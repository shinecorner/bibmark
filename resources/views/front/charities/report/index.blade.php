@extends('front.layouts.header-footer-layout')

@section('styles')
@endsection

@section('scripts')
    window.charity_id = {{ $charity->id }};
@endsection

@section('content')
    Charity report
@endsection
