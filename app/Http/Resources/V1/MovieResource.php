<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class  MovieResource extends JsonResource
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
        return [
            'id' => $this->id,
            'attributes' => [
                'name' => $this->name,
                'picture' => $this->picture,
                'site_url' => $this->site_url,
                'category_id' => $this->category_id,
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at,
            ],
            'relationships' => [
                'category' => new CategoryResource($this->category),
            ],
            'links' => [
                'self' => ''
            ]
        ];
    }
}
