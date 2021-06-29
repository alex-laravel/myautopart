<?php

namespace App\Http\Controllers\Backend\TecDoc\Manufacturer;

use App\Http\Controllers\Controller;
use App\Models\TecDoc\Manufacturer;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Str;

class ManufacturerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        return view('backend.tecdoc-manufacturers.index');
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
     * @param \App\Models\TecDoc\Manufacturer $manufacturer
     * @return \Illuminate\Http\Response
     */
    public function show(Manufacturer $manufacturer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\TecDoc\Manufacturer $manufacturer
     * @return \Illuminate\Http\Response
     */
    public function edit(Manufacturer $manufacturer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\TecDoc\Manufacturer $manufacturer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Manufacturer $manufacturer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\TecDoc\Manufacturer $manufacturer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Manufacturer $manufacturer)
    {
        //
    }

    /**
     * @return RedirectResponse
     */
    public function sync()
    {
        Artisan::call('tecdoc:manufacturers');

        $output = Artisan::output();
        $output = json_decode($output, true);

        if (!$this->hasSuccessResponse($output)) {
            return redirect()->back();
        }

        $output = $this->getResponseDataAsArray($output);

        if (empty($output)) {
            return redirect()->back();
        }

        foreach ($output as &$manufacturer) {
            $manufacturer['slug'] = Str::slug($manufacturer['manuName']);
            $manufacturer['isPopular'] = $manufacturer['favorFlag'];
            $manufacturer['isVisible'] = true;
        }

        Manufacturer::truncate();
        Manufacturer::insert($output);

        return redirect()->back();
    }
}
