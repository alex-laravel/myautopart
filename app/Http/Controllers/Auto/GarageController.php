<?php

namespace App\Http\Controllers\Auto;

use App\Facades\Garage;
use App\Http\Controllers\Controller;
use App\Models\TecDoc\Manufacturer;
use App\Models\TecDoc\ModelSeries;
use App\Models\TecDoc\Vehicle;
use Illuminate\Http\RedirectResponse;


class GarageController extends Controller
{
    /**
     * @param integer $manufacturerId
     * @param integer $modelSeriesId
     * @param integer $vehicleId
     * @return RedirectResponse
     */
    public function vehicleAdd($manufacturerId, $modelSeriesId, $vehicleId)
    {
        $manufacturer = Manufacturer::where('manuId', $manufacturerId)->first();

        if (!$manufacturer) {
            return back();
        }

        $modelSeries = ModelSeries::where('manuId', $manufacturer->manuId)->where('modelId', $modelSeriesId)->first();

        if (!$modelSeries) {
            return back();
        }

        $vehicle = Vehicle::where('carId', $vehicleId)->first();

        if (!$modelSeries) {
            abort(404);
        }

        Garage::addVehicle($manufacturer->manuId, $manufacturer->manuName, $modelSeries->modelId, $modelSeries->modelname, $vehicle->carId, $vehicle->carName);

        return redirect('/');
    }

    /**
     * @param integer $manufacturerId
     * @param integer $modelSeriesId
     * @param integer $vehicleId
     * @return RedirectResponse
     */
    public function vehicleActivate($manufacturerId, $modelSeriesId, $vehicleId)
    {
        Garage::activateVehicle($manufacturerId, $modelSeriesId, $vehicleId);

        return back();
    }

    /**
     * @param integer $manufacturerId
     * @param integer $modelSeriesId
     * @param integer $vehicleId
     * @return RedirectResponse
     */
    public function vehicleDelete($manufacturerId, $modelSeriesId, $vehicleId)
    {
        Garage::deleteVehicle($manufacturerId, $modelSeriesId, $vehicleId);

        return back();
    }
}
