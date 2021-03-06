   <div class="row">
     {{-- Left Column --}}
     <div class="row col-md-8">

       <div class="form-group mb-3 col-12">
         <x-form.input name="name" title="Product Name" :value="$product->name" required="1"/>
       </div>

       <div class="form-group col-12 mb-3">
         <label for="category_id">Category</label>
         <select type="text" name="category_id" id="category_id" class="form-control @error('category_id') is-invalid @enderror" required>
           <option value="" selected>No Parent</option>
           @foreach (DB::table('categories')->get() as $category)
             <option value="{{ $category->id }}" @if ($category->id == old('category_id', $product->category_id))
               selected
           @endif>{{ $category->name }}</option>
           @endforeach)
         </select>
         @error('category_id')
           <span class="invalid-feedback d-block" role="alert"><strong>{{ $message }}</strong></span>
         @enderror
       </div>

       <div class="form-group mb-3 row col-12">
         <div class="col-sm-4">
           <x-form.input step="0.1" name="price" :value="$product->price" type="number" title="Price" />
         </div>
         <div class="col-sm-4">
           <x-form.input step="0.1" name="cost" :value="$product->cost" type="number" title="Cost" />
         </div>
         <div class="col-sm-4">
           <x-form.input step="0.1" name="compare_price" :value="$product->compare_price" type="number" title="Compare Price" />
         </div>
       </div>

       <div class="row col-12">
         <div class="col-md-6">
           <x-form.input name="sku" :value="$product->sku" type="text" title="Sku" />
         </div>
         <div class="col-md-6">
           <x-form.input name="barcode" :value="$product->barcode" type="text" title="Barcode" />
         </div>
       </div>
       <div class="col-12 row">
         <div class="col-md-6 form-group">
           <x-form.input name="quantity" :value="$product->quantity" type="text" title="Quantity" />
         </div>
         <div class="col-md-6 form-group">
           <label for="availability">Availability</label>
           <select name="availability" id="availability" class="form-control @error('availablity') is-invalid @enderror">
             @foreach ($availability as $key => $value)
               <option value="{{ $key }}" @if (old('availablity', $product->availablity) == $key) selected @endif>{{ $value }}</option>
             @endforeach
           </select>
           @error('availability')
             <span class="d-block invalid-feedback">{{ $message }}</span>
           @enderror
         </div>
       </div>
       <div class="form-group col-12">
              <label class="form-label" >Description</label>

           <textarea name="description" id="description" cols="30" rows="10">
            {!!  $product->description !!}
           </textarea>
       </div>

     </div>
     {{-- End Left Column --}}


     {{-- Right Column --}}
     <div class="col-md-4 row">

       <div class="form-group mb-3 col-12">
         <label for="status">Status</label>
         <select name="status" id="status" class="form-control @error('status') is-invalid @enderror">
           @foreach ($getStatus as $key => $value)
             <option value="{{ $key }}" @if ($key == old('status', $product->status)) selected @endif>{{ $value }}</option>
           @endforeach
         </select>
         @error('status')
           <span class="d-block invalid-feedback"><strong>{{ $message }}</strong></span>
         @enderror
       </div>

       <div class="form-group mb-3 col-12 text-center">
         <label for="image">
           Thumbnail
             <img src="{{ $product->image_url }}" alt="Uploded Image" id="blah" class="mx-auto mt-2" width="350">

         </label>
         <input type="file" name="image" id="image" class="form-control d-none @error('image') is-invalid @enderror" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
         @error('image')
           <span class="invalid-feedback d-block" role="alert"><strong>{{ $message }}</strong></span>
         @enderror
       </div>
       <div class="form-group mb-3 col-12 text-center">
         <label for="image">
          Gallery
          <div class="row mb-2 text-center">
              @foreach ($product->getMedia('gallery') as $media)
                <div class="col-3 mb-2">

                    <div class="text-danger"><input type="checkbox" name="delete_media[]" value="{{ $media->id }}" id="{{ 'media.' . $media->id }}" class="text-danger"><label class="text-sm" for="{{ 'media.' . $media->id }}">Delete<img src="{{ $media->getUrl('thumb') }}" alt=""></label></div>
                </div>
              @endforeach
          </div>
         </label>
         <input type="file" name="gallery[]" multiple id="gallery" class="form-control @error('gallery') is-invalid @enderror">
         @error('gallery')
           <span class="invalid-feedback d-block" role="alert"><strong>{{ $message }}</strong></span>
         @enderror
       </div>


     </div>
     {{-- End Right Column --}}
     <div class="row col-12">
       <div class="form-group mb-3 col-12">
         <button type="submit" class="btn btn-success w-25 mx-2">{{ $type }}</button>
         <a href="{{ route('dashboard.products.index') }}" class="btn btn-outline-dark mx-2">Return Back</a>
       </div>
     </div>




   </div>
