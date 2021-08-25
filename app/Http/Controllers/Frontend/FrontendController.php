<?php


namespace App\Http\Controllers\Frontend;


use App\Http\Controllers\Controller;
use App\Repositories\Frontend\TecDoc\AssemblyGroupRepository;
use App\Repositories\Frontend\TecDoc\ManufacturerRepository;
use Illuminate\Support\Facades\View;

class FrontendController extends Controller
{
    /**
     * @var ManufacturerRepository
     */
    protected $manufacturerRepository;

    /**
     * @param ManufacturerRepository $manufacturerRepository
     * @param AssemblyGroupRepository $assemblyGroupRepository
     */
    public function __construct(ManufacturerRepository $manufacturerRepository, AssemblyGroupRepository $assemblyGroupRepository)
    {
        $this->manufacturerRepository = $manufacturerRepository;

        View::share('sharedAssemblyGroups', $assemblyGroupRepository->getAssemblyGroupsAsTree());
    }
}
