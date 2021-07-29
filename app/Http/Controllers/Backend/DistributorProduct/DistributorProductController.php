<?php

namespace App\Http\Controllers\Backend\DistributorProduct;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\DistributorProduct\DistributorProductImportRequest;
use App\Models\Distributor\Distributor;
use App\Models\DistributorProduct\DistributorProduct;
use App\Repositories\Backend\DistributorProducts\DistributorProductsRepository;
use Illuminate\Contracts\View\View;
use Illuminate\Http\UploadedFile;

class DistributorProductController extends Controller
{
    const FILE_IMPORT_EXTENSION_TXT = 'txt';
    const FILE_IMPORT_EXPECTED_SECTORS_SIZE = 11;
    const FILE_IMPORT_EXPECTED_SECTORS_START = 4;

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

        $distributor = Distributor::find((int)$request->input('distributor_id'));
        $distributorStorageIds = $distributor->storages()->orderBy('import_sequence_number')->get()->pluck('id')->toArray();

        $file = $request->file('distributor_file');

        switch (true) {
            case $file->extension() === self::FILE_IMPORT_EXTENSION_TXT:
                $this->importTxt($distributorStorageIds, $file);
                break;
        }

        return back()->withFlashSuccess(trans('alerts.backend.distributor_products.imported'));
    }

    /**
     * @param array $distributorStorageIds
     * @param UploadedFile $file
     */
    private function importTxt($distributorStorageIds, UploadedFile $file)
    {
        $content = fopen($file, 'r');
        fgets($content);

        while (!feof($content)) {
            $line = fgets($content);
            $line = explode("\t", $line);

            if (count($line) === self::FILE_IMPORT_EXPECTED_SECTORS_SIZE) {
                $products = [];

                foreach ($distributorStorageIds as $index => $distributorStorageId) {
                    $quantity = (int)$line[self::FILE_IMPORT_EXPECTED_SECTORS_START + $index];

                    $products[] = [
                        'distributor_storage_id' => $distributorStorageId,
                        'original_product_no' => iconv(mb_detect_encoding($line[1], mb_detect_order(), true), "UTF-8", $line[1]),
                        'original_product_name' => iconv(mb_detect_encoding($line[2], mb_detect_order(), true), "UTF-8", $line[2]),
                        'original_brand_name' => iconv(mb_detect_encoding($line[0], mb_detect_order(), true), "UTF-8", $line[0]),
                        'price' => $line[3],
                        'quantity' => $quantity > 0 ? $quantity : 0,
                    ];
                }

                DistributorProduct::insert($products);
            }
        }

        fclose($content);
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
