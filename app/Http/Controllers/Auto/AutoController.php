<?php

namespace App\Http\Controllers\Auto;

use App\Facades\Garage;
use App\Http\Controllers\Controller;
use App\Models\TecDoc\Manufacturer;
use App\Models\TecDoc\ModelSeries;
use App\Models\TecDoc\ShortCuts;
use App\Models\TecDoc\Vehicle;
use Illuminate\Contracts\View\View;


class AutoController extends Controller
{
    /**
     * @param string $manufacturer
     * @return View
     */
    public function manufacturer($manufacturer)
    {
        $manufacturer = Manufacturer::where('manuId', $manufacturer)->first();

        if (!$manufacturer) {
            abort(404);
        }

        $modelSeries = ModelSeries::where('manuId', $manufacturer->manuId)->get();

        return view('auto.manufacturer', [
            'manufacturer' => $manufacturer,
            'modelSeries' => $modelSeries,
        ]);
    }

    /**
     * @param string $manufacturer
     * @param string $model
     * @return View
     */
    public function model($manufacturer, $model)
    {
        $manufacturer = Manufacturer::where('manuId', $manufacturer)->first();

        if (!$manufacturer) {
            abort(404);
        }

        $modelSeries = ModelSeries::where('manuId', $manufacturer->manuId)->where('modelId', $model)->first();

        if (!$modelSeries) {
            abort(404);
        }

        $vehicles = Vehicle::where('manuId', $manufacturer->manuId)->where('modelId', $model)->get();

        return view('auto.model', [
            'manufacturer' => $manufacturer,
            'modelSeries' => $modelSeries,
            'vehicles' => $vehicles,
        ]);
    }

    /**
     * @param string $manufacturer
     * @param string $model
     * @param string $vehicle
     * @return View
     */
    public function vehicle($manufacturer, $model, $vehicle)
    {
        $manufacturer = Manufacturer::where('manuId', $manufacturer)->first();

        if (!$manufacturer) {
            abort(404);
        }

        $modelSeries = ModelSeries::where('manuId', $manufacturer->manuId)->where('modelId', $model)->first();

        if (!$modelSeries) {
            abort(404);
        }

        $vehicle = Vehicle::where('carId', $vehicle)->first();

        if (!$modelSeries) {
            abort(404);
        }

        return view('auto.vehicle', [
            'manufacturer' => $manufacturer,
            'modelSeries' => $modelSeries,
            'vehicle' => $vehicle,
        ]);
    }
}
