<div class="card sticky-top">
    <div class="card-title py-3">
        <div class="row align-items-center">
            <div class="col-6">
                <h3 class="heading heading-3 strong-400 mb-0">
                    <span>{{__('Summary')}}</span>
                </h3>
            </div>

            <div class="col-6 text-right">
                <span class="badge badge-md badge-success">{{ count(Session::get('cart')) }} {{__('Items')}}</span>
            </div>
        </div>
    </div>

    <div class="card-body">
        @if (\App\Addon::where('unique_identifier', 'club_point')->first() != null && \App\Addon::where('unique_identifier', 'club_point')->first()->activated)
            @php
                $total_point = 0;
            @endphp
            @foreach (Session::get('cart') as $key => $cartItem)
                @php
                    $product = getProductOrWholesale($cartItem['id']);
                    $total_point += $product->earn_point*$cartItem['quantity'];
                @endphp
            @endforeach
            <div class="club-point mb-3 bg-soft-base-1 border-light-base-1 border">
                {{ __("Total Club point") }}:
                <span class="strong-700 float-right">{{ $total_point }}</span>
            </div>
        @endif
        <table class="table-cart table-cart-review">
            <thead>
                <tr>
                    <th class="product-name">{{__('Product')}}</th>
                    <th class="product-total text-right">{{__('Total')}}</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $shipping = 0;
                    $temp_subtotal = 0;
                    $subtotal = 0;
                    $temp_shipping = 0;
                    $temp_total = 0;
                    $discount_total = 0;
                    $tax = App\Tax::first()?App\Tax::first()->tax:0;
                    $tax_get = 0;
                    $cz = 0;
                @endphp
                @foreach (Session::get('cart') as $key => $cartItem)
                    @php
                    $product = \App\Product::find($cartItem['id']);
                    if($product->wholesale ){
                        foreach(json_decode($product->min) as $key=>$min){
                                $max = json_decode($product->max)[$key];
                                $disc = (int)json_decode($product->wholesale_discount)[$key];
                                $quantity = (int)$cartItem['quantity'];
                                if(($min <= $quantity) && ($quantity <= $max)){
                                    $price = (($cartItem['price']* $cartItem['quantity'] * (100 - $disc)/100) * (100 - $tax)/100 );
                                    $discount_total+= ((int)($cartItem['price'] * $cartItem['quantity'] )/ 100) * $disc;
                                    $subtotal+= $cartItem['price']*$cartItem['quantity'];
                                    $temp_subtotal+= $cartItem['price']*$cartItem['quantity']* (100 - $tax)/100;
                                    $temp_subtotal =($temp_subtotal *  (100 - $disc))/100  ;
                                    $tax_get+= ($cartItem['price'] * $cartItem['quantity']) - $price;
                                }
                        }
                    }else{
                        $subtotal = $subtotal+= $cartItem['price']*$cartItem['quantity'];
                        $price = ( ($cartItem['price'] *  (100 - $tax))/100 * $cartItem['quantity']) ;
                        $temp_subtotal+= ($cartItem['price']*$cartItem['quantity'] *  (100 - $tax))/100;
                        $tax_get+= ($cartItem['price'] * $cartItem['quantity']) - $price;
                    }

                    $product_name_with_choice = $product->name;
                    if ($cartItem['variant'] != null) {
                        $product_name_with_choice = $product->name.' - '.$cartItem['variant'];
                    }

                    if  (\Route::current()->getName() == 'checkout.store_delivery_info')
                    {
                        $setCountry = Session::get('country_set');
                        $data = ['country'=>$setCountry];
                        $shipping_type =$cartItem['shipping_type'];

                        if($cartItem['shipping_type'] == 'free'){
                            $shipping +=0;
                        }else if($cartItem['shipping_type']== 'flat_rate'){
                            $shipping += $cartItem['shipping']*$cartItem['quantity'];
                        }else{
                          $shipping+= $cartItem['shipping'];
                        }
                    }
                    @endphp
                    <tr class="cart_item">
                        <td class="product-name">
                             {{ Illuminate\Support\Str::limit($product_name_with_choice, 30, ' (...)')  }}
                            <strong class="product-quantity">× {{ $cartItem['quantity'] }}</strong>
                        </td>
                        <td class="product-total text-right">
                            <span class="pl-4">{{ single_price(number_format($price,3)) }}</span>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        @if (\Route::current()->getName() == 'checkout.store_delivery_info')

            <table class="table-cart table-cart-review my-4">
                <thead>
                    <tr>
                        <th class="product-name">{{__('Product Shipping charge')}}</th>
                        <th class="product-total text-right">{{__('Amount')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach (Session::get('cart') as $key => $cartItem)
                       @php $cartItem_shipping = ($cartItem['shipping'] *  (100 - $tax))/100;   $temp_shipping+= ($cartItem_shipping*$cartItem['quantity']); $tax_get+= $cartItem['shipping'] - $cartItem_shipping;@endphp
                        <tr class="cart_item">
                            <td class="product-name">
                               {{ ucfirst(str_replace('_',' ',$cartItem['shipping_type']))}}
                                <strong class="product-quantity">× {{ $cartItem['quantity'] }}</strong>
                            </td>
                            <td class="product-total text-right">
                                <span class="pl-4">{{ single_price(number_format($cartItem_shipping*$cartItem['quantity'],3)) }}</span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        @endif

	@php
	$loyalty=0;$coupon=0;$cashback=0;
	if(Session::has('loyality_discount')){$loyalty=Session::get('loyality_discount');}
	if(Session::has('coupon_discount')){$coupon=Session::get('coupon_discount');}
	if(Session::has('cashback_discount')){$cashback=Session::get('cashback_discount');}
    $tax_get-=$discount_total;
    $total_main = $subtotal + $temp_shipping - $loyalty - $coupon - $cashback  - $discount_total;
    $total = $temp_subtotal + $temp_shipping + $tax_get - $loyalty - $coupon - $cashback  - $discount_total;
    @endphp

    <script>
        console.log("Total=>"+{{$total}},"Subtotal=>"+{{$temp_subtotal}} ,"Total=>"+{{$total_main}},"Subtotal=>"+{{$subtotal}}  ,"Shipping=>"+{{$temp_shipping}},"Tax=>"+{{$tax_get}},"Loyality=>"+{{$loyalty}},"Coupon=>"+{{$coupon}},"Cashback=>"+{{$cashback}},"Discount=>"+{{$discount_total}});
    </script>

        <table class="table-cart table-cart-review">

            <tfoot>
                <tr class="cart-subtotal">
                    <th>{{__('Subtotal')}}</th>
                    <td class="text-right">
                        <span class="strong-600">{{ single_price(number_format($temp_subtotal,3) ) }}</span>
                    </td>
                </tr>


                @isset(App\Tax::first()->tax)
                    <tr class="cart-shipping">
                        <th>{{__('Tax')}} @ {{$tax}}%</th>
                        <td class="text-right">
                            <span class="strong-600">{{single_price(number_format($tax_get,3))}}</span>
                        </td>
                    </tr>
                @endif

                @if (\Route::current()->getName() == 'checkout.store_delivery_info')
                    <tr class="cart-shipping">
                        <th>{{__('Total Shipping')}}</th>
                        <td class="text-right">
                            <span class="text-italic">{{ single_price(number_format($temp_shipping,3)) }}</span>
                        </td>
                    </tr>
                @endif

                @if(isset($cartItem['id']))
                    @foreach (App\Raffle::all() as $rfl)
                        @if($rfl->status == 1)
                        @foreach (json_decode($rfl->product_to_show) as $id)
                                @if((int)$id == $cartItem['id'])
                                    @foreach (Session::get('cart') as $key => $cartItem)
                                        @if(isset( $cartItem['raffle_ticket'] ))
                                        <tr class="cart-shipping">
                                            <th>{{__('Raffle Ticket')}}</th>
                                            <td class="text-right">
                                                @php $item = $cartItem['raffle_ticket']; @endphp
                                                <span class="text-italic"> {{$item}}</span>
                                            </td>
                                        </tr>
                                        @endif
                                    @endforeach
                                @endif
                            @endforeach
                        @endif
                    @endforeach
                @endif

                @if (Session::has('coupon_discount'))
                    <tr class="cart-shipping">
                        <th>{{__('Coupon Discount')}}</th>
                        <td class="text-right">
                            <span class="text-italic">{{ single_price(Session::get('coupon_discount')) }}</span>
                        </td>
                    </tr>
                @endif

                @if (Session::has('loyality_discount'))
                <tr class="cart-shipping">
                    <th>{{__('Loyality Discount')}}</th>
                    <td class="text-right">
                        <span class="text-italic">{{ single_price(Session::get('loyality_discount')) }}</span>
                    </td>
                </tr>
            @endif
              @if (Session::has('cashback_discount'))
                <tr class="cart-shipping">
                    <th>{{__('Cashaback Discount')}}</th>
                    <td class="text-right">
                        <span class="text-italic">{{ single_price(Session::get('cashback_discount')) }}</span>
                    </td>
                </tr>
            @endif

                @php
                    if(Session::has('coupon_discount')){
                        $total -= Session::get('coupon_discount');
                    }
                    if(Session::has('loyality_discount')){
                        $total -= Session::get('loyality_discount');
                    }
                @endphp

                <tr class="cart-total">
                    <th><span class="strong-600">{{__('Total')}}</span></th>
                    <td class="text-right">
                        <strong><span id="total_amount">{{ single_price(number_format($total_main,3)) }}</span></strong>
                    </td>
                </tr>


                @if($discount_total != 0)
                <tr class="cart-total">
                    <th><span class="strong-600">{{__('Wholesale Savings')}}</span></th>
                    <td class="text-right">
                        <strong><span>{{ single_price(number_format($discount_total,3)) }}</span></strong>
                    </td>
                </tr>
                @endif

            </tfoot>
        </table>

        @if (Auth::check() && \App\BusinessSetting::where('type', 'coupon_system')->first()->value == 1)
            @if (Session::has('coupon_discount') )
                <div class="mt-3">
                    <form class="form-inline" action="{{ route('checkout.remove_coupon_code') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group flex-grow-1">
                            @if(Session::has('coupon_gifts'))
                            <div class="form-control bg-gray w-100">{{ \App\CouponGifts::find(Session::get('coupon_id'))->code }}</div>
                            @else
                            <div class="form-control bg-gray w-100">{{ \App\Coupon::find(Session::get('coupon_id'))->code }}</div>
                            @endif
                        </div>
                        <button type="submit" class="btn btn-base-1">{{__('Change Coupon')}}</button>
                    </form>
                </div>
            @else
                <div class="mt-3">
                    <form class="form-inline" action="{{ route('checkout.apply_coupon_code') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group flex-grow-1">
                            <input type="text" class="form-control w-100" name="code" placeholder="{{__('Have coupon code? Enter here')}}" required>
                        </div>
                        <button type="submit" class="btn btn-base-1">{{__('Apply')}}</button>
                    </form>
                </div>
            @endif

            @if (Session::has('loyality_discount') )
                <div class="mt-3">
                    <form class="form-inline" action="{{ route('checkout.remove_loyility_code') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group flex-grow-1">
                        <div class="form-control bg-gray w-100">{{ \App\myLoyality::find(Session::get('loyality_id'))->code }}</div>
                        </div>
                        <button type="submit" class="btn btn-base-1">{{__('Remove Loyality')}}</button>
                    </form>
                </div>
            @else
                <div class="mt-3">
                    <form class="form-inline" action="{{ route('checkout.apply_loyility_code') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group flex-grow-1">
                            <input type="text" class="form-control w-100" name="code" placeholder="{{__('Have Loyalty Code? Enter here')}}" required>
                        </div>
                        <button type="submit" class="btn btn-base-1">{{__('Apply')}}</button>
                    </form>
                </div>
            @endif
            @if (Session::has('cashback_discount') )
            <div class="mt-3">
                <form class="form-inline" action="{{ route('checkout.remove_cashback_code') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group flex-grow-1">
                    <div class="form-control bg-gray w-100">{{ \App\MyCustomerCashback::find(Session::get('cashback_id'))->code }}</div>
                    </div>
                    <button type="submit" class="btn btn-base-1">{{__('Remove Cashback')}}</button>
                </form>
            </div>
            @else
            <div class="mt-3">
                <form class="form-inline" action="{{ route('checkout.apply_cashback_code') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group flex-grow-1">
                        <input type="text" class="form-control w-100" name="code" placeholder="{{__('Have Cashback Code? Enter here')}}" required>
                    </div>
                    <button type="submit" class="btn btn-base-1">{{__('Apply')}}</button>
                </form>
            </div>
            @endif
        @endif
    </div>
</div>
