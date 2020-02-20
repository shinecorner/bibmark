@extends('front.layouts.header-footer-layout')

@section('styles')

@endsection

@section('scripts')
    window.charity_id = {{$id}};
@endsection

@section('content')
    <add-charity-campaign :charity='@json($charity)'></add-charity-campaign>
@endsection
