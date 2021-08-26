<?php

namespace App\Http\Controllers\Backend\TecDoc\Model;

use App\Http\Controllers\Backend\TecDoc\TecDocController;
use App\Http\Requests\Backend\Model\ModelSynchronizeRequest;
use App\Models\TecDoc\Country;
use App\Models\TecDoc\CountryGroup;
use App\Models\TecDoc\Manufacturer\Manufacturer;
use App\Models\TecDoc\ModelSeries;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Str;

class ModelController extends TecDocController
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        return view('backend.tecdoc-models.index', [
            'countries' => Country::orderBy('countryCode')->get(),
            'countryGroups' => CountryGroup::orderBy('tecdocCode')->get(),
            'defaultLanguage' => config('tecdoc.api.country'),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\TecDoc\ModelSeries $modelSeries
     * @return \Illuminate\Http\Response
     */
    public function show(ModelSeries $modelSeries)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\TecDoc\ModelSeries $modelSeries
     * @return \Illuminate\Http\Response
     */
    public function edit(ModelSeries $modelSeries)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\TecDoc\ModelSeries $modelSeries
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ModelSeries $modelSeries)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\TecDoc\ModelSeries $modelSeries
     * @return \Illuminate\Http\Response
     */
    public function destroy(ModelSeries $modelSeries)
    {
        //
    }

    /**
     * @param ModelSynchronizeRequest $request
     * @return RedirectResponse
     */
    public function sync(ModelSynchronizeRequest $request)
    {
        ini_set('max_execution_time', 0);

        ModelSeries::truncate();

        $manufacturers = Manufacturer::onlyIsFavorite()->orderBy('manuId')->get();

        $modelIds = [];

        foreach ($manufacturers as $manufacturer) {
            foreach (self::$allowedPassengerAndCommercialLinkingTargetTypes as $linkingTargetType) {
                Artisan::call('tecdoc:models', [
                    'country' => $request->input('country'),
                    'countryGroup' => $request->input('countryGroup'),
                    'manufacturerId' => $manufacturer->manuId,
                    'linkingTargetType' => $linkingTargetType
                ]);

                $output = Artisan::output();
                $output = json_decode($output, true);

                if (!$this->hasSuccessResponse($output)) {
                    continue;
                }

                $output = $this->getResponseDataAsArray($output);

                if (empty($output)) {
                    continue;
                }

                foreach ($output as $index => &$model) {
                    if (in_array($model['modelId'], $modelIds)) {
                        unset($output[$index]);
                        continue;
                    }

                    $model['manuId'] = $manufacturer->manuId;
                    $model['yearOfConstrFrom'] = isset($model['yearOfConstrFrom']) ? $this->prepareConstructionYearFormat($model['yearOfConstrFrom']) : null;
                    $model['yearOfConstrTo'] = isset($model['yearOfConstrTo']) ? $this->prepareConstructionYearFormat($model['yearOfConstrTo']) : null;
                    $model['isPopular'] = $model['favorFlag'];
                    $model['isVisible'] = true;
                    $model['slug'] = Str::slug($model['modelname']);

                    $modelIds[] = $model['modelId'];
                }

                ModelSeries::insert($output);
            }
        }

        return redirect()->back();
    }

    /**
     * @param string $year
     * @return integer|null
     */
    private function prepareConstructionYearFormat($year)
    {
        if (empty($year)) {
            return null;
        }

        $yearFrom = 1900;
        $yearTo = date('Y');

        $year = substr($year, 0, 4);
        $year = (int)$year;

        return ($yearFrom <= $year) && ($year <= $yearTo) ? $year : null;
    }
}
