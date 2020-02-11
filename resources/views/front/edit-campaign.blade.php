@extends('front.layouts.header-footer-layout')

@section('styles')

@endsection

@section('scripts')
    window.sponsor_id = {{$id}};
    window.campaign_id = {{$campaignId}};
@endsection

@section('content')
    <add-campaign :sponsor='@json($sponsor)' :campaign='@json($campaign)' :campaignId='@json($campaignId)'></add-campaign>
@endsection
