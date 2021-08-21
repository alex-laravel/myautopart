<?php


namespace App\Repositories\Backend\TecDoc;


use App\Models\TecDoc\VehicleDetails\VehicleDetails;
use App\Repositories\BaseRepository;

class VehicleDetailsRepository extends BaseRepository
{
    const MODEL = VehicleDetails::class;

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->query()
            ->select([
                'td_vehicle_details.*'
            ]);
    }
}
