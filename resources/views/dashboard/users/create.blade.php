@extends('dashboard.layoute')

@section('title')
  Create user
@endsection

@push('styles')

@endpush

@push('ineerNav')
  <li class="breadcrumb-item"><a href="#">Create user</a></li>

@endpush

@section('breadcrumb')
  users
@endsection

@section('content')

  @parent
  <div class="col mr-5">

    <form action="{{ route('dashboard.users.store') }}" method="POST">
      @csrf

     @include('dashboard.users._form', ['title' => 'create'])
    </form>
  </div>

@endsection



@push('scripts')


@endpush
