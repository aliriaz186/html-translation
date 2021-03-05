<div class="modal-header">
    <h5 class="modal-title strong-600 heading-5">{{__('Order id')}}: {{ $order->code }}</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<ul class="nav nav-tabs mt-3" id="myTab" role="tablist">
    @foreach (App\OrderDetail::where('order_id',$order->id)->orderBy('created_at', 'desc')->groupBy('seller_id')->get() as $order_detail_key => $orderDetails)
       <li class="nav-item"> <a class="nav-link @if($order_detail_key==0)active @endif" id="{{$orderDetails->id}}-tab" data-toggle="tab" href="#{{$orderDetails->id}}" role="tab" aria-controls="{{$orderDetails->id}}" aria-selected="true">{{$orderDetails->seller->user->shop->name}}</a></li>
    @endforeach
</ul>
  <div class="tab-content" id="myTabContent">
    @foreach (App\OrderDetail::where('order_id',$order->id)->orderBy('created_at', 'desc')->groupBy('seller_id')->get() as $order_detail_key => $orderDetails)
        @php $status = $orderDetails->delivery_status;    $tracker_number = $orderDetails->trackingNumber; $refund_request_addon = \App\Addon::where('unique_identifier', 'refund_request')->first();@endphp
        <div class="tab-pane fade @if($order_detail_key==0)show active @endif" id="{{$orderDetails->id}}" role="tabpanel" aria-labelledby="{{$orderDetails->id}}-tab">
            <div class="modal-body gry-bg px-3 pt-0">
                <div class="pt-4"  @if($status == 'delivered' || $status == 'cancelled' || $status == 'returned') @else style="margin-left:16%;" @endif>
                    <ul class="process-steps clearfix">
                        <li @if($status == 'pending') class="active" @else class="done" @endif>
                            <div class="icon">1</div>
                            <div class="title">{{__('Order placed')}}</div>
                        </li>
                        <li @if($status == 'pending' || $status == 'delivered' || $status == 'cancelled' || $status == 'returned') class="active" @elseif($status == 'on_delivery' || $status == 'delivered') class="done" @endif>
                            <div class="icon">2</div>
                            <div class="title">{{__('Pending')}}</div>
                        </li>
                        @if($status == 'delivered' || $status == 'cancelled' || $status == 'returned')
                        <li  class="done">
                            <div class="icon">3</div>
                            <div class="title"> {{$status == 'delivered'?'Shipped':ucfirst($status)}}</div>
                        </li>
                        @endif
                    </ul>
                </div>
                <div class="contaienr">
                <ul class="nav nav-tabs mt-3" id="products{{$order_detail_key }}" role="tablist">
		    @foreach (App\OrderDetail::where('order_id',$order->id)->orderBy('created_at', 'desc')->where('seller_id',$orderDetails->seller->user->id) ->get() as $key=> $orderDetailsInner)
		       <li class="nav-item"> <a class="nav-link @if($key==0)active @endif" id="{{$orderDetailsInner->product->id}}-tab" data-toggle="tab" href="#{{$orderDetailsInner->product->id}}" role="tab" aria-controls="{{$orderDetailsInner->product->id}}" aria-selected="true">{{Illuminate\Support\Str::limit($orderDetailsInner->product->name,30,'...')}}</a></li>
		    @endforeach
		</ul>
                    <div class="row">
                        <div class="col-lg-12">
                         <div class="tab-content" id="myTabContent">
                         @foreach (App\OrderDetail::where('order_id',$order->id)->orderBy('created_at', 'desc')->where('seller_id',$orderDetails->seller->user->id)->get() as $key => $orderDetailsInner)
                           <div class="tab-pane fade @if($key==0)show active @endif" id="{{$orderDetailsInner->product->id}}" role="tabpanel" aria-labelledby="{{$orderDetailsInner->product->id}}-tab">
                            <div class="card mt-4">
                                <div class="card-header py-2 px-3 heading-6 strong-600">{{__('Track Your Order')}}</div>
                                <div class="card-body pb-0">
                                    <table class="table table-bordered table-sm table-hover table-responsive-md">
                                        <thead>
                                            <tr>
                                                <th width="10%">{{__('Product')}}</th>
                                                <th>{{__('Shipped By')}}</th>
                                                <th>{{__('Tracking id')}}</th>
                                                <th>{{__('Track order')}}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                          <tr>
                                          <td>  <a href="{{ route('product', $orderDetailsInner->product->slug) }}" class="d-block product-image h-100">
                                               <img class="img-fit lazyload mx-auto" src="{{ asset('frontend/images/placeholder.jpg') }}" data-src="{{ asset($orderDetailsInner->product->thumbnail_img) }}" alt="{{ __($orderDetailsInner->product->name) }}">
                                           </a>
                                     		</td>
                                            <td>{{ ucfirst(str_replace('_',' ',$orderDetailsInner->shipping_type))}}</td>
                                            <td><input type="number" readonly="true" id="tracker_number" class="form-control" placeholder="Tracking Number" value="{{($tracker_number!='' && $tracker_number !='@')?$tracker_number:''}}"></td>
                                            <td>
                                            <button class="btn btn-primary custom-block" style="width:48%"  id="tracker_submit">Track order</button></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                           </div>
                            @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mt-4">
                <div class="card-header py-2 px-3 heading-6 strong-600 clearfix">
                    <div class="float-left">{{__('Order Summary')}}</div>
                </div>
                <div class="card-body pb-0">
                        <div class="card-body pb-0 pt-0">
                            <div class="row">
                                <div class="col-lg-5">
                                    <table class="details-table table">
                                        <tr>
                                            <td class="w-50 strong-600 text-left font-weight-bold heading-6" >{{__('Order Details')}}:</td>
                                        </tr>

                                        <tr>
                                            <td class="w-50 strong-600">{{__('Order Code')}}:</td>
                                            <td>{{ $order->code }}</td>
                                        </tr>
                                        <tr>
                                            <td class="w-50 strong-600">{{__('Order Date')}}:</td>
                                            <td>{{ date('d-m-Y H:m A', $order->date) }}</td>
                                        </tr>
                                        <tr>
                                            <td class="w-50 strong-600">{{__('Order Status')}}:</td>
                                            @php if($status=='delivered'){ $status='shipped';} @endphp
                                            <td>{{ ucfirst(str_replace('_', ' ', $status)) }}</td>
                                        </tr>
                                        <tr>
                                            <td class="w-50 strong-600">{{__('Payment method')}}:</td>
                                            <td>{{ ucfirst(str_replace('_', ' ', $order->payment_type)) }}</td>
                                        </tr>
                                        <tr>
                                            <td class="w-50 strong-600">{{__('Shipping method')}}:</td>
                                            @if($orderDetails->shipping_type == 'flat_rate')
                                                <td>{{__('Flat shipping rate')}}</td>
                                            @elseif($orderDetails->shipping_type == 'free')
                                                <td>{{__('Free shipping ')}}</td>
                                            @else
                                                <td>{{ucfirst($orderDetails->shipping_type)}}</td>
                                            @endif
                                        </tr>
                                       <tr>
                                            <td class="w-50 strong-600">{{__('Total order amount')}}:</td>
                                            <td>{{ single_price($orderDetails->price + $orderDetails->tax + $orderDetails->shipping_cost) }}</td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-lg-4">
                                    <table class="details-table table">
                                    <tr>
                                            <td class="w-50 strong-600 text-left font-weight-bold heading-6" >{{__('Customer Details')}}:</td>
                                        </tr>
                                        <tr>
                                            <td>{{ json_decode($order->shipping_address)->name }}</td>
                                        </tr>
                                        <tr><td>{{ json_decode($order->shipping_address)->address }}</td></tr>
                                    @if(isset(json_decode($order->shipping_address)->address2))
                                        <tr><td>{{ json_decode($order->shipping_address)->address2 }}</td></tr> @endif
                                        <tr><td> {{ json_decode($order->shipping_address)->city }} </td></tr>
                                        <tr><td>{{ json_decode($order->shipping_address)->postal_code }}</td></tr>
                                        <tr><td> {{ str_replace('_',' ',json_decode($order->shipping_address)->country) }}</td></tr>
                                        <tr><td>{{ json_decode($order->shipping_address)->phone }}</td> </tr>
                                    </table>
                                </div>
                                <div class="col-lg-3">
                                    <table class="details-table table">
                                        <tr>
                                            <td class="w-50 strong-600 text-left font-weight-bold heading-6" colspan="2">{{__('Sold By')}}:</td>
                                        </tr>

                                        <tr>
                                            <td>{{ $orderDetails->seller->user->username}}</td>
                                        </tr>
                                        <tr>
                                            <td>{{ $orderDetails->seller->user->shop->name}}</td>
                                        </tr>
                                        <tr>
                                        <td>{{ $orderDetails->seller->user->shop->address}}</td>
                                        </tr>
                                        @if($orderDetails->seller->user->shop->phone)
                                        <tr>
                                            <td>{{ $orderDetails->seller->user->shop->phone}}</td>
                                        </tr>
                                        @endif
                                        <tr>
                                            <td>VAT ID: {{ $orderDetails->seller->user->shop->tax_id?$orderDetails->seller->user->shop->tax_id:'N/A'}}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    @endforeach
  </div>
  <div class="row">
        <div class="col-lg-9">
            <div class="card mt-4">
                <div class="card-header py-2 px-3 heading-6 strong-600">{{__('Order Details')}}</div>
                <div class="card-body pb-0">
                    <table class="details-table table">
                        <thead>
                            <tr>
                             <th>#</th>
                                <th>{{__('Image')}}</td>
                                <th width="30%">{{__('Product')}}</th>
                                <th>{{__('Variation')}}</th>
                                <th>{{__('Qty')}}</th>
                                <th>{{__('Shipping Method')}}</th>
                                <th>{{__('Loyalty Points')}}</th>
                                <th>{{__('Price')}}</th>
                                @if ($refund_request_addon != null && $refund_request_addon->activated == 1)
                                    <th>{{__('Refund')}}</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order->orderDetails as $key => $orderDetail)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>  <a href="{{ route('product', $orderDetail->product->slug) }}" class="d-block product-image h-100">
                                               <img class="img-fit lazyload mx-auto" src="{{ asset('frontend/images/placeholder.jpg') }}" data-src="{{ asset($orderDetail->product->thumbnail_img) }}" alt="{{ __($orderDetail->first()->product->name) }}">
                                           </a>
                                     </td>
                                    <td>
                                        @if ($orderDetail->product != null)
                                            <a href="{{ route('product', $orderDetail->product->slug) }}" target="_blank">{{ $orderDetail->product->name }}</a>
                                        @else
                                        <a href="#" target="_blank">{{App\PermenentProduct::where('product_id',$orderDetail->product_id)->first()->name}}</a>
                                        @endif
                                    </td>
                                    <td>
                                        {{  ($orderDetail->variation=='')?'N/A':$orderDetail->variation }}
                                    </td>
                                    <td>
                                        {{ $orderDetail->quantity }}
                                    </td>
                                    <td>
                                        @if ($orderDetail->shipping_type!='pickup_point')
                                            {{ucfirst(str_replace('_',' ',$orderDetail->shipping_type))}}
                                        @elseif ($orderDetail->shipping_type == 'pickup_point')
                                            @if ($orderDetail->pickup_point != null)
                                                {{ $orderDetail->pickup_point->name }} ({{ __('Pickip Point') }})
                                            @endif
                                        @endif
                                    </td>
                                      <td class="text-center">
                                       @isset($order->loyality->point_earned){{ $order->loyality->point_earned}} @else N/A @endisset
                                    </td>
                                    @php $price =$orderDetail->price;  $tax = 0; if(isset(App\Tax::first()->tax)){$tax=App\Tax::first()->tax; $price =($orderDetail->price *  (100 - $tax))/100; };  ;@endphp
                                    <td>{{ single_price($price) }}</td>
                                    @if ($refund_request_addon != null && $refund_request_addon->activated == 1)
                                        @php
                                            $no_of_max_day = \App\BusinessSetting::where('type', 'refund_request_time')->first()->value;
                                            $last_refund_date = $orderDetail->created_at->addDays($no_of_max_day);
                                            $today_date = Carbon\Carbon::now();
                                        @endphp
                                        <td>
                                            @if ($orderDetail->product != null && $orderDetail->product->refundable != 0 && $orderDetail->refund_request == null && $today_date <= $last_refund_date && $orderDetail->delivery_status == 'delivered')
                                                <a href="{{route('refund_request_send_page', $orderDetail->id)}}" class="btn btn-styled btn-sm btn-base-1">{{ __('Send') }}</a>
                                            @elseif ($orderDetail->refund_request != null && $orderDetail->refund_request->refund_status == 0)
                                                <span class="strong-600">{{ __('Pending') }}</span>
                                            @elseif ($orderDetail->refund_request != null && $orderDetail->refund_request->refund_status == 1)
                                                <span class="strong-600">{{ __('Approved') }}</span>
                                            @elseif ($orderDetail->product->refundable != 0)
                                                <span class="strong-600">{{ __('N/A') }}</span>
                                            @else
                                                <span class="strong-600">{{ __('Non-refundable') }}</span>
                                            @endif
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @php
        $subtotal = $order->orderDetails->sum('price');
        $shipping_cost = $order->orderDetails->sum('shipping_cost');
        $tax = $order->orderDetails->sum('price');

        if(isset(App\Tax::first()->tax)){
            $tax=App\Tax::first()->tax;
            $subtotal = ($order->orderDetails->sum('price')  *  (100 - $tax))/100 ;
            $shipping_cost =($order->orderDetails->sum('shipping_cost') *  (100 - $tax))/100 ;
            $tax =  ($order->orderDetails->sum('price') + $order->orderDetails->sum('shipping_cost'))/$tax;
        }
        @endphp
        <div class="col-lg-3">
            <div class="card mt-4">
                <div class="card-header py-2 px-3 heading-6 strong-600">{{__('Order Amount')}}</div>
                <div class="card-body pb-0">
                    <table class="table details-table">
                        <tbody>
                            <tr>
                                <th>{{__('Subtotal')}}</th>
                                <td class="text-right">
                                    <span class="strong-600">{{ single_price($subtotal) }}</span>
                                </td>
                            </tr>
                            <tr>
                                <th>{{__('Shipping')}}</th>
                                <td class="text-right">
                                    <span class="text-italic">{{ single_price($shipping_cost) }}</span>
                                </td>
                            </tr>
                            <tr>
                                <th>{{__('Tax')}}</th>
                                <td class="text-right">
                                    <span class="text-italic">{{ single_price($tax) }}</span>
                                </td>
                            </tr>
                            <tr>
                                <th>{{__('Coupon Discount')}}</th>
                                <td class="text-right">
                                    <span class="text-italic">{{ single_price($order->coupon_discount) }}</span>
                                </td>
                            </tr>
                            <tr>
                                <th><span class="strong-600">{{__('Total')}}</span></th>
                                <td class="text-right">
                                    <strong><span>{{ single_price($order->grand_total) }}</span></strong>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            @if ($order->manual_payment && $order->manual_payment_data == null)
                <button onclick="show_make_payment_modal({{ $order->id }})" class="btn btn-block btn-base-1">{{__('Make Payment')}}</button>
            @endif
        </div>
  </div>
<script type="text/javascript">
    function show_make_payment_modal(order_id){
        $.post('{{ route('checkout.make_payment') }}', {_token:'{{ csrf_token() }}', order_id : order_id}, function(data){
            $('#payment_modal_body').html(data);
            $('#payment_modal').modal('show');
            $('input[name=order_id]').val(order_id);
        });
    }
</script>
