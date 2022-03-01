@extends('dashboard.layoute')

@section('title')
  roles Page
@endsection

@push('styles')
@endpush

@push('ineerNav')
@endpush

@section('breadcrumb')
  {{ __('roles') }}
@endsection

@section('content')
  @parent
  <div class="col">
    <div class="d-flex justify-content-between">
      <div class="">
        <form class="form-group row" action="{{ route('dashboard.roles.index') }}" method="get">
          <input type="text" name="search" class="form-control mr-2 col-4" placeholder="Name role" value="{{ request('search') }}">
          {{-- <select name="deleteItems" id="" class="form-control mr-2 col-4">
            <option value="">@lang("Exists Items")</option> --}}
            {{-- <option value="true" @if (request('deleteItems')) selected @endif>@lang("Deleted Items")</option> --}}
          {{-- </select> --}}
          <button type="submit" class="btn col-3 btn-success">@lang("Search")</button>
        </form>

      </div>

      <div class="">
        <a href="{{ route('dashboard.roles.create') }}" class="btn btn-outline-primary text-light p-2 mb-2">{{ __('Create New') }}</a>
      </div>
    </div>
    <table class="table">
      <tr>
        <th> @lang("Name") </th>
        <th>{{ __('Permissions #') }}</th>
        <th>{{ __('Users #') }}</th>
        <th class="text-center">{{ __('Actions') }}</th>

      </tr>
      @foreach ($roles as $key => $role)
        <tr>


          <td>{{ $role->name }}</td>
          <td>{{ count($role->permissions) }}</td>

          <td></td>
          <td>
            <div class="row">
              {{-- @can('roles.update') --}}
                <div class="col">
                  <a href="{{ route('dashboard.roles.edit', $role->id) }}" class="btn btn-outline-success btn-sm mb-2 mb-md-0 w-full"><i class="far fa-edit"></i></a>
                  </form>
                </div>
              {{-- @endcan --}}


              <div class="col">
                  {{-- @can('roles.delete') --}}


                <form action="{{ route('dashboard.roles.destroy', $role->id) }}" method="post" onsubmit="return confirm('Are you sure you want to destroy this role: {{ $role->name }}')">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-outline-danger btn-sm w-full"><i class="far fa-trash-alt"></i></button>
                </form>
                    {{-- @endcan --}}
              </div>

            </div>



          </td>


        </tr>
      @endforeach
    </table>
    {{ $roles->links() }}
  </div>
@endsection



@push('scripts')
@endpush
