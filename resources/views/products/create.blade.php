@extends('dashboard.layoute')

@section('title')
  Create product
@endsection

@push('styles')
  {{-- Summer Note --}}
  <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">

  <style>
    .note-editable,
    .panel-heading,
    .note-toolbar,
    .note-statusbar {
      background: white !important;
      color: black !important;
    }

  </style>
@endpush

@push('ineerNav')
  <li class="breadcrumb-item"><a href="#">Create product</a></li>

@endpush

@section('breadcrumb')
  products
@endsection

@section('content')

  @parent
  <form action="{{ route('dashboard.products.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

        @include('products._form', ['type' => 'Create'])
        
    </form>


  @endsection



  @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <script>
      $(document).ready(function() {
        $('#description').summernote();
      })
    </script>
  @endpush
