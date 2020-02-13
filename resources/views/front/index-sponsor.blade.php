@extends('front.layouts.header-footer-layout')

@section('styles')
@endsection

@section('scripts')
@endsection

@section('content')
    <sponsor-index :sponsor='@json($sponsor)' :instagram-posts='@json($instagramPosts)' ></sponsor-index>
@endsection
