<?php

namespace App\Http\Requests\Charity;

use App\Http\Requests\Request;

class CreateOrUpdateCampaignRequest extends Request
{
    /**
     *  Validation rules to be applied to the input.
     *
     *  @return void
     */
    public function rules()
    {
        return [
            'id' => 'sometimes|integer|exists:charity_campaign',
            'name' => 'required|string',
            'budget' => 'sometimes|numeric',
            'logo' => 'sometimes|url|nullable',            
            'logo_width' => 'sometimes|numeric|nullable',
            'charity_id' => 'required|integer',
            'geo_targets' => 'sometimes|nullable',
            'status' => 'required|boolean',
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
            'logo' => 'trim|escape',
        ];
    }
}
