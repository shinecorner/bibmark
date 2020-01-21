@extends('admin.layouts.layout-2')

@section('styles')
    
@endsection

@section('scripts')

@endsection

@section('content')
    <div>
        <h4 class="d-flex justify-content-between align-items-center w-100 font-weight-bold py-3 mb-4">
            <div>Assets</div>
            <button type="button" class="btn btn-primary btn-round d-block" onclick="window.location='assets/create';">
                <span class="ion ion-md-add"></span>&nbsp; Create Asset
            </button>
        </h4>
        <asset-list></asset-list>
    </div>
@endsection