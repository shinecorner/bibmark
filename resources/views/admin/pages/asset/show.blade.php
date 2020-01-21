@extends('admin.layouts.layout-2')

@section('styles')
    
@endsection

@section('content')
    <asset-show :asset="{{ $asset }}"></asset-show>
@endsection