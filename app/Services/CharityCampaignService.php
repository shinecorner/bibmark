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
            'charity_id' => $data['charity_id'],
        ];
        if (isset($data['id'])) {
            $campaign = CharityCampaign::find($data['id']);
            if ($campaign->update($values)) {
                return $campaign;
            }
        } else {
            $campaign = CharityCampaign::create($values);
            return $campaign;
        }
        return null;
    }

}
