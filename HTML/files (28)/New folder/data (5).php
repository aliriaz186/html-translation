@extends('frontend.layouts.classified')

@section('robots'){{ __('noindex') }}@stop
@section('meta')
    <!-- Schema.org markup for Google+ -->
    <meta itemprop="name" content="{{ $customer_product->meta_title }}">
    <meta itemprop="description" content="{{ $customer_product->meta_description }}">
    <meta itemprop="image" content="{{ asset($customer_product->meta_img) }}">

    <!-- Twitter Card data -->
    <meta name="twitter:card" content="product">
    <meta name="twitter:site" content="@publisher_handle">
    <meta name="twitter:title" content="{{ $customer_product->meta_title }}">
    <meta name="twitter:description" content="{{ $customer_product->meta_description }}">
    <meta name="twitter:creator" content="@author_handle">
    <meta name="twitter:image" content="{{ asset($customer_product->meta_img) }}">
    <meta name="twitter:data1" content="{{ single_price($customer_product->unit_price) }}">
    <meta name="twitter:label1" content="Price">

    <!-- Open Graph data -->
    <meta property="og:title" content="{{ $customer_product->meta_title }}" />
    <meta property="og:type" content="product" />
    <meta property="og:url" content="{{ route('product', $customer_product->slug) }}" />
    <meta property="og:image" content="{{ asset($customer_product->meta_img) }}" />
    <meta property="og:description" content="{{ $customer_product->meta_description }}" />
    <meta property="og:site_name" content="{{ env('APP_NAME') }}" />
    <meta property="og:price:amount" content="{{ single_price($customer_product->unit_price) }}" />
@endsection
<style>
	#color_border_red:before{
		color:red;
		background:red;
	}
</style>

