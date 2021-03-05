@extends('frontend.layouts.app')

@section('content')

    <section class="gry-bg py-4 profile">
        <div class="container-fluid p-4">
            <div class="row cols-xs-space cols-sm-space cols-md-space">
                <div class="col-lg-2-1 d-none d-lg-block">
                    @include('frontend.inc.seller_side_nav')
                </div>

                <div class="col-lg-9">
                    <div class="main-content">
                        <div class="page-title">
                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <h2 class="heading heading-6 text-capitalize strong-600 mb-0">
                                        {{__('Add Your Wholesale Product')}}
                                    </h2>
                                </div>
                                <div class="col-md-6">
                                    <div class="float-md-right">
                                        <ul class="breadcrumb">
                                            <li><a href="{{ route('home') }}">{{__('Home')}}</a></li>
                                            <li><a href="{{ route('dashboard') }}">{{__('Dashboard')}}</a></li>
                                            <li><a href="{{ route('seller.wholesale_products') }}">{{__('Wholesale Products')}}</a></li>
                                            <li class="active"><a href="{{ route('seller.wholesale_products.upload') }}">{{__('Add New Wholesale Product')}}</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <form class="" action="{{route('wholesale.products.store')}}" method="POST" enctype="multipart/form-data" id="choice_form">
                            @csrf
                    		<input type="hidden" name="added_by" value="seller">

                            <div class="form-box bg-white mt-4">
                                <div class="form-box-title px-3 py-2">
                                    {{__('General')}}
                                </div>
                                <div class="form-box-content p-3">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label>{{__('Product Name')}} <span class="required-star">*</span></label>
                                        </div>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control mb-3" name="name" placeholder="{{__('Product Name')}}" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label>{{__('W.Product Category')}} <span class="required-star">*</span></label>
                                        </div>
                                        <div class="col-md-10">
                                            <div class="form-control mb-3 c-pointer" data-toggle="modal" data-target="#categorySelectModal" id="product_category">{{__('Select a w.category')}}</div>
                                            <input type="hidden" name="category_id" id="category_id" value="" required>
                                            <input type="hidden" name="subcategory_id" id="subcategory_id" value="" required>
                                            <input type="hidden" name="subsubcategory_id" id="subsubcategory_id" value="">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label>{{__('Product Brand')}} <span class="required-star">*</span></label>
                                        </div>
                                        <div class="col-md-10">
                                            <div class="mb-3">
                                                <select class="form-control mb-3 selectpicker" data-placeholder="Select a brand" id="brands" name="brand_id">
                                                    <option value="">{{ ('Select Brand') }}</option>
                                                    @foreach (\App\Brand::all() as $brand)
                                                        <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label>{{__('Product Unit')}} <span class="required-star">*</span></label>
                                        </div>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control mb-3" name="unit" placeholder="Product unit" required>
                                        </div>
                                    </div>
                                      <div class="row">
                                        <div class="col-md-2">
                                            <label>{{__('SKU')}} </label>
                                        </div>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control mb-3" name="sku" placeholder="SKU">
                                        </div>
                                    </div>
                                    
                                    <div class="row code_number">
                                            <div class="col-md-2">
                                                <label>{{__('EAN/UPC/JAN')}}</label>
                                            </div>
                                            <div class="col-md-10">
                                                <input type="text" class="form-control mb-3" name="barcode_number" placeholder="{{__('EAN/UPC/JAN')}}">
                                            </div>
                                    </div>
                                     <div class="row">
                                            <div class="col-md-2">
                                                <label>{{__('Product Condition ')}} <span class="required-star">*</span></label>
                                            </div>
                                            <div class="col-md-10">
                                            	 <select class="form-control mb-3 selectpicker" required data-placeholder="Select a product condition" id="product_condition" name="product_condition">
                                                    <option value="">{{ ('Please Select Product Condition') }}</option>
                                                    <option value="new">{{ ('New') }}</option>
                                                    <option value="used">{{ ('Used') }}</option>
                                                    <option value="refurbished">{{ ('Refurbished') }}</option> 
                                                    <option value="faulty">{{ ('Faulty') }}</option>
                                                    <option value="damaged">{{ ('Damaged') }}</option>
                                                    <option value="for_parts">{{ ('For Parts') }}</option>
                                                </select>
                                            </div>
                                    </div>
                                    <br>
                                    @php
                                        $pos_addon = \App\Addon::where('unique_identifier', 'pos_system')->first();
                                    @endphp
                                    @if ($pos_addon != null && $pos_addon->activated == 1)
            							<div class="row mt-2">
            								<label class="col-md-2">{{__('Barcode')}}</label>
            								<div class="col-md-10">
            									<input type="text" class="form-control mb-3" name="barcode" placeholder="{{ __('Barcode') }}">
            								</div>
            							</div>
                                    @endif

                                    @php
                                        $refund_request_addon = \App\Addon::where('unique_identifier', 'refund_request')->first();
                                    @endphp
                                    @if ($refund_request_addon != null && $refund_request_addon->activated == 1)
            							<div class="row mt-2">
            								<label class="col-md-2">{{__('Refundable')}}</label>
            								<div class="col-md-10">
            									<label class="switch" style="margin-top:5px;">
            										<input type="checkbox" name="refundable" checked>
            			                            <span class="slider round"></span></label>
            									</label>
            								</div>
            							</div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-box bg-white mt-4">
                                <div class="form-box-title px-3 py-2">
                                    {{__('Images')}}
                                </div>
                                <div class="form-box-content p-3">
                                    <div id="product-images">
                                        <div class="row">
                                            <div class="col-md-2">
                                                <label>{{__('Main Images')}} <span class="required-star">*</span></label>
                                            </div>
                                            <div class="col-md-10">
                                                <div class="custom-input-file custom-input-file--4"  ></div>
                                                <label for="photos_1" class="mw-100 mb-3" data-toggle="modal" data-target="#photos_1">
                                                    <span></span>
                                                    <strong>
                                                        <i class="fa fa-upload"></i>
                                                        {{__('Choose image')}}
                                                    </strong>
                                                </label>
                                            </div>
                                            <br>
                                            <div id="below_image_test" style="width: 100%"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-box bg-white mt-4">
                                <div class="form-box-title px-3 py-2">
                                    {{__('Videos')}}
                                </div>
                                <div class="form-box-content p-3">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label>{{__('Video From')}}</label>
                                        </div>
                                        <div class="col-md-10">
                                            <div class="mb-3">
                                                <select class="form-control selectpicker" data-minimum-results-for-search="Infinity" name="video_provider">
                                                    <option value="youtube">{{__('Youtube')}}</option>
            										<option value="dailymotion">{{__('Dailymotion')}}</option>
            										<option value="vimeo">{{__('Vimeo')}}</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label>{{__('Video URL')}}</label>
                                        </div>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control mb-3" name="video_link" placeholder="{{__('Video link')}}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-box bg-white mt-4">
                                <div class="form-box-title px-3 py-2">
                                    {{__('Meta Tags')}}
                                </div>
                                <div class="form-box-content p-3">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label>{{__('Meta Title')}}</label>
                                        </div>
                                        <div class="col-md-10">
                                            <input type="text" name="meta_title" class="form-control mb-3" placeholder="{{__('Meta Title')}}">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label>{{__('Description')}}</label>
                                        </div>
                                        <div class="col-md-10">
                                            <textarea name="meta_description" rows="8" class="form-control mb-3"></textarea>
                                        </div>
                                    </div>
                                   
                                </div>
                            </div>
                            <div class="form-box bg-white mt-4">
                                <div class="form-box-title px-3 py-2">
                                    {{__('Customer Choice')}}
                                </div>
                                <div class="form-box-content p-3">
                                    <div class="row mb-3">
                                        <div class="col-8 col-md-3 order-1 order-md-0">
        									<input type="text" class="form-control" value="{{__('Colors')}}" disabled>
        								</div>
        								<div class="col-12 col-md-7 col-xl-8 order-3 order-md-0 mt-2 mt-md-0">
        									<select class="form-control color-var-select" name="colors[]" id="colors" multiple disabled>
        										@foreach (\App\Color::orderBy('name', 'asc')->get() as $key => $color)
        											<option value="{{ $color->code }}">{{ $color->name }}</option>
        										@endforeach
        									</select>
        								</div>
        								<div class="col-4 col-xl-1 col-md-2 order-2 order-md-0 text-right">
        									<label class="switch" style="margin-top:5px;">
        										<input value="1" type="checkbox" name="colors_active">
        										<span class="slider round"></span>
        									</label>
        								</div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-3">
                                            <label>{{__('Attributes')}}</label>
                                        </div>
                                        <div class="col-md-7">
                                            <div class="">
                                                <select name="choice_attributes[]" id="choice_attributes" class="form-control selectpicker" multiple data-placeholder="Choose Attributes">
                                                    @foreach (\App\Attribute::all() as $key => $attribute)
            											<option value="{{ $attribute->id }}">{{ $attribute->name }}</option>
            										@endforeach
            			                        </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-3">
        								<p>{{__('Choose the attributes of this product and then input values of each attribute')}}</p>
        							</div>
                                    <div id="customer_choice_options">

                                    </div>
                                </div>
                            </div>
                            <div class="form-box bg-white mt-4">
                                <div class="form-box-title px-3 py-2">
                                    {{__('Price')}}
                                </div>
                                <div class="form-box-content p-3">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label>{{__('Price')}} <span class="required-star">*</span></label>
                                        </div>
                                        <div class="col-md-10">
                                            <input type="number" min="0" value="0" step="0.01" class="form-control mb-3" name="unit_price" placeholder="{{__('Unit Price')}} ({{__('Base Price')}})" required>
                                        </div>
                                    </div>
                                    
                                   
                                     <div class="row">
                                        <div class="col-md-2">
                                            <label>{{__('Purchased Price')}} <span class="required-star">*</span></label>
                                        </div>
                                        <div class="col-md-10">
                                            <input type="number" min="0" step="0.01" class="form-control mb-3" name="purchase_price" placeholder="{{__('Purchased Price')}}" value="0" required>
                                        </div>
                                    </div> 

                                    <div class="row">
                                        <div class="col-md-2">
                                            <label>{{__('Discount')}}</label>
                                        </div>
                                        <div class="col-8">
                                            <input type="number" min="0" value="0" step="0.01" class="form-control mb-3" name="discount" placeholder="{{__('Discount')}}" required>
                                        </div>
                                        <div class="col-4 col-md-2">
                                            <div class="mb-3">
                                                <select class="form-control selectpicker" name="discount_type" data-minimum-results-for-search="Infinity">
                                                    <option value="amount">{{__('£')}}</option>
                                                    <option value="percent">{{__('%')}}</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label>{{__('Min Quantity')}}</label>
                                        </div>
                                        <div class="col-10">
                                            <input type="number" min="0" value="0"  class="form-control mb-3" name="min_stock" placeholder="{{__('Min Quantity')}}" required>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-2">
                                            <label>{{__('Max Quantity')}}</label>
                                        </div>
                                        <div class="col-10">
                                            <div class="mb-3">
                                                <input type="number" min="0" value="0"  class="form-control mb-3" name="max_stock" placeholder="{{__('Max Quantity')}}" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-12" id="sku_combination">

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-box bg-white mt-4">
                                <div class="form-box-title px-3 py-2">
                                    {{__('Shipping')}} <span id="shipDefaultText f-12">(Default Set)</span>
                                    <div class="pull-right {{App\SellerCountry::where('seller_id',Auth::user()->id)->first()->shipping_type != null?'':'d-none'}}" >
                                    <label class="switch" style="margin-top:5px;">
                                        <input type="checkbox" name="shipping_active" checked onchange="shippingDefaultChange(this)">
                                        <span class="slider round"></span>
                                    </label>
                                </div>
                                </div>


                                <div class="form-box-content p-3" id="shipDefault">
                                    <ul class="nav nav-tabs" role="tablist">
                                        @foreach(json_decode(App\SellerCountry::where('seller_id',Auth::user()->id)->first()->setCountries) as $key=>$country)
                                            <li class="nav-item">
                                                <a class="nav-link {{$key==0?'active':''}}" data-toggle="tab" href="#tabs-{{$key}}" role="tab">{{ str_replace('_',' ',$country) }}</a>
                                            </li>
                                        @endforeach
                                    </ul>

                                    <div class="tab-content">
                                        <br>
                                        @foreach(json_decode(App\SellerCountry::where('seller_id',Auth::user()->id)->first()->setCountries) as $key=>$country)
                                         <div class="tab-pane {{$key==0?'active':''}}" id="tabs-{{$key}}" role="tabpanel">
                                                <div class="row">
                                                    <div class="col-md-2">
                                                        <label>{{__('Shiping Type')}}</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                            <select name="shipping_type[]" onchange="changeCatch('{{$country}}',this)" class="form-control" required>
                                                                <option value="selected--{{$country}}" selected id="selected">{{__('Selct Shipping Type')}}</option>
                                                                <option value="free--{{$country}}" id="free">{{__('Free Shipping')}}</option>
                                                                <option value="flat_rate--{{$country}}" id="flat_rate">{{__('Flat Rate')}}</option>
                                                                <option value="courier--{{$country}}" id="courier">{{__('Courier')}}</option>
                                                            </select>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="row"  id="{{$country}}--flat_shipping_data" style="display:none">
                                                    <div class="col-md-2">
                                                        <label>{{__('Flat Rate')}}</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <input type="number" min="0" step="0.01"  class="form-control mb-3" name="shipping_flat_price[]" placeholder="{{__('Flat Rate Cost')}}">
                                                    </div>
                                                    <div class="col-md-2">
                                                        <label class="switch" style="margin-top:5px;">
                                                            <input type="radio" name="shipping_flat_type" value="flat_rate" checked>
                                                            <span class="slider round"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            <div class="row" id="{{$country}}--free_shipping_data" style="display:none">
                                                <div class="col-md-2">
                                                    <label>{{__('Free Shipping')}}</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <input type="number" min="0" step="0.01" value="0" class="form-control mb-3" name="shipping_free_price"  disabled placeholder="{{__('Flat Rate Cost')}}">
                                                </div>
                                                <div class="col-md-2">
                                                    <label class="switch" style="margin-top:5px;">
                                                        <input type="radio" name="shipping_free_type" value="free" checked>
                                                        <span class="slider round"></span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div id="{{$country}}--courier_shipping_data" style="display:none">
                                                <div class="row" >
                                                    <div class="col-md-2">
                                                        <label>{{__('Courier Company')}}</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                            <select name="shipping_courier_type[]" class="form-control demo-select2" onchange="premiumChange('{{$country}}',this)">
                                                                <option value="Selected" selected>Please Select Courier Company </option>
                                                                @foreach ($shipping as $ship)
                                                                <option value="{{$ship->id}}-{{$ship->premium}}-1--{{$country}}">{{$ship->name}}</option>
                                                                @endforeach
                                                            </select>
                                                    </div>
                                                    <label class="switch mt-1 {{$country}}_dafault_company_label "   data-toggle="tooltip" title="set it default company">
                                                        <input type="checkbox"  class="{{$country}}_dafault_company" value="{{$country}}_default" name="default_company[]"  onchange="set_default_company(this,'{{$country}}')">
                                                        <span class="slider round"></span>
                                                    </label>
                                                </div>
                                                <br>
                                                <div class="row" id="{{$country}}--premium_price1">
                                                    <div class="col-md-2">
                                                        <label>{{__('Price')}}</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <input  type="number" min="0" step="0.01" value="0" class="form-control mb-3" name="shipping_courier_price[]" placeholder="{{__('Price')}}">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6" id="{{$country}}--premium_data1" style="display: none">
                                                        <a> <i data-toggle="tooltip" title="If you select this you have no price but get promote product" class="fa fa-info-circle text-danger" style="font-size:20px;margin-left:35%" data-toggle="modal" data-target="#info"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="{{$country}}--addButtonShippingCourier" class="text-right" style="display:none">
                                                <button type="button" class="btn btn-info mb-3" onclick="add_more_shipping_courier('{{$country}}')">{{ __('Add More') }}</button>
                                            </div>
                                        </div>
                                            @endforeach
                                    </div>
                                </div>
                            </div>

                            <div class="form-box bg-white mt-4">
                                <div class="form-box-title px-3 py-2">
                                    {{__('Return Policy')}}
                                </div>
                                <div class="form-box-content p-3">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label>{{__('Return Days')}}</label>
                                        </div>
                                        <div class="col-md-10">
                                            <div class="mb-3">
                                                <select class="form-control selectpicker" name="return_policy_date_id" required>
                                                        <option value="selected" selected>{{__('Please select the Return Days')}}</option>
                                                        @foreach (App\ReturnPolicyDate::all() as $rpd)
                                                            <option value="{{$rpd->id}}">{{$rpd->days}}</option>
                                                        @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                              <div class="form-box bg-white mt-4">
                                <div class="form-box-title px-3 py-2">
                                    {{__('Free Customer Return')}}
                                     <div class="pull-right" >
                                    <label class="switch mt-1">
                                        <input type="checkbox" name="free_return_active" onchange="FreeReturnChange(this)" >
                                        <span class="slider round"></span>
                                    </label>
                                </div>

                                </div>
                                <div class="form-box-content p-3" id="freeReturn">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label>{{__('Free Return Validity')}}</label>
                                        </div>
                                        <div class="col-md-10">
                                            <div class="mb-3">
                                                <select class="form-control selectpicker" name="FreeReturn_id">
                                                        <option value="selected" selected>{{__('Please select the Free Return Validity')}}</option>
                                                        @foreach (App\FreeReturn::all() as $free_return)
                                                            <option value="{{$free_return->id}}">{{$free_return->days}}</option>
                                                        @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
			
			      <div class="form-box bg-white mt-4">
                                <div class="form-box-title px-3 py-2"  id="accessories" >
                                    {{__('Accessories (Maximum 4)')}}
                                       <div class="pull-right" data-toggle="tooltip" title="Maximum 4 accessory products" data-target="#info"  >
                                         <i class="fa fa-info-circle"></i>
                                       </div>
                                </div>
                                <div class="form-box-content p-3">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label>{{__('Accessories')}}</label>
                                        </div>
                                        <div class="col-md-10">
                                            <div class="mb-3">
                                                <select class="form-control selectpicker" data-placeholder="Select Accessories" name="accessories[]" multiple>
                                                        @foreach (App\Product::where('user_id',Auth::user()->id)->get() as $produuct)
                                                            <option value="{{$produuct->id}}">{{$produuct->name}}</option>
                                                        @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-box bg-white mt-4">
                                <div class="form-box-title px-3 py-2">
                                    {{__('Description')}}
                                </div>
                                <div class="form-box-content p-3">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label>{{__('Description')}}</label>
                                        </div>
                                        <div class="col-md-10">
                                            <div class="mb-3">
                                                <textarea class="editor" name="description"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                                 <div class="row">
                                    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
                                    <div class="col-lg-12">
                                        <div class="modal fade" id="photos_1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                            <div class="modal-content" style="    width: 164%;margin-left: -22%;">
                                                <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Product Images</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div  id="upload_button">
                                                        <div class="image-upload" style="display: block;text-align:center">
                                                            <label for="actual_input">
                                                             <img src="{{asset('uploads/shop/upload.jpg')}}" style="width: 25%;height:20vh"/>
                                                              <p>Upload Images and then Drag & Drop </p>
                                                            </label>
                                                          </div>
                                                        <input type="file" id="actual_input" name="photos[]" style="display: none"  class="btn btn-secondary" value="Upload Multiple Files" multiple onchange="afterImagesUpload(this)">
                                                    </div>
                                                    <script>$('.remove-files').click(function(e){id = e.target.id; values = $('#firstImage').val();var idToEliminate = id+','; values = values.replace(idToEliminate,'');$('#firstImage').val(values); $(this).parents('.img-upload-preview').remove();}); </script>

                                                    <div id="upload_div" class="upload_div_class" style="display: none">
                                                        <p style="text-align: center">Drag & Drop to set position</p>
                                                        <div id = "imageListId">
                                                        </div>
                                                    </div>

                                                    <input type="hidden" id="firstImage" value="null" name="firstImage">
                                                    <input type="hidden" id="itsFirst" value="true">

                                                </div>

                                                <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="button"  onclick="upload_save(this)" class="btn btn-primary">Save changes</button>
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <div class="form-box mt-4 text-right">
                                <button id="save_btn" type="submit" class="btn btn-styled btn-base-1">{{ __('Save') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal -->
    <div class="modal fade" id="categorySelectModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLabel">Select Wholesale Category</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="target-category heading-6">
                        <span class="mr-3">{{__('Target Wholesale Category')}}:</span>
                        <span>{{__('category')}} > {{__('subcategory')}} > {{__('subsubcategory')}}</span>
                    </div>
                    <div class="row no-gutters modal-categories mt-4 mb-2">
                        <div class="col-4">
                            <div class="modal-category-box c-scrollbar">
                                <div class="sort-by-box">
                                    <form role="form" class="search-widget">
                                        <input class="form-control input-lg" type="text" placeholder="Search Category" onkeyup="filterListItems(this, 'categories')">
                                        <button type="button" class="btn-inner">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </form>
                                </div>
                                <div class="modal-category-list has-right-arrow">
                                    <ul id="categories">
                                 @foreach ($categories as $key => $category)
                                        @if(App\PermissionSeller::where('seller_id',Auth::user()->id)->where('category_id',$category->id)->where('status',1)->first())
                                            <li onclick="get_subcategories_by_category(this, {{ $category->id }})">{{ __($category->name) }}
                                        @elseif(App\PermissionSeller::where('seller_id',Auth::user()->id)->where('category_id',$category->id)->where('status',0)->first())
                                        <li onclick="permission_grant(this, {{ $category->id }} , 1)">{{ __($category->name) }}
                                            <i class="fa fa-lock pull-right text-secondary"></i>
                                        @elseif($category->permission==1)
                                        <li onclick="permission_grant(this, {{ $category->id }} , 0)">{{ __($category->name) }}
                                            <i class="fa fa-lock pull-right text-secondary"></i>
                                        @else
                                            <li onclick="get_subcategories_by_category(this, {{ $category->id }})">{{ __($category->name) }}
                                        @endif
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="modal-category-box c-scrollbar" id="subcategory_list">
                                <div class="sort-by-box">
                                    <form role="form" class="search-widget">
                                        <input class="form-control input-lg" type="text" placeholder="Search SubCategory" onkeyup="filterListItems(this, 'subcategories')">
                                        <button type="button" class="btn-inner">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </form>
                                </div>
                                <div class="modal-category-list has-right-arrow">
                                    <ul id="subcategories">

                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="modal-category-box c-scrollbar" id="subsubcategory_list">
                                <div class="sort-by-box">
                                    <form role="form" class="search-widget">
                                        <input class="form-control input-lg" type="text" placeholder="Search SubSubCategory" onkeyup="filterListItems(this, 'subsubcategories')">
                                        <button type="button" class="btn-inner">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </form>
                                </div>
                                <div class="modal-category-list">
                                    <ul id="subsubcategories">

                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('cancel')}}</button>
                    <button type="button" class="btn btn-primary" onclick="closeModal()">{{__('Confirm')}}</button>
                </div>
            </div>
        </div>
    </div>
            <div class="modal fade" id="ticket_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-zoom product-modal" id="modal-size" role="document">
                    <div class="modal-content position-relative">
                        <div class="modal-header">
                            <h5 class="modal-title strong-600 heading-5">{{__('Create a Ticket')}}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body px-3 pt-3">
                            <form class="" action="{{ route('support_ticket.store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label>{{('Subject')}} <span class="text-danger">*</span></label>
                                <input type="text" class="form-control mb-3" disabled name="subject" value="" id="subject" placeholder="Subject" required>
                                </div>
                                <div class="form-group">
                                    <label>{{('Provide a detailed description')}} <span class="text-danger">*</span></label>
                                    <textarea class="form-control editor" name="details" id="details" placeholder="Type your reply" data-buttons="bold,underline,italic,|,ul,ol,|,paragraph,|,undo,redo"></textarea>
                                </div>
                                <div class="form-group">
                                    <input type="file" name="attachments[]" id="file" class="custom-input-file custom-input-file--2" data-multiple-caption="{count} files selected" multiple />
                                        <label for="file" class=" mw-100 mb-0">
                                        <i class="fa fa-upload"></i>
                                        <span>{{('Attach files.')}}</span>
                                    </label>
                                </div>
                                <div class="text-right mt-4">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('cancel')}}</button>
                                    <button type="submit"  class="btn btn-base-1">{{__('Send Ticket')}}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
