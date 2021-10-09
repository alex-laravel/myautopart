<?php


namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Repositories\Frontend\TecDoc\AssemblyGroupRepository;
use App\Repositories\Frontend\TecDoc\DirectArticleRepository;
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
     * @var DirectArticleRepository
     */
    protected $directArticleRepository;

    /**
     * @param ManufacturerRepository $manufacturerRepository
     * @param ModelSeriesRepository $modelSeriesRepository
     * @param VehicleRepository $vehicleRepository
     * @param AssemblyGroupRepository $assemblyGroupRepository
     * @param DirectArticleRepository $directArticleRepository
     */
    public function __construct(ManufacturerRepository $manufacturerRepository,
                                ModelSeriesRepository $modelSeriesRepository,
                                VehicleRepository $vehicleRepository,
                                AssemblyGroupRepository $assemblyGroupRepository,
                                DirectArticleRepository $directArticleRepository)
    {
        $this->manufacturerRepository = $manufacturerRepository;
        $this->modelSeriesRepository = $modelSeriesRepository;
        $this->vehicleRepository = $vehicleRepository;
        $this->assemblyGroupRepository = $assemblyGroupRepository;
        $this->directArticleRepository = $directArticleRepository;

        View::share('sharedAssemblyGroups', $this->assemblyGroupRepository->getAssemblyGroupsAsTree());
    }
}
