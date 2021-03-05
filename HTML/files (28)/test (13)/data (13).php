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
                        <!-- Page title -->
                        <div class="page-title">
                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <h2 class="heading heading-6 text-capitalize strong-600 mb-0">
                                        {{__('Update your product')}}
                                    </h2>
                                </div>
                                <div class="col-md-6">
                                    <div class="float-md-right">
                                        <ul class="breadcrumb">
                                            <li><a href="{{ route('home') }}">{{__('Home')}}</a></li>
                                            <li><a href="{{ route('dashboard') }}">{{__('Dashboard')}}</a></li>
                                            <li><a href="{{ route('seller.products') }}">{{__('Products')}}</a></li>
                                            <li class="active"><a href="{{ route('seller.products.edit', $product->id) }}">{{__('Edit Product')}}</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <form class="" action="{{route('products.update', $product->id)}}" method="POST" enctype="multipart/form-data" id="choice_form">
                            <input name="_method" type="hidden" value="POST">
                            <input type="hidden" name="id" value="{{ $product->id }}">
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
                                            <input type="text" readonly="true" class="form-control mb-3" name="name" placeholder="{{__('Product Name')}}" value="{{ __($product->name) }}">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label>{{__('Product Category')}} <span class="required-star">*</span></label>
                                        </div>
                                        <div class="col-md-10">
                                            @if ($product->subsubcategory != null)
                                                <div class="form-control mb-3 c-pointer" data-toggle="modal" data-target="#categorySelectModal" id="product_category">{{ $product->category->name.'>'.$product->subcategory->name.'>'.$product->subsubcategory->name }}</div>
                                            @else
                                                <div class="form-control mb-3 c-pointer" data-toggle="modal" data-target="#categorySelectModal" id="product_category">{{ $product->category->name.'>'.$product->subcategory->name }}</div>
                                            @endif
                                            <input type="hidden" name="category_id" id="category_id" value="{{ $product->category_id }}" required>
                                            <input type="hidden" name="subcategory_id" id="subcategory_id" value="{{ $product->subcategory_id }}" required>
                                            <input type="hidden" name="subsubcategory_id" id="subsubcategory_id" value="{{ $product->subsubcategory_id }}">
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
                                                        <option value="{{ $brand->id }}" @if($brand->id == $product->brand_id) selected @endif>{{ $brand->name }}</option>
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
                                            <input type="text" class="form-control mb-3" name="unit" placeholder="Product unit" value="{{ $product->unit }}">
                                        </div>
                                    </div>
                                     <div class="row">
                                        <div class="col-md-2">
                                            <label>{{__('SKU')}} </label>
                                        </div>
                                        <div class="col-md-10">
                                            <input type="text" readonly="true" class="form-control mb-3" value="{{$product->sku}}" name="sku" placeholder="SKU">
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row code_number" >
                                        <div class="col-md-2">
                                            <label>{{__('EAN/UPC/JAN')}}</label>
                                        </div>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control mb-3" value="{{$product->barcode_number}}" name="barcode_number" placeholder="{{__('EAN/UPC/JAN')}}">
                                        </div>
                                    </div>
                                      <div class="row">
                                            <div class="col-md-2">
                                                <label>{{__('Product Condition')}} <span class="required-star">*</span></label>
                                            </div>
                                            <div class="col-md-10">
                                            	 <select class="form-control mb-3 selectpicker" required data-placeholder="Select a product condition" id="product_condition" name="product_condition">
                                                    <option value="">{{ ('Please Select Product Condition') }}</option>
                                                    <option value="new" {{$product->product_condition=='new'?'selected':''}}>{{ ('New') }}</option>
                                                    <option value="used" {{$product->product_condition=='used'?'selected':''}}>{{ ('Used') }}</option>
                                                    <option value="refurbished" {{$product->product_condition=='refurbished'?'selected':''}}>{{ ('Refurbished') }}</option> 
                                                    <option value="faulty" {{$product->product_condition=='faulty'?'selected':''}}>{{ ('Faulty') }}</option>
                                                    <option value="damaged" {{$product->product_condition=='damaged'?'selected':''}}>{{ ('Damaged') }}</option>
                                                    <option value="parts" {{$product->product_condition=='parts'?'selected':''}}>{{ ('For Parts') }}</option>
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
            									<input type="text" class="form-control mb-3" name="barcode" placeholder="{{ __('Barcode') }}" value="{{ $product->barcode }}">
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
            										<input type="checkbox" name="refundable" @if ($product->refundable == 1) checked @endif>
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
                                                <div class="row">
                                                    @if ($product->photos != null)
                                                        @foreach (json_decode($product->photos) as $key => $photo)
                                                            <div class="col-md-3">
                                                                <div class="img-upload-preview">
                                                                    <img loading="lazy"  src="{{ asset($photo) }}" alt="" class="img-responsive">
                                                                    <input type="hidden" name="previous_photos[]" value="{{ $photo }}">
                                                                    <button type="button" class="btn btn-danger close-btn remove-files"><i class="fa fa-times"></i></button>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    @endif
                                                </div>
                                                <input type="file" name="photos[]" id="photos-1" class="custom-input-file custom-input-file--4" data-multiple-caption="{count} files selected" accept="image/*" />
                                                <label for="photos-1" class="mw-100 mb-3">
                                                    <span></span>
                                                    <strong>
                                                        <i class="fa fa-upload"></i>
                                                        {{__('Choose image')}}
                                                    </strong>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <button type="button" class="btn btn-info mb-3" onclick="add_more_slider_image()">{{ __('Add More') }}</button>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label>{{__('Thumbnail Image')}} <small>(290x300)</small> <span class="required-star">*</span></label>
                                        </div>
                                        <div class="col-md-10">
                                            <div class="row">
                                                @if ($product->thumbnail_img != null)
                                                    <div class="col-md-3">
                                                        <div class="img-upload-preview">
                                                            <img loading="lazy"  src="{{ asset($product->thumbnail_img) }}" alt="" class="img-responsive">
                                                            <input type="hidden" name="previous_thumbnail_img" value="{{ $product->thumbnail_img }}">
                                                            <button type="button" class="btn btn-danger close-btn remove-files"><i class="fa fa-times"></i></button>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                            <input type="file" name="thumbnail_img" id="file-2" class="custom-input-file custom-input-file--4" data-multiple-caption="{count} files selected" accept="image/*" />
                                            <label for="file-2" class="mw-100 mb-3">
                                                <span></span>
                                                <strong>
                                                    <i class="fa fa-upload"></i>
                                                    {{__('Choose image')}}
                                                </strong>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label>{{__('Featured')}} <small>(290x300)</small></label>
                                        </div>
                                        <div class="col-md-10">
                                            <div class="row">
                                                @if ($product->featured_img != null)
                                                    <div class="col-md-3">
                                                        <div class="img-upload-preview">
                                                            <img loading="lazy"  src="{{ asset($product->featured_img) }}" alt="" class="img-responsive">
                                                            <input type="hidden" name="previous_featured_img" value="{{ $product->featured_img }}">
                                                            <button type="button" class="btn btn-danger close-btn remove-files"><i class="fa fa-times"></i></button>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                            <input type="file" name="featured_img" id="file-3" class="custom-input-file custom-input-file--4" data-multiple-caption="{count} files selected" accept="image/*" />
                                            <label for="file-3" class="mw-100 mb-3">
                                                <span></span>
                                                <strong>
                                                    <i class="fa fa-upload"></i>
                                                    {{__('Choose image')}}
                                                </strong>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label>{{__('Flash Deal')}} <small>(290x300)</small></label>
                                        </div>
                                        <div class="col-md-10">
                                            <div class="row">
                                                @if ($product->flash_deal_img != null)
                                                    <div class="col-md-3">
                                                        <div class="img-upload-preview">
                                                            <img loading="lazy"  src="{{ asset($product->flash_deal_img) }}" alt="" class="img-responsive">
                                                            <input type="hidden" name="previous_flash_deal_img" value="{{ $product->flash_deal_img }}">
                                                            <button type="button" class="btn btn-danger close-btn remove-files"><i class="fa fa-times"></i></button>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                            <input type="file" name="flash_deal_img" id="file-4" class="custom-input-file custom-input-file--4" data-multiple-caption="{count} files selected" accept="image/*" />
                                            <label for="file-4" class="mw-100 mb-3">
                                                <span></span>
                                                <strong>
                                                    <i class="fa fa-upload"></i>
                                                    {{__('Choose image')}}
                                                </strong>
                                            </label>
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
                                                    <option value="youtube" <?php if($product->video_provider == 'youtube') echo "selected";?> >{{__('Youtube')}}</option>
            										<option value="dailymotion" <?php if($product->video_provider == 'dailymotion') echo "selected";?> >{{__('Dailymotion')}}</option>
            										<option value="vimeo" <?php if($product->video_provider == 'vimeo') echo "selected";?> >{{__('Vimeo')}}</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label>{{__('Video URL')}}</label>
                                        </div>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control mb-3" name="video_link" placeholder="{{__('Video link')}}" value="{{ $product->video_link }}">
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
                                            <input type="text" class="form-control mb-3" name="meta_title" value="{{ $product->meta_title }}" placeholder="{{__('Meta Title')}}">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label>{{__('Description')}}</label>
                                        </div>
                                        <div class="col-md-10">
                                            <textarea name="meta_description" rows="8" class="form-control mb-3">{{ $product->meta_description }}</textarea>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label>{{__('Meta Image')}}</label>
                                        </div>
                                        <div class="col-md-10">
                                            <div class="row">
                                                @if ($product->meta_img != null)
                                                    <div class="col-md-3">
                                                        <div class="img-upload-preview">
                                                            <img loading="lazy"  src="{{ asset($product->meta_img) }}" alt="" class="img-responsive">
                                                            <input type="hidden" name="previous_meta_img" value="{{ $product->meta_img }}">
                                                            <button type="button" class="btn btn-danger close-btn remove-files"><i class="fa fa-times"></i></button>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                            <input type="file" name="meta_img" id="file-5" class="custom-input-file custom-input-file--4" data-multiple-caption="{count} files selected" accept="image/*" />
                                            <label for="file-5" class="mw-100 mb-3">
                                                <span></span>
                                                <strong>
                                                    <i class="fa fa-upload"></i>
                                                    {{__('Choose image')}}
                                                </strong>
                                            </label>
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
        									<select class="form-control color-var-select" name="colors[]" id="colors" multiple>
                                                @foreach (\App\Color::orderBy('name', 'asc')->get() as $key => $color)
        											<option value="{{ $color->code }}" <?php if(in_array($color->code, json_decode($product->colors))) echo 'selected'?> >{{ $color->name }}</option>
        										@endforeach
        									</select>
                                        </div>
        								<div class="col-4 col-xl-1 col-md-2 order-2 order-md-0 text-right">
        									<label class="switch" style="margin-top:5px;">
                                                <input value="1" type="checkbox" name="colors_active" <?php if(count(json_decode($product->colors)) > 0) echo "checked";?> >
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
            											<option value="{{ $attribute->id }}" @if($product->attributes != null && in_array($attribute->id, json_decode($product->attributes, true))) selected @endif>{{ $attribute->name }}</option>
            										@endforeach
            			                        </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
        								<p>Choose the attributes of this product and then input values of each attribute</p>
        							</div>
                                    <div id="customer_choice_options">
                                        @foreach (json_decode($product->choice_options) as $key => $choice_option)
        									<div class="row mb-3">
        										<div class="col-8 col-md-3 order-1 order-md-0">
        											<input type="hidden" name="choice_no[]" value="{{ $choice_option->attribute_id }}">
        											<input type="text" class="form-control" name="choice[]" value="{{ \App\Attribute::find($choice_option->attribute_id)->name }}" placeholder="Choice Title" disabled>
        										</div>
        										<div class="col-12 col-md-7 col-xl-8 order-3 order-md-0 mt-2 mt-md-0">
        											<input type="text" class="form-control" name="choice_options_{{ $choice_option->attribute_id }}[]" placeholder="Enter choice values" value="{{ implode(',', $choice_option->values) }}" data-role="tagsinput" onchange="update_sku()">
        										</div>
        										<div class="col-4 col-xl-1 col-md-2 order-2 order-md-0 text-right">
                                                    <button type="button" onclick="delete_row(this)" class="btn btn-link btn-icon text-danger"><i class="fa fa-trash-o"></i></button>
                                                </div>
        									</div>
        								@endforeach
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
                                            <label>{{__('Price')}} <span class="required-star">*</span></label>
                                        </div>
                                        <div class="col-md-10">
                                            <input type="number" min="0" step="0.01" class="form-control mb-3" name="unit_price" placeholder="{{__('Unit Price')}} ({{__('Base Price')}})" value="{{$product->unit_price}}">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label>{{__('Purchased Price')}} <span class="required-star">*</span></label>
                                        </div>
                                        <div class="col-md-10">
                                            <input type="number" min="0" step="0.01" class="form-control mb-3" name="purchase_price" placeholder="{{__('Purchased Price')}}" value="{{$product->purchase_price}}" required>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label>{{__('Discount')}}</label>
                                        </div>
                                        <div class="col-8">
                                            <input type="number" min="0" step="0.01" class="form-control mb-3" name="discount" placeholder="{{__('Discount')}}" value="{{$product->discount}}">
                                        </div>
                                        <div class="col-md-2 col-4">
                                            <div class="mb-3">
                                                <select class="form-control selectpicker" name="discount_type" data-minimum-results-for-search="Infinity">
                                                    <option value="amount" <?php if($product->discount_type == 'amount') echo "selected";?> >$</option>
            	                                	<option value="percent" <?php if($product->discount_type == 'percent') echo "selected";?> >%</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" id="quantity">
                                        <div class="col-md-2">
                                            <label>{{__('Quantity')}} <span class="required-star">*</span></label>
                                        </div>
                                        <div class="col-md-10">
                                            <input type="number" min="0" step="1" class="form-control mb-3" name="current_stock" placeholder="{{__('Quantity')}}" value="{{$product->current_stock}}">
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
                                        <label class="switch" style="mt-1">
                                            <input type="checkbox" name="shipping_active" checked onchange="shippingDefaultChange(this)">
                                            <span class="slider round"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-box-content p-3"  id="shipDefault">
                                    <ul class="nav nav-tabs" role="tablist">
                                        @foreach(json_decode(App\SellerCountry::where('seller_id',Auth::user()->id)->first()->setCountries) as $key=>$country)
                                            <li class="nav-item">
                                                <a class="nav-link {{$key==0?'active':''}}" data-toggle="tab" href="#tabs-{{$key}}" role="tab">{{str_replace('_',' ',$country)}}</a>
                                            </li>
                                        @endforeach
                                    </ul>

                                    <div class="tab-content">
                                        <br>
                                        @foreach(json_decode(App\SellerCountry::where('seller_id',Auth::user()->id)->first()->setCountries) as $country_key=>$country)
                                         <div class="tab-pane {{$country_key==0?'active':''}}" id="tabs-{{$country_key}}" role="tabpanel">
                                            <div class="row">
                                                    <div class="col-md-2">
                                                        <label>{{__('Shiping Type')}}</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                            @php
                                                                $shipping_type_selected = explode('--',json_decode($product->shipping_type)[$country_key])[0];
                                                                 
                                                                $cost_shipping = explode('--',json_decode($product->shipping_cost)[$country_key]);
                                                                        if($product->default_courier_company && $country_key < count(json_decode($product->default_courier_company))){
                                                                            $shippingCourierDefault = explode('--',json_decode($product->default_courier_company)[$country_key]);
                                                                        }else{
                                                                            $shippingCourierDefault = null;
                                                                        }
                                                                if($cost_shipping[1] == $country){$cost_shipping = $cost_shipping[0];}
                                                            @endphp
                                                            <select name="shipping_type[]" onchange="changeCatch('{{$country}}',this)" class="form-control">
                                                                <option value="free--{{$country}}" @if ($shipping_type_selected=='free') selected @endif id="free">Free Shipping</option>
                                                                <option value="flat_rate--{{$country}}" @if ($shipping_type_selected=='flat_rate') selected @endif id="flat_rate">Flat Rate</option>
                                                                <option value="courier--{{$country}}" @if ($shipping_type_selected=='courier') selected @endif id="courier">Courier</option>
                                                            </select>
                                                    </div>
                                                   
                                                </div>
                                                <br>
                                                <div class="row"  id="{{$country}}--flat_shipping_data" @if ($shipping_type_selected=='flat_rate') style="display:flex" @else style="display: none" @endif>
                                                    <div class="col-md-2">
                                                        <label>{{__('Flat Rate')}}</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                    <input type="number" min="0" step="0.01"  class="form-control mb-3" name="shipping_flat_price[]" placeholder="{{__('Flat Rate Cost')}}" @if ($shipping_type_selected=='flat_rate') value="{{$cost_shipping}}" @endif>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <label class="switch" style="margin-top:5px;">
                                                            <input type="radio" name="shipping_flat_type" value="flat_rate" checked>
                                                            <span class="slider round"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            <div class="row" id="{{$country}}--free_shipping_data"  @if ($shipping_type_selected=='free') style="display:flex" @else style="display: none" @endif>
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
                                             @if($shipping_type_selected == 'courier')
                                                            <div id="{{$country}}--courier_shipping_data"  style="{{$shipping_type_selected=='courier'?'display:block':'display: none'}}">
                                                                @php      $shippingCourierPrice = json_decode($product->shipping_courier_price); $shippingCourierType = json_decode($product->shipping_courier_data); @endphp
                                                                @foreach ($shippingCourierType as $key=>$ship_courier_company_id_with_country)

                                                                    <div class="row"  @if ($shipping_type_selected!='courier') style="display: none" @endif >
                                                                        @php $ship_courier_company_id_with_country = explode('--',$ship_courier_company_id_with_country);  $get_id_courier_company = $ship_courier_company_id_with_country[0]; $get_country = $ship_courier_company_id_with_country[1];  $courier_company_prices = explode('--',$shippingCourierPrice[$key]); @endphp
                                                                            @if($country == $get_country)
                                                                                @php $courier_company = App\Shipping::findOrFail($get_id_courier_company); @endphp
                                                                                <div class="col-md-2">
                                                                                    @if($key==0)
                                                                                        <label>{{__('Courier Company')}}</label>
                                                                                    @else
                                                                                        <button type="button" onclick="delete_this_row_shipping('{{$country}}',this,{{$key}})" class="btn btn-link btn-icon text-danger"><i class="fa fa-trash-o"></i></button>
                                                                                    @endif
                                                                                </div>
                                                                                <div class="col-md-8">
                                                                                    <select name="shipping_courier_type[]" class="form-control demo-select2" onchange="premiumChange('{{$country}}',this)">
                                                                                        @foreach (App\Shipping::all() as $ship_all)
                                                                                            <option {{$ship_all->id==$courier_company->id?'selected':''}} value="{{$ship_all->id}}-{{$ship_all->premium}}-{{$key}}--{{$country}}">{{$ship_all->name}}</option>
                                                                                        @endforeach
                                                                                    </select>
                                                                                </div>
                                                                                <label class="switch mt-1 {{$country}}_dafault_company_label "   data-toggle="tooltip" title="set it default company">
                                                                                    <input type="checkbox"  class="{{$country}}_dafault_company @if($shippingCourierDefault) {{ $shippingCourierDefault[0] ==''.$get_country.'__'.$courier_company->id?'deault_country':''}}@endif"  @if($shippingCourierDefault) {{ $shippingCourierDefault[0] ==''.$get_country.'__'.$courier_company->id?'checked':''}}@endif  value="{{$country}}_default" name="default_company[]" id="default1" onchange="set_default_company(this,'{{$country}}')">
                                                                                    <span class="slider round"></span>
                                                                                </label>
                                                                            @endif
                                                                    </div>

                                                                    @if($get_country == $country)
                                                                        <div class="row" id="{{$country}}--premium_price{{$key}}"   style="{{$courier_company->premium == 'on'?'display: none':'display:flex' }}">
                                                                            <div class="col-md-2 mt-3">
                                                                                <label>{{__('Price')}}</label>
                                                                            </div>
                                                                            <div class="col-md-8 mt-3">
                                                                                <input  type="number" min="0" step="0.01" value="{{$courier_company_prices[0]}}" class="form-control mb-3" name="shipping_courier_price[]" placeholder="{{__('Price')}}" @if ($shipping_type_selected=='courier') value="{{$cost_shipping}}"  @endif>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">

                                                                            <div class="col-md-2 mt-3">
                                                                                <label>{{__('')}}</label>
                                                                            </div>
                                                                            <div class="col-md-8 mt-1 mb-1" id="{{$country}}--premium_data{{$key}}" style="{{$courier_company->premium == 'on'?'display:flex':'display:none'}}" >
                                                                                <a> <i data-toggle="tooltip" title="If you select this you have no price but get promote product" class="fa fa-info-circle text-danger" style="font-size:20px;margin-left:35%" data-toggle="modal" data-target="#info"></i></a>
                                                                            </div>
                                                                        </div>
                                                                    @endif

                                                                @endforeach
                                                            </div>
                                                        @else
                                                            <div id="{{$country}}--courier_shipping_data" style="display:none">
                                                                <div class="row" >
                                                                    <div class="col-md-2">
                                                                        <label>{{__('Courier Company')}}</label>
                                                                    </div>
                                                                    <div class="col-md-8">
                                                                            <select name="shipping_courier_type[]" class="form-control demo-select2" onchange="premiumChange('{{$country}}',this)">
                                                                                <option value="Selected" selected>Please Select Courier Company </option>
                                                                                @foreach (App\Shipping::all() as $ship)
                                                                                <option value="{{$ship->id}}-{{$ship->premium}}-1--{{$country}}">{{$ship->name}}</option>
                                                                                @endforeach
                                                                            </select>
                                                                    </div>
                                                                    <label class="switch mt-1 {{$country}}_dafault_company_label "   data-toggle="tooltip" title="set it default company">
                                                                        <input type="checkbox"  class="{{$country}}_dafault_company" value="{{$country}}_default" name="default_company[]" id="default1" onchange="set_default_company(this,'{{$country}}')">
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
                                                        @endif
                                            <div id="{{$country}}--addButtonShippingCourier" class="text-right" @if ($shipping_type_selected=='courier') style="display:block" @else style="display: none" @endif>

                                                <button type="button" class="btn btn-info mb-3" onclick="add_more_shipping_courier('{{$country}}')">{{ __('Add More') }}</button>
                                            </div>
                                        </div>
                                            @endforeach
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
                                                        <option value="selected" selected>Please select the Return Days</option>
                                                        @foreach (App\ReturnPolicyDate::all() as $rpd)
                                                            <option {{$product->return_policy_date_id==$rpd->id?'selected':''}} value="{{$rpd->id}}">{{$rpd->days}}</option>
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
                                        <input type="checkbox" name="free_return_active" {{$product->FreeReturn?'checked':''}} onchange="FreeReturnChange(this)" >
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
                                                <select class="form-control selectpicker" name="freeReturn">
                                                        <option value="selected" selected>Please select the Free Return Validity</option>
                                                        @foreach (App\FreeReturn::all() as $freeReturn)
                                                            <option {{$product->FreeReturn_id == $freeReturn->id?'selected':''}} value="{{$freeReturn->id}}">{{$freeReturn->days}}</option>
                                                        @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                             <div class="form-box bg-white mt-4">
                                <div class="form-box-title px-3 py-2">
                                    {{__('Accessories (Maximum 4)')}}
                                </div>
                                <div class="form-box-content p-3">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label>{{__('Accessories')}}</label>
                                        </div>
                                        <div class="col-md-10">
                                            <div class="mb-3">
                                                <select class="form-control selectpicker" id="accessories"  data-placeholder="Select Accessories" name="accessories[]" multiple>
                                                    @if(json_decode($product->accessories))
                                                        @foreach(json_decode($product->accessories) as $product_id)
                                                        @php $pro = App\Product::find($product_id); @endphp
                                                            <option selected value="{{$product_id}}">{{$pro->name}}</option>
                                                        @endforeach
                                                     @endif
                                                     @foreach (App\Product::where('user_id',Auth::user()->id)->get() as $produuct)
                                                        <option value="{{$product->id}}">{{$product->name}}</option>
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
                                                <textarea class="editor" name="description">{{$product->description}}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
        
                            <div class="form-box mt-4 text-right">
                                <button type="submit" id="edit_default" class="btn btn-styled btn-base-1">{{ __('Update This Product') }}</button>
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
                    <h6 class="modal-title" id="exampleModalLabel">{{__('Select Category')}}</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="target-category heading-6">
                        <span class="mr-3">{{__('Target Category')}}:</span>
                        <span>{{__('Category')}} > {{__('Subcategory')}} > {{__('Sub Subcategory')}}</span>
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
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('Cancel')}}</button>
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


       function set_default_setting() {
       el = $('.deault_country');
       country = (el.val().split('_default')[0]);
        if(el.checked){$(`.${country}_dafault_company`).prop("disabled", false); $('#edit_default').fadeOut(); }
        if(!el.checked){$(`.${country}_dafault_company`).not(el).prop("disabled", true); $('#edit_default').fadeIn(); }
}

        $(document).ready(function(){
            set_default_setting();
            $('#subcategory_list').hide();
            $('#subsubcategory_list').hide();
            //get_attributes_by_subsubcategory($('#subsubcategory_id').val());
            update_sku();

            $('.remove-files').on('click', function(){
                $(this).parents(".col-md-3").remove();
            });

            let courier_shipping_type = document.getElementsByClassName('courier_shipping_type');
            var shipping_ids_loop = 0;
            for(i=0;i<courier_shipping_type.length;i++){
                premium = courier_shipping_type[i].value;
                premium = premium.split('-');
                if(premium[1]=='on'){

                $('#premium_price'+premium[2]).css('display','none');
                $('#premium_data'+premium[2]).css('display','block');
            }else{
                $('#premium_price'+premium[2]).css('display','flex');
                $('#premium_data'+premium[2]).css('display','none');
            }
            shipping_ids_loop = i;
            }

        });

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

        // function get_brands_by_subsubcategory(subsubcat_id){
        //     $('#brands').html(null);
    	// 	$.post('{{ route('subsubcategories.get_brands_by_subsubcategory') }}',{_token:'{{ csrf_token() }}', subsubcategory_id:subsubcategory_id}, function(data){
    	// 	    for (var i = 0; i < data.length; i++) {
    	// 	        $('#brands').append($('<option>', {
    	// 	            value: data[i].id,
    	// 	            text: data[i].name
    	// 	        }));
    	// 	    }
    	// 	});
    	// }

        function get_attributes_by_subsubcategory(subsubcategory_id){
            // var subsubcategory_id = $('#subsubcategories').val();
    		$.post('{{ route('subsubcategories.get_attributes_by_subsubcategory') }}',{_token:'{{ csrf_token() }}', subsubcategory_id:subsubcategory_id}, function(data){
    		    $('#choice_attributes').html(null);
    		    for (var i = 0; i < data.length; i++) {
    		        $('#choice_attributes').append($('<option>', {
    		            value: data[i].id,
    		            text: data[i].name
    		        }));
    		    }
    			$("#choice_attributes > option").each(function() {
    				var str = @php echo $product->attributes @endphp;
    		        $("#choice_attributes").val(str).change();
    		    });
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
            if(category_id > 0 && subcategory_id > 0 && subsubcategory_id > 0){
                $('#category_id').val(category_id);
                $('#subcategory_id').val(subcategory_id);
                $('#subsubcategory_id').val(subsubcategory_id);
                $('#product_category').html(category_name+'>'+subcategory_name+'>'+subsubcategory_name);
                $('#categorySelectModal').modal('hide');
                //get_brands_by_subsubcategory(subsubcategory_id);
                //get_attributes_by_subsubcategory(subsubcategory_id);
            }
            else{
                alert('Please choose categories...');
                console.log(category_id);
                console.log(subcategory_id);
                console.log(subsubcategory_id);
                //showAlert();
            }
        }

        // var i = $('input[name="choice_no[]"').last().val();
        // if(isNaN(i)){
    	// 	i =0;
    	// }

        function add_more_customer_choice_option(i, name){
            //i++;
    		$('#customer_choice_options').append('<div class="row mb-3"><div class="col-8 col-md-3 order-1 order-md-0"><input type="hidden" name="choice_no[]" value="'+i+'"><input type="text" class="form-control" name="choice[]" value="'+name+'" placeholder="Choice Title" readonly></div><div class="col-12 col-md-7 col-xl-8 order-3 order-md-0 mt-2 mt-md-0"><input type="text" class="form-control tagsInput" name="choice_options_'+i+'[]" placeholder="Enter choice values" onchange="update_sku()"></div><div class="col-4 col-xl-1 col-md-2 order-2 order-md-0 text-right"><button type="button" onclick="delete_row(this)" class="btn btn-link btn-icon text-danger"><i class="fa fa-trash-o"></i></button></div></div>');
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

    	// $('input[name="unit_price"]').on('keyup', function() {
    	//     update_sku();
    	// });
        //
        // $('input[name="name"]').on('keyup', function() {
    	//     update_sku();
    	// });

        $('#choice_attributes').on('change', function() {
    		//$('#customer_choice_options').html(null);
    		$.each($("#choice_attributes option:selected"), function(j, attribute){
    			flag = false;
    			$('input[name="choice_no[]"]').each(function(i, choice_no) {
    				if($(attribute).val() == $(choice_no).val()){
    					flag = true;
    				}
    			});
                if(!flag){
    				add_more_customer_choice_option($(attribute).val(), $(attribute).text());
    			}
            });

    		var str = @php echo $product->attributes @endphp;

    		$.each(str, function(index, value){
    			flag = false;
    			$.each($("#choice_attributes option:selected"), function(j, attribute){
    				if(value == $(attribute).val()){
    					flag = true;
    				}
    			});
                if(!flag){
    				//console.log();
    				$('input[name="choice_no[]"][value="'+value+'"]').parent().parent().remove();
    			}
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
    		   url:'{{ route('products.sku_combination_edit') }}',
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
                    $('#edit_default').fadeOut();
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
           var shipping_data =  `<div class="row">
                <div class="col-2">
                <button type="button" onclick="delete_this_row_shipping('${country}',this,${increment})" class="btn btn-link btn-icon text-danger"><i class="fa fa-trash-o"></i></button>
                </div>
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


    @if(App\SellerCountry::where('seller_id',Auth::user()->id)->first()->shipping_type != null)
        $('#shipDefault').css('display','none');
    @endif
    function shippingDefaultChange(el){
        console.log(76);
        if(el.checked){
            $('#shipDefault').css('display','none');
            $('#shipDefaultText').css('display','inline-block');
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
            if(!el.checked){$(`.${country}_dafault_company`).prop("disabled", false); $('#edit_default').fadeOut(); }
            else{$(`.${country}_dafault_company`).not(el).prop("disabled", true); $('#edit_default').fadeIn(); }
          }

</script>

@endsection
