 <div class="row">
   <div class="row col-md-8">
     <div class="form-group col-12">
       <label for="CategoryName">Category Name</label>
       <input type="text" name="CategoryName" id="CategoryName" class="form-control @error('CategoryName') is-invalid @enderror" value="{{ old('CategoryName', $category->name) }}">
       @error('CategoryName')
         <span class="invalid-feedback d-block" role="alert"><strong>{{ $message }}</strong></span>
       @enderror
     </div>

     <div class="form-group col-12">
       <label for="CategoryParent">Category Parent</label>
       <select type="text" name="CategoryParent" id="CategoryParent" class="form-control @error('CategoryParent') is-invalid @enderror">
         <option value="" selected>No Parent</option>
         @foreach (DB::table('categories')->get() as $key => $value)
           <option value="{{ $value->id }}" @if ($value->id == old('CategoryParent', $category->id))
             selected
         @endif>{{ $value->name }}</option>
         @endforeach)
       </select>
       @error('CategoryParent')
         <span class="invalid-feedback d-block" role="alert"><strong>{{ $message }}</strong></span>
       @enderror
     </div>

     <div class="form-group col-12">
       <label for="Description">Description</label>
       <textarea type="text" name="Description" id="Description" class="form-control @error('Description') is-invalid @enderror">{{ old('Description', $category->description) }}</textarea>
       @error('Description')
         <span class="invalid-feedback d-block" role="alert"><strong>{{ $message }}</strong></span>
       @enderror
     </div>

     <div class="col-12">
       <button type="submit" class="btn btn-success w-25 mx-2">{{ $title }}</button>
       <a href="{{ route('dashboard.categories.index') }}" class="btn btn-outline-dark mx-2">Cancel</a>
     </div>
   </div>
   <div class="col-md-4 text-center">
     <label for="image">
       Thumbnail
       @if ($category->image)
         <img src="{{ Storage::url($category->image) }}" alt="Uploded Image" id="blah" class="mx-auto mt-2" width="250">
       @else
         <img src="{{ asset('images/noImage.png') }}" alt="Uploded Image" id="blah" class="mx-auto mt-2" width="250">
       @endif
     </label>
     <input type="file" name="image" id="image" class="form-control d-none @error('image') is-invalid @enderror" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
     @error('image')
       <span class="invalid-feedback d-block" role="alert"><strong>{{ $message }}</strong></span>
     @enderror
   </div>






 </div>
