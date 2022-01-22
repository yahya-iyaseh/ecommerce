@extends('dashboard.layoute')


@section('title', 'User Profile')

@section('content')
  <form action="{{ route('profile.update') }}" method="post" class="col-12">
    @csrf
    @method('post')
    <div class="row w-100">
      <div class="col-12 mt-3">
        <x-form.input type="text" name="name" title="Name" :value="$user->name" class="form-control" />

      </div>
      <div class="col-12 mt-3">
        <x-form.input type="email" name="email" title="Email" :value="$user->email" class="form-control" />

      </div>
    </div>
    <div class="col-12 mt-3"> <button class="btn btn-success w-25">Update</button>
    </div>
  </form>
@endsection
