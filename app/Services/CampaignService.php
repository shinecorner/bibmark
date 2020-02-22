<?php


namespace App\Services;


use App\Models\Campaign;

class CampaignService
{
    /**
     * Get all sponsors
     *
     * @return array
     */
    public function getAll()
    {
        return Campaign::all();
    }

    public function getBySponsorId($id){
        return Campaign::where('sponsor_id', $id)->get();
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
            'budget' => isset($data['budget']) ? floatval($data['budget']) : 0,
            'status' => $data['status'],
            'sponsor_id' => $data['sponsor_id'],
        ];
        if (isset($data['id'])) {
            $campaign = Campaign::find($data['id']);
            if ($campaign->update($values)) {
                if(isset($data['geo_targets']) && !empty($data['geo_targets'])){
                    $campaign->geoTargets()->delete();
                    $this->syncGeoTarget($campaign, $data['geo_targets']);
                }
                return $campaign;
            }
        } else {
            $campaign = Campaign::create($values);
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