@section('classified-content')
    <!-- SHOP GRID WRAPPER -->

	@php $AdvertisementClassified = App\AdvertisementClassified::first(); @endphp
	
	@if($AdvertisementClassified->firstAdvertisment!='')
		<div>
			{!! $AdvertisementClassified->firstAdvertisment !!}
		 <div>
	@endif
    <section class="product-details-area">
        <div class="container-fluid">

            <div class="bg-white">

                <!-- Product gallery and Description -->
                <div class="row no-gutters cols-xs-space cols-sm-space cols-md-space">
                    <div class="col-lg-5">
                        <div class="product-gal sticky-top d-flex flex-row-reverse">
                            <div class="product-gal-img">
                                <img class="xzoom img-fluid" src="{{ asset(json_decode($customer_product->photos)[0]) }}" xoriginal="{{ asset(json_decode($customer_product->photos)[0]) }}" />
                            </div>
                            <div class="product-gal-thumb">
                                <div class="xzoom-thumbs">
                                    @if($customer_product->photos != null)
                                    @foreach (json_decode($customer_product->photos) as $key => $photo)
                                        <a href="{{ asset($photo) }}">
                                            <img class="xzoom-gallery" width="80" src="{{ asset($photo) }}"  @if($key == 0) xpreview="{{ asset($photo) }}" @endif>
                                        </a>
                                    @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <!-- Product description -->
                        <div class="product-description-wrapper">
                            <!-- Product title -->
                            <h2 class="product-title">
                                {{ $customer_product->name }}
                                @if(Auth::check())
                                   <button data-toggle="modal" data-target="#chatModal" onclick="show_chat_modal('{{ $customer_product->name }}','{{$customer_product->id}}')" class="btn btn-sm btn-primary pull-right">{{__('Contact Seller')}}</button>
                                @else
                                   <button href="#" data-toggle="modal" data-target="#login_modal" class="btn btn-sm btn-primary pull-right">{{__('Contact Seller')}}</button>
                                 @endif
                            </h2>

                            <div class="row no-gutters mt-3">
                                <div class="col-2">
                                    <div class="product-description-label">{{__('Price')}}:</div>
                                </div>
                                <div class="col-10">
                                    <div class="product-price">
                                        <strong>
                                            {{ single_price($customer_product->unit_price) }}
                                        </strong>
                                        <span class="piece">/{{ $customer_product->unit }}</span>
                                    </div>
                                </div>
                            </div>

                            <ul class="list-group border rounded mt-5">
                                <li class="list-group-item">
                                    <div class="icon-block icon-block--style-3 icon-block--style-3-v2">
                                        <i class="la la-user bg-gray-lighter"></i>
                                        <div class="icon-block-content">
                                            <h3 class="heading heading-6 strong-500">                                            
                             			<a href="{{ route('user.feedback', encrypt($customer_product->user->id)) }}">
                                                {{ $customer_product->user->name }}
                                                </a>
                                                  <span class="star-rating star-rating-sm d-block">
		
				                @php
				                    $rating = App\Feedback::where('customer_id',$customer_product->user->id)->avg('rating');
				                @endphp
				                @if ($rating > 0)
				                    {{ renderStarRating($rating) }}  {{Customer_average_percentage($customer_product->user->customer->id)}}%
				                @else
				                    {{ renderStarRating(0) }}  {{Customer_average_percentage($customer_product->user->customer->id)}}%
				                @endif
				            </span>
                                            </h3>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="icon-block icon-block--style-3 icon-block--style-3-v2">
                                        <i class="la la-map-marker bg-gray-lighter"></i>
                                        <div class="icon-block-content">
                                            <h3 class="heading heading-6 strong-500">
                                                {{ $customer_product->location }}
                                            </h3>
                                        </div>
                                    </div>
                                </li>
                                 @if(Auth::check())
                                <li class="list-group-item border-bottom-0 c-pointer" onclick="show_number(this)">
                                    <div class="icon-block icon-block--style-3 icon-block--style-3-v2">
                                        <i class="la la-phone bg-base-1"></i>
                                        <div class="icon-block-content">
                                            <h3 class="heading heading-5 strong-700 mb-0">
                                                <span class="dummy">{{ str_replace(substr($customer_product->user->phone,3),'XXXXXXXX', $customer_product->user->phone) }}</span>
                                                <span class="real d-none">{{ $customer_product->user->phone }}</span>
                                            </h3>
                                            <p class="mb-0">Click to show phone number</p>
                                        </div>
                                    </div>
                                </li>
                                 @else
                              <li class="list-group-item border-bottom-0 c-pointer" style="border-bottom: 1px solid rgba(0, 0, 0, 0.125);" onclick="show_model(this)">
                                <div class="icon-block icon-block--style-3 icon-block--style-3-v2">
                                    <i class="la la-phone bg-base-1"></i>
                                    <div class="icon-block-content">
                                        <h3 class="heading heading-5 strong-700 mb-0">
                                            <span class="dummy">{{ str_replace(substr($customer_product->user->phone,3),'XXXXXXXX', $customer_product->user->phone) }}</span>
                                            <span class="real d-none">{{ $customer_product->user->phone }}</span>
                                        </h3>
                                        <p class="mb-0">Click to show phone number</p>
                                    </div>
                                </div>
                            </li>
                            @endif
                            </ul>

                            <div class="row no-gutters mt-5">
                                <div class="col-2">
                                    <div class="product-description-label mt-2">{{__('Share')}}:</div>
                                </div>
                                <div class="col-10">
                                    <div id="share"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                        @if(App\ClassifiedSellerTips::first() && App\ClassifiedSellerTips::first()->status)
                    <div class="col-md-3">
                        <div class="p-4 bg-white shadow-sm">
                            <div id="color_border_red" class="section-title-1 clearfix">
                                <h3 class="heading-5 strong-700 mb-0 float-left">
                                    <span class="mr-4" style="color:red">{{__('Buyer Tips')}}</span>
                                </h3>
                            </div>
                            <div class="caorusel-box">
                                    {!! App\ClassifiedSellerTips::first()->message !!}
                            </div>
                        </div>
                    </div>
                @endif
                </div>
            </div>
        </div>
    </section>

    <section class="gry-bg mb-4">
        <div class="container-fluid p-5">
            <div class="row">
                <div class="col-xl-12">
                    <div class="product-desc-tab bg-white">
                        <div class="tabs tabs--style-2">
                            <ul class="nav nav-tabs justify-content-center sticky-top bg-white">
                                <li class="nav-item">
                                    <a href="#tab_default_1" data-toggle="tab" class="nav-link text-uppercase strong-600 active show">{{__('Description')}}</a>
                                </li>
                                @if($customer_product->video_link != null)
                                    <li class="nav-item">
                                        <a href="#tab_default_2" data-toggle="tab" class="nav-link text-uppercase strong-600">{{__('Video')}}</a>
                                    </li>
                                @endif
                                @if($customer_product->pdf != null)
                                    <li class="nav-item">
                                        <a href="#tab_default_3" data-toggle="tab" class="nav-link text-uppercase strong-600">{{__('Downloads')}}</a>
                                    </li>
                                @endif
                            </ul>

                            <div class="tab-content pt-0">
                                <div class="tab-pane active show" id="tab_default_1">
                                    <div class="py-2 px-4">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <?php echo $customer_product->description; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane" id="tab_default_2">
                                    <div class="fluid-paragraph py-2">
                                        <!-- 16:9 aspect ratio -->
                                        <div class="embed-responsive embed-responsive-16by9 mb-5">
                                            @if ($customer_product->video_provider == 'youtube' && $customer_product->video_link != null)
                                                <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/{{ explode('=', $customer_product->video_link)[1] }}"></iframe>
                                            @elseif ($customer_product->video_provider == 'dailymotion' && $customer_product->video_link != null)
                                                <iframe class="embed-responsive-item" src="https://www.dailymotion.com/embed/video/{{ explode('video/', $customer_product->video_link)[1] }}"></iframe>
                                            @elseif ($customer_product->video_provider == 'vimeo' && $customer_product->video_link != null)
                                                <iframe src="https://player.vimeo.com/video/{{ explode('vimeo.com/', $customer_product->video_link)[1] }}" width="500" height="281" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="tab_default_3">
                                    <div class="py-2 px-4">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <a href="{{ asset($customer_product->pdf) }}">{{ __('Download') }}</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="mb-4">
        <div class="container-fluid p-5">
            <div class="p-4 bg-white shadow-sm">
                <div class="section-title-1 clearfix">
                    <h3 class="heading-5 strong-700 mb-0 float-left">
                        <span class="mr-4">{{__('Other Ads of')}} {{$customer_product->classified_category->name}}</span>
                    </h3>
                    <ul class="inline-links float-right">
                        <li><a href="{{route('customer_products.category', $customer_product->classified_category->slug)}}" class="active">{{__('View More')}}</a></li>
                    </ul>
                </div>
                <div class="caorusel-box">
                    <div class="slick-carousel" data-slick-items="6" data-slick-xl-items="5" data-slick-lg-items="4"  data-slick-md-items="3" data-slick-sm-items="2" data-slick-xs-items="2">
                        @php
                            $products = filter_customer_products(\App\CustomerProduct::where('classified_category_id', $customer_product->classified_category_id)->where('id', '!=', $customer_product->id)->where('status', '1')->where('published', '1'))->limit(10)->get();
                        @endphp
                        @foreach ($products as $key => $product)
                            <div class="product-card-2 card card-product m-2 shop-cards shop-tech">
                                <div class="card-body p-0">
                                    <div class="card-image">
                                        <a href="{{ route('customer.product', $product->slug) }}" class="d-block">
                                            <img class="img-fit lazyload mx-auto" src="{{ asset('frontend/images/placeholder.jpg') }}" data-src="{{ asset($product->thumbnail_img) }}" alt="{{ __($product->name) }}">
                                        </a>
                                        </a>
                                    </div>

                                    <div class="p-3">
                                        <div class="price-box">
                                            <span class="product-price strong-600">{{ single_price($product->unit_price) }}</span>
                                        </div>
                                        <h2 class="product-title p-0 text-truncate-2">
                                            <a href="{{ route('customer.product', $product->slug) }}">{{ __($product->name) }}</a>
                                        </h2>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>



