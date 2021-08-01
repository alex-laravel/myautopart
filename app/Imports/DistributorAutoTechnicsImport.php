<?php

namespace App\Imports;

use App\Models\DistributorProduct\DistributorProduct;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;

class DistributorAutoTechnicsImport extends DistributorAbstractImport implements ToCollection, WithCustomCsvSettings
{
    const  HEADING_ROW_COUNT = 1;
    const  QUANTITY_COLUMN_START = 4;
    const  SEPARATOR_SYMBOL = ';';

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

            $data = explode(self::SEPARATOR_SYMBOL, $row[0]);

            foreach ($this->distributorStorageIds as $distributorStorageIndex => $distributorStorageId) {
                DistributorProduct::create([
                    'distributor_storage_id' => $distributorStorageId,
                    'original_product_no' => $this->filterOriginalProductNo($data[1]),
                    'original_product_name' => $data[2],
                    'original_brand_name' => $data[0],
                    'price' => filter_var($data[3], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION),
                    'quantity' => (int)filter_var($data[self::QUANTITY_COLUMN_START + $distributorStorageIndex], FILTER_SANITIZE_NUMBER_INT),
                ]);
            }
        }
    }

    /**
     * @return array
     */
    public function getCsvSettings(): array
    {
        return [
            'delimiter' => "\t"
        ];
    }

    /**
     * @param string $value
     * @return string
     */
    private function filterOriginalProductNo($value)
    {
        return substr($value, strpos($value, " ") + 1);
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
