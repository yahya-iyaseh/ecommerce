@extends('dashboard.layoute')

@section('title')
  Categories Page
@endsection

@push('styles')

@endpush

@push('ineerNav')
@endpush

@section('breadcrumb')
  Categories
@endsection

@section('content')

  @parent
  <div class="col">
    @if (Session::has('success'))
      @if (Session::has('type') == 'warning')
        <div class="alert alert-warning" role="alert">{{ Session::get('success') }}</div>
      @else
        <div class="alert alert-success" role="alert">{{ Session::get('success') }}</div>

      @endif
    @endif
    <a href="{{ route('dashboard.categories.create') }}" class="btn btn-outline-primary text-light p-2 mb-2">Create New</a>
    <table class="table">
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Parent</th>
        <th>Created At</th>
        <th>Image</th>

        <th class="text-center">actions</th>
      </tr>



      @foreach ($categories as $key => $category)
        <tr>

          <td>{{ $key + 1 }}</td>
          <td>{{ $category->name }}</td>
          @if (isset($category->parent->name))
            <td>{{ $category->parent->name }}</td>
          @else
            <td><span class="text-warning">No Parent</span></td>
          @endif

          <td>{{ $category->created_at }}</td>
          <td><img src="{{ Storage::url($category->image) }}" alt="{{ $category->image }}" width="100"></td>

          <td>
            <div class="row">
              <div class="col-md-6">
                <a href="{{ route('dashboard.categories.edit', $category->id) }}" class="btn btn-outline-success btn-sm mb-2 mb-md-0 w-full"><i class="far fa-edit"></i></a>
                </form>
              </div>
              <div class="col-md-6">
                <form action="{{ route('dashboard.categories.destroy', $category->id) }}" method="post">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-outline-danger btn-sm w-full"><i class="far fa-trash-alt"></i></button>
                </form>
              </div>
            </div>



          </td>


        </tr>
      @endforeach
    </table>
    {{ $categories->links() }}
  </div>

@endsection



@push('scripts')


@endpush
