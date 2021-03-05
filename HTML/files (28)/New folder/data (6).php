@extends('frontend.layouts.classified')
@section('classified-content')
<div class="header_section" >


         <!--banner section start -->
         <div class="banner_section layout_padding">
            <div id="my_slider" class="carousel slide" data-ride="carousel">
               <div class="carousel-inner">
                   @foreach(App\ClassifiedProductsFrontend::all() as  $key=>$classified_prodcuts)
                   <div class="carousel-item {{$key==0?'active':''}}">
                    <div class="container">
                       <div class="row">
                          <div class="col-md-6">
                             <div class="taital_main">
                                <h4 class="banner_taital">{!!$classified_prodcuts->title!!}</h4>
                                <p class="banner_text">{!!$classified_prodcuts->text!!}</p>
                                <div class="book_bt"><a href="{{route('home')}}">Shop Now</a></div>
                             </div>
                          </div>
                          <div class="col-md-6">
                             <div><img src="{{asset($classified_prodcuts->slider_image)}}" class="image_1"></div>
                          </div>
                       </div>
                    </div>
                 </div>
                   @endforeach
               </div>
               <a class="carousel-control-prev" href="#my_slider" role="button" data-slide="prev">
               <i class=""><img src="{{asset('frontend/classified_products/images/left-icon.png')}}"></i>
               </a>
               <a class="carousel-control-next" href="#my_slider" role="button" data-slide="next">
               <i class=""><img src="{{asset('frontend/classified_products/images/right-icon.png')}}"></i>
               </a>
            </div>
         </div>
         <!--banner section end -->
      </div>


      @if(\App\BusinessSetting::where('type', 'classified_product')->first()->value == 1)
<div class="container">
    <h1 class="feature_taital">CLASSIFIED PRODUCTS</h1>
    <div class="row">
        @foreach (\App\CustomerProduct::where('status', '1')->where('published', '1')->get() as $key => $customer_product)
 	@if(Carbon\Carbon::now()->lt($customer_product->expire_date) || $customer_product->expire_date == null)
        <div class="col-md-4 col-sm-6">
            <div class="product-grid">
                <div class="product-image">
                    <a href="{{ route('customer.product.detail', $customer_product->slug) }}">
                        <img class="pic-1" style="height:50vh" src="{{ asset($customer_product->thumbnail_img) }}">
                        <img class="pic-2" style="height:50vh" src="{{ asset(json_decode($customer_product->photos)[0]) }}">
                    </a>
                      <ul class="social">
                        <li><a href="" data-tip="Add to Wishlist"><i class="fa fa-heart"></i></a></li>
                    </ul>
                    <span class="product-discount-label">{{__('Classified')}}</span>

                    @if($customer_product->conditon == 'new')
                        <span class="product-new-label">{{__('New')}}</span>
                    @elseif($customer_product->conditon == 'used')
                        <span class="product-new-label">{{__('Used')}}</span>
                    @endif

                </div>

                <div class="product-content">
                    <h3 class="title"><a href="{{ route('customer.product.detail', $customer_product->slug) }}">{{ __($customer_product->name) }}</a></h3>
                    <div class="price">{{ single_price($customer_product->unit_price) }}</div>
                    <a class="add-to-cart" href="{{ route('customer.product.detail', $customer_product->slug) }}">View Product</a>
                </div>
            </div>
        </div>
        @endif
        @endforeach
    </div>
</div>
<hr>
@endif

@endsection
