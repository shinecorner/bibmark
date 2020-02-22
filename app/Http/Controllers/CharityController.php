<?php

namespace App\Http\Controllers;

use App\Models\Charity;
use Illuminate\Http\Request;

class CharityController extends Controller
{
    /**
     * Get all of the donations for the charity.
     *
     * @return \Illuminate\Http\Response
     */
    public function getDonations(Request $request, Charity $charity)
    {
        return view('front.charities.donations.index', [
            'charity' => $charity
        ]);
    }

    /**
     * Get all of the order gallery for the charity.
     *
     * @param Charity $charity
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getOrders(Charity $charity)
    {
        return view('front.charities.orders.index', [
            'charity' => $charity
        ]);
    }

    public function show($charity_id) {
        $charity = Charity::find((int) $charity_id);
        return view('front.edit-charity', [
            'charity' => $charity,
            'id' => $charity_id
        ]);
    }
}
