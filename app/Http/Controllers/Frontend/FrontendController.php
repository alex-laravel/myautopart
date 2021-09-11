<?php


namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Repositories\Frontend\TecDoc\AssemblyGroupRepository;
use App\Repositories\Frontend\TecDoc\ManufacturerRepository;
use App\Repositories\Frontend\TecDoc\ModelSeriesRepository;
use App\Repositories\Frontend\TecDoc\VehicleRepository;
use Illuminate\Support\Facades\View;

class FrontendController extends Controller
{
    /**
     * @var ManufacturerRepository
     */
    protected $manufacturerRepository;

    /**
     * @var ModelSeriesRepository
     */
    protected $modelSeriesRepository;

    /**
     * @var VehicleRepository
     */
    protected $vehicleRepository;

    /**
     * @var AssemblyGroupRepository
     */
    protected $assemblyGroupRepository;

    /**
     * @param ManufacturerRepository $manufacturerRepository
     * @param ModelSeriesRepository $modelSeriesRepository
     * @param VehicleRepository $vehicleRepository
     * @param AssemblyGroupRepository $assemblyGroupRepository
     */
    public function __construct(ManufacturerRepository $manufacturerRepository,
                                ModelSeriesRepository $modelSeriesRepository,
                                VehicleRepository $vehicleRepository,
                                AssemblyGroupRepository $assemblyGroupRepository)
    {
        $this->manufacturerRepository = $manufacturerRepository;
        $this->modelSeriesRepository = $modelSeriesRepository;
        $this->vehicleRepository = $vehicleRepository;
        $this->assemblyGroupRepository = $assemblyGroupRepository;

        View::share('sharedAssemblyGroups', $this->assemblyGroupRepository->getAssemblyGroupsAsTree());
    }
}
