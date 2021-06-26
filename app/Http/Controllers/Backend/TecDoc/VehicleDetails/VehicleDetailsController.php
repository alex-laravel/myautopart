<?php

namespace App\Http\Controllers\Backend\TecDoc\VehicleDetails;

use App\Http\Controllers\Controller;
use App\Models\TecDoc\VehicleDetails;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class VehicleDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        return view('backend.tecdoc-languages.index');
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
     * @param  \App\Models\TecDoc\VehicleDetails  $vehicleDetails
     * @return \Illuminate\Http\Response
     */
    public function show(VehicleDetails $vehicleDetails)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TecDoc\VehicleDetails  $vehicleDetails
     * @return \Illuminate\Http\Response
     */
    public function edit(VehicleDetails $vehicleDetails)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TecDoc\VehicleDetails  $vehicleDetails
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, VehicleDetails $vehicleDetails)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TecDoc\VehicleDetails  $vehicleDetails
     * @return \Illuminate\Http\Response
     */
    public function destroy(VehicleDetails $vehicleDetails)
    {
        //
    }
}
