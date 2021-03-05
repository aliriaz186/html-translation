@extends('frontend.layouts.app')

@section('meta_title'){{ $shop->meta_title }}@stop

@section('meta_description'){{ $shop->meta_description }}@stop

@section('meta')
    <!-- Schema.org markup for Google+ -->
    <meta itemprop="name" content="{{ $shop->meta_title }}">
    <meta itemprop="description" content="{{ $shop->meta_description }}">
    <meta itemprop="image" content="{{ asset($shop->logo) }}">

    <!-- Twitter Card data -->
    <meta name="twitter:card" content="product">
    <meta name="twitter:site" content="@publisher_handle">
    <meta name="twitter:title" content="{{ $shop->meta_title }}">
    <meta name="twitter:description" content="{{ $shop->meta_description }}">
    <meta name="twitter:creator" content="@author_handle">
    <meta name="twitter:image" content="{{ asset($shop->meta_img) }}">

    <!-- Open Graph data -->
    <meta property="og:title" content="{{ $shop->meta_title }}" />
    <meta property="og:type" content="Shop" />
    <meta property="og:url" content="{{ route('shop.visit', $shop->slug) }}" />
    <meta property="og:image" content="{{ asset($shop->logo) }}" />
    <meta property="og:description" content="{{ $shop->meta_description }}" />
    <meta property="og:site_name" content="{{ $shop->name }}" />
@endsection

