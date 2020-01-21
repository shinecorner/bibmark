<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth; 
use App\Models\Asset;

class AssetService
{
    /**
     * Get all assets
     * 
     * @return array
     */
    public function getAllAssets()
    {
        return Asset::all();
    }

    /**
     * Get asset by id
     *
     * @param integer $id
     * @return App\Models\Asset
     */
    public function getAssetById($id)
    {
        return Asset::find($id);
    }

    /**
     * Create or Update a asset
     * 
     * @param array $data
     * @return App\Models\Asset 
     */
    public function createOrUpdateAsset($data)
    {
        $user = Auth::user();
        if ($user->isSuperAdmin()) {
            $values = [
                'name' => $data['name'],
                'filename' => $data['filename'],
                'type' => $data['type'],
                'rate' => isset($data['rate']) ? floatval($data['rate']) : 0,
                'cap' => isset($data['cap']) ? floatval($data['cap']) : 0,
                'cap_perc' => isset($data['cap_perc']) ? floatval($data['cap_perc']) : 0,
                'assetable_id' => isset($data['assetable_id']) ? intval($data['assetable_id']) : 1,
                'assetable_type' => $data['assetable_type'],
            ];
            if (isset($data['id'])) {
                $asset = Asset::find($data['id']);
                if ($asset->update($values)) {
                    return $asset;
                }
            } else {
                $asset = Asset::create($values);
                return $asset;
            }
        } else {
            $values = [
                'name' => $data['name'],
                'filename' => $data['filename'],
                'type' => $data['type'],
                'rate' => isset($data['rate']) ? floatval($data['rate']) : 0,
                'cap' => isset($data['cap']) ? floatval($data['cap']) : 0,
                'cap_perc' => isset($data['cap_perc']) ? floatval($data['cap_perc']) : 0,
                'assetable_id' => isset($data['assetable_id']) ? intval($data['assetable_id']) : 1,
                'assetable_type' => $data['assetable_type'],
            ];
            if (isset($data['id'])) {
                $asset = Asset::find($data['id']);
                if ($user->assets->contains($asset->id)){
                    if ($asset->update($values)) {
                        return $asset;
                    }
                }
                else return $asset;
            } else {
                $asset = Asset::create($values);
                $user->assets()->attach($asset->id);

                return $asset;
            }
        }

        return null;
    }

    /**
     * Delete a asset
     * 
     * @param integer charityId
     * @return boolean
     */
    public function deleteAsset($assetId)
    {
        $user = Auth::user();
        if ($user->isSuperAdmin()) {
            $asset = Asset::find($assetId);
            // $asset->users()->detach();
            $asset->delete();
        }

        return false;
    }
}
