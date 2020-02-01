<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SponsorResource extends JsonResource
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
            'hashtags' => $this->hashtags,
            'logo' => $this->logo,
            'background_image' => $this->background_image,
            'bio' => $this->bio,
            'website' => $this->website,
            'instagram' => $this->instagram,
            'facebook' => $this->facebook,
            'twitter' => $this->twitter,
            'company_address' => $this->company_address,
            'city' => $this->city,
            'state' => $this->state,
            'zip' => $this->zip,
            'country' => $this->country,
            'company_phone' => $this->company_phone,
            'email' => $this->email,
            'balance' => number_format($this->balance, 2),
            'budget' => number_format($this->budget, 2),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