@section('content')
    <!-- <section>
        <img loading="lazy"  src="https://via.placeholder.com/2000x300.jpg" alt="" class="img-fluid">
    </section> -->

    @php
        $total = 0;
        $rating = 0;
        foreach ($shop->user->products as $key => $seller_product) {
            $total += $seller_product->reviews->count();
            $rating += $seller_product->reviews->sum('rating');
        }
        
     $timing =  json_decode($shop->timing);
    @endphp

    <section class="gry-bg pt-2 ">
        <div class="container-fluid">
            <div class="row @if(!$timing) align-items-baseline @endif bg-white" @if($shop->cover) style="background:url('{{asset($shop->cover)}}'); height:40vh; background-position: center;
    background-size: cover; " @endif>
                <div class="col-md-6 {{$shop->cover?'mt-4':''}}">
                    <div class="d-flex">
                        <img height="70" class="lazyload mt-3" style="border-radius: 50%;" src="{{ asset('frontend/images/placeholder.jpg') }}" data-src="{{ asset($shop->logo) }}" alt="Shop Logo">
                        <div class="p-3">
                            <h3 class="strong-700 heading-4 mb-0">{{ $shop->name }}
                                @if ($shop->user->seller->verification_status == 1)
                                    <span class="ml-2"><i class="fa fa-check-circle text-success"></i></span>
                                @else
                                    <span class="ml-2"><i class="fa fa-times-circle text-danger"></i></span>
                                @endif
                            </h3>
                             <div class="star-rating star-rating-sm mb-1">
                                    @php
                                    $feedback = App\SellerFeedback::where('seller_id',$shop->user->id)->where('status',1)->avg('rating');
                                    $feedback = $feedback==null?0:$feedback ;
                                @endphp
                                    <span class="star-rating star-rating-sm d-block">
                                        {{ renderStarRating($feedback) }} 
                                    </span>
  
                                    <span class="rating-count d-block ml-0">({{ count(App\SellerFeedback::where('seller_id',$shop->user->id)->where('status',1)->get()) }} {{__('customer feedbacks')}}) {{Seller_average_percentage($shop->user->id)}}%</span>
                            </div>
                            @if(isset($shop->tax_id))
                                <h5>VAT ID : <strong>{{$shop->tax_id}}</strong></h5>
                            @endif
                            
                            <div><span class="font-weight-bold">{{__('Tel:')}}</span> <span class="location alpha-6">{{ $shop->phone}}</span> </div>
                            <div><span class="font-weight-bold">{{__('Address:')}}</span> <span class="location alpha-6">{{ $shop->address }}</span> </div>
                            <div class="font-weight-bold">Registered member since <span class="">  {{$shop->created_at->format('d-m-Y')}} </span> </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 {{$shop->cover?'mt-4':''}}">                
                @if($timing)
                <div style="margin-left:57%;">
                    <div class="mt-3">
                       <strong>Opening Times:</strong><br>
	                    @php $days = array(); $days['monday'] = 'monday';$days['tuesday'] = 'tuesday';$days['wednesday'] = 'wednesday';$days['thusday'] = 'thusday';$days['friday'] = 'friday';$days['saturday'] = 'saturday';$days['sunday'] = 'sunday';  @endphp
	                  @foreach($days as $key=>$day)
	                     @php $open = 'open_'.$day; $close= 'close_'.$day; $closed = 'closed';  @endphp
	                     {{Illuminate\Support\Str::limit(ucfirst($day),3,'')}}: {{$timing->$open == $closed?'Closed':date('h a', strtotime($timing->$open)).' -'}} {{$timing->$close== $closed?'':date('h a', strtotime($timing->$close))}} @if(!$loop->last)| @endif
	                 @endforeach    
                    </div>
                   @endif
                    <div id="share" style="margin-top:5%"></div>
                    </div>
               @if($timing)  </div>  @endif
            </div>
        </div>
    </section>
    <section class="bg-white">
        <div class="container-fluid">
            <div class="row sticky-top mt-2">
                <div class="col border">
                    <div class="seller-shop-menu">
                     <div class="row">
                        <div class="col-md-8">
                        <ul class="inline-links">
                            <li @if(!isset($type)) class="active" @endif><a href="{{ route('shop.visit', $shop->slug) }}">{{__('Store Home')}}</a></li>
                            <li @if(isset($type) && $type == 'top_selling') class="active" @endif><a href="{{ route('shop.visit.type', ['slug'=>$shop->slug, 'type'=>'top_selling']) }}">{{__('Top Selling')}}</a></li>
                            <li @if(isset($type) && $type == 'all_products') class="active" @endif><a href="{{ route('shop.visit.type', ['slug'=>$shop->slug, 'type'=>'all_products']) }}">{{__('All Products')}}</a></li>
                            <li @if(isset($type) && $type == 'ratings') class="active" @endif><a href="{{ route('shop.visit.type', ['slug'=>$shop->slug, 'type'=>'ratings']) }}">{{__('Ratings')}}</a></li>
                        </ul>
                        </div>
                        @if (\App\BusinessSetting::where('type', 'conversation_system')->first()->value == 1)
                       <div class="col-md-4 mt-1">
                             <div class="row">
                              
                               <div class="col-md-2">
                                  <button class="btn btn-sm btn-styled btn-base-1 " onclick="show_chat_modal()">{{__('Contact Seller')}}</button>
                               </div>
                               <div class="col-md-7 pl-5">
                               	  <button class="btn btn-sm btn-styled btn-base-1 " onclick="addToBestSeller({{$shop->user->id}})">{{__('Save this Seller')}}</button>
                                ({{count(App\BestSellerByCustomer::where('seller_id',$shop->user->id)->get())}} Followers)
                                </div>
                              <div class="col-md-1">
                                @if($shop->user->seller->verification_status == 1)
		                <div class="position-absolute medal-badge">
		                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xml:space="preserve" viewBox="0 0 287.5 442.2">
		                        <polygon style="fill:#F8B517;" points="223.4,442.2 143.8,376.7 64.1,442.2 64.1,215.3 223.4,215.3 "/>
		                        <circle style="fill:#FBD303;" cx="143.8" cy="143.8" r="143.8"/>
		                        <circle style="fill:#F8B517;" cx="143.8" cy="143.8" r="93.6"/>
		                        <polygon style="fill:#FCFCFD;" points="143.8,55.9 163.4,116.6 227.5,116.6 175.6,154.3 195.6,215.3 143.8,177.7 91.9,215.3 111.9,154.3
		                        60,116.6 124.1,116.6 "/>
		                    </svg>
		                  </div>
		                  @endif
		             </div>
                             </div>
                        	
		            
              		</div>
                      @endif
                      </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </section>
    
   @if($shop->images_banner)
      <div class="row" style="height:31.1vh">
      	@foreach(json_decode($shop->images_banner) as $key=>$banner)
      	<div class="col-md-4 p-1">
      	  <img src="{{ asset($banner) }}" class="w-100 mb-2" style="height:31vh !important" alt="banner_{{$key}}">
      	</div>
      @endforeach
      </div>
   @endif
              

    @if (!isset($type))
        
        <section class="sct-color-1 pt-5 pb-4">
            <div class="container-fluid">
                <div class="section-title section-title--style-1 text-center mb-4">
                    <h3 class="section-title-inner heading-3 strong-600">
                        {{__('Featured Products')}}
                    </h3>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="caorusel-box">
                            <div class="slick-carousel center-mode" data-slick-items="5" data-slick-lg-items="3"  data-slick-md-items="3" data-slick-sm-items="1" data-slick-xs-items="1">
                                @foreach ($shop->user->products->where('published', 1)->where('featured_seller', 1) as $key => $product)
                                    <div class="">
                                        <div class="product-card-2 card card-product mx-3 my-5 shop-cards shop-tech">
                                            <div class="card-body p-0">

                                                <div class="card-image">
                                                    <a href="{{ route('product', $product->slug) }}" class="d-block">
                                                        <img  class="mx-auto img-fit lazyload" src="{{ asset('frontend/images/placeholder.jpg') }}" data-src="{{ asset($product->featured_img) }}" alt="{{ __($product->name) }}">
                                                    </a>
                                                </div>

                                                <div class="p-3">
                                                    <h2 class="product-title p-0 text-truncate-2">
                                                        <a href="{{ route('product', $product->slug) }}">{{  Illuminate\Support\Str::limit($product->name,25,'...') }}</a>
                                                    </h2>
                                                    <div class="star-rating star-rating-sm mt-1">
                                                        {{ renderStarRating($product->rating) }}
                                                    </div>
                                                    <div class="price-box">
                                                        <del class="old-product-price strong-400">{{ home_base_price($product->id) }}</del>
                                                        <span class="product-price strong-600">{{ home_discounted_base_price($product->id) }}</span>
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
        </section>
        
             @if ($shop->sliders != null)
        <section class="py-1 pt-0">
            <div class="container-fluid">
                <div class="home-slide">
                    <div class="slick-carousel" data-slick-arrows="true">
                        @if ($shop->sliders != null)
                            @foreach (json_decode($shop->sliders) as $key => $slide)
                                <div class="">
                                    <img class="d-block w-100 lazyload" src="{{ asset('frontend/images/placeholder-rect.jpg') }}" data-src="{{ asset($slide) }}" alt="{{ $key }} slide" style="max-height:300px;">
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </section>
        @endif
    @endif

  <section class="@if (!isset($type)) gry-bg @endif pt-5">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-2-1 d-none d-xl-block">
                    <div class="seller-info-box mb-3">
                        <div class="sold-by position-relative">
                            @if($shop->user->seller->verification_status == 1)
                                <div class="position-absolute medal-badge">
                                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xml:space="preserve" viewBox="0 0 287.5 442.2">
                                        <polygon style="fill:#F8B517;" points="223.4,442.2 143.8,376.7 64.1,442.2 64.1,215.3 223.4,215.3 "/>
                                        <circle style="fill:#FBD303;" cx="143.8" cy="143.8" r="143.8"/>
                                        <circle style="fill:#F8B517;" cx="143.8" cy="143.8" r="93.6"/>
                                        <polygon style="fill:#FCFCFD;" points="143.8,55.9 163.4,116.6 227.5,116.6 175.6,154.3 195.6,215.3 143.8,177.7 91.9,215.3 111.9,154.3
                                        60,116.6 124.1,116.6 "/>
                                    </svg>
                                </div>
                            @endif
                            <div class="title">{{__('Seller Info')}}</div>
                            <a href="" class="name d-block">{{ ucfirst($shop->user->name) }}</a>
                            
                            <div class="rating text-center d-block">
                                @php
                                $rating = App\SellerFeedback::where('seller_id',$shop->user->id)->avg('rating');
                                if($rating==null){
                                    $rating = 0;
                                }; 
                                $average_percentage = Seller_average_percentage($shop->user->id);
                                       if($average_percentage == 50){
                                            $feedback_status = 'Neurtal';
                                 	}
                                        else if($average_percentage > 50)  {
                                             $feedback_status = 'Positive';
                                        }                                  
                                        else { 
                                             $feedback_status = 'Negative';}
                            @endphp
                                <span class="star-rating star-rating-sm d-block">
                                
                                    @if ($rating > 0)
                                    {{ renderStarRating($rating) }} {{$average_percentage}}% {{$feedback_status }}
                                    @else
                                        {{ renderStarRating(0) }}
                                       
                                    @endif
                                </span>

                                <span class="rating-count d-block ml-0">({{ count(App\SellerFeedback::where('seller_id',$shop->user->id)->get()) }} {{__('customer feedbacks')}})</span>
                            </div>
                        </div>
			<div class="footer-top-box text-center cursor" style="padding:0px;" onclick="addToBestSeller({{$shop->user->id}})">
			        <ul class="inline-links inline-links--style-1">
			            <li>
			                <span class="badge badge-lg badge-pill bg-primary text-white" style=" margin-top: 10px;">Save this Seller</span>
			                <p><strong class="text-primary">({{count(App\BestSellerByCustomer::where('seller_id',$shop->user->id)->get())}} Followers)</strong></p>
			            </li>
			        </ul>    
			</div>
                    </div>
                   <div class="seller-category-box bg-white sidebar-box mb-3">
                        <div class="box-title">
                            {{__('This Sellers Categories')}}
                        </div>
                        <div class="box-content">
                            <div class="category-accordion">
                                @php
                                    $brands = array();
                                    foreach (\App\Product::where('user_id', $shop->user->id)->get() as $product){
                                    	array_push($brands,$product->brand_id);
                                    }
                                   $brands = array_unique($brands);
                                @endphp
                                @foreach (\App\Product::where('user_id', $shop->user->id)->select('category_id')->distinct()->get() as $key => $category)
                                    <div class="single-category">
                                        <button class="btn w-100 category-name collapsed" type="button" data-toggle="collapse" data-target="#category-{{ $key }}" aria-expanded="false">
                                            <a class="text-secondary" href="{{ route('shop.products.category', ['slug'=>$shop->slug ,'category_slug'=> App\Category::findOrFail($category->category_id)->slug]) }}">{{ Illuminate\Support\Str::limit(App\Category::findOrFail($category->category_id)->name,25,'(...)')}} </a>
                                        </button>
                                        <div id="category-{{ $key }}" class="collapse">
                                            @foreach (\App\Product::where('user_id', $shop->user->id)->where('category_id', $category->category_id)->select('subcategory_id')->distinct()->get() as $riz => $subcategory)
                                                <div class="single-sub-category">
                                                    <button class="btn w-100 sub-category-name" type="button" data-toggle="collapse" data-target="#subCategory-{{ $subcategory->subcategory_id }}" aria-expanded="false">
                                                        <a class="text-secondary" href="{{ route('shop.products.subcategory',  ['slug'=>$shop->slug,'subcategory_slug'=> App\SubCategory::findOrFail($subcategory->subcategory_id)->slug]) }}"> {{ Illuminate\Support\Str::limit(App\SubCategory::findOrFail($subcategory->subcategory_id)->name,25,'(...)') }} </a>
                                                    </button>
                                                    <div id="subCategory-{{ $subcategory->subcategory_id }}" class="collapse">
                                                        <ul class="sub-sub-category-list">
                                           			@foreach (\App\Product::where('user_id', $shop->user->id)->where('category_id',$category->category_id)->where('subcategory_id', $subcategory->subcategory_id)->select('subsubcategory_id')->distinct()->get() as $key=>$subsubcategory)
                                                               @php
                                                                    $subsubcategory = App\SubSubCategory::findOrFail($subsubcategory->subsubcategory_id);
                                                                @endphp
                                                                <li><a href="{{ route('shop.products.subsubcategory',  ['slug'=>$shop->slug,'subcategory_slug'=> $subsubcategory->slug]) }}">{{Illuminate\Support\Str::limit($subsubcategory->name,25,'(...)')}}</a></li>
                                                            @endforeach

                                                        </div>
                                                </div>

                                            @endforeach
                                        </div>
                                    </div>

                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="seller-top-products-box bg-white sidebar-box mb-4">
                        <div class="box-title">
                            {{__('Brands')}}
                        </div>
                        <div class="box-content">
                            <div class="seller-brands">
                        		<ul class="seller-brand-list">
                                    @foreach ($brands as $brand_id_inner)
                                        @if (\App\Brand::find($brand_id_inner) != null)
                                            <li class="brand-item">
                                                <a href="{{ route('products.brand.shop', [$shop->slug,\App\Brand::find($brand_id_inner)->slug,$shop->id]) }}">
                                                    <img src="{{ asset('frontend/images/placeholder.jpg') }}" data-src="{{ asset(\App\Brand::find($brand_id_inner)->logo) }}" class="img-fluid lazyload" alt="{{ \App\Brand::find($brand_id_inner)->name }}">
                                                </a>
                                            </li>
                                        @endif
                                    @endforeach
                        		</ul>
                        	</div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-9">
                    <h4 class="heading-5 strong-600 border-bottom pb-3 mb-4">
                    
                        @if (!isset($type))
                            {{__('New Arrival Products')}}
                          
                        @elseif ($type == 'top_selling')
                            {{__('Top Selling')}}
                            
                        @elseif ($type == 'all_products')
                            {{__('All Products')}}
                            
                        @elseif ($type == 'ratings')
                            {{__('Ratings')}}

                        @endif
                        
                    </h4>
                     @if (!isset($type) || $type == 'top_selling' || $type == 'all_products' || $type == 'search' )
                            
			 <form class="" id="search-form" action="{{ route('search-shop',$shop->slug) }}" method="GET">
			<input type="hidden" name="id" value="{{$shop->id}}">
			<input type="hidden" name="type_old" value="@isset($type) {{$type}} @else 'new_arrival' @endisset">
			
			<input type="hidden" name="shop" value="{{$shop->id}}">
			<div class="sort-by-bar row no-gutters bg-white mb-3 px-3 pt-2">	
           		    <div class="col-xl-6 d-flex d-xl-block justify-content-between align-items-end ">
			        <div class="sort-by-box flex-grow-1">
			            <div class="form-group">
			                <label>{{__('Search')}}</label>
			                <div class="search-widget">
			                    <input class="form-control input-lg" type="text" name="q" placeholder="{{__('Search products')}}" @isset($query) value="{{ $query }}" @endisset>
			                    <button type="submit" class="btn-inner btn-primary" style="background: #377dff; opacity:1 !important">
			                        <i class="fa fa-search"></i>
			                    </button>
			                </div>
			            </div>
			        </div>
			        <div class="d-xl-none ml-3 form-group">
			            <button type="button" class="btn p-1 btn-sm" id="side-filter">
			                <i class="la la-filter la-2x"></i>
			            </button>
			        </div>
			    </div>
			    <div class="col-xl-6">
			        <div class="row no-gutters">
			            <div class="col-6">
			                <div class="sort-by-box px-1">
			                    <div class="form-group">
			                        <label>{{__('Sort by')}}</label>
			                        <select class="form-control sortSelect" data-minimum-results-for-search="Infinity" name="sort_by" onchange="filter()">
			                            <option value="1" @isset($sort_by) @if ($sort_by == '1') selected @endif @endisset>{{__('Newest')}}</option>
			                            <option value="2" @isset($sort_by) @if ($sort_by == '2') selected @endif @endisset>{{__('Oldest')}}</option>
			                            <option value="3" @isset($sort_by) @if ($sort_by == '3') selected @endif @endisset>{{__('Price low to high')}}</option>
			                            <option value="4" @isset($sort_by) @if ($sort_by == '4') selected @endif @endisset>{{__('Price high to low')}}</option>
			                        </select>
			                    </div>
			                </div>
			            </div>
			            <div class="col-6">
			                <div class="sort-by-box px-1">
			                    <div class="form-group">
			                        <label>{{__('Brands')}}</label>
			                        <select class="form-control sortSelect" data-placeholder="{{__('All Brands')}}" name="brand" onchange="filter()">
			                            <option value="">{{__('All Brands')}}</option>
			                            @foreach (\App\Brand::all() as $brand_main)
			                                <option value="{{ $brand_main->slug }}" @isset($brand_id) @if ($brand_id == $brand_main->id) selected @endif @endisset>{{ $brand_main->name }}</option>
			                            @endforeach
			                        </select>
			                    </div>
			                </div>
			            </div>
			            
			        </div>
			    </div>
			</div>
		     </form>
		     @endif
			<div class="product-list row gutters-5 sm-no-gutters">
                        @php
                        if (!isset($type)){
                            if(isset($_GET['search'])){
                                $products = \App\Product::where('user_id', $shop->user->id)->where('published', 1)->orderBy('created_at', 'desc')
                                ->where('name', 'like', '%'.$_GET['search'].'%')->paginate(24);
                            }else{
                                $products = \App\Product::where('user_id', $shop->user->id)->where('published', 1)->orderBy('created_at', 'desc')->paginate(24);
                            }
                        }
                        elseif ($type == 'top_selling'){
                            if(isset($_GET['search'])){
                                $products = \App\Product::where('user_id', $shop->user->id)->where('published', 1)->orderBy('num_of_sale', 'desc')
                                ->where('name', 'like', '%'.$_GET['search'].'%')->paginate(24);
                            }else{
                                $products = \App\Product::where('user_id', $shop->user->id)->where('published', 1)->orderBy('num_of_sale', 'desc')->paginate(24);
                            }
                          }
                        elseif ($type == 'all_products'){
                            if(isset($_GET['search'])){
                                $products = \App\Product::where('user_id', $shop->user->id)->where('published', 1)
                                ->where('name', 'like', '%'.$_GET['search'].'%')->paginate(24);
                            }else{
                                $products = \App\Product::where('user_id', $shop->user->id)->where('published', 1)->paginate(24);
                            }
                        }
                    @endphp
                    @if(isset($type) && $type != 'ratings' || !isset($type))
                        @foreach ($products as $key => $product)
                            <div class="col-lg-3 col-md-4 col-6">
                                <div class="card product-box-1 mb-3">
                                    <div class="card-image">
                                        <a href="{{ route('product', $product->slug) }}" class="d-block text-center">
                                            <img class="img-fit lazyload" src="{{ asset('frontend/images/placeholder.jpg') }}" data-src="{{ asset($product->thumbnail_img) }}" alt="{{ __($product->name) }}">
                                        </a>
                                    </div>
                                    <div class="card-body p-0">
                                        <div class="px-3 py-2">
                                            <h2 class="title text-truncate-2 mb-0">
                                                <a href="{{ route('product', $product->slug) }}">{{  Illuminate\Support\Str::limit($product->name,25,'...') }}</a>
                                            </h2>
                                        </div>
                                        <div class="price-bar row no-gutters">
                                            <div class="price col-md-7">
                                                @if(home_price($product->id) != home_discounted_price($product->id))
                                                    <del class="old-product-price strong-600">{{ home_base_price($product->id) }}</del>
                                                    <span class="product-price strong-600">{{ home_discounted_base_price($product->id) }}</span>
                                                @else
                                                    <span class="product-price strong-600">{{ home_discounted_base_price($product->id) }}</span>
                                                @endif
                                            </div>
                                            <div class="col-md-5">
                                                <div class="star-rating star-rating-sm float-md-right">
                                                    {{ renderStarRating($product->rating) }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="cart-add d-flex">
                                                <button class="btn add-wishlist border-right" title="Add to Wishlist" onclick="addToWishList({{ $product->id }})">
                                                    <i class="la la-heart-o"></i>
                                                </button>
                                                <button class="btn add-compare border-right" title="Add to Compare" onclick="addToCompare({{ $product->id }})">
                                                    <i class="la la-refresh"></i>
                                                </button>
                                                <button type="button" class="btn btn-block btn-icon-left" onclick="showAddToCartModal({{ $product->id }})">
                                                    <span class="d-none d-sm-inline-block">{{__('Add to cart')}}</span><i class="la la-shopping-cart ml-2"></i>
                                                </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    @if(count($products)>23)
                    <div class="row">
                        <div class="col">
                            <div class="products-pagination my-5">
                                <nav aria-label="Center aligned pagination">
                                    <ul class="pagination justify-content-center">
                                        {{ $products->links() }}
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                   @endif 
                    @else
                    <div class="row  bg-white w-100 p-3">
                        <div class="col-lg-6">
                            <h5 class="text-center">Feedback Ratings</h5>
                            <table class="table table-stripped text-center table-bordered">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>1 month</th>
                                        <th>6 month</th>
                                        <th>12 months</th>
                                        <th>Lifetime</th>
                                    </tr>
                                </thead>
                                <tbody>
                                      <tr>
                                        <td>Positive</td>
                                        @php $id = $shop->user->id ;
                                        @endphp
                                        <td>{{count(App\SellerFeedback::where('seller_id',$id)->where('status',1)->where('created_at','>',\Carbon\Carbon::now()->subMonths(1))->where('rating','>',3)->get())}}</td>
                                        <td>{{count(App\SellerFeedback::where('seller_id',$id)->where('status',1)->where('created_at','>',\Carbon\Carbon::now()->subMonths(6))->where('rating','>',3)->get())}}</td>
                                        <td>{{count(App\SellerFeedback::where('seller_id',$id)->where('status',1)->where('created_at','>',\Carbon\Carbon::now()->subMonths(12))->where('rating','>',3)->get())}}</td>
                                        <td>{{count(App\SellerFeedback::where('seller_id',$id)->where('status',1)->where('created_at','>',\Carbon\Carbon::now()->subYears(12))->where('rating','>',3)->get())}}</td>                   
                                    </tr>
                                     
                                    <tr>
                                        <td>Neutral</td>
                                        <td>{{count(App\SellerFeedback::where('seller_id',$id)->where('status',1)->where('created_at','>',\Carbon\Carbon::now()->subMonths(1))->where('rating',3)->get())}}</td>
                                        <td>{{count(App\SellerFeedback::where('seller_id',$id)->where('status',1)->where('created_at','>',\Carbon\Carbon::now()->subMonths(6))->where('rating',3)->get())}}</td>
                                        <td>{{count(App\SellerFeedback::where('seller_id',$id)->where('status',1)->where('created_at','>',\Carbon\Carbon::now()->subMonths(12))->where('rating',3)->get())}}</td>
                                        <td>{{count(App\SellerFeedback::where('seller_id',$id)->where('status',1)->where('created_at','>',\Carbon\Carbon::now()->subYears(12))->where('rating',3)->get())}}</td>   
                                    </tr>
 				    <tr>
                                        <td>Negative</td>
                                        <td>{{count(App\SellerFeedback::where('seller_id',$id)->where('status',1)->where('created_at','>',\Carbon\Carbon::now()->subMonths(1))->where('rating','<',3)->get())}}</td>
                                        <td>{{count(App\SellerFeedback::where('seller_id',$id)->where('status',1)->where('created_at','>',\Carbon\Carbon::now()->subMonths(6))->where('rating','<',3)->get())}}</td>
                                        <td>{{count(App\SellerFeedback::where('seller_id',$id)->where('status',1)->where('created_at','>',\Carbon\Carbon::now()->subMonths(12))->where('rating','<',3)->get())}}</td>
                                        <td>{{count(App\SellerFeedback::where('seller_id',$id)->where('status',1)->where('created_at','>',\Carbon\Carbon::now()->subYears(12))->where('rating','<',3)->get())}}</td>   
                                      </tr>
                                    
                                </tbody>
                            </table>
                        </div>
                        <div class="col-lg-6">
                            <h5 class="text-center">Detailed Seller Ratings</h5>
                            <br><br><br>
                            <div class="row">
                                <div class="col-md-6 border">
                                    <p style="margin: 0px">Accurate Description</p>
                                    <div class="star-rating star-rating-sm mt-1">
                                        @php $ratingADN = App\SellerFeedbackDetail::where('seller_id',$id)->avg('ratingADN');
                                             $ratingDT = App\SellerFeedbackDetail::where('seller_id',$id)->avg('ratingDT');
                                             $ratingCOMM = App\SellerFeedbackDetail::where('seller_id',$id)->avg('ratingCOMM');
                                             $ratingACCD = App\SellerFeedbackDetail::where('seller_id',$id)->avg('ratingACCD');
                                        @endphp
                                        {{ renderStarRating($ratingADN) }}
                                    </div>
                                </div>
                                <div class="col-md-6 border">
                                    <p style="margin: 0px">Delivery Time</p>
                                    <div class="star-rating star-rating-sm mt-1">
                                        {{ renderStarRating($ratingDT) }}
                                    </div>
                                </div>
                                <div class="col-md-6 border">
                                    <p style="margin: 0px">Communication</p>
                                    <div class="star-rating star-rating-sm mt-1">
                                        {{ renderStarRating($ratingCOMM) }}
                                    </div>
                                </div>
                                <div class="col-md-6 border">
                                    <p style="margin: 0px">Reasonable Postage Cost</p>
                                    <div class="star-rating star-rating-sm mt-1">
                                        {{ renderStarRating($ratingACCD) }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                        
                       <div class="row mt-3 bg-white w-100 p-3">
                        <h5 class="text-center">Feedbacks</h5>
                        
                        @foreach ($CustomerFeedback as $SFB)
                            <div class="row w-100" style="margin-bottom:-3%">
                               @php $customer = App\User::findOrFail($SFB->customer_id); $seller= App\User::findOrFail($SFB->seller_id);  @endphp
                                <div class="col-md-1" style="z-index:2;height:66%">
                                    <div class="widget-profile-box px-3 py-4 d-flex align-items-center">
                                        <div class="widget-profile-box px-3 py-4 d-flex align-items-center" style="margin-top:-231%">
                                           <a href="{{ route('user.feedback', encrypt($customer->id)) }}">
                                            @if ($customer->avatar_original != null)
                                                <div class="image " style="background-image:url('{{ asset($customer->avatar_original) }}')"></div>
                                            @else
                                                <div class="image " style="background-image:url('{{ asset('frontend/images/user.png') }}')"></div>
                                            @endif
                                            </a>
                                       </div>
                                    </div>
                                </div>
                                  @if($SFB->reply)
                               <div class="col-md-5 border pl-5" style="height:70%">
                               @else 
                               <div class="col-md-11 border pl-5" style="height:70%">
                               @endif
                                <a href="{{ route('user.feedback', encrypt($customer->id)) }}"><h6 class="" style="margin-bottom:-2px">By {{$customer->name}}</h6></a>
                                <p class="font-weight-bold" style="margin-bottom:-2px">{{$SFB->title}}</p>
                                <div class="star-rating star-rating-sm">
                                    {{ renderStarRating($SFB->rating) }}
                                </div>
                                <p>{{str_limit($SFB->message, $limit = 100, $end="...")}}</p>
                               </div>
                               @if($SFB->reply)
                               <div class="col-md-1">
                                   <span> <i class="fa fa-reply" style="font-size: 2rem;margin-top: 40%;"></i> </span>
                               </div>
                               <div class="col-md-5 border" style="height:70%">
                                    <h6 class="font-weight-bold ">Seller Response</h6>
                                    <p>{{str_limit($SFB->reply, $limit = 100, $end="...")}}</p>
                               </div>
                               <div class="col-md-1" style="margin-left:-9%">
                                <div class="widget-profile-box px-3 py-4 d-flex align-items-center" >
                                    <div class="widget-profile-box px-3 py-4 d-flex align-items-center"  style="margin-top:-231%">
                                        <div class="image " style="background-image:url('{{ asset($shop->logo) }}')" ></div>
                                    </div>
                                </div>
                               </div>
                                @endif
                            </div>
                        @endforeach
                          <div class="clearfix">
		            <div class="pull-right">
		                {{ $CustomerFeedback->appends(request()->input())->links() }}
		            </div>
        	     </div>
                    </div>
                   
                    <br><br>
                @endif
              
                </div>
            </div>
        </div>
    </section>




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
                    <input type="hidden" name="product_id" value="">
                    <div class="modal-body gry-bg px-3 pt-3">
                        <div class="form-group">
                            <input type="text" class="form-control mb-3" name="title" value="" placeholder="Product Name" required>
                         </div>
                        <div class="form-group">
                            <textarea class="form-control" rows="8" name="question" required placeholder="Your Question"></textarea>
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

@endsection

@section('script')
	<script>
	    $(document).ready(function() {
    		$('#share').share({
                @php
                 $output = ""; 
                if($shop->facebook==1){$output=$output."'facebook',";}
            if($shop->twitter==1){$output=$output."'twitter',";}
            if($shop->youtube==1){$output=$output."'youtube',";}
            if($shop->google==1){$output=$output."'googleplus',";}
            if($shop->linkedin==1){$output=$output."'linkedin',";}
            if($shop->inl==1){$output=$output."'in1',";}
            if($shop->stumbleupon==1){$output=$output."'stumbleupon'";}
       
              @endphp
    			networks: [{!!$output!!}],
    			theme: 'square'
    		});
            getVariantPrice();

    	});
    	
    	        function filter(){
            $('#search-form').submit();
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
	</script>
	
@endsection