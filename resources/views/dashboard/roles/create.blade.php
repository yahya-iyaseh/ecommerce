@extends('dashboard.layoute')

@section('title')
  Create role
@endsection

@push('styles')

@endpush

@push('ineerNav')
  <li class="breadcrumb-item"><a href="#">Create role</a></li>

@endpush

@section('breadcrumb')
  roles
@endsection

@section('content')

  @parent
  <div class="col mr-5">

    <form action="{{ route('dashboard.roles.store') }}" method="POST">
      @csrf

     @include('dashboard.roles._form', ['title' => 'create'])
    </form>
  </div>

@endsection



@push('scripts')


@endpush
