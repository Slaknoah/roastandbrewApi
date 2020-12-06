<?php

namespace App\Http\Resources\Company;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class Company extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $result = [
            'id'                => $this->id,
            'name'              => $this->name,
            'slug'              => $this->slug,
            'header_image_url'  => $this->header_image_url,
            'logo_url'          => $this->logo_url,
            'roaster'           => $this->roaster,
            'subscription'      => $this->subscription,
            'description'       => $this->description,
            'website'           => $this->website,
            'country'           => $this->country,
            'address'           => $this->address,
            'city'              => $this->city,
            'state'             => $this->state,
            'zip'               => $this->zip,
            'facebook_url'      => $this->facebook_url,
            'twitter_url'       => $this->twitter_url,
            'instagram_url'     => $this->instagram_url,
            'added_by'          => $this->added_by,
            'cafes_count'       => $this->cafes()->count(),
            'likes_count'       => $this->likes()->count(),
            'liked'             => 0
        ];

        if ( Auth::guard('sanctum')->check() && $this->likes->contains( Auth::guard('sanctum')->user()->id ) ) {
            $result['liked'] = 1;
        }

        return $result;
    }
}
