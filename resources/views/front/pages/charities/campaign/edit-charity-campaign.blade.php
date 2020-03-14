@extends('front.layouts.header-footer-layout')

@section('styles')

@endsection

@section('scripts')
    window.charity_id = {{$id}};
    window.campaign_id = {{$campaignId}};
@endsection

@section('content')
    <add-charity-campaign :charity='@json($charity)' :campaign='@json($campaign)' :campaign-id='@json($campaignId)' :current-geo-targets='@json($geoTargetDetails)'></add-charity-campaign>
@endsection
