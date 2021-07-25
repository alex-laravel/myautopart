<?php

namespace App\Http\Controllers\Backend\Distributor;

use App\Http\Controllers\Controller;
use App\Models\Distributor\Distributor;
use App\Repositories\Backend\Distributors\DistributorsRepository;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class DistributorController extends Controller
{
    /**
     * @var DistributorsRepository
     */
    protected $distributorsRepository;

    /**
     * @param DistributorsRepository $distributorsRepository
     */
    public function __construct(DistributorsRepository $distributorsRepository)
    {
        $this->distributorsRepository = $distributorsRepository;
    }

    /**
     * @return View
     */
    public function index()
    {
        return view('backend.distributors.index');
    }

    /**
     * @return View
     */
    public function create()
    {
        return view('backend.distributors.create');
    }

    /**
     * @param Request $request
     * @return View
     */
    public function store(Request $request)
    {
        $this->distributorsRepository->create($request->only([
            'title',
            'description'
        ]));

        return view('backend.distributors.index')->withFlashSuccess(trans('alerts.backend.distributors.created'));
    }

    /**
     * @param Distributor $distributor
     * @return View
     */
    public function show(Distributor $distributor)
    {
        return view('backend.distributors.show', [
            'distributor' => $distributor
        ]);
    }

    /**
     * @param Distributor $distributor
     * @return View
     */
    public function edit(Distributor $distributor)
    {
        return view('backend.distributors.edit', [
            'distributor' => $distributor
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Distributor $distributor
     * @return Response
     */
    public function update(Request $request, Distributor $distributor)
    {
        $this->distributorsRepository->update($distributor, $request->only([
            'title',
            'description'
        ]));

        return view('backend.distributors.index')->withFlashSuccess(trans('alerts.backend.distributors.updated'));
    }

    /**
     * @param Distributor $distributor
     * @return Response
     */
    public function destroy(Distributor $distributor)
    {
        $this->distributorsRepository->delete($distributor);

        return back()->withFlashSuccess(trans('alerts.backend.distributors.deleted'));
    }
}
