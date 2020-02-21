@extends('front.layouts.header-footer-layout')

@section('styles')

@endsection

@section('scripts')
    window.charity_id = {{$id}};
    window.campaign_id = {{$campaignId}};
@endsection

@section('content')
    <add-charity-campaign :charity='@json($charity)' :campaign='@json($campaign)' :campaignId='@json($campaignId)'></add-charity-campaign>
@endsection
