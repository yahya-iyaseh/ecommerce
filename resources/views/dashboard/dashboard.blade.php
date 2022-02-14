@extends('dashboard.layoute')

@section('title')
  Admin Dashboard
@endsection

@push('styles')
  <style>
    #messages {
      max-height: 400px !important;
      overflow: auto;
    }

  </style>
@endpush

@section('show')
@endsection
@section('breadcrumb')
  @parent
  Main Dashboard
@endsection

@section('content')
@endsection



@push('scripts')
@endpush
