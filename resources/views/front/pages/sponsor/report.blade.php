@extends('front.layouts.header-footer-layout')

@section('styles')

@endsection

@section('scripts')
window.sponsor_id = {{$id}};
@endsection

@section('content')
<sponsor-report :sponsor='@json($sponsor)'></sponsor-report>
@endsection
