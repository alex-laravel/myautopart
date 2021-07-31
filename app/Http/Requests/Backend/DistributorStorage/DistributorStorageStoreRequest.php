<?php

namespace App\Http\Requests\Backend\DistributorStorage;

use Illuminate\Foundation\Http\FormRequest;

class DistributorStorageStoreRequest extends FormRequest
{
    /**
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * @return array
     */
    public function rules()
    {
        return [
            'distributor_id' => 'required|integer|exists:sh_distributors,id',
            'title' => 'required|string|min:3|max:255|unique:sh_distributor_storages,title',
            'description' => 'nullable|string|min:3|max:455',
            'delivery_days' => 'nullable|integer|min:0',
            'import_sequence_number' => 'required|integer|min:1',
        ];
    }
}
