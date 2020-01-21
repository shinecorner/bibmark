<?php

namespace App\Http\Requests\Asset;

use App\Http\Requests\Request;
use Waavi\Sanitizer\Laravel\SanitizesInput;

class CreateOrUpdateAssetRequest extends Request
{
    /**
     *  Validation rules to be applied to the input.
     *
     *  @return void
     */
    public function rules()
    {
        return [
            'id' => 'sometimes|integer',
            'name' => 'required|string',
            'filename' => 'required|string',
            'type' => 'sometimes|string',
            'rate' => 'sometimes|numeric',
            'cap' => 'sometimes|nullable',
            'cap_perc' => 'sometimes|numeric',
            'assetable_id' => 'sometimes',
            'assetable_type' => 'sometimes|string|nullable',
            
        ];
    }

    /**
     *  Filters to be applied to the input.
     *
     *  @return void
     */
    public function filters()
    {
        return [
            'name' => 'trim',
            'filename' => 'trim|escape',
            'type' => 'trim|escape'
        ];
    }
}
