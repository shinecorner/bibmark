<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use App\Models\{ Billing };

class BillingService
{
    /**
     * Create a billing
     *
     * @param array $data
     * @return App\Models\Billing
     */
    public function createBilling($data)
    {
        $user = Auth::user();
        if ($user->isSuperAdmin() || $data['user_id'] == $user->id) {
            $billing = $user->cards()->create([
                'name' => $data['name'],
                'address' => $data['address'],
                'city' => $data['city'],
                'state' => $data['state'],
                'zip' => $data['zip'],
                'country' => $data['country']
            ]);
            $billing->createAsStripeCustomer($data['stripe_token']);

            return $billing;
        }

        return null;
    }

    /**
     * Get all billings belong to an sponsor
     *
     * @param integer $sponsorId
     * @return array
     */
    public function getBillingsWithSponsorId($sponsorId)
    {
        $sponsor = Sponsor::find($sponsorId);

        return $sponsor->cards;
    }

    /**
     * Get all billings belong to a user
     *
     * @param integer $userId
     * @return array
     */
    public function getBillingsWithUserId($userId)
    {
        $user = User::find($userId);

        return $user->cards;
    }
}
