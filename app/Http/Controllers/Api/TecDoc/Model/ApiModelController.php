<?php


namespace App\Http\Controllers\Api\TecDoc\Model;


use App\Http\Controllers\Api\ApiBaseController;
use App\Http\Responses\Api\V1\Response;
use App\Models\TecDoc\ModelSeries;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;

class ApiModelController extends ApiBaseController
{
    /**
     * @param integer $manufacturerId
     * @return JsonResponse
     */
    public function index($manufacturerId)
    {
        if (!request()->ajax()) {
            abort(404);
        }

        $models = ModelSeries::where('manuId', (int)$manufacturerId)->orderBy('modelname')->get();

        return Response::success($this->prepareModelsResponse($models));
    }

    /**
     * @param Collection $models
     * @return array
     */
    private function prepareModelsResponse($models)
    {
        $response = [];

        foreach ($models as $model) {
            $response[] = [
                'id' => $model->modelId,
                'name' => $model->modelname
            ];
        }

        return $response;
    }
}
