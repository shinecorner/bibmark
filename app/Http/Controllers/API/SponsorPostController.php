<?php

namespace App\Http\Controllers\API;

use App\Models\Sponsor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SponsorPostController extends Controller
{
    /**
     * Get all posts from social network.
     *
     * @param Sponsor $sponsor
     * @param string network
     * @return Response
     */
    public function index(Sponsor $sponsor, string $network)
    {
        dd($sponsor, $network);
    }
}