@extends('layouts.app')

@section('content')

<div class="row">
	<form class="form form-horizontal mar-top" action="{{route('products.update', $product->id)}}" method="POST" enctype="multipart/form-data" id="choice_form">
		<input name="_method" type="hidden" value="POST">
		<input type="hidden" name="id" value="{{ $product->id }}">
		@csrf
		<div class="panel">
			<div class="panel-heading">
				<h3 class="panel-title">{{__('Product Information')}}</h3>
			</div>
			<div class="panel-body">
				<div class="tab-base ">
				    <!--Nav tabs-->
				    <ul class="nav nav-tabs">
						<li class="active">
				            <a data-toggle="tab" href="#demo-stk-lft-tab-1" aria-expanded="true">{{__('General')}}</a>
				        </li>
				        <li class="">
				            <a data-toggle="tab" href="#demo-stk-lft-tab-2" aria-expanded="false">{{__('Images')}}</a>
				        </li>
						<li class="">
				            <a data-toggle="tab" href="#demo-stk-lft-tab-3" aria-expanded="false">{{__('Videos')}}</a>
				        </li>
				        <li class="">
				            <a data-toggle="tab" href="#demo-stk-lft-tab-4" aria-expanded="false">{{__('Meta Tags')}}</a>
				        </li>
						<li class="">
				            <a data-toggle="tab" href="#demo-stk-lft-tab-5" aria-expanded="false">{{__('Customer Choice')}}</a>
				        </li>
						<li class="">
				            <a data-toggle="tab" href="#demo-stk-lft-tab-6" aria-expanded="false">{{__('Price')}}</a>
				        </li>
						<li class="">
				            <a data-toggle="tab" href="#demo-stk-lft-tab-7" aria-expanded="false">{{__('Description')}}</a>
				        </li>
						<li class="">
				            <a data-toggle="tab" href="#demo-stk-lft-tab-9" aria-expanded="false">{{__('Shipping Info')}}</a>
				        </li>
						<li class="">
				            <a data-toggle="tab" href="#demo-stk-lft-tab-10" aria-expanded="false">{{__('PDF Specification')}}</a>
				        </li>
				    </ul>

				    <!--Tabs Content-->
				    <div class="tab-content">
				        <div id="demo-stk-lft-tab-1" class="tab-pane fade active in">
							<div class="form-group">
	                            <label class="col-lg-2 control-label">{{__('Product Name')}}</label>
	                            <div class="col-lg-7">
	                                <input type="text" class="form-control" name="name" placeholder="{{__('Product Name')}}" value="{{$product->name}}" required>
	                            </div>
	                        </div>
	                        <div class="form-group" id="category">
	                            <label class="col-lg-2 control-label">{{__('Category')}}</label>
	                            <div class="col-lg-7">
	                                <select class="form-control demo-select2-placeholder" name="category_id" id="category_id" required>
	                                	<option>Select an option</option>
	                                	@foreach($categories as $category)
	                                	    <option value="{{$category->id}}" <?php if($product->category_id == $category->id) echo "selected"; ?> >{{__($category->name)}}</option>
	                                	@endforeach
	                                </select>
	                            </div>
	                        </div>
	                        <div class="form-group" id="subcategory">
	                            <label class="col-lg-2 control-label">{{__('Subcategory')}}</label>
	                            <div class="col-lg-7">
	                                <select class="form-control demo-select2-placeholder" name="subcategory_id" id="subcategory_id" required>

	                                </select>
	                            </div>
	                        </div>
	                        <div class="form-group" id="subsubcategory">
	                            <label class="col-lg-2 control-label">{{__('Sub Subcategory')}}</label>
	                            <div class="col-lg-7">
	                                <select class="form-control demo-select2-placeholder" name="subsubcategory_id" id="subsubcategory_id">

	                                </select>
	                            </div>
	                        </div>
	                        <div class="form-group" id="brand">
	                            <label class="col-lg-2 control-label">{{__('Brand')}}</label>
	                            <div class="col-lg-7">
	                                <select class="form-control demo-select2-placeholder" name="brand_id" id="brand_id">
										<option value="">{{ ('Select Brand') }}</option>
										@foreach (\App\Brand::all() as $brand)
											<option value="{{ $brand->id }}" @if($product->brand_id == $brand->id) selected @endif>{{ $brand->name }}</option>
										@endforeach
	                                </select>
	                            </div>
	                        </div>
	                        <div class="form-group">
	                            <label class="col-lg-2 control-label">{{__('Unit')}}</label>
	                            <div class="col-lg-7">
	                                <input type="text" class="form-control" name="unit" placeholder="Unit (e.g. KG, Pc etc)" value="{{$product->unit}}" required>
	                            </div>
	                        </div>
	                        <div class="form-group">
	                            <label class="col-lg-2 control-label">{{__('Tags')}}</label>
	                            <div class="col-lg-7">
	                                <input type="text" class="form-control" name="tags[]" id="tags" value="{{ $product->tags }}" placeholder="Type to add a tag" data-role="tagsinput">
	                            </div>
                            </div>
							<div class="form-group">
							    <label class="col-lg-2 control-label">{{__('SKU')}}</label>
							    <div class="col-lg-7">
							        <input type="text" class="form-control" value="{{$product->sku}}" name="sku" placeholder="SKU" >
							    </div>
							</div>
							<div class="form-group">
							    <label class="col-lg-2 control-label">{{__('EAN/UPC/JAN')}}</label>
							    <div class="col-lg-7">
							        <input type="text" class="form-control" value="{{$product->barcode_number}}" name="barcode_number" placeholder="EAN/UPC/JAN" >
							    </div>
							 </div>
							 <div class="form-group">
							    <label  class="col-lg-2 control-label">{{__('Product Condition ')}} <span class="required-star">*</span></label>
							
							    <div class="col-md-7">
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
							<div class="form-group">
							<label class="col-lg-2 control-label">{{__('Return Days')}}</label>
							    <div class="col-lg-7">
							        <select class="form-control selectpicker" name="return_policy_date_id" required>
							            <option value="selected" selected>Please select the return days</option>
							            @foreach (App\ReturnPolicyDate::all() as $rpd)
							                <option {{$product->return_policy_date_id==$rpd->id?'selected':''}}  value="{{$rpd->id}}">{{$rpd->days}}</option>
							            @endforeach
							    </select>
							    </div>
							</div>
							<div class="form-group">
							    <label class="col-lg-2 control-label">{{__('Free Return Validity')}}</label>
							    <div class="col-md-7">
							            <select class="form-control selectpicker" name="FreeReturn_id">
							                    <option value="selected" selected>Please select the Free Return Validity</option>
							                    @foreach (App\FreeReturn::all() as $freeReturn)
							                        <option  {{$product->FreeReturn_id == $freeReturn->id?'selected':''}} value="{{$freeReturn->id}}">{{$freeReturn->days}}</option>
							                    @endforeach
							            </select>
							     </div>
                            </div>
                            <div class="form-group">
							    <label class="col-lg-2 control-label">{{__('Accessories (Max 4)')}}</label>
							    <div class="col-md-7">
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
							@php
							    $pos_addon = \App\Addon::where('unique_identifier', 'pos_system')->first();
							@endphp
							@if ($pos_addon != null && $pos_addon->activated == 1)
								<div class="form-group">
									<label class="col-lg-2 control-label">{{__('Barcode')}}</label>
									<div class="col-lg-7">
										<input type="text" class="form-control" name="barcode" placeholder="{{ ('Barcode') }}" value="{{ $product->barcode }}">
									</div>
								</div>
							@endif

							@php
							    $refund_request_addon = \App\Addon::where('unique_identifier', 'refund_request')->first();
							@endphp
							@if ($refund_request_addon != null && $refund_request_addon->activated == 1)
								<div class="form-group">
									<label class="col-lg-2 control-label">{{__('Refundable')}}</label>
									<div class="col-lg-7">
										<label class="switch" style="margin-top:5px;">
											<input type="checkbox" name="refundable" @if ($product->refundable == 1) checked @endif>
				                            <span class="slider round"></span></label>
										</label>
									</div>
								</div>
							@endif
				        </div>
				        <div id="demo-stk-lft-tab-2" class="tab-pane fade">
							<div class="form-group">
								<label class="col-lg-2 control-label">{{__('Main Images')}}</label>
								<div class="col-lg-7">
									<div id="photos">
										@if(is_array(json_decode($product->photos)))
											@foreach (json_decode($product->photos) as $key => $photo)
												<div class="col-md-4 col-sm-4 col-xs-6">
													<div class="img-upload-preview">
														<img loading="lazy"  src="{{ asset($photo) }}" alt="" class="img-responsive">
														<input type="hidden" name="previous_photos[]" value="{{ $photo }}">
														<button type="button" class="btn btn-danger close-btn remove-files"><i class="fa fa-times"></i></button>
													</div>
												</div>
											@endforeach
										@endif
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="col-lg-2 control-label">{{__('Thumbnail Image')}} <small>(290x300)</small></label>
								<div class="col-lg-7">
									<div id="thumbnail_img">
										@if ($product->thumbnail_img != null)
											<div class="col-md-4 col-sm-4 col-xs-6">
												<div class="img-upload-preview">
													<img loading="lazy"  src="{{ asset($product->thumbnail_img) }}" alt="" class="img-responsive">
													<input type="hidden" name="previous_thumbnail_img" value="{{ $product->thumbnail_img }}">
													<button type="button" class="btn btn-danger close-btn remove-files"><i class="fa fa-times"></i></button>
												</div>
											</div>
										@endif
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="col-lg-2 control-label">{{__('Featured')}} <small>(290x300)</small></label>
								<div class="col-lg-7">
									<div id="featured_img">
										@if ($product->featured_img != null)
											<div class="col-md-4 col-sm-4 col-xs-6">
												<div class="img-upload-preview">
													<img loading="lazy"  src="{{ asset($product->featured_img) }}" alt="" class="img-responsive">
													<input type="hidden" name="previous_featured_img" value="{{ $product->featured_img }}">
													<button type="button" class="btn btn-danger close-btn remove-files"><i class="fa fa-times"></i></button>
												</div>
											</div>
										@endif
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="col-lg-2 control-label">{{__('Flash Deal')}} <small>(290x300)</small></label>
								<div class="col-lg-7">
									<div id="flash_deal_img">
										@if ($product->flash_deal_img != null)
											<div class="col-md-4 col-sm-4 col-xs-6">
												<div class="img-upload-preview">
													<img loading="lazy"  src="{{ asset($product->flash_deal_img) }}" alt="" class="img-responsive">
													<input type="hidden" name="previous_flash_deal_img" value="{{ $product->flash_deal_img }}">
													<button type="button" class="btn btn-danger close-btn remove-files"><i class="fa fa-times"></i></button>
												</div>
											</div>
										@endif
									</div>
								</div>
							</div>
				        </div>
				        <div id="demo-stk-lft-tab-3" class="tab-pane fade">
							<div class="form-group">
								<label class="col-lg-2 control-label">{{__('Video Provider')}}</label>
								<div class="col-lg-7">
									<select class="form-control demo-select2-placeholder" name="video_provider" id="video_provider">
										<option value="youtube" <?php if($product->video_provider == 'youtube') echo "selected";?> >{{__('Youtube')}}</option>
										<option value="dailymotion" <?php if($product->video_provider == 'dailymotion') echo "selected";?> >{{__('Dailymotion')}}</option>
										<option value="vimeo" <?php if($product->video_provider == 'vimeo') echo "selected";?> >{{__('Vimeo')}}</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="col-lg-2 control-label">{{__('Video Link')}}</label>
								<div class="col-lg-7">
									<input type="text" class="form-control" name="video_link" value="{{ $product->video_link }}" placeholder="Video Link">
								</div>
							</div>
				        </div>
						<div id="demo-stk-lft-tab-4" class="tab-pane fade">
							<div class="form-group">
								<label class="col-lg-2 control-label">{{__('Meta Title')}}</label>
								<div class="col-lg-7">
									<input type="text" class="form-control" name="meta_title" value="{{ $product->meta_title }}" placeholder="{{__('Meta Title')}}">
								</div>
							</div>
							<div class="form-group">
								<label class="col-lg-2 control-label">{{__('Description')}}</label>
								<div class="col-lg-7">
									<textarea name="meta_description" rows="8" class="form-control">{{ $product->meta_description }}</textarea>
								</div>
							</div>
							<div class="form-group">
								<label class="col-lg-2 control-label">{{ __('Meta Image') }}</label>
								<div class="col-lg-7">
									<div id="meta_photo">
										@if ($product->meta_img != null)
											<div class="col-md-4 col-sm-4 col-xs-6">
												<div class="img-upload-preview">
													<img loading="lazy"  src="{{ asset($product->meta_img) }}" alt="" class="img-responsive">
													<input type="hidden" name="previous_meta_img" value="{{ $product->meta_img }}">
													<button type="button" class="btn btn-danger close-btn remove-files"><i class="fa fa-times"></i></button>
												</div>
											</div>
										@endif
									</div>
								</div>
							</div>
				        </div>
						<div id="demo-stk-lft-tab-5" class="tab-pane fade">
							<div class="form-group">
								<div class="col-lg-2">
									<input type="text" class="form-control" value="{{__('Colors')}}" disabled>
								</div>
								<div class="col-lg-7">
									<select class="form-control color-var-select" name="colors[]" id="colors" multiple>
										@foreach (\App\Color::orderBy('name', 'asc')->get() as $key => $color)
											<option value="{{ $color->code }}" <?php if(in_array($color->code, json_decode($product->colors))) echo 'selected'?> >{{ $color->name }}</option>
										@endforeach
									</select>
								</div>
								<div class="col-lg-2">
									<label class="switch" style="margin-top:5px;">
										<input value="1" type="checkbox" name="colors_active" <?php if(count(json_decode($product->colors)) > 0) echo "checked";?> >
										<span class="slider round"></span>
									</label>
								</div>
							</div>

							<div class="form-group">
								<div class="col-lg-2">
									<input type="text" class="form-control" value="{{__('Attributes')}}" disabled>
								</div>
			                    <div class="col-lg-7">
			                        <select name="choice_attributes[]" id="choice_attributes" class="form-control demo-select2" multiple data-placeholder="Choose Attributes">
										@foreach (\App\Attribute::all() as $key => $attribute)
											<option value="{{ $attribute->id }}" @if($product->attributes != null && in_array($attribute->id, json_decode($product->attributes, true))) selected @endif>{{ $attribute->name }}</option>
										@endforeach
			                        </select>
			                    </div>
			                </div>

							<div class="">
								<p>Choose the attributes of this product and then input values of each attribute</p>
								<br>
							</div>

							<div class="customer_choice_options" id="customer_choice_options">
								@foreach (json_decode($product->choice_options) as $key => $choice_option)
									<div class="form-group">
										<div class="col-lg-2">
											<input type="hidden" name="choice_no[]" value="{{ $choice_option->attribute_id }}">
											<input type="text" class="form-control" name="choice[]" value="{{ \App\Attribute::find($choice_option->attribute_id)->name }}" placeholder="Choice Title" disabled>
										</div>
										<div class="col-lg-7">
											<input type="text" class="form-control" name="choice_options_{{ $choice_option->attribute_id }}[]" placeholder="Enter choice values" value="{{ implode(',', $choice_option->values) }}" data-role="tagsinput" onchange="update_sku()">
										</div>
										<div class="col-lg-2">
											<button onclick="delete_row(this)" class="btn btn-danger btn-icon"><i class="demo-psi-recycling icon-lg"></i></button>
										</div>
									</div>
								@endforeach
							</div>
				        </div>
						<div id="demo-stk-lft-tab-6" class="tab-pane fade">
							<div class="form-group">
	                            <label class="col-lg-2 control-label">{{__('Unit price')}}</label>
	                            <div class="col-lg-7">
	                                <input type="text" placeholder="{{__('Unit price')}}" name="unit_price" class="form-control" value="{{$product->unit_price}}" required>
	                            </div>
	                        </div>
	                        <div class="form-group">
	                            <label class="col-lg-2 control-label">{{__('Purchase price')}}</label>
	                            <div class="col-lg-7">
	                                <input type="number" min="0" step="0.01" placeholder="{{__('Purchase price')}}" name="purchase_price" class="form-control" value="{{$product->purchase_price}}" required>
	                            </div>
	                        </div>

	                        <div class="form-group">
	                            <label class="col-lg-2 control-label">{{__('Discount')}}</label>
	                            <div class="col-lg-7">
	                                <input type="number" min="0" step="0.01" placeholder="{{__('Discount')}}" name="discount" class="form-control" value="{{ $product->discount }}" required>
	                            </div>
	                            <div class="col-lg-1">
	                                <select class="demo-select2" name="discount_type" required>
	                                	<option value="amount" <?php if($product->discount_type == 'amount') echo "selected";?> >{{currency_symbol()}}</option>
	                                	<option value="percent" <?php if($product->discount_type == 'percent') echo "selected";?> >{{__('%')}}</option>
	                                </select>
	                            </div>
	                        </div>
							<div class="form-group" id="quantity">
								<label class="col-lg-2 control-label">{{__('Quantity')}}</label>
								<div class="col-lg-7">
									<input type="number" min="0" value="{{ $product->current_stock }}" step="1" placeholder="{{__('Quantity')}}" name="current_stock" class="form-control" required>
								</div>
							</div>
							<br>
							<div class="sku_combination" id="sku_combination">

							</div>
				        </div>
						<div id="demo-stk-lft-tab-7" class="tab-pane fade">
							<div class="form-group">
	                            <label class="col-lg-2 control-label">{{__('Description')}}</label>
	                            <div class="col-lg-9">
	                                <textarea class="editor" name="description">{{$product->description}}</textarea>
	                            </div>
	                        </div>
                        </div>
						<div id="demo-stk-lft-tab-9" class="tab-pane fade">
                            <div class="row">
                                <div class="col-md-2"></div>
                                <div class="col-md-8 pt-4">
                                    @if(App\SellerCountry::where('seller_id',Auth::user()->id)->first()->shipping_type)
                                    <div class="from-group" style="margin-bottom:5%">
                                        {{__('Shipping')}} <span id="shipDefaultText f-12">(Default Set)</span>
                                        <br>
                                        <div class="pull-right {{App\SellerCountry::where('seller_id',Auth::user()->id)->first()->shipping_type != null?'':'d-none'}}" >
                                            <label class="switch" style="mt-1">
                                                <input type="checkbox" name="shipping_active" checked onchange="shippingDefaultChange(this)">
                                                <span class="slider round"></span>
                                            </label>
                                        </div>
                                    </div>
                                    @endif
                                    <div class="form-group tab-base pt-5 mt-3" id="shipDefault"  style="border: 1px dashed #d4cbcb">
                                            <ul class="nav nav-tabs" role="tablist"  style="border: 1px dashed #d4cbcb">
                                                @foreach(json_decode(App\SellerCountry::where('seller_id',Auth::user()->id)->first()->setCountries) as $key=>$country)
                                                    <li class="nav-item  {{$key==0?'active':''}}">
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
                                                                    @php $shipping_type_selected = explode('--',json_decode($product->shipping_type)[$country_key])[0];
                                                                        $cost_shipping = explode('--',json_decode($product->shipping_cost)[$country_key]);

                                                                        if($cost_shipping[1] == $country){$cost_shipping = $cost_shipping[0];}
                                                                        if($product->default_courier_company && $country_key < count(json_decode($product->default_courier_company))){
                                                                            $shippingCourierDefault = explode('--',json_decode($product->default_courier_company)[$country_key]);
                                                                        }else{
                                                                            $shippingCourierDefault = null;
                                                                        }

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
                                                    <div id="{{$country}}--addButtonShippingCourier" class="text-right" @if ($shipping_type_selected=='courier') style="display:block" @else style="display: none" @endif>
                                                        <button type="button" class="btn btn-info mb-3" onclick="add_more_shipping_courier('{{$country}}')">{{ __('Add More') }}</button>
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
			</div>
			<div class="panel-footer text-right">
				<button type="submit" name="button" class="btn btn-purple">{{ __('Save') }}</button>
			</div>
		</div>
	</form>
