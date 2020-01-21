<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class AssetCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $collection = $this->collection->map(function($asset) {
            return [
                'id' => $asset->id,
                'name' => $asset->name,
                'filename' => $asset->filename,
                'type' => $asset->type,
                'rate' => number_format($asset->rate, 2),
                'cap' => number_format($asset->cap, 2),
                'cap_perc' => number_format($asset->cap_perc, 2),
                'assetable_id' => $asset->assetable_id,
                'created_at' => $asset->created_at,
                'updated_at' => $asset->updated_at,
            ];
        });

        return [
            'assets' => $collection
        ];
    }
}
