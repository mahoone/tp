<?php

namespace Modules\User\Http\Requests;

use Illuminate\Validation\Rules;

class StoreUserRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules()
    {
        return [
            'first_name' => [
                'required',
                'string',
                'max:255'
            ],
            'surname' => [
                'required',
                'string',
                'max:255'
            ],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                'unique:users'
            ],
            'admin' => [
                'nullable',
                'string'
            ],
            'password' => [
                'required',
                'confirmed',
                Rules\Password::defaults()
            ]
        ];
    }
}
