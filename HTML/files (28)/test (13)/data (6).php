@extends('frontend.layouts.app')

@section('content')

    <section class="gry-bg py-4 profile">
        <div class="container">
            <div class="row cols-xs-space cols-sm-space cols-md-space">
                <div class="col-lg-3 d-none d-lg-block">
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
                                        <span class="d-block title heading-3 strong-400">{{ count(\App\OrderDetail::where('seller_id', Auth::user()->id)->where('delivery_status', 'delivered')->get()) }}</span>
                                        <span class="d-block sub-title">{{__('Total Sales')}}</span>
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-3 col-6">
                                <div class="dashboard-widget text-center  mt-4 c-pointer">
                                    <a href="javascript:;" class="d-block">
                                        <i class="fa fa-gbp"></i>
                                        @php
                                            $orderDetails = \App\OrderDetail::where('seller_id', Auth::user()->id)->get();
                                            $total = 0;
                                            foreach ($orderDetails as $key => $orderDetail) {
                                                if($orderDetail->order->payment_status == 'paid'){
                                                    $total += $orderDetail->price;
                                                }
                                            }
                                        @endphp
                                        <span class="d-block title heading-3 strong-400">{{ single_price($total) }}</span>
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
                                        <span class="d-block title heading-3 strong-400">10%</span>
                                        <span class="d-block sub-title">{{__('Seller Commission')}}</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="row">
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
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="bg-white mt-4 p-5 text-center">
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
                    <a href="{{ route('supportpolicy') }}">
                        <i class="la la-bolt"></i>
                        <h4 class="heading-5">{{__('Flash Deals')}}</h4>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="footer-top-box text-center">
                    <a href="{{ route('terms') }}">
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
                    <a href="{{ route('sellerpolicy') }}">
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
                    <a href="/cancellation_requests">
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
                    <a href="{{ route('supportpolicy') }}">
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
                    <a href="{{ route('returnpolicy') }}">
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
                    <a href="{{ route('terms') }}">
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
                    <a href="{{ route('supportpolicy') }}">
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

<script>
    function updateSellerSettings() {
        $.post('{{ route('seller.settings_update') }}',{_token:'{{ @csrf_token() }}'}, function(data){
                window.location.reload();
        });
    }
</script>

@endsection

