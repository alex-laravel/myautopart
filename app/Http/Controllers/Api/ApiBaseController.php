<?php


namespace App\Http\Controllers\Api;


use App\Repositories\Frontend\TecDoc\ManufacturerRepository;
use App\Repositories\Frontend\TecDoc\ModelSeriesRepository;

abstract class ApiBaseController
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
     */
    public function __construct(ManufacturerRepository $manufacturerRepository, ModelSeriesRepository $modelSeriesRepository)
    {
        $this->manufacturerRepository = $manufacturerRepository;
        $this->modelSeriesRepository = $modelSeriesRepository;
    }
}
