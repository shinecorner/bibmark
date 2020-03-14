@extends('front.layouts.header-footer-layout')

@section('styles')
@endsection

@section('scripts')
    window.charity_id = {{ $charity->id }};
@endsection

@section('content')
    <charity-donation-list
        :charity='@json($charity)'>
    </charity-donation-list>
@endsection
