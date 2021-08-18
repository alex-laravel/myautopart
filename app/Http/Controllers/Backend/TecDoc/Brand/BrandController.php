<?php

namespace App\Http\Controllers\Backend\TecDoc\Brand;

use App\Http\Controllers\Controller;
use App\Models\TecDoc\Brand;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        return view('backend.tecdoc-brands.index');
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
     * @param \App\Models\TecDoc\Brand $brand
     * @return \Illuminate\Http\Response
     */
    public function show(Brand $brand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\TecDoc\Brand $brand
     * @return \Illuminate\Http\Response
     */
    public function edit(Brand $brand)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\TecDoc\Brand $brand
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Brand $brand)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\TecDoc\Brand $brand
     * @return \Illuminate\Http\Response
     */
    public function destroy(Brand $brand)
    {
        //
    }

    /**
     * @return RedirectResponse
     */
    public function sync()
    {
        Artisan::call('tecdoc:brands');

        $output = Artisan::output();
        $output = json_decode($output, true);

        if (!$this->hasSuccessResponse($output)) {
            \Log::alert('FAIL BRANDS RESPONSE!');
            return redirect()->back();
        }

        $output = $this->getResponseDataAsArray($output);

        if (empty($output)) {
            \Log::alert('EMPTY BRANDS RESPONSE!');
            return redirect()->back();
        }

        Brand::truncate();
        Brand::insert($output);

        \Log::info('BRANDS CREATED!');

        return redirect()->back();
    }

    /**
     * @return RedirectResponse
     */
    public function syncAssets()
    {
        ini_set('max_execution_time', 0);

        $brands = Brand::get();

        foreach ($brands as $brand) {
            Artisan::call('tecdoc:brand-assets', [
                'brandId' => $brand->id,
                'brandLogoId' => $brand->brandLogoID
            ]);

            $output = Artisan::output();

            if ($output !== true) {
                \Log::alert('FAIL BRAND ASSETS RESPONSE for Brand ID [' . $brand->brandId . ']!');
                continue;
            }

            \Log::info('BRANDS CREATED for Brand ID [' . $brand->brandId . ']!');
        }

        return redirect()->back();
    }
}
