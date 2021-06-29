<?php

namespace App\Http\Controllers\Backend\TecDoc\Vehicle;

use App\Http\Controllers\Controller;
use App\Models\TecDoc\ModelSeries;
use App\Models\TecDoc\Vehicle;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Str;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        return view('backend.tecdoc-vehicles.index');
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
     * @param  \App\Models\TecDoc\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function show(Vehicle $vehicle)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TecDoc\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function edit(Vehicle $vehicle)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TecDoc\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vehicle $vehicle)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TecDoc\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vehicle $vehicle)
    {
        //
    }

    /**
     * @return RedirectResponse
     */
    public function sync()
    {
        ini_set('max_execution_time', 0);

        Vehicle::truncate();

        foreach (ModelSeries::orderBy('manuId')->get() as $modelSeries) {
            Artisan::call('tecdoc:vehicles', [
                'manufacturerId' => $modelSeries->manuId,
                'modelId' => $modelSeries->modelId,
            ]);

            $output = Artisan::output();
            $output = json_decode($output, true);

            if (!$this->hasSuccessResponse($output)) {
                \Log::alert('FAIL RESPONSE FOR MANUFACTURER ID [' . $modelSeries->manuId . '] AND MODEL ID [' . $modelSeries->modelId . ']!');
                continue;
            }

            $output = $this->getResponseDataAsArray($output);

            if (empty($output)) {
                \Log::alert('EMPTY RESPONSE FOR MANUFACTURER ID [' . $modelSeries->manuId . '] AND MODEL ID [' . $modelSeries->modelId . ']!');
                continue;
            }

            foreach ($output as &$vehicle) {
                $vehicle['manuId'] = $modelSeries->manuId;
                $vehicle['modelId'] = $modelSeries->modelId;
                $vehicle['slug'] = Str::slug($vehicle['carName']);
            }

            Vehicle::insert($output);

            \Log::info('VEHICLES FOR MANUFACTURER ID [' . $modelSeries->manuId . '] AND MODEL ID [' . $modelSeries->modelId . '] CREATED!');
        }

        return redirect()->back();
    }
}
