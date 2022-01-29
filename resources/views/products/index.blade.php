@extends('dashboard.layoute')

@section('title')
  Products Page
@endsection

@push('styles')

@endpush

@push('ineerNav')
@endpush

@section('breadcrumb')
  Products
@endsection

@section('content')

  @parent
  <div class="col">
    <div class="d-flex justify-content-between">
      <div class="">
        <form class="form-group row" action="{{ route('dashboard.products.index') }}" method="get">
          <input type="text" name="search" class="form-control mr-2 col-4" placeholder="Product Name" value="{{ request('search') }}">
          <select name="deleteItems" id="" class="form-control mr-2 col-4">
            <option value="">Exists Products</option>
            <option value="true" @if (request('deleteItems'))
              selected
              @endif>Deleted Products</option>
          </select>
          <button type="submit" class="btn col-3 btn-success">Search</button>
        </form>

      </div>

      <div class="">
        <a href="{{ route('dashboard.products.create') }}" class="btn btn-outline-primary text-light p-2 mb-2">Create New</a>
      </div>
    </div>
    <table class="table">
      <tr>
        <th>Product Image</th>
        <th>ID</th>
        <th>Name</th>
        <th>Category</th>
        <th>Price</th>
        <th>Qty.</th>
        <th>SKU</th>
        <th>Status</th>
        <th>Created At</th>
        <th class="text-center">actions</th>
      </tr>
      @foreach ($products as $key => $product)
        <tr>
          <td>
              <img src="{{ $product->image_url }}" alt="{{ $product->image }}" width="100">

          </td>
          <td>{{ $key + 1 }}</td>
          <td>{{ $product->name }}</td>
          <td>{{ $product->category_id }}</td>
          <td>
            @if ($product->compare_price)
              <span class="text-info">({{ $product->compare_price }}), </span>
            @endif
            {{ $product->price }}
          </td>
          <td>{{ $product->quantity }}</td>
          <td>{{ $product->sku }}</td>
          <td>
            @if ($product->status == 'active')
              <span class="bg-success px-1 rounded"> {{ $product->status }}</span>
            @elseif ($product->status == 'draft')
              <span class="bg-warning px-1 rounded"> {{ $product->status }}</span>
            @elseif ($product->status == 'archived')
              <span class="bg-danger px-1 rounded"> {{ $product->status }}</span>
            @endif
          </td>
          <td>{{ $product->created_at }}</td>
          <td>
            <div class="row">
              <div class="col-md-6">
                @if (request('deleteItems'))
                  <a href="{{ route('dashboard.products.restore', $product->id) }}" class="btn btn-outline-success btn-sm mb-2 mb-md-0 w-full text-center"><i class="fa fa-trash-restore"></i></a>
                @else
                  <a href="{{ route('dashboard.products.edit', $product->id) }}" class="btn btn-outline-success btn-sm mb-2 mb-md-0 w-full text-center"><i class="far fa-edit"></i></a>
                @endif
                </form>
              </div>
              <div class="col-md-6">
                <form action="{{ route('dashboard.products.destroy', $product->id) }}" method="post" onsubmit='return confirm("Are you sure you want to destroy this product ({{ $product->name }})?")'>
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-outline-danger btn-sm w-full text-center"><i class="far fa-trash-alt"></i></button>
                </form>
              </div>
            </div>



          </td>


        </tr>
      @endforeach
    </table>
    {{ $products->links() }}
  </div>

@endsection



@push('scripts')


@endpush
