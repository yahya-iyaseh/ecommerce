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
        <td></td>
        <td>ID</td>
        <td>Name</td>
        <td>Parent</td>
        <td>Created At</td>
        <td colspan="2" class="text-center">actions</td>
      </tr>



      @foreach ($categories as $key => $category)
        <tr>
          <td>{{ $category->image }}</td>
          <td>{{ $key + 1 }}</td>
          <td>{{ $category->name }}</td>
          @if (isset($category->parent->name))
            <td>{{ $category->parent->name }}</td>
          @else
            <td><span class="text-warning">No Parent</span></td>
          @endif

          <td>{{ $category->created_at }}</td>
          <td>
            <a href="{{ route('dashboard.categories.edit', $category->id) }}" class="btn btn-outline-success">Edit</a>
                        </form>

            <form action="{{ route('dashboard.categories.destroy', $category->id) }}" method="post">
              @csrf
              @method('DELETE')
          </td>
          <td>
            <button type="submit" class="btn btn-outline-danger btn-sm">Remove</button>
          </td>
        </tr>
      @endforeach
    </table>
    {{ $categories->links() }}
  </div>

@endsection



@push('scripts')


@endpush
