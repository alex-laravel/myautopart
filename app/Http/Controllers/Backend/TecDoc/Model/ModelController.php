<?php

namespace App\Http\Controllers\Backend\TecDoc\Model;

use App\Http\Controllers\Controller;
use App\Models\TecDoc\ModelSeries;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ModelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        return view('backend.tecdoc-models.index');
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
     * @param  \App\Models\TecDoc\ModelSeries  $modelSeries
     * @return \Illuminate\Http\Response
     */
    public function show(ModelSeries $modelSeries)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TecDoc\ModelSeries  $modelSeries
     * @return \Illuminate\Http\Response
     */
    public function edit(ModelSeries $modelSeries)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TecDoc\ModelSeries  $modelSeries
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ModelSeries $modelSeries)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TecDoc\ModelSeries  $modelSeries
     * @return \Illuminate\Http\Response
     */
    public function destroy(ModelSeries $modelSeries)
    {
        //
    }
}
