<?php

namespace App\Http\Resources\Cafe;

use Illuminate\Http\Resources\Json\JsonResource;

class Cafe extends JsonResource
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
            'id'                => $this->id,
            'location_name'     => $this->location_name,
            'slug'              => $this->slug,
            'description'       => $this->description,
            'address'           => $this->address,
            'city'              => $this->city,
            'state'             => $this->state,
            'zip'               => $this->zip,
            'country'           => $this->country,
            'tea'               => $this->tea,
            'matcha'            => $this->matcha,
            'primary_image_url' => $this->primary_image_url,
            'company'           => $this->company,
        ];
    }
}
