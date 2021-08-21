<?php


namespace App\Http\Controllers\Backend\TecDoc\Manufacturer;


use App\Http\Controllers\Controller;
use App\Repositories\Backend\TecDoc\ManufacturerRepository;

class ManufacturerAjaxController extends Controller
{
    /**
     * @var ManufacturerRepository
     */
    protected $manufacturerRepository;

    /**
     * @param ManufacturerRepository $manufacturerRepository
     */
    public function __construct(ManufacturerRepository $manufacturerRepository)
    {
        $this->manufacturerRepository = $manufacturerRepository;
    }

    /**
     * @return array
     * @throws \Exception
     */
    public function get()
    {
        return datatables()->of($this->manufacturerRepository->getData())
            ->editColumn('favorFlag', function ($manufacturer) {
                return $manufacturer->isfavoriteLabel;
            })
            ->editColumn('isPopular', function ($manufacturer) {
                return $manufacturer->isPopularLabel;
            })
            ->editColumn('isVisible', function ($manufacturer) {
                return $manufacturer->isVisibleLabel;
            })
            ->rawColumns(['favorFlag', 'isPopular', 'isVisible'])
            ->make(true);
    }
}