@endsection

@section('script')
    <script type="text/javascript">

        var category_name = "";
        var subcategory_name = "";
        var subsubcategory_name = "";

        var category_id = null;
        var subcategory_id = null;
        var subsubcategory_id = null;

        $(document).ready(function(){

            $('#subcategory_list').hide();
            $('#subsubcategory_list').hide();
            $('.demo-select2').select2();
        });

        function ondelete(event,id){
                // $(event).parents(".col-md-3").remove();
            }

        function list_item_highlight(el){
            $(el).parent().children().each(function(){
                $(this).removeClass('selected');
            });
            $(el).addClass('selected');
        }

        function get_subcategories_by_category(el, cat_id){
            list_item_highlight(el);
            category_id = cat_id;
            subcategory_id = null;
            subsubcategory_id = null;
            category_name = $(el).html();
            $('#subcategories').html(null);
            $('#subsubcategory_list').hide();
            $.post('{{ route('subcategories.get_wholesale_subcategories_by_category') }}',{_token:'{{ csrf_token() }}', category_id:category_id}, function(data){
                for (var i = 0; i < data.length; i++) {
                    $('#subcategories').append('<li onclick="get_subsubcategories_by_subcategory(this, '+data[i].id+')">'+data[i].name+'</li>');
                }
                $('#subcategory_list').show();
            });
        }

        function get_subsubcategories_by_subcategory(el, subcat_id){
            list_item_highlight(el);
            subcategory_id = subcat_id;
            subsubcategory_id = null;
            subcategory_name = $(el).html();
            $('#subsubcategories').html(null);
            $.post('{{ route('subsubcategories.get_wholesale_subsubcategories_by_subcategory') }}',{_token:'{{ csrf_token() }}', subcategory_id:subcategory_id}, function(data){
                for (var i = 0; i < data.length; i++) {
                    $('#subsubcategories').append('<li onclick="confirm_subsubcategory(this, '+data[i].id+')">'+data[i].name+'</li>');
                }
                $('#subsubcategory_list').show();
            });
        }

        function confirm_subsubcategory(el, subsubcat_id){
            list_item_highlight(el);
            subsubcategory_id = subsubcat_id;
            subsubcategory_name = $(el).html();
    	}

        function get_attributes_by_subsubcategory(subsubcategory_id){
    		$.post('{{ route('subsubcategories.get_attributes_by_wholesale_subsubcategory') }}',{_token:'{{ csrf_token() }}', subsubcategory_id:subsubcategory_id}, function(data){
    		    $('#choice_attributes').html(null);
    		    for (var i = 0; i < data.length; i++) {
    		        $('#choice_attributes').append($('<option>', {
    		            value: data[i].id,
    		            text: data[i].name
    		        }));
    		    }
    		});
    	}

        function filterListItems(el, list){
            filter = el.value.toUpperCase();
            li = $('#'+list).children();
            for (i = 0; i < li.length; i++) {
                if ($(li[i]).html().toUpperCase().indexOf(filter) > -1) {
                    $(li[i]).show();
                } else {
                    $(li[i]).hide();
                }
            }
        }

        function closeModal(){
            if(category_id > 0 && subcategory_id > 0){
                $('#category_id').val(category_id);
                $('#subcategory_id').val(subcategory_id);
                $('#subsubcategory_id').val(subsubcategory_id);
                $('#product_category').html(category_name+'>'+subcategory_name+'>'+subsubcategory_name);
                $('#categorySelectModal').modal('hide');
            }
            else{
                alert('Please choose categories...');
            }
        }

        //var i = 0;
        function add_more_customer_choice_option(i, name){
    		$('#customer_choice_options').append('<div class="row mb-3"><div class="col-8 col-md-3 order-1 order-md-0"><input type="hidden" name="choice_no[]" value="'+i+'"><input type="text" class="form-control" name="choice[]" value="'+name+'" placeholder="Choice Title" readonly></div><div class="col-12 col-md-7 col-xl-8 order-3 order-md-0 mt-2 mt-md-0"><input type="text" class="form-control tagsInput" name="choice_options_'+i+'[]" placeholder="Enter choice values" onchange="update_sku()"></div><div class="col-4 col-xl-1 col-md-2 order-2 order-md-0 text-right"><button type="button" onclick="delete_row(this)" class="btn btn-link btn-icon text-danger"><i class="fa fa-trash-o"></i></button></div></div>');
    		// i++;
            $('.tagsInput').tagsinput('items');
    	}

    	$('input[name="colors_active"]').on('change', function() {
    	    if(!$('input[name="colors_active"]').is(':checked')){
    			$('#colors').prop('disabled', true);
    		}
    		else{
    			$('#colors').prop('disabled', false);
    		}
    		update_sku();
    	});

    	$('#colors').on('change', function() {
    	    update_sku();
    	});

    	$('input[name="unit_price"]').on('keyup', function() {
    	    update_sku();
    	});

        $('input[name="name"]').on('keyup', function() {
    	    update_sku();
    	});

        $('#choice_attributes').on('change', function() {
    		$('#customer_choice_options').html(null);
    		$.each($("#choice_attributes option:selected"), function(){
                add_more_customer_choice_option($(this).val(), $(this).text());
            });
    		update_sku();
    	});

    	function delete_row(em){
    		$(em).closest('.row').remove();
    		update_sku();
    	}

    	function update_sku(){
            $.ajax({
    		   type:"POST",
    		   url:'{{ route('products.sku_combination') }}',
    		   data:$('#choice_form').serialize(),
    		   success: function(data){
    			   $('#sku_combination').html(data);
    			   if (data.length > 1) {
    				   $('#quantity').hide();
    			   }
    			   else {
    			   		$('#quantity').show();
    			   }
    		   }
    	   });
    	}

        var photo_id = 2;
        function add_more_slider_image(){
            var photoAdd =  '<div class="row">';
            photoAdd +=  '<div class="col-2">';
            photoAdd +=  '<button type="button" onclick="delete_this_row(this)" class="btn btn-link btn-icon text-danger"><i class="fa fa-trash-o"></i></button>';
            photoAdd +=  '</div>';
            photoAdd +=  '<div class="col-10">';
            photoAdd +=  '<input type="file" name="photos[]" id="photos-'+photo_id+'" class="custom-input-file custom-input-file--4" data-multiple-caption="{count} files selected" multiple accept="image/*" />';
            photoAdd +=  '<label for="photos-'+photo_id+'" class="mw-100 mb-3">';
            photoAdd +=  '<span></span>';
            photoAdd +=  '<strong>';
            photoAdd +=  '<i class="fa fa-upload"></i>';
            photoAdd +=  "{{__('Choose image')}}";
            photoAdd +=  '</strong>';
            photoAdd +=  '</label>';
            photoAdd +=  '</div>';
            photoAdd +=  '</div>';
            $('#product-images').append(photoAdd);

            photo_id++;
            imageInputInitialize();
        }
        function delete_this_row(em){
            $(em).closest('.row').remove();
        }

        $('[data-toggle="tooltip"]').tooltip();


        function changeCatch(country,event){
            value = event.value;
            value = value.split('--');

            if(value[0] == 'free'){
                    $(`#${country}--free_shipping_data`).css('display','flex');
                    $(`#${country}--flat_shipping_data`).css('display','none');
                    $(`#${country}--courier_shipping_data`).css('display','none');
                    $(`#${country}--addButtonShippingCourier`).css('display','none');
            }
            else if(value[0] == 'flat_rate'){
                    $(`#${country}--free_shipping_data`).css('display','none');
                    $(`#${country}--flat_shipping_data`).css('display','flex');
                    $(`#${country}--courier_shipping_data`).css('display','none');
                    $(`#${country}--addButtonShippingCourier`).css('display','none');
            }
            else if(value[0] == 'courier'){
	            $(`.${country}_dafault_company_label`).fadeOut();
	            $('#save_btn').fadeOut();
                    $(`#${country}--free_shipping_data`).css('display','none');
                    $(`#${country}--flat_shipping_data`).css('display','none');
                    $(`#${country}--courier_shipping_data`).css('display','block');
                    $(`#${country}--addButtonShippingCourier`).css('display','block');
            }
            else{
                    $(`#${country}--free_shipping_data`).css('display','none');
                    $(`#${country}--flat_shipping_data`).css('display','none');
                    $(`#${country}--courier_shipping_data`).css('display','none');
                    $(`#${country}--addButtonShippingCourier`).css('display','none');
            }
        }

    increment=2;
        function add_more_shipping_courier(country){
           var shipping_data =
             `<div class="row"> <div class="col-2">
                <button type="button" onclick="delete_this_row_shipping('${country}',this,${increment})" class="btn btn-link btn-icon text-danger"><i class="fa fa-trash-o"></i></button> </div>
                <div class="col-md-8">
                        <select name="shipping_courier_type[]" class="form-control " onchange="premiumChange('{{$country}}',this)">
                            @foreach ($shipping as $ship)
                                <option value="{{$ship->id}}-{{$ship->premium}}-${increment}--${country}">{{$ship->name}}</option>
                            @endforeach
                        </select>
                </div>
                  <label class="switch mt-1 ${country}_dafault_company_label"   data-toggle="tooltip" title="set it default company">
                        <input type="checkbox" name="default_company[]" value="${country}_default" class="${country}_dafault_company" onchange="set_default_company(this,'${country}')" id="default">
                        <span class="slider round"></span>
                </label>
            </div>
            <br>
            <div class="row" id="${country}--premium_price${increment}">
                <div class="col-md-2">
                </div>
                <div class="col-md-8">
                    <input  type="number" min="0" step="0.01" value="0" class="form-control mb-3" name="shipping_courier_price[]" placeholder="{{__('Price')}}">
                </div>
            </div>
            <div class="row">
                <div class="col-md-6" id="${country}--premium_data${increment}" style="display: none">
                    <a> <i data-toggle="tooltip" title="If you select this you have no price but get promote product" class="fa fa-info-circle text-danger" style="font-size:20px;margin-left:35%" data-toggle="modal" data-target="#info"></i></a>
                </div>
            </div>
            `;

            $(`#${country}--courier_shipping_data`).append(shipping_data);
          
            increment++;
        }

            imageInputInitialize();

        function premiumChange(country,event){
            premium = event.value;
            premium = premium.split('-');
 			$(`.${country}_dafault_company`).val(`${country}__${premium[0]}`);
 
                    if(premium[1]=='on'){
                        $(`#${country}--premium_price`+premium[2]).css('display','none');
                        $(`#${country}--premium_data`+premium[2]).css('display','block');
                    }else{
                        $(`#${country}--premium_price`+premium[2]).css('display','flex');
                        $(`#${country}--premium_data`+premium[2]).css('display','none');
                    }
        }

        function delete_this_row_shipping(country,e,id){
            delete_this_row(e);
            $(`#${country}--premium_price`+id).css('display','none');
            $(`#${country}--premium_data`+id).css('display','none');
        }


