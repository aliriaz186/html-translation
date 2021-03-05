@extends('layouts.app')

@section('content')

    <div class="tab-base">

        <!--Nav Tabs-->
        <ul class="nav nav-tabs">
            <li class="active">
                <a data-toggle="tab" href="#demo-lft-tab-1" aria-expanded="true">{{ __('Home slider') }}</a>
            </li>
            <li class="">
                <a data-toggle="tab" href="#demo-lft-tab-2" aria-expanded="false">{{ __('Home banner 1') }}</a>
            </li>
            <li class="">
                <a data-toggle="tab" href="#demo-lft-tab-4" aria-expanded="false">{{ __('Home categories') }}</a>
            </li>
            <li class="">
                <a data-toggle="tab" href="#demo-lft-tab-3" aria-expanded="false">{{ __('Home banner 2') }}</a>
            </li>  
             <li class="">
                <a data-toggle="tab" href="#demo-lft-tab-8" aria-expanded="false">{{ __('Circle banner') }}</a>
            </li>
            <li class="">
                <a data-toggle="tab" href="#demo-lft-tab-5" aria-expanded="false">{{ __('Top 10') }}</a>
            </li>
            <li class="">
                <a data-toggle="tab" href="#demo-lft-tab-6" aria-expanded="false">{{ __('Top banner') }}</a>
            </li>
            <li class="">
                <a data-toggle="tab" href="#demo-lft-tab-7" aria-expanded="false">{{ __('Classified banner') }}</a>
            </li>
            
        </ul>

        <!--Tabs Content-->
        <div class="tab-content">
            <div id="demo-lft-tab-1" class="tab-pane fade active in">

                @if(permission_check_all('sliders') || permission_check_delete('sliders') || permission_check_post('sliders') || permission_check_put('sliders') )
                    <div class="row">
                        <div class="col-sm-12">
                            <a onclick="add_slider()" class="btn btn-rounded btn-info pull-right">{{__('Add New Slider')}}</a>
                        </div>
                    </div>
                @endif
                <br>

                <div class="panel">
                    <div class="panel-heading">
                        <h3 class="panel-title">{{__('Home slider')}}</h3>
                    </div>
                    <div class="panel-body">
                        <table class="table table-striped table-bordered demo-dt-basic" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{__('Photo')}}</th>
                                    <th width="50%">{{__('Link')}}</th>
                                    <th>{{__('Published')}}</th>
                                    <th width="10%">{{__('Options')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach(\App\Slider::all() as $key => $slider)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td><img loading="lazy"  class="img-md" src="{{ asset($slider->photo)}}" alt="Slider Image"></td>
                                        <td>{{$slider->link}}</td>
                                        <td><label class="switch">
                                            <input onchange="update_slider_published(this)" value="{{ $slider->id }}" type="checkbox" <?php if($slider->published == 1) echo "checked";?> >
                                            <span class="slider round"></span></label></td>
                                        <td>
                                            <div class="btn-group dropdown">
                                                <button class="btn btn-primary dropdown-toggle dropdown-toggle-icon" data-toggle="dropdown" type="button">
                                                    {{__('Actions')}} <i class="dropdown-caret"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-right">
                                                    @if(permission_check_all('sliders') || permission_check_delete('sliders')  )
                                                        <li><a onclick="confirm_modal('{{route('sliders.destroy', $slider->id)}}');">{{__('Delete')}}</a></li>
                                                    @endif
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
            <div id="demo-lft-tab-2" class="tab-pane fade">

                @if(permission_check_all('banners') || permission_check_post('banners') )
                    <div class="row">
                        <div class="col-sm-12">
                            <a onclick="add_banner_1()" class="btn btn-rounded btn-info pull-right">{{__('Add New Banner')}}</a>
                        </div>
                    </div>
                @endif
                <br>

                <div class="panel">
                    <div class="panel-heading">
                        <h3 class="panel-title">{{__('Home banner')}} (Max 3 published)</h3>
                    </div>
                    <div class="panel-body">
                        <table class="table table-striped table-bordered demo-dt-basic" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{__('Photo')}}</th>
                                    <th>{{__('Position')}}</th>
                                    <th>{{__('Published')}}</th>
                                    <th width="10%">{{__('Options')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach(\App\Banner::where('position', 1)->get() as $key => $banner)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td><img loading="lazy"  class="img-md" src="{{ asset($banner->photo)}}" alt="banner Image"></td>
                                        <td>{{ __('Banner Position ') }}{{ $banner->position }}</td>
                                        <td><label class="switch">
                                            <input onchange="update_banner_published(this)" value="{{ $banner->id }}" type="checkbox" <?php if($banner->published == 1) echo "checked";?> >
                                            <span class="slider round"></span></label></td>
                                        <td>
                                            <div class="btn-group dropdown">
                                                <button class="btn btn-primary dropdown-toggle dropdown-toggle-icon" data-toggle="dropdown" type="button">
                                                    {{__('Actions')}} <i class="dropdown-caret"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-right">
                                                     @if(permission_check_all('banners') || permission_check_delete('banners') || permission_check_post('banners') || permission_check_put('banners') )
                                                        <li><a onclick="edit_home_banner_1({{ $banner->id }})">{{__('Edit')}}</a></li>
                                                    @endif
                                                    @if(permission_check_all('banners') || permission_check_delete('banners') || permission_check_post('banners') || permission_check_put('banners') )
                                                        <li><a onclick="confirm_modal('{{route('home_banners.destroy', $banner->id)}}');">{{__('Delete')}}</a></li>
                                                    @endif
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
            <div id="demo-lft-tab-3" class="tab-pane fade">

                @if(permission_check_all('banners') || permission_check_post('banners') )
                    <div class="row">
                        <div class="col-sm-12">
                            <a onclick="add_banner_2()" class="btn btn-rounded btn-info pull-right">{{__('Add New Banner')}}</a>
                        </div>
                    </div>
                @endif
                <br>

                <div class="panel">
                    <div class="panel-heading">
                        <h3 class="panel-title">{{__('Home banner')}} (Max 3 published)</h3>
                    </div>
                    <div class="panel-body">
                        <table class="table table-striped table-bordered demo-dt-basic" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{__('Photo')}}</th>
                                    <th>{{__('Position')}}</th>
                                    <th>{{__('Published')}}</th>
                                    <th width="10%">{{__('Options')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach(\App\Banner::where('position', 2)->get() as $key => $banner)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td><img loading="lazy"  class="img-md" src="{{ asset($banner->photo)}}" alt="banner Image"></td>
                                        <td>{{ __('Banner Position ') }}{{ $banner->position }}</td>
                                        <td><label class="switch">
                                            <input onchange="update_banner_published(this)" value="{{ $banner->id }}" type="checkbox" <?php if($banner->published == 1) echo "checked";?> >
                                            <span class="slider round"></span></label></td>
                                        <td>
                                            <div class="btn-group dropdown">
                                                <button class="btn btn-primary dropdown-toggle dropdown-toggle-icon" data-toggle="dropdown" type="button">
                                                    {{__('Actions')}} <i class="dropdown-caret"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-right">
                                                    @if(permission_check_all('banners') || permission_check_put('banners')  )
                                                        <li><a onclick="edit_home_banner_2({{ $banner->id }})">{{__('Edit')}}</a></li>
                                                    @endif
                                                    @if(permission_check_all('banners') || permission_check_delete('banners')  )
                                                        <li><a onclick="confirm_modal('{{route('home_banners.destroy', $banner->id)}}');">{{__('Delete')}}</a></li>
                                                    @endif
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
            <div id="demo-lft-tab-4" class="tab-pane fade">

                @if(permission_check_all('categories') || permission_check_post('categories')  )
                <div class="row">
                    <div class="col-sm-12">
                        <a onclick="add_home_category()" class="btn btn-rounded btn-info pull-right">{{__('Add New Category')}}</a>
                    </div>
                </div>
                @endif

                <br>

                <div class="panel">
                    <div class="panel-heading">
                        <h3 class="panel-title">{{__('Home Categories')}}</h3>
                    </div>
                    <div class="panel-body">
                        <table class="table table-striped table-bordered demo-dt-basic" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{__('Category')}}</th>
                                    <th>{{__('Subsubcategories')}}</th>
                                    <th>{{ __('Status') }}</th>
                                    <th width="10%">{{__('Options')}}</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach(\App\HomeCategory::all() as $key => $home_category)
                                    <tr>
                                        <td>{{$key+1}}</td>

                                        <td>{{$home_category->category->name}}</td>
                                        <td>
                                            @foreach (json_decode($home_category->subsubcategories) as $key => $subsubcategory_id)
                                                @if (\App\SubSubCategory::find($subsubcategory_id) != null)

                                                    <span class="badge badge-info">{{\App\SubSubCategory::find($subsubcategory_id)->name}}</span>
                                                @endif
                                            @endforeach
                                        </td>
                                        <td><label class="switch">
                                            <input onchange="update_home_category_status(this)" value="{{ $home_category->id }}" type="checkbox" <?php if($home_category->status == 1) echo "checked";?> >
                                            <span class="slider round"></span></label></td>
                                        <td>
                                            <div class="btn-group dropdown">
                                                <button class="btn btn-primary dropdown-toggle dropdown-toggle-icon" data-toggle="dropdown" type="button">
                                                    {{__('Actions')}} <i class="dropdown-caret"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-right">
                                                    @if(permission_check_all('categories') || permission_check_put('categories')  )
                                                        <li><a onclick="edit_home_category({{ $home_category->id }})">{{__('Edit')}}</a></li>
                                                    @endif
                                                    @if(permission_check_all('categories') || permission_check_delete('categories')  )
                                                        <li><a onclick="confirm_modal('{{route('home_categories.destroy', $home_category->id)}}');">{{__('Delete')}}</a></li>
                                                    @endif
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
            <div id="demo-lft-tab-5" class="tab-pane fade">
                <div class="panel">
                    <div class="panel-heading">
                        <h3 class="panel-title">{{__('Top 10 Information')}}</h3>
                    </div>

                    <!--Horizontal Form-->
                    <!--===================================================-->
                    <form class="form-horizontal" action="{{ route('top_10_settings.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @if(permission_check_all('categories') || permission_check_post('categories') )

                        <div class="panel-body">
                            <div class="form-group">
                                <label class="col-sm-3" for="url">{{__('Top Categories (Max 10)')}}</label>
                                <div class="col-sm-9">
                                    <select class="form-control demo-select2-max-10" name="top_categories[]" multiple required>
                                        @foreach (\App\Category::all() as $key => $category)
                                            <option value="{{ $category->id }}" @if($category->top == 1) selected @endif>{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3" for="url">{{__('Top Brands (Max 10)')}}</label>
                                <div class="col-sm-9">
                                    <select class="form-control demo-select2-max-10" name="top_brands[]" multiple required>
                                        @foreach (\App\Brand::all() as $key => $brand)
                                            <option value="{{ $brand->id }}" @if($brand->top == 1) selected @endif>{{ $brand->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="panel-footer text-right">
                            <button class="btn btn-purple" type="submit">{{__('Save')}}</button>
                        </div>
                        @endif
                    </form>
                    <!--===================================================-->
                    <!--End Horizontal Form-->

                </div>
            </div>

            <div id="demo-lft-tab-6" class="tab-pane fade">

                @if(permission_check_all('top_banners') || permission_check_post('top_banners') )
                <div class="row">
                    <div class="col-sm-12">
                        <a onclick="add_new_top_banner()" class="btn btn-rounded btn-info pull-right">{{__('Add New Top')}}</a>
                    </div>
                </div>
                @endif
                <br>
                <div class="panel">
                    <div class="panel-heading">
                        <h3 class="panel-title">{{__('Top Banner')}}</h3>
                    </div>
                    <div class="panel-body">
                        <table class="table table-striped table-bordered demo-dt-basic" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    @if(permission_check_all('top_banners') || permission_check_post('top_banners') )
                                        <th>{{__('Status')}}</th>
                                    @endif
                                    <th>{{__('Message')}}</th>
                                    <th>{{__('Color')}}</th>
                                    <th>{{__('Height')}}</th>
                                    <th width="10%">{{__('Options')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach(\App\TopBanner::all() as $key => $topBanner)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    @if(permission_check_all('top_banners') || permission_check_post('top_banners') )
                                    <td><label class="switch">
                                        <input onchange="update_top_banner(this)" value="{{ $topBanner->id }}" type="checkbox" <?php if($topBanner->status == 1) echo "checked";?> >
                                        <span class="slider round"></span></label>
                                    </td>
                                    @endif
                                    <td>{!!$topBanner->message!!}</td>
                                    <td>{{$topBanner->color}}</td>
                                    <td>{{$topBanner->height}}</td>
                                    <td>
                                        <div class="btn-group dropdown">
                                            <button class="btn btn-primary dropdown-toggle dropdown-toggle-icon" data-toggle="dropdown" type="button">
                                                {{__('Actions')}} <i class="dropdown-caret"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-right">
                                                @if(permission_check_all('top_banners') || permission_check_delete('top_banners') )
                                                    <li><a onclick="confirm_modal('{{route('top_banner.destroy',$topBanner->id)}}');">{{__('Delete')}}</a></li>
                                                @endif
                                                </ul>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
               <!-- banner text picture  -->

            {{-- classified  --}}
            <div id="demo-lft-tab-7" class="tab-pane fade">

                @if(permission_check_all('customer_products') || permission_check_post('customer_products') )
                <div class="row">
                    <div class="col-sm-12">
                        <a onclick="add_new_classified()" class="btn btn-rounded btn-info pull-right">{{__('Add New Classified')}}</a>
                    </div>
                </div>
                @endif
                <br>
                <div class="panel">
                    <div class="panel-heading">
                        <h3 class="panel-title">{{__(' Classified Product')}}</h3>
                    </div>
                    <div class="panel-body">
                        <table class="table table-striped table-bordered demo-dt-basic" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    @if(permission_check_all('classified_products_frontends') || permission_check_post('classified_products_frontends') )
                                        <th>{{__('Status')}}</th>
                                    @endif
                                    {{-- <th>{{__('Banner')}}</th> --}}
                                    <th>{{__('Slider')}}</th>
                                    <th>{{__('Title')}}</th>
                                    {{-- <th>{{__('Text')}}</th> --}}
                                    <th width="10%">{{__('Options')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach(\App\ClassifiedProductsFrontend::all() as $key => $classifiedProducts)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    @if(permission_check_all('classified_products_frontends') || permission_check_post('classified_products_frontends') )
                                    <td><label class="switch">
                                        <input onchange="update_top_classified(this)" value="{{ $classifiedProducts->id }}" type="checkbox" <?php if($classifiedProducts->status == 1) echo "checked";?> >
                                        <span class="slider round"></span></label>
                                    </td>
                                    @endif
                                    {{-- <td><img loading="lazy"  class="img-md" src="{{ asset($classifiedProducts->banner_image)}}" alt="banner Image"></td> --}}
                                    <td><img loading="lazy"  class="img-md" src="{{ asset($classifiedProducts->slider_image)}}" alt="slider Image"></td>
                                    <td>{!!$classifiedProducts->title!!}</td>
                                    {{-- <td>{!!$classifiedProducts->text!!}</td> --}}
                                    <td>
                                        <div class="btn-group dropdown">
                                            <button class="btn btn-primary dropdown-toggle dropdown-toggle-icon" data-toggle="dropdown" type="button">
                                                {{__('Actions')}} <i class="dropdown-caret"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-right">
                                                @if(permission_check_all('classified_products_frontends') || permission_check_delete('classified_products_frontends') )
                                                    <li><a onclick="confirm_modal('{{route('classified_products.destroy',$classifiedProducts->id)}}');">{{__('Delete')}}</a></li>
                                                @endif
                                                </ul>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
              <div id="demo-lft-tab-8" class="tab-pane fade">

                @if(permission_check_all('circle_banners') || permission_check_post('circle_banners') )
                    <div class="row">
                        <div class="col-sm-12">
                            @if(count(\App\BannerCircle::where('status',1)->get()) < 6)
                            <a onclick="add_banner_circle_1()" class="btn btn-rounded btn-info pull-right">{{__('Add New Banner')}}</a>
                            @endif
                        </div>
                    </div>
                @endif
                <br>

                <div class="panel">
                    <div class="panel-heading">
                        <h3 class="panel-title">{{__('Circle banner')}} (Max 6 published)</h3>
                    </div>
                    <div class="panel-body">
                        <table class="table table-striped table-bordered demo-dt-basic" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{__('Status')}}</th>
                                    <th>{{__('Photo')}}</th>
                                    <th>{{__('Title')}}</th>
                                    <th>{{__('Link')}}</th>
                                    <th width="10%">{{__('Options')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach(\App\BannerCircle::all() as $key => $banner)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                         <td><label class="switch">
                                            <input onchange="update_banner_circle_status(this)"  value="{{ $banner->id }}" type="checkbox" {{$banner->status == 1?"checked":''}} >
                                            <span class="slider round"></span></label></td>
                                        <td><img loading="lazy"  class="img-md" src="{{ asset($banner->photo)}}" alt="banner Image"></td>
                                        <td>{{$banner->title}}</td>

                                        <td>{{$banner->link}}</td>
                                        <td>
                                             <div class="btn-group dropdown">
                                                <button class="btn btn-primary dropdown-toggle dropdown-toggle-icon" data-toggle="dropdown" type="button">
                                                    {{__('Actions')}} <i class="dropdown-caret"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-right">
                                                     @if(permission_check_all('circle_banners') || permission_check_delete('circle_banners') || permission_check_post('circle_banners') || permission_check_put('circle_banners') )
                                                        <li><a onclick="edit_home_banner_circle({{ $banner->id }})">{{__('Edit')}}</a></li>
                                                    @endif
                                                    @if(permission_check_all('circle_banners') || permission_check_delete('circle_banners') || permission_check_post('circle_banners') || permission_check_put('circle_banners') )
                                                        <li><a onclick="confirm_modal('{{route('home_circle_banners.destroy', $banner->id)}}');">{{__('Delete')}}</a></li>
                                                    @endif
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')

<script type="text/javascript">

    function updateSettings(el, type){
        if($(el).is(':checked')){
            var value = 1;
        }
        else{
            var value = 0;
        }
        $.post('{{ route('business_settings.update.activation') }}', {_token:'{{ csrf_token() }}', type:type, value:value}, function(data){
            if(data == 1){
                showAlert('success', 'Settings updated successfully');
            }
            else{
                showAlert('danger', 'Something went wrong');
            }
        });
    }

    function add_slider(){
        $.get('{{ route('sliders.create')}}', {}, function(data){
            $('#demo-lft-tab-1').html(data);
        });
    }

    function add_banner_1(){
        $.get('{{ route('home_banners.create', 1)}}', {}, function(data){
            $('#demo-lft-tab-2').html(data);
        });
    }

    function add_banner_2(){
        $.get('{{ route('home_banners.create', 2)}}', {}, function(data){
            $('#demo-lft-tab-3').html(data);
        });
    }

  function add_banner_circle_1(){
        $.get('{{ route('home_circle_banners.create')}}', {}, function(data){
            $('#demo-lft-tab-8').html(data);
        });
    }
    
    function edit_home_banner_1(id){
        var url = '{{ route("home_banners.edit", "home_banner_id") }}';
        url = url.replace('home_banner_id', id);
        $.get(url, {}, function(data){
            $('#demo-lft-tab-2').html(data);
            $('.demo-select2-placeholder').select2();
        });
    }

    function edit_home_banner_2(id){
        var url = '{{ route("home_banners.edit", "home_banner_id") }}';
        url = url.replace('home_banner_id', id);
        $.get(url, {}, function(data){
            $('#demo-lft-tab-3').html(data);
            $('.demo-select2-placeholder').select2();
        });
    }
    
     function edit_home_banner_circle(id){
        var url = '{{ route("home_circle_banners.edit", "home_circle_banner_id") }}';
        url = url.replace('home_circle_banner_id', id);
        $.get(url, {}, function(data){
            $('#demo-lft-tab-8').html(data);
            $('.demo-select2-placeholder').select2();
        });
    }


    function add_home_category(){
        $.get('{{ route('home_categories.create')}}', {}, function(data){
            $('#demo-lft-tab-4').html(data);
            $('.demo-select2-placeholder').select2();
        });
    }

    function edit_home_category(id){
        var url = '{{ route("home_categories.edit", "home_category_id") }}';
        url = url.replace('home_category_id', id);
        $.get(url, {}, function(data){
            $('#demo-lft-tab-4').html(data);
            $('.demo-select2-placeholder').select2();
        });
    }

    function add_new_top_banner(){
        $.get('{{ route('top_banner.create')}}', {}, function(data){
            $('#demo-lft-tab-6').html(data);
        });
    }
    function add_new_classified(){

        $.get('{{ route('classified_products.create')}}', {}, function(data){
            $('#demo-lft-tab-7').html(data);
        });
    }

    function update_home_category_status(el){
        if(el.checked){
            var status = 1;
        }
        else{
            var status = 0;
        }
        $.post('{{ route('home_categories.update_status') }}', {_token:'{{ csrf_token() }}', id:el.value, status:status}, function(data){
            if(data == 1){
                showAlert('success', 'Home Page Category status updated successfully');
            }
            else{
                showAlert('danger', 'Something went wrong');
            }
        });
    }

    function update_banner_published(el){
        if(el.checked){
            var status = 1;
        }
        else{
            var status = 0;
        }
        $.post('{{ route('home_banners.update_status') }}', {_token:'{{ csrf_token() }}', id:el.value, status:status}, function(data){
            if(data == 1){
                showAlert('success', 'Banner status updated successfully');
            }
            else{
                showAlert('danger', 'Maximum 4 banners to be published');
            }
        });
    }

    function update_slider_published(el){
        if(el.checked){
            var status = 1;
        }
        else{
            var status = 0;
        }
        var url = '{{ route('sliders.update', 'slider_id') }}';
        url = url.replace('slider_id', el.value);

        $.post(url, {_token:'{{ csrf_token() }}', status:status, _method:'PATCH'}, function(data){
            if(data == 1){
                showAlert('success', 'Published sliders updated successfully');
            }
            else{
                showAlert('danger', 'Something went wrong');
            }
        });
    }

    function update_top_banner(el){
        if(el.checked){
            var status = 1;
        }
        else{
            var status = 0;
        }
        $.post('{{route('top_banner.update')}}', {_token:'{{ csrf_token() }}', id:el.value , status:status}, function(data){
            if(data == 1){
                showAlert('success', 'Top Banner updated successfully');
                location.reload();
            }
            else{
                showAlert('danger', 'Something went wrong');
                location.reload();

            }
        });
    }

    
    function update_banner_circle_status(el){
        if(el.checked){
            var status = 1;
        }
        else{
            var status = 0;
        }
        $.post('{{ route('banners_circle.update_status') }}', {_token:'{{ csrf_token() }}', id:el.value, status:status}, function(data){
            if(data == 1){
                showAlert('success', 'Banner status updated successfully');
            }
            else{
                showAlert('danger', 'Maximum 4 banners to be published');
            }
        });
    }
</script>

@endsection
