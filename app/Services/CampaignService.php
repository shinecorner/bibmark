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
                return $campaign;
            }
        } else {
            $campaign = Campaign::create($values);
            return $campaign;
        }
        return null;
    }

}
