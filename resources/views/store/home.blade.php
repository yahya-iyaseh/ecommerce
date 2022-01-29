<x-Store-layout>

  <div class="ps-section ps-section--hotdeal-3 pt-80 pb-40">
    <div class="ps-container">
      <div class="ps-section__header mb-50">
        <h3 class="ps-section__title" data-mask="Promotion">- Our Event</h3>
      </div>
      <div class="ps-section__content">
        <div class="row">
          <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 ">
            <div class="ps-product--hotdeal reverse">
              <div class="ps-product__thumbnail"><a class="ps-product__overlay" href="product-detail.html"></a><img src="{{ asset('template/images//access/5.jpg') }}" alt=""></div>
              <div class="ps-product__content"><a class="ps-product__title" href="product-detail.html">Slim Fit Men Sport Hoodie</a>
                <p class="ps-product__price">Only: <span>£178</span></p>
                <div class="ps-product__status">
                  <div class="sold">Already sold: <span>10</span></div>
                  <div class="avaiable">Avaiable: <span>30</span></div>
                </div>
                <div class="progress">
                  <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;"></div>
                </div>
                <ul class="ps-countdown" data-time="December 13, 2017 15:37:25">
                  <li><span class="hours"></span>
                    <p>Hours</p>
                  </li>
                  <li class="divider">:</li>
                  <li><span class="minutes"></span>
                    <p>minutes</p>
                  </li>
                  <li class="divider">:</li>
                  <li><span class="seconds"></span>
                    <p>Seconds</p>
                  </li>
                </ul><a class="ps-btn" href="cart.html">Order Today<i class="ps-icon-next"></i></a>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 "><a class="ps-offer mb-30" href="product-detail.html"><img src="{{ asset('template/images//offer/home-3-1.jpg') }}" alt=""></a><a class="ps-offer" href="product-detail.html"><img
                src="images/offer/home-3-3.jpg')}}" alt=""></a>
          </div>
          <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 "><a class="ps-offer" href="product-detail.html"><img src="{{ asset('template/images//offer/home-3-2.jpg') }}" alt=""></a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="ps-section--features-product ps-section masonry-root pt-40 pb-80">
    <div class="ps-container">
      <div class="ps-section__header mb-50">
        <h3 class="ps-section__title" data-mask="features">- New Product</h3>
        <ul class="ps-masonry__filter">
          <li class="current"><a href="#" data-filter="*">All <sup>8</sup></a></li>
          <li><a href="#" data-filter=".nike">Nike <sup>1</sup></a></li>
          <li><a href="#" data-filter=".adidas">Adidas <sup>1</sup></a></li>
          <li><a href="#" data-filter=".men">Men <sup>1</sup></a></li>
          <li><a href="#" data-filter=".women">Women <sup>1</sup></a></li>
          <li><a href="#" data-filter=".kids">Kids <sup>4</sup></a></li>
        </ul>
      </div>
      <div class="ps-section__content pb-50">
        <div class="masonry-wrapper" data-col-md="4" data-col-sm="2" data-col-xs="1" data-gap="30" data-radio="100%">
          <div class="ps-masonry">
            <div class="grid-sizer"></div>
            @foreach ($newProducts as $key => $product)
              <x-store.product-card :product="$product" :new="$loop->first" />


            @endforeach


          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="ps-features pt-80 pb-80 bg--cover" data-background="{{ asset('template/images/background/parallax.jpg') }}">
    <div class="ps-container">
      <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 ">
          <div class="ps-iconbox ps-iconbox--inverse">
            <div class="ps-iconbox__header"><i class="ps-icon-delivery"></i>
              <h3>Free shipping</h3>
              <p>ON ORDER OVER $199</p>
            </div>
            <div class="ps-iconbox__content">
              <p>Want to track a package? Find tracking information and order details from Your Orders.</p>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 ">
          <div class="ps-iconbox ps-iconbox--inverse">
            <div class="ps-iconbox__header"><i class="ps-icon-money"></i>
              <h3>100% MONEY BACK.</h3>
              <p>WITHIN 30 DAYS AFTER DELIVERY.</p>
            </div>
            <div class="ps-iconbox__content">
              <p>You may return most new, unopened items sold within 30 days of delivery for a full refund.</p>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 ">
          <div class="ps-iconbox ps-iconbox--inverse">
            <div class="ps-iconbox__header"><i class="ps-icon-customer-service"></i>
              <h3>SUPPORT 24/7.</h3>
              <p>WE CAN HELP YOU ONLINE.</p>
            </div>
            <div class="ps-iconbox__content">
              <p>We offer a 24/7 customer hotline so you’re never alone if you have a question.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="ps-owl-root ps-section pt-80 pb-40">
    <div class="ps-container">
      <div class="ps-section__header mb-50">
        <div class="row">
          <div class="col-lg-9 col-md-12 col-sm-12 col-xs-12 ">
            <h3 class="ps-section__title" data-mask="BEST SALE">- Top Sales</h3>
          </div>
          <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12 ">
            <div class="ps-owl-actions"><a class="ps-prev" href="#"><i class="ps-icon-arrow-right"></i>Prev</a><a class="ps-next" href="#">Next<i class="ps-icon-arrow-left"></i></a></div>
          </div>
        </div>
      </div>
      <div class="ps-section__content">
        <div class="ps-owl--colection owl-slider" data-owl-auto="true" data-owl-loop="true" data-owl-speed="5000" data-owl-gap="30" data-owl-nav="false" data-owl-dots="false" data-owl-item="4" data-owl-item-xs="1" data-owl-item-sm="2"
          data-owl-item-md="2" data-owl-item-lg="4" data-owl-duration="1000" data-owl-mousedrag="on">
          @foreach ($topSales as $product)
            <div class="ps-shoes--carousel">
              <x-store.product-card :product="$product" :new="$loop->first" />
            </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
  <div class="ps-section pt-40 pb-80">
    <div class="ps-container">
      <div class="ps-section__header mb-50">
        <h3 class="ps-section__title" data-mask="SALE OFF">- - HOT DEAL TODAY</h3>
      </div>
      <div class="ps-section__content">
        <div class="row">
          <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 ">
            <div class="ps-product--hotdeal reverse">
              <div class="ps-product__thumbnail"><a class="ps-product__overlay" href="product-detail.html"></a><img src="{{ asset('template/images//access/4.jpg') }}" alt=""></div>
              <div class="ps-product__content"><a class="ps-product__title text-uppercase" href="product-detail.html">Jordan pro andre hat</a>
                <p class="ps-product__price">Only: <span>£178</span></p>
                <div class="ps-product__status">
                  <div class="sold">Already sold: <span>10</span></div>
                  <div class="avaiable">Avaiable: <span>30</span></div>
                </div>
                <div class="progress">
                  <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;"></div>
                </div>
                <ul class="ps-countdown" data-time="December 13, 2017 15:37:25">
                  <li><span class="hours"></span>
                    <p>Hours</p>
                  </li>
                  <li class="divider">:</li>
                  <li><span class="minutes"></span>
                    <p>minutes</p>
                  </li>
                  <li class="divider">:</li>
                  <li><span class="seconds"></span>
                    <p>Seconds</p>
                  </li>
                </ul><a class="ps-btn" href="cart.html">Order Today<i class="ps-icon-next"></i></a>
              </div>
            </div>
          </div>
          <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 ">
            <div class="ps-product--hotdeal reverse">
              <div class="ps-product__thumbnail"><a class="ps-product__overlay" href="product-detail.html"></a><img src="{{ asset('template/images//access/1.jpg') }}" alt=""></div>
              <div class="ps-product__content"><a class="ps-product__title text-uppercase" href="product-detail.html">brasilia small bag</a>
                <p class="ps-product__price">Only: <span>£178</span></p>
                <div class="ps-product__status">
                  <div class="sold">Already sold: <span>10</span></div>
                  <div class="avaiable">Avaiable: <span>30</span></div>
                </div>
                <div class="progress">
                  <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;"></div>
                </div>
                <ul class="ps-countdown" data-time="December 13, 2017 15:37:25">
                  <li><span class="hours"></span>
                    <p>Hours</p>
                  </li>
                  <li class="divider">:</li>
                  <li><span class="minutes"></span>
                    <p>minutes</p>
                  </li>
                  <li class="divider">:</li>
                  <li><span class="seconds"></span>
                    <p>Seconds</p>
                  </li>
                </ul><a class="ps-btn" href="cart.html">Order Today<i class="ps-icon-next"></i></a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="ps-home-testimonial bg--parallax pb-80" data-background="{{ asset('template/images/background/parallax.jpg')}}">
    <div class="container">
      <div class="owl-slider" data-owl-auto="true" data-owl-loop="true" data-owl-speed="5000" data-owl-gap="0" data-owl-nav="false" data-owl-dots="true" data-owl-item="1" data-owl-item-xs="1" data-owl-item-sm="1" data-owl-item-md="1"
        data-owl-item-lg="1" data-owl-duration="1000" data-owl-mousedrag="on" data-owl-animate-in="fadeIn" data-owl-animate-out="fadeOut">
        <div class="ps-testimonial">
          <div class="ps-testimonial__thumbnail"><img src="{{ asset('template/images//testimonial/1.jpg') }}" alt=""><i class="fa fa-quote-left"></i></div>
          <header>
            <select class="ps-rating">
              <option value="1">1</option>
              <option value="1">2</option>
              <option value="1">3</option>
              <option value="1">4</option>
              <option value="5">5</option>
            </select>
            <p>Logan May - CEO & Founder Invision</p>
          </header>
          <footer>
            <p>“Dessert pudding dessert jelly beans cupcake sweet caramels gingerbread. Fruitcake biscuit cheesecake. Cookie topping sweet muffin pudding tart bear claw sugar plum croissant. “</p>
          </footer>
        </div>
        <div class="ps-testimonial">
          <div class="ps-testimonial__thumbnail"><img src="{{ asset('template/images//testimonial/2.jpg') }}" alt=""><i class="fa fa-quote-left"></i></div>
          <header>
            <select class="ps-rating">
              <option value="1">1</option>
              <option value="1">2</option>
              <option value="1">3</option>
              <option value="1">4</option>
              <option value="5">5</option>
            </select>
            <p>Logan May - CEO & Founder Invision</p>
          </header>
          <footer>
            <p>“Dessert pudding dessert jelly beans cupcake sweet caramels gingerbread. Fruitcake biscuit cheesecake. Cookie topping sweet muffin pudding tart bear claw sugar plum croissant. “</p>
          </footer>
        </div>
        <div class="ps-testimonial">
          <div class="ps-testimonial__thumbnail"><img src="{{ asset('template/images//testimonial/3.jpg') }}" alt=""><i class="fa fa-quote-left"></i></div>
          <header>
            <select class="ps-rating">
              <option value="1">1</option>
              <option value="1">2</option>
              <option value="1">3</option>
              <option value="1">4</option>
              <option value="5">5</option>
            </select>
            <p>Logan May - CEO & Founder Invision</p>
          </header>
          <footer>
            <p>“Dessert pudding dessert jelly beans cupcake sweet caramels gingerbread. Fruitcake biscuit cheesecake. Cookie topping sweet muffin pudding tart bear claw sugar plum croissant. “</p>
          </footer>
        </div>
      </div>
    </div>
  </div>
  <div class="ps-section ps-home-blog pt-80 pb-80">
    <div class="ps-container">
      <div class="ps-section__header mb-50">
        <h2 class="ps-section__title" data-mask="News">- Our Story</h2>
        <div class="ps-section__action"><a class="ps-morelink text-uppercase" href="#">View all post<i class="fa fa-long-arrow-right"></i></a></div>
      </div>
      <div class="ps-section__content">
        <div class="row">
          <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 ">
            <div class="ps-post">
              <div class="ps-post__thumbnail"><a class="ps-post__overlay" href="blog-detail.html"></a><img src="{{ asset('template/images//blog/1.jpg') }}" alt=""></div>
              <div class="ps-post__content"><a class="ps-post__title" href="blog-detail.html">An Inside Look at the Breaking2 Kit</a>
                <p class="ps-post__meta"><span>By:<a class="mr-5" href="blog.html">Alena Studio</a></span> -<span class="ml-5">Jun 10, 2017</span></p>
                <p>Leverage agile frameworks to provide a robust synopsis for high level overviews. Iterative approaches to corporate strategy foster collaborative thinking to further…</p><a class="ps-morelink" href="blog-detail.html">Read more<i
                    class="fa fa-long-arrow-right"></i></a>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 ">
            <div class="ps-post">
              <div class="ps-post__thumbnail"><a class="ps-post__overlay" href="blog-detail.html"></a><img src="{{ asset('template/images//blog/2.jpg') }}" alt=""></div>
              <div class="ps-post__content"><a class="ps-post__title" href="blog-detail.html">Unpacking the Breaking2 Race Strategy</a>
                <p class="ps-post__meta"><span>By:<a class="mr-5" href="blog.html">Alena Studio</a></span> -<span class="ml-5">Jun 10, 2017</span></p>
                <p>Leverage agile frameworks to provide a robust synopsis for high level overviews. Iterative approaches to corporate strategy foster collaborative thinking to further…</p><a class="ps-morelink" href="blog-detail.html">Read more<i
                    class="fa fa-long-arrow-right"></i></a>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 ">
            <div class="ps-post">
              <div class="ps-post__thumbnail"><a class="ps-post__overlay" href="blog-detail.html"></a><img src="{{ asset('template/images//blog/3.jpg') }}" alt=""></div>
              <div class="ps-post__content"><a class="ps-post__title" href="blog-detail.html">Nike’s Latest Football Cleat Breaks the Mold</a>
                <p class="ps-post__meta"><span>By:<a class="mr-5" href="blog.html">Alena Studio</a></span> -<span class="ml-5">Jun 10, 2017</span></p>
                <p>Leverage agile frameworks to provide a robust synopsis for high level overviews. Iterative approaches to corporate strategy foster collaborative thinking to further…</p><a class="ps-morelink" href="blog-detail.html">Read more<i
                    class="fa fa-long-arrow-right"></i></a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="ps-home-partner">
    <div class="ps-container">
      <div class="owl-slider" data-owl-auto="true" data-owl-loop="true" data-owl-speed="5000" data-owl-gap="40" data-owl-nav="false" data-owl-dots="false" data-owl-item="6" data-owl-item-xs="2" data-owl-item-sm="4" data-owl-item-md="5"
        data-owl-item-lg="6" data-owl-duration="1000" data-owl-mousedrag="on"><a href="#"><img src="{{ asset('template/images//partner/1.png" alt=""></a><a href="#"><img src="{{ asset('template/images//partner/2.png" alt=""></a><a href="#"><img src="{{ asset('template/images//partner/3.png" alt=""></a><a
          href="#"><img src="{{ asset('template/images//partner/4.png" alt=""></a><a href="#"><img src="{{ asset('template/images//partner/5.png" alt=""></a><a href="#"><img src="{{ asset('template/images//partner/6.png" alt=""></a><a href="#"><img src="{{ asset('template/images//partner/7.png" alt=""></a><a href="#"><img
            src="images/partner/8.png" alt=""></a>
      </div>
    </div>
  </div>
  <div class="ps-home-contact">
    <div id="contact-map" data-address="New York, NY" data-title="BAKERY LOCATION!" data-zoom="17"></div>
    <div class="ps-home-contact__form">
      <header>
        <h3>Contact Us</h3>
        <p>Learn about our company profile, communityimpact, sustainable motivation, and more.</p>
      </header>
      <footer>
        <form action="product-listing.html" method="post">
          <div class="form-group">
            <label>Name<span>*</span></label>
            <input class="form-control" type="text">
          </div>
          <div class="form-group">
            <label>Email<span>*</span></label>
            <input class="form-control" type="email">
          </div>
          <div class="form-group">
            <label>Your message<span>*</span></label>
            <textarea class="form-control" rows="4"></textarea>
          </div>
          <div class="form-group text-center">
            <button class="ps-btn">Send Message<i class="fa fa-angle-right"></i></button>
          </div>
        </form>
      </footer>
    </div>
  </div>
</x-Store-layout>
