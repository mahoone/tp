<?php

namespace App\Http\Resources;

class IndexUsersResource extends BaseResource
{
    public function toArray($request)
    {
        dd($this->first_name);
        return [
            'id' => $this->id,
            'firstName' => $this->first_name,
            'surname' => $this->surname,
            'email' => $this->email,
            'createdAt' => $this->created_at,
            'updatedAt' => $this->updated_at,
        ];
    }
}
