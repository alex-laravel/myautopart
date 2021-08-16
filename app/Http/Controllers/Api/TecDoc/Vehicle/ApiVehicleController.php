<?php


namespace App\Http\Controllers\Api\TecDoc\Vehicle;


use App\Http\Controllers\Api\ApiBaseController;
use App\Http\Responses\Api\V1\Response;
use App\Models\TecDoc\Vehicle;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;

class ApiVehicleController extends ApiBaseController
{
    /**
     * @param integer $modelId
     * @return JsonResponse
     */
    public function index($modelId)
    {
        if (!request()->ajax()) {
            abort(404);
        }

        $vehicles = Vehicle::where('modelId', (int)$modelId)->orderBy('carName')->get();

        return Response::success($this->prepareVehiclesResponse($vehicles));
    }

    /**
     * @param Collection $vehicles
     * @return array
     */
    private function prepareVehiclesResponse($vehicles)
    {
        $response = [];

        foreach ($vehicles as $vehicle) {
            $response[] = [
                'id' => $vehicle->carId,
                'name' => $vehicle->carName
            ];
        }

        return $response;
    }
}
