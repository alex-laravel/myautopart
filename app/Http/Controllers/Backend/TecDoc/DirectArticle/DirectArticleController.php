<?php

namespace App\Http\Controllers\Backend\TecDoc\DirectArticle;

use App\Http\Controllers\Backend\TecDoc\TecDocController;
use App\Models\TecDoc\DirectArticle\DirectArticle;
use App\Models\TecDoc\GenericArticle\GenericArticle;
use App\Models\TecDoc\Vehicle;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class DirectArticleController extends TecDocController
{
    /**
     * @return View
     */
    public function index()
    {
        return view('backend.tecdoc-direct-articles.index');
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
     * @param  \App\Models\TecDoc\DirectArticle\DirectArticle  $directArticle
     * @return \Illuminate\Http\Response
     */
    public function show(DirectArticle $directArticle)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TecDoc\DirectArticle\DirectArticle  $directArticle
     * @return \Illuminate\Http\Response
     */
    public function edit(DirectArticle $directArticle)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TecDoc\DirectArticle\DirectArticle  $directArticle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DirectArticle $directArticle)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TecDoc\DirectArticle\DirectArticle  $directArticle
     * @return \Illuminate\Http\Response
     */
    public function destroy(DirectArticle $directArticle)
    {
        //
    }

    /**
     * @return RedirectResponse
     */
    public function sync()
    {
        ini_set('max_execution_time', 0);

//        DirectArticle::truncate();

        $vehicles = Vehicle::where('carId', '>', 2034)->orderBy('carId')->get();
        $genericArticleIds = GenericArticle::orderBy('genericArticleId')->get()->pluck('genericArticleId')->toArray();

        foreach ($vehicles as $vehicle) {
            foreach (array_chunk($genericArticleIds, 24) as $genericArticleChunk) {
                Artisan::call('tecdoc:direct-articles', [
                    'linkingTargetId' => $vehicle->carId,
                    'linkingTargetType' => $vehicle->carType,
                    'genericArticleIds' => $genericArticleChunk,
                ]);

                $output = Artisan::output();
                $output = json_decode($output, true);

                if (!$this->hasSuccessResponse($output)) {
                    \Log::alert('FAIL DIRECT ARTICLES RESPONSE FOR linkingTargetId [' . $vehicle->carId . '] AND linkingTargetType [' . $vehicle->carType . '] AND genericArticleIds [' . implode(",", $genericArticleChunk) . ']!');
                    continue;
                }

                $output = $this->getResponseDataAsArray($output);

                if (empty($output)) {
                    \Log::alert('EMPTY DIRECT ARTICLES RESPONSE FOR linkingTargetId [' . $vehicle->carId . '] AND linkingTargetType [' . $vehicle->carType . '] AND genericArticleIds [' . implode(",", $genericArticleChunk) . ']!');
                    continue;
                }

                foreach ($output as &$article) {
                    $article['carId'] = $vehicle->carId;
                    $article['carType'] = $vehicle->carType;
                    $article['assemblyGroupNodeId'] = 0;
                }

                DirectArticle::insert($output);

                \Log::info('DIRECT ARTICLES FOR linkingTargetId [' . $vehicle->carId . '] AND linkingTargetType [' . $vehicle->carType . '] AND genericArticleIds [' . implode(",", $genericArticleChunk) . '] CREATED!');
            }
        }

        return redirect()->back();
    }
}
