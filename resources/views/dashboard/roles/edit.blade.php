@extends('dashboard.layoute')

@section('title')
  Create role
@endsection

@push('styles')

@endpush

@push('ineerNav')
  <li class="breadcrumb-item"><a href="#">Edit role</a></li>

@endpush

@section('breadcrumb')
  roles
@endsection

@section('content')

  @parent
  <div class="col mr-5">
    @if (Session::has('errors'))
      @foreach (Session::get('errors') as $error)
        <div class="">{{ $error }}</div>
      @endforeach
    @endif
    <form action="{{ route('dashboard.roles.update', $role->id) }}" method="POST" enctype="multipart/form-data">
      @csrf
      @method('PUT')
           @include('dashboard.roles._form', ['title' => 'Update'])

    </form>
  </div>

@endsection



@push('scripts')


@endpush
