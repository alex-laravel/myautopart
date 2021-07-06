<?php

namespace App\Http\Controllers\Backend\TecDoc\Model;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Model\ModelSynchronizeRequest;
use App\Models\TecDoc\Country;
use App\Models\TecDoc\CountryGroup;
use App\Models\TecDoc\Manufacturer;
use App\Models\TecDoc\ModelSeries;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Str;

class ModelController extends Controller
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TecDoc\ModelSeries  $modelSeries
     * @return \Illuminate\Http\Response
     */
    public function show(ModelSeries $modelSeries)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TecDoc\ModelSeries  $modelSeries
     * @return \Illuminate\Http\Response
     */
    public function edit(ModelSeries $modelSeries)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TecDoc\ModelSeries  $modelSeries
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ModelSeries $modelSeries)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TecDoc\ModelSeries  $modelSeries
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

        $manufacturers = Manufacturer::orderBy('manuId')->get();

        foreach ($manufacturers as $manufacturer) {
            Artisan::call('tecdoc:models', [
                'manufacturerId' => $manufacturer->manuId,
                'country' => $request->input('country'),
                'countryGroup' => $request->input('countryGroup'),
                'linkingTargetType' => $manufacturer->linkingTargetTypes
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

            foreach ($output as &$model) {
                $model['manuId'] = $manufacturer->manuId;

                if (!isset($model['yearOfConstrFrom'])) {
                    $model['yearOfConstrFrom'] = null;
                }

                if (!isset($model['yearOfConstrTo'])) {
                    $model['yearOfConstrTo'] = null;
                }

                $model['isPopular'] = $model['favorFlag'];
                $model['isVisible'] = true;
                $model['slug'] = Str::slug($model['modelname']);
            }

            ModelSeries::insert($output);
        }

        return redirect()->back();
    }
}
