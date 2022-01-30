@extends('dashboard.layoute')


@section('title', 'User Profile')

@section('content')
    <a href="{{ route('change-password') }}" class="btn btn-outline-success ml-auto mr-5">Change Password</a>
  <form action="{{ route('profile.update') }}" method="post" class="col-12">
    @csrf
    @method('post')
    <div class="row w-100">

      <div class="col-6">
        <x-form.input type="text" name="first_name" title="First Name" :value="$user->profile->first_name" class="form-control" />

      </div>
      <div class="col-6">
        <x-form.input type="text" name="last_name" title="Last Name" :value="$user->profile->last_name" class="form-control" />

      </div>
      <div class="col-12 mt-2">
        <x-form.input type="text" name="name" title="Display Name" :value="$user->name" class="form-control" required />
      </div>
      <div class="col-12 mt-2">
        <x-form.input type="email" name="email" title="Email Address" :value="$user->email" class="form-control" required />
      </div>
      <div class="col-6 mt-2">
        <x-form.input type="date" name="birth_date" title="Birth Date" :value="$user->profile->birth_date" class="form-control" />
      </div>
      <div class="col-6 mt-5 d-flex justify-start content-center" >
        <x-form.label title="Gender" class="mr-5" />
        <input type="radio" name="gender" id="male" value="male" class="mt-2" @if(old('gender', $user->profile->gender) == 'male') checked @endif />
        <label for="male" class="mx-4">Male</label>
        <input type="radio" name="gender" id="female" value="female" class="mt-2" @if(old('gender', $user->profile->gender) == 'female') checked @endif />
        <label for="female" class="mx-4">Female</label>
      </div>
      <div class="col-6 mt-2">
          <x-form.input type="text" name="city" title="city" :value="$user->profile->city" />
      </div>

      <div class="col-6 mt-2">

         <label for="country_code">Country</label>
         <select name="country_code" id="country_code" class="form-control @error('country_code') is-invalid @enderror">
                        <option value="">Select Country</option>

           @foreach (Symfony\Component\Intl\Countries::getNames() as $code => $value)
             <option value="{{ $code }}" @if ($code == old('country_code', $user->profile->country_code)) selected @endif>{{ $value }}</option>
           @endforeach
         </select>
         @error('country_code')
           <span class="d-block invalid-feedback"><strong>{{ $message }}</strong></span>
         @enderror

    </div>

      <div class="col-6 mt-2">

         <label for="locale">Language</label>
         <select name="locale" id="locale" class="form-control @error('locale') is-invalid @enderror">
                        <option value="">Select Language</option>

           @foreach (Symfony\Component\Intl\Languages::getNames() as $code => $value)
             <option value="{{ $code }}" @if ($code == old('locale', $user->profile->locale)) selected @endif>{{ $value }}</option>
           @endforeach
         </select>
         @error('locale')
           <span class="d-block invalid-feedback"><strong>{{ $message }}</strong></span>
         @enderror
       </div>

      <div class="col-6 mt-2">

         <label for="timezone">Timezone</label>
         <select name="timezone" id="timezone" class="form-control @error('timezone') is-invalid @enderror">
            <option value="">Select Timezone</option>
           @foreach (Symfony\Component\Intl\Timezones::getNames() as $code => $value)
             <option value="{{ $code }}" @if ($code == old('timezone', $user->profile->timezone)) selected @endif>{{ $value }}</option>
           @endforeach
         </select>
         @error('timezone')
           <span class="d-block invalid-feedback"><strong>{{ $message }}</strong></span>
         @enderror
       </div>



    </div>
    <div class="col-12 mt-3"> <button class="btn btn-primary w-25">Save</button>
    </div>
  </form>
@endsection
