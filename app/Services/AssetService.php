<?php

namespace App\Services;

use App\Models\AssetSize;
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
        $assetableTypes = [1 => 'Charity',2 => 'Sponsor'];
        $assetableId = isset($data['assetable_id']) ? intval($data['assetable_id']) : 1;
        if ($user->isSuperAdmin()) {
            $values = [
                'name' => $data['name'],
                'filename' => $data['filename'],
                'type' => $data['type'],
                'rate' => isset($data['rate']) ? floatval($data['rate']) : 0,
                'cap' => isset($data['cap']) ? floatval($data['cap']) : 0,
                'cap_perc' => isset($data['cap_perc']) ? floatval($data['cap_perc']) : 0,
                'assetable_id' => $assetableId,
                'assetable_type' => $assetableTypes[$assetableId],
            ];
            if (isset($data['id'])) {
                $asset = Asset::find($data['id']);
                if ($asset->update($values)) {
                    $assetSizes = $asset->sizes;
                    if(isset($data['fileurls'])) {
                        foreach ($data['fileurls'] as $key => $file) {
                            if ($key) {
                                $assetSize=AssetSize::find($assetSizes[$key-1]->id);
                                $assetSize->update(['size' => $file['sizes']['width'] . 'X' . $file['sizes']['height']]);
                            }
                        }
                    }
                    return $asset;
                }
            } else {
                $asset = Asset::create($values);
                foreach ($data['fileurls'] as $key => $file) {
                    if ($key) {
                        $assetSize = new AssetSize();
                        $assetSize->asset_id = $asset->id;
                        $assetSize->size = $file['sizes']['width'] . 'X' . $file['sizes']['height'];
                        $assetSize->amount = 1;
                        $assetSize->save();
                    }
                }
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
                'assetable_id' => $assetableId,
                'assetable_type' => $assetableTypes[$assetableId],
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
