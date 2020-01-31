<?php

namespace App\Http\Controllers;

use App\Models\Sponsor;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CampaignController extends Controller
{
    /**
     * Display the Campaign resource.
     *
     * @param $id
     * @return Response
     */
    public function list($id)
    {
        $sponsor = Sponsor::find($id);

        return view('front.campaign')->with([
            'campaigns' => [
                '0' => [
                    'name' => 'Holiday Starbucks',
                    'logo' => 'https://upload.wikimedia.org/wikipedia/en/thumb/d/d3/Starbucks_Corporation_Logo_2011.svg/1200px-Starbucks_Corporation_Logo_2011.svg.png',
                    'budget' => '$350,000',
                    'status' => 'Active',
                ],
                '1' => [
                    'name' => 'Starbucks',
                    'logo' => 'https://upload.wikimedia.org/wikipedia/en/thumb/d/d3/Starbucks_Corporation_Logo_2011.svg/1200px-Starbucks_Corporation_Logo_2011.svg.png',
                    'budget' => '$175,000',
                    'status' => 'InActive',
                ],
            ],
            'id' => $id,
            'sponsor' => $sponsor,
        ]);
    }
}
