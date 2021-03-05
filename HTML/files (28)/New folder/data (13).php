@extends('frontend.layouts.app')
@section('content')

    <div id="page-content">
        <section class="slice-xs sct-color-2 border-bottom">
            <div class="container container-sm">
                <div class="row cols-delimited justify-content-center">
                    <div class="col">
                        <div class="icon-block icon-block--style-1-v5 text-center ">
                            <div class="block-icon c-gray-light mb-0">
                                <i class="la la-shopping-cart"></i>
                            </div>
                            <div class="block-content d-none d-md-block">
                                <h3 class="heading heading-sm strong-300 c-gray-light text-capitalize">1. {{__('My Cart')}}</h3>
                            </div>
                        </div>
                    </div>

                    <div class="col">
                        <div class="icon-block icon-block--style-1-v5 text-center ">
                            <div class="block-icon mb-0 c-gray-light">
                                <i class="la la-map-o"></i>
                            </div>
                            <div class="block-content d-none d-md-block">
                                <h3 class="heading heading-sm strong-300 c-gray-light text-capitalize">2. {{__('Shipping info')}}</h3>
                            </div>
                        </div>
                    </div>

                    <div class="col">
                        <div class="icon-block icon-block--style-1-v5 text-center active">
                            <div class="block-icon mb-0">
                                <i class="la la-truck"></i>
                            </div>
                            <div class="block-content d-none d-md-block">
                                <h3 class="heading heading-sm strong-300 c-gray-light text-capitalize">3. {{__('Delivery info')}}</h3>
                            </div>
                        </div>
                    </div>

                    <div class="col">
                        <div class="icon-block icon-block--style-1-v5 text-center">
                            <div class="block-icon c-gray-light mb-0">
                                <i class="la la-credit-card"></i>
                            </div>
                            <div class="block-content d-none d-md-block">
                                <h3 class="heading heading-sm strong-300 c-gray-light text-capitalize">4. {{__('Payment')}}</h3>
                            </div>
                        </div>
                    </div>

                    <div class="col">
                        <div class="icon-block icon-block--style-1-v5 text-center">
                            <div class="block-icon c-gray-light mb-0">
                                <i class="la la-check-circle"></i>
                            </div>
                            <div class="block-content d-none d-md-block">
                                <h3 class="heading heading-sm strong-300 c-gray-light text-capitalize">5. {{__('Confirmation')}}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="py-4 gry-bg">
            <div class="container-fluid p-4">
                <div class="row cols-xs-space cols-sm-space cols-md-space">
                    <div class="col-xl-9">
                        <form class="form-default" data-toggle="validator" action="{{ route('checkout.store_delivery_info') }}" role="form" method="POST">
                            @csrf
                            @php
                                $admin_products = array();
                                $seller_products = array();
                                $shipping_type='';
                                foreach (Session::get('cart') as $key => $cartItem){
                                    if(\App\Product::find($cartItem['id'])->added_by == 'admin'){
                                        array_push($admin_products, $cartItem['id']);
                                    }
                                    else{
                                        $product_ids = array();
                                        if(array_key_exists(\App\Product::find($cartItem['id'])->user_id, $seller_products)){
                                            $product_ids = $seller_products[\App\Product::find($cartItem['id'])->user_id];
                                        }
                                        array_push($product_ids, $cartItem['id']);
                                        $seller_products[\App\Product::find($cartItem['id'])->user_id] = $product_ids;
                                    }

                                }
                            @endphp

                            @if (!empty($admin_products))
                            <div class="card mb-3">
                                <div class="card-header bg-white py-3">
                                    <h5 class="heading-6 mb-0">{{ \App\GeneralSetting::first()->site_name }} Products</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <table class="table-cart table-stripped">
                                                <thead>
                                                    <tr>
                                                        <td>#</td>
                                                        <td>Image</td>
                                                        <td>Name</td>
                                                        <td>Select Shipping Method</td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($admin_products as $key => $id)
                                                        @php $seller = $key; @endphp
                                                    <tr class="cart-item">
                                                        <td>{{$key+1}}</td>
                                                        <td class="product-image" >
                                                            <a href="{{ route('product', \App\Product::find($id)->slug) }}" target="_blank">
                                                                <img loading="lazy"  src="{{ asset(\App\Product::find($id)->thumbnail_img) }}">
                                                            </a>
                                                        </td>
                                                        <td class="product-name strong-600">
                                                            <a href="{{ route('product', \App\Product::find($id)->slug) }}" target="_blank" class="d-block c-base-2">
                                                                {{ Illuminate\Support\Str::limit(\App\Product::find($id)->name,45,' (...)') }}
                                                            </a>
                                                        </td>
                                                        <td id="shipment_{{$seller}}_{{$key}}">
                                                            <div class="form-group">
                                                                <select name="shipping_type_{{ $key }}" onchange="select_shipment_option(this,{{$seller}},{{$key}},'admin')" class="form-control" >
                                                                    <option selected>Select Shipment Option</option>
                                                                    <option value="home_delivery">Home Delivery</option>
                                                                    @if (\App\BusinessSetting::where('type', 'pickup_point')->first()->value == 1)
                                                                        <option value="local_pickup">{{ __('Local Pickup') }}</option>
                                                                    @endif
                                                                    </select>
                                                            </div>
                                                            <div>
                                                                <div id="local_pickup_admin__{{$seller}}__{{$key}}"  class="d-none">
                                                                    @if (\App\BusinessSetting::where('type', 'pickup_point')->first()->value == 1)
                                                                        <div class="mt-3 pickup_point_id_admin ">
                                                                            <select class="pickup-select form-control-lg w-100" name="pickup_point_id_admin" data-placeholder="Select a pickup point">
                                                                                    <option value="">{{__('Select your nearest pickup point')}}</option>
                                                                                @foreach (\App\PickupPoint::where('pick_up_status',1)->get() as $pick_up_point)
                                                                                    <option value="{{ $pick_up_point->id }}" data-address="{{ $pick_up_point->address }}" data-phone="{{ $pick_up_point->phone }}">
                                                                                        {{ $pick_up_point->name }}
                                                                                    </option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                                <div id="home_delivery_admin__{{$seller}}__{{$key}}" class="d-none">
                                                                    @php
                                                                        $product =  \App\Product::find($id);
                                                                        $shipping_companies = json_decode($product->shipping_courier_data);
                                                                        $shipping_type = ShippingType($product,$data);
                                                                        $country_id = App\Country::where('name',str_replace('_',' ',$data['country']))->first()->id;
                                                                        $data['product_id'] = $id;
                                                                    @endphp
                                                                    <div class="form-group">
                                                                        @if($shipping_type == 'courier')
                                                                          <select name="shipping_type_courier_seller[]" id="shipping_courier_style{{$key}}" onchange="getCountryNonPremiumData({{$id}},{{$country_id}},{{$seller}},{{$key}},'admin')" class="form-control">
                                                                            <option value="" >Select Shipping Courier</option>
                                                                            {!! gettingShippingCompanies($shipping_companies,$data,ShippingCost($product,$data)) !!}
                                                                        </select>
                                                                        <p id="estimate_admin__{{$seller}}__{{$key}}" class="d-none">Estimated Delivery <span class="text-success" id="estimated_by_admin__{{$seller}}__{{$key}}"> </span>  <span class="text-success" id="estimated_to_admin__{{$seller}}__{{$key}}"> </span></p>
                                                                        @else
                                                                        <select name="shipping_type_courier_seller[]"  class="form-control">
                                                                            <option value="{{$shipping_type}}">{{$shipping_type == 'free'?'Free Shipping':'Flat Rate'}}</option>
                                                                        </select>
                                                                        @endif
                                                                        <input type="hidden" name="country" value="{{$data['country']}}">
                                                                    </div>
                                                                </div>
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
                            @endif
                            @if (!empty($seller_products))
                            @foreach ($seller_products as $key => $seller_product)
                               @php $shop = \App\Shop::where('user_id', $key)->first(); $seller = $key;  @endphp
                                    <div class="card mb-3">
                                        <div class="card-header bg-white py-3">
                                            <h5 class="heading-6 mb-0">{{ $shop->name }} Products</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="row no-gutters">
                                                <div class="col-md-12">
                                                    <table class="table-cart">
                                                        <thead>
                                                            <tr>
                                                                <td>#</td>
                                                                <td>Image</td>
                                                                <td>Name</td>
                                                                <td>Select Shipping Method</td>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($seller_product as $key_inner=>$id)
                                                            <tr class="cart-item">
                                                                <td>{{$key_inner+1}}</td>
                                                                <td class="product-image" >
                                                                    <a href="{{ route('product', \App\Product::find($id)->slug) }}" target="_blank">
                                                                        <img loading="lazy"  src="{{ asset(\App\Product::find($id)->thumbnail_img) }}">
                                                                    </a>
                                                                </td>
                                                                <td class="product-name strong-600">
                                                                    <a href="{{ route('product', \App\Product::find($id)->slug) }}" target="_blank" class="d-block c-base-2">
                                                                        {{ \App\Product::find($id)->name }}
                                                                    </a>
                                                                </td>
                                                                <td>
                                                                    <div class="form-group">
                                                                        <select name="shipping_type_{{ $key }}" onchange="select_shipment_option(this,{{$seller}},{{$key_inner}},'seller')"  class="form-control">
                                                                            <option  selected>{{ __('Select Shipment Option')}}</option>
                                                                            <option value="home_delivery">{{ __('Home Delivery')}}</option>
                                                                            @if (\App\BusinessSetting::where('type', 'pickup_point')->first()->value == 1)
                                                                                <option value="local_pickup">{{ __('Local Pickup') }}</option>
                                                                            @endif
                                                                            </select>
                                                                    </div>
                                                                    <div>
                                                                        <div id="local_pickup_seller__{{$seller}}__{{$key_inner}}" class="d-none">
                                                                            @if (\App\BusinessSetting::where('type', 'pickup_point')->first()->value == 1)
                                                                                <div class="mt-3 pickup_point_id_seller ">
                                                                                    <select class="pickup-select form-control-lg w-100" name="pickup_point_id_seller" data-placeholder="Select a pickup point">
                                                                                            <option value="">{{__('Select your nearest pickup point')}}</option>
                                                                                        @foreach (\App\PickupPoint::where('pick_up_status',1)->get() as $pick_up_point)
                                                                                            <option value="{{ $pick_up_point->id }}" data-address="{{ $pick_up_point->address }}" data-phone="{{ $pick_up_point->phone }}">
                                                                                                {{ $pick_up_point->name }}
                                                                                            </option>
                                                                                        @endforeach
                                                                                    </select>
                                                                                </div>
                                                                            @endif
                                                                        </div>
                                                                        <div id="home_delivery_seller__{{$seller}}__{{$key_inner}}" class="d-none">
                                                                            @php
                                                                                $product =  \App\Product::find($id);
                                                                                $shipping_companies = json_decode($product->shipping_courier_data);
                                                                                $shipping_type = ShippingType($product,$data);
                                                                                $country_id = App\Country::where('name',str_replace('_',' ',$data['country']))->first()->id;
                                                                                $data['product_id'] = $id;
                                                                            @endphp
                                                                            <div class="form-group">
                                                                                @if($shipping_type == 'courier')
		                                                                            <select name="shipping_type_courier_seller[]" class="form-control"  onchange="getCountryNonPremiumData({{$id}},{{$country_id}},{{$seller}},{{$key_inner}},'seller')">
		                                                                                    <option value="" selected >Select Shipping Courier</option>
		                                                                                    {!! gettingShippingCompanies($shipping_companies,$data, ShippingCost($product,$data)) !!}
		                                                                            </select>
		                                                                             <p id="estimate_seller__{{$seller}}__{{$key_inner}}" class="d-none">Estimated Delivery <span class="text-success" id="estimated_by_seller__{{$seller}}__{{$key_inner}}"> </span>  <span class="text-success" id="estimated_to_seller__{{$seller}}__{{$key_inner}}"> </span></p>
   										 @else
                                                                                       <select name="shipping_type_courier_seller[]"  class="form-control">
                                                                                           <option value="{{$shipping_type}}">{{$shipping_type == 'free'?'Free Shipping':'Flat Rate'}}</option>
                                                                                       </select>
                                                                                @endif
                                                                                <input type="hidden" name="country" value="{{$data['country']}}">
                                                                            </div>
                                                                        </div>
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
                                @endforeach
                            @endif
                            <div class="row align-items-center pt-4">
                                <div class="col-md-6">
                                    <a href="{{ route('home') }}" class="link link--style-3">
                                        <i class="ion-android-arrow-back"></i>
                                        {{__('Return to shop')}}
                                    </a>
                                </div>
                                <div class="col-md-6 text-right">
                                    <button type="submit" class="btn btn-styled btn-base-1">{{__('Continue to Payment')}}</a>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-3 ml-lg-auto">
                             @include('frontend.partials.cart_summary')

                    </div>
                </div>
            </div>
        </section>
    </div>

