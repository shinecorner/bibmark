<?php

namespace App\Http\Controllers;

use App\Models\Charity;
use Illuminate\Http\Request;
use App\Services\{TwitterService, InstagramService};

class CharityController extends Controller
{
    const NETWORKS = [
        'instagram',
        'twitter'
    ];

    public function __construct (InstagramService $instagramService, TwitterService $twitterService)
    {
        $this->instagramService = $instagramService;
        $this->twitterService = $twitterService;
    }

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

    /**
     * Show charity page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Charity $charity)
    {
        return view('front.index-charity', [
            'charity' => $charity,
        ]);
    }

    /**
     * Get all posts from social network.
     *
     * @param Charity $charity
     * @param string network
     * @return Response
     */
    public function getPosts(Charity $charity, string $network)
    {
        $network = strtolower($network);

        if (in_array($network, self::NETWORKS)) {
            $tags = explode(',', $charity->hashtags);

            return $this->makeRequest($tags, $network);
        }

        return response()->json([], 200);
    }

    /**
     * Perform request
     *
     * @param array $tags
     * @param string network
     * @return array
     */
    public function makeRequest(array $tags = ['bibmark'], $network)
    {
        $service = $network. 'Service';

        return $this->{$service}->getPosts($tags);
    }
}
