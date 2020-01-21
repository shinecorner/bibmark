@extends('admin.layouts.layout-2')

@section('styles')
    
@endsection

@section('scripts')
    
@endsection

@section('content')
    <h4 class="font-weight-bold py-3 mb-4">
    Create user
    </h4>
    <user-edit sponsor-id="{{ isset($sponsorId) ? $sponsorId : '' }}"></user-edit>
@endsection