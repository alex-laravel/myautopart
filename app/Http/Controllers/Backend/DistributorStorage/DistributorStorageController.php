<?php

namespace App\Http\Controllers\Backend\DistributorStorage;

use App\Http\Controllers\Controller;
use App\Models\Distributor\Distributor;
use App\Models\DistributorStorage\DistributorStorage;
use App\Repositories\Backend\DistributorStorages\DistributorStoragesRepository;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class DistributorStorageController extends Controller
{
    /**
     * @var DistributorStoragesRepository
     */
    protected $distributorStoragesRepository;

    /**
     * @param DistributorStoragesRepository $distributorStoragesRepository
     */
    public function __construct(DistributorStoragesRepository $distributorStoragesRepository)
    {
        $this->distributorStoragesRepository = $distributorStoragesRepository;
    }

    /**
     * @return View
     */
    public function index()
    {
        return view('backend.distributor-storages.index');
    }

    /**
     * @return View
     */
    public function create()
    {
        return view('backend.distributor-storages.create', [
            'distributorsList' => $this->prepareDistributorsList(),
            'deliveryDaysList' => $this->prepareDeliveryDaysList(),
        ]);
    }

    /**
     * @param Request $request
     * @return View
     */
    public function store(Request $request)
    {
        $this->distributorStoragesRepository->create($request->only([
            'distributor_id',
            'title',
            'description',
            'delivery_days',
            'import_sequence_number',
        ]));

        return view('backend.distributor-storages.index')->withFlashSuccess(trans('alerts.backend.distributor-storages.created'));
    }

    /**
     * @param DistributorStorage $distributorStorage
     * @return View
     */
    public function show(DistributorStorage $distributorStorage)
    {
        return view('backend.distributor-storages.show', [
            'distributorStorage' => $distributorStorage
        ]);
    }

    /**
     * @param DistributorStorage $distributorStorage
     * @return View
     */
    public function edit(DistributorStorage $distributorStorage)
    {
        return view('backend.distributor-storages.edit', [
            'distributorStorage' => $distributorStorage,
            'distributorsList' => $this->prepareDistributorsList(),
            'deliveryDaysList' => $this->prepareDeliveryDaysList(),
        ]);
    }

    /**
     * @param Request $request
     * @param DistributorStorage $distributorStorage
     * @return View
     */
    public function update(Request $request, DistributorStorage $distributorStorage)
    {
        $this->distributorStoragesRepository->update($distributorStorage, $request->only([
            'distributor_id',
            'title',
            'description',
            'delivery_days',
            'import_sequence_number',
        ]));

        return view('backend.distributor-storages.index')->withFlashSuccess(trans('alerts.backend.distributor-storages.updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DistributorStorage $distributorStorage
     * @return Response
     */
    public function destroy(DistributorStorage $distributorStorage)
    {
        //
    }

    /**
     * @return array
     */
    private function prepareDistributorsList()
    {
        $distributors = Distributor::pluck('title', 'id')->toArray();
        $distributors[0] = ' - Select One - ';

        asort($distributors);

        return $distributors;
    }

    /**
     * @return array
     */
    private function prepareDeliveryDaysList()
    {
        $deliveryDays[0] = 'Today';
        $deliveryDays[1] = '1';
        $deliveryDays[2] = '2';
        $deliveryDays[3] = '3';
        $deliveryDays[4] = '4';
        $deliveryDays[5] = '5';
        $deliveryDays[6] = '6';
        $deliveryDays[7] = '7';

        return $deliveryDays;
    }
}
