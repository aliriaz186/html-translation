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
                                        {{__('Shop Settings')}}
                                        <a href="{{ route('shop.visit', $shop->slug) }}" class="btn btn-link btn-sm" target="_blank">({{__('Visit Shop')}})<i class="la la-external-link"></i>)</a>
                                    </h2>
                                </div>
                                <div class="col-md-6">
                                    <div class="float-md-right">
                                        <ul class="breadcrumb">
                                            <li><a href="{{ route('home') }}">{{__('Home')}}</a></li>
                                            <li><a href="{{ route('dashboard') }}">{{__('Dashboard')}}</a></li>
                                            <li class="active"><a href="{{ route('shops.index') }}">{{__('Shop Settings')}}</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <form class="" action="{{ route('shops.update', $shop->id) }}" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="_method" value="PATCH">
                            @csrf
                            <div class="form-box bg-white mt-4">
                                <div class="form-box-title px-3 py-2">
                                    {{__('Business Details')}}
                                </div>
                                <div class="form-box-content p-3">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label>{{__('Store Name')}} <span class="required-star">*</span></label>
                                        </div>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control mb-3" placeholder="{{__('Shop Name')}}" name="name" value="{{ $shop->name }}" required>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-2">
                                            <label>{{__('Pickup Points')}} <span class="required-star"></span></label>
                                        </div>
                                        <div class="col-md-10">
                                            <select class="form-control mb-3 selectpicker" data-placeholder="Select Pickup Point" id="pick_up_point" name="pick_up_point_id[]" multiple>
                                                @foreach (\App\PickupPoint::all() as $pick_up_point)
                                                    @if (Auth::user()->shop->pick_up_point_id != null)
                                                        <option value="{{ $pick_up_point->id }}" @if (in_array($pick_up_point->id, json_decode(Auth::user()->shop->pick_up_point_id))) selected @endif>{{ $pick_up_point->name }}</option>
                                                    @else
                                                        <option value="{{ $pick_up_point->id }}">{{ $pick_up_point->name }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label>{{__('Logo')}} <small>(120x120)</small></label>
                                        </div>
                                        <div class="col-md-10">
                                            <input type="file" name="logo" id="file-2" class="custom-input-file custom-input-file--4" data-multiple-caption="{count} files selected" accept="image/*" />
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
                                            <label>{{__('Address')}} <span class="required-star">*</span></label>
                                        </div>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control mb-3" placeholder="{{__('Address')}}" name="address" value="{{ $shop->address }}" required>
                                        </div>
                                    </div>
                                    <div class="row">
					    <div class="col-md-2">
					        <label>{{__('Phone Number')}}</label>
					    </div>
					    <div class="col-md-8">
					        <input type="tel" class="form-control mb-3" placeholder="{{__('Contact Number')}}" id="pNo" name="phone" value="{{ $shop->phone }}"  style="width: 360%">
					        <input type="hidden" value="" id="countryCode" name="countryCode">
					    </div>
					</div>
                                     <div class="mt-3 row">
                                        <div class="col-md-2">
                                            <label>{{__('Tax')}} <span class="required-star">*</span></label>
                                        </div>
                                        <div class="col-md-10">
                                            <select name="tax" id="" class="form-control" onchange="selectTax(this)">
                                                <option value="vat" {{$shop->tax=='vat'?'selected':''}}>Vat</option>
                                                <option value="no_vat" {{$shop->tax=='no_vat'?'selected':''}}>No Vat</option>
                                            </select>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row" id="tax_id" @if($shop->tax=='no_vat')style="display: none"@endif>
                                        <div class="col-md-2">
                                            <label>{{__('Tax Id')}} <span class="required-star">*</span></label>
                                        </div>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control mb-3" placeholder="{{__('Id')}}" name="tax_id" value="{{ $shop->tax=='vat'?$shop->tax_id:''}}" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label>{{__('Meta Title')}} <span class="required-star">*</span></label>
                                        </div>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control mb-3" placeholder="{{__('Meta Title')}}" name="meta_title" value="{{ $shop->meta_title }}" required>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label>{{__('Meta Description')}} <span class="required-star">*</span></label>
                                        </div>
                                        <div class="col-md-10">
                                            <textarea name="meta_description" rows="6" class="form-control mb-3" required>{{ $shop->meta_description }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="text-right mt-4">
                                <button type="submit" class="btn btn-styled btn-base-1">{{__('Save')}}</button>
                            </div>
                        </form>
                        
                        <form class="" action="{{ route('shops.update', $shop->id) }}" method="POST" enctype="multipart/form-data">
			    <input type="hidden" name="_method" value="PATCH">
			    @csrf
			    <div class="form-box bg-white mt-4">
			        <div class="form-box-title px-3 py-2">
			            {{__('Cover Photo')}}
			        </div>
			        <div class="form-box-content p-3">
			            <div>
			                <div class="row">
			                    <div class="col-md-2">
			                        <label>{{__('Image')}} <small>(1400x400)</small></label>
			                    </div>
			                    <div class="offset-2 offset-md-0 col-10 col-md-10">
			                        <div class="row">
			                            @if ($shop->cover != null)
			                                    <div class="col-md-6">
			                                        <div class="img-upload-preview">
			                                            <img loading="lazy"  src="{{ asset($shop->cover) }}" alt="" class="img-fluid">
			                                            <input type="hidden" name="previous_cover" value="{{ $shop->cover }}">
			                                            <button type="button" class="btn btn-danger close-btn remove-files"><i class="fa fa-times"></i></button>
			                                        </div>
			                                    </div>
			                            @endif
			                        </div>
			                        <input type="file" name="cover" id="cover-0" class="custom-input-file custom-input-file--4" accept="image/*" />
			                        <label for="cover-0" class="mw-100 mb-3">
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
			    </div>
			    <div class="text-right mt-4">
			        <button type="submit" class="btn btn-styled btn-base-1">{{__('Save')}}</button>
			    </div>
			</form>
			
                        <form class="" action="{{ route('shops.update', $shop->id) }}" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="_method" value="PATCH">
                            @csrf
                            <div class="form-box bg-white mt-4">
                                <div class="form-box-title px-3 py-2">
                                    {{__('Slider Settings')}}
                                </div>
                                <div class="form-box-content p-3">
                                    <div id="shop-slider-images">
                                        <div class="row">
                                            <div class="col-md-2">
                                                <label>{{__('Slider Images')}} <small>(1400x400)</small></label>
                                            </div>
                                            <div class="offset-2 offset-md-0 col-10 col-md-10">
                                                <div class="row">
                                                    @if ($shop->sliders != null)
                                                        @foreach (json_decode($shop->sliders) as $key => $sliders)
                                                            <div class="col-md-6">
                                                                <div class="img-upload-preview">
                                                                    <img loading="lazy"  src="{{ asset($sliders) }}" alt="" class="img-fluid">
                                                                    <input type="hidden" name="previous_sliders[]" value="{{ $sliders }}">
                                                                    <button type="button" class="btn btn-danger close-btn remove-files"><i class="fa fa-times"></i></button>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    @endif
                                                </div>
                                                <input type="file" name="sliders[]" id="slide-0" class="custom-input-file custom-input-file--4" data-multiple-caption="{count} files selected" multiple accept="image/*" />
                                                <label for="slide-0" class="mw-100 mb-3">
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
                                </div>
                            </div>
                            <div class="text-right mt-4">
                                <button type="submit" class="btn btn-styled btn-base-1">{{__('Save')}}</button>
                            </div>
                        </form>
                        
                        
                        <form class="" action="{{ route('shops.update', $shop->id) }}" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="_method" value="PATCH">
                            @csrf
                            <div class="form-box bg-white mt-4">
                                <div class="form-box-title px-3 py-2">
                                    {{__('Banner Settings')}}
                                </div>
                                <div class="form-box-content p-3">
                                    <div id="shop-banner-images">
                                        <div class="row">
                                            <div class="col-md-2">
                                                <label>{{__('Banner Images')}} <small>(Max 3)</small></label>
                                            </div>
                                            <div class="offset-2 offset-md-0 col-10 col-md-10">
                                                <div class="row">
                                                    @if ($shop->images_banner != null)
                                                        @foreach (json_decode($shop->images_banner) as $key => $banner)
                                                            <div class="col-md-6">
                                                                <div class="img-upload-preview">
                                                                    <img loading="lazy"  src="{{ asset($banner) }}" alt="" class="img-fluid">
                                                                    <input type="hidden" name="previous_images_banner[]" value="{{ $banner}}">
                                                                    <button type="button" class="btn btn-danger close-btn remove-files"><i class="fa fa-times"></i></button>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    @endif
                                                </div>
                                                
                                                  <input type="file" name="images_banner[]" id="banner-0" class="custom-input-file custom-input-file--4" data-multiple-caption="{count} files selected" multiple accept="image/*" />
                                                <label for="banner-0" class="mw-100 mb-3">
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
                                        <button type="button" class="btn btn-info mb-3" onclick="add_more_banner_image()">{{ __('Add More') }}</button>
                                    </div>
                                </div>
                            </div>
                            <div class="text-right mt-4">
                                <button type="submit" class="btn btn-styled btn-base-1">{{__('Save')}}</button>
                            </div>
                        </form>

                        {{-- Timer  --}}

                        <form class="" action="{{ route('shops.update', $shop->id) }}" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="_method" value="PATCH">
                            @csrf
                            <div class="form-box bg-white mt-4">
                                <div class="form-box-title px-3 py-2">
                                    {{__('Business Operating Times')}}
                                </div>
                                <div class="form-box-content p-3">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <table class="table table-sm table-hover table-responsive-md">
                                                <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>{{__('Days')}}</th>
                                                    <th>{{__('Opening Time')}}</th>
                                                    <th>{{__('Closing Time')}}</th>
                                                    <th>{{__('Closed')}}</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                    @php $i=1; $days = array(); $days['monday'] = 'monday';$days['tuesday'] = 'tuesday';$days['wednesday'] = 'wednesday';$days['thusday'] = 'thusday';$days['friday'] = 'friday';$days['saturday'] = 'saturday';$days['sunday'] = 'sunday';  @endphp
                                                  @foreach($days as $key=>$day)
                                                  
                                                     @php  $timing =  json_decode($shop->timing); $open = 'open_'.$day; $close= 'close_'.$day; $closed = 'closed';  @endphp
                                                    <tr>
                                                        <td>{{$i}}</td>
                                                        <td><label for="{{$day}}">{{ucfirst($day)}}</label></td>
                                                        <td><input id="{{$open}}" class="form-control" type="time" @if($timing)  {{$timing->$open == $closed?'readonly':''}} value="{{$timing->$open}}" @endif name="open_{{$day}}"></td>
                                                        <td><input id="{{$close}}" class="form-control" type="time"  @if($timing)  {{$timing->$open == $closed?'readonly':''}} value="{{$timing->$close}}" @endif name="close_{{$day}}"></td>
                                                        <td>
                                                            <label class="switch" data-toggle="tooltip" title="closed">
                                                                <input type="checkbox" onchange="dayChange(this,{{$open}},{{$close}})"  @if($timing) {{$timing->$open == $closed?'checked':''}} @endif name="closed_{{$day}}" />
                                                                <span class="slider round"></span>
                                                            </label>
                                                        </td>
                                                    </tr>
                                                    @php $i++; @endphp
                                                 @endforeach
                                                </tbody>
                                            </table> 
                                        </div>
                                       
                                    </div>      
                                </div>
                            </div>
                            <div class="text-right mt-4">
                                <button type="submit" class="btn btn-styled btn-base-1">{{__('Save')}}</button>
                            </div>
                        </form>


                        <form class="" action="{{ route('shops.update', $shop->id) }}" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="_method" value="PATCH">
                            @csrf
                            <div class="form-box bg-white mt-4">
                                <div class="form-box-title px-3 py-2">
                                    {{__('Social Media Share')}}
                                </div>
                                <div class="form-box-content p-3">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label ><i class="line-height-1_8 size-24 mr-2 fa fa-facebook bg-facebook c-white text-center"></i>{{__('Facebook')}} </label>
                                        </div>
                                        <div class="col-md-2">
                                         <label class="switch" data-toggle="tooltip" title="Facebook Active\Deactive">
		                                    <input type="checkbox" {{$shop->facebook== 1?'checked':''}} name="facebook" />
		                                    <span class="slider round"></span>
	                             	  </label>
                                        </div>
                                        <div class="col-md-2">
                                            <label><i class="line-height-1_8 size-24 mr-2 fa fa-twitter bg-twitter c-white text-center"></i>{{__('Twitter')}} </label>
                                        </div>
                                        <div class="col-md-2">
                                         <label class="switch" data-toggle="tooltip" title="Twitter Active\Deactive">
		                                    <input type="checkbox" {{ $shop->twitter== 1?'checked':''}} name="twitter" />
		                                    <span class="slider round"></span>
	                             	 </label>
                                        </div>
                                        <div class="col-md-2">
                                            <label><i class="line-height-1_8 size-24 mr-2 fa fa-google bg-google c-white text-center"></i>{{__('Google')}} </label>
                                        </div>
                                        <div class="col-md-2">
                                  	 <label class="switch" data-toggle="tooltip" title="Google Active\Deactive">
		                                    <input type="checkbox" {{ $shop->google== 1?'checked':''}} name="google" />
		                                    <span class="slider round"></span>
	                             	    </label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label><i class="line-height-1_8 size-24 mr-2 fa fa-youtube bg-youtube c-white text-center"></i>{{__('Youtube')}} </label>
                                        </div>
                                        <div class="col-md-2">
                                            <label class="switch" data-toggle="tooltip" title="Youtube Active\Deactive">
		                                    <input type="checkbox" {{ $shop->youtube== 1?'checked':''}} name="youtube" />
		                                    <span class="slider round"></span>
	                             	    </label>
                                        </div>
                                        <div class="col-md-2">
                                            <label ><i class="line-height-1_8 size-24 mr-2 fa fa-linkedin  bg-facebook c-white text-center"></i>{{__('Linkedin')}} </label>
                                        </div>
                                        <div class="col-md-2">
                                         <label class="switch" data-toggle="tooltip" title="Linkedin Active\Deactive">
		                                    <input type="checkbox" {{ $shop->linkedin== 1?'checked':''}} name="linkedin" />
		                                    <span class="slider round"></span>
	                             	  </label>
                                        </div>
                                        <div class="col-md-2">
                                            <label ><i class="line-height-1_8 size-24 mr-2 fa fa-in1 bg-facebook c-white text-center"></i>{{__('In1')}} </label>
                                        </div>
                                        <div class="col-md-2">
                                         <label class="switch" data-toggle="tooltip" title="In1 Active\Deactive">
		                                    <input type="checkbox" {{ $shop->inl== 1?'checked':''}}  name="inl"  />
		                                    <span class="slider round"></span>
	                             	  </label>
                                        </div>
                                        <div class="col-md-2">
                                            <label ><i class="line-height-1_8 size-24 mr-2 fa fa-stumbleupon bg-facebook c-white text-center"></i>{{__('Stumbleupon')}} </label>
                                        </div>
                                        <div class="col-md-2">
                                         <label class="switch" data-toggle="tooltip" title="Stumbleupon Active\Deactive">
		                                    <input type="checkbox" {{ $shop->stumbleupon== 1?'checked':''}}  name="stumbleupon"  />
		                                    <span class="slider round"></span>
	                             	  </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="text-right mt-4">
                                <button type="submit" class="btn btn-styled btn-base-1">{{__('Save')}}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>



@endsection

@section('script')
    <script src="{{asset('js/intlTelInput.js')}}"></script>

    <script>
    
      var cover = 0;
      
    
        var slide_id = 1;
        function add_more_slider_image(){
            var shopSliderAdd =  '<div class="row">';
            shopSliderAdd +=  '<div class="col-2">';
            shopSliderAdd +=  '<button type="button" onclick="delete_this_row(this)" class="btn btn-link btn-icon text-danger"><i class="fa fa-trash-o"></i></button>';
            shopSliderAdd +=  '</div>';
            shopSliderAdd +=  '<div class="col-10">';
            shopSliderAdd +=  '<input type="file" name="sliders[]" id="slide-'+slide_id+'" class="custom-input-file custom-input-file--4" data-multiple-caption="{count} files selected" multiple accept="image/*" />';
            shopSliderAdd +=  '<label for="slide-'+slide_id+'" class="mw-100 mb-3">';
            shopSliderAdd +=  '<span></span>';
            shopSliderAdd +=  '<strong>';
            shopSliderAdd +=  '<i class="fa fa-upload"></i>';
            shopSliderAdd +=  "{{__('Choose image')}}";
            shopSliderAdd +=  '</strong>';
            shopSliderAdd +=  '</label>';
            shopSliderAdd +=  '</div>';
            shopSliderAdd +=  '</div>';
            $('#shop-slider-images').append(shopSliderAdd);

            slide_id++;
            imageInputInitialize();
        }
        
        
       
        var banner_id = @if(json_decode($shop->images_banner)) {{count(json_decode($shop->images_banner))}} @else 1 @endif;         
 
        function add_more_banner_image(){
                   if(banner_id==3 @if(json_decode($shop->images_banner))  || {{count(json_decode($shop->images_banner))}} == 3 @endif){
                alert('You allready reached to max');
            }else{
            var shopBannerAdd =  '<div class="row">';
            shopBannerAdd +=  '<div class="col-2">';
            shopBannerAdd +=  '<button type="button" onclick="delete_this_row(this)" class="btn btn-link btn-icon text-danger"><i class="fa fa-trash-o"></i></button>';
            shopBannerAdd +=  '</div>';
            shopBannerAdd +=  '<div class="col-10">';
            shopBannerAdd +=  '<input type="file" name="images_banner[]" id="slide-'+banner_id+'" class="custom-input-file custom-input-file--4" data-multiple-caption="{count} files selected" multiple accept="image/*" />';
            shopBannerAdd +=  '<label for="slide-'+banner_id+'" class="mw-100 mb-3">';
            shopBannerAdd +=  '<span></span>';
            shopBannerAdd +=  '<strong>';
            shopBannerAdd +=  '<i class="fa fa-upload"></i>';
            shopBannerAdd +=  "{{__('Choose image')}}";
            shopBannerAdd +=  '</strong>';
            shopBannerAdd +=  '</label>';
            shopBannerAdd +=  '</div>';
            shopBannerAdd +=  '</div>';
            $('#shop-banner-images').append(shopBannerAdd);

            banner_id++;
            imageInputInitialize();
            }
        }
        
        
        function delete_this_row(em){
            $(em).closest('.row').remove();
        }


        $(document).ready(function(){
            $('.remove-files').on('click', function(){
                $(this).parents(".col-md-6").remove();
            });
        });

        function selectTax(el){
            if(el.value=='vat'){
                $('#tax_id').css('display','flex');
            }else{
                $('#tax_id').css('display','none');
            }
        }
        
      function dayChange(el,open,close){
        	if(el.checked){
        	 open.readOnly = true;
        	 close.readOnly = true;
        	}else{
        	
        	 open.readOnly = false;
        	 close.readOnly = false;
        	}
        }
        
	    var input = document.querySelector("#pNo");
	  var data =   window.intlTelInput(input, {
	    customPlaceholder: function(selectedCountryPlaceholder, selectedCountryData) {
	                return "e.g. " + selectedCountryPlaceholder;
	            },
	    })
	    ;
	
	$("#pNo").on("countrychange", function(e){
	    dialCode = data.getSelectedCountryData()["dialCode"];
	        $('#countryCode').val(dialCode)
	});
	</script>
@endsection
