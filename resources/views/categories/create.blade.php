@extends('dashboard.layoute')

@section('title')
  Create Category
@endsection

@push('styles')

@endpush

@push('ineerNav')
  <li class="breadcrumb-item"><a href="#">Create Category</a></li>

@endpush

@section('breadcrumb')
  Categories
@endsection

@section('content')

  @parent
  <div class="col mr-5">
    @if (Session::has('errors'))
      @foreach (Session::get('errors') as $error)
        <div class="">{{ $error }}</div>
      @endforeach
    @endif
    <form action="{{ route('dashboard.categories.store') }}" method="POST" enctype="multipart/form-data">
      @csrf

     @include('categories._form', ['title' => 'create'])
    </form>
  </div>

@endsection



@push('scripts')


@endpush
