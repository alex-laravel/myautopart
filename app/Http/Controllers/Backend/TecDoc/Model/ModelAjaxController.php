<?php


namespace App\Http\Controllers\Backend\TecDoc\Model;


use App\Http\Controllers\Controller;
use App\Repositories\Backend\TecDoc\ModelRepository;

class ModelAjaxController extends Controller
{
    /**
     * @var ModelRepository
     */
    protected $modelRepository;

    /**
     * @param ModelRepository $modelRepository
     */
    public function __construct(ModelRepository $modelRepository)
    {
        $this->modelRepository = $modelRepository;
    }

    /**
     * @return array
     * @throws \Exception
     */
    public function get()
    {
        return datatables()->of($this->modelRepository->getData())->make(true);
    }
}
