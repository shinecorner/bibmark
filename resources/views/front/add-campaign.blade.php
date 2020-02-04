@extends('front.layouts.header-footer-layout')

@section('styles')

@endsection

@section('scripts')
    window.sponsor_id = {{$id}};
@endsection

@section('content')
    <add-campaign :sponsor='@json($sponsor)'></add-campaign>
@endsection
