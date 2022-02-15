@extends('dashboard.layoute')

@section('title')
  Categories Page
@endsection

@push('styles')

@endpush

@push('ineerNav')
@endpush

@section('breadcrumb')
  {{ __("Categories") }}
@endsection

@section('content')

  @parent
  <div class="col">
    <div class="d-flex justify-content-between">
      <div class="">
        <form class="form-group row" action="{{ route('dashboard.categories.index') }}" method="get">
          <input type="text" name="search" class="form-control mr-2 col-4" placeholder="Name Category" value="{{ request('search') }}">
          <select name="deleteItems" id="" class="form-control mr-2 col-4">
            <option value="">@lang("Exists Items")</option>
            <option value="true" @if (request('deleteItems'))
              selected
              @endif>@lang("Deleted Items")</option>
          </select>
          <button type="submit" class="btn col-3 btn-success">@lang("Search")</button>
        </form>

      </div>

      <div class="">
        <a href="{{ route('dashboard.categories.create') }}" class="btn btn-outline-primary text-light p-2 mb-2">{{ __("Create New") }}</a>
      </div>
    </div>
    <table class="table">
      <tr>
        <th>{{ Lang::get("Image") }}</th>
        <th>{{ trans("ID") }}</th>
        <th> @lang("Name") </th>
        <th>{{ __("Parent") }}</th>
        <th>{{ __("Created At") }}</th>

        <th class="text-center">{{ __("Actions") }}</th>
      </tr>



      @foreach ($categories as $key => $category)
        <tr>
            <td>

            <img src="{{ $category->image_url }}" alt="{{ $category->image }}" width="100">

          </td>
          <td>{{ $key + 1 }}</td>
          <td>{{ $category->name }}</td>
          @if (isset($category->parent->name))
            <td>{{ $category->parent->name }}</td>
          @else
            <td><span class="text-warning">No Parent</span></td>
          @endif

          <td>{{ $category->created_at }}</td>

          <td>
            <div class="row">
              <div class="col-md-6">
                @if (request('deleteItems'))
                  <a href="{{ route('dashboard.categories.restore', $category->id) }}" class="btn btn-outline-success btn-sm mb-2 mb-md-0 w-full"><i class="fa fa-trash-restore"></i></a>
                @else
                  <a href="{{ route('dashboard.categories.edit', $category->id) }}" class="btn btn-outline-success btn-sm mb-2 mb-md-0 w-full"><i class="far fa-edit"></i></a>
                @endif
                </form>
              </div>
              <div class="col-md-6">
                <form action="{{ route('dashboard.categories.destroy', $category->id) }}" method="post" onsubmit="return confirm('Are you sure you want to destroy this category: {{ $category->name }}')">
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
