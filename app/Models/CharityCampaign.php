<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Enums\MorphType;

class CharityCampaign extends Model
{
    use SoftDeletes;
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $table = "charity_campaign";
    protected $guarded = [];
    public function geoTargets()
    {
        return $this->morphMany(MorphType::GeoTarget, 'target');
    }
    public function listGeoTargets(){
        $geo_target_details = [];        
        $targets = $this->geoTargets()->get();
        foreach($targets as $target){            
            $info = [];            
            $info['name'] = $target->name;
            $info['status'] = boolval($target->status);
            $info['zipcodes'] = [];
            foreach($target->details()->get() as $i => $detail){
                $info['zipcodes'][$i]['zipcode'] = $detail->zipcode;
                $info['zipcodes'][$i]['radius'] = $detail->radius;
            }
            $geo_target_details[] = $info;
        }          
        return $geo_target_details;
    }    
}
