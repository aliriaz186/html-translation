@extends('frontend.layouts.app')

	<link href ="https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css"rel = "stylesheet">
	<script src ="https://code.jquery.com/jquery-1.10.2.js"></script>
	<script src ="https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>


	<style>

		/* text align for the body */
/*
		/* image dimension */
		/* img{
			height: 200px;
			width: 350px;
		} */ */

		/* imagelistId styling */
		#imageListId , #below_image
		{
		margin: 0;
		padding: 0;
		list-style-type: none;
		}
		#imageListId div , #below_image div
		{
			margin: 0 4px 4px 4px;
			padding: 0.4em;
            display: inline-block;
            width: 17%;
		}

        #imageListId div img , #below_image div img{
            width: 100%;
            height: 18vh;
        }




		/* Output order styling */
		#outputvalues{
		margin: 0 2px 2px 2px;
		padding: 0.4em;
		padding-left: 1.5em;
		width: 250px;
		border: 2px solid dark-green;
		background : gray;
		}
		.listitemClass
		{
			border: 1px solid #006400;
			width: 350px;
		}
		.height{
			height: 10px;
		}
	</style>
@section('content')

    <section class="gry-bg py-4 profile">
        <div class="container-fluid p-4">
            <div class="row cols-xs-space cols-sm-space cols-md-space">
                <div class="col-lg-2-1 d-none d-lg-block">
                    @include('frontend.inc.seller_side_nav')
                </div>

                <div class="col-lg-9">
                    <div class="main-content">
                        <!-- Page title -->
                        <div class="page-title">
                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <h2 class="heading heading-6 text-capitalize strong-600 mb-0">
                                        {{__('Add Your Product')}}
                                    </h2>
                                </div>
                                <div class="col-md-6">
                                    <div class="float-md-right">
                                        <ul class="breadcrumb">
                                            <li><a href="{{ route('home') }}">{{__('Home')}}</a></li>
                                            <li><a href="{{ route('dashboard') }}">{{__('Dashboard')}}</a></li>
                                            <li><a href="{{ route('seller.products') }}">{{__('Products')}}</a></li>
                                            <li class="active"><a href="{{ route('seller.products.upload') }}">{{__('Add New Product')}}</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <form class="" action="{{route('products.store')}}" method="POST" enctype="multipart/form-data" id="choice_form">
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
                                            <label>{{__('Product Category')}} <span class="required-star">*</span></label>
                                        </div>
                                        <div class="col-md-10">
                                            <div class="form-control mb-3 c-pointer" data-toggle="modal" data-target="#categorySelectModal" id="product_category">{{__('Select a category')}}</div>
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
                                            <label>{{__('Product Tag')}} <span class="required-star">*</span></label>
                                        </div>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control mb-3 tagsInput" name="tags[]" placeholder="Type & hit enter" data-role="tagsinput" required>
                                        </div>
                                    </div>
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
                                                {{-- <input type="file" name="photos[]" id="photos-1" class="custom-input-file custom-input-file--4" data-multiple-caption="{count} files selected" required accept="image/*" /> --}}
                                                <label for="photos_1" class="mw-100 mb-3" data-toggle="modal" data-target="#photos_1">
                                                    <span></span>
                                                    <strong>
                                                        <i class="fa fa-upload"></i>
                                                        {{__('Choose image')}}
                                                    </strong>
                                                </label>
                                            </div>
                                            <br>
                                            <div id="below_image"></div>
                                        </div>
                                    </div>
                                    {{-- <div class="text-right">
                                        <button type="button" class="btn btn-info mb-3" onclick="add_more_slider_image()">{{ __('Add More') }}</button>
                                    </div> --}}
                                    {{-- <div class="row">
                                        <div class="col-md-2">
                                            <label>{{__('Thumbnail Image')}} <small>(290x300)</small> <span class="required-star">*</span></label>
                                        </div>
                                        <div class="col-md-10">
                                            <input type="file" name="thumbnail_img" id="file-2" class="custom-input-file custom-input-file--4" data-multiple-caption="{count} files selected" accept="image/*" />
                                            <label for="file-2" class="mw-100 mb-3">
                                                <span></span>
                                                <strong>
                                                    <i class="fa fa-upload"></i>
                                                    {{__('Choose image')}}
                                                </strong>
                                            </label>
                                        </div>
                                    </div> --}}
                                    {{-- <div class="row">
                                        <div class="col-md-2">
                                            <label>{{__('Featured')}} <small>(290x300)</small></label>
                                        </div>
                                        <div class="col-md-10">
                                            <input type="file" name="featured_img" id="file-3" class="custom-input-file custom-input-file--4" data-multiple-caption="{count} files selected" accept="image/*" />
                                            <label for="file-3" class="mw-100 mb-3">
                                                <span></span>
                                                <strong>
                                                    <i class="fa fa-upload"></i>
                                                    {{__('Choose image')}}
                                                </strong>
                                            </label>
                                        </div>
                                    </div> --}}
                                    {{-- <div class="row">
                                        <div class="col-md-2">
                                            <label>{{__('Flash Deal')}} <small>(290x300)</small></label>
                                        </div>
                                        <div class="col-md-10">
                                            <input type="file" name="flash_deal_img" id="file-4" class="custom-input-file custom-input-file--4" data-multiple-caption="{count} files selected" accept="image/*" />
                                            <label for="file-4" class="mw-100 mb-3">
                                                <span></span>
                                                <strong>
                                                    <i class="fa fa-upload"></i>
                                                    {{__('Choose image')}}
                                                </strong>
                                            </label>
                                        </div>
                                    </div> --}}
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
                                    {{-- <div class="row">
                                        <div class="col-md-2">
                                            <label>{{__('Meta Image')}} <span class="required-star">*</span></label>
                                        </div>
                                        <div class="col-md-10">
                                            <input type="file" name="meta_img" id="file-5" class="custom-input-file custom-input-file--4" data-multiple-caption="{count} files selected" accept="image/*" />
                                            <label for="file-5" class="mw-100 mb-3">
                                                <span></span>
                                                <strong>
                                                    <i class="fa fa-upload"></i>
                                                    {{__('Choose image')}}
                                                </strong>
                                            </label>
                                        </div>
                                    </div> --}}
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
        									<select class="form-control color-var-select" name="colors[]" id="colors" multiple>
        										@foreach (\App\Color::orderBy('name', 'asc')->get() as $key => $color)
        											<option value="{{ $color->code }}">{{ $color->name }}</option>
        										@endforeach
        									</select>
        								</div>
        								<div class="col-4 col-xl-1 col-md-2 order-2 order-md-0 text-right">
        									<label class="switch" style="margin-top:5px;">
        										<input value="1" type="checkbox" name="colors_active" checked>
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
        								<p>Choose the attributes of this product and then input values of each attribute</p>
        							</div>
                                    <div id="customer_choice_options">

                                    </div>
                                    {{-- <div class="row">
                                        <div class="col-2">
        									<button type="button" class="btn btn-info" onclick="add_more_customer_choice_option()">{{ __('Add More Customer Choice Option') }}</button>
        								</div>
                                    </div> --}}
                                </div>
                            </div>
                            <div class="form-box bg-white mt-4">
                                <div class="form-box-title px-3 py-2">
                                    {{__('Price')}}
                                </div>
                                <div class="form-box-content p-3">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label>{{__('Unit Price')}} <span class="required-star">*</span></label>
                                        </div>
                                        <div class="col-md-10">
                                            <input type="number" min="0" value="0" step="0.01" class="form-control mb-3" name="unit_price" placeholder="{{__('Unit Price')}} ({{__('Base Price')}})" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label>{{__('Purchase Price')}} <span class="required-star">*</span></label>
                                        </div>
                                        <div class="col-md-10">
                                            <input type="number" min="0" value="0" step="0.01" class="form-control mb-3" name="purchase_price" placeholder="{{__('Purchase Price')}}" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label>{{__('Tax')}}</label>
                                        </div>
                                        <div class="col-8">
                                            <input type="number" min="0" value="0" step="0.01" class="form-control mb-3" name="tax" placeholder="{{__('Tax')}}" required>
                                        </div>
                                        <div class="col-4 col-md-2">
                                            <div class="mb-3">
                                                <select class="form-control selectpicker" name="tax_type" data-minimum-results-for-search="Infinity">
                                                    <option value="amount">$</option>
                                                    <option value="percent">%</option>
                                                </select>
                                            </div>
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
                                                    <option value="amount">$</option>
                                                    <option value="percent">%</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" id="quantity">
                                        <div class="col-md-2">
                                            <label>{{__('Quantity')}} <span class="required-star">*</span></label>
                                        </div>
                                        <div class="col-md-10">
                                            <input type="number" min="0" value="0" step="1" class="form-control mb-3" name="current_stock" placeholder="{{__('Quantity')}}" required>
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
                                    {{__('Shipping')}}
                                </div>

                                <div class="form-box-content p-3">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label>{{__('Shiping Type')}}</label>
                                        </div>
                                        <div class="col-md-8">
                                                <select name="shipping_type" id="shipping_type" class="form-control">
                                                    <option value="selected" selected>Selct Shipping Type</option>
                                                    <option value="free">Free Shipping</option>
                                                    <option value="flat_rate">Flat Rate</option>
                                                    <option value="courier">Courier</option>
                                                </select>
                                        </div>
                                    </div>
                                <br>

                                {{-- upload Images  --}}
                                <div class="row">
                                    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
                                    <div class="col-lg-12">
                                        <div class="modal fade" id="photos_1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                            <div class="modal-content" style="    width: 164%;margin-left: -22%;">
                                                <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
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

                                                    <div id="upload_div" style="display: none">
                                                        <p style="text-align: center">Drag & Drop to set position</p>
                                                        <div id = "imageListId">
                                                        </div>
                                                    </div>

                                                    <input type="hidden" id="firstImage" value="null" name="firstImage">
                                                    <input type="hidden" id="itsFirst" value="true">

                                                </div>

                                                <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="button"  onclick="upload_save(this)" class="btn btn-danger">Save changes</button>
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                    <div class="row"  id="flat_shipping_data" style="display:none">
                                        <div class="col-md-2">
                                            <label>{{__('Flat Rate')}}</label>
                                        </div>
                                        <div class="col-md-8">
                                            <input type="number" min="0" step="0.01" value="0" class="form-control mb-3" name="shipping_flat_price" placeholder="{{__('Flat Rate Cost')}}">
                                        </div>
                                        <div class="col-md-2">
                                            <label class="switch" style="margin-top:5px;">
                                                <input type="radio" name="shipping_flat_type" value="flat_rate" checked>
                                                <span class="slider round"></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="row" id="free_shipping_data" style="display:none">
                                        <div class="col-md-2">
                                            <label>{{__('Free Shipping')}}</label>
                                        </div>
                                        <div class="col-md-8">
                                            <input type="number" min="0" step="0.01" value="0" class="form-control mb-3" name="shipping_free_price" value="0" disabled placeholder="{{__('Flat Rate Cost')}}">
                                        </div>
                                        <div class="col-md-2">
                                            <label class="switch" style="margin-top:5px;">
                                                <input type="radio" name="shipping_free_type" value="free" checked>
                                                <span class="slider round"></span>
                                            </label>
                                        </div>
                                    </div>

                                    <div id="courier_shipping_data" style="display:none">
                                        <div class="row" >
                                            <div class="col-md-2">
                                                <label>{{__('Courier Company')}}</label>
                                            </div>
                                            <div class="col-md-8">
                                                    <select name="shipping_courier_type[]" class="form-control courier_shipping_type">
                                                        <option value="Selected" selected>Please Select Courier Company </option>
                                                        @foreach ($shipping as $ship)
                                                        <option value="{{$ship->id}}-{{$ship->premium}}-1">{{$ship->name}}</option>
                                                        @endforeach
                                                    </select>
                                            </div>
                                        </div>
                                       <br>
                                        <div class="row" id="premium_price1">
                                            <div class="col-md-2">
                                                <label>{{__('Price')}}</label>
                                            </div>
                                            <div class="col-md-8">
                                                <input  type="number" min="0" step="0.01" value="0" class="form-control mb-3" name="shipping_courier_price[]" placeholder="{{__('Price')}}">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6" id="premium_data1" style="display: none">
                                                <a> <i data-toggle="tooltip" title="If you select this you have no price but get promote product" class="fa fa-info-circle text-danger" style="font-size:20px;margin-left:35%" data-toggle="modal" data-target="#info"></i></a>
                                            </div>
                                        </div>

                                </div>

                                <div id="addButtonShippingCourier" class="text-right" style="display:none">
                                    <button type="button" class="btn btn-info mb-3" onclick="add_more_shipping_courier()">{{ __('Add More') }}</button>
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
                            <div class="form-box bg-white mt-4">
                                <div class="form-box-title px-3 py-2">
                                    {{__('PDF Specification')}}
                                </div>
                                <div class="form-box-content p-3">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label>{{__('PDF')}}</label>
                                        </div>
                                        <div class="col-md-10">
                                            <input type="file" name="pdf" id="file-6" class="custom-input-file custom-input-file--4" data-multiple-caption="{count} files selected" accept="pdf/*" />
                                            <label for="file-6" class="mw-100 mb-3">
                                                <span></span>
                                                <strong>
                                                    <i class="fa fa-upload"></i>
                                                    {{__('Choose PDF')}}
                                                </strong>
                                            </label>
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
                    <h6 class="modal-title" id="exampleModalLabel">Select Category</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="target-category heading-6">
                        <span class="mr-3">{{__('Target Category')}}:</span>
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
                                            <li onclick="get_subcategories_by_category(this, {{ $category->id }})">{{ __($category->name) }}</li>
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
        });

        function ondelete(event,id){
                console.log(id);
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
            $.post('{{ route('subcategories.get_subcategories_by_category') }}',{_token:'{{ csrf_token() }}', category_id:category_id}, function(data){
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
            $.post('{{ route('subsubcategories.get_subsubcategories_by_subcategory') }}',{_token:'{{ csrf_token() }}', subcategory_id:subcategory_id}, function(data){
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
    		$.post('{{ route('subsubcategories.get_attributes_by_subsubcategory') }}',{_token:'{{ csrf_token() }}', subsubcategory_id:subsubcategory_id}, function(data){
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

        $('#shipping_type').change(function(){
                if(this.value == 'free'){
                    $('#free_shipping_data').css('display','flex');
                    $('#flat_shipping_data').css('display','none');
                    $('#courier_shipping_data').css('display','none');
                    $('#addButtonShippingCourier').css('display','none');
                }else if(this.value == 'flat_rate'){
                    $('#free_shipping_data').css('display','none');
                    $('#flat_shipping_data').css('display','flex');
                    $('#courier_shipping_data').css('display','none');
                    $('#addButtonShippingCourier').css('display','none');

                }else{
                    $('#free_shipping_data').css('display','none');
                    $('#flat_shipping_data').css('display','none');
                    $('#courier_shipping_data').css('display','block');
                    $('#addButtonShippingCourier').css('display','block');

                }
        })


        var shipping_id = 2;
        function add_more_shipping_courier(){
           var shipping_data =  `<div class="row">
                <div class="col-2">
                <button type="button" onclick="delete_this_row_shipping(this,${shipping_id})" class="btn btn-link btn-icon text-danger"><i class="fa fa-trash-o"></i></button>
                </div>
                <div class="col-md-8">
                        <select name="shipping_courier_type[]" class="form-control courier_shipping_type" onchange('changeData(this)')>
                            @foreach ($shipping as $ship)
                            <option value="{{$ship->id}}-{{$ship->premium}}-${shipping_id}">{{$ship->name}}</option>
                            @endforeach
                        </select>
                </div>
            </div>
            <br>
            <div class="row" id="premium_price${shipping_id}">
                <div class="col-md-2">
                </div>
                <div class="col-md-8">
                    <input  type="number" min="0" step="0.01" value="0" class="form-control mb-3" name="shipping_courier_price[]" placeholder="{{__('Price')}}">
                </div>
            </div>
            <div class="row">
                <div class="col-md-6" id="premium_data${shipping_id}" style="display: none">
                    <a> <i data-toggle="tooltip" title="If you select this you have no price but get promote product" class="fa fa-info-circle text-danger" style="font-size:20px;margin-left:35%" data-toggle="modal" data-target="#info"></i></a>
                </div>
            </div>
`

            $('#courier_shipping_data').append(shipping_data);

            shipping_id++;
            imageInputInitialize();
        }


        function delete_this_row_shipping(e,id){
            delete_this_row(e);
            $('#premium_price'+id).css('display','none');
            $('#premium_data'+id).css('display','none');
    }



$(document).on("change",'.courier_shipping_type',function(){
    premium = this.value;
            premium = premium.split('-');

            if(premium[1]=='on'){
                $('#premium_price'+premium[2]).css('display','none');
                $('#premium_data'+premium[2]).css('display','block');
            }else{
                $('#premium_price'+premium[2]).css('display','flex');
                $('#premium_data'+premium[2]).css('display','none');
            }

});


var positions = String();
var stopif = 0;
var values='';
var filenames = [];

function afterImagesUpload(event){
    var files_exist = event.files[0];

    if(files_exist){

        // $('#upload_button').css('display','none');
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
                j++;
            value = `
            <div id="imageNo${j}" class = "listitemClass">
                <img  id="imageSrc${j}"  class="${limit}" src="${String(reader.result)}" alt="">
            </div>
            `;

            below_img = `
            <div id="image_below${j}" class="img-upload-preview">
                <img loading="lazy"  src="${String(reader.result)}" alt="" class="img-responsive">
                <button type="button" class="btn btn-danger close-btn remove-files" id="${j}" onclick("ondelete(this,delete${j})")><i class="fa fa-times"></i></button>
            </div>
            <br>
            `
            ;

            positions+= below_img;
            div.append(value);
            }
            reader.readAsDataURL(files[k]);
                if(k<(stopif)){
                    values+= i+',';
                    if(i==files.length){stopif+=1;}
                }else{
                    values+= i;
                }
            console.log('i = ' ,i , 'k = ', k ,'stopif = ' , stopif , 'values = [ ' , values , ' ]' , 'file_length' ,  files.length);

            }

            $('#firstImage').val(values);
    }
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

        var div_image_bellow = $('#below_image');
        itsFirst= $('#itsFirst').val();

        pos = positions.split('<br>');
        values = values.split(',');

        for(i=0;i<(pos.length-1);i++)
        {

            if(itsFirst=='true'){

                if(typeof pos[values[i]] !==undefined){
                    if(clickOnce > 0){

                        ids = 'image_below'+(parseInt(oldValues[i])+1);
                        idsToRemove = document.getElementById(ids);
                        if(idsToRemove!=null){
                            idsToRemove.remove();
                            console.log('values = ',values,'oldValues' , oldValues ,'i = ' , i  ,'length = ' ,pos.length-1 , 'valuesLength = ', parseInt(oldValues[i])+1);
                            // oldValues=[];
                            // oldValues.push(values[i]);

                        }
                        // idsToRemove.remove();

                    }else{
                        oldValues.push(values[i]);
                    }

                  div_image_bellow.append(pos[values[i]]);
            }
            }else{

                if(typeof pos[values[i]-1] !==undefined){
                  div_image_bellow.append(pos[values[i]-1]);
            }

        }
        $('#photos_1').modal('hide');
        }

        $('.remove-files').click(function(e){
           id = e.target.id;
           values = $('#firstImage').val();

           var idToEliminate = id+',';

            values = values.replace(idToEliminate,'');

            $('#firstImage').val(values);
           $(this).parents('.img-upload-preview').remove();

        });

        clickOnce++;

    }
</script>
@endsection
