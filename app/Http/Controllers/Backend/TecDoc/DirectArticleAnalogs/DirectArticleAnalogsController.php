<?php

namespace App\Http\Controllers\Backend\TecDoc\DirectArticleAnalogs;

use App\Http\Controllers\Controller;
use App\Models\TecDoc\DirectArticleAnalog\DirectArticleAnalog;
use App\Models\TecDoc\DirectArticleDetails\DirectArticleDetails;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class DirectArticleAnalogsController extends Controller
{
    /**
     * @return View
     */
    public function index()
    {
        return view('backend.tecdoc-direct-article-analogs.index');
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
     * @param \App\Models\TecDoc\DirectArticleAnalog\DirectArticleAnalog $directArticleAnalog
     * @return \Illuminate\Http\Response
     */
    public function show(DirectArticleAnalog $directArticleAnalog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\TecDoc\DirectArticleAnalog\DirectArticleAnalog $directArticleAnalog
     * @return \Illuminate\Http\Response
     */
    public function edit(DirectArticleAnalog $directArticleAnalog)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\TecDoc\DirectArticleAnalog\DirectArticleAnalog $directArticleAnalog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DirectArticleAnalog $directArticleAnalog)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\TecDoc\DirectArticleAnalog\DirectArticleAnalog $directArticleAnalog
     * @return \Illuminate\Http\Response
     */
    public function destroy(DirectArticleAnalog $directArticleAnalog)
    {
        //
    }

    /**
     * @return RedirectResponse
     */
    public function sync()
    {
        ini_set('max_execution_time', 0);

//        DirectArticleAnalog::truncate();

        DirectArticleDetails::chunk(500, function ($directArticles) {
            foreach ($directArticles as $directArticle) {
                Artisan::call('tecdoc:direct-articles-analogs', [
                    'articleNumber' => $directArticle->articleNo,
                ]);

                $output = Artisan::output();
                $output = json_decode($output, true);

                if (!$this->hasSuccessResponse($output)) {
                    \Log::alert('FAIL DIRECT ARTICLE ANALOGS RESPONSE FOR ID [' . $directArticle->id . '] AND articleNo [' . $directArticle->articleNo . ']!');
                    \Log::alert($output);
                    continue;
                }

                $output = $this->getResponseDataAsArray($output);

                if (empty($output)) {
                    \Log::alert('EMPTY DIRECT ARTICLE ANALOGS RESPONSE FOR ID [' . $directArticle->id . '] AND articleNo [' . $directArticle->articleNo . ']!');
                    continue;
                }

                foreach ($output as &$directArticleAnalog) {
                    $directArticleAnalog['originalArticleId'] = $directArticle->articleId;
                    $directArticleAnalog['originalArticleNo'] = $directArticle->articleNo;
                }

                DirectArticleAnalog::insert($output);

                \Log::alert('DIRECT ARTICLE ANALOGS FOR ID [' . $directArticle->id . '] AND articleNo [' . $directArticle->articleNo . '] CREATED!');
            }
        });

        return redirect()->back();
    }
}