<section class="mb-4">
    <div class="container-fluid p-5">
        <div class="row">
            <div class="col-md-12">
                <section class="mb-4">
                    <div class="container-fluid p-5-fluid-fluid">
                        <div class="px-2 py-4 p-md-4 bg-white shadow-sm">
                            <div class="section-title-1 clearfix">
                                <h3 class="heading-5 strong-700 mb-0 float-left">
                                    <span class="mr-4">{{__('Similar listing from the same category')}}</span>
                                </h3>
                                <ul class="inline-links float-right">
                                <li><a  href="{{ route('shop.visit', $customer_product->user->shop->slug) }}" class="active">{{__('Show More')}}</a></li>
                                </ul>
                            </div>
                            <div class="caorusel-box arrow-round gutters-5">
                                <div class="slick-carousel" data-slick-items="6" data-slick-xl-items="5" data-slick-lg-items="4"  data-slick-md-items="3" data-slick-sm-items="2" data-slick-xs-items="2">
                                    @foreach (filter_products(\App\customerproduct::where('classified_subcategory_id', $customer_product->classified_subcategory_id)->where('id', '!=', $customer_product->id))->limit(10)->get() as $key => $related_product)
                                        <div class="caorusel-card my-1">
                                            <div class="row no-gutters product-box-2 align-items-center">
                                                <div class="col-4">
                                                    <div class="position-relative overflow-hidden h-100">
                                                        <a href="{{ route('product', $related_product->slug) }}" class="d-block product-image h-100">
                                                            <img class="img-fit lazyload mx-auto" src="{{ asset('frontend/images/placeholder.jpg') }}" data-src="{{ asset($related_product->thumbnail_img) }}" alt="{{ __($related_product->name) }}">
                                                        </a>
                                                        <div class="product-btns">
                                                            <button >

                                                            </button>
                                                            <button class="btn add-wishlist" title="Add to Compare" onclick="addToCompare({{ $related_product->id }})">
                                                                <i class="la la-heart-o"></i>
                                                            </button>
                                                            <button class="btn quick-view" >

                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-8 border-left">
                                                    <div class="p-3">
                                                        <h2 class="product-title mb-0 p-0 text-truncate-2">
                                                            <a href="{{ route('product', $related_product->slug) }}">{{ __(Illuminate\Support\Str::limit($related_product->name, 10) ) }}</a>
                                                        </h2>
                                                        <div class="clearfix">
                                                            <div class="price-box float-left">
                                                                    <del class="product-price strong-400">{{ $related_product->unit_price }}/Unit Price</del>
                                                                <span class=" strong-600"> {{$related_product->unit}}/Unit </span>
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
</section>

	@if($AdvertisementClassified->secondAdvertisment!='')
		<div>
			{!! $AdvertisementClassified->secondAdvertisment !!}
		 <div>
	@endif

    <div class="modal" id="chatModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-zoom product-modal" id="modal-size" role="document">
            <div class="modal-content position-relative">
                <div class="modal-header">
                    <h5 class="modal-title strong-600 heading-5">{{__('Contact Seller')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="" action="{{ route('conversations.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body gry-bg px-3 pt-3">
                        <div class="form-group">
                            <input type="text" class="form-control mb-3" name="title" placeholder="Order Id" id="product-name" required readonly>
                            <input type="hidden" class="form-control mb-3" name="orderId" placeholder="Order Id" id="product-id" required readonly>
                        </div>
                        <div class="form-group bg-white">
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
                          @if(\App\BusinessSetting::where('type', 'google_login')->first()->value == 1 || \App\BusinessSetting::where('type', 'facebook_login')->first()->value == 1 || \App\BusinessSetting::where('type', 'twitter_login')->first()->value == 1)
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
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script type="text/javascript">

     function show_chat_modal(name,id){
            document.getElementById("product-name").value = name;
            document.getElementById("product-id").value = id;
        }

        if ( $.isFunction($.fn.share) ) {

    		$('#share').share({
    			networks: ['facebook','googleplus','twitter','linkedin','tumblr','in1','stumbleupon','digg'],
    			theme: 'square'
    		});
    		}

        function show_number(el){

            $(el).find('.dummy').addClass('d-none');
            $(el).find('.real').removeClass('d-none').addClass('d-block');
        }

        function show_model(el){

        $('#login_modal').modal('show');
        }

    </script>
@endsection
