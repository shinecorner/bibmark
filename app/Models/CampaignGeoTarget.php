<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CampaignGeoTarget extends Model
{
    protected $guarded = [];
    public function target()
    {
        return $this->morphTo();
    }
    public function details()
    {
        return $this->hasMany('App\Models\GeoTargetDetails','geo_target_id','id');
    }
}
