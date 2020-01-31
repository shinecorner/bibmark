@extends('front.layouts.header-footer-layout')

@section('styles')

@endsection

@section('scripts')
    window.sponsor_id = {{$id}};
@endsection

@section('content')
    <campaign-page :campaigns='@json($campaigns)' :sponsor='@json($sponsor)'></campaign-page>
@endsection
