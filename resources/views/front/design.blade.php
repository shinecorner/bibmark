@extends('front.layouts.app')

@section('head')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r69/three.min.js"></script>
    <script src="https://s3.amazonaws.com/com.wrapview/scripts/MTLLoader.js"></script>
    <script src="https://s3.amazonaws.com/com.wrapview/scripts/OBJMTLLoader.js"></script>
@endsection

@section('scripts')

@endsection

@section('content')
    <design-tool :design_id="0"></design-tool>
@endsection
