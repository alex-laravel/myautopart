<?php

namespace App\Http\Controllers\Frontend\AutoPart;

use App\Http\Controllers\Controller;
use App\Models\TecDoc\Manufacturer\Manufacturer;
use App\Models\TecDoc\ModelSeries;
use App\Models\TecDoc\Vehicle;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class AutoPartController extends Controller
{
    /**
     * @param integer $manufacturerId
     * @param integer $modelSeriesId
     * @param integer $vehicleId
     * @return View
     */
    public function index($manufacturerId, $modelSeriesId, $vehicleId)
    {
        $manufacturer = Manufacturer::where('manuId', $manufacturerId)->first();

        if (!$manufacturer) {
            abort(404);
        }

        $modelSeries = ModelSeries::where('manuId', $manufacturer->manuId)->where('modelId', $modelSeriesId)->first();

        if (!$modelSeries) {
            abort(404);
        }

        $vehicle = Vehicle::where('carId', $vehicleId)->first();

        if (!$vehicle) {
            abort(404);
        }

        return view('frontend.auto-parts.index', [
            'manufacturer' => $manufacturer,
            'modelSeries' => $modelSeries,
            'vehicle' => $vehicle,
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
