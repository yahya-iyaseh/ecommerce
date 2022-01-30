@extends('dashboard.layoute')


@section('title', 'Change password')

@section('content')

  <form action="{{ route('change-password.update') }}" method="post" class="col-12 row">
    @csrf
    <div class="row">
      <div class="col-12 mt-3">
        <x-form.input type="password" name="password" title="Password" :value="null" class="form-control" />

      </div>
      <div class="col-12 mt-3">
        <x-form.input type="password" name="new_password" title="New Password" :value="null" class="form-control" />

      </div>
      <div class="col-12 mt-3">
        <x-form.input type="password" name="new_password_confirmation" title="Confirm Password" :value="null" class="form-control" />

      </div>
      <div class="col-12 mt-3">
         <button class="btn btn-success w-25">Update</button>
        <a href="{{ route('profile') }}" class="btn btn-outline-dark">Back</a>
        </div>
      </div>


  </form>
@endsection
