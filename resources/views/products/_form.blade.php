   <div class="row">
      {{-- Left Column --}}
      <div class="row col-md-8">

        <div class="form-group mb-3 col-12">
          <label for="name">product Name</label>
          <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $product->name) }}" required>
          @error('name')
            <span class="invalid-feedback d-block" role="alert"><strong>{{ $message }}</strong></span>
          @enderror
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
            <label for="price">Price</label>
            <input type="number" setp="0.1" class="form-control @error('price') is-invalid @enderror" placeholder="Price" id="price" name="price" value="{{ old('price', $product->price) }}" required>
            @error('price')
              <span class="d-block invalid-feedback">{{ $message }}</span>
            @enderror
          </div>
          <div class="col-sm-4">
            <label for="cost">Cost</label>
            <input type="number" setp="0.1" class="form-control @error('cost') is-invalid @enderror" placeholder="Cost" id="cost" name="cost" value="{{ old('cost', $product->cost) }}">
            @error('cost')
              <span class="d-block invalid-feedback">{{ $message }}</span>
            @enderror
          </div>
          <div class="col-sm-4">
            <label for="compare_price">Compare Price</label>
            <input type="number" setp="0.1" class="form-control @error('compare_price') is-invalid @enderror" placeholder="Compare Price" id="compare_price" name="compare_price" value="{{ old('compare_price', $product->compare_price) }}">
            @error('copmare_price')
              <span class="d-block invalid-feedback">{{ $message }}</span>
            @enderror
          </div>
        </div>

        <div class="row col-12">
          <div class="col-md-6">
            <label for="sku">Sku</label>
            <input type="text" class="form-control @error('sku') is-invalid @enderror" name="sku" id="sku" value="{{ old('sku', $product->sku) }}">
            @error('sku')
              <span class="s-block invalid-feedback">{{ $message }}</span>
            @enderror
          </div>
          <div class="col-md-6">
            <label for="barcode">Barcode</label>
            <input type="text" class="form-control @error('barcode') is-invalid @enderror" name="barcode" id="barcode" value="{{ old('barcode', $product->barcode) }}">
            @error('barcode')
              <span class="s-block invalid-feedback">{{ $message }}</span>
            @enderror
          </div>
        </div>
        <div class="col-12 row">
          <div class="col-md-6 form-group">
            <label for="quantity">Quantity</label>
            <input type="text" class="form-control @error('quantity') is-invalid @enderror" name="quantity" id="quantity" value="{{ old('quantity', $product->quantity) }}">
            @error('quantity')
              <span class="s-block invalid-feedback">{{ $message }}</span>
            @enderror

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
            <label for="description">Description</label>
            <textarea type="text" name="description" id="description" class="form-control @error('description') is-invalid @enderror">{!! old('description', $product->description) !!}</textarea>
            @error('description')
              <span class="invalid-feedback d-block" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
          </div>

        </div>
        {{-- End Left Column --}}


        {{-- Right Column --}}
        <div class="col-md-4 row">

          <div class="form-group mb-3 col-12">
            <label for="status">Status</label>
            <select name="status" id="status" class="form-control @error('status') is-invalid @enderror">
              @foreach ($getStatus as $key => $value)
                <option value="{{ $key }}" @if($key == old('status', $product->status)) selected @endif>{{ $value }}</option>
              @endforeach
            </select>
            @error('status')
              <span class="d-block invalid-feedback"><strong>{{ $message }}</strong></span>
            @enderror
          </div>

          <div class="form-group mb-3 col-12 text-center">
            <label for="image">
              Thumbnail
              @if($product->image)
                            <img src="{{    Storage::url($product->image)}}" alt="Uploded Image" id="blah" class="mx-auto mt-2" width="350">

              @else
                            <img src="{{ asset('images/noImage.png') }}" alt="Uploded Image" id="blah" class="mx-auto mt-2" width="350">

              @endif
            </label>
            <input type="file" name="image" id="image" class="form-control d-none @error('image') is-invalid @enderror" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
            @error('image')
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
