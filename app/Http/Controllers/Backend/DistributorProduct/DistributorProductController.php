<?php

namespace App\Http\Controllers\Backend\DistributorProduct;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\DistributorProduct\DistributorProductImportRequest;
use App\Imports\DistributorAutoTechnicsImport;
use App\Imports\DistributorTehnomirImport;
use App\Imports\DistributorUniqueTradeImport;
use App\Models\Distributor\Distributor;
use App\Repositories\Backend\DistributorProducts\DistributorProductsRepository;
use Illuminate\Contracts\View\View;

use Maatwebsite\Excel\Facades\Excel;

class DistributorProductController extends Controller
{
    const FILE_IMPORT_EXTENSION_CSV = 'csv';

    const DISTRIBUTOR_IMPORT_SLUG_AUTO_TECHNICS = 'auto-technics';
    const DISTRIBUTOR_IMPORT_SLUG_AUTO_TEXNOMIR_ODESSA = 'texnomir-odessa';
    const DISTRIBUTOR_IMPORT_SLUG_AUTO_TEXNOMIR_GERMANIYA = 'texnomir-germaniya';
    const DISTRIBUTOR_IMPORT_SLUG_AUTO_TEXNOMIR_EMIRATY = 'texnomir-emiraty';
    const DISTRIBUTOR_IMPORT_SLUG_AUTO_UNIQUE_TRADE = 'unique-trade';

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
     * @return View
     */
    public function index()
    {
        return view('backend.distributor-products.index', [
            'distributorsList' => $this->prepareDistributorsList(),
        ]);
    }

    /**
     * @param DistributorProductImportRequest $request
     * @return View
     */
    public function import(DistributorProductImportRequest $request)
    {
        ini_set('max_execution_time', 0);

        $distributorId = (int)$request->input('distributor_id');
        $distributorFile = $request->file('distributor_file');

        $distributor = Distributor::find($distributorId);
        $distributorStorageIds = $distributor->storages()->orderBy('import_sequence_number')->get()->pluck('id')->toArray();

        switch (true) {
            case $distributor->import_slug === self::DISTRIBUTOR_IMPORT_SLUG_AUTO_TECHNICS && $distributorFile->getClientOriginalExtension() === self::FILE_IMPORT_EXTENSION_CSV:
                Excel::import(new DistributorAutoTechnicsImport($distributorStorageIds), $distributorFile, \Maatwebsite\Excel\Excel::CSV);
                break;
            case $distributor->import_slug === self::DISTRIBUTOR_IMPORT_SLUG_AUTO_TEXNOMIR_ODESSA && $distributorFile->getClientOriginalExtension() === self::FILE_IMPORT_EXTENSION_CSV:
            case $distributor->import_slug === self::DISTRIBUTOR_IMPORT_SLUG_AUTO_TEXNOMIR_GERMANIYA && $distributorFile->getClientOriginalExtension() === self::FILE_IMPORT_EXTENSION_CSV:
            case $distributor->import_slug === self::DISTRIBUTOR_IMPORT_SLUG_AUTO_TEXNOMIR_EMIRATY && $distributorFile->getClientOriginalExtension() === self::FILE_IMPORT_EXTENSION_CSV:
                Excel::import(new DistributorTehnomirImport($distributorStorageIds), $distributorFile, \Maatwebsite\Excel\Excel::CSV);
                break;
            case $distributor->import_slug === self::DISTRIBUTOR_IMPORT_SLUG_AUTO_UNIQUE_TRADE && $distributorFile->getClientOriginalExtension() === self::FILE_IMPORT_EXTENSION_CSV:
                Excel::import(new DistributorUniqueTradeImport($distributorStorageIds), $distributorFile, \Maatwebsite\Excel\Excel::CSV);
                break;
            default:
                return back()->withFlashDanger(trans('exceptions.backend.distributor_products.import_error'));
        }

        return back()->withFlashSuccess(trans('alerts.backend.distributor_products.imported'));
    }

    /**
     * @return array
     */
    private function prepareDistributorsList()
    {
        $distributors = Distributor::pluck('title', 'id')->toArray();
        $distributors[0] = ' - Select One - ';

        asort($distributors);

        return $distributors;
    }
}
