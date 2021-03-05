@extends('layouts.app')

@section('content')

<style>
.fa{
    padding: 7px;
    color: white;
}
.bg-twitter {
	background-color:#00aced;
}
.bg-facebook {
	background-color:#3b579d;
}
.bg-google {
	background-color:#dd4a3a;
}
.bg-instagram {
	background-color:#e1306c;
}
.bg-youtube {
	background-color:#E62117;
}

</style>

<!-- Basic Data Tables -->
<!--===================================================-->
<div class="col-lg-12 ">
    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title">{{__('Shop Setting')}}</h3>
        </div>
    <form class="form-horizontal" action="{{ route('shops.update',$shop->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input name="_method" type="hidden" value="PATCH">
    
    <div class="panel-body">
       <div class="form-group">
                <label class="col-sm-3 control-label" for="name">{{__('Store Name')}} <span class="required-star">*</span></label>
                <div class="col-sm-9">
                        <input type="text" class="form-control mb-3" id="searchName"  value="{{ $shop->name }}" placeholder="{{__('Shop Name')}}" name="name" required>
                </div>
                <div class="spinner-border spinner_own no_package" id="spinner"></div>
                <div class="spinner_own no_package" id="tick">X</div>
                <div class="spinner_own no_package" id="cross">&check;</div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="logo">{{__('Logo')}}</label>
                    <div class="img-upload-preview">
                        <img loading="lazy"  src="{{ asset($shop->logo) }}" alt="" class="img-responsive">
                        <input type="hidden" name="logo" value="{{ $shop->logo }}">
                        <button type="button" class="btn btn-danger close-btn remove-files"><i class="fa fa-times"></i></button>
                    </div>
                <div style="display:none" id="file_upload">
                    <input class="d-none"  type="file" name="logo">
            	</div>	
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="address">{{__('Address')}}  <span class="required-star">*</span></label>
                <div class="col-sm-9">
                    <input  value="{{$shop->address }}" type="text" class="form-control mb-3" placeholder="{{__('Address')}}" name="address" required>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="address">{{__('Phone Number')}} <span class="required-star">*</span></label>
                <div class="col-sm-9">
                   <input  value="{{ $shop->phone }}" type="text" class="form-control mb-3" placeholder="{{__('Phone Number')}}" name="phone" required>
                </div>
            </div>
          
          
        </div>   
            <div class="panel-footer text-right">
                <button class="btn btn-purple" type="submit">{{__('Save')}}</button>
            </div>
        </form>
</div>



<div class="col-lg-12 ">
    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title">{{__('Cover Settings')}}</h3>
        </div>
        <form class="form-horizontal" action="{{ route('shops.update',$shop->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input name="_method" type="hidden" value="PATCH">
            <div class="panel-body">
            <div class="form-box bg-white mt-4">
                <div class="form-box-content p-3">
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
                            <div id="cover">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
                <div class="panel-footer text-right">
                    <button class="btn btn-purple" type="submit">{{__('Save')}}</button>
                </div>
        </form>
    </div>
</div>            


<div class="col-lg-12 ">
    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title">{{__('Slider Settings')}}</h3>
        </div>
    <form class="form-horizontal" action="{{ route('shops.update',$shop->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input name="_method" type="hidden" value="PATCH">
    
    <div class="panel-body">
      <div class="form-box bg-white mt-4">
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
                                <div id="slider">
                                </div>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel-footer text-right">
            <button class="btn btn-purple" type="submit">{{__('Save')}}</button>
        </div>
        </form>
    </div>
</div>


<div class="col-lg-12 ">
    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title">{{__('Banner Settings')}}</h3>
        </div>
    <form class="form-horizontal" action="{{ route('shops.update',$shop->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input name="_method" type="hidden" value="PATCH">
    
    <div class="panel-body">
      <div class="form-box bg-white mt-4">
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
                                <div id="banner">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel-footer text-right">
            <button class="btn btn-purple" type="submit">{{__('Save')}}</button>
        </div>
        </form>
    </div>
</div>



<div class="col-lg-12 ">
    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title">{{__('Business Operating Times')}}</h3>
        </div>
        <form class="" action="{{ route('shops.update', $shop->id) }}" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="_method" value="PATCH">
            @csrf
            <div class="form-box bg-white mt-4">
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
            <div class="panel-footer text-right">
	        <button class="btn btn-purple" type="submit">{{__('Save')}}</button>
	    </div>
        </form>
        </div>
      </div>

<div class="col-lg-12 ">
    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title">{{__('Social Media Share')}}</h3>
        </div>
    <form class="form-horizontal" action="{{ route('shops.update',$shop->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input name="_method" type="hidden" value="PATCH">
    
	    <div class="panel-body">
	         <div class="form-box bg-white mt-4">
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
	                    </div>
	                    <div class="row">
	                     
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
	    </div>
	    <div class="panel-footer text-right">
	        <button class="btn btn-purple" type="submit">{{__('Save')}}</button>
	    </div>
	        </form>
	    </div>
	</div>
@endsection

@section('script')
<script type="text/javascript">
    $(document).ready(function(){

     $('#searchName').keyup(function(){
    $('#spinner').css('display','block');
    $('#cross').css('display','none');
    $('#tick').css('display','none');
    var query = $(this).val();
    if(query != ''){
       $.ajax({
        url:"{{ route('shops.create.search') }}",
        method:"GET",
        data:{_token: '{{ csrf_token()}}', name:query},
        success:function(data){

            if(data == "false"){
                $('#spinner').css('display','none');
                $('#cross').css('display','block');
                $('#tick').css('display','none');
            }else{
                $('#spinner').css('display','none');
                $('#cross').css('display','none');
                $('#tick').css('display','block');
            }
    }
    });}
    });

    $("#slider").spartanMultiImagePicker({
			fieldName:        'sliders[]',
			maxCount:         3,
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

$("#banner").spartanMultiImagePicker({
			fieldName:        'images_banner[]',
			maxCount:         3,
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
        
$("#cover").spartanMultiImagePicker({
			fieldName:        'cover',
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
$('.remove-files').on('click', function(){
            $(this).parents(".img-upload-preview").remove();
            $('#file_upload').css('display', "block" )
        });


</script>

@endsection
