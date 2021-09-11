<?php

namespace App\Http\Controllers\Backend\TecDoc\DirectArticleDetails;

use App\Http\Controllers\Controller;
use App\Models\TecDoc\DirectArticle\DirectArticle;
use App\Models\TecDoc\DirectArticleDetails\DirectArticleDetails;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class DirectArticleDetailsController extends Controller
{
    /**
     * @return View
     */
    public function index()
    {
        return view('backend.tecdoc-direct-article-details.index');
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
     * @param \App\Models\TecDoc\DirectArticleDetails\DirectArticleDetails $directArticleDetails
     * @return \Illuminate\Http\Response
     */
    public function show(DirectArticleDetails $directArticleDetails)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\TecDoc\DirectArticleDetails\DirectArticleDetails $directArticleDetails
     * @return \Illuminate\Http\Response
     */
    public function edit(DirectArticleDetails $directArticleDetails)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\TecDoc\DirectArticleDetails\DirectArticleDetails $directArticleDetails
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DirectArticleDetails $directArticleDetails)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\TecDoc\DirectArticleDetails\DirectArticleDetails $directArticleDetails
     * @return \Illuminate\Http\Response
     */
    public function destroy(DirectArticleDetails $directArticleDetails)
    {
        //
    }

    /**
     * @return RedirectResponse
     */
    public function sync()
    {
        ini_set('max_execution_time', 0);

        DirectArticleDetails::truncate();

        DirectArticle::orderBy('id')->chunk(25, function ($directArticles) {
            $directArticleIds = [];

            foreach ($directArticles as $directArticle) {
                $directArticleIds[] = $directArticle->articleId;
            }

            Artisan::call('tecdoc:direct-articles-details', [
                'articleIds' => $directArticleIds,
            ]);

            $output = Artisan::output();
            $output = json_decode($output, true);


            if (!$this->hasSuccessResponse($output)) {
                \Log::alert('FAIL DIRECT ARTICLE DETAILS RESPONSE FOR IDS [' . implode(", ", $directArticleIds) . ']!');
                \Log::alert($output);
                return false;
            }

            $output = $this->getResponseDataAsArray($output);

            if (empty($output)) {
                \Log::alert('EMPTY DIRECT ARTICLE DETAILS RESPONSE FOR IDS [' . implode(", ", $directArticleIds) . ']!');
                return false;
            }

            $details = [];

            foreach ($output as $articleDetails) {
                $detailsItem['articleId'] = $articleDetails['directArticle']['articleId'];
                $detailsItem['articleName'] = $articleDetails['directArticle']['articleName'];
                $detailsItem['articleNo'] = $articleDetails['directArticle']['articleNo'];
                $detailsItem['articleState'] = $articleDetails['directArticle']['articleState'];
                $detailsItem['articleStateName'] = $articleDetails['directArticle']['articleStateName'];
                $detailsItem['brandName'] = $articleDetails['directArticle']['brandName'];
                $detailsItem['brandNo'] = $articleDetails['directArticle']['brandNo'];
                $detailsItem['genericArticleId'] = $articleDetails['directArticle']['genericArticleId'];
                $detailsItem['flagAccessories'] = $articleDetails['directArticle']['flagAccessories'];
                $detailsItem['flagCertificationCompulsory'] = $articleDetails['directArticle']['flagCertificationCompulsory'];
                $detailsItem['flagRemanufacturedPart'] = $articleDetails['directArticle']['flagRemanufacturedPart'];
                $detailsItem['flagSuitedforSelfService'] = $articleDetails['directArticle']['flagSuitedforSelfService'];
                $detailsItem['hasAppendage'] = $articleDetails['directArticle']['hasAppendage'];
                $detailsItem['hasAxleLink'] = $articleDetails['directArticle']['hasAxleLink'];
                $detailsItem['hasCsGraphics'] = $articleDetails['directArticle']['hasCsGraphics'];
                $detailsItem['hasDocuments'] = $articleDetails['directArticle']['hasDocuments'];
                $detailsItem['hasLessDiscount'] = $articleDetails['directArticle']['hasLessDiscount'];
                $detailsItem['hasMarkLink'] = $articleDetails['directArticle']['hasMarkLink'];
                $detailsItem['hasMotorLink'] = $articleDetails['directArticle']['hasMotorLink'];
                $detailsItem['hasOEN'] = $articleDetails['directArticle']['hasOEN'];
                $detailsItem['hasPartList'] = $articleDetails['directArticle']['hasPartList'];
                $detailsItem['hasPrices'] = $articleDetails['directArticle']['hasPrices'];
                $detailsItem['hasSecurityInfo'] = $articleDetails['directArticle']['hasSecurityInfo'];
                $detailsItem['hasUsage'] = $articleDetails['directArticle']['hasUsage'];
                $detailsItem['hasVehicleLink'] = $articleDetails['directArticle']['hasVehicleLink'];
                $detailsItem['articleAttributes'] = json_encode($articleDetails['articleAttributes']);
                $detailsItem['articleThumbnails'] = json_encode($articleDetails['articleThumbnails']);
                $detailsItem['articleDocuments'] = json_encode($articleDetails['articleDocuments']);
                $detailsItem['articleInfo'] = json_encode($articleDetails['articleInfo']);
                $detailsItem['articlePrices'] = json_encode($articleDetails['articlePrices']);
                $detailsItem['eanNumber'] = json_encode($articleDetails['eanNumber']);
                $detailsItem['immediateAttributs'] = json_encode($articleDetails['immediateAttributs']);
                $detailsItem['immediateInfo'] = json_encode($articleDetails['immediateInfo']);
                $detailsItem['mainArticle'] = json_encode($articleDetails['mainArticle']);
//                $detailsItem['mainArticle'] = '';
                $detailsItem['oenNumbers'] = json_encode($articleDetails['oenNumbers']);
//                $detailsItem['oenNumbers'] = '';
                $detailsItem['usageNumbers2'] = json_encode($articleDetails['usageNumbers2']);
                $detailsItem['replacedByNumber'] = json_encode($articleDetails['replacedByNumber']);
                $detailsItem['replacedNumber'] = json_encode($articleDetails['replacedNumber']);
                $detailsItem['created_at'] = now();
                $detailsItem['updated_at'] = now();

                $details[] = $detailsItem;
            }

            DirectArticleDetails::insert($details);
        });

        return redirect()->back();
    }
}
