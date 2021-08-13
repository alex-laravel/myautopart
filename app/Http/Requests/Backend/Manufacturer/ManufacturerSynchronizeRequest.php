<?php

namespace App\Http\Requests\Backend\Manufacturer;

use App\Models\TecDoc\Manufacturer\Manufacturer;
use Illuminate\Foundation\Http\FormRequest;

class ManufacturerSynchronizeRequest extends FormRequest
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
            'country' => 'required_without:countryGroup|nullable|string|exists:td_countries,countryCode',
            'countryGroup' => 'required_without:country|nullable|string|exists:td_country_groups,tecdocCode',
            'manufacturers' => 'required|array',
            'manufacturers.*' => 'required|string|in:' . implode(",", Manufacturer::$allowedTargetTypes),
        ];
    }
}
