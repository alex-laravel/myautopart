<?php

namespace App\Http\Controllers\Backend\TecDoc\Vehicle;

use App\Http\Controllers\Backend\TecDoc\TecDocController;
use App\Http\Requests\Backend\Vehicle\VehicleSynchronizeRequest;
use App\Models\TecDoc\Country;
use App\Models\TecDoc\CountryGroup;
use App\Models\TecDoc\ModelSeries;
use App\Models\TecDoc\Vehicle\Vehicle;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Str;

class VehicleController extends TecDocController
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        return view('backend.tecdoc-vehicles.index', [
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
     * @param Vehicle $vehicle
     * @return \Illuminate\Http\Response
     */
    public function show(Vehicle $vehicle)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Vehicle $vehicle
     * @return \Illuminate\Http\Response
     */
    public function edit(Vehicle $vehicle)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Vehicle $vehicle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vehicle $vehicle)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Vehicle $vehicle
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vehicle $vehicle)
    {
        //
    }

    /**
     * @param VehicleSynchronizeRequest $request
     * @return RedirectResponse
     */
    public function sync(VehicleSynchronizeRequest $request)
    {
        ini_set('max_execution_time', 0);

        Vehicle::truncate();

        $vehicleIds = [];

        foreach (self::$allowedPassengerAndCommercialLinkingTargetTypes as $linkingTargetType) {
            foreach (ModelSeries::orderBy('manuId')->get() as $modelSeries) {
                Artisan::call('tecdoc:vehicles', [
                    'country' => $request->input('country'),
                    'countryGroup' => $request->input('countryGroup'),
                    'manufacturerId' => $modelSeries->manuId,
                    'modelId' => $modelSeries->modelId,
                    'linkingTargetType' => $linkingTargetType,
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

                foreach ($output as $index => &$vehicle) {
                    if (in_array($vehicle['carId'], $vehicleIds)) {
                        unset($output[$index]);
                        continue;
                    }

                    $vehicle['manuId'] = $modelSeries->manuId;
                    $vehicle['modelId'] = $modelSeries->modelId;
                    $vehicle['slug'] = Str::slug($vehicle['carName']);

                    unset($vehicle['carType']);

                    $vehicleIds[] = $vehicle['carId'];
                }

                Vehicle::insert($output);

                \Log::info('VEHICLES FOR MANUFACTURER ID [' . $modelSeries->manuId . '] AND MODEL ID [' . $modelSeries->modelId . '] CREATED!');
            }
        }


        return redirect()->back();
    }
}
