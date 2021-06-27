<?php


namespace App\Http\Controllers\Backend\TecDoc\VehicleDetails;


use App\Http\Controllers\Controller;
use App\Repositories\Backend\TecDoc\VehicleDetailsRepository;

class VehicleDetailsAjaxController extends Controller
{
    /**
     * @var VehicleDetailsRepository
     */
    protected $vehicleDetailsRepository;

    /**
     * @param VehicleDetailsRepository $vehicleDetailsRepository
     */
    public function __construct(VehicleDetailsRepository $vehicleDetailsRepository)
    {
        $this->vehicleDetailsRepository = $vehicleDetailsRepository;
    }

    /**
     * @return array
     * @throws \Exception
     */
    public function get()
    {
        return datatables()->of($this->vehicleDetailsRepository->getData())->make(true);
    }
}
