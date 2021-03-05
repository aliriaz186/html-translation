@extends('layouts.app')
@section('content')
    <div class="col-lg-10 col-lg-offset-1">
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title">{{__('Shipping Profile')}}</h3>
            </div>
             <div class="panel-body">
                    <div class="tab-base">
                        @if(App\SellerCountry::where('seller_id',Auth::user()->id)->first()->shipping_type == null)
                            <form action="{{route('seller.set_default_shipping_price')}}" method="POST">
                            @csrf
                        @else
                            <form action="{{route('seller.edit_default_shipping_price')}}" method="POST">
                            @csrf
                        @endif
                        @if(App\SellerCountry::where('seller_id',Auth::user()->id)->first()->shipping_type == null)
                             <ul class="nav nav-tabs" role="tablist">
                                @foreach(json_decode(App\SellerCountry::where('seller_id',Auth::user()->id)->first()->setCountries) as $key=>$country)
                                    <li class="nav-item  {{$key==0?'active':''}}">
                                    	  @php  $country =str_replace('_',' ', $country); @endphp
                                        <a class="nav-link {{$key==0?'active':''}}" data-toggle="tab" href="#tabs-{{$key}}" role="tab">{{$country}}</a>
                                    </li>
                                @endforeach
                            </ul>
                            <div class="tab-content">
                            <br>
                            @foreach(json_decode(App\SellerCountry::where('seller_id',Auth::user()->id)->first()->setCountries) as $key=>$country)
                             <div class="tab-pane {{$key==0?'active':''}}" id="tabs-{{$key}}" role="tabpanel">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label>{{__('Shipping Type')}}</label>
                                        </div>
                                        <div class="col-md-10">
                                                <select name="shipping_type[]" onchange="changeCatch('{{$country}}',this)" class="form-control" required>
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
                                                    @foreach (App\Shipping::all() as $ship)
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
                                <div id="{{$country}}--addButtonShippingCourier" class="text-right" style="display:none">
                                    <button type="button" class="btn btn-info mb-3" onclick="add_more_shipping_courier('{{$country}}')">{{ __('Add More') }}</button>
                                </div>
                             </div>
                                @endforeach
                        @else
                             <div class="form-box-content p-3">
                                <ul class="nav nav-tabs" role="tablist">

                                    @foreach(json_decode(App\SellerCountry::where('seller_id',Auth::user()->id)->first()->setCountries) as $key=>$country)
                                        <li class="nav-item  {{$key==0?'active':''}}">
                                        	  @php  $country =str_replace('_',' ', $country); @endphp
                                            <a class="nav-link {{$key==0?'active':''}}" data-toggle="tab" href="#tabs-{{$key}}" role="tab">{{$country}}</a>
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
                                                        @php
                                                        $shh  = App\SellerCountry::where('seller_id',Auth::user()->id)->first();
                                                            $shipping_type_selected = explode('--',json_decode($shh->shipping_type)[$key])[0];
                                                            $cost_shipping = explode('--',json_decode($shh->shipping_cost)[$key]);
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
                                            @php
                                                $shippingCourierPrice = json_decode($shh->shipping_courier_price);
                                                $shippingCourierType = json_decode($shh->shipping_courier_type);
                                                $old_country = $country;
                                            @endphp
                                            @foreach ($shippingCourierType as $key_courier=>$ship_courier_company_id_with_country)
                                            <div class="row"  @if ($shipping_type_selected!='courier') style="display: none" @endif >
                                                @php $ship_courier_company_id_with_country = explode('--',$ship_courier_company_id_with_country);  $get_id_courier_company = $ship_courier_company_id_with_country[0]; $get_country = $ship_courier_company_id_with_country[1];  $courier_company_prices = explode('--',$shippingCourierPrice[$key_courier]); @endphp
                                                    @if($country == $get_country)
                                                        @php $courier_company = App\Shipping::findOrFail($get_id_courier_company); @endphp
                                                        <div class="col-md-2">
                                                            @if($key_courier==0 ||$country != $old_country)
                                                            <label>{{__('Courier Company')}}</label>
                                                            @else
                                                                <button type="button" onclick="delete_this_row_shipping('{{$country}}',this,{{$key_courier}})" class="btn btn-link btn-icon text-danger"><i class="fa fa-trash-o"></i></button>
                                                            @endif
                                                        </div>
                                                        <div class="col-md-8">
                                                            <select name="shipping_courier_type[]" class="form-control demo-select2" onchange="premiumChange('{{$country}}',this)">
                                                                @foreach (App\Shipping::all() as $ship_all)
                                                                    <option {{$ship_all->id==$courier_company->id?'selected':''}} value="{{$ship_all->id}}-{{$ship_all->premium}}-{{$key_courier}}--{{$country}}">{{$ship_all->name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    @else
                                                    @php  $old_country = $get_country; @endphp
                                                    @endif
                                            </div>
                                            @if($get_country == $country)
                                            <div class="row" id="{{$country}}--premium_price{{$key_courier}}"   style="{{$courier_company->premium == 'on'?'display: none':'display:flex' }}">
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
                                                <div class="col-md-8 mt-1 mb-1" id="{{$country}}--premium_data{{$key_courier}}" style="{{$courier_company->premium == 'on'?'display:flex':'display:none'}}" >
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
                        @endif
                    </div>
            </div>
            <div class="panel-footer text-right">
                @if(App\SellerCountry::where('seller_id',Auth::user()->id)->first()->shipping_type == null)
                    <button class="btn btn-purple" type="submit">{{__('Save')}}</button>
                @else
                    <button class="btn btn-purple" type="submit">{{__('Save / Edit')}}</button>
                @endif
            </div>
        </form>
        </div>
    </div>
@endsection
@section('script')
   <script>
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
                console.log(`#${country}--courier_shipping_data`);
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
            console.log(3);
           var shipping_data =  `<div class="row">
            <br>
                <div class="col-md-2">
                <button type="button" onclick="delete_this_row_shipping('${country}',this,${increment})" class="btn btn-link btn-icon text-danger"><i class="fa fa-trash-o"></i></button>
                </div>
                <div class="col-md-8">
                        <select name="shipping_courier_type[]" class="form-control " onchange="premiumChange('${country}',this)">
                            <option value="Selected" selected>Please Select Courier Company </option>
                            @foreach (App\Shipping::all() as $ship)
                                <option value="{{$ship->id}}-{{$ship->premium}}-${increment}--${country}">{{$ship->name}}</option>
                            @endforeach
                        </select>
                </div>
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
        function premiumChange(country,event){
            premium = event.value;
                    premium = premium.split('-');
                    if(premium[1]=='on'){
                        $(`#${country}--premium_price`+premium[2]).css('display','none');
                        $(`#${country}--premium_data`+premium[2]).css('display','flex');
                    }else{
                        $(`#${country}--premium_price`+premium[2]).css('display','flex');
                        $(`#${country}--premium_data`+premium[2]).css('display','none');
                    }
        }

        function delete_this_row_shipping(country,e,id){
            delete_this_row(e);
            $(`#${country}--premium_price`+id).closest('.row').remove();
            $(`#${country}--premium_data`+id).closest('.row').remove();
        }
        function delete_this_row(em){
            $(em).closest('.row').remove();
        }
    </script>
@endsection
