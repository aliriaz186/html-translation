@extends('frontend.layouts.app')


@section('meta_title'){{ $detailedProduct->meta_title }}@stop

@section('meta_description'){{ $detailedProduct->meta_description }}@stop

@section('meta_keywords'){{ $detailedProduct->tags }}@stop

	    <style>
		.color_red{color:red !important;}    
		.add_to{width: 86%;}
		.add_to i{font-size: 29px;}
		.add_to strong{font-size: 10px;} 
		.add_to .footer-top-box {padding:0px !important; padding-top: 20px !important;}
	    </style>    


@section('meta')

    <!-- Schema.org markup for Google+ -->
    <meta itemprop="name" content="{{ $detailedProduct->meta_title }}">
    <meta itemprop="description" content="{{ $detailedProduct->meta_description }}">
    <meta itemprop="image" content="{{ asset($detailedProduct->meta_img) }}">

    <!-- Twitter Card data -->
    <meta name="twitter:card" content="product">
    <meta name="twitter:site" content="@publisher_handle">
    <meta name="twitter:title" content="{{ $detailedProduct->meta_title }}">
    <meta name="twitter:description" content="{{ $detailedProduct->meta_description }}">
    <meta name="twitter:creator" content="@author_handle">
    <meta name="twitter:image" content="{{ asset($detailedProduct->meta_img) }}">
    <meta name="twitter:data1" content="{{ single_price($detailedProduct->unit_price) }}">
    <meta name="twitter:label1" content="Price">

    <!-- Open Graph data -->
    <meta property="og:title" content="{{ $detailedProduct->meta_title }}" />
    <meta property="og:type" content="product" />
    <meta property="og:image" content="{{ asset($detailedProduct->meta_img) }}" />
    <meta property="og:description" content="{{ $detailedProduct->meta_description }}" />
    <meta property="og:site_name" content="{{ env('APP_NAME') }}" />
    <meta property="og:price:amount" content="{{ single_price($detailedProduct->unit_price) }}" />
@endsection