@endsection

@section('script')
    <script type="text/javascript">

        function select_shipment_option(el,seller,id,type){
            
            if(el.value == 'home_delivery'){
                $('#home_delivery_'+type+'__'+seller+'__'+id).removeClass('d-none');
                $('#local_pickup_'+type+'__'+seller+'__'+id).addClass('d-none');
            }else{
                $('#local_pickup_'+type+'__'+seller+'__'+id).removeClass('d-none');
                $('#home_delivery_'+type+'__'+seller+'__'+id).addClass('d-none');
            }
        }

        function show_pickup_point(el) {
        	var value = $(el).val();
        	var target = $(el).data('target');

            value = value.replace(' ','_');

        	if(value == 'home_delivery'){
                if(!$(target).hasClass('d-none')){
                    $(target).addClass('d-none');
                }
        	}else{
        		$(target).removeClass('d-none');
        	}
        }
        

        function getCountryNonPremiumData(product_id,country_id,seller,id,type){
     
               $.get('{{ route('getNonPremium.change') }}',{_token:'{{ csrf_token() }}', country_id:country_id,product_id:product_id}, function(data){
                                console.log(product_id,country_id,seller,id,type,data);
                          if(data == 'premium'){
                                $('#estimate__'+id).addClass('d-none');
                          }else{
                              console.log('#estimate__'+id);
                        $('#estimate_'+type+'__'+seller+'__'+id).removeClass('d-none');
                         $('#estimated_by_'+type+'__'+seller+'__'+id).html(data.split('##')[0]);
                         $('#estimated_to_'+type+'__'+seller+'__'+id).html(data.split('##')[1]);
                          }
                        });
        }

    </script>
@endsection
