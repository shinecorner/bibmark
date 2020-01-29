<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use App\Models\Sponsor;
use App\Enums\ChargeStatus;
use App;
use App\Services\ExtraService;


class SponsorService
{
    /**
     * Get all sponsors
     *
     * @return array
     */
    public function getAllSponsors()
    {
        return Sponsor::all();
    }

    /**
     * Get sponsor by id
     *
     * @param integer $id
     * @return App\Models\Sponsor
     */
    public function getSponsorById($id)
    {
        return Sponsor::find($id);
    }

    /**
     * Create or Update an sponsor
     *
     * @param array $data
     * @return App\Models\Sponsor
     */
    public function createOrUpdateSponsor($data)
    {
        $user = Auth::user();
        if ($user->isSuperAdmin()) {
            $values = [
                'name' => $data['name'],
                'logo' => $data['logo'],
                'background_image' => $data['background_image'],
                'balance' => isset($data['balance']) ? floatval($data['balance']) : 0,
                'budget' => isset($data['budget']) ? floatval($data['budget']) : 0,
            ];
            if (isset($data['id'])) {
                $sponsor = Sponsor::find($data['id']);
                if ($sponsor->update($values)) {
                    return $sponsor;
                }
            } else {
                $sponsor = Sponsor::create($values);
                return $sponsor;
            }
        } else {
            $values = [
                'name' => $data['name'],
                'logo' => $data['logo'],
                'background_image' => $data['background_image'],
                'balance' => isset($data['balance']) ? floatval($data['balance']) : 0,
                'budget' => isset($data['budget']) ? floatval($data['budget']) : 0,
            ];
            if (isset($data['id'])) {
                $sponsor = Sponsor::find($data['id']);
                if ($user->sponsors->contains($sponsor->id)){
                    if ($sponsor->update($values)) {
                        return $sponsor;
                    }
                }
                else return $sponsor;
            } else {
                $sponsor = Sponsor::create($values);
                $user->sponsors()->attach($sponsor->id);

                return $sponsor;
            }
        }

        return null;
    }

    /**
     * Delete an sponsor
     *
     * @param integer sponsorId
     * @return boolean
     */
    public function deleteSponsor($sponsorId)
    {
        $user = Auth::user();
        if ($user->isSuperAdmin()) {
            $sponsor = Sponsor::find($sponsorId);
            $sponsor->users()->detach();
            $sponsor->delete();
        }

        return false;
    }

    public function uploadImage($image, $type = "sponsor")
    {
        return resolve(ExtraService::class)->uploadImage([
            'image' => $image,
            'type' => $type
        ]);
    }

    /**
     * Charge sponsors
     *
     * @return void
     */
    public function chargeSponsors()
    {
        $sponsors = Sponsor::where('balance', '<', 'budget')
                           ->where('balance', '>', 0)
                           ->where('budget', '>', 0)
                           ->get();
        foreach ($sponsors as $sponsor) {
            $billing = $sponsor->defaultCard();
            if ($billing) {
                $charge = Charge::create([
                    'order_id' => 0,
                    'amount' => $sponsor->budget - $sponsor->balance,
                    'name' => $billing->name,
                    'address' => $billing->address,
                    'city' => $billing->city,
                    'state' => $billing->state,
                    'country' => $billing->country,
                    'zip' => $billing->zip,
                    'stripe_id' => $billing->stripe_id,
                    'card_brand' => $billing->card_brand,
                    'card_last_four' => $billing->card_last_four,
                    'status' => ChargeStatus::NotYet
                ]);
                $charge->charge($billing);
            }
        }
    }
}