</div>




@endsection

@section('script')

<script type="text/javascript">

	// var i = $('input[name="choice_no[]"').last().val();
	// if(isNaN(i)){
	// 	i =0;
	// }


    $(document).ready(function(){
           el = $('.deault_country');
       country = (el.val().split('_default')[0]);
        if(el.checked){$(`.${country}_dafault_company`).prop("disabled", false); $('#edit_default').fadeOut(); }
        if(!el.checked){$(`.${country}_dafault_company`).not(el).prop("disabled", true); $('#edit_default').fadeIn(); }
        
            if(document.getElementById('shipping_type').value == 'free'){
                    $('#free_shipping_data').css('display','flex');
                    $('#flat_shipping_data').css('display','none');
                    $('#courier_shipping_data').css('display','none');
                    $('#addButtonShippingCourier').css('display','none');

            }else if(document.getElementById('shipping_type').value == 'flat_rate'){
                $('#free_shipping_data').css('display','none');
                    $('#flat_shipping_data').css('display','flex');
                    $('#courier_shipping_data').css('display','none');
                    $('#addButtonShippingCourier').css('display','none');
            }else{
  		$(`.${country}_dafault_company_label`).fadeOut();
                $('#edit_default').fadeOut();
                $('#free_shipping_data').css('display','none');
                    $('#flat_shipping_data').css('display','none');
                    $('#courier_shipping_data').css('display','block');
                    $('#addButtonShippingCourier').css('display','block');
            }

            let courier_shipping_type = document.getElementsByClassName('courier_shipping_type');
            var shipping_ids_loop = 0;
            for(i=0;i<courier_shipping_type.length;i++){
                premium = courier_shipping_type[i].value;
                premium = premium.split('-');
                if(premium[1]=='on'){

                $(`#${premium[4]}--premium_price${premium[2]}`).css('display','none');
                $(`#${premium[4]}--premium_data${premium[2]}`).css('display','block');
            }else{
                $(`#${premium[4]}--premium_price${premium[2]}`).css('display','flex');
                $(`#${premium[4]}--premium_data${premium[2]}`).css('display','none');
            }
            shipping_ids_loop = i;
            }


        });


        var shipping_id = 2;
        function add_more_shipping_courier(country){
           var shipping_data =  `<br> <div class="row">
                <div class="col-md-2">
                <button type="button" onclick="delete_this_row_shipping('${country}',this,${shipping_id})" class="btn btn-link btn-icon text-danger"><i class="fa fa-trash-o"></i></button>
                </div>
                <div class="col-md-8">
                        <select name="shipping_courier_type[]" class="form-control courier_shipping_type" onchange('changeData(this)')>
                            <option value="Selected" selected>Please Select Courier Company </option>
                            @foreach ($shipping as $ship)
                            <option value="{{$ship->id}}-{{$ship->premium}}-${shipping_id}--${country}">{{$ship->name}}</option>
                            @endforeach
                        </select>
                </div>
                  <label class="switch mt-1 ${country}_dafault_company_label"   data-toggle="tooltip" title="set it default company">
                        <input type="checkbox" name="default_company[]" value="${country}_default" class="${country}_dafault_company" onchange="set_default_company(this,'${country}')" id="default">
                        <span class="slider round"></span>
                </label>
            </div>
            <br>
            <div class="row" id="${country}--premium_price${shipping_id}">
                <div class="col-md-2">
                </div>
                <div class="col-md-8">
                    <input  type="number" min="0" step="0.01" value="0" class="form-control mb-3" name="shipping_courier_price[]" placeholder="{{__('Price')}}">
                </div>
            </div>
            <div class="row">
                <div class="col-md-6" id="${country}--premium_data${shipping_id}" style="display: none">
                    <a> <i data-toggle="tooltip" title="If you select this you have no price but get promote product" class="fa fa-info-circle text-danger" style="font-size:20px;margin-left:35%" data-toggle="modal" data-target="#info"></i></a>
                </div>
            </div>
`

            $(`#${country}--courier_shipping_data`).append(shipping_data);
            $(`.${country}_dafault_company_label`).fadeOut();
            shipping_id++;
        }

        function delete_this_row_shipping(country,e,id){
            $(e).closest('.row').remove();

            $(`#${country}--premium_price`+id).css('display','none');
            $(`#${country}--premium_data`+id).css('display','none');
        }




	function add_more_customer_choice_option(i, name){
		$('#customer_choice_options').append('<div class="form-group"><div class="col-lg-2"><input type="hidden" name="choice_no[]" value="'+i+'"><input type="text" class="form-control" name="choice[]" value="'+name+'" readonly></div><div class="col-lg-7"><input type="text" class="form-control" name="choice_options_'+i+'[]" placeholder="Enter choice values" data-role="tagsinput" onchange="update_sku()"></div><div class="col-lg-2"><button onclick="delete_row(this)" class="btn btn-danger btn-icon"><i class="demo-psi-recycling icon-lg"></i></button></div></div>');
		$("input[data-role=tagsinput], select[multiple][data-role=tagsinput]").tagsinput();
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

	function delete_row(em){
		$(em).closest('.form-group').remove();
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

	function get_subcategories_by_category(){
		var category_id = $('#category_id').val();
		$.post('{{ route('subcategories.get_subcategories_by_category') }}',{_token:'{{ csrf_token() }}', category_id:category_id}, function(data){
		    $('#subcategory_id').html(null);
		    for (var i = 0; i < data.length; i++) {
		        $('#subcategory_id').append($('<option>', {
		            value: data[i].id,
		            text: data[i].name
		        }));
		    }
		    $("#subcategory_id > option").each(function() {
		        if(this.value == '{{$product->subcategory_id}}'){
		            $("#subcategory_id").val(this.value).change();
		        }
		    });

		    $('.demo-select2').select2();

		    get_subsubcategories_by_subcategory();
		});
	}

	function get_subsubcategories_by_subcategory(){
		var subcategory_id = $('#subcategory_id').val();
		$.post('{{ route('subsubcategories.get_subsubcategories_by_subcategory') }}',{_token:'{{ csrf_token() }}', subcategory_id:subcategory_id}, function(data){
		    $('#subsubcategory_id').html(null);
			$('#subsubcategory_id').append($('<option>', {
				value: null,
				text: null
			}));
		    for (var i = 0; i < data.length; i++) {
		        $('#subsubcategory_id').append($('<option>', {
		            value: data[i].id,
		            text: data[i].name
		        }));
		    }
		    $("#subsubcategory_id > option").each(function() {
		        if(this.value == '{{$product->subsubcategory_id}}'){
		            $("#subsubcategory_id").val(this.value).change();
		        }
		    });

		    $('.demo-select2').select2();

		});
	}


	function get_attributes_by_subsubcategory(){
		var subsubcategory_id = $('#subsubcategory_id').val();
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

			$('.demo-select2').select2();
		});
	}

	$(document).ready(function(){

	    get_subcategories_by_category();
		$("#photos").spartanMultiImagePicker({
			fieldName:        'photos[]',
			maxCount:         10,
			rowHeight:        '200px',
			groupClassName:   'col-md-4 col-sm-4 col-xs-6',
			maxFileSize:      '',
			dropFileLabel : "Drop Here",
			onExtensionErr : function(index, file){
				console.log(index, file,  'extension err');
				alert('Please only input png or jpg type file')
			},
			onSizeErr : function(index, file){
				console.log(index, file,  'file size too big');
				alert('File size too big');
			}
		});
		$("#thumbnail_img").spartanMultiImagePicker({
			fieldName:        'thumbnail_img',
			maxCount:         1,
			rowHeight:        '200px',
			groupClassName:   'col-md-4 col-sm-4 col-xs-6',
			maxFileSize:      '',
			dropFileLabel : "Drop Here",
			onExtensionErr : function(index, file){
				console.log(index, file,  'extension err');
				alert('Please only input png or jpg type file')
			},
			onSizeErr : function(index, file){
				console.log(index, file,  'file size too big');
				alert('File size too big');
			}
		});
		$("#featured_img").spartanMultiImagePicker({
			fieldName:        'featured_img',
			maxCount:         1,
			rowHeight:        '200px',
			groupClassName:   'col-md-4 col-sm-4 col-xs-6',
			maxFileSize:      '',
			dropFileLabel : "Drop Here",
			onExtensionErr : function(index, file){
				console.log(index, file,  'extension err');
				alert('Please only input png or jpg type file')
			},
			onSizeErr : function(index, file){
				console.log(index, file,  'file size too big');
				alert('File size too big');
			}
		});
		$("#flash_deal_img").spartanMultiImagePicker({
			fieldName:        'flash_deal_img',
			maxCount:         1,
			rowHeight:        '200px',
			groupClassName:   'col-md-4 col-sm-4 col-xs-6',
			maxFileSize:      '',
			dropFileLabel : "Drop Here",
			onExtensionErr : function(index, file){
				console.log(index, file,  'extension err');
				alert('Please only input png or jpg type file')
			},
			onSizeErr : function(index, file){
				console.log(index, file,  'file size too big');
				alert('File size too big');
			}
		});
		$("#meta_photo").spartanMultiImagePicker({
			fieldName:        'meta_img',
			maxCount:         1,
			rowHeight:        '200px',
			groupClassName:   'col-md-4 col-sm-4 col-xs-6',
			maxFileSize:      '',
			dropFileLabel : "Drop Here",
			onExtensionErr : function(index, file){
				console.log(index, file,  'extension err');
				alert('Please only input png or jpg type file')
			},
			onSizeErr : function(index, file){
				console.log(index, file,  'file size too big');
				alert('File size too big');
			}
		});

		update_sku();

		$('.remove-files').on('click', function(){
            $(this).parents(".col-md-4").remove();
        });
	});

	$('#category_id').on('change', function() {
	    get_subcategories_by_category();
	});

	$('#subcategory_id').on('change', function() {
	    get_subsubcategories_by_subcategory();
	});

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

    $('[data-toggle="tooltip"]').tooltip();


