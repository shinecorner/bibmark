@extends('admin.layouts.layout-2')

@section('styles')
    
@endsection

@section('scripts')
    
@endsection

@section('content')
    <h4 class="font-weight-bold py-3 mb-4">
    Change Password <span class="text-muted">#{{ $user->id }}</span>
    </h4>
    <user-change-password user-id="{{ $user->id }}"></user-change-password>
@endsection