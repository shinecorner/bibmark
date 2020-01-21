<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AssetResource extends JsonResource
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
            'filename' => $this->filename,
            'type' => $this->type,
            'rate' => number_format($this->rate, 2),
            'cap' => number_format($this->cap, 2),
            'cap_perc' => number_format($this->cap_perc, 2),
            'assetable_id' => $this->assetable_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
