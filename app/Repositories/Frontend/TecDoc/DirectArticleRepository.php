<?php


namespace App\Repositories\Frontend\TecDoc;


use App\Models\TecDoc\DirectArticleDetails\DirectArticleDetails;
use App\Repositories\BaseRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class DirectArticleRepository extends BaseRepository
{
    /**
     * @param integer $directArticleDetailsId
     * @return Model
     */
    public function getDirectArticleByIdWithDocumentsWithProducts($directArticleDetailsId)
    {
        return DirectArticleDetails::with('documents')
            ->with('products')
            ->find((int)$directArticleDetailsId);
    }

    /**
     * @param integer $packageLimit
     * @param string $directArticleNo
     * @return LengthAwarePaginator
     */
    public function getDirectArticleByArticleNoWithDocumentsWithProducts($directArticleNo, $packageLimit = 10)
    {
        return DirectArticleDetails::with('documents')
            ->with('products')
            ->where('articleNo', $directArticleNo)
            ->paginate($packageLimit);
    }

    /**
     * @param integer $carId
     * @param integer $packageLimit
     * @return LengthAwarePaginator
     */
    public function getDirectArticlesByVehicleIdPaginated($carId, $packageLimit = 10)
    {
        return DB::table('td_cross_direct_article_vehicle')
            ->leftJoin('td_direct_article_details', 'td_cross_direct_article_vehicle.articleId', '=', 'td_direct_article_details.articleId')
            ->select([
                'td_direct_article_details.id',
                'td_direct_article_details.articleId',
                'td_direct_article_details.articleName',
                'td_direct_article_details.articleNo',
                'td_direct_article_details.brandNo'
            ])
            ->where('td_cross_direct_article_vehicle.carId', (int)$carId)
            ->paginate($packageLimit);
    }

    /**
     * @param array $assemblyGroupNodeIds
     * @param integer $packageLimit
     * @return LengthAwarePaginator
     */
    public function getDirectArticlesByAssemblyIdsPaginated($assemblyGroupNodeIds, $packageLimit = 10)
    {
        return DB::table('td_cross_direct_article_assembly_group')
            ->leftJoin('td_direct_article_details', 'td_cross_direct_article_assembly_group.articleId', '=', 'td_direct_article_details.articleId')
            ->select([
                'td_direct_article_details.id',
                'td_direct_article_details.articleId',
                'td_direct_article_details.articleName',
                'td_direct_article_details.articleNo',
                'td_direct_article_details.brandNo'
            ])
            ->whereIn('td_cross_direct_article_assembly_group.assemblyGroupNodeId', $assemblyGroupNodeIds)
            ->paginate($packageLimit);
    }

    /**
     * @param integer $brandId
     * @param integer $packageLimit
     * @return LengthAwarePaginator
     */
    public function getDirectArticlesByBrandIdPaginated($brandId, $packageLimit = 10)
    {
        return DB::table('td_cross_direct_article_brand')
            ->leftJoin('td_direct_article_details', 'td_cross_direct_article_brand.articleId', '=', 'td_direct_article_details.articleId')
            ->select([
                'td_direct_article_details.id',
                'td_direct_article_details.articleId',
                'td_direct_article_details.articleName',
                'td_direct_article_details.articleNo',
                'td_direct_article_details.brandNo'
            ])
            ->where('td_cross_direct_article_brand.brandNo', (int)$brandId)
            ->paginate($packageLimit);
    }
}
