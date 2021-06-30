<?php

namespace App\Http\Controllers\Backend\TecDoc\ShortCut;

use App\Http\Controllers\Controller;
use App\Repositories\Backend\TecDoc\ShortCutRepository;

class ShortCutAjaxController extends Controller
{
    /**
     * @var ShortCutRepository
     */
    protected $shortCutRepository;

    /**
     * @param ShortCutRepository $shortCutRepository
     */
    public function __construct(ShortCutRepository $shortCutRepository)
    {
        $this->shortCutRepository = $shortCutRepository;
    }

    /**
     * @return array
     * @throws \Exception
     */
    public function get()
    {
        return datatables()->of($this->shortCutRepository->getData())->make(true);
    }
}
