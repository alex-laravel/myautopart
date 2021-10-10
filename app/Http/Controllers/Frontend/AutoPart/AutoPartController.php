<?php

namespace App\Http\Controllers\Frontend\AutoPart;

use App\Http\Controllers\Frontend\FrontendController;
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

        $parts = $this->directArticleRepository->getDirectArticlesByVehicleIdPaginated($vehicle->carId);

        return view('frontend.auto-parts.vehicle', [
            'manufacturerId' => $manufacturer->manuId,
            'manufacturerName' => $manufacturer->manuName,
            'modelSeriesId' => $modelSeries->modelId,
            'modelSeriesName' => $modelSeries->modelname,
            'vehicleId' => $vehicle->carId,
            'vehicleName' => $vehicle->carName,
            'parts' => $parts
        ]);
    }

    /**
     * @param integer $shortCutId
     * @return View
     */
    public function byCategory($shortCutId)
    {
        $shortCut = $this->shortCutRepository->getShortCutByShortCutId($shortCutId);

        if (!$shortCut) {
            abort(404);
        }

        $assemblyGroupNodeIds = $this->assemblyGroupRepository->getLowerAssemblyGroupIdsByParentShortCutId($shortCut->shortCutId);

        $parts = $this->directArticleRepository->getDirectArticlesByAssemblyIdsPaginated($assemblyGroupNodeIds);

        return view('frontend.auto-parts.category', [
            'shortCut' => $shortCut,
            'parts' => $parts
        ]);
    }

    /**
     * @param integer $assemblyId
     * @return View
     */
    public function byAssembly($assemblyId)
    {
        $assemblyGroup = $this->assemblyGroupRepository->getAssemblyGroupByAssemblyGroupId($assemblyId);

        if (!$assemblyGroup) {
            abort(404);
        }

        $assemblyGroupNodeIds = $assemblyGroup->hasChilds
            ? $this->assemblyGroupRepository->getLowerAssemblyGroupIdsByParentAssemblyGroupId($assemblyId)
            : [$assemblyGroup->assemblyGroupNodeId];

        $assemblyGroupNodeIds = array_unique($assemblyGroupNodeIds);

        $parts = $this->directArticleRepository->getDirectArticlesByAssemblyIdsPaginated($assemblyGroupNodeIds);

        return view('frontend.auto-parts.assembly', [
            'assemblyGroup' => $assemblyGroup,
            'parts' => $parts
        ]);
    }

    /**
     * @param integer $brandId
     * @return View
     */
    public function byBrand($brandId)
    {
        $brand = $this->brandRepository->getBrandByBrandId($brandId);

        if (!$brand) {
            abort(404);
        }

        $parts = $this->directArticleRepository->getDirectArticlesByBrandIdPaginated($brand->brandId);

        return view('frontend.auto-parts.brand', [
            'brand' => $brand,
            'parts' => $parts
        ]);
    }

    /**
     * @param integer $partId
     * @return View
     */
    public function partDetails($partId)
    {
        $part = $this->directArticleRepository->getDirectArticleByIdWithDocumentsWithProducts($partId);

        if (!$part) {
            abort(404);
        }

        return view('frontend.auto-parts.part-details', [
            'part' => $part
        ]);
    }

    /**
     * @param Request $request
     * @return View
     */
    public function partSearch(Request $request)
    {
        $partNo = (string)$request->input('partOriginalNo');

        $parts = $this->directArticleRepository->getDirectArticleByArticleNoWithDocumentsWithProducts($partNo);

        return view('frontend.auto-parts.search', [
            'partNo' => $partNo,
            'parts' => $parts
        ]);
    }
}
