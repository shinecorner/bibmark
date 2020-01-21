@extends('admin.layouts.layout-dashboard-detail-page')

@section('styles')

@endsection

@section('scripts')

@endsection

@section('content')
    <div>
        <sponsor-detail-page :sponsor-id="{{ $sponsorId }}"></sponsor-detail-page>
    </div>
@endsection