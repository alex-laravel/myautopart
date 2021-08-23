<?php

namespace App\Http\Controllers\Frontend\AutoPart;

use App\Facades\Garage;
use App\Http\Controllers\Frontend\FrontendController;
use App\Models\TecDoc\AssemblyGroup\AssemblyGroup;
use App\Models\TecDoc\Brand;
use App\Models\TecDoc\DirectArticle\DirectArticle;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class AutoPartController extends FrontendController
{
    const PARTS_PACKAGE_LIMIT = 10;

    /**
     * @return View
     */
    public function byVehicle()
    {
        $activeVehicle = Garage::getActiveVehicle();

        if (!$activeVehicle) {
            abort(404);
        }

        $parts = DirectArticle::where('carId', (int)$activeVehicle['vehicleId'])->paginate(self::PARTS_PACKAGE_LIMIT);

//        $assemblyGroups = AssemblyGroup::orderBy('assemblyGroupName')->get()->toArray();
//        $assemblyGroupsTree = $this->generateAssemblyGroupsTree($assemblyGroups);

        return view('frontend.auto-parts.vehicle', [
            'manufacturerId' => $activeVehicle['manufacturerId'],
            'manufacturerName' => $activeVehicle['manufacturerName'],
            'modelSeriesId' => $activeVehicle['modelSeriesId'],
            'modelSeriesName' => $activeVehicle['modelSeriesName'],
            'vehicleId' => $activeVehicle['vehicleId'],
            'vehicleName' => $activeVehicle['vehicleName'],
            'parts' => $parts,
            'assemblyGroups' => []
//            'assemblyGroups' => $assemblyGroupsTree
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

        $assemblyGroups = AssemblyGroup::orderBy('assemblyGroupName')->get()->toArray();
        $assemblyGroupsTree = $this->generateAssemblyGroupsTree($assemblyGroups);

        return view('frontend.auto-parts.brand', [
            'brand' => $brand,
            'parts' => $parts,
            'assemblyGroups' => $assemblyGroupsTree
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


    /**
     * @param array $assemblyGroups
     * @param integer $parentId
     * @return array
     */
    private function generateAssemblyGroupsTree(&$assemblyGroups, $parentId = null)
    {
        $assemblyGroupsTree = [];

        foreach ($assemblyGroups as $assemblyGroup) {
            if ($assemblyGroup['parentNodeId'] == $parentId) {
                $children = $this->generateAssemblyGroupsTree($assemblyGroups, $assemblyGroup['assemblyGroupNodeId']);

                if ($children) {
                    $assemblyGroup['children'] = $children;
                }

                $assemblyGroupsTree[$assemblyGroup['assemblyGroupNodeId']] = $assemblyGroup;
                unset($assemblyGroups[$assemblyGroup['assemblyGroupNodeId']]);
            }
        }

        return $assemblyGroupsTree;
    }
}
