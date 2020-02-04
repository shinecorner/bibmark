<?php

namespace App\Http\Requests\Sponsor;

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
            'id' => 'sometimes|integer|exists:campaigns',
            'name' => 'required|string',
            'budget' => 'sometimes|numeric',
            'logo' => 'sometimes|url|nullable',
            'sponsor_id' => 'required|integer',
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
