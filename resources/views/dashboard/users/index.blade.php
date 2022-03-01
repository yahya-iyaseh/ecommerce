@extends('dashboard.layoute')

@section('title')
  users Page
@endsection

@push('styles')
@endpush

@push('ineerNav')
@endpush

@section('breadcrumb')
  {{ __('users') }}
@endsection

@section('content')
  @parent
  <div class="col">
    <div class="d-flex justify-content-between">
      <div class="">
        <form class="form-group row" action="{{ route('dashboard.users.index') }}" method="get">
          <input type="text" name="search" class="form-control mr-2 col-4" placeholder="Name user" value="{{ request('search') }}">
          {{-- <select name="deleteItems" id="" class="form-control mr-2 col-4">
            <option value="">@lang("Exists Items")</option> --}}
            {{-- <option value="true" @if (request('deleteItems')) selected @endif>@lang("Deleted Items")</option> --}}
          {{-- </select> --}}
          <button type="submit" class="btn col-3 btn-success">@lang("Search")</button>
        </form>

      </div>

      <div class="">
        <a href="{{ route('dashboard.users.create') }}" class="btn btn-outline-primary text-light p-2 mb-2">{{ __('Create New') }}</a>
      </div>
    </div>
    <table class="table">
      <tr>
        <th> @lang("Name") </th>
        <th>{{ __('Roles #') }}</th>
        <th class="text-center">{{ __('Actions') }}</th>

      </tr>
      @foreach ($users as $key => $user)
        <tr>


          <td>{{ $user->name }}</td>
          <td>{{ implode( ', ',$user->roles()->pluck('name')->toArray() ) }}</td>

          <td>
            <div class="row">
              {{-- @can('users.update') --}}
                <div class="col">
                  <a href="{{ route('dashboard.users.edit', $user->id) }}" class="btn btn-outline-success btn-sm mb-2 mb-md-0 w-full"><i class="far fa-edit"></i></a>
                  </form>
                </div>
              {{-- @endcan --}}


              <div class="col">
                  {{-- @can('users.delete') --}}


                <form action="{{ route('dashboard.users.destroy', $user->id) }}" method="post" onsubmit="return confirm('Are you sure you want to destroy this user: {{ $user->name }}')">
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
    {{ $users->links() }}
  </div>
@endsection



@push('scripts')
@endpush
