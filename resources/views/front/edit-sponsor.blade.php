@extends('front.layouts.header-footer-layout')

@section('styles')

@endsection

@section('scripts')
window.sponsor_id = {{$id}};
@endsection

@section('content')
<sponsor-edit-page :sponsor='@json($sponsor)' :slug='@json($slug)' ></sponsor-edit-page>
@endsection
