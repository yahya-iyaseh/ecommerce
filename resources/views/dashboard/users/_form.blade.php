 <div class="row">

     <div class="form-group col-12 col-md-6">
         <x-form.input name="name" id="name" title="User Name" :value="$user->name" required/>
     </div>
     <div class="form-group col-12 col-md-6">
         <x-form.input name="email" id="email" title="User Email" :value="$user->email" required/>
     </div>

     <div class="col-md-12">
         <h3>{{ __("Roles") }}</h3>
         @foreach(App\Models\Role::all() as $role)
        <div class="custom-control custom-switch ml-3 my-3">
            <input type="checkbox" class="custom-control-input" user="switch" id="roles_{{ $role->name }}" name="roles[]" value="{{ $role->id }}" @if (in_array($role->id, $roles))
            checked
            @endif>
            <label for="roles_{{ $role->name }}" class="custom-control-label">{{ __($role->name) }}</label>
        </div>
         @endforeach

     </div>



     <div class="col-12">
       <button type="submit" class="btn btn-success w-25 mx-2">{{ $title }}</button>
       <a href="{{ route('dashboard.users.index') }}" class="btn btn-outline-dark mx-2">Cancel</a>
     </div>








 </div>
