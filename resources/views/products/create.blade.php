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
  <div class="col mr-5">
    @if (Session::has('errors'))
      @foreach (Session::get('errors') as $error)
        <div class="">{{ $error }}</div>
      @endforeach
    @endif
    <form action="{{ route('dashboard.products.store') }}" method="POST" enctype="multipart/form-data">
      @csrf

      <div class="row">
        <div class="row col-md-8">
          <div class="form-group mb-3 row col-12">
            <div class="col-md-4">
              <label for="productName">product Name</label>
            </div>
            <div class="col-md-8">
              <input type="text" name="productName" id="productName" class="form-control @error('productName') is-invalid @enderror" value="{{ old('productName')}}">
              @error('productName')
                <span class="invalid-feedback d-block" role="alert"><strong>{{ $message }}</strong></span>
              @enderror
            </div>
          </div>
          <div class="form-group mb-3 row col-12">
            <div class="col-md-4">
              <label for="productParent">product Parent</label>
            </div>
            <div class="col-md-8">
              <select type="text" name="productParent" id="productParent" class="form-control @error('productParent') is-invalid @enderror">
                <option value="" selected>No Parent</option>
                @foreach (DB::table('products')->get() as $product)
                  <option value="{{ $product->id }}" @if ( $product->id == old('productParent'))
                        selected
                  @endif>{{ $product->name }}</option>
                @endforeach)

              </select>
              @error('productParent')
                <span class="invalid-feedback d-block" role="alert"><strong>{{ $message }}</strong></span>
              @enderror
            </div>
          </div>
          <div class="form-group mb-3 row col-12">
            <div class="col-md-4">
              <label for="Description">Description</label>
            </div>
            <div class="col-md-8">
              <textarea type="text" name="Description" id="Description" class="form-control @error('Description') is-invalid @enderror">{{ old('Description') }}</textarea>
              @error('Description')
                <span class="invalid-feedback d-block" role="alert"><strong>{{ $message }}</strong></span>
              @enderror
            </div>
          </div>
        </div>
        <div class="row col-md-4">
          <div class="form-group mb-3 row col-12">
            <div class="col-md-4">
              <label for="image">Thumbnail</label>
            </div>
            <div class="col-md-8">
              <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror">
              @error('image')
                <span class="invalid-feedback d-block" role="alert"><strong>{{ $message }}</strong></span>
              @enderror
            </div>
          </div>
        </div>
        <div class="row col-12">
          <div class="form-group mb-3 col-12">
            <button type="submit" class="btn btn-success w-25 mx-2">add</button>
            <a href="{{ route('dashboard.products.index') }}" class="btn btn-outline-dark mx-2">cancel</a>
          </div>
        </div>




      </div>
    </form>
  </div>

@endsection



@push('scripts')


@endpush
