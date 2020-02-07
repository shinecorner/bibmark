@extends('front.layouts.header-footer-layout')

@section('styles')

@endsection

@section('scripts')
    window.sponsor_id = {{$id}};
    window.campaign_id = {{$campaignId}};
@endsection

@section('content')
    <edit-campaign :sponsor='@json($sponsor)', :campaign='@json($campaign)'></edit-campaign>
@endsection
