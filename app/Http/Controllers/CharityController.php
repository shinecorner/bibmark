<?php

namespace App\Http\Controllers;

use App\Http\Resources\CharityResource;
use App\Models\Charity;
use App\Services\CharityService;
use Illuminate\Http\Request;

class CharityController extends Controller
{
    protected $service;

    public function __construct(CharityService $charityService)
    {
        $this->service = $charityService;
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

    /**
     * Update charity data
     * @param Request $request
     * @param $id
     * @param CharityService $charityService
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id, CharityService $charityService)
    {
        $result = new CharityResource($charityService->createOrUpdateCharity($request->all()));

        $charity = Charity::find($id);
        $logo= $request['logo'] ? $this->service->uploadImage($request['logo'], 'profile') : $charity->logo;

        $charity->update([
            'logo' => $logo,
        ]);

        return response()->json(['charity' => $charity], 200);
    }
}
