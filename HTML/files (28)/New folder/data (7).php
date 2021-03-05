@extends('frontend.layouts.app')

@section('content')
    <section class="gry-bg py-4 profile">
        <div class="container-fluid p-4">
            <div class="row cols-xs-space cols-sm-space cols-md-space">
                <div class="col-lg-2-1 d-none d-lg-block">
                    @auth()
                        @if(Auth::user()->user_type == 'seller')
                            @include('frontend.inc.seller_side_nav')
                        @elseif(Auth::user()->user_type == 'customer')
                            @include('frontend.inc.customer_side_nav')
                        @endif
                    @endauth
                </div>

                <div class="col-lg-9">
                    <div class="main-content">
                        <!-- Page title -->
                        <div class="page-title">
                            <div class="row align-items-center">
                                <div class="col-md-6 col-12 d-flex align-items-center">
                                    <h2 class="heading heading-6 text-capitalize strong-600 mb-0">
                                        {{__('Recently Viewed Products')}}
                                    </h2>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="float-md-right">
                                        <ul class="breadcrumb">
                                            <li><a href="{{ route('home') }}">{{__('Home')}}</a></li>
                                            <li><a href="{{ route('dashboard') }}">{{__('Dashboard')}}</a></li>
                                            <li class="active"><a href="{{ route('cookies-products') }}">{{__('Recent Products')}}</a></li>
                                        </ul>
                                        <br>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4 offset-md-4">
                                <div class="dashboard-widget text-center green-widget text-white mt-4 c-pointer">
                                    <i class="fa fa-list"></i>
                                    <span class="d-block title heading-3 strong-400">{{count($products)}}</span>
                                    <span class="d-block sub-title">{{ __('Total Products') }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="card no-border mt-5">
                            <div class="card-header py-3">
                                <h4 class="mb-0 h6">{{__('Recent Products')}}</h4>
                                <span class="pull-right mmt-1"><a href="" class="btn btn-sm btn-anim-primary text-white ">Clear Cookies</a></span>

                            </div>
                            <div class="card-body">
                                <div class="row">
                             @foreach ($products as $key => $product_id)
                                            @php $product = App\Product::findOrFail($product_id);  @endphp
                                            <div class="col-md-3">
                                                <div class="caorusel-card">
                                                    <div class="product-card-2 card card-product shop-cards shop-tech">
                                                        <div class="card-body p-0">
                                                            <div class="card-image">
                                                                <a href="{{ route('product', $product->slug) }}" class="d-block">
                                                                    <img class="img-fit lazyload mx-auto" src="{{ asset('frontend/images/placeholder.jpg') }}" data-src="{{ asset($product->featured_img) }}" alt="{{ __($product->name) }}">
                                                                </a>
                                                            </div>
                                                            <div class="p-md-3 p-2">
                                                                <div class="price-box">
                                                                    @if(home_base_price($product->id) != home_discounted_base_price($product->id))
                                                                        <del class="old-product-price strong-400">{{ home_base_price($product->id) }}</del>
                                                                    @endif
                                                                    <span class="product-price strong-600">{{ home_discounted_base_price($product->id) }}</span>
                                                                </div>
                                                                <div class="star-rating star-rating-sm mt-1">
                                                                    {{ renderStarRating($product->rating) }}
                                                                </div>
                                                                <h2 class="product-title p-0 text-truncate-2">
                                                                    <a href="{{ route('product', $product->slug) }}">{{ __($product->name) }}</a>
                                                                </h2>

                                                                @if (\App\Addon::where('unique_identifier', 'club_point')->first() != null && \App\Addon::where('unique_identifier', 'club_point')->first()->activated)
                                                                    <div class="club-point mt-2 bg-soft-base-1 border-light-base-1 border">
                                                                        {{ __('Club Point') }}:
                                                                        <span class="strong-700 float-right">{{ $product->earn_point }}</span>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

