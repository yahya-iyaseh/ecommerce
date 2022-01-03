@extends('dashboard.layoute')

@section('title')
  Create Category
@endsection

@push('styles')

@endpush

@push('ineerNav')
  <li class="breadcrumb-item"><a href="#">Create Category</a></li>

@endpush

@section('breadcrumb')
  Categories
@endsection

@section('content')

  @parent
  <div class="col mr-5">
    @if (Session::has('errors'))
      @foreach (Session::get('errors') as $error)
        <div class="">{{ $error }}</div>
      @endforeach
    @endif
    <form action="{{ route('dashboard.categories.store') }}" method="POST" enctype="multipart/form-data">
      @csrf

      <div class="row">
        <div class="row col-md-8">
          <div class="form-group mb-3 row col-12">
            <div class="col-md-4">
              <label for="CategoryName">Category Name</label>
            </div>
            <div class="col-md-8">
              <input type="text" name="CategoryName" id="CategoryName" class="form-control @error('CategoryName') isInvalid @enderror">
              @error('CategoryName')
                <span class="invalid-feedback d-block" role="alert"><strong>{{ $message }}</strong></span>
              @enderror
            </div>
          </div>
          <div class="form-group mb-3 row col-12">
            <div class="col-md-4">
              <label for="CategoryParent">Category Parent</label>
            </div>
            <div class="col-md-8">
              <select type="text" name="CategoryParent" id="CategoryParent" class="form-control @error('CategoryParent') isInvalid @enderror">
                <option value="" selected>No Parent</option>
                @foreach (DB::table('categories')->get() as $category)
                  <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach)

              </select>
              @error('CategoryParent')
                <span class="invalid-feedback d-block" role="alert"><strong>{{ $message }}</strong></span>
              @enderror
            </div>
          </div>
          <div class="form-group mb-3 row col-12">
            <div class="col-md-4">
              <label for="Description">Description</label>
            </div>
            <div class="col-md-8">
              <textarea type="text" name="Description" id="Description" class="form-control @error('Description') isInvalid @enderror"></textarea>
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

              <input type="file" name="image" id="image" class="form-control @error('image') isInvalid @enderror">
              @error('image')
                <span class="invalid-feedback d-block" role="alert"><strong>{{ $message }}</strong></span>
              @enderror
            </div>
          </div>
        </div>

        <div class="row col-12">
          <div class="form-group mb-3 col-12">
            <button type="submit" class="btn btn-success w-25 mx-2">add</button>
            <a href="{{ route('dashboard.categories.index') }}" class="btn btn-outline-dark mx-2">cancel</a>
          </div>
        </div>




      </div>
    </form>
  </div>

@endsection



@push('scripts')


@endpush
