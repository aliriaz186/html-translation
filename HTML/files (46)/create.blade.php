@extends('layouts.app')

@section('content')

<div class="row">
	<form class="form form-horizontal mar-top" action="{{route('products.store')}}" method="POST" enctype="multipart/form-data" id="choice_form">
		@csrf
		<input type="hidden" name="added_by" value="admin">
		<div class="panel">
			<div class="panel-heading">
				<h3 class="panel-title">{{__('Product Information')}}</h3>
			</div>
			<div class="panel-body">
				<div class="tab-base">
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
						{{-- <li class="">
				            <a data-toggle="tab" href="#demo-stk-lft-tab-8" aria-expanded="false">Display Settings</a>
				        </li> --}}
						<li class="">
				            <a data-toggle="tab" href="#demo-stk-lft-tab-9" aria-expanded="false">{{__('Shipping Info')}}</a>
				        </li>
				    </ul>

				    <!--Tabs Content-->
				    <div class="tab-content">
				        <div id="demo-stk-lft-tab-1" class="tab-pane fade active in">
							<div class="form-group">
								<label class="col-lg-2 control-label">{{__('Product Name')}}</label>
								<div class="col-lg-7">
									<input type="text" class="form-control" name="name" placeholder="{{__('Product Name')}}" onchange="update_sku()" required>
								</div>
							</div>
							<div class="form-group" id="category">
								<label class="col-lg-2 control-label">{{__('Category')}}</label>
								<div class="col-lg-7">
									<select class="form-control demo-select2-placeholder" name="category_id" id="category_id" required>
										@foreach($categories as $category)
											<option value="{{$category->id}}">{{__($category->name)}}</option>
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
											<option value="{{ $brand->id }}">{{ $brand->name }}</option>
										@endforeach
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="col-lg-2 control-label">{{__('Unit')}}</label>
								<div class="col-lg-7">
									<input type="text" class="form-control" name="unit" placeholder="Unit (e.g. KG, Pc etc)" required>
								</div>
							</div>
							<div class="form-group">
								<label class="col-lg-2 control-label">{{__('Tags')}}</label>
								<div class="col-lg-7">
									<input type="text" class="form-control" name="tags[]" placeholder="Type to add a tag" data-role="tagsinput">
								</div>
				                         </div>
				                         <div class="form-group">
								<label class="col-lg-2 control-label">{{__('SKU')}}</label>
								<div class="col-lg-7">
									<input type="text" class="form-control" name="sku" placeholder="SKU" >
								</div>
				                         </div>
				                            <div class="form-group">
								<label class="col-lg-2 control-label">{{__('EAN/UPC/JAN')}}</label>
								<div class="col-lg-7">
									<input type="text" class="form-control" name="barcode_number" placeholder="EAN/UPC/JAN" >
								</div>
				                            </div>
				                              <div class="form-group">
		                                                <label  class="col-lg-2 control-label">{{__('Product Condition ')}} <span class="required-star">*</span></label>

			                                            <div class="col-md-7">
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
				                            <div class="form-group">
				                                    <label class="col-lg-2 control-label">{{__('Return Days')}}</label>
				                                <div class="col-lg-7">
				                                    <select class="form-control selectpicker" name="return_policy_date_id" required>
				                                        <option value="selected" selected>Please select the return days</option>
				                                        @foreach (App\ReturnPolicyDate::all() as $rpd)
				                                            <option value="{{$rpd->id}}">{{$rpd->days}}</option>
				                                        @endforeach
				                                    </select>
				                                </div>
				                            </div>
				                             <div class="form-group">
			                                            <label class="col-lg-2 control-label">{{__('Free Return Validity')}}</label>
			                                        <div class="col-md-7">
			                                                <select class="form-control selectpicker" name="FreeReturn_id">
			                                                        <option value="selected" selected>Please select the Free Return Validity</option>
			                                                        @foreach (App\FreeReturn::all() as $freeReturb)
			                                                            <option value="{{$freeReturb->id}}">{{$freeReturb->days}}</option>
			                                                        @endforeach
			                                                </select>
			                                            </div>
			                                    </div>
			                                      <div class="form-group">
				                                    <label class="col-lg-2 control-label">{{__('Accessories (Max 4)')}}</label>
				                                <div class="col-lg-7">
				                                    <select class="form-control selectpicker" data-placeholder="Select an accessories" name="accessories[]" multiple>
		                                                        @foreach (App\Product::where('user_id',Auth::user()->id)->get() as $produuct)
		                                                            <option value="{{$produuct->id}}">{{$produuct->name}}</option>
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
										<input type="text" class="form-control" name="barcode" placeholder="{{ ('Barcode') }}">
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
											<input type="checkbox" name="refundable" checked>
				                            <span class="slider round"></span></label>
										</label>
									</div>
								</div>
							@endif
				        </div>
				        <div id="demo-stk-lft-tab-2" class="tab-pane fade">
							<div class="form-group">

                                <div class="form-box-content p-3">
                                    <div id="product-images">
                                        <div class="row">
                                            <div class="col-md-2">
                                                <label>{{__('Main Images')}} <span class="required-star">*</span></label>
                                            </div>
                                            <div class="col-md-10">
                                                <div id="photo" style="border: 2px dashed #c3c3c3;height: 34vh;width: 32%;" onclick="openModel()">
                                                    <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAEAAAABACAQAAAAAYLlVAAAABGdBTUEAALGPC/xhBQAAACBjSFJNAAB6JgAAgIQAAPoAAACA6AAAdTAAAOpgAAA6mAAAF3CculE8AAAAAmJLR0QAAKqNIzIAAAAJcEhZcwAADdcAAA3XAUIom3gAAAAHdElNRQfiBA4PGSVZX/u4AAAGhUlEQVRo3u2ZbXBU5RXHf8/NOy+BSOWtCbB3N5CIQBCwzDjjuE4xQUVKZ1od+WIhATttRVFpK9UPRUorg5bUtxacynSmQ6e2Io6lSgi0UxFrjNNRKrD3uUuIaBgmljdrJpvc0w/P7mbzstmkuQtfOJ/uOffs8//d5z773HvOhat2hU31dp0yq8ob7cfA0mZ9EDw/DAB3rrdJLWaijxcnaLWvc2PFxYwATXklG3mMPB/Fe+wUq4MNGQD0X1iajFzgS1+ES8hPzITcG9o9CIBbKzsAOMdGeSvk+HPhkYLcKm8t3wFQ7cy2z6RLLNXntWjRH5ya6o90qrl36ZgWLfpP6TKsnHsoBjpy7p32qf8A9l42A/DNyLVpAOQGAPndjI/9lwf4z2a+ALAWpQHgBgCasiMPC2O8bw7SAcwEIJItAJDjAMxKB6AARLIHoDwAlZMO4ArbVYDc4SS3FnXN88bkN5d9fkVmwK3rbPPeYX/nWb0tWnjZZ8C5T36ThF7fXUzdZZ0ByVHbUn1VG5l/WQF0Jdf0juTcNFBea1GWAKx+24j0i0TmO//uPOs8nhWAlqPmkZLyw3d7+9Eqq0FVMlr9VP88CwDhLn7SK/BK4Eiq686ThuRN+qH+he8AYNfLE3TGnd9T20t+LgdkAgCXANjgPjXUcdP+DaPjvXVqtHo60GZ85bEpuqN7sTVGNQWOpWbqOXIAI/9La7t3iOkgjzoq9OgIAKLjvQYWCLLi+C2zTieigTb29M10rucAXwFge/AhOBnuPsQ0UI84KvTI/3kLIsXemywAIJR7cLB3xchsdYBrAVR98EGAGdHuMK0A6mG9jYw2AMCxsepNbky65bGDJ6ekkb/OajSljKq31yWiM10vzCcArM+M0A/g6Ji8fWoxAP/gZTNi98Ho5P4/PVmZlP9VjzxAuZYwp+MITw8LoG104RuYPe7tjqX2Kl4CYJbXDyFa0d3IpLj8A32HDTmExbxlP8Q9QwZoLfridW6Oy9fMvqTErosjVHQ3upN6Mt1ZXiOTAeTZ/vIAwYhKIIwbIkC0sHMvYQAOx5bOvgSgxK6TnQCqUhqdeOmqZ8pBphj50A/SDR08Yd3KZ2SwJECkoHsPX4/L1/RUtEqCa+Kl23Wq0ZkIujwhz3Pp5QHs4yxPbF5S6k4fKEdpAVDVso7bAdQ7ndV9C2pR0RdlDQAfeWusP/JVIx/8/mDyTo16gFspSAl9KK+rPcH3BgBAE0wn3wchYc8Hv5deXM+UelU98Dm1S9b1tC4SAEbmiFSXXxj4Z6LcF1g7NHl3mexmVErgDKpX6+MTtcrebw5TFuFg8qDE/i4vxp0X7EEmX98prxp51S5PyO3WlODk4CSvzPsGWzDjl8pb7uq+M/Cud1t6+eQsbFB3e7uDW1XaSurjCflHzf7AG1Zt4lGWhJvGDm4D4KKaY7cAWrRo0Ucixfhizh+0aNGek1wxkWL3YbeuKdkActZqT4sW3SAqCeCEfZK/24znbk+JPalFi3Nfyjw8E7/s+5NrwJ/iNFJgPWcOCn+cEl4IEH++AJD/GKZifurYWF9LMxU270Wqdup/B8sr+1JWATA29w5/Ae4C4HP775kyQ4dVOwArhlUbZrTrAWg2TrSqazyAMi+rUyO3AOR8Zh8HkGaWgKr0F6AUwLRk3D3e8l7Tu8xaBiC4W+0NwPssASb7W55fAyDHoClPqtMlyQoA5QIwzsI0UNQQhs9sbQCqBBbG5Gd9Sxljql2eBBK366zFCQDKfQE4BWAea6FN9jiryCqyitgPIDuNF5gY2gWAadu1WfEG3cLhqw1gHwJQE7/W7kBHoCPQIV6qZ1pWTXliqut/WvIegFp5wvYB4FUzA9GvZUos+TamxfFnK/8VzgOjcn7bUjJSffttUxF49ZKyuFUXAF09EXeSMlt1y6lD1rRPWQ/AzbGP9MpI6UgAlLAFgBvdrSnRfQBqb09EnpcJgLA63NX/e8EZzo2AIdcsQZBnCzaUxb88ODepC0GzPogWelt4EIBfB++Pf7A4ml/0uPxoeB2zIZhj1Qb+1jukF8kuVQlAS2xOxcWUb0bOAjarRX0bMSM04TU5rJpzmyFWpeaziG9hOivn1HLzxOizAbnTmeeNGrZQH1OKldwxyPm/xmoTNbc/O+AA5tSoZ6gY4MQFtd5+KQUmWwDQlFdSxxKqmJEM/YvXZGeotddsZA8gYXqcmivF1umO1sr27KtdtWHb/wAERFuYrBJ1jgAAACV0RVh0ZGF0ZTpjcmVhdGUAMjAxOC0wNC0xNFQxNToyNTozNyswMjowMKaBIu8AAAAldEVYdGRhdGU6bW9kaWZ5ADIwMTgtMDQtMTRUMTU6MjU6MzcrMDI6MDDX3JpTAAAAGXRFWHRTb2Z0d2FyZQB3d3cuaW5rc2NhcGUub3Jnm+48GgAAAABJRU5ErkJggg==" alt="" style="width: 64px;vertical-align: middle;margin-left: auto; margin-right: auto; margin-top: 27%; display:block">
                                                </div>
                                            </div>
                                            <br>
                                            <br>
                                            <br>
                                            <div id="below_image_test" style="width: 100%"></div>
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
                                            <button type="button"  onclick="upload_save(this)" class="btn btn-danger">Save changes</button>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
				        </div>
				        <div id="demo-stk-lft-tab-3" class="tab-pane fade">
							<div class="form-group">
								<label class="col-lg-2 control-label">{{__('Video Provider')}}</label>
								<div class="col-lg-7">
									<select class="form-control demo-select2-placeholder" name="video_provider" id="video_provider">
										<option value="youtube">{{__('Youtube')}}</option>
										<option value="dailymotion">{{__('Dailymotion')}}</option>
										<option value="vimeo">{{__('Vimeo')}}</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="col-lg-2 control-label">{{__('Video Link')}}</label>
								<div class="col-lg-7">
									<input type="text" class="form-control" name="video_link" placeholder="{{__('Video Link')}}">
								</div>
							</div>
				        </div>
						<div id="demo-stk-lft-tab-4" class="tab-pane fade">
							<div class="form-group">
								<label class="col-lg-2 control-label">{{__('Meta Title')}}</label>
								<div class="col-lg-7">
									<input type="text" class="form-control" name="meta_title" placeholder="{{__('Meta Title')}}">
								</div>
							</div>
							<div class="form-group">
								<label class="col-lg-2 control-label">{{__('Description')}}</label>
								<div class="col-lg-7">
									<textarea name="meta_description" rows="8" class="form-control"></textarea>
								</div>
							</div>
							<div class="form-group">
								<label class="col-lg-2 control-label">{{ __('Meta Image') }}</label>
								<div class="col-lg-7">
									<div id="meta_photo">

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
									<select class="form-control color-var-select" name="colors[]" id="colors" multiple disabled>
										@foreach (\App\Color::orderBy('name', 'asc')->get() as $key => $color)
											<option value="{{ $color->code }}">{{ $color->name }}</option>
										@endforeach
									</select>
								</div>
								<div class="col-lg-2">
									<label class="switch" style="margin-top:5px;">
										<input value="1" type="checkbox" name="colors_active">
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
											<option value="{{ $attribute->id }}">{{ $attribute->name }}</option>
										@endforeach
			                        </select>
			                    </div>
			                </div>

							<div>
								<p>Choose the attributes of this product and then input values of each attribute</p>
								<br>
							</div>

							<div class="customer_choice_options" id="customer_choice_options">

							</div>

							{{-- <div class="customer_choice_options" id="customer_choice_options">

							</div>
							<div class="form-group">
								<div class="col-lg-2">
									<button type="button" class="btn btn-info" onclick="add_more_customer_choice_option()">{{ __('Add more customer choice option') }}</button>
								</div>
							</div> --}}
				        </div>

						<div id="demo-stk-lft-tab-6" class="tab-pane fade">
							<div class="form-group">
								<label class="col-lg-2 control-label">{{__('Unit price')}}</label>
								<div class="col-lg-7">
									<input type="number" min="0" value="0" step="0.01" placeholder="{{__('Unit price')}}" name="unit_price" class="form-control" required>
								</div>
							</div>
							<div class="form-group">
								<label class="col-lg-2 control-label">{{__('Purchase price')}}</label>
								<div class="col-lg-7">
									<input type="number" min="0" value="0" step="0.01" placeholder="{{__('Purchase price')}}" name="purchase_price" class="form-control" required>
								</div>
							</div>
							<div class="form-group">
								<label class="col-lg-2 control-label">{{__('Discount')}}</label>
								<div class="col-lg-7">
									<input type="number" min="0" value="0" step="0.01" placeholder="{{__('Discount')}}" name="discount" class="form-control" required>
								</div>
								<div class="col-lg-1">
									<select class="demo-select2" name="discount_type">
										<option value="amount">{{currency_symbol()}}</option>
										<option value="percent">{{__('%')}}</option>
									</select>
								</div>
							</div>
							<div class="form-group" id="quantity">
								<label class="col-lg-2 control-label">{{__('Quantity')}}</label>
								<div class="col-lg-7">
									<input type="number" min="0" value="0" step="1" placeholder="{{__('Quantity')}}" name="current_stock" class="form-control" required>
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
									<textarea class="editor" name="description"></textarea>
								</div>
							</div>
				        </div>

						<div id="demo-stk-lft-tab-9" class="tab-pane fade">
                            <div class="row">
                                <div class="col-md-12">
                                    <label>{{__('Shiping Type')}} <span id="shipDefaultText f-12">(Default Set)</label>
                                        <br>
                                        @if(App\SellerCountry::where('seller_id',Auth::user()->id)->first()->shipping_type)
                                        <div class="pull-right {{App\SellerCountry::where('seller_id',Auth::user()->id)->first()->shipping_type != null?'':'d-none'}}" >
                                            <label class="switch" style="mt-1">
                                                <input type="checkbox" name="shipping_active" checked onchange="shippingDefaultChange(this)">
                                                <span class="slider round"></span>
                                            </label>
                                        </div>
                                        @endif
                                    </div>
                                <br>
                                <div class="col-md-2"></div>
                                <div class="col-md-8" id="shipDefault">
                                    <div class="tab-base" style="border: 1px dashed #d4cbcb">
                                        <ul class="nav nav-tabs" style="border: 1px dashed #d4cbcb">
                                            @foreach(json_decode(App\SellerCountry::where('seller_id',Auth::user()->id)->first()->setCountries) as $key=>$country)
                                                <li class="{{$key==0?'active':''}}">
                                                    <a data-toggle="tab" href="#tabs-{{$key}}" >{{str_replace('_',' ',$country)}}</a>
                                                </li>
                                            @endforeach
                                        </ul>
                                        <div class="tab-content">
                                           
                                            @foreach(json_decode(App\SellerCountry::where('seller_id',Auth::user()->id)->first()->setCountries) as $key=>$country)
                                            <div class="tab-pane {{$key==0?'active':''}}" id="tabs-{{$key}}" role="tabpanel">
                                                    <div class="row">
                                                        <div class="col-md-2">
                                                            <label>{{__('Shiping Type')}}</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                                <select name="shipping_type[]" onchange="changeCatch('{{$country}}',this)" class="form-control">
                                                                    <option value="selected--{{$country}}" selected id="selected">Selct Shipping Type</option>
                                                                    <option value="free--{{$country}}" id="free">Free Shipping</option>
                                                                    <option value="flat_rate--{{$country}}" id="flat_rate">Flat Rate</option>
                                                                    <option value="courier--{{$country}}" id="courier">Courier</option>
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
                            </div>
                        </div>
				    </div>
                </div>


			</div>
			<div class="panel-footer text-right">
				<button type="submit" id="save_btn" name="button" class="btn btn-info">{{ __('Save') }}</button>
			</div>
		</div>
	</form>
