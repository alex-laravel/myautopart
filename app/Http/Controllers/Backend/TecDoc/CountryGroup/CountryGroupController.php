<?php

namespace App\Http\Controllers\Backend\TecDoc\CountryGroup;

use App\Http\Controllers\Controller;
use App\Models\TecDoc\CountryGroup;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class CountryGroupController extends Controller
{
    /**
     * @return View
     */
    public function index()
    {
        return view('backend.tecdoc-county-groups.index');
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
     * @param  \App\Models\TecDoc\CountryGroup  $countryGroup
     * @return \Illuminate\Http\Response
     */
    public function show(CountryGroup $countryGroup)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TecDoc\CountryGroup  $countryGroup
     * @return \Illuminate\Http\Response
     */
    public function edit(CountryGroup $countryGroup)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TecDoc\CountryGroup  $countryGroup
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CountryGroup $countryGroup)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TecDoc\CountryGroup  $countryGroup
     * @return \Illuminate\Http\Response
     */
    public function destroy(CountryGroup $countryGroup)
    {
        //
    }
}
