@extends('frontend.layouts.app')

@section('content')

@if(Auth::user()->user_type == "customer")
    <section class="gry-bg py-1 profile">
        <div class="container-fluid p-4">
            <div class="row cols-xs-space cols-sm-space cols-md-space">
                <div class="col-lg-2-1 d-none d-lg-block">
                    @include('frontend.inc.customer_side_nav')
                </div>
                <div class="col-lg-9">
                    <!-- Page title -->
                    <div class="page-title">
                        <div class="row align-items-center">
                            <div class="col-md-6 col-12">
                                <h2 class="heading heading-6 text-capitalize strong-600 mb-0">
                                    {{__('Dashboard')}}
                                </h2>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="float-md-right">
                                    <ul class="breadcrumb">
                                        <li><a href="{{ route('home') }}">{{__('Home')}}</a></li>
                                        <li class="active"><a href="{{ route('dashboard') }}">{{__('Dashboard')}}</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- dashboard content -->
                    <div class="">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="dashboard-widget text-center green-widget mt-4 c-pointer">
                                    <a href="javascript:;" class="d-block">
                                        <i class="fa fa-shopping-cart"></i>
                                        @if(Session::has('cart'))
                                            <span class="d-block title">{{ count(Session::get('cart'))}} {{__('Product(s)')}}</span>
                                        @else
                                            <span class="d-block title">0 {{__('Product')}}</span>
                                        @endif
                                        <span class="d-block sub-title">{{__('in your cart')}}</span>
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="dashboard-widget text-center red-widget mt-4 c-pointer">
                                    <a href="javascript:;" class="d-block">
                                        <i class="fa fa-heart"></i>
                                        <span class="d-block title">{{ count(Auth::user()->wishlists)}} {{__('Product(s)')}}</span>
                                        <span class="d-block sub-title">{{__('in your wishlist')}}</span>
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="dashboard-widget text-center yellow-widget mt-4 c-pointer">
                                    <a href="javascript:;" class="d-block">
                                        <i class="fa fa-building"></i>
                                        @php
                                            $orders = \App\Order::where('user_id', Auth::user()->id)->get();
                                            $total = 0;
                                            foreach ($orders as $key => $order) {
                                                $total += count($order->orderDetails);
                                            }
                                        @endphp
                                        <span class="d-block title">{{ $total }} {{__('Product(s)')}}</span>
                                        <span class="d-block sub-title">{{__('you ordered')}}</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <br>
                        <section class="slice-sm footer-top-bar bg-white">
                            <div class="container sct-inner">
                                <div class="row no-gutters">
                                    <div class="col-lg-3 col-md-6">
                                        <div class="footer-top-box text-center">
                                            <a href="{{route('purchases.index')}}">
                                                <i class="la la-shopping-cart"></i>
                                                <h4 class="heading-5">{{__('My Purchases')}}</h4>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6">
                                        <div class="footer-top-box text-center">
                                            <a href="{{ route('purchases.return_request') }}">
                                                <i class="la la-repeat"></i>
                                                <h4 class="heading-5">{{__('Return Requested')}}</h4>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6">
                                        <div class="footer-top-box text-center">
                                            <a href="{{ route('purchases.refund_request') }}">
                                                <i class="la la-money"></i>
                                                <h4 class="heading-5">{{__('Refunds')}}</h4>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6">
                                        <div class="footer-top-box text-center">
                                            <a href="{{ route('purchases.cancellation_request') }}">
                                                <i class="la la-times-circle"></i>
                                                <h4 class="heading-5">{{__('Cancelled Orders')}}</h4>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <section class="slice-sm footer-top-bar bg-white">
                            <div class="container sct-inner">
                                <div class="row no-gutters">
                                    <div class="col-lg-3 col-md-6">
                                        <div class="footer-top-box text-center">
                                            <a href="{{ route('sellerpolicy') }}">
                                                <i class="la la-users"></i>
                                                <h4 class="heading-5">{{__('Affiliate Program')}}</h4>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6">
                                        <div class="footer-top-box text-center">
                                            <a href="{{ route('vouchers.index') }}">
                                                <i class="la la-tags"></i>
                                                <h4 class="heading-5">{{__('My Vouchers')}}</h4>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6">
                                        <div class="footer-top-box text-center">
                                            <a href="{{route('myoffers')}}">
                                                <i class="la la-cart-plus"></i>
                                                <h4 class="heading-5">{{__('My Offers')}}</h4>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6">
                                        <div class="footer-top-box text-center">
                                            <a href="{{ route('disputes.index') }}">
                                                <i class="la la-exclamation"></i>
                                                <h4 class="heading-5">{{__('Disputes')}}</h4>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <section class="slice-sm footer-top-bar bg-white">
                            <div class="container sct-inner">
                                <div class="row no-gutters">
                                    <div class="col-lg-3 col-md-6">
                                        <div class="footer-top-box text-center">
                                            <a href="{{route('user.sell-with-us')}}">
                                                <i class="la la-globe"></i>
                                                <h4 class="heading-5">{{__('Selling on eCarto')}}</h4>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6">
                                        <div class="footer-top-box text-center">
                                            <a href="tel:+441415360882">
                                                <i class="la la-phone"></i>
                                                <h4 class="heading-5">{{__('Customer S. Phone')}}</h4>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6">
                                        <div class="footer-top-box text-center">
                                            <a target="_blank" href="/chat/customer-service/help.php" onclick="window.open('chat/customer-service/help.php','USC Chat Widget','width=600,height=600')">
                                                <i class="la la-comments"></i>
                                                <h4 class="heading-5">{{__('Customer S. Chat')}}</h4>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6">
                                        <div class="footer-top-box text-center">
                                            <a href="{{ route('my_addressees') }}">
                                                <i class="la la-home"></i>
                                                <h4 class="heading-5">{{__('My Addresses')}}</h4>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <section class="slice-sm footer-top-bar bg-white">
                            <div class="container sct-inner">
                                <div class="row no-gutters">
                                    <div class="col-lg-3 col-md-6">
                                        <div class="footer-top-box text-center">
                                            <a href="{{route('loyalty.index')}}">
                                                <i class="la la-money"></i>
                                                <h4 class="heading-5">{{__('Loyalty')}}</h4>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6">
 					 <div class="footer-top-box text-center">
                                            <a href="{{route('cashback.index')}}">
                                                <i class="la la-money"></i>
                                                <h4 class="heading-5">{{__('Cashback')}}</h4>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6">
                                        <div class="footer-top-box text-center">
                                            <a href="{{route('customer.raffle.index')}}">
                                                <i class="la la-ticket"></i>
                                                <h4 class="heading-5">{{__('Raffle')}}</h4>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6">
                                        <div class="footer-top-box text-center">
                                            <a href="{{route('customer-feedback.index')}}">
                                                <i class="la la-feed"></i>
                                                <h4 class="heading-5">{{__('Feedback')}}</h4>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-box bg-white mt-4">
                                    <div class="form-box-title px-3 py-2 clearfix ">
                                        {{__('Saved Shipping Info')}}
                                        <div class="float-right">
                                            <a href="{{ route('profile') }}" class="btn btn-link btn-sm">{{__('Edit')}}</a>
                                        </div>
                                    </div>
                                    <div class="form-box-content p-3">
                                        <table>
                                        <tr>
                                                <td>{{__('Name')}}:</td>
                                                <td class="p-2">{{ Auth::user()->name }}</td>
                                            </tr>
                                            <tr>
                                                <td>{{__('Address')}}:</td>
                                                <td class="p-2">{{ Auth::user()->address }}</td>
                                            </tr>

                                            <tr>
                                                <td>{{__('Address 2')}}:</td>
                                                <td class="p-2">{{ Auth::user()->address2 }}</td>
                                            </tr>
                                            <tr>
                                                <td>{{__('City')}}:</td>
                                                <td class="p-2">{{ Auth::user()->city }}</td>
                                            </tr>
                                            <tr>
                                                <td>{{__('Postal Code')}}:</td>
                                                <td class="p-2">{{ Auth::user()->postal_code }}</td>
                                            </tr>
                                            <tr>
                                                <td>{{__('Country')}}:</td>
                                                <td class="p-2">

                                                    @if (Auth::user()->country != null)
                                                         @isset(\App\Country::where('code', Auth::user()->country)->first()->name)
                                                        {{ \App\Country::where('code', Auth::user()->country)->first()->name }}
                                                         @endisset

                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>{{__('Phone')}}:</td>
                                                <td class="p-2">{{ Auth::user()->phone }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-box bg-white mt-4">
                                    <div class="form-box-title px-3 py-2 clearfix ">
                                        {{__('Recently viewed products')}}
                                    </div>
                                    <div class="form-box-content p-3">
                                       <div class="caorusel-box arrow-round gutters-5">
					    <div class="slick-carousel" data-slick-items="1" data-slick-xl-items="1" data-slick-lg-items="1"  data-slick-md-items="1" data-slick-sm-items="1" data-slick-xs-items="1">
					        @if(Cookie::has('user_viwed_products') && Cookie::has('laravel_cookie_consent'))
					            @foreach (json_decode(Cookie::get('user_viwed_products')) as $key => $product_id)
					            @php $product = App\Product::findOrFail($product_id); @endphp
					                <div class="caorusel-card">
					                    <div class="product-card-2 card card-product shop-cards shop-tech">
					                        <div class="card-body p-0">

					                            <div class="card-image">

					                                <a href="{{ route('product', $product->slug) }}" class="d-block">
					                                    <img style="height: 103px;" class="img-fit lazyload mx-auto" src="{{ asset('frontend/images/placeholder.jpg') }}" data-src="{{ asset($product->featured_img) }}" alt="{{ __($product->name) }}">

					                            </div>                     </a>

					                            <div class="p-md-3 p-2">
					                            @if($product->FreeReturn_id)
					                                <div>
					                                <span class="product-label label-hot">{{__('Free Returns')}}</span>
					                                </div>
					                            @endif
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
					            @endforeach
					        @endif
					    </div>
					</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-box bg-white mt-4">
                                    <div class="form-box-title px-3 py-2 clearfix ">
                                        {{__('Purchased Package')}}
                                    </div>
                                    @php
                                        $customer_package = \App\CustomerPackage::find(Auth::user()->customer_package_id);
                                    @endphp
                                    <div class="form-box-content p-3">
                                        @if($customer_package != null)
                                            <div class="form-box-content p-2 category-widget text-center">
                                                <center><img alt="Package Logo" src="{{ asset($customer_package->logo) }}" style="height:100px; width:90px;"></center>
                                                <left> <strong><p>{{__('Product Upload')}}: {{ $customer_package->product_upload }} {{__('Times')}}</p></strong></left>
                                                <strong><p>{{__('Product Upload Remaining')}}: {{ Auth::user()->remaining_uploads }} {{__('Times')}}</p></strong>
                                                <strong><p><div class="name mb-0">{{__('Current Package')}}: {{ $customer_package->name }} <span class="ml-2"><i class="fa fa-check-circle" style="color:green"></i></span></div></p></strong>
                                            </div>
                                        @else
                                            <div class="form-box-content p-2 category-widget text-center">
                                                <center><strong><p>{{__('Package Removed')}}</p></strong></center>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </section>
    <section class="gry-bg profile">
	<div class="container-fluid py-1 p-4">
	    <div class="row cols-xs-space cols-sm-space cols-md-space">

	         <div class="col-lg-12 d-none d-lg-block">
	         	 @if(App\AdvertismentDashboard::first())
	                            {!! App\AdvertismentDashboard::first()->secondAdvertisment !!}
	                @endif
	         </div>
	    </div>
	 </div>
    </section>
@else
    <section class="gry-bg py-4 profile">
        <div class="container-fluid p-4">
            <div class="row cols-xs-space cols-sm-space cols-md-space">
                <div class="col-lg-2-1 d-none d-lg-block">
                    @include('frontend.inc.seller_side_nav')
                </div>

                <div class="col-lg-9">
                    <!-- Page title -->
                    <div class="page-title">
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <h2 class="heading heading-6 text-capitalize strong-600 mb-0">
                                    {{__('Dashboard')}}
                                </h2>
                            </div>
                            <div class="col-md-6">
                                <div class="float-md-right">
                                    <ul class="breadcrumb">
                                        <li><a href="{{ route('home') }}">{{__('Home')}}</a></li>
                                        <li class="active"><a href="{{ route('dashboard') }}">{{__('Dashboard')}}</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- dashboard content -->
                    <div class="">
                        <div class="row">
                            <div class="col-md-3 col-6">
                                <div class="dashboard-widget text-center  mt-4 c-pointer">
                                    <a href="javascript:;" class="d-block">
                                        <i class="fa fa-upload"></i>
                                        <span class="d-block title heading-3 strong-400">{{ count(\App\Product::where('user_id', Auth::user()->id)->get()) }}</span>
                                        <span class="d-block sub-title">{{__('Total Products')}}</span>
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-3 col-6">
                                <div class="dashboard-widget text-center  mt-4 c-pointer">
                                    <a href="javascript:;" class="d-block">
                                        <i class="fa fa-cart-plus"></i>
                                        <span class="d-block title heading-3 strong-400">
                                        <!-- {{ count(\App\OrderDetail::where('seller_id', Auth::user()->id)->where('delivery_status', 'delivered')->get()) }} -->
                                           @php $orderDetails = \App\OrderDetail::where('seller_id', Auth::user()->id)->get(); $total_sales = 0; foreach ($orderDetails as $key => $orderDetail) { if($orderDetail->order->payment_status == 'paid'){$total_sales += ($orderDetail->price  + $orderDetail->shipping_cost); }}@endphp
                                        {{single_price($total_sales)}}
                                        </span>
                                        <span class="d-block sub-title">{{__('Total Sales')}}</span>
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-3 col-6">
                                <div class="dashboard-widget text-center  mt-4 c-pointer">
                                                         <a href="javascript:;" class="d-block">
                                        <i class="fa fa-gbp"></i>
                                        @php
                                            $earning = 0;
                                               $admin_to_pay_extra = App\Seller::findOrFail(Auth::user()->id)->admin_to_pay_extra;
                                            foreach(\App\OrderDetail::where('seller_id', Auth::user()->id)->where('delivery_status','!=','returned')->where('delivery_status','!=','refunded')->where('delivery_status','!=','pending')->get() as $orderDetail){
                                               $earning+= ($orderDetail->price+$orderDetail->shipping_cost + $orderDetail->tax + $orderDetail->commission + $admin_to_pay_extra);

	                                    }
                                        @endphp
                                        <span class="d-block title heading-3 strong-400">{{ single_price($earning) }}</span>
                                        <span class="d-block sub-title">{{__('Total Earnings')}}</span>
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-3 col-6">
                                <div class="dashboard-widget text-center mt-4 c-pointer">
                                    <a href="javascript:;" class="d-block">
                                        <i class="fa fa-check-square-o"></i>
                                        <span class="d-block title heading-3 strong-400">{{ count(\App\OrderDetail::where('seller_id', Auth::user()->id)->where('delivery_status', 'delivered')->get()) }}</span>
                                        <span class="d-block sub-title">{{__('Successful Orders')}}</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="">
                        <div class="row">
                            <div class="col-md-3 col-6">
                                <div class="dashboard-widget text-center mt-4 c-pointer">
                                    <a href="javascript:;" class="d-block">
                                        <i class="fa fa-shopping-basket"></i>
                                        <span class="d-block title heading-3 strong-400">{{ count(\App\OrderDetail::where('seller_id', Auth::user()->id)->get()) }}</span>
                                        <span class="d-block sub-title">{{__('Total Orders')}}</span>
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-3 col-6">
                                <div class="dashboard-widget text-center mt-4 c-pointer">
                                    <a href="javascript:;" class="d-block">
                                        <i class="fa fa-hourglass"></i>
                                        <span class="d-block title heading-3 strong-400">{{ count(\App\OrderDetail::where('seller_id', Auth::user()->id)->where('delivery_status', 'pending')->get()) }}</span>
                                        <span class="d-block sub-title">{{__('Pending Orders')}}</span>
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-3 col-6">
                                <div class="dashboard-widget text-center mt-4 c-pointer">
                                    <a href="javascript:;" class="d-block">
                                        <i class="fa fa-times"></i>
                                        <span class="d-block title heading-3 strong-400">{{ count(\App\OrderDetail::where('seller_id', Auth::user()->id)->where('delivery_status', 'cancelled')->get()) }}</span>
                                        <span class="d-block sub-title">{{__('Cancelled Orders')}}</span>
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-3 col-6">
                                <div class="dashboard-widget text-center mt-4 c-pointer">
                                    <a href="javascript:;" class="d-block">
                                        <i class="fa fa-money"></i>
                                        @if (App\BusinessSetting::where('type', 'category_wise_commission')->first()->value != 1) {
                                        @php
                                         $commission =  App\BusinessSetting::where('type','vendor_commission')->first('value');
                                         $commission_pay =  App\BusinessSetting::where('type','payment_commission')->first('value');
                                        @endphp
                                           <span class="d-block title heading-3 strong-400">{{$commission->value}} + {{$commission_pay->value}} = {{$commission->value + $commission_pay->value}}%</span>
                                           <span class="d-block sub-title">{{__('Commission + Processing Fee')}}</span>
                                         @else
                                           <span class="d-block title heading-3 strong-400"><a href="{{route('seller.categories.commission')}}" class="btn btn-primary text-white btn-sm mb-1">{{__('Commission')}}</a></span>
                                        <span class="d-block sub-title">{{__('Commission + Processing Fee')}}</span>
                                        @endif
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-5">
                                @php
                                $orders = DB::table('orders')
                                            ->orderBy('code', 'desc')
                                            ->join('order_details', 'orders.id', '=', 'order_details.order_id')
                                            ->where('order_details.seller_id', Auth::user()->id)
                                            ->where('orders.viewed', 0)
                                            ->select('orders.id')
                                            ->distinct()
                                            ->count();
                            @endphp
                                <div class="bg-white mt-4 p-4 text-center">
                                    <div class="heading-4 strong-700">{{__('Orders')}}</div>
                                    <a href="{{ route('orders.index') }}" class="btn btn-styled btn-base-1 btn-outline btn-sm">{{__('Orders ')}}
                                        @if($orders > 0)<span class="ml-2" style="color:green"><strong>({{ $orders }} {{ __('New') }})</strong></span></span>@endif
                                    </a>

                                </div>
                                <div class="bg-white mt-2 p-5 text-center">
                                    <div class="mb-3">
                                        @if(Auth::user()->seller->verification_status == 0)
                                            <img loading="lazy"  src="{{ asset('frontend/images/icons/non_verified.png') }}" alt="" width="130">
                                        @else
                                            <img loading="lazy"  src="{{ asset('frontend/images/icons/verified.png') }}" alt="" width="130">
                                        @endif
                                    </div>
                                    @if(Auth::user()->seller->verification_status == 0)
                                        <a href="{{ route('shop.verify') }}" class="btn btn-styled btn-base-1">{{__('Verify Now')}}</a>
                                    @endif
                                </div>

                            </div>
                            <div class="col-md-7">
                                <div class="form-box bg-white mt-4">
                                    <div class="form-box-title px-3 py-2 text-center">
                                        {{__('Orders')}}
                                    </div>
                                    <div class="form-box-content p-3">
                                        <table class="table mb-0 table-bordered" style="font-size:14px;">
                                            <tr>
                                                <td>{{__('Total orders')}}:</td>
                                                <td><strong class="heading-6">{{ count(\App\OrderDetail::where('seller_id', Auth::user()->id)->get()) }}</strong></td>
                                            </tr>
                                            <tr >
                                                <td>{{__('Pending orders')}}:</td>
                                                <td><strong class="heading-6">{{ count(\App\OrderDetail::where('seller_id', Auth::user()->id)->where('delivery_status', 'pending')->get()) }}</strong></td>
                                            </tr>
                                            <tr >
                                                <td>{{__('Cancelled orders')}}:</td>
                                                <td><strong class="heading-6">{{ count(\App\OrderDetail::where('seller_id', Auth::user()->id)->where('delivery_status', 'cancelled')->get()) }}</strong></td>
                                            </tr>
                                            <tr >
                                                <td>{{__('Successful orders')}}:</td>
                                                <td><strong class="heading-6">{{ count(\App\OrderDetail::where('seller_id', Auth::user()->id)->where('delivery_status', 'delivered')->get()) }}</strong></td>
                                            </tr>
                                            <tr >
                                                <td>{{__('Return orders')}}:</td>
                                                <td><strong class="heading-6">{{ count(\App\OrderDetail::where('seller_id', Auth::user()->id)->where('delivery_status', 'returned')->get()) }}</strong></td>
                                            </tr>
                                            <tr >
                                                <td>{{__('Refund orders')}}:</td>
                                                <td><strong class="heading-6">{{ count(\App\OrderDetail::where('seller_id', Auth::user()->id)->where('delivery_status','Refund Processing')->orwhere('delivery_status', 'Refunded (Partial Refund)')->orwhere('delivery_status', 'refunded')->get()) }}</strong></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                                    </br>
                        <section class="slice-sm footer-top-bar bg-white">
                            <div class="container sct-inner">
                                <div class="row no-gutters">
                                    <div class="col-lg-3 col-md-6">
                                        <div class="footer-top-box text-center">
                                            <a href="{{ route('sellerpolicy') }}">
                                                <i class="la la-file-text"></i>
                                                <h4 class="heading-5">{{__('Seller Policy')}}</h4>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6">
                                        <div class="footer-top-box text-center">
                                            <a href="{{ route('returnpolicy') }}">
                                                <i class="la la-exchange"></i>
                                                <h4 class="heading-5">{{__('Return Policy')}}</h4>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6">
                                        <div class="footer-top-box text-center">
                                            <a href="{{ route('supportpolicy') }}">
                                                <i class="la la-support"></i>
                                                <h4 class="heading-5">{{__('Support Policy')}}</h4>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6">
                                        <div class="footer-top-box text-center">
                                            <a href="{{ route('terms') }}">
                                                <i class="la la-dashboard"></i>
                                                <h4 class="heading-5">{{__('Terms & Conditions')}}</h4>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <section class="slice-sm footer-top-bar bg-white">
                            <div class="container sct-inner">
                                <div class="row no-gutters">
                                    <div class="col-lg-3 col-md-6">
                                        <div class="footer-top-box text-center">
                                            <a href="{{ route('sellerpolicy') }}">
                                                <i class="la la-user-secret"></i>
                                                <h4 class="heading-5">{{__('Privacy Policy')}}</h4>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6">
                                        <div class="footer-top-box text-center">
                                            <a href="{{ route('returnpolicy') }}">
                                                <i class="la la-history"></i>
                                                <h4 class="heading-5">{{__('Refund Policy')}}</h4>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6">
                                        <div class="footer-top-box text-center">
                                            <a href="{{ route('supportpolicy') }}">
                                                <i class="la la-file-o"></i>
                                                <h4 class="heading-5">{{__('Selling Policy')}}</h4>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6">
                                        <div class="footer-top-box text-center">
                                            <a href="{{ route('terms') }}">
                                                <i class="la la-list"></i>
                                                <h4 class="heading-5">{{__('Listing Policy')}}</h4>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <section class="slice-sm footer-top-bar bg-white">
                            <div class="container sct-inner">
                                <div class="row no-gutters">
                                    <div class="col-lg-3 col-md-6">
                                        <div class="footer-top-box text-center">
                                            <a href="{{ route('promoteproducts') }}">
                                                <i class="la la-bullhorn"></i>
                                                <h4 class="heading-5">{{__('Promote Products')}}</h4>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6">
                                        <div class="footer-top-box text-center">
                                            <a href="{{route('seller.subscription_seller')}}">
                                                <i class="la la-bank"></i>
                                                <h4 class="heading-5">{{__('Shop Subscription')}}</h4>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6">
                                        <div class="footer-top-box text-center">
                                            <a href="{{ route('seller.flashDeal') }}">
                                                <i class="la la-bolt"></i>
                                                <h4 class="heading-5">{{__('Flash Deals')}}</h4>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6">
                                        <div class="footer-top-box text-center">
                                            <a href="{{route('register-a-Brand')}}">
                                                <i class="la la-plus-circle"></i>
                                                <h4 class="heading-5">{{__('Register Your Brand')}}</h4>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <section class="slice-sm footer-top-bar bg-white">
                            <div class="container sct-inner">
                                <div class="row no-gutters">
                                    <div class="col-lg-3 col-md-6">
                                        <div class="footer-top-box text-center">
                                            <a href="{{ route('return_address.index') }}">
                                                <i class="la la-mail-reply"></i>
                                                <h4 class="heading-5">{{__('Return Address')}}</h4>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6">
                                        <div class="footer-top-box text-center">
                                            <a href="/return_requests">
                                                <i class="la la-random"></i>
                                                <h4 class="heading-5">{{__('Return Request')}}</h4>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6">
                                        <div class="footer-top-box text-center">
                                            <a href="./cancellation_requests">
                                                <i class="la la-times-circle"></i>
                                                <h4 class="heading-5">{{__('Order Cancellation')}}</h4>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6">
                                        <div class="footer-top-box text-center">
                                            <a href="{{ route('disputes.index') }}">
                                                <i class="la la-exclamation"></i>
                                                <h4 class="heading-5">{{__('Dispute')}}</h4>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <section class="slice-sm footer-top-bar bg-white">
                            <div class="container sct-inner">
                                <div class="row no-gutters">
                                    <div class="col-lg-3 col-md-6">
                                        <div class="footer-top-box text-center">
                                            <a href="{{ route('sellerpolicy') }}">
                                                <i class="la la-gamepad"></i>
                                                <h4 class="heading-5">{{__('Apps & Games')}}</h4>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6">
                                        <div class="footer-top-box text-center">
                                            <a href="{{ route('returnpolicy') }}">
                                                <i class="la la-gears"></i>
                                                <h4 class="heading-5">{{__('API  Credentials')}}</h4>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6">
                                        <div class="footer-top-box text-center">
                                            <a href="{{ route('make-suggestion') }}">
                                                <i class="la la-info-circle"></i>
                                                <h4 class="heading-5">{{__('Make A Suggestion')}}</h4>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6">
                                        <div class="footer-top-box text-center">
                                            <a href="{{route('sellernotes.index')}}">
                                                <i class="la la-save"></i>
                                                <h4 class="heading-5">{{__('Save Notes')}}</h4>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <section class="slice-sm footer-top-bar bg-white">
                            <div class="container sct-inner">
                                <div class="row no-gutters">
                                    <div class="col-lg-3 col-md-6">
                                        <div class="footer-top-box text-center">
                                            <a href="{{ route('accountHealth') }}">
                                                <i class="la la-heartbeat"></i>
                                                <h4 class="heading-5">{{__('Account Health')}}</h4>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6">
                                        <div class="footer-top-box text-center">
                                            <a href="{{ route('my_addressees') }}">
                                                <i class="la la-home"></i>
                                                <h4 class="heading-5">{{__('My Addresses')}}</h4>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6">
                                        <div class="footer-top-box text-center">
                                            <a href="{{ route('create-coupons') }}">
                                                <i class="la la-gift"></i>
                                                <h4 class="heading-5">{{__('Create Coupons')}}</h4>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6">
                                        <div class="footer-top-box text-center">
                                            <a href="{{route('add-a-Brand')}}">
                                                <i class="la la-plus-circle"></i>
                                                <h4 class="heading-5">{{__('Add A Brand')}}</h4>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <section class="slice-sm footer-top-bar bg-white">
                            <div class="container sct-inner">
                                <div class="row no-gutters">
                                    <div class="col-lg-3 col-md-6">
                                        <div class="footer-top-box text-center">
                                            <a href="{{ route('manage-ads') }}">
                                                <i class="la la-bar-chart-o"></i>
                                                <h4 class="heading-5">{{__('Manage My Ads')}}</h4>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6">
                                        <div class="footer-top-box text-center">
                                            <a href="{{ route('returnpolicy') }}">
                                                <i class="la la-group"></i>
                                                <h4 class="heading-5">{{__('Affiliate Program')}}</h4>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6">
                                        <div class="footer-top-box text-center">
                                            <a href="{{route('submit-offers')}}">
                                                <i class="la la-cart-plus"></i>
                                                <h4 class="heading-5">{{__('Submit Offers')}}</h4>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6">
                                        <div class="footer-top-box text-center">
                                            <a href="#">
                                            <label class="switch">
                                            <input type="checkbox" onchange="updateSellerSettings()" {{\App\SellerSettings::where('seller_id', \Illuminate\Support\Facades\Auth::user()->id)->exists() ? "checked" : ""}}>
                                            <span class="slider round"></span>
                                        </label>
                                            <h4 class="heading-5">{{__('Holiday & Shop Maintenance Mode')}}</h4>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <section class="slice-sm footer-top-bar bg-white">
                            <div class="container sct-inner">
                                <div class="row no-gutters">
                                    <div class="col-lg-3 col-md-6">
                                        <div class="footer-top-box text-center">
                                            <a href="{{ route('seller-forum') }}">                       <i class="la la-comment"></i>
                                                <h4 class="heading-5">{{__('Seller Forum')}}</h4>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6">
                                        <div class="footer-top-box text-center">
                                            <a href="tel:+441415360882">
                                                <i class="la la-phone"></i>
                                                <h4 class="heading-5">{{__('Seller Support Phone')}}</h4>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6">
                                        <div class="footer-top-box text-center">
                                            <a target="_blank" href="/chat/seller-support/help.php" onclick="window.open('chat/seller-support/help.php','USC Chat Widget','width=600,height=600')">
                                                <i class="la la-comments"></i>
                                                <h4 class="heading-5">{{__('Seller Support Chat')}}</h4>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6">
                                        <div class="footer-top-box text-center">
                                            <a href="{{ route('news-updates') }}">
                                                <i class="la la-bell"></i>
                                                <h4 class="heading-5">{{__('News & Updates')}}</h4>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <section class="slice-sm footer-top-bar bg-white">
                            <div class="container sct-inner">
                                <div class="row no-gutters">
                                    <div class="col-lg-3 col-md-6">
                                        <div class="footer-top-box text-center">
                                            <a href="{{ route('shipping-companies') }}">
                                                <i class="la la-building"></i>
                                                <h4 class="heading-5">{{__('Shipping Companies')}}</h4>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6">
                                        <div class="footer-top-box text-center">
                                            <a href="{{ route('shipping-countries.index') }}">
                                                <i class="la la-globe"></i>
                                                <h4 class="heading-5">{{__('Shipping Countries')}}</h4>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6">
                                        <div class="footer-top-box text-center">
                                            <a href="{{ route('import_data.index') }}">
                                                <i class="la la-cloud-download"></i>
                                                <h4 class="heading-5">{{__('Import Data')}}</h4>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6">
                                        <div class="footer-top-box text-center">
                                            <a href="{{ route('feedbacks.seller') }}">
                                                <i class="la la-feed"></i>
                                                <h4 class="heading-5">{{__('Feedback')}}</h4>
                                            </a>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </section>
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-box bg-white mt-4">
                                    <div class="form-box-title px-3 py-2 text-center">
                                        {{__('Products')}}
                                    </div>
                                    <div class="form-box-content p-3 category-widget">
                                        <ul class="clearfix">
                                            @foreach (\App\Category::all() as $key => $category)
                                                @if(count($category->products->where('user_id', Auth::user()->id))>0)
                                                    <li><a>{{ __($category->name) }}<span>({{ count($category->products->where('user_id', Auth::user()->id)) }})</span></a></li>
                                                @endif
                                            @endforeach
                                        </ul>
                                        <div class="text-center">
                                            <a href="{{ route('seller.products.upload')}}" class="btn pt-3 pb-1">{{__('Add New Product')}}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="bg-white mt-4 p-4 text-center">
                                    <div class="heading-4 strong-700">{{__('Shop')}}</div>
                                    <p>{{__('Manage & organize your shop')}}</p>
                                    <a href="{{ route('shops.index') }}" class="btn btn-styled btn-base-1 btn-outline btn-sm">{{__('Go to setting')}}</a>
                                </div>
                                <div class="bg-white mt-4 p-4 text-center">
                                    <div class="heading-4 strong-700">{{__('Payment')}}</div>
                                    <p>{{__('Configure your payment method')}}</p>
                                    <a href="{{ route('profile') }}" class="btn btn-styled btn-base-1 btn-outline btn-sm">{{__('Configure Now')}}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
      <section class="gry-bg profile">
	<div class="container-fluid py-1 p-4">
	    <div class="row cols-xs-space cols-sm-space cols-md-space">

	         <div class="col-lg-12 d-none d-lg-block">
	         	 @if(App\AdvertismentDashboard::first())
	                            {!! App\AdvertismentDashboard::first()->secondAdvertisment !!}
	                @endif
	         </div>
	    </div>
	 </div>
    </section>

    @include('frontend.partials.forms')


<script>
    function updateSellerSettings() {
        $.post('{{ route('seller.settings_update') }}',{_token:'{{ @csrf_token() }}'}, function(data){
                window.location.reload();
        });
    }
</script>

@endif
@endsection
