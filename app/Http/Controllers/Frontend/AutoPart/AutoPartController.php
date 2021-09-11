<?php

namespace App\Http\Controllers\Frontend\AutoPart;

use App\Http\Controllers\Frontend\FrontendController;
use App\Models\TecDoc\Brand;
use App\Models\TecDoc\DirectArticle\DirectArticle;
use Illuminate\Contracts\View\View;

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

        $parts = DirectArticle::with('details')->where('carId', $vehicle->carId)->paginate(self::PARTS_PACKAGE_LIMIT);

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
     * @param integer $categoryId
     * @return View
     */
    public function byCategory($categoryId)
    {
        $assemblyGroupNodeIds = $this->assemblyGroupRepository->getLowerAssemblyGroupIdsByParentShortCutId($categoryId);

        $parts = DirectArticle::with('details')->whereIn('assemblyGroupNodeId', $assemblyGroupNodeIds)->paginate(self::PARTS_PACKAGE_LIMIT);

        return view('frontend.auto-parts.category', [
            'parts' => $parts
        ]);
    }

    /**
     * @param integer $assemblyId
     * @return View
     */
    public function byAssembly($assemblyId)
    {
        $assemblyGroupNodeIds = $this->assemblyGroupRepository->getLowerAssemblyGroupIdsByParentAssemblyGroupId($assemblyId);

        $parts = DirectArticle::whereIn('assemblyGroupNodeId', $assemblyGroupNodeIds)->paginate(self::PARTS_PACKAGE_LIMIT);

        return view('frontend.auto-parts.assembly', [
            'parts' => $parts
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

        $parts = DirectArticle::with('details')->where('brandNo', (int)$brandId)->paginate(self::PARTS_PACKAGE_LIMIT);

        return view('frontend.auto-parts.brand', [
            'brand' => $brand,
            'parts' => $parts,
            'assemblyGroups' => []
        ]);
    }

    /**
     * @param integer $partId
     * @return View
     */
    public function partDetails($partId)
    {
        return view('frontend.auto-parts.part-details');
    }
}
