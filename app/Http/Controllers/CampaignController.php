<?php

namespace App\Http\Controllers;

use App\Http\Requests\Sponsor\CreateOrUpdateCampaignRequest;
use App\Http\Resources\CampaignResource;
use App\Models\Sponsor;
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
    public function list($id)
    {
        $sponsor = Sponsor::find($id);
        $campaigns = $this->service->getBySponsorId($id);

        return view('front.campaign')->with([
            'campaigns' => $campaigns,
            'id' => $id,
            'sponsor' => $sponsor,
        ]);
    }

    public function create($id)
    {
        $sponsor = Sponsor::find($id);
        return view('front.add-campaign')->with([
            'id' => $id,
            'sponsor' => $sponsor,
        ]);
    }

    public function createOrUpdate(CreateOrUpdateCampaignRequest $request, CampaignService $campaignService){
        if (!empty($request['logo_url'])) {
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
}
