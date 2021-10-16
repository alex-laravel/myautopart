<?php

namespace App\Http\Controllers\Frontend\AutoPart;

use App\Helpers\VinCodeHelper;
use App\Http\Controllers\Frontend\FrontendController;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class AutoPartController extends FrontendController
{
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
    public function searchByOriginalNoOrVin(Request $request)
    {
        $searchCode = (string)$request->input('searchCode');
        $searchCode = strtoupper($searchCode);

        switch (true) {
            case $this->isVinCode($searchCode):
                return $this->searchByVin($searchCode);
            default:
                return $this->searchByOriginalNo($searchCode);
        }
    }

    /**
     * @param string $partOriginalNo
     * @return View
     */
    private function searchByOriginalNo($partOriginalNo)
    {
        $parts = $this->directArticleRepository->getDirectArticleByArticleNoWithDocumentsWithProducts($partOriginalNo);

        return view('frontend.auto-parts.search', [
            'partNo' => $partOriginalNo,
            'parts' => $parts
        ]);
    }

    /**
     * @param string $vinCode
     * @return View
     */
    private function searchByVin($vinCode)
    {
        Artisan::call('tecdoc:vin-code-decoding', [
            'vinCode' => $vinCode
        ]);

        $output = Artisan::output();
        $output = json_decode($output, true);

        if (!$this->hasSuccessResponse($output)) {
            return view('frontend.auto-parts.search', ['partNo' => $vinCode, 'parts' => []]);
        }

        $output = $this->getResponseData($output);

        if (empty($output)) {
            return view('frontend.auto-parts.search', ['partNo' => $vinCode, 'parts' => []]);
        }

        if (!isset($output['matchingManufacturers']['array'][0]['manuId'])) {
            return view('frontend.auto-parts.search', ['partNo' => $vinCode, 'parts' => []]);
        }

        $manufacturer = $this->manufacturerRepository->getManufacturerById($output['matchingManufacturers']['array'][0]['manuId']);

        if (!$manufacturer) {
            return view('frontend.auto-parts.search', ['partNo' => $vinCode, 'parts' => []]);
        }

        if (!isset($output['matchingModels']['array'][0]['modelId'])) {
            return view('frontend.auto-parts.search', ['partNo' => $vinCode, 'parts' => []]);
        }

        $modelSeries = $this->modelSeriesRepository->getModelSeriesById($output['matchingModels']['array'][0]['modelId']);

        if (!$modelSeries) {
            return view('frontend.auto-parts.search', ['partNo' => $vinCode, 'parts' => []]);
        }

        if (!isset($output['matchingVehicles']['array']) || !is_array($output['matchingVehicles']['array'])) {
            return view('frontend.auto-parts.search', ['partNo' => $vinCode, 'parts' => []]);
        }

        $vehicleIds = array_column($output['matchingVehicles']['array'], 'carId');
        $vehicles = $this->vehicleRepository->getVehiclesByIds($vehicleIds);

        return view('frontend.auto.model', [
            'manufacturer' => $manufacturer,
            'modelSeries' => $modelSeries,
            'vehicles' => $vehicles,
        ]);
    }

    /**
     * @param string $searchCode
     * @return boolean
     */
    private function isVinCode($searchCode)
    {
        return preg_match(VinCodeHelper::PATTERN, $searchCode) === 1;
    }
}
