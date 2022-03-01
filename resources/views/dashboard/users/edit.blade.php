@extends('dashboard.layoute')

@section('title')
  Create user
@endsection

@push('styles')

@endpush

@push('ineerNav')
  <li class="breadcrumb-item"><a href="#">Edit user</a></li>

@endpush

@section('breadcrumb')
  users
@endsection

@section('content')

  @parent
  <div class="col mr-5">
    @if (Session::has('errors'))
      @foreach (Session::get('errors') as $error)
        <div class="">{{ $error }}</div>
      @endforeach
    @endif
    <form action="{{ route('dashboard.users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
      @csrf
      @method('PUT')
           @include('dashboard.users._form', ['title' => 'Update'])

    </form>
  </div>

@endsection



@push('scripts')


@endpush
