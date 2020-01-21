@extends('admin.layouts.layout-2')

@section('styles')
    
@endsection

@section('scripts')

@endsection

@section('content')
    <div>
        <h4 class="d-flex justify-content-between align-items-center w-100 font-weight-bold py-3 mb-4">
            <div>Sponsors</div>
            <button type="button" class="btn btn-primary btn-round d-block" onclick="window.location='sponsors/create';">
                <span class="ion ion-md-add"></span>&nbsp; Create sponsor
            </button>
        </h4>
        <sponsor-list></sponsor-list>
    </div>
@endsection