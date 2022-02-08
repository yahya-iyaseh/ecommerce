<x-Store-layout>
  <div class="ps-checkout pt-80 pb-80">
    <div class="ps-container">
      <form class="ps-checkout__form" action="{{ route('checkout.store') }}" method="post">
        @csrf
        @method('POST')
        <div class="row">
          <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 ">
            <div class="ps-checkout__billing">
              <h3>Billing Detail</h3>
              <div class="form-group form-group--inline">
                <x-form.input name="shipping[first_name]" title="First Name" :value="$user->profile->first_name" required/>
              </div>
              <div class="form-group form-group--inline">
                <x-form.input name="shipping[last_name]" title="Last Name" :value="$user->profile->last_name" required/>

              </div>
              <div class="form-group form-group--inline">
                <x-form.input type="text" name="shipping[phone_number]" title="Phone Number" :value="$user->profile->phone" required/>
              </div>
              <div class="form-group form-group--inline">
                <x-form.input type="email" name="shipping[email]" title="Email" :value="$user->email" required/>

              </div>
              <div class="form-group form-group--inline">
                <x-form.input type="text" name="shipping[street]" title="Street Address" :value="$user->profile->address" required/>

              </div>
              <div class="form-group form-group--inline">
                <x-form.input type="text" name="shipping[city]" title="City" :value="$user->profile->city" required/>

              </div>
              <div class="form-group form-group--inline">
                <x-form.select name="shipping[country_code]" title="Country" :value="$user->profile->country_code" required/>

              </div>
              <div class="form-group">
                <div class="ps-checkbox">
                  <input class="form-control" type="checkbox" id="cb01">
                  <label for="cb01">Create an account?</label>
                </div>
              </div>
              <h3 class="mt-40"> Addition information</h3>
              <div class="form-group form-group--inline textarea">
                <label>Order Notes</label>
                <textarea class="form-control" rows="5" placeholder="Notes about your order, e.g. special notes for delivery."></textarea>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 ">
            <div class="ps-checkout__order">
              <header>
                <h3>Your Order</h3>
              </header>
              <div class="content">
                <table class="table ps-checkout__products">
                  <thead>
                    <tr>
                      <th class="text-uppercase">Product</th>
                      <th class="text-uppercase">Total</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($cart->all() as $key => $item)
                      <tr>
                        <td>{{ $item->product->name }} x{{ $item->quantity }}</td>
                        <td>{{ Money::format($item->quantity * $item->product->price) }}</td>
                      </tr>

                    @endforeach

                    <tr class="mt-2">

                      <td>
                        Order Total:
                      </td>
                      <td>
                        <u> {{ Money::format($total) }}</u>
                      </td>
                    </tr>

                  </tbody>
                </table>

              </div>
              <footer>
                <h3>Payment Method</h3>
                <div class="form-group cheque">
                  <div class="ps-radio">
                    <input class="form-control" type="radio" id="rdo01" name="payment" checked>
                    <label for="rdo01">Cheque Payment</label>
                    <p>Please send your cheque to Store Name, Store Street, Store Town, Store State / County, Store Postcode.</p>
                  </div>
                </div>
                <div class="form-group paypal">
                  <div class="ps-radio ps-radio--inline">
                    <input class="form-control" type="radio" name="payment" id="rdo02">
                    <label for="rdo02">Paypal</label>
                  </div>
                  <ul class="ps-payment-method">
                    <li><a href="#"><img src="images/payment/1.png" alt=""></a></li>
                    <li><a href="#"><img src="images/payment/2.png" alt=""></a></li>
                    <li><a href="#"><img src="images/payment/3.png" alt=""></a></li>
                  </ul>
                  <button type="submit" class="ps-btn ps-btn--fullwidth">Place Order<i class="ps-icon-next"></i></button>
                </div>
              </footer>
            </div>
            <div class="ps-shipping">
              <h3>FREE SHIPPING</h3>
              <p>YOUR ORDER QUALIFIES FOR FREE SHIPPING.<br> <a href="#"> Singup </a> for free shipping on every order, every time.</p>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>

</x-Store-layout>
