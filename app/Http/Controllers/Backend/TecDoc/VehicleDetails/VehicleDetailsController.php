<?php

namespace App\Http\Controllers\Backend\TecDoc\VehicleDetails;

use App\Http\Controllers\Controller;
use App\Models\TecDoc\Vehicle;
use App\Models\TecDoc\VehicleDetails;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class VehicleDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        return view('backend.tecdoc-vehicle-details.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\TecDoc\VehicleDetails $vehicleDetails
     * @return \Illuminate\Http\Response
     */
    public function show(VehicleDetails $vehicleDetails)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\TecDoc\VehicleDetails $vehicleDetails
     * @return \Illuminate\Http\Response
     */
    public function edit(VehicleDetails $vehicleDetails)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\TecDoc\VehicleDetails $vehicleDetails
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, VehicleDetails $vehicleDetails)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\TecDoc\VehicleDetails $vehicleDetails
     * @return \Illuminate\Http\Response
     */
    public function destroy(VehicleDetails $vehicleDetails)
    {
        //
    }

    /**
     * @return RedirectResponse
     */
    public function sync()
    {
        ini_set('max_execution_time', 0);

        VehicleDetails::truncate();

        $vehicleIds = Vehicle::orderBy('carId')->skip(0)->take(1000)->get()->pluck('carId')->toArray();

        foreach (array_chunk($vehicleIds, 24) as $vehicleIdsChunk) {
            Artisan::call('tecdoc:vehicle-details', [
                'vehicleIds' => $vehicleIdsChunk
            ]);

            $output = Artisan::output();
            $output = json_decode($output, true);

            if (!$this->hasSuccessResponse($output)) {
                \Log::alert('FAIL RESPONSE!');
                continue;
            }

            $output = $this->getResponseDataAsArray($output);

            if (empty($output)) {
                \Log::alert('EMPTY RESPONSE!');
                continue;
            }

            foreach ($output as &$vehicle) {
                if (!isset($vehicle['vehicleDetails'])) {
                    \Log::alert('INVALID FORMAT RESPONSE!');
                    continue;
                }

                $vehicle['vehicleDetails']['vehicleDocId'] = isset($vehicle['vehicleDocId']) ? $vehicle['vehicleDocId'] : null;

                unset($vehicle['vehicleDetails']['rmiTypeId']);

                VehicleDetails::create($vehicle['vehicleDetails']);
            }

            \Log::info('VEHICLE DETAILS FOR IDS [' . implode(",", $vehicleIdsChunk) . '] CREATED!');
        }

        return redirect()->back();
    }
}
