<?php

namespace App\Http\Controllers;

use App\Http\Requests\Sponsor\CreateOrUpdateCampaignRequest;
use App\Http\Resources\CampaignResource;
use App\Models\Sponsor;
use App\Models\Campaign;
use App\Services\CampaignService;
use App\Services\ExtraService;
use App\Services\SponsorService;
use Illuminate\Http\Response;

class CampaignController extends Controller
{
    protected $service;
    protected $extraService;
    public function __construct(CampaignService $campaignService, ExtraService $extraService)
    {
        $this->service = $campaignService;
        $this->extraService = $extraService;
    }

    /**
     * Display the Campaign resource.
     *
     * @param $id
     * @return Response
     */
    public function index($id)
    {
        $sponsor = Sponsor::find($id);
        $campaigns = $this->service->getBySponsorId($id);

        return view('front.pages.sponsor.campaign.campaign')->with([
            'campaigns' => $campaigns,
            'id' => $id,
            'sponsor' => $sponsor,
        ]);
    }

    public function list($id) {
        $sponsor = Sponsor::find($id);
        $campaigns = $this->service->getBySponsorId($id);

        $result = ['campaigns' => $campaigns, 'id' => $id, 'sponsor' => $sponsor];
        return response()->json($result, 200);
    }

    public function create($id)
    {
        $sponsor = Sponsor::find($id);
        return view('front.pages.sponsor.campaign.add-campaign')->with([
            'id' => $id,
            'sponsor' => $sponsor,
            'geoTargetDetails' => []
        ]);
    }

    public function edit($id, $campaignId)
    {
        $sponsor = Sponsor::find($id);
        $campaign = Campaign::find($campaignId);
        $geo_target_details = $campaign->listGeoTargets();
        return view('front.pages.sponsor.campaign.edit-campaign')->with([
            'id' => $id,
            'campaignId' => $campaignId,
            'sponsor' => $sponsor,
            'campaign' => $campaign,
            'geoTargetDetails' => $geo_target_details
        ]);
    }

    public function createOrUpdate(CreateOrUpdateCampaignRequest $request, CampaignService $campaignService){
        if (!empty($request['logo_url']) && !is_string($request['logo_url'])) {
            $request['logo'] = $this->extraService->uploadImage(
                [
                    'image' => $request['logo_url'],
                    'type' => 'campaign'
                ]
            );
        }
        $result = new CampaignResource($this->service->createOrUpdate($request->all()));
        return response()->json($result, 200);
    }

    public function destroy($id) 
    {
        $campaign = Campaign::find($id);
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
