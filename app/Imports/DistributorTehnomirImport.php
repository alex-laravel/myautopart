<?php

namespace App\Imports;

use App\Models\DistributorProduct\DistributorProduct;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class DistributorTehnomirImport extends DistributorAbstractImport implements ToCollection
{
    const  HEADING_ROW_COUNT = 0;

    /**
     * @var array
     */
    private $distributorStorageIds;

    /**
     * @param array $distributorStorageIds
     */
    public function __construct($distributorStorageIds)
    {
        $this->distributorStorageIds = $distributorStorageIds;
    }

    /**
     * @param Collection $rows
     */
    public function collection(Collection $rows)
    {
        $this->clearExistingProducts($this->distributorStorageIds);

        foreach ($rows as $rowIndex => $row) {
            if ($this->isHeading($rowIndex)) {
                continue;
            }

            foreach ($this->distributorStorageIds as $distributorStorageId) {
                DistributorProduct::create([
                    'distributor_storage_id' => $distributorStorageId,
                    'original_product_no' => $row[7],
                    'original_product_name' => $row[2],
                    'original_brand_name' => $row[0],
                    'price' => filter_var($row[10], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION),
                    'quantity' => (int)filter_var($row[3], FILTER_SANITIZE_NUMBER_INT)
                ]);
            }
        }
    }

    /**
     * @param integer $rowIndex
     * @return boolean
     */
    private function isHeading($rowIndex)
    {
        return $rowIndex <= self::HEADING_ROW_COUNT;
    }
}
