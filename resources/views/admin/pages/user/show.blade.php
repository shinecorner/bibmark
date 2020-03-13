@extends('admin.layouts.layout-2')

@section('styles')
    
@endsection

@section('scripts')
    
@endsection

@section('content')
    <h4 class="font-weight-bold py-3 mb-4">
    Show User <span class="text-muted">#{{ $user->id }}</span>
    </h4>
    <user-show :user="{{ $user }}"></user-show>
@endsection