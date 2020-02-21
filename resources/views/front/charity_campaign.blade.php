@extends('front.layouts.header-footer-layout')

@section('styles')

@endsection

@section('scripts')
    window.charity_id = {{$id}};
@endsection

@section('content')
    <charity-campaign-page :campaigns='@json($campaigns)' :charity='@json($charity)'></charity-campaign-page>    
@endsection
