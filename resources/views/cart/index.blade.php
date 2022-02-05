<x-store-layout>
  <main class="ps-main">
    <div class="ps-content pt-80 pb-80">
      <div class="ps-container">
        <div class="ps-cart-listing">
          <table class="table ps-cart__table">
            <thead>
              <tr>
                <th>All Products</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              @foreach ($cart->all() as $item)
                <tr>
                  <td><a class="ps-product__preview" href="{{ route('products.show', [$item->product->category->slug, $item->product->slug]) }}"><img class="mr-15" src="{{ $item->product->image_url }}" width="70"
                        alt="">{{ $item->product->name }}</a></td>
                  <td>{{ Money::format($item->product->price) }}</td>
                  <td>
                    <div class="form-group--number">
                      <button class="minus"><span>-</span></button>
                      <input class="form-control" type="text" value="{{ $item->quantity }}">
                      <button class="plus"><span>+</span></button>
                    </div>
                  </td>
                  <td>{{ Money::format($item->quantity * $item->product->price) }}</td>
                  <td>
                    <form action="{{ route('cart.destroy', $item->id) }}" method="POST">
                      @csrf
                      @method('DELETE')
                      
                      <button type="submit" class="ps-remove"></button>
                    </form>
                  </td>
                </tr>

              @endforeach

            </tbody>
          </table>
          <div class="ps-cart__actions">
            <div class="ps-cart__promotion">
              <div class="form-group">
                <div class="ps-form--icon"><i class="fa fa-angle-right"></i>
                  <input class="form-control" type="text" placeholder="Promo Code">
                </div>
              </div>
              <div class="form-group">
                <button class="ps-btn ps-btn--gray">Continue Shopping</button>
              </div>
            </div>
            <div class="ps-cart__total">
              <h3>Total Price: <span> {{ Money::format($cart->total()) }}</span></h3>

              <button type="submit" class="ps-btn" href="">Process to checkout<i class="ps-icon-next"></i></button>


            </div>
          </div>
        </div>
      </div>
    </div>


  </main>
</x-store-layout>