</div>
@endsection

@section('script')

<script type="text/javascript">

	function add_more_customer_choice_option(i, name){
		$('#customer_choice_options').append('<div class="form-group"><div class="col-lg-2"><input type="hidden" name="choice_no[]" value="'+i+'"><input type="text" class="form-control" name="choice[]" value="'+name+'" placeholder="Choice Title" readonly></div><div class="col-lg-7"><input type="text" class="form-control" name="choice_options_'+i+'[]" placeholder="Enter choice values" data-role="tagsinput" onchange="update_sku()"></div></div>');

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

	$('input[name="unit_price"]').on('keyup', function() {
	    update_sku();
	});

	$('input[name="name"]').on('keyup', function() {
	    update_sku();
	});

	function delete_row(em){
		$(em).closest('.form-group').remove();
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

	function get_subcategories_by_category(){
		var category_id = $('#category_id').val();
		$.post('{{ route('subcategories.get_subcategories_by_category') }}',{_token:'{{ csrf_token() }}', category_id:category_id}, function(data){
		    $('#subcategory_id').html(null);
		    for (var i = 0; i < data.length; i++) {
		        $('#subcategory_id').append($('<option>', {
		            value: data[i].id,
		            text: data[i].name
		        }));
		        $('.demo-select2').select2();
		    }
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
		        $('.demo-select2').select2();
		    }
		    //get_brands_by_subsubcategory();
			//get_attributes_by_subsubcategory();
		});
	}

	function get_brands_by_subsubcategory(){
		var subsubcategory_id = $('#subsubcategory_id').val();
		$.post('{{ route('subsubcategories.get_brands_by_subsubcategory') }}',{_token:'{{ csrf_token() }}', subsubcategory_id:subsubcategory_id}, function(data){
		    $('#brand_id').html(null);
		    for (var i = 0; i < data.length; i++) {
		        $('#brand_id').append($('<option>', {
		            value: data[i].id,
		            text: data[i].name
		        }));
		        $('.demo-select2').select2();
		    }
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
			$('.demo-select2').select2();
		});
	}

	$(document).ready(function(){

	    get_subcategories_by_category();

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
	});

	$('#category_id').on('change', function() {
	    get_subcategories_by_category();
	});

	$('#subcategory_id').on('change', function() {
	    get_subsubcategories_by_subcategory();
	});

	$('#subsubcategory_id').on('change', function() {
	});

	$('#choice_attributes').on('change', function() {
		$('#customer_choice_options').html(null);
		$.each($("#choice_attributes option:selected"), function(){
            add_more_customer_choice_option($(this).val(), $(this).text());
        });
		update_sku();
	});

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

        function delete_this_row_shipping(country,e,id){
            delete_this_row(e);
            $(`#${country}--premium_price`+id).css('display','none');
            $(`#${country}--premium_data`+id).css('display','none');
        }

       
shipping_id=2;
        function add_more_shipping_courier(country){
           var shipping_data =  `<div class="row">
                <div class="col-md-2" style="margin-top:10px">
                <button type="button" onclick="delete_this_row_shipping('${country}',this,$shipping_id})" class="btn btn-link btn-icon text-danger"><i class="fa fa-trash-o"></i></button>
                </div>
                <div class="col-md-8">
                        <select name="shipping_courier_type[]" class="form-control " onchange="premiumChange('{{$country}}',this)">
                            @foreach ($shipping as $ship)
                                <option value="{{$ship->id}}-{{$ship->premium}}-$shipping_id}--${country}">{{$ship->name}}</option>
                            @endforeach
                        </select>
                </div>
                  <label class="switch mt-1 ${country}_dafault_company_label"   data-toggle="tooltip" title="set it default company">
                        <input type="checkbox" name="default_company[]" value="${country}_default" class="${country}_dafault_company" onchange="set_default_company(this,'${country}')" id="default">
                        <span class="slider round"></span>
                </label>
            </div>
            <br>
            <div class="row" id="${country}--premium_price$shipping_id}">
                <div class="col-md-2">
                </div>
                <div class="col-md-8">
                    <input  type="number" min="0" step="0.01" value="0" class="form-control mb-3" name="shipping_courier_price[]" placeholder="{{__('Price')}}">
                </div>
            </div>
            <div class="row">
                <div class="col-md-6" id="${country}--premium_data$shipping_id}" style="display: none">
                    <a> <i data-toggle="tooltip" title="If you select this you have no price but get promote product" class="fa fa-info-circle text-danger" style="font-size:20px;margin-left:35%" data-toggle="modal" data-target="#info"></i></a>
                </div>
            </div>
            `;

            $(`#${country}--courier_shipping_data`).append(shipping_data);

        shipping_id++;
        }



        function premiumChange(country,event){
                 premium = event.value;                  
                   premium = premium.split('-');
                    
            $(`.${country}_dafault_company_label`).fadeIn();
 	    $(`.${country}_dafault_company`).val(`${country}__${premium[0]}`);

                    if(premium[1]=='on'){
                        $(`#${country}--premium_price`+premium[2]).css('display','none');
                        $(`#${country}--premium_data`+premium[2]).css('display','block');
                    }else{
                        $(`#${country}--premium_price`+premium[2]).css('display','flex');
                        $(`#${country}--premium_data`+premium[2]).css('display','none');
                    }
        }
        function delete_this_row_shipping(e,id){
            delete_this_row(e);
            $('#premium_price'+id).css('display','none');
            $('#premium_data'+id).css('display','none');
    }




var positions = String();
var stopif = 0;
var values='';
var filenames = [];

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

            value = `
            <div id="imageNo${j}" class = "listitemClass img-upload-preview">
                <img  id="imageSrc${j}"  class="${limit}" src="${String(reader.result)}" alt="">
                <button type="button" class="btn btn-danger close-btn remove-files" id="${j}"><i class="fa fa-times"></i></button>
            </div>
            `;
  		j++;
            below_img = `
            <div id="image_below${j}" class="img-upload-preview">
                <img loading="lazy"  src="${String(reader.result)}" alt="" class="img-responsive">
                <button type="button" class="btn btn-danger close-btn " id="${j}")><i class="fa fa-times"></i></button>
            </div>
            <br>
            `;

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

function openModel(){
    $('#photos_1').modal('show');
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
function set_default_company(el,country){
            if(!el.checked){$(`.${country}_dafault_company`).prop("disabled", false); $('#save_btn').fadeOut(); }
            else{$(`.${country}_dafault_company`).not(el).prop("disabled", true); $('#save_btn').fadeIn(); }
          }
</script>

@endsection
