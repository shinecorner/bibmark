<?php

namespace App\Http\Controllers;

use App\Http\Resources\CharityResource;
use App\Models\Charity;
use App\Services\CharityService;
use App\Services\SlugService;
use Illuminate\Http\Request;

class CharityController extends Controller
{
    protected $charityService;

    protected $slugService;

    public function __construct(CharityService $charityService, SlugService $slugService)
    {
        $this->charityService = $charityService;
        $this->slugService = $slugService;
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
            'id' => $charity_id,
            'slug' => $charity->slug()->first() ? $charity->slug->slug : ''
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

        /** @var \App\Models\Charity $charity */
        $charity = Charity::find($id);

        // Update charity logo
        $logo = $request['logo'] ? $this->charityService->uploadImage($request['logo'], 'profile') : $charity->logo;
        $charity->update([
            'logo' => $logo,
        ]);

        $result = ['charity' => $charity];

        //Update charity slug
        if ($request->has('slug')) {
            $updateSlugResult = $this->slugService->createOrUpdateSlug([
                'slug' => $request->get('slug'),
                'slugable_type' => Charity::class,
                'slugable_id' => $charity->getAttribute('id')
            ]);
            if (!$updateSlugResult['result']) {
                $result["errors"] = $updateSlugResult["errors"];
            }
        }

        return response()->json($result, 200);
    }
}
