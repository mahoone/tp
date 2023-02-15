<?php

namespace Modules\User\Http\Requests;

class UpdateUserRequest extends BaseRequest
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
                'unique:users,email,' . $this->user->id
            ],
            'admin' => [
                'nullable',
                'string'
            ],
            'password' => [
                'sometimes',
                'nullable',
                'confirmed',
                'min:6'
            ]
        ];
    }
}
