<?php


namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Repositories\Frontend\TecDoc\AssemblyGroupRepository;
use App\Repositories\Frontend\TecDoc\BrandRepository;
use App\Repositories\Frontend\TecDoc\DirectArticleRepository;
use App\Repositories\Frontend\TecDoc\ManufacturerRepository;
use App\Repositories\Frontend\TecDoc\ModelSeriesRepository;
use App\Repositories\Frontend\TecDoc\ShortCutRepository;
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
     * @var BrandRepository
     */
    protected $brandRepository;

    /**
     * @var ShortCutRepository
     */
    protected $shortCutRepository;

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
     * @param BrandRepository $brandRepository
     * @param ShortCutRepository $shortCutRepository
     * @param AssemblyGroupRepository $assemblyGroupRepository
     * @param DirectArticleRepository $directArticleRepository
     */
    public function __construct(ManufacturerRepository $manufacturerRepository,
                                ModelSeriesRepository $modelSeriesRepository,
                                VehicleRepository $vehicleRepository,
                                BrandRepository $brandRepository,
                                ShortCutRepository $shortCutRepository,
                                AssemblyGroupRepository $assemblyGroupRepository,
                                DirectArticleRepository $directArticleRepository)
    {
        $this->manufacturerRepository = $manufacturerRepository;
        $this->modelSeriesRepository = $modelSeriesRepository;
        $this->vehicleRepository = $vehicleRepository;
        $this->brandRepository = $brandRepository;
        $this->shortCutRepository = $shortCutRepository;
        $this->assemblyGroupRepository = $assemblyGroupRepository;
        $this->directArticleRepository = $directArticleRepository;

        View::share('sharedAssemblyGroups', $this->assemblyGroupRepository->getAssemblyGroupsAsTree());
    }
}
