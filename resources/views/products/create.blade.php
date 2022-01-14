@extends('dashboard.layoute')

@section('title')
  Create product
@endsection

@push('styles')

@endpush

@push('ineerNav')
  <li class="breadcrumb-item"><a href="#">Create product</a></li>

@endpush

@section('breadcrumb')
  products
@endsection

@section('content')

  @parent
  <form action="{{ route('dashboard.products.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

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

        <div class="form-group mb-3 gap-1 row col-12">
          <div class="col-sm-4">
            <label for="price">Price</label>
            <input type="number" setp="0.1" class="form-control" placeholder="Price" id="price" name="price" required>
          </div>
          <div class="col-sm-4">
            <label for="cost">Cost</label>
            <input type="number" setp="0.1" class="form-control" placeholder="Cost" id="cost" name="cost">
          </div>
          <div class="col-sm-4">
            <label for="compare_price">Compare Price</label>
            <input type="number" setp="0.1" class="form-control" placeholder="Compare Price" id="compare_price" name="compare_price">
          </div>
        </div>

        <div class="row col-12">
          <div class="col-md-6">
            <label for="sku">Sku</label>
            <input type="text" class="form-control" name="sku" id="sku">
          </div>
          <div class="col-md-6">
            <label for="barcode">Barcode</label>
            <input type="text" class="form-control" name="barcode" id="barcode">
          </div>
        </div>

        <div class="form-group mb-3 col-12">
          <label for="Description">Description</label>
          <textarea type="text" name="Description" id="Description" class="form-control @error('Description') is-invalid @enderror">{{ old('Description') }}</textarea>
          @error('Description')
            <span class="invalid-feedback d-block" role="alert"><strong>{{ $message }}</strong></span>
          @enderror
        </div>

      </div>
      {{-- End Left Column --}}


      {{-- Right Column --}}
      <div class="col-md-4 row">

        <div class="form-group mb-3 col-12">
          <label for="status">Status</label>
          <select name="status" id="status" class="form-control">
            @foreach ($status as $key => $value)
              <option value="{{ $key }}">{{ $value }}</option>
            @endforeach
          </select>
        </div>

        <div class="form-group mb-3 col-12 text-center">
          <label for="image">
            Thumbnail
            <img src="{{ asset('images/noImage.png') }}" alt="Uploded Image" id="blah" class="mx-auto mt-2" width="200">
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
          <button type="submit" class="btn btn-success w-25 mx-2">add</button>
          <a href="{{ route('dashboard.products.index') }}" class="btn btn-outline-dark mx-2">cancel</a>
        </div>
      </div>




    </div>
  </form>


@endsection



@push('scripts')


@endpush
