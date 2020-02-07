@extends('front.layouts.header-footer-layout')

@section('styles')

@endsection

@section('scripts')
    window.sponsor_id = {{$id}};
    window.campaign_id = {{$campaignId}};
@endsection

@section('content')
    <campaign-edit :sponsor='@json($sponsor)' :campaign='@json($campaign)' :campaign-id='@json($campaignId)'></campaign-edit>
@endsection
