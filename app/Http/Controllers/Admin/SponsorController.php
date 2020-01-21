<?php

namespace App\Http\Controllers\Admin;

use App\Models\Sponsor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\SponsorResource;
use App\Services\UserService;

class SponsorController extends Controller
{
    public function __construct()
    {

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.pages.sponsor.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.sponsor.create');
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
    public function show(Sponsor $sponsor)
    {
        return view('admin.pages.sponsor.show', [
            'sponsor' => $sponsor
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
        return view('admin.pages.sponsor.edit', [
            'sponsor' => $sponsor
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sponsor  $sponsor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sponsor $sponsor)
    {
        //
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
     * Show the form for creating a new user.
     *
     * @return \Illuminate\Http\Response
     */
    public function createUser($sponsorId)
    {
        return view('admin.pages.user.create', [
            'sponsorId' => $sponsorId
        ]);
    }

    /**
     * Show the form for editing a user.
     *
     * @param integer $sponsorId
     * @param integer $userId
     * @param App\Services\UserService $userService
     * @return \Illuminate\Http\Response
     */
    public function editUser($sponsorId, $userId, UserService $userService)
    {
        return view('admin.pages.user.edit', [
            'sponsorId' => $sponsorId,
            'user' => $userService->user($userId)
        ]);
    }
}
