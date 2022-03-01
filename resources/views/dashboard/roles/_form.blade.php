 <div class="row">

     <div class="form-group col-12">
         <x-form.input name="name" id="name" title="Role Name" :value="$role->name" required/>
       @error('name')
         <span class="invalid-feedback d-block" role="alert"><strong>{{ $message }}</strong></span>
       @enderror
     </div>

     <div class="col-md-12">
         <h3>{{ __("Permissions") }}</h3>
         <div class="row my-4 mx-3">
         @foreach(config('permissions') as $key => $value)
        <div class="custom-control custom-switch col-md-6 col-lg-4 col-xl-3 my-2">
            <input type="checkbox" class="custom-control-input" role="switch" id="permissions_{{ str_replace('.', '_',$key) }}" name="permissions[]" value="{{ $key }}" @if($role->has($key)) checked @endif>
            <label for="permissions_{{ str_replace('.', '_',$key) }}" class="custom-control-label">{{ __($value) }}</label>
        </div>
         @endforeach
         </div>
     </div>



     <div class="col-12">
       <button type="submit" class="btn btn-success w-25 mx-2">{{ $title }}</button>
       <a href="{{ route('dashboard.roles.index') }}" class="btn btn-outline-dark mx-2">Cancel</a>
     </div>








 </div>
