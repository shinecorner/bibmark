<?php

namespace App\Http\Controllers;

use App\Models\Sponsor;
use App\Services\SponsorService;
use Illuminate\Http\Request;
use App\Http\Resources\SponsorResource;

class SponsorController extends Controller
{
    protected $service;
    public function __construct(SponsorService $sponsorService)
    {
        $this->service = $sponsorService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $sponsor = Sponsor::find($id);
        return view('front.index-sponsor')->with([
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
            'id' => $id
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

        return response()->json(['sponsor' => $sponsor], 200);
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
}
