<?php

namespace App\Http\Controllers\Backend\TecDoc\BrandAddress;

use App\Http\Controllers\Controller;
use App\Models\TecDoc\BrandAddresses;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class BrandAddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        return view('backend.tecdoc-brand-addresses.index');
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
     * @param  \App\Models\TecDoc\BrandAddresses  $brandAddresses
     * @return \Illuminate\Http\Response
     */
    public function show(BrandAddresses $brandAddresses)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TecDoc\BrandAddresses  $brandAddresses
     * @return \Illuminate\Http\Response
     */
    public function edit(BrandAddresses $brandAddresses)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TecDoc\BrandAddresses  $brandAddresses
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BrandAddresses $brandAddresses)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TecDoc\BrandAddresses  $brandAddresses
     * @return \Illuminate\Http\Response
     */
    public function destroy(BrandAddresses $brandAddresses)
    {
        //
    }
}
