@extends('front.layouts.header-footer-layout')

@section('styles')

@endsection

@section('scripts')
    window.sponsor_id = {{$id}};
    window.campaign_id = {{$campaignId}};
@endsection

@section('content')
    <add-campaign :sponsor='@json($sponsor)' :campaign='@json($campaign)' :campaign-id='@json($campaignId)' :current-geo-targets='@json($geoTargetDetails)'></add-campaign>
@endsection
