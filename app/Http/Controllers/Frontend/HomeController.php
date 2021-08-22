<?php


namespace App\Http\Controllers\Frontend;


use App\Facades\Garage;
use App\Http\Controllers\Controller;
use App\Models\TecDoc\Brand;
use App\Models\TecDoc\Manufacturer\Manufacturer;
use Illuminate\Contracts\View\View;

class HomeController extends Controller
{
    const BRANDS_LIMIT = 16;

    /**
     * @return View
     */
    public function index()
    {
//        Garage::clearVehicles();

        $manufacturers = Manufacturer::onlyIsFavorite()->orderBy('manuName')->get();

        $brands = Brand::inRandomOrder()->limit(self::BRANDS_LIMIT)->get();

        return view('frontend.home.index', [
            'manufacturers' => $manufacturers,
            'brands' => $brands,
//            'garageVehicles' => Garage::getVehicles(),
        ]);
    }
}
