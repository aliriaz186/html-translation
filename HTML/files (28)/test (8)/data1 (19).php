<style>
    .forInline{
        display:flex; flex-direction: row; justify-content: center; align-items: center;
    }
</style>
<div class="modal-header">
    <h5 class="modal-title strong-600 heading-5">{{__('Order id')}}: {{ $order->code }}</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>

@php
    $seller_order_details =  $order->orderDetails->where('seller_id', Auth::user()->id)->first() ;
    $status = $seller_order_details->delivery_status;
    $tracker_number = $seller_order_details->trackingNumber;
    $payment_status = $seller_order_details->payment_status;
    $refund_request_addon = \App\Addon::where('unique_identifier', 'refund_request')->first();

@endphp

<div class="modal-body gry-bg px-3 pt-0">
    <div   class="pt-4 @if($status != 'delivered' || $status != 'cancelled' || $status != 'returned')ml-2 @endif "  >
        <ul class="process-steps clearfix">
            <li @if($status == 'Pending') class="active" @else class="done" @endif>
                <div class="icon">1</div>
                <div class="title">{{__('Order placed')}}</div>
            </li>
        <li @if($status == 'Pending' || $status == 'delivered' || $status == 'cancelled' || $status == 'returned') class="active"  @elseif($status == 'on_delivery' || $status == 'delivered') class="done" @endif >
                <div class="icon">2</div>
                <div class="title">{{__('Pending')}}</div>
            </li>
            <li @if($status == 'delivered' || $status == 'cancelled' || $status == 'returned') class="done" @else class="d-none"  @endif>
                <div class="icon">3</div>
                <div class="title"> {{$status == 'delivered'?'Shipped':ucfirst($status)}}</div>
            </li>
        </ul>
    </div>
    <div class="row mt-5">
        <div class="offset-lg-2 col-lg-4 col-sm-6">
            <div class="form-inline">
                <select class="form-control selectpicker form-control-sm"  data-minimum-results-for-search="Infinity" id="update_payment_status">
                    <option value="unpaid" @if ($payment_status == 'unpaid') selected @endif>{{__('Unpaid')}}</option>
                    <option value="paid" @if ($payment_status == 'paid') selected @endif>{{__('Paid')}}</option>
                </select>
                <label class="my-2" >{{__('Payment Status')}}</label>
            </div>
        </div>
        <div class="col-lg-4 col-sm-6">
            <div class="form-inline">
                <select class="form-control selectpicker form-control-sm"  data-minimum-results-for-search="Infinity" id="update_delivery_status">
                    <option value="Pending" @if ($status == 'Pending') selected @endif>{{__('Pending')}}</option>
                    <option value="on_review" @if ($status == 'on_review') selected @endif>{{__('On review')}}</option>
                    <option value="on_delivery" @if ($status == 'on_delivery') selected @endif>{{__('On delivery')}}</option>
                    <option value="delivered" @if ($status == 'delivered') selected @endif>{{__('Shipped')}}</option>
                    <option value="cancelled" @if ($status == 'cancelled') selected @endif>{{__('Cancelled')}}</option>
                    <option value="returned" @if ($status == 'returned') selected @endif>{{__('Returned')}}</option>
                    <option value="refunded" @if ($status == 'refunded') selected @endif>{{__('Refunded')}}</option>
                </select>
                <label class="my-2" >{{__('Delivery Status')}}</label>
            </div>
        </div>
    </div>
    <br>
    <div class="contaienr">
        <div class="row">
            <div class="col-lg-12">
                <div class="card mt-4">
                    <div class="card-header py-2 px-3 heading-6 strong-600">{{__('Track Your Order')}}</div>
                    <div class="card-body pb-0">
                        <table class="table table-bordered table-sm table-hover table-responsive-md">
                            <thead>
                                <tr>
                                    <th>{{__('Shipped By')}}</th>
                                    <th>{{__('Tracking id')}}</th>
                                    <th>{{__('Track order')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <td>{{ ucfirst(str_replace('_',' ',$seller_order_details->shipping_type))}}</td>
                                <td><input type="number" id="tracker_number" class="form-control" placeholder="Tracking Number" value="{{($tracker_number!='' && $tracker_number !='@')?$tracker_number:''}}"></td>
                                <td>
                                <button  data-toggle="modal" data-target="#shipOrder" class="btn btn-warning w-50 text-white" >Edit</button>
                                <button class="btn btn-primary custom-block" style="width:48%"  id="tracker_submit">Track order</button></td>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card mt-3">
        <div class="card-header py-2 px-3 ">
        <div class="heading-6 strong-600">{{__('Order Summary')}}</div>
        </div>
        <div class="card-body pb-0">
            <div class="row">
                <div class="col-lg-6">
                    <table class="details-table table">
                        <tr>
                            <td class="w-50 strong-600">{{__('Order Code')}}:</td>
                            <td>{{ $order->code }}</td>
                        </tr>
                        <tr>
                            <td class="w-50 strong-600">{{__('Customer')}}:</td>
                            <td>{{ json_decode($order->shipping_address)->name }}</td>
                        </tr>
                        <tr>
                            <td class="w-50 strong-600">{{__('Email')}}:</td>
                            @if ($order->user_id != null)
                                <td>{{ $order->user->permanent_email}}</td>
                            @endif
                        </tr>
                        <tr>
                            <td class="w-50 strong-600">{{__('Shipping address')}}:</td>
                            <td>{{ json_decode($order->shipping_address)->address }}, {{ json_decode($order->shipping_address)->city }}, {{ json_decode($order->shipping_address)->postal_code }}, {{ json_decode($order->shipping_address)->country }}</td>
                        </tr>
                    </table>
                </div>
                <div class="col-lg-6">
                    <table class="details-table table">
                        <tr>
                            <td class="w-50 strong-600">{{__('Order date')}}:</td>
                            <td>{{ date('d-m-Y H:m A', $order->date) }}</td>
                        </tr>
                        <tr>
                            <td class="w-50 strong-600">{{__('Order status')}}:</td>
                            <td>{{ $status }}</td>
                        </tr>
                        <tr>
                            <td class="w-50 strong-600">{{__('Total order amount')}}:</td>
                            <td>{{ single_price($order->orderDetails->where('seller_id', Auth::user()->id)->sum('price') + $order->orderDetails->where('seller_id', Auth::user()->id)->sum('tax')) }}</td>
                        </tr>
                        <tr>
                            <td class="w-50 strong-600">{{__('Contact')}}:</td>
                            <td>{{ json_decode($order->shipping_address)->phone }}</td>
                        </tr>
                        <tr>
                            <td class="w-50 strong-600">{{__('Payment method')}}:</td>
                            <td>{{ ucfirst(str_replace('_', ' ', $order->payment_type)) }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @if($seller_order_details->delivery_status == 'returned' || $seller_order_details->delivery_status == 'Authorised Request' || $seller_order_details->delivery_status  == 'Unauthorised Request' )

    <br>
    <div class="contaienr">
        <div class="row">
            <div class="col-lg-12">
                <div class="card mt-4">
                    <div class="card-header py-2 px-3 heading-6 strong-600">{{__('Returned Order')}}</div>
                    <div class="card-body pb-0">
                        <table class="table table-bordered table-sm table-hover table-responsive-md">
                            <thead>
                                <tr>
                                    <th>{{__('Returned By')}}</th>
                                    <th>{{__('Tracking id')}}</th>
                                    <th>{{__('Track order')}}</th>
                                </tr>
                            </thead>
                                <form action="{{route('return.tracker.number')}}" method="POST">
                                @csrf
                                <tbody>
                                    @php $ReturnRequestTracker = App\ReturnRequestTracker::where('order_detail_id',$order->id)->first(); @endphp
                                    <tr>
                                    <td>
                                     <input type="hidden" name="order_id" class="form-control" value="{{$order->id}}">
                                    <select class="shipping form-control"  name="shipping" {{$ReturnRequestTracker?'disabled':''}}>
                                        @foreach(App\Shipping::whereNull('premium')->get() as $shipping)
                                            <option @if($ReturnRequestTracker){{$ReturnRequestTracker->shipping_id==$shipping->id?'selected':''}} @endif value="{{$shipping->id}}"> {{$shipping->name}} </option>
                                        @endforeach
                                    </select></td>
                                    @if($ReturnRequestTracker)
                                        <td><input name="tracker_number" type="text" class="tracker_number form-control" placeholder="Tracking Number" {{$ReturnRequestTracker?'readonly':''}} value="{{$ReturnRequestTracker->tracker_number}}"></td>
                                        <td class="d-flex"><button type="button" data-toggle="modal" data-target="#track_again" onclick="show_track_modal({{$ReturnRequestTracker->shipping_id}},'{{$ReturnRequestTracker->tracker_number}}',{{$order->id}})" class="btn btn-warning w-50 mr-1">Edit</button>
                                        <button class="btn btn-primary btn-block w-48" >Track order</button></td>
                                    @else
                                        <td><input name="tracker_number" type="text" class="tracker_number form-control" placeholder="Tracking Number" value=""></td>
                                        <td class="d-flex"><button type="submit"  class="btn  btn-warning w-50 mr-1">Set</button>
                                        <button class="btn btn-primary btn-block w-48"  >Track order</button></td>
                                    @endif
                                    </tr>
                                </tbody>
                                </form>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
    <div class="row">
        <div class="col-lg-9">
            <div class="card mt-4">
                <div class="card-header py-2 px-3 heading-6 strong-600">{{__('Order Details')}}</div>
                <div class="card-body pb-0">
                    <table class="details-table table table-sm table-hover table-responsive-md">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th width="40%">{{__('Product')}}</th>
                                <th>{{__('Variation')}}</th>
                                <th>{{__('Quantity')}}</th>
                                <th>{{__('Delivery Type')}}</th>
                                <th>{{__('Price')}}</th>
                                @if ($refund_request_addon != null && $refund_request_addon->activated == 1)
                                    <th>{{__('Refund')}}</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order->orderDetails->where('seller_id', Auth::user()->id) as $key => $orderDetail)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>
                                        @if ($orderDetail->product != null)
                                            <a href="{{ route('product', $orderDetail->product->slug) }}" target="_blank">{{ $orderDetail->product->name }}</a>
                                        @else
                                            <a href="#" target="_blank">{{ $orderDetail->product_permenent->name }}</a>
                                        @endif
                                    </td>
                                    <td>
                                        {{ $orderDetail->variation }}
                                    </td>
                                    <td>
                                        {{ $orderDetail->quantity }}
                                    </td>
                                    <td>
                                        @if ($orderDetail->shipping_type != null && $orderDetail->shipping_type == 'home_delivery')
                                            {{ __('Home Delivery') }}
                                        @elseif ($orderDetail->shipping_type == 'pickup_point')
                                            @if ($orderDetail->pickup_point != null)
                                                {{ $orderDetail->pickup_point->name }} ({{ __('Pickip Point') }})
                                            @endif
                                        @else
                                            {{ $orderDetail->shipping_type }}

                                        @endif
                                    </td>
                                    @php $price =$orderDetail->price;  $tax = 0; if(isset(App\Tax::first()->tax)){$tax=App\Tax::first()->tax; $price =($orderDetail->price *  (100 - $tax))/100; };  ;@endphp
                                    <td>{{ $price }}</td>
                                    @if ($refund_request_addon != null && $refund_request_addon->activated == 1)
                                        <td>
                                            @if ($orderDetail->product != null && $orderDetail->product->refundable != 0 && $orderDetail->refund_request == null)
                                                <button type="submit" class="btn btn-styled btn-sm btn-base-1" onclick="send_refund_request('{{ $orderDetail->id }}')">{{ __('Send') }}</button>
                                            @elseif ($orderDetail->refund_request != null && $orderDetail->refund_request->refund_status == 0)
                                                <span class="strong-600">{{ __('Pending') }}</span>
                                            @elseif ($orderDetail->refund_request != null && $orderDetail->refund_request->refund_status == 1)
                                                <span class="strong-600">{{ __('Paid') }}</span>
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
        $subtotal = $order->orderDetails->where('seller_id', Auth::user()->id)->sum('price');
        $shipping_cost = $order->orderDetails->where('seller_id', Auth::user()->id)->sum('shipping_cost');
        $tax = 0;

        if(isset(App\Tax::first()->tax)){
            $tax=App\Tax::first()->tax;
            $subtotal = ($order->orderDetails->where('seller_id', Auth::user()->id)->sum('price')  *  (100 - $tax))/100 ;
            $shipping_cost =($order->orderDetails->where('seller_id', Auth::user()->id)->sum('shipping_cost') *  (100 - $tax))/100 ;
            $tax = ($order->orderDetails->where('seller_id', Auth::user()->id)->sum('price') +$order->orderDetails->where('seller_id', Auth::user()->id)->sum('shipping_cost'))/$tax;
        }
        @endphp
        <div class="col-lg-3">
            <div class="card mt-4">
                <div class="card-header py-2 px-3 heading-6 strong-600">{{__('Order Ammount')}}</div>
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
                                <th><span class="strong-600">{{__('Total')}}</span></th>
                                <td class="text-right">
                                    <strong>
                                        <span>{{ single_price($order->orderDetails->where('seller_id', Auth::user()->id)->sum('price') + $order->orderDetails->where('seller_id', Auth::user()->id)->sum('shipping_cost')) }}
                                        </span>
                                    </strong>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

 if($('#update_delivery_status').val() == 'delivered'){
    $('#tracker_number').css('display','block');

};

    $('#update_delivery_status').on('change', function(){

        var order_id = {{ $order->id }};
        var status = $('#update_delivery_status').val();
        if(status == 'delivered'){
            $('#tracker_number').toggle();
            $.post('{{ route('orders.update_delivery_status') }}', {_token:'{{ @csrf_token() }}',order_id:order_id,status:status}, function(data){
                $('#order_details').modal('hide');
                showFrontendAlert('success', 'Order status has been updated');
                location.reload().setTimeOut(500);
            });

        }else{
            $('#tracker_number').css('display','none');
            $.post('{{ route('orders.update_delivery_status') }}', {_token:'{{ @csrf_token() }}',order_id:order_id,status:status}, function(data){
                $('#order_details').modal('hide');
                showFrontendAlert('success', 'Order status has been updated');
                location.reload().setTimeOut(500);
            });
        }
    });

    $('#update_payment_status').on('change', function(){
        var order_id = {{ $order->id }};
        var status = $('#update_payment_status').val();
        $.post('{{ route('orders.update_payment_status') }}', {_token:'{{ @csrf_token() }}',order_id:order_id,status:status}, function(data){
            $('#order_details').modal('hide');
            showFrontendAlert('success', 'Payment status has been updated');
            location.reload().setTimeOut(500);
        });
    });

    $('#tracker_submit').click(function(){
        var order_id = {{ $order->id }};
        var status = $('#update_delivery_status').val();
        var tracker_number = $('#tracker_number').val();
        $.post('{{ route('orders.update_delivery_status') }}', {_token:'{{ @csrf_token() }}',order_id:order_id,status:status,trackNumber:tracker_number}, function(data){
            $('#order_details').modal('hide');
            showFrontendAlert('success', 'Order status has been updated');
            location.reload().setTimeOut(500);
        });
    });

   $.post('{{ route('update-notification-returnRequest') }}', {_token:'{{ @csrf_token() }}',order_id:{{$seller_order_details->id}}}, function(data){
  	console.log(data);

  });

</script>
