@extends('dashboard.layoute')

@section('title')
  Create Category
@endsection

@push('styles')

@endpush

@push('ineerNav')
  <li class="breadcrumb-item"><a href="#">Edit Category</a></li>

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
    <form action="{{ route('dashboard.categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
      @csrf
      @method('PUT')
      <div class="row">
        <div class="row col-md-8">
          <div class="form-group mb-3 row col-12">
            <div class="col-md-4">
              <label for="CategoryName">Category Name</label>
            </div>
            <div class="col-md-8">
              <input type="text" name="CategoryName" id="CategoryName" class="form-control @error('CategoryName') is-invalid @enderror" value="{{ $category->name }}">
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
              <select type="text" name="CategoryParent" id="CategoryParent" class="form-control @error('CategoryParent') is-invalid @enderror">
                <option value="" selected>No Parent</option>
                @foreach (DB::table('categories')->get() as $item)
                  @if ($item->id !== $category->id)
                    <option value="{{ $item->id }}" @if ($category->parent_id == $item->id) selected @endif>{{ $item->name }}</option>
                  @endif
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
              <textarea type="text" name="Description" id="Description" class="form-control @error('Description') is-invalid @enderror">{{ $category->description }}</textarea>
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

              <input type="file" name="image" id="image" class="form-control d-none @error('image') is-invalid @enderror" onchange="document.getElementById('out').src = window.URL.createObjectURL(this.files[0])">
              @error('image')
                <span class="invalid-feedback d-block" role="alert"><strong>{{ $message }}</strong></span>
              @enderror
              <label for="image"><img src="{{ Storage::url($category->image) }}" alt="{{ $category->image }}" width="220" class="mt-2 img-responsive mx-auto" id="out">
              </label>
            </div>
          </div>
        </div>

        <div class="row col-12">
          <div class="form-group mb-3 col-12">
            <button type="submit" class="btn btn-info w-25 mx-2">Update</button>
            <a href="{{ route('dashboard.categories.index') }}" class="btn btn-outline-dark mx-2">cancel</a>
          </div>
        </div>




      </div>
    </form>
  </div>

@endsection



@push('scripts')


@endpush
