<?php


namespace App\Http\Controllers\Api;


use App\Repositories\Frontend\TecDoc\ManufacturerRepository;

abstract class ApiBaseController
{
    /**
     * @var ManufacturerRepository
     */
    protected $manufacturerRepository;

    /**
     * @param ManufacturerRepository $manufacturerRepository
     */
    public function __construct(ManufacturerRepository $manufacturerRepository)
    {
        $this->manufacturerRepository = $manufacturerRepository;
    }
}
