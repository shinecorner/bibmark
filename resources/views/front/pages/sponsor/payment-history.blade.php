@extends('front.layouts.header-footer-layout')

@section('styles')

@endsection

@section('scripts')
window.sponsor_id = {{$id}};
@endsection

@section('content')
<payment-history-page :history='@json($history)' :sponsor='@json($sponsor)'></payment-history-page>
@endsection
