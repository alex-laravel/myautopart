<?php


namespace App\Http\Controllers\Frontend;


use App\Http\Controllers\Controller;
use App\Models\TecDoc\AssemblyGroup\AssemblyGroup;
use App\Models\TecDoc\Brand;
use App\Models\TecDoc\Manufacturer\Manufacturer;
use App\Models\TecDoc\ShortCut\ShortCut;
use Illuminate\Contracts\View\View;

class HomeController extends Controller
{
    const BRANDS_LIMIT = 16;

    /**
     * @return View
     */
    public function index()
    {
//
//        //        Garage::clearVehicles();
//
        $manufacturers = Manufacturer::onlyIsFavorite()->orderBy('manuName')->get();

        $brands = Brand::inRandomOrder()->limit(self::BRANDS_LIMIT)->get();

        $categories = ShortCut::orderBy('shortCutName')->get();
        $assemblyGroups = AssemblyGroup::orderBy('assemblyGroupName')->get()->toArray();

        $assemblyGroupsTree = $this->generateAssemblyGroupsTree($assemblyGroups);

        return view('frontend.home.index', [
            'manufacturers' => $manufacturers,
            'brands' => $brands,
//            'garageVehicles' => Garage::getVehicles(),
            'assemblyGroups' => $assemblyGroupsTree,
            'categories' => $categories,
        ]);
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
                $children = null;
//                $children = $this->generateAssemblyGroupsTree($assemblyGroups, $assemblyGroup['assemblyGroupNodeId']);

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
