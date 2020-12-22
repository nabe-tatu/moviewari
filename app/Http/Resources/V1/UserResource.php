<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
//    /**
//     * Transform the resource into an array.
//     *
//     * @param  \Illuminate\Http\Request  $request
//     * @return array
//     */
//    public function toArray($request)
//    {
//        return parent::toArray($request);
//    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        //info($this->id);
        return [
            'id' => $this->id,
            'attributes' => [
                'name' => $this->name,
                'email' => $this->email,
                'password' => $this->password,
                'admin' => $this->admin,
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at,
            ],
            'relationships' => [],
            'links' => [
                'self' => ''
            ]
        ];
    }
}