var positions = String();
var stopif = 0;
var values='';
var filenames = [];
var clickafter = 0;

function afterImagesUpload(event){
    $('#imageListId').on('click','.remove-files',function(e){
        id = e.target.id;
           values = $('#firstImage').val();
           var idToEliminate = id+',';
           values = values.replace(idToEliminate,'');
           $('#firstImage').val(values);
           $(this).parents('.img-upload-preview').remove();
    })

    var files_exist = event.files[0];
    if(files_exist){
        $('#upload_div').css('display','block');
        var div = $('#imageListId');
        var files = document.getElementById('actual_input').files;
        if(files.length>7){
            alert('you added more then 7 images');
            return;
        }
        var j=stopif;
        let limit = stopif+files.length;
        for (i = stopif,k=0; i < limit; i++,k++) {
            if(stopif ==0){stopif = files.length;}
            const reader = new FileReader();
            reader.onload = () => {
            if(i==0){j=i-i;}
            value = `<div id="imageNo${j}" class = "listitemClass img-upload-preview"><img  id="imageSrc${j}"  class="${limit}" src="${String(reader.result)}" alt=""> <button type="button" class="btn btn-danger close-btn remove-files" id="${j}"><i class="fa fa-times"></i></button></div>`;
  		    j++;
            below_img = `<div id="image_below${j}" class="img-upload-preview"><img loading="lazy"  src="${String(reader.result)}" alt="" class="img-responsive"><button type="button" class="btn btn-danger close-btn " id="${j}")><i class="fa fa-times"></i></button></div><br>`;

            positions+= below_img;
            div.append(value);
            }
            reader.readAsDataURL(files[k]);
                if(k<(stopif)){
                    values+= i+',';
                }else{
                    values+= i;
                }

            }
            $('#firstImage').val(values);
    }


    if(clickafter>0){ $('#photos_1').modal('hide');} else {clickafter++;}

}

    $(function() {
        $( "#imageListId" ).sortable({
        update: function(event, ui) {
            document.getElementById('itsFirst').value = 'false';
            getIdsOfImages();
        }//end update
        });

    });

    function getIdsOfImages() {
    var values = [];
        $('.listitemClass').each(function (index) {
            values.push($(this).attr("id")
                    .replace("imageNo", ""));
        });
        $('#firstImage').val(values);
    }

    var clickOnce = 0;
    var oldValues = [];

    function upload_save(event){

        values = $('#firstImage').val();
        data = $('.upload_div_class');
        $('#below_image_test').append(data);
        itsFirst= $('#itsFirst').val();
        $('#firstImage').val(values);

        $('.remove-files').click(function(e){
           id = e.target.id;
           values = $('#firstImage').val();
           var idToEliminate = id+',';
           values = values.replace(idToEliminate,'');
           $('#firstImage').val(values);
           $(this).parents('.img-upload-preview').remove();
        });
        $('#photos_1').modal('hide');
    }
    


    function permission_grant(el, cat_id,status){
        list_item_highlight(el);
            category_id = cat_id;
            subcategory_id = null;
            subsubcategory_id = null;
            category_name = $(el).html();
            $('#subcategories').html(null);
            $('#subsubcategory_list').hide();

            if(status==1){
                $('#subcategories').append(`<button type="button" class="btn btn-danger text-white"  onclick="ticket_modal()"> Support Ticket </button>`);
                $('#subcategory_list').show();
            }else{
                $('#subcategories').append(`<button type="button" class="btn btn-danger text-white" onclick="requestPermission(${category_id})"> Permission Request </button>`);
                $('#subcategory_list').show();
}

    }

    function requestPermission(category_id){
    $.post('{{ route('wholesale_category.permission') }}',{_token:'{{ csrf_token() }}', category_id:category_id}, function(data){
            if(data=='true'){
                $('#categorySelectModal').modal('hide');
                showFrontendAlert('success', 'Request  successfully send');
                location.reload();
            }else{
                $('#categorySelectModal').modal('hide');
                showFrontendAlert('error', 'Try letter');
                location.reload();

            }
        });
    }

    function ticket_modal(subject){
        $('subject').val('Request for '+subject);
        $('#categorySelectModal').modal('hide');
        $('#ticket_modal').modal('show');
    }

    @if(App\SellerCountry::where('seller_id',Auth::user()->id)->first()->shipping_type != null)
        $('#shipDefault').css('display','none');
    @endif
    function shippingDefaultChange(el){

        if(el.checked){
            $('#shipDefault').css('display','none');
            $('#shipDefaultText').css('display','inline-block');
            $('#save_btn').fadeIn(); 
        }
        else{
            $('#shipDefault').css('display','block');
            $('#shipDefaultText').css('display','none');
        }
    }

    $('#freeReturn').css('display','none');
    function FreeReturnChange (el)
    {
        if(el.checked){
            $('#freeReturn').css('display','block');
        }
        else{
            $('#freeReturn').css('display','none');
        }
    }
        function set_default_company(el,country){
            if(!el.checked){$(`.${country}_dafault_company`).prop("disabled", false); $('#save_btn').fadeOut(); }
            else{$(`.${country}_dafault_company`).not(el).prop("disabled", true); $('#save_btn').fadeIn(); }
          }
    </script>
@endsection
