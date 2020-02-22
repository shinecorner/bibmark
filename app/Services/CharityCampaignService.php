<?php


namespace App\Services;


use App\Models\CharityCampaign;

class CharityCampaignService
{
    /**
     * Get all sponsors
     *
     * @return array
     */
    public function getAll()
    {
        return CharityCampaign::all();
    }

    public function getByCharityId($id){
        return CharityCampaign::where('charity_id', $id)->get();
    }

    /**
     * Create or Update an sponsor
     *
     * @param array $data
     * @return Campaign
     */
    public function createOrUpdate($data)
    {
        $values = [
            'name' => $data['name'],
            'logo' => isset($data['logo']) ? $data['logo'] : '',
            'logo_width' => isset($data['logo_width']) ? $data['logo_width'] : '',
            'budget' => isset($data['budget']) ? floatval($data['budget']) : 0,
            'hashtags' => isset($data['hashtags']) ? $data['hashtags'] : '',
            'status' => $data['status'],
            'charity_id' => $data['charity_id']            
        ];
        if (isset($data['id'])) {
            $campaign = CharityCampaign::find($data['id']);
            if ($campaign->update($values)) {
                if(isset($data['geo_targets']) && !empty($data['geo_targets'])){
                    $campaign->geoTargets()->delete();
                    $this->syncGeoTarget($campaign, $data['geo_targets']);
                }
                return $campaign;
            }
        } else {
            $campaign = CharityCampaign::create($values);                
            if(isset($data['geo_targets']) && !empty($data['geo_targets'])){
                $this->syncGeoTarget($campaign, $data['geo_targets']);
            }
            return $campaign;
        }        
        return null;
    }
    public function syncGeoTarget(&$campaign, $data){           
        $input_targets = json_decode((string) $data, true);
        if(!empty($input_targets)){
            foreach($input_targets as $i_target){
                $geo_target = $campaign->geoTargets()->create(['name' => $i_target['name'], 'status' => boolval($i_target['status'])]);
                $geo_target->details()->createMany($i_target['zipcodes']);
            }                    
        }        
    }    
}
