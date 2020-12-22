<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class MovieUserResource extends JsonResource
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
            'attributes' => [
                'discount' => $this->discount,
                'date' => $this->date,
                'time' => $this->time,
                'url' => $this->url,
                'user_id' => $this->user_id,
                'movie_id' => $this->movie_id,
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at,
            ],
            'relationships' => [
                'user' => new UserResource($this->user),
                'movie' => new MovieResource($this->movie)
            ],
            'links' => [
                'self' => ''
            ]
        ];
    }
}
