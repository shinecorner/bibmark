@extends('front.layouts.header-footer-layout')

@section('styles')

@endsection

@section('scripts')
window.charity_id = {{$id}};
@endsection

@section('content')
<charity-edit-page :charity='@json($charity)' ></charity-edit-page>
@endsection
