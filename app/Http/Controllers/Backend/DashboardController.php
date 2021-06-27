<?php


namespace App\Http\Controllers\Backend;


use App\Http\Controllers\Controller;
use App\Models\TecDoc\Brand;
use App\Models\TecDoc\Manufacturer;
use App\Models\TecDoc\ModelSeries;
use App\Models\TecDoc\Vehicle;
use Illuminate\Contracts\View\View;

class DashboardController extends Controller
{
    /**
     * @return View
     */
    public function index()
    {
        return view('backend.dashboard.index', [
            'manufacturersTotal' => Manufacturer::get()->count(),
            'modelsTotal' => ModelSeries::get()->count(),
            'vehiclesTotal' => Vehicle::get()->count(),
            'brandsTotal' => Brand::get()->count(),
        ]);
    }
}
