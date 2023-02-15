<?php

namespace Modules\User\Http\Requests;

class DefaultUsersRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules()
    {
        return [];
    }
}
