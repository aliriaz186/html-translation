@extends('frontend.layouts.app')
@section('content')
<section class="gry-bg py-4 profile">
   <div class="container-fluid p-4">
      <div class="row cols-xs-space cols-sm-space cols-md-space">
         <div class="col-lg-2-1 d-none d-lg-block">
            @if(Auth::user()->user_type == 'seller')
            @include('frontend.inc.seller_side_nav')
            @elseif(Auth::user()->user_type == 'customer')
            @include('frontend.inc.customer_side_nav')
            @endif
         </div>
         <div class="col-lg-9">
            <div class="main-content">
               <!-- Page title -->
               <div class="page-title">
                  <div class="row align-items-center">
                     <div class="col-md-6 col-12">
                        <h2 class="heading heading-6 text-capitalize strong-600 mb-0">
                           {{__('Promotions')}}
                        </h2>
                     </div>
                     <div class="col-md-6 col-12">
                        <div class="float-md-right">
                           <ul class="breadcrumb">
                              <li><a href="{{ route('home') }}">{{__('Home')}}</a></li>
                              <li><a href="{{ route('dashboard') }}">{{__('Dashboard')}}</a></li>
                              <li class="active"><a href="{{ route('customer.raffle.index') }}">{{__('Raffle')}}</a></li>
                           </ul>
                        </div>
                     </div>
                  </div>
               </div>
               <section class="pb-4 mt-4">
                <div class="container">
                    <div class="gutters-5 row">
                        @foreach (json_decode($Raffle->product_to_show) as $key => $raffle_product)
                            @php
                                $product = \App\Product::find($raffle_product);
                            @endphp
                            @if ($product->published != 0)
                                <div class="col-xl-3 col-lg-4 col-md-4 col-6">
                                    <div class="product-card-2 card card-product shop-cards shop-tech mb-2">
                                        <div class="card-body p-0">

                                            <div class="position-relative overflow-hidden h-100">
                                                <a href="{{ route('product', $product->slug) }}" class="d-block product-image h-100">
                                                    <img class="img-fit lazyload mx-auto" src="{{ asset('frontend/images/placeholder.jpg') }}" data-src="{{ asset($product->thumbnail_img) }}" alt="{{ __($product->name) }}">
                                                </a>
                                                <div class="product-btns text-center">
                                                    <button class="btn add-wishlist" title="Add to Wishlist" onclick="addToWishList({{ $product->id }})">
                                                        <i class="la la-heart-o  text-primary"></i>
                                                    </button>
                                                    <button class="btn add-compare" title="Add to Compare" onclick="addToCompare({{ $product->id }})">
                                                        <i class="la la-refresh text-primary"></i>
                                                    </button>
                                                    <button class="btn quick-view" title="Quick view" onclick="showAddToCartModal({{ $product->id }})">
                                                        <i class="la la-eye  text-primary"></i>
                                                    </button>
                                                </div>
                                            </div>

                                            <div class="p-3">
                                                <div class="price-box">
                                                    @if(home_base_price($product->id) != home_discounted_base_price($product->id))
                                                        <del class="old-product-price strong-400">{{ home_base_price($product->id) }}</del>
                                                    @endif
                                                    <span class="product-price strong-600">{{ home_discounted_base_price($product->id) }}</span>
                                                </div>
                                                <div class="star-rating star-rating-sm mt-1">
                                                    {{ renderStarRating($product->rating) }}
                                                </div>
                                                <h2 class="product-title p-0 mt-2">
                                                    <a href="{{ route('product', $product->slug) }}" class="text-truncate">{{ __($product->name) }}</a>
                                                </h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </section>
            </div>
         </div>
      </div>
   </div>
</section>
@endsection
