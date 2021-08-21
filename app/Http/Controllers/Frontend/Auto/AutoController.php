<?php

namespace App\Http\Controllers\Frontend\Auto;

use App\Facades\Garage;
use App\Http\Controllers\Controller;
use App\Models\TecDoc\Manufacturer\Manufacturer;
use App\Models\TecDoc\ModelSeries;
use App\Models\TecDoc\Vehicle\Vehicle;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;


class AutoController extends Controller
{
    /**
     * @return View
     */
    public function index()
    {
        $manufacturers = Manufacturer::onlyIsFavorite()->orderBy('manuName')->get();

        return view('frontend.auto.index', [
            'manufacturers' => $manufacturers,
        ]);
    }

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

        return view('frontend.auto.manufacturer', [
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

        return view('frontend.auto.model', [
            'manufacturer' => $manufacturer,
            'modelSeries' => $modelSeries,
            'vehicles' => $vehicles,
        ]);
    }

    /**
     * @param string $manufacturer
     * @param string $model
     * @param string $vehicle
     * @return RedirectResponse
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

        if (!$vehicle) {
            abort(404);
        }

        Garage::addVehicle($manufacturer->manuId, $manufacturer->manuName, $modelSeries->modelId, $modelSeries->modelname, $vehicle->carId, $vehicle->carName);

        return redirect()->route('frontend.parts.index', [$manufacturer->manuId, $modelSeries->modelId, $vehicle->carId]);
    }
}
