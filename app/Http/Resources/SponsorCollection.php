<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class SponsorCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $collection = $this->collection->map(function($sponsor) {
            return [
                'id' => $sponsor->id,
                'name' => $sponsor->name,
                'logo' => $sponsor->logo,
                'background_image' => $sponsor->background_image,
                'balance' => number_format($sponsor->balance, 2),
                'budget' => number_format($sponsor->budget, 2),
                'created_at' => $sponsor->created_at,
                'updated_at' => $sponsor->updated_at,
            ];
        });

        return [
            'sponsors' => $collection
        ];
    }
}
