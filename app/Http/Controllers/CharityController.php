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
        ]);;
    }

    /**
     * Get all of the order gallery for the charity.
     *
     * @return \Illuminate\Http\Response
     */
    public function getOrders(Request $request, Charity $charity)
    {
        return view('front.charities.orders.index', [
            'charity' => $charity
        ]);;
    }
}