function delete_this_row(em){
            $(em).closest('.row').remove();
        }


   function premiumChange(country,event){
            $(`.${country}_dafault_company_label`).fadeIn();
            premium = event.value;
                    premium = premium.split('-');
                    $(`.${country}_dafault_company`).val(`${country}__${premium[0]}`);
                    if(premium[1]=='on'){
                        $(`#${country}--premium_price`+premium[2]).css('display','none');
                        $(`#${country}--premium_data`+premium[2]).css('display','flex');
                    }else{
                        $(`#${country}--premium_price`+premium[2]).css('display','flex');
                        $(`#${country}--premium_data`+premium[2]).css('display','none');
                    }
        }


function openModelShipping(){
    $('#shippingModal').modal('show');
}
@if(App\SellerCountry::where('seller_id',Auth::user()->id)->first()->shipping_type != null)
        $('#shipDefault').css('display','none');
    @endif

function shippingDefaultChange(el){

if(el.checked){
    $('#shipDefault').css('display','none');
    $('#shipDefaultText').css('display','inline-block');
}
else{
    $('#shipDefault').css('display','block');
    $('#shipDefaultText').css('display','none');
}
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
   function premiumChange(country,event){
            $(`.${country}_dafault_company_label`).fadeIn();
            premium = event.value;
                    premium = premium.split('-');
                    $(`.${country}_dafault_company`).val(`${country}__${premium[0]}`);
                    if(premium[1]=='on'){
                        $(`#${country}--premium_price`+premium[2]).css('display','none');
                        $(`#${country}--premium_data`+premium[2]).css('display','flex');
                    }else{
                        $(`#${country}--premium_price`+premium[2]).css('display','flex');
                        $(`#${country}--premium_data`+premium[2]).css('display','none');
                    }
        }

    $(document).on("change",'.courier_shipping_type',function(){
    premium = this.value;
            premium = premium.split('-');
            console.log(premium);
            if(premium[1]=='on'){
                $('#premium_price'+premium[2]).css('display','none');
                $('#premium_data'+premium[2]).css('display','block');
            }else{
                $('#premium_price'+premium[2]).css('display','flex');
                $('#premium_data'+premium[2]).css('display','none');
            }

});

        function set_default_company(el,country){
            if(!el.checked){$(`.${country}_dafault_company`).prop("disabled", false); $('#edit_default').fadeOut(); }
            else{$(`.${country}_dafault_company`).not(el).prop("disabled", true); $('#edit_default').fadeIn(); }
          }
</script>
@endsection
