<?php

namespace App\Http\Requests\User;

use App\Http\Requests\Request;
use Waavi\Sanitizer\Laravel\SanitizesInput;

class CreateOrUpdateUserUnderSponsorRequest extends Request
{
    /**
     *  Validation rules to be applied to the input.
     *
     *  @return void
     */
    public function rules()
    {
        return [
            'sponsor_id' => 'required|integer|exists:sponsors,id',
            'user_id' => 'sometimes|integer|exists:users,id',
            'role' => 'sometimes|integer',
            'name' => 'sometimes|string',
            'email' => 'sometimes|email'
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
            'email' => 'trim'
        ];
    }
}
