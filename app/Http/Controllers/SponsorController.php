<?php

namespace App\Http\Controllers;

use App\Models\Sponsor;
use Illuminate\Http\Request;
use App\Http\Resources\SponsorResource;
use App\Services\{SponsorService, TwitterService, InstagramService, SlugService};

class SponsorController extends Controller
{
    const NETWORKS = [
        'instagram',
        'twitter'
    ];

    public function __construct (
        SponsorService $sponsorService,
        InstagramService $instagramService,
        TwitterService $twitterService,
        SlugService $slugService
    )
    {
        $this->service = $sponsorService;
        $this->instagramService = $instagramService;
        $this->twitterService = $twitterService;
        $this->slugService = $slugService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Sponsor $sponsor)
    {        
        return view('front.index-sponsor', [
            'sponsor' => $sponsor,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sponsor  $sponsor
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $sponsor = Sponsor::find($id);
        return view('front.edit-sponsor')->with([
            'sponsor' => $sponsor,
            'id' => $id,
            'slug' => $sponsor->slug()->first() ? $sponsor->slug->slug : ''
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sponsor  $sponsor
     * @return \Illuminate\Http\Response
     */
    public function edit(Sponsor $sponsor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sponsor  $sponsor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, SponsorService $sponsorService)
    {
        $result = new SponsorResource($sponsorService->createOrUpdateSponsor($request->all()));

        $sponsor = Sponsor::find($id);

        $logo= $request['logo'] ? $this->service->uploadImage($request['logo'], 'profile') : $sponsor->logo;
        $sponsor->update([
            'logo' => $logo,
        ]);

        $result = [
            "sponsor" => $sponsor
        ];

        //Update charity slug
        if ($request->has('slug')) {
            $updateSlugResult = $this->slugService->createOrUpdateSlug([
                'slug' => $request->get('slug'),
                'slugable_type' => Sponsor::class,
                'slugable_id' => $sponsor->getAttribute('id')
            ]);
            if (!$updateSlugResult['result']) {
                $result["errors"] = $updateSlugResult["errors"];
            }
        }

        return response()->json($result, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sponsor  $sponsor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sponsor $sponsor)
    {
        //
    }

    /**
     * Update cover image
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function updateCover(Request $request, $id){
        $sponsor = Sponsor::find($id);
        $background_image = $request['cover'] ? $this->service->uploadImage($request['cover'], 'profile') : $sponsor->background_image;
        $sponsor->update([
            'background_image' => $background_image
        ]);
        return response()->json(['sponsor' => $sponsor], 200);
    }
    /**
     * Update profile picture
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function updateProfilePicture(Request $request, $id){
        $sponsor = Sponsor::find($id);                
        if ($request->file('logo')) {            
            $logo= $request->file('logo') ? $this->service->uploadImage($request->file('logo'), 'profile') : $sponsor->logo;
            $sponsor->update([
                'logo' => $logo,
            ]);
        }
        return response()->json(['sponsor' => $sponsor], 200);
    }
    /**
     * Get all posts from social network.
     *
     * @param Sponsor $sponsor
     * @param string network
     * @return Response
     */
    public function getPosts(Sponsor $sponsor, string $network)
    {
        $network = strtolower($network);

        if (in_array($network, self::NETWORKS)) {
            $tags = explode(',', $sponsor->hashtags);

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
