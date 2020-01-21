@extends('admin.layouts.layout-2')

@section('styles')
    
@endsection

@section('scripts')
    
@endsection

@section('content')
    <h4 class="font-weight-bold py-3 mb-4">
    Edit asset <span class="text-muted">#{{ $asset->id }}</span>
    </h4>
    <asset-edit :asset="{{ $asset }}"></asset-edit>
@endsection