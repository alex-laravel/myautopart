<?php

namespace App\Http\Controllers\Backend\TecDoc\ShortCut;

use App\Http\Controllers\Controller;
use App\Models\TecDoc\ShortCut\ShortCut;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class ShortCutController extends Controller
{
    /**
     * @return View
     */
    public function index()
    {
        return view('backend.tecdoc-short-cuts.index');
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
     * @param  \App\Models\TecDoc\ShortCut\ShortCut  $shortCut
     * @return \Illuminate\Http\Response
     */
    public function show(ShortCut $shortCut)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TecDoc\ShortCut\ShortCut  $shortCut
     * @return \Illuminate\Http\Response
     */
    public function edit(ShortCut $shortCut)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TecDoc\ShortCut\ShortCut  $shortCut
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ShortCut $shortCut)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TecDoc\ShortCut\ShortCut  $shortCut
     * @return \Illuminate\Http\Response
     */
    public function destroy(ShortCut $shortCut)
    {
        //
    }

    /**
     * @return RedirectResponse
     */
    public function sync()
    {
        Artisan::call('tecdoc:short-cuts');

        $output = Artisan::output();
        $output = json_decode($output, true);

        if (!$this->hasSuccessResponse($output)) {
            return redirect()->back();
        }

        $output = $this->getResponseDataAsArray($output);

        if (empty($output)) {
            return redirect()->back();
        }

        ShortCut::truncate();
        ShortCut::insert($output);

        return redirect()->back();
    }
}
