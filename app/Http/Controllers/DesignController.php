<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\Design;
use App\Models\Account;
use App\Models\Charity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\AcceptHeader;

class DesignController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('front.design');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getCharities(){

        // $charities = Charity::all();
        $charities = Asset::where('assetable_id', 1)->get();
        return $charities;
    }

    public function getSponsors(){

        // $sponsors = Account::all();
        $sponsors = Asset::where('assetable_id', 2)->get();
        return $sponsors;
    }

    public function myDesign(){

        $user_id = Auth::check() ? Auth::user()->id : null;
        $mydesigns = Design::where('user_id', $user_id)->get();

        return $mydesigns;
    }

    public function saveDesign(Request $request){
        $mydesigns = Design::create([
            'user_id' => $request->user_id,
            'name' => $request->name,
            'exported_file' => $request->exported_file,
            'image' => $request->image
        ]);
        
        return $mydesigns;
    }
}
