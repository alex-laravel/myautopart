<?php

namespace App\Http\Controllers\Backend\TecDoc\AssemblyGroup;

use App\Http\Controllers\Backend\TecDoc\TecDocController;
use App\Models\TecDoc\AssemblyGroup\AssemblyGroup;
use App\Models\TecDoc\ShortCut\ShortCut;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class AssemblyGroupController extends TecDocController
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        return view('backend.tecdoc-assembly-groups.index');
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
     * @param \App\Models\TecDoc\AssemblyGroup\AssemblyGroup $assemblyGroup
     * @return \Illuminate\Http\Response
     */
    public function show(AssemblyGroup $assemblyGroup)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\TecDoc\AssemblyGroup\AssemblyGroup $assemblyGroup
     * @return \Illuminate\Http\Response
     */
    public function edit(AssemblyGroup $assemblyGroup)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\TecDoc\AssemblyGroup\AssemblyGroup $assemblyGroup
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AssemblyGroup $assemblyGroup)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\TecDoc\AssemblyGroup\AssemblyGroup $assemblyGroup
     * @return \Illuminate\Http\Response
     */
    public function destroy(AssemblyGroup $assemblyGroup)
    {
        //
    }


    /**
     * @return RedirectResponse
     */
    public function sync()
    {
        AssemblyGroup::truncate();


        foreach (self::$allowedTargetTypes as $linkingTargetType) {
            foreach (ShortCut::get() as $shortCut) {
                Artisan::call('tecdoc:assembly-groups', [
                    'shortCutId' => $shortCut->shortCutId,
                    'linkingTargetType' => $linkingTargetType
                ]);

                $output = Artisan::output();
                $output = json_decode($output, true);

                if (!$this->hasSuccessResponse($output)) {
                    \Log::alert('FAIL ASSEMBLY GROUPS RESPONSE FOR SHORT CUT ID [' . $shortCut->shortCutId . ']!');
                    continue;
                }

                $output = $this->getResponseDataAsArray($output);

                if (empty($output)) {
                    \Log::alert('EMPTY ASSEMBLY GROUPS RESPONSE FOR SHORT CUT ID [' . $shortCut->shortCutId . ']!');
                    continue;
                }

                foreach ($output as &$assemblyGroup) {
                    $assemblyGroup['shortCutId'] = $shortCut->shortCutId;
                    $assemblyGroup['parentNodeId'] = isset($assemblyGroup['parentNodeId']) ? $assemblyGroup['parentNodeId'] : null;
                    $assemblyGroup['linkingTargetType'] = $linkingTargetType;
                }

                AssemblyGroup::insert($output);
            }
        }

        return redirect()->back();
    }
}
