<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UsersResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'email_verified_at' => $this->email_verified_at,
            'password' => $this->password,
            'role' => $this->role,
            'remember_token' => $this->remember_token,
            'active' => $this->active,
            'stoken' => $this->stoken,
            'nick' => $this->nick,
            'bank_name' => $this->bank_name,
            'bank_code' => $this->bank_code,
            'bank_number' => $this->bank_number,
            'bank_account' => $this->bank_account,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'deleted_at' => $this->deleted_at
        ];
    }
}
