@extends('front.layouts.header-footer-layout')

@section('styles')
@endsection

@section('scripts')
@endsection

@section('content')
    <charity-index
        :charity='@json($charity)'>
    </charity-index>
@endsection
