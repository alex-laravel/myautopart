<?php

namespace App\Http\Controllers\Backend\TecDoc\Model;

use App\Http\Controllers\Controller;
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
        return view('backend.tecdoc-models.index');
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
     * @return RedirectResponse
     */
    public function sync()
    {
        ini_set('max_execution_time', 0);

        ModelSeries::truncate();

        $manufacturerIds = Manufacturer::get()->pluck('manuId')->toArray();

        foreach ($manufacturerIds as $manufacturerId) {
            Artisan::call('tecdoc:models', [
                'manufacturerId' => $manufacturerId
            ]);

            $output = Artisan::output();
            $output = json_decode($output, true);

            if (!$this->hasSuccessResponse($output)) {
                return redirect()->back();
            }

            $output = $this->getResponseDataAsArray($output);

            if (empty($output)) {
                return redirect()->back();
            }

            foreach ($output as &$model) {
                $model['manuId'] = $manufacturerId;

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

//            \Log::info('MODELS FOR MANUFACTURER ID [' . $manufacturerId . '] CREATED!');
        }

        return redirect()->back();
    }
}
