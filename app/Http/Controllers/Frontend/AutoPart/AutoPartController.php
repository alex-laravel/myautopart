<?php

namespace App\Http\Controllers\Frontend\AutoPart;

use App\Http\Controllers\Frontend\FrontendController;
use App\Models\TecDoc\Brand;
use App\Models\TecDoc\DirectArticle\DirectArticle;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class AutoPartController extends FrontendController
{
    const PARTS_PACKAGE_LIMIT = 10;

    /**
     * @param integer $vehicleId
     * @return View
     */
    public function byVehicle($vehicleId)
    {
        $vehicle = $this->vehicleRepository->getVehicleById($vehicleId);

        if (!$vehicle) {
            abort(404);
        }

        $manufacturer = $this->manufacturerRepository->getManufacturerById($vehicle->manuId);

        if (!$manufacturer) {
            abort(404);
        }

        $modelSeries = $this->modelSeriesRepository->getModelSeriesById($vehicle->modelId);

        if (!$modelSeries) {
            abort(404);
        }

        $parts = DirectArticle::where('carId', $vehicle->carId)->paginate(self::PARTS_PACKAGE_LIMIT);

        return view('frontend.auto-parts.vehicle', [
            'manufacturerId' => $manufacturer->manuId,
            'manufacturerName' => $manufacturer->manuName,
            'modelSeriesId' => $modelSeries->modelId,
            'modelSeriesName' => $modelSeries->modelname,
            'vehicleId' => $vehicle->carId,
            'vehicleName' => $vehicle->carName,
            'parts' => $parts,
            'assemblyGroups' => []
        ]);
    }

    /**
     * @param integer $brandId
     * @return View
     */
    public function byBrand($brandId)
    {
        $brand = Brand::where('brandId', (int)$brandId)->first();

        if (!$brand) {
            abort(404);
        }

        $parts = DirectArticle::where('brandNo', (int)$brandId)->paginate(self::PARTS_PACKAGE_LIMIT);

        return view('frontend.auto-parts.brand', [
            'brand' => $brand,
            'parts' => $parts,
            'assemblyGroups' => []
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
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