@section('content')
    <!-- SHOP GRID WRAPPER -->
    <section class="product-details-area gry-bg p-0">
        <div class="container-fluid">
         
            @isset(App\ads::first()->firstAd)
                <div> {!! App\ads::first()->firstAd !!} <br> </div>
            @endisset
            <div class="bg-white">
                <!-- Product gallery and Description -->
                <div class="row no-gutters cols-xs-space cols-sm-space cols-md-space">
                    <div class="col-lg-5 pl-2">
                        <div class="product-gal sticky-top d-flex flex-row-reverse">
                            @if(is_array(json_decode($detailedProduct->photos)) && count(json_decode($detailedProduct->photos)) > 0)
                                <div class="product-gal-img">
                                    <div class="prod_image">
                                        <img style="border:1px dashed gray" id="thumbnailImage"  onclick="changeImage()"   src="{{ asset('frontend/images/placeholder.jpg') }}" class="xzoom img-fluid lazyload" src="{{ asset('frontend/images/placeholder.jpg') }}" data-src="{{ asset(json_decode($detailedProduct->photos)[0]) }}" xoriginal="{{ asset(json_decode($detailedProduct->photos)[0]) }}" />
                                    </div>
                                    <div class="product-gal-thumb">
                                         <div class="caorusel-box arrow-round gutters-5 mt-3" style="height:14vh">
                                            <div class="slick-carousel" data-slick-items="6" data-slick-xl-items="5" data-slick-lg-items="4"  data-slick-md-items="3" data-slick-sm-items="2" data-slick-xs-items="2">
                                                @foreach (json_decode($detailedProduct->photos) as $key => $photo)
                                                <div class="caorusel-card">
                                                    <div class="product-card-2 card card-product shop-cards shop-tech">
                                                        <div class="card-body p-0">
                                                            <div class="card-image">
                                                                <a href="{{ asset($photo) }}" class="d-block">
                                                                    <img style="height: 13vh" src="{{ asset('frontend/images/placeholder.jpg') }}" class="xzoom-gallery lazyload more_images" src="{{ asset('frontend/images/placeholder.jpg') }}" width="80" data-src="{{ asset($photo) }}"  @if($key == 0) xpreview="{{ asset($photo) }}" @endif>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class ={{(isset(App\ads::first()->secondAd) || isset(App\ads::first()->thirdAd) || App\ProductBuyerTips::where('status',1)->first())? "col-lg-5" :"col-lg-6"}}>
                        <!-- Product description -->
                        <div class="product-description-wrapper">
                            <!-- Product title -->
                            <h1 class="product-title mb-2">
                                {{ __($detailedProduct->name) }}
                            </h1>

                            <div class="row align-items-center my-1">
                                <div class="col-10">
                                    <!-- Rating stars -->
                                    <div class="rating">
                                        @php
                                            $total = 0;
                                            $total += $detailedProduct->reviews->count();
                                        @endphp
                                        <span class="star-rating">
                                       @if($detailedProduct->brand)  Brand:  <a href="{{ route('products.brand.shop', [$detailedProduct->user->shop->slug,$detailedProduct->brand->slug,$detailedProduct->user->shop->id]) }}"> {{$detailedProduct->brand->name}}</a> | @endif {{ renderStarRating($detailedProduct->rating) }}
                                       </span>
                                        <span class="rating-count ml-1">({{ $total }} {{__('reviews')}}) |
                                        @if (\App\BusinessSetting::where('type', 'product_query')->first()->value == 1)
                                           <a  onclick="activaTab('tab_default_8')" href="#tab_default_8" >{{__('Ask a question')}}</a>
                                        @endif
                                    </span>
                                    </div>
                                </div>
                                <div class="col-2 text-right">
                                    <ul class="inline-links inline-links--style-1">
                                        @php
                                            $qty = 0;
                                            $min_stock = 0;
                                            $max_stock = 0;
                                            if($detailedProduct->variant_product){
                                                foreach ($detailedProduct->wholesale_stocks as $key => $stock) {
                                                    $qty += $stock->qty;
                                                    $min_stock += $stock->min_stock;
                                                    $max_stock += $stock->max_stock;
                                                }
                                            }
                                            else{
                                                $qty = $detailedProduct->current_stock;
                                                $min_stock = $detailedProduct->min_stock;
                                                $max_stock = $detailedProduct->max_stock;
                                                
                                            }
                                        @endphp
                                        @if ($qty > 0)
                                            <li>
                                                <span class="badge badge-md badge-pill bg-green">{{__('In stock')}}</span>
                                            </li>
                                        @else
                                            <li>
                                                <span class="badge badge-md badge-pill bg-red">{{__('Out of stock')}}</span>
                                            </li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                            <br>
                            <div class="row align-items-center">
                                <div class="sold-by col-auto">
                                    <small class="mr-2">{{__('Sold by')}}: </small><br>
                                    @if ( \App\BusinessSetting::where('type', 'vendor_system_activation')->first()->value == 1)
                                        <a href="{{ route('shop.visit', $detailedProduct->user->shop->slug) }}">{{ $detailedProduct->user->name }} <i class="la la-home"></i></a>
                                        <span class="star-rating star-rating-sm d-block">
                                                @php
                                                    $rating = App\SellerFeedback::where('seller_id',$detailedProduct->user->id)->avg('rating');
                                                @endphp
                                                @if ($rating > 0)
                                                    {{ renderStarRating($rating) }}  {{Seller_average_percentage($detailedProduct->user->id)}}%
                                                @else
                                                    {{ renderStarRating(0) }}  {{Seller_average_percentage($detailedProduct->user->id)}}%
                                                @endif
                                        </span>
                                    @endif
                                </div>
                                 @if (\App\BusinessSetting::where('type', 'conversation_system')->first()->value == 1)
                                       <div class="col-auto">
                                        	<button class="btn btn-styled btn-base-1 btn-circle" onclick="show_chat_modal()">{{__('Message Seller')}}</button>
                              		</div>
                                @endif
                            </div>
                            <br>
                            @php $nintyDayPassed = Carbon\Carbon::parse($detailedProduct->updated_at);
                                $nintyDayPassed = $nintyDayPassed->addMonths(3);
                                $today = Carbon\Carbon::now();
                            @endphp
                            
                                
                            @if(home_price($detailedProduct->id) != home_discounted_price($detailedProduct->id) && ($today->greaterThan($nintyDayPassed) && (App\OrderDetail::where('product_id',$detailedProduct->id)->count()>20)))
                                
                                <div class="row no-gutters mt-4">
                                    <div class="col-2">
                                        <div class="product-description-label">{{__('Price')}}:</div>
                                    </div>
                                    <div class="col-10">
                                        <div class="product-price-old">
                                            <del>
                                                {{ home_price($detailedProduct->id) }}
                                                <span>/{{ $detailedProduct->unit }}</span>
                                            </del>
                                        </div>
                                    </div>
                                </div>

                                <div class="row no-gutters mt-3">
                                    <div class="col-2">
                                        <div class="product-description-label mt-1">{{__('Discount Price')}}:</div>
                                    </div>
                                    <div class="col-10">
                                        <div class="product-price">
                                            <strong>
                                                {{ home_discounted_price($detailedProduct->id) }}
                                            </strong>
                                            <span class="piece">/{{ $detailedProduct->unit }}</span>
                                        </div>
                                    </div>
                                </div>
                            @else
                           
                                <div class="row no-gutters mt-3">
                                    <div class="col-2">
                                        <div class="product-description-label">{{__('Price')}}:</div>
                                    </div>
                                    <div class="col-10">
                                        <div class="product-price">
                                            <strong>
                                                {{ home_discounted_price($detailedProduct->id) }}
                                            </strong>
                                            <span class="piece">/{{ $detailedProduct->unit }}</span>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            @if (\App\Addon::where('unique_identifier', 'club_point')->first() != null && \App\Addon::where('unique_identifier', 'club_point')->first()->activated && $detailedProduct->earn_point > 0)
                                <div class="row no-gutters mt-4">
                                    <div class="col-2">
                                        <div class="product-description-label">{{ __('Club Point') }}:</div>
                                    </div>
                                    <div class="col-10">
                                        <div class="d-inline-block club-point bg-soft-base-1 border-light-base-1 border">
                                            <span class="strong-700">{{ $detailedProduct->earn_point }}</span>
                                        </div>
                                    </div>
                                </div>
                            @endif
			                @php
                            $shipping_courier_date = 0;
                            foreach (json_decode($detailedProduct->shipping_type) as $ship_type){
                                if(explode('--',$ship_type)[0] == 'courier'){
                                    $shipping_courier_date = 1;
                                    break;
                                }
                            }
                           @endphp
                            <br>
                           @if($shipping_courier_date)
                                @foreach(json_decode($detailedProduct->default_courier_company) as $defaults_selected_courier)
                                   @php  $defaults_selected_courier = explode('__',$defaults_selected_courier); $default_company_country = $defaults_selected_courier[0]; $default_company_id = $defaults_selected_courier[1]; $default =  App\Shipping::findOrFail($default_company_id);  $default_country_set_by_admin =  App\Country::where('default',1)->first() @endphp
                                 @if($default->premium == 'on')
                                            <div class="row no-gutters pb-3">
                                                <div class="col-md-12">
                                                    <p class="fast">{{PremiumShipping()[0]}}<span  id="demo"></span>{{PremiumShipping()[1]}}</p>
                                                </div>
                                            </div>
                                            <br>
                                @else
                                    @if(str_replace(' ','_',$default_country_set_by_admin->name) ==  $default_company_country)
                                        <div class="row no-gutters mb-2">
                                            <div class="col-2">
                                                <div class="product-description-label">{{__('Shipping Country:')}}</div>
                                            </div>
                                            <div class="col-5">
                                                <select class="form-control selectpicker" data-placeholder="Select a country" onchange="getCountryNonPremiumData(this)">
                                                    @foreach(App\Country::all() as $country)
                                                        <option {{$country->name==$default_country_set_by_admin->name?'selected':''}} value="{{$country->id}}">{{str_replace('_',' ',$country->name)}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row no-gutters mb-2">
                                            <div class="col-2">
                                                <div class="product-description-label">{{__('Estimated Delivery:')}}</div>
                                            </div>
                                            <div class="col-5">
                                                <div class="text-success font-weight-bold">
                                                    <strong class="font-weight-bold" style="font-size:1rem;">
                                                        <span id="estimated_by">{{ explode('##',NonPremiumShipping($default))[0]}} </span>  <span id="estimated_to">{{ explode('##',NonPremiumShipping($default))[1] }} </span>
                                                    </strong>
                                                </div>
                                            </div>
                                        </div>
                                        @break
                                    @else
                                       <div class="row no-gutters mb-2">
                                            <div class="col-2">
                                                <div class="product-description-label">{{__('Shipping Country:')}}</div>
                                            </div>
                                            <div class="col-5">
                                                <select class="form-control selectpicker" data-placeholder="Select a country" onchange="getCountryNonPremiumData(this)">
                                                    @foreach(App\Country::all() as $country)
                                                        <option {{$country->name==$default_country_set_by_admin->name?'selected':''}} value="{{$country->id}}">{{str_replace('_',' ',$country->name)}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row no-gutters mb-2">
                                            <div class="col-2">
                                                <div class="product-description-label">{{__('Estimated Delivery Date:')}}</div>
                                            </div>
                                            <div class="col-5">
                                                <div class="text-success font-weight-bold">
                                                    <strong class="font-weight-bold"  style="font-size:1rem;">
                                                        <span>{{__('We don\'t ship to')}}</span>  <span> {{$default_country_set_by_admin->name}} </span>
                                                    </strong>
                                                </div>
                                            </div>

                                        </div>
                                        @break
                                    @endif
                                @endif
                                 @endforeach
                            @endif
                            <form id="option-choice-form-wholesale">
                                @csrf
                                <input type="hidden" name="id" value="{{ $detailedProduct->id }}">
                                <input type="hidden" name="wholesale" value="wholesale">
                                @foreach (json_decode($detailedProduct->choice_options) as $key => $choice)
                                <div class="row no-gutters">
                                    <div class="col-2">
                                        <div class="product-description-label mt-2 ">{{ \App\Attribute::find($choice->attribute_id)->name }}:</div>
                                    </div>
                                    <div class="col-10">
                                        <ul class="list-inline checkbox-alphanumeric checkbox-alphanumeric--style-1 mb-2">
                                            @foreach ($choice->values as $key => $value)
                                                <li>
                                                    <input type="radio" id="{{ $choice->attribute_id }}-{{ $value }}" name="attribute_id_{{ $choice->attribute_id }}" value="{{ $value }}" @if($key == 0) checked @endif>
                                                    <label for="{{ $choice->attribute_id }}-{{ $value }}">{{ $value }}</label>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                                @endforeach
                                @if (count(json_decode($detailedProduct->colors)) > 0)
                                    <div class="row no-gutters">
                                        <div class="col-2">
                                            <div class="product-description-label mt-2">{{__('Color')}}:</div>
                                        </div>
                                        <div class="col-10">
                                            <ul class="list-inline checkbox-color mb-1">
                                                @foreach (json_decode($detailedProduct->colors) as $key => $color)
                                                    <li>
                                                        <input type="radio" id="{{ $detailedProduct->id }}-color-{{ $key }}" name="color" value="{{ $color }}" @if($key == 0) checked @endif>
                                                        <label style="background: {{ $color }};" for="{{ $detailedProduct->id }}-color-{{ $key }}" data-toggle="tooltip"></label>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                    <br>
                                @endif

                                <!-- Quantity + Add to cart -->
                                <div class="row no-gutters">
                                    <div class="col-2">
                                        <div class="product-description-label mt-2">{{__('Quantity')}}:</div>
                                    </div>
                                    <div class="col-10">
                                        <div class="product-quantity d-flex align-items-center">
                                            <div class="input-group input-group--style-2 pr-3" style="width: 160px;">
                                                <span class="input-group-btn">
                                                    <button class="btn btn-number" type="button" data-type="minus" data-field="quantity" disabled="disabled">
                                                        <i class="la la-minus"></i>
                                                    </button>
                                                </span>
                                                <input type="text" name="quantity" id="min_stock_wholesale" class="form-control input-number text-center" placeholder="1" value="{{$min_stock}}" min="{{$min_stock}}" max="{{$max_stock}}">
                                                <span class="input-group-btn">
                                                    <button class="btn btn-number" type="button" data-type="plus" data-field="quantity">
                                                        <i class="la la-plus"></i>
                                                    </button>
                                                </span>
                                            </div>
                                            <div class="avialable-amount">(<span id="available-quantity">{{ $qty }}</span> {{__('available')}})</div>
                                        </div>
                                    </div>
                                </div>

                                <br>
                                <div class="row no-gutters pb-3 d-none" id="chosen_price_div">
                                    <div class="col-2">
                                        <div class="product-description-label">{{__('Total Price')}}:</div>
                                    </div>
                                    <div class="col-10">
                                        <div class="product-price">
                                            <strong id="chosen_price">

                                            </strong>
                                        </div>
                                    </div>
                                </div>
                            </form>

                            <div class="d-table width-100 mt-3">
                                <div class="d-table-cell">
                                    <!-- Buy Now button -->
                                    @if ($qty > 0)
                                        <button type="button" class="btn btn-styled btn-base-1 btn-icon-left strong-700 hov-bounce hov-shaddow buy-now" onclick="buyNow()">
                                            <i class="la la-shopping-cart"></i> {{__('Buy Now')}}
                                        </button>
                                        <button type="button" class="btn btn-styled btn-alt-base-1 c-white btn-icon-left strong-700 hov-bounce hov-shaddow ml-2 add-to-cart" onclick="addToCart()">
                                            <i class="la la-shopping-cart"></i>
                                            <span class="d-none d-md-inline-block"> {{__('Add to cart')}}</span>
                                        </button>
                                    @else
                                        <button type="button" class="btn btn-styled btn-base-3 btn-icon-left strong-700" disabled>
                                            <i class="la la-cart-arrow-down"></i> {{__('Out of Stock')}}
                                        </button>
                                    @endif
                                </div>
                            </div>
                       <div class="row add_to">
                                <div class="col-lg-3 col-md-6 cursor"  onclick="addToWishList({{ $detailedProduct->id }})">
                                        <div class="footer-top-box text-center">
                                            <a>
                                                <i class="la la-heart-o"></i>
                                               <p><strong class="text-primary">{{__('Add to wishlist')}}</strong></p>
                                            </a>
                                        </div>
                                </div>
                                <div class="col-lg-3 col-md-6 cursor" onclick="addToCompare({{ $detailedProduct->id }})">       
                                        <div class="footer-top-box text-center">
                                            <a>
                                                <i class="la la-refresh"></i>
                                                <p> <strong class="text-primary">{{__('Add to compare')}}</strong></p>
                                            </a>
                                        </div>
                                </div>
                                <div class="col-lg-3 col-md-6 cursor" onclick="addToBestSeller({{ $detailedProduct->user->id }})">       
                                        <div class="footer-top-box text-center">
                                            <a >
                                                <i class="la la-user"></i>
                                                 <p><strong class="text-primary">{{__('Save this seller')}}</strong></p>
                                            </a>
                                        </div>
                                </div>
                        </div>  
                           <div class="row no-gutters mt-3">
                                <div class="col-2">
                                    <div class="product-description-label alpha-6">{{__('Return Policy')}}:</div>
                                </div>
                                <div class="col-10">
                                    {{__('Returns accepted if product not as described, buyer pays return shipping fee; or keep the product & agree refund with seller.')}} <a href="{{ route('returnpolicy') }}" class="ml-2">View details</a>
                                </div>
                            </div>
                            
                        <div class="row no-gutters mt-1">
                               <div class="col-2">
                                 <div class="product-description-label">{{__('Product Condition')}}:</div>
                               </div>
                               <div class="col-2">
                                   {{ ucfirst(str_replace('_',' ',$detailedProduct->product_condition))}}
                               </div>
                                
                               @foreach(App\Cashback::where('enable',1)->get() as $cashback)
                                 @foreach(json_decode($cashback->products) as $product)
                                    @if($product == $detailedProduct->id)
                                   
	                               <div class="col-8">
	                                   @php
                               			$discount = explode('£', home_discounted_price($detailedProduct->id));
                               			$discount[1] = str_replace(' - ','',$discount[1]);
                                		$number = floor($discount[1]/$cashback->ratio);
                                	@endphp
                                       <p class="text-center" style="border:1px dashed"> <i class="fa fa-money" aria-hidden="true"></i> Earn an additional <span class="text-danger font-weight-bold">{{single_price($cashback->point*$number)}}</span> cashback for this product.</p>
	                               </div>
	                           @endif    
                               	@endforeach
                               @endforeach
                        </div>
                            <br class="mt-2">
                            <div class="report">
                                    @if(Auth::check() && Auth::user()->user_type == 'api_user')
                                            <a class="cursor" style="color:red !important" onclick="showApiNotification()"><i class="fa fa-comment"></i> Report incorrect product information</a>	
                                    @elseif(Auth::check())
                                            <a class="cursor" style="color:red !important" data-toggle="modal" data-target="#report"><i class="fa fa-comment"></i> Report incorrect product information</a>
                                    @else
                                        <a  class="cursor "  style="color:red !important" href="#" data-toggle="modal" data-target="#GuestCheckout"><i class="fa fa-comment"></i> Report incorrect product information</a>
                                    @endif
                            </div>
                            @php
                                $refund_request_addon = \App\Addon::where('unique_identifier', 'refund_request')->first();
                                $refund_sticker = \App\BusinessSetting::where('type', 'refund_sticker')->first();
                            @endphp
                            @if ($refund_request_addon != null && $refund_request_addon->activated == 1)
                                <div class="row no-gutters mt-3">
                                    <div class="col-2">
                                        <div class="product-description-label">{{__('Refund')}}:</div>
                                    </div>
                                    <div class="col-10">
                                        <a href="{{ route('returnpolicy') }}" target="_blank"> @if ($refund_sticker != null && $refund_sticker->value != null) <img src="{{ asset($refund_sticker->value) }}" height="36"> @else <img src="{{ asset('frontend/images/refund-sticker.jpg') }}" height="36"> @endif</a>
                                        <a href="{{ route('returnpolicy') }}" class="ml-2" target="_blank">View Policy</a>
                                    </div>
                                </div>
                            @endif

                            @if ($detailedProduct->added_by == 'seller')
                                <div class="row no-gutters mt-3">
                                    <div class="col-2">
                                        <div class="product-description-label">{{__('Seller Guarantees')}}:</div>
                                    </div>
                                    <div class="col-10">
                                        @if ($detailedProduct->user->seller->verification_status == 1)
                                            {{__('Verified seller')}}
                                        @else
                                            {{__('Non verified seller')}}
                                        @endif
                                    </div>
                                </div>
                            @endif
                            <div class="row no-gutters mt-3">
                                <div class="col-2">
                                    <div class="product-description-label alpha-6">{{__('Payment')}}:</div>
                                </div>
                                <div class="col-10">
                                    <ul class="inline-links">
                                        <li>
                                            <img src="{{ asset('frontend/images/placeholder.jpg') }}" src="{{ asset('frontend/images/placeholder.jpg') }}" data-src="{{ asset('frontend/images/icons/cards/visa.png') }}" width="30" class="lazyload">
                                        </li>
                                        <li>
                                            <img src="{{ asset('frontend/images/placeholder.jpg') }}" src="{{ asset('frontend/images/placeholder.jpg') }}" data-src="{{ asset('frontend/images/icons/cards/mastercard.png') }}" width="30" class="lazyload">
                                        </li>
                                        <li>
                                            <img src="{{ asset('frontend/images/placeholder.jpg') }}" src="{{ asset('frontend/images/placeholder.jpg') }}" data-src="{{ asset('frontend/images/icons/cards/maestro.png') }}" width="30" class="lazyload">
                                        </li>
                                        <li>
                                            <img src="{{ asset('frontend/images/placeholder.jpg') }}" src="{{ asset('frontend/images/placeholder.jpg') }}" data-src="{{ asset('frontend/images/icons/cards/paypal.png') }}" width="30" class="lazyload">
                                        </li>
                                        <li>
                                            <img src="{{ asset('frontend/images/placeholder.jpg') }}" src="{{ asset('frontend/images/placeholder.jpg') }}" data-src="{{ asset('frontend/images/icons/cards/cod.png') }}" width="30" class="lazyload">
                                        </li>
                                    </ul>
                                </div>
                            </div>


                            @if($detailedProduct->FreeReturn_id)
                                <div class="row no-gutters mt-3">
                                    <div class="col-2">
                                        <div class="product-description-label">{{__('Free Return')}}:</div>
                                    </div>
                                    <div class="col-10 strong-700 text-success">
                                        {{$detailedProduct->FreeReturn->days}} Days Free Easy Return
                                    </div>
                                </div>
                           @endif

                            <hr class="mt-4">
                            <div class="row no-gutters mt-4">
                                <div class="col-2">
                                    <div class="product-description-label mt-2">{{__('Share')}}:</div>
                                </div>
                                <div class="col-10">
                                    <div id="share"></div>
                                </div>
                            </div>

                            @php
                            $ref = App\Referral::where('enable',1)->first();
                            if($ref!=null){
                                $discount = explode('£', home_discounted_price($detailedProduct->id));
                                $discount[1] = str_replace(' - ','',$discount[1]);
                                $number = floor($discount[1]/$ref->ratio);}
                            @endphp

                            @if($ref!=null && $ref->ratio<$discount[1] && (reffernalCategory($detailedProduct) ||reffernalSubCategory($detailedProduct) || reffernalSubSubCategory($detailedProduct)))
                                <div class="row no-gutters mt-4 lottery">
                                    <p>By buying this product you can collect up to <span > {{ $number }} loyalty point</span>. Your cart will total {{$number}} point that can be converted into a voucher of <span>{{single_price($ref->point*$number)}}</span>.</p>
                                </div>
                            @else
                                   <p class="text-danger">{{"This product does not qualify for a Loyalty Point"}}</p>
                            @endif
                        </div>
                    </div>
                     @if( isset(App\ads::first()->secondAd) || isset(App\ads::first()->thirdAd) || App\ProductBuyerTips::where('status',1)->first())
	                    <div class="col-lg-2">
	                        <div class="product-gal sticky-top d-flex flex-row-reverse">
	                            <div class="product-gal-img">
                                    @if(App\ProductBuyerTips::where('status',1)->first())
                                              <div class="bg-white shadow-sm">
				                <div class="section-title-1 clearfix">
				                  <h3 class="heading-5 strong-700 mb-0 float-left">
				                    <span>Shop with confidence</span>
				                  </h3>
				                 </div>
                                                 {!! App\ProductBuyerTips::where('status',1)->first()->message !!}
				              </div>
				                  @endif
	                                @isset(App\ads::first()->secondAd){!! App\ads::first()->secondAd !!}@endisset
	                                <br><br>
	                                @isset(App\ads::first()->thirdAd) {!! App\ads::first()->thirdAd!!} @endisset
	                            </div>
	                        </div>
	                    </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    @foreach (App\promote::all() as $promote)
         @php
          if( ($promote->product->category_id == $detailedProduct->category_id || $promote->product->subcategory_id == $detailedProduct->subcategory_id || $promote->product->subsubcategory_id == $detailedProduct->subsubcategory_id) && explode('-',$promote->product->slug)[0] ==  explode('-',$detailedProduct->slug)[0]){
             $products = filter_products(\App\Product::where('category_id', $promote->product->category_id)->where('subcategory_id', $promote->product->subcategory_id)->where('subsubcategory_id', $promote->product->subsubcategory_id))->where('slug', 'like', '%'.explode('-',$promote->product->slug)[0].'%')->limit(10)->get(); 
          }else{$products = App\Product::inRandomOrder()->limit(5)->get(); }
            @endphp
        <section class="mb-4">
    <div class="container-fluid">
        <div class="px-2 py-4 p-md-4 bg-white shadow-sm">
            <div class="section-title-1 clearfix">
                <h3 class="heading-5 strong-700 mb-0 float-left">
                    <span class="mr-4">{{__('Sponsored Products')}}</span>
                </h3>
            </div>
            <div class="caorusel-box arrow-round gutters-5">
                <div class="slick-carousel" data-slick-items="6" data-slick-xl-items="5" data-slick-lg-items="4"  data-slick-md-items="3" data-slick-sm-items="2" data-slick-xs-items="2">
                    @foreach ($products as $key => $product)
                    <div class="caorusel-card">
                        <div class="product-card-2 card card-product shop-cards shop-tech">
                            <div class="card-body p-0">

                                <div class="card-image">

                                    <a href="{{ route('product', $product->slug) }}" class="d-block">
                                        <img class="img-fit lazyload mx-auto" src="{{ asset('frontend/images/placeholder.jpg') }}" data-src="{{ asset($product->featured_img) }}" alt="{{ __($product->name) }}">
               
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
                </div>
            </div>
        </div>
    </div>
</section>

    @endforeach


    <section class="gry-bg">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12">
                    <div class="product-desc-tab bg-white">
                        <div class="tabs tabs--style-2">
                            <ul class="nav nav-tabs justify-content-center sticky-top bg-white">
                                <li class="nav-item">
                                    <a href="#tab_default_1" data-toggle="tab" class="nav-link text-uppercase strong-600 active show">{{__('Description')}}</a>
                                </li>
                                @if($detailedProduct->video_link != null)
                                    <li class="nav-item">
                                        <a href="#tab_default_2" data-toggle="tab" class="nav-link text-uppercase strong-600">{{__('Video')}}</a>
                                    </li>
                                @endif

                                <li class="nav-item">
                                    <a href="#tab_default_4" data-toggle="tab" class="nav-link text-uppercase strong-600">{{__('Reviews')}}</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#tab_default_5" data-toggle="tab" class="nav-link text-uppercase strong-600">{{__('Shipping Countries')}}</a>
                                </li>

                                <li class="nav-item">
                                    <a href="#tab_default_6" data-toggle="tab" class="nav-link text-uppercase strong-600">{{__('Return Date Policy')}}</a>
                                </li>
                                @if (\App\BusinessSetting::where('type', 'product_query')->first()->value == 1)
                                    <li class="nav-item">
                                        <a href="#tab_default_8" data-toggle="tab" class="nav-link text-uppercase strong-600">{{__('Questions')}}</a>
                                    </li>
                                @endif
                                @if($detailedProduct->accessories)
                                            <li class="nav-item">
                                                <a href="#tab_default_7" data-toggle="tab" class="nav-link text-uppercase strong-600">{{__('Accessories')}}</a>
                                            </li>
                                 @endif
                            </ul>

                            <div class="tab-content pt-0">
                                <div class="tab-pane active show" id="tab_default_1">
                                    <div class="py-2 px-4">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="mw-100 overflow--hidden">
                                                    <?php echo $detailedProduct->description; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="tab_default_2">
                                    <div class="fluid-paragraph py-2">
                                        <!-- 16:9 aspect ratio -->
                                        <div class="embed-responsive embed-responsive-16by9 mb-5">
                                            @if ($detailedProduct->video_provider == 'youtube' && $detailedProduct->video_link != null)
                                                <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/{{ explode('=', $detailedProduct->video_link)[1] }}"></iframe>
                                            @elseif ($detailedProduct->video_provider == 'dailymotion' && $detailedProduct->video_link != null)
                                                <iframe class="embed-responsive-item" src="https://www.dailymotion.com/embed/video/{{ explode('video/', $detailedProduct->video_link)[1] }}"></iframe>
                                            @elseif ($detailedProduct->video_provider == 'vimeo' && $detailedProduct->video_link != null)
                                                <iframe src="https://player.vimeo.com/video/{{ explode('vimeo.com/', $detailedProduct->video_link)[1] }}" width="500" height="281" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="tab_default_4">
                                    <div class="fluid-paragraph py-4">
                                        @foreach ($detailedProduct->reviews as $key => $review)
                                            <div class="block block-comment">
                                                <div class="block-image">
                                                    <img src="{{ asset('frontend/images/placeholder.jpg') }}" data-src="{{ asset($review->user->avatar_original) }}" class="rounded-circle lazyload">
                                                </div>
                                                <div class="block-body">
                                                    <div class="block-body-inner">
                                                        <div class="row no-gutters">
                                                            <div class="col">
                                                                <h3 class="heading heading-6">
                                                                    <a href="javascript:;">{{ $review->user->name }}</a>
                                                                </h3>
                                                                <span class="comment-date">
                                                                    {{ date('d-m-Y', strtotime($review->created_at)) }}
                                                                </span>
                                                            </div>
                                                            <div class="col">
                                                                <div class="rating text-right clearfix d-block">
                                                                    <span class="star-rating star-rating-sm float-right">
                                                                        @for ($i=0; $i < $review->rating; $i++)
                                                                            <i class="fa fa-star active"></i>
                                                                        @endfor
                                                                        @for ($i=0; $i < 5-$review->rating; $i++)
                                                                            <i class="fa fa-star"></i>
                                                                        @endfor
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <p class="comment-text">
                                                            {{ $review->comment }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach

                                        @if(count($detailedProduct->reviews) <= 0)
                                            <div class="text-center">
                                                {{ __('There have been no reviews for this product yet.') }}
                                            </div>
                                        @endif

                                        @if(Auth::check())
                                            @php     $commentable = false; @endphp
                                            @foreach ($detailedProduct->orderDetails as $key => $orderDetail)
                                                @if($orderDetail->order != null && $orderDetail->order->user_id == Auth::user()->id && $orderDetail->delivery_status == 'delivered' && \App\Review::where('user_id', Auth::user()->id)->where('product_id', $detailedProduct->id)->first() == null)
                                                    @php
                                                        $commentable = true;
                                                    @endphp
                                                @endif
                                            @endforeach
                                            @if ($commentable)
                                                <div class="leave-review">
                                                    <div class="section-title section-title--style-1">
                                                        <h3 class="section-title-inner heading-6 strong-600 text-uppercase">
                                                            {{__('Write a review')}}
                                                        </h3>
                                                    </div>
                                                    <form class="form-default" role="form" action="{{ route('reviews.store') }}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="product_id" value="{{ $detailedProduct->id }}">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="" class="text-uppercase c-gray-light">{{__('Your name')}}</label>
                                                                    <input type="text" name="name" value="{{ Auth::user()->name }}" class="form-control" disabled required>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="" class="text-uppercase c-gray-light">{{__('Email')}}</label>
                                                                    <input type="text" name="email" value="{{ Auth::user()->email }}" class="form-control" required disabled>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <div class="c-rating mt-1 mb-1 clearfix d-inline-block">
                                                                    <input type="radio" id="star5" name="rating" value="5" required/>
                                                                    <label class="star" for="star5" title="Awesome" aria-hidden="true"></label>
                                                                    <input type="radio" id="star4" name="rating" value="4" required/>
                                                                    <label class="star" for="star4" title="Great" aria-hidden="true"></label>
                                                                    <input type="radio" id="star3" name="rating" value="3" required/>
                                                                    <label class="star" for="star3" title="Very good" aria-hidden="true"></label>
                                                                    <input type="radio" id="star2" name="rating" value="2" required/>
                                                                    <label class="star" for="star2" title="Good" aria-hidden="true"></label>
                                                                    <input type="radio" id="star1" name="rating" value="1" required/>
                                                                    <label class="star" for="star1" title="Bad" aria-hidden="true"></label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row mt-3">
                                                            <div class="col-sm-12">
                                                                <textarea class="form-control" rows="4" name="comment" placeholder="{{__('Your review')}}" required></textarea>
                                                            </div>
                                                        </div>

                                                        <div class="text-right">
                                                            <button type="submit" class="btn btn-styled btn-base-1 btn-circle mt-4">
                                                                {{__('Send review')}}
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            @endif
                                        @endif
                                    </div>
                                </div>
                                <div class="tab-pane" id="tab_default_5">
                                    <div class="py-2 px-4">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="mw-100 overflow--hidden">
                                                    <table  class="table table-striped table-bordered demo-dt-basic w-100" cellspacing="0">
                                                        <thead>
                                                            <th>#</th>
                                                            <th>Country name</th>
                                                            <th>Prices</th>
                                                        </thead>
                                                        <tbody>
                                                            @php
                                                             $shipping_type_default_or_not = App\SellerCountry::where('seller_id',$detailedProduct->user->id)->where('shipping_type','!=',null)->first();
                                                                $shipping_default =  json_decode($detailedProduct->shipping_type);
                                                                $shipping_courier =  json_decode($detailedProduct->shipping_courier_data);
                                                                $shipping_cost = json_decode($detailedProduct->shipping_cost);
                                                                $shipping_courier_price = json_decode($detailedProduct->shipping_courier_price);

                                                            @endphp
                                                            @foreach($shipping_default as $key=>$shipping_country)
                                                            <tr>

                                                                @php $shipping_country = explode('--',$shipping_country); @endphp
                                                                <td>{{$key+1}}</td>
                                                                @if($shipping_country[0] == 'courier')
                                                                <td>{{str_replace('_',' ',$shipping_country[1])}} </td>
                                                                <td>
                                                                    <table class="table">
                                                                        <th colspan="1">Courier Companies</th>
                                                                        <th>Price</th>
                                                                    @foreach($shipping_courier as $key=>$courier_compannies_ids)

                                                                        @php
                                                                        $courier_country = explode('--',$courier_compannies_ids)[1];
                                                                        $courier_compannies_ids = explode('--',$courier_compannies_ids)[0];
                                                                        $courier_price = explode('--',$shipping_courier_price[$key]);
                                                                   @endphp
                                                                   @if($courier_country ==$shipping_country[1])
                                                                                <tr>
                                                                                    <td>{{App\Shipping::findOrFail($courier_compannies_ids)->name}}</td>
                                                                                    <td>{{single_price($courier_price[0])}}</td>
                                                                                </tr>
                                                                    @endif
                                                                    @endforeach

                                                            </table>
                                                            </td>
                                                                @else
                                                                    <td>{{str_replace('_',' ',$shipping_country[1])}} ({{str_replace('_',' ',$shipping_country[0])}})</td>
                                                                    <td>{{explode('--',$shipping_cost[$key])[0]}}</td>
                                                                @endif
                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="tab_default_6">
                                    <div class="py-2 px-4">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="mw-100 overflow--hidden">
                                                    <div class="row">
                                                        @php $ReturnPolicyDate= App\ReturnPolicyDate::findOrFail($detailedProduct->return_policy_date_id);@endphp
                                                        <div class="col-md-12">
                                                            <h5 class="text-center">{{$ReturnPolicyDate->days}} Days Return Period</h5>
                                                        </div>
                                                        <div class="col-md-12">
                                                            {!! $ReturnPolicyDate->message !!}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @if(!is_null($detailedProduct->accessories))
                                <div class="tab-pane" id="tab_default_7">
                                        <div class="col-md-12">
                                            <section class="mb-4">
                                                <div class="container-fluid">
                                                    <div class="px-2 py-4 p-md-4 bg-white shadow-sm">

                                                        <div class="caorusel-box arrow-round gutters-5">
                                                            <div class="" data-slick-items="6" data-slick-xl-items="5" data-slick-lg-items="4"  data-slick-md-items="3" data-slick-sm-items="2" data-slick-xs-items="2">
                                                                @foreach ((json_decode($detailedProduct->accessories)) as $key => $product_id)
                                                                @php $product = App\Product::findOrFail($product_id); @endphp
                                                                <div class="caorusel-card" style="width: 232px !important;">
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
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </section>
                                        </div>
                                    </div>
                                @endif

                                @if (\App\BusinessSetting::where('type', 'product_query')->first()->value == 1)
                                    <div class="tab-pane" id="tab_default_8">
                                        <div class="py-2 px-4">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="mw-100 overflow--hidden">
                                                        <div class="row">
                                                            <div class="pull-right mb-2" style="display: inherit;margin-left: 75%;">
                                                                <button type="button" class="btn btn-primary btn-sm strong-690" onclick="show_query_modal()">
                                                                    {{__('Ask a new question')}}
                                                                </button>
				                                                <input class="ml-2" id="search_query" type="text" placeholder="Search query..." class="form-control">
                                                           	</div>
                                                            <div class="col-lg-12" id="default-question">
                                                               @foreach($productQueries as $key=>$product_query)
                                                                   <div class="accordion" id="default-search-content">
                                                                        <div class="card">
                                                                            <div class="card-header" style="padding:0px" id="headingOne">
                                                                                <h2 class="mb-0">
                                                                                    <button type="button" class="btn btn-link" data-toggle="collapse" data-target="#collapse{{$key}}">
                                                                                        <i class="fa fa-plus"></i> {!! \Illuminate\Support\Str::words($product_query->question,30,'....')  !!}
                                                                                    </button>
                                                                                </h2>
                                                                            </div>
                                                                            <div id="collapse{{$key}}" class="collapse" aria-labelledby="headingOne" data-parent="#default-search-content">
                                                                                <div class="card-body">
                                                                                <strong> Asked by: <a href="{{ route('user.feedback', encrypt($product_query->customer->id)) }}">{{$product_query->user->name}} </a> on {{Carbon\Carbon::parse($product_query->created_at)->format('d-m-Y @ H:i:s')}}  </strong>
                                                                                    <p> {{$product_query->question}}  </p>
                                                                                                    <strong> Replied by:  <a href="{{ route('shop.visit', $product_query->user->shop->slug) }}">{{$product_query->user->name}}</a> </strong>
                                                                                                        <strong> on {{Carbon\Carbon::parse($product_query->updated_at)->format('d-m-Y @ H:i:s')}} </strong>
                                                                                    <p>{{$product_query->replay!=null?$product_query->replay:'No reply available yet'}}</p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        </div>
                                                              @endforeach
                                                            </div>
                                                            <div id="search-question" class="d-none">    </div>
                                                            <div id="search-nothing" class="d-none">     </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- Move Outside --}}
                                        <div class="row">
                                            <div class="col">
                                                <div class="products-pagination my-5">
                                                    <nav aria-label="Center aligned pagination">
                                                        <ul class="pagination justify-content-center">
                                                            {{ $productQueries->links() }}
                                                        </ul>
                                                    </nav>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                   
                                @endif                               
                            </div>
                        </div>
                    </div>
                    <div class="my-4 bg-white p-3">
                        <section class="mb-4">
                            <div class="container-fluid">
                                <div class="px-2 py-4 p-md-4 bg-white shadow-sm">
                                    <div class="section-title-1 clearfix">
                                        <h3 class="heading-5 strong-700 mb-0 float-left">
                                            <span class="mr-4">{{__('Related Products')}}</span>
                                        </h3>
                                    </div>

                                    <div class="caorusel-box arrow-round gutters-5">
                                        <div class="slick-carousel" data-slick-items="6" data-slick-xl-items="5" data-slick-lg-items="4"  data-slick-md-items="3" data-slick-sm-items="2" data-slick-xs-items="2">
                                            @foreach (filter_products(\App\Product::where('subcategory_id', $detailedProduct->subcategory_id)->where('id', '!=', $detailedProduct->id))->limit(10)->get() as $key => $related_product)
                                                <div class="caorusel-card my-1">
                                                    <div class="row no-gutters product-box-2 align-items-center">
                                                        <div class="col-4">
                                                            <div class="position-relative overflow-hidden h-100">
                                                                <a href="{{ route('product', $related_product->slug) }}" class="d-block product-image h-100">
                                                                    <img class="img-fit lazyload mx-auto" src="{{ asset('frontend/images/placeholder.jpg') }}" data-src="{{ asset($related_product->thumbnail_img) }}" alt="{{ __($related_product->name) }}">
                                                                </a>
                                                                <div class="product-btns">
                                                                    <button class="btn add-wishlist" title="Add to Wishlist" onclick="addToWishList({{ $related_product->id }})">
                                                                        <i class="la la-heart-o"></i>
                                                                    </button>
                                                                    <button class="btn add-compare" title="Add to Compare" onclick="addToCompare({{ $related_product->id }})">
                                                                        <i class="la la-refresh"></i>
                                                                    </button>
                                                                    <button class="btn quick-view" title="Quick view" onclick="showAddToCartModal({{ $related_product->id }})">
                                                                        <i class="la la-eye"></i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-8 border-left">
                                                            <div class="p-3">
                                                                <h2 class="product-title mb-0 p-0 text-truncate-2">
                                                                    <a href="{{ route('product', $related_product->slug) }}">{{ __(Illuminate\Support\Str::limit($related_product->name, 10) ) }}</a>
                                                                </h2>
                                                                <div class="star-rating star-rating-sm mb-2">
                                                                    {{ renderStarRating($related_product->rating) }}
                                                                </div>
                                                                <div class="clearfix">
                                                                    <div class="price-box float-left">
                                                                        @if(home_base_price($related_product->id) != home_discounted_base_price($related_product->id))
                                                                            <del class="old-product-price strong-400">{{ home_base_price($related_product->id) }}</del>
                                                                        @endif
                                                                        <span class="product-price strong-600">
                                                                            {{ home_discounted_base_price($related_product->id) }}
                                                                        </span>
                                                                    </div>
                                                                    <div class="float-right">
                                                                        <button class="add-to-cart btn" title="Add to Cart" onclick="showAddToCartModal({{ $related_product->id }})">
                                                                            <i class="la la-shopping-cart"></i>
                                                                        </button>
                                                                    </div>
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
                        </section>
                    </div>
                 
                </div>
            </div>
        </div>
    </section>

    <section class="gry-bg">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                     <div class="my-4 bg-white p-3">
                        <section class="mb-4">
                            <div class="container-fluid">
                                <div class="px-2 py-4 p-md-4 bg-white shadow-sm">
                                    <div class="section-title-1 clearfix">
                                        <h3 class="heading-5 strong-700 mb-0 float-left">
                                            <span class="mr-4">{{__('Top Selling Products From This Seller')}}</span>
                                        </h3>
                                        <ul class="inline-links float-right">
                                            @if($detailedProduct->added_by == 'seller')
                                                <li><a  href="{{ route('shop.visit', $detailedProduct->user->shop->slug) }}" class="active">{{__('Show More')}}</a></li>
                                            @else
                                                <li>Admin Products</li>
                                            @endif
                                        </ul>
                                    </div>
                                    <div class="caorusel-box arrow-round gutters-5">
                                        <div class="slick-carousel" data-slick-items="6" data-slick-xl-items="5" data-slick-lg-items="4"  data-slick-md-items="3" data-slick-sm-items="2" data-slick-xs-items="2">
                                            @foreach (filter_products(\App\Product::where('user_id', $detailedProduct->user_id)->orderBy('num_of_sale', 'desc'))->limit(6)->get() as $key => $top_product)
                                            <div class="caorusel-card">
                                                <div class="product-card-2 card card-product shop-cards shop-tech">
                                                    <div class="card-body p-0">

                                                        <div class="card-image">
                                                            <a href="{{ route('product', $top_product->slug) }}" class="d-block">
                                                                <img class="img-fit lazyload mx-auto" src="{{ asset('frontend/images/placeholder.jpg') }}" data-src="{{ asset($top_product->featured_img) }}" alt="{{ __($top_product->name) }}">
                                                            </a>
                                                        </div>

                                                        <div class="p-md-3 p-2">
                                                            <div class="price-box">
                                                                @if(home_base_price($top_product->id) != home_discounted_base_price($top_product->id))
                                                                    <del class="old-product-price strong-400">{{ home_base_price($top_product->id) }}</del>
                                                                @endif
                                                                <span class="product-price strong-600">{{ home_discounted_base_price($top_product->id) }}</span>
                                                            </div>
                                                            <div class="star-rating star-rating-sm mt-1">
                                                                {{ renderStarRating($top_product->rating) }}
                                                            </div>
                                                            <h2 class="product-title p-0 text-truncate-2">
                                                                <a href="{{ route('product', $top_product->slug) }}">{{ __($top_product->name) }}</a>
                                                            </h2>

                                                            @if (\App\Addon::where('unique_identifier', 'club_point')->first() != null && \App\Addon::where('unique_identifier', 'club_point')->first()->activated)
                                                                <div class="club-point mt-2 bg-soft-base-1 border-light-base-1 border">
                                                                    {{ __('Club Point') }}:
                                                                    <span class="strong-700 float-right">{{ $top_product->earn_point }}</span>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
             </div>
        </div>
    </section>
    
    <div class="modal" id="report" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-zoom product-modal" id="modal-size" role="document">
            <div class="modal-content position-relative">
                <div class="modal-header">
                    <h5 class="modal-title strong-600 heading-5">{{__('Report Incorrect Product Information')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="" action="{{ route('product.report') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body gry-bg px-3 pt-3">
                        <div class="form-group">
                            <input type="text" class="form-control mb-3" name="title" placeholder="Product Name" id="product-code-con" re value="{{$detailedProduct->name}}" required readonly>
                            <input type="hidden" class="form-control mb-3" name="productId" placeholder="Product Id" value="{{$detailedProduct->id}}" required readonly>
                        @if(Auth::check())
                            <input type="hidden" class="form-control mb-3" name="userId" placeholder="User Id" value="{{Auth::user()->id}}" required readonly>
                        @endif
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" rows="8" name="message" required placeholder="Detailed incorrect product information"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-link" data-dismiss="modal">{{__('Cancel')}}</button>
                        <button type="submit" class="btn btn-base-1 btn-styled">{{__('Send')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="chat_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-zoom product-modal" id="modal-size" role="document">
            <div class="modal-content position-relative">
                <div class="modal-header">
                    <h5 class="modal-title strong-600 heading-5">{{__('Any question about this product?')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="" action="{{ route('conversations.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $detailedProduct->id }}">
                    <div class="modal-body gry-bg px-3 pt-3">
                        <div class="form-group">
                            <input type="text" class="form-control mb-3" name="title" value="{{ $detailedProduct->name }}" placeholder="Product Name" required>
                         </div>
                        <div class="form-group">
                            <textarea class="form-control" rows="8" name="question" required placeholder="Your Question">{{ route('product', $detailedProduct->slug) }}</textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-link" data-dismiss="modal">{{__('Cancel')}}</button>
                        <button type="submit" class="btn btn-base-1 btn-styled">{{__('Send')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="query_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-zoom product-modal" id="modal-size" role="document">
            <div class="modal-content position-relative">
                <div class="modal-header">
                    <h5 class="modal-title strong-600 heading-5">{{__('Any question about this product?')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="" action="{{ route('product_query.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $detailedProduct->id }}">
                    <div class="modal-body gry-bg px-3 pt-3">
                        <div class="form-group">
                            <input type="text" class="form-control mb-3" readonly="true" name="title" value="{{ $detailedProduct->name }}" placeholder="Product Name" required>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" rows="8" name="message" required placeholder="Your Question"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-link" data-dismiss="modal">{{__('Cancel')}}</button>
                        <button type="submit" class="btn btn-base-1 btn-styled">{{__('Send')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="login_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLabel">{{__('Login')}}</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row align-items-center">
                        <div class="col">
                            <div class="card">
                                <div class="card-body px-4">
                                    <form class="form-default" role="form" action="{{ route('cart.login.submit') }}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <div class="input-group input-group--style-1">
                                                <input type="email" name="email" class="form-control" placeholder="{{__('Email')}}">
                                                <span class="input-group-addon">
                                                    <i class="text-md ion-person"></i>
                                                </span>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="input-group input-group--style-1">
                                                <input type="password" name="password" class="form-control" placeholder="{{__('Password')}}">
                                                <span class="input-group-addon">
                                                    <i class="text-md ion-locked"></i>
                                                </span>
                                            </div>
                                        </div>

                                        <div class="row align-items-center">
                                            <div class="col-md-6">
                                                <a href="#" class="link link-xs link--style-3">{{__('Forgot password?')}}</a>
                                            </div>
                                            <div class="col-md-6 text-right">
                                                <button type="submit" class="btn btn-styled btn-base-1 px-4">{{__('Sign in')}}</button>
                                            </div>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card">
                                <div class="card-body px-4">
                                    @if(\App\BusinessSetting::where('type', 'google_login')->first()->value == 1)
                                        <a href="{{ route('social.login', ['provider' => 'google']) }}" class="btn btn-styled btn-block btn-google btn-icon--2 btn-icon-left px-4 my-4">
                                            <i class="icon fa fa-google"></i> {{__('Login with Google')}}
                                        </a>
                                    @endif
                                    @if (\App\BusinessSetting::where('type', 'facebook_login')->first()->value == 1)
                                        <a href="{{ route('social.login', ['provider' => 'facebook']) }}" class="btn btn-styled btn-block btn-facebook btn-icon--2 btn-icon-left px-4 my-4">
                                            <i class="icon fa fa-facebook"></i> {{__('Login with Facebook')}}
                                        </a>
                                    @endif
                                    @if (\App\BusinessSetting::where('type', 'twitter_login')->first()->value == 1)
                                    <a href="{{ route('social.login', ['provider' => 'twitter']) }}" class="btn btn-styled btn-block btn-twitter btn-icon--2 btn-icon-left px-4 my-4">
                                        <i class="icon fa fa-twitter"></i> {{__('Login with Twitter')}}
                                    </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<div class="modal fade" id="GuestCheckout" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-zoom" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLabel">{{__('Login')}}</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="p-3">
                        <form class="form-default" role="form" action="{{ route('cart.login.submit') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <div class="input-group input-group--style-1">
                                    <input type="email" name="email" class="form-control" placeholder="{{__('Email')}}">
                                    <span class="input-group-addon">
                                        <i class="text-md la la-user"></i>
                                    </span>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="input-group input-group--style-1">
                                    <input type="password" name="password" class="form-control" placeholder="{{__('Password')}}">
                                    <span class="input-group-addon">
                                        <i class="text-md la la-lock"></i>
                                    </span>
                                </div>
                            </div>

                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <a href="{{ route('password.request') }}" class="link link-xs link--style-3">{{__('Forgot password?')}}</a>
                                </div>
                                <div class="col-md-6 text-right">
                                    <button type="submit" class="btn btn-styled btn-base-1 px-4">{{__('Sign in')}}</button>
                                </div>
                            </div>
                        </form>

                    </div>
                     @if(\App\BusinessSetting::where('type', 'google_login')->first()->value == 1 || \App\BusinessSetting::where('type', 'facebook_login')->first()->value == 1 || \App\BusinessSetting::where('type', 'twitter_login')->first()->value == 1)
                        <div class="or or--1 mt-3 text-center">
                            <span>or</span>
                        </div>
                        <div class="p-3 pb-0">
                            @if (\App\BusinessSetting::where('type', 'facebook_login')->first()->value == 1)
                                <a href="{{ route('social.login', ['provider' => 'facebook']) }}" class="btn btn-styled btn-block btn-facebook btn-icon--2 btn-icon-left px-4 mb-3">
                                    <i class="icon fa fa-facebook"></i> {{__('Login with Facebook')}}
                                </a>
                            @endif
                            @if(\App\BusinessSetting::where('type', 'google_login')->first()->value == 1)
                                <a href="{{ route('social.login', ['provider' => 'google']) }}" class="btn btn-styled btn-block btn-google btn-icon--2 btn-icon-left px-4 mb-3">
                                    <i class="icon fa fa-google"></i> {{__('Login with Google')}}
                                </a>
                            @endif
                            @if (\App\BusinessSetting::where('type', 'twitter_login')->first()->value == 1)
                            <a href="{{ route('social.login', ['provider' => 'twitter']) }}" class="btn btn-styled btn-block btn-twitter btn-icon--2 btn-icon-left px-4 mb-3">
                                <i class="icon fa fa-twitter"></i> {{__('Login with Twitter')}}
                            </a>
                            @endif
                        </div>
                    @endif
                    @if (\App\BusinessSetting::where('type', 'guest_checkout_active')->first()->value == 1)
                        <div class="or or--1 mt-0 text-center">
                            <span>or</span>
                        </div>
                        <div class="text-center">
                            <a href="{{ route('checkout.shipping_info') }}" class="btn btn-styled btn-base-1">{{__('Guest Checkout')}}</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')

    <script type="text/javascript">
        $(document).ready(function() {
    		$('#share').share({
    			networks: ['facebook','twitter','linkedin','tumblr','in1','stumbleupon','digg'],
    			theme: 'square'
    		});
            getVariantPrice();

    	});

        function CopyToClipboard(containerid) {
            if (document.selection) {
                var range = document.body.createTextRange();
                range.moveToElementText(document.getElementById(containerid));
                range.select().createTextRange();
                document.execCommand("Copy");

            } else if (window.getSelection) {
                var range = document.createRange();
                document.getElementById(containerid).style.display = "block";
                range.selectNode(document.getElementById(containerid));
                window.getSelection().addRange(range);
                document.execCommand("Copy");
                document.getElementById(containerid).style.display = "none";

            }
            showFrontendAlert('success', 'Copied');
        }

        function show_chat_modal(){
            @if(Auth::check() && Auth::user()->user_type == 'api_user')      
                showFrontendAlert('warning','Please login as a user.');    
            @elseif (Auth::check())
                $('#chat_modal').modal('show');
            @else
              $('#GuestCheckout').modal();
            @endif
        }

        function show_query_modal(){
            @if(Auth::check() && Auth::user()->user_type == 'api_user')      
                showFrontendAlert('warning','Please login as a user.');    
            @elseif (Auth::check())
               $('#query_modal').modal('show');
            @else
                $('#GuestCheckout').modal();
            @endif
        }


        // {{-- Get country nonn premium  --}}
        function getCountryNonPremiumData(el){
            country_id =  el.value;

               $.get('{{ route('getNonPremium.change') }}',{_token:'{{ csrf_token() }}', country_id:country_id,product_id:{{$detailedProduct->id}}}, function(data){
                            data = data.split('##');

                         $('#estimated_by').html(data[0]);
                         $('#estimated_to').html(data[1]);
                        });
        }
    </script>



<!-- Display the countdown timer in an element -->

@if(isset($shipping_date))
<script>
var countDownDate = new Date("{{ Carbon\Carbon::tomorrow()->format('M-d-Y') . ' '. $shipping_date->at}}").getTime();


var x = setInterval(function() {
  var now = new Date().getTime();
  var distance = countDownDate - now;
  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);
  document.getElementById("demo").innerHTML = hours + ": " + minutes + ": " + seconds + " ";

  if (distance < 0) {
    clearInterval(x);
    document.getElementById("demo").innerHTML = "EXPIRED";
  }
}, 1000);
</script>
@endif

@if($detailedProduct->photos)

<script>
    @php $photos = ''; @endphp
     @foreach (json_decode($detailedProduct->photos) as $key => $photo)
       @php $photo = asset($photo); if($photos == ''){ $photos="'".$photo;}else{$photos=$photos."','".$photo;} if(count(json_decode($detailedProduct->photos))== $key+1){$photos=$photos."'";} @endphp
    @endforeach
    var imgs = [{!!$photos!!}];

    function changeImage(dir) {
        var img = $('#thumbnailImage');
        position = img.attr('src');
        image = imgs[imgs.indexOf(position) + (dir || 1)] || imgs[dir ? imgs.length - 1 : 0];
        img.attr('src',image);
        img.attr('data-src',image);
        img.attr('xoriginal',image);

        number =imgs.indexOf(position) + (dir || 1) || imgs[dir ? imgs.length - 1 : 0];
        $(`.more_images`).removeClass('xactive');
        $(`.more_images`).eq(number).addClass('xactive');
    }

    document.onkeydown = function(e) {
        e = e || window.event;
        if (e.keyCode == '37') {
            changeImage(-1) //left <- show Prev image
        } else if (e.keyCode == '39') {
            // right -> show next image
            changeImage()
        }
    }

    $('body').on('click', '.slick-arrow>.la-angle-left', function () {
        changeImage(-1) ;
});
$('body').on('click', '.slick-arrow>.la-angle-right', function () {
    changeImage();
});

</script>

@endif

<script>

function activaTab(tab){
    const offsetTop = document.querySelector('#'+tab).offsetTop;

  scroll({
    top: offsetTop,
    behavior: "smooth"
  });
console.log(offsetTop);
  $('.nav-tabs a[href="#' + tab + '"]').tab('show');
  
};

$('#search_query').on('keyup', function(){
    search();
});
function search(){
  var search = $('#search_query').val();
    if(search.length > 0){

        $.get('{{ route('search_query.ajax') }}', { _token: '{{ @csrf_token() }}', search:search}, function(data){
        console.log(data);
            if(data == '0'){
                 $('#default-question').addClass("d-none");
                $('#search-nothing').removeClass('d-none').html('Sorry, nothing found for <strong>"'+search+'"</strong>');

            }
            else{
                $('#search-nothing').addClass('d-none').html(null);
                $('#default-question').addClass("d-none");
                $('#search-question').removeClass("d-none");
                $('#search-question').html(data);
            }
        });
    }
    else {
        $('#default-question').removeClass('d-none');
        $('#search-question').addClass("d-none");
    }
}

   function showCheckoutModal(){
        $('#GuestCheckout').modal();
    }
</script>
@endsection
