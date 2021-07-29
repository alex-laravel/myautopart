<?php

namespace App\Http\Controllers\Backend\DistributorProduct;

use App\Http\Controllers\Controller;
use App\Repositories\Backend\DistributorProducts\DistributorProductsRepository;

class DistributorProductAjaxController extends Controller
{
    /**
     * @var DistributorProductsRepository
     */
    protected $distributorProductsRepository;

    /**
     * @param DistributorProductsRepository $distributorProductsRepository
     */
    public function __construct(DistributorProductsRepository $distributorProductsRepository)
    {
        $this->distributorProductsRepository = $distributorProductsRepository;
    }

    /**
     * @return array
     * @throws \Exception
     */
    public function get()
    {
        return datatables()->of($this->distributorProductsRepository->getData())
            ->addColumn('distributor', function ($distributorProduct) {
                return $distributorProduct->distributor ? $distributorProduct->distributor->title : '';
            })
            ->addColumn('actions', function ($distributorProduct) {
                return $distributorProduct->actionButtons;
            })
            ->rawColumns(['actions'])
            ->make(true);
    }
}
