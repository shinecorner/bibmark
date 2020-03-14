<?php

namespace App\Http\Controllers;

use App\Http\Requests\Charity\CreateOrUpdateCampaignRequest;
use App\Http\Resources\CharityCampaignResource;
use App\Models\Charity;
use App\Models\CharityCampaign;
use App\Services\CharityCampaignService;
use App\Services\ExtraService;
use App\Services\CharityService;
use Illuminate\Http\Response;

class CharityCampaignController extends Controller
{
    protected $service;
    protected $extraService;
    public function __construct(CharityCampaignService $campaignService, ExtraService $extraService)
    {
        $this->service = $campaignService;
        $this->extraService = $extraService;
    }

    /**
     * Display the CharityCampaign resource.
     *
     * @param $id
     * @return Response
     */
    public function index($id)
    {        
        $charity = Charity::find($id);
        $campaigns = $this->service->getByCharityId($id);
        
        return view('front.pages.charities.campaign.charity_campaign')->with([
            'campaigns' => $campaigns,
            'id' => $id,
            'charity' => $charity,
        ]);
    }

    public function list($id) {
        $charity = Charity::find($id);
        $campaigns = $this->service->getByCharityId($id);

        $result = ['campaigns' => $campaigns, 'id' => $id, 'charity' => $charity];
        return response()->json($result, 200);
    }

    public function create($id)
    {
        $charity = Charity::find($id);
        return view('front.pages.charities.campaign.add-charity-campaign')->with([
            'id' => $id,
            'charity' => $charity,
            'geoTargetDetails' => []
        ]);
    }

    public function edit($id, $campaignId)
    {
        $charity = Charity::find($id);
        $campaign = CharityCampaign::find($campaignId);
        $geo_target_details = $campaign->listGeoTargets();        
        return view('front.pages.charities.campaign.edit-charity-campaign')->with([
            'id' => $id,
            'campaignId' => $campaignId,
            'charity' => $charity,
            'campaign' => $campaign,
            'geoTargetDetails' => $geo_target_details
        ]);
    }

    public function createOrUpdate(CreateOrUpdateCampaignRequest $request, CharityCampaignService $campaignService){                
        if (!empty($request['logo_url']) && !is_string($request['logo_url'])) {
            $request['logo'] = $this->extraService->uploadImage(
                [
                    'image' => $request['logo_url'],
                    'type' => 'campaign'
                ]
            );
        }        
        $result = new CharityCampaignResource($this->service->createOrUpdate($request->all()));
        return response()->json($result, 200);
    }

    public function destroy($id) 
    {
        $campaign = CharityCampaign::find($id);
        if($campaign) {
            $result = $campaign->delete();
        } else {
            $result = 0;
        }
        return response()->json($result, 200);
    }

    private function getCampaigns($id) {

    }
}
