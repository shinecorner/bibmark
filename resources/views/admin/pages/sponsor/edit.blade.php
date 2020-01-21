@extends('admin.layouts.layout-2')

@section('styles')
    
@endsection

@section('scripts')
    
@endsection

@section('content')
    <h4 class="font-weight-bold py-3 mb-4">
    Edit sponsor <span class="text-muted">#{{ $sponsor->id }}</span>
    </h4>
    <sponsor-edit :sponsor="{{ $sponsor }}"></sponsor-edit>
@endsection