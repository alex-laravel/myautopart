<?php


namespace App\Http\Controllers\Frontend;


use App\Http\Controllers\Controller;
use App\Repositories\Frontend\TecDoc\AssemblyGroupRepository;
use App\Repositories\Frontend\TecDoc\ManufacturerRepository;
use App\Repositories\Frontend\TecDoc\ModelSeriesRepository;
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
     * @param ManufacturerRepository $manufacturerRepository
     * @param ModelSeriesRepository $modelSeriesRepository
     * @param AssemblyGroupRepository $assemblyGroupRepository
     */
    public function __construct(ManufacturerRepository $manufacturerRepository,
                                ModelSeriesRepository $modelSeriesRepository,
                                AssemblyGroupRepository $assemblyGroupRepository)
    {
        $this->manufacturerRepository = $manufacturerRepository;
        $this->modelSeriesRepository = $modelSeriesRepository;

        View::share('sharedAssemblyGroups', $assemblyGroupRepository->getAssemblyGroupsAsTree());
    }
}
