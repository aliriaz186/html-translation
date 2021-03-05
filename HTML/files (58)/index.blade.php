@extends('layouts.app')

@section('content')
@php
    $refund_request_addon = \App\Addon::where('unique_identifier', 'refund_request')->first();
@endphp
<!-- Basic Data Tables -->
<!--===================================================-->
<div class="panel">
    <div class="panel-heading bord-btm clearfix pad-all h-100">
        <h3 class="panel-title pull-left pad-no">{{__('Orders')}}</h3>
        <div class="pull-right clearfix">
            <form class="" id="sort_orders" action="" method="GET">
                <div class="box-inline pad-rgt pull-left">

                <div class="box-inline pad-rgt pull-left">
                    <div class="" style="min-width: 200px;">
                        <input type="text" class="form-control" id="search" name="search"@isset($sort_search) value="{{ $sort_search }}" @endisset placeholder="Type & Enter">
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="panel-body">
        <table class="table table-striped res-table mar-no" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>#</th>
                    <th>{{__('Order Code')}}</th>
                    <th>{{__('Customer')}}</th>
                    <th>{{__('Amount')}}</th>
                    <th>{{__('Delivery Status')}}</th>
                    <th>{{__('Payment Method')}}</th>
                    <th>{{__('Payment Status')}}</th>
                    @if ($refund_request_addon != null && $refund_request_addon->activated == 1)
                        <th>{{__('Refund')}}</th>
                    @endif
                    <th width="10%">{{__('Options')}}</th>
                </tr>
            </thead>
            <tbody>

                @for($j=0;$j<count($orders);$j++)
                    @for($i=0;$i<$totalLoop1;$i++)

                        @php
                        if(($i)>($totalLoop[$j]-1)){  break;}

                        if($orders[$j][$i])
                        {$order = \App\Order::find($orders[$j][$i]->id);
                        }else{
                            $order=null;
                        }
                        @endphp

                        @if($order != null)
                            <tr>
                                <td>
                                </td>
                                <td>
                                    {{ $order->code }} @if($order->viewed == 0) <span class="pull-right badge badge-info">{{ __('New') }}</span> @endif
                                </td>
                                <td>
                                    @if ($order->user_id != null)
                                        {{ $order->user->name }}
                                    @else
                                        Guest ({{ $order->guest_id }})
                                    @endif
                                </td>
                                <td>
                                    {{ single_price($order->orderDetails->where('seller_id',  $seller_ids[$j])->where('order_id',$order->id)->first()->sum('price') + $order->orderDetails->where('seller_id',  $seller_ids[$j])->where('order_id',$order->id)->first()->sum('tax')) }}
                                </td>
                                <td>

                                    @php
                                        $status = $order->orderDetails->first()->delivery_status;
                                        if($status=='delivered'){$status='shipped';}
                                    @endphp
                                    {{ ucfirst(str_replace('_', ' ', $status)) }}
                                </td>
                                <td>
                                    {{ ucfirst(str_replace('_', ' ', $order->payment_type)) }}
                                </td>
                                <td>
                                    <span class="badge badge--2 mr-4">
                                    @if ($order->orderDetails->where('seller_id',  $seller_ids[$j])->where('order_id',$order->id)->first()->payment_status == 'paid')
                                         <i class="bg-green"></i> Paid
                                        @else
                                            <i class="bg-red"></i> Unpaid
                                        @endif
                                    </span>
                                </td>
                                @if ($refund_request_addon != null && $refund_request_addon->activated == 1)
                                    <td>
                                        @if (count($order->refund_requests) > 0)
                                            {{ count($order->refund_requests) }} Refund
                                        @else
                                            No Refund
                                        @endif
                                    </td>
                                @endif
                                <td>

                                    <div class="btn-group dropdown">
                                        <button class="btn btn-primary dropdown-toggle dropdown-toggle-icon" data-toggle="dropdown" type="button">
                                            {{__('Actions')}} <i class="dropdown-caret"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-right">
                                          @if(permission_check_all('orders') || permission_check_put('orders') || permission_check_post('orders') )
                                            <li><a href="{{ route('orders.show', encrypt($order->id)) }}">{{__('Pay')}}</a></li>
                                          @endif
                                          @if(permission_check_all('orders') || permission_check_get('orders') || permission_check_post('orders') || permission_check_put('orders') ||  permission_check_delete('orders') )
                                            <li><a href="{{ route('orders.show', encrypt($order->id)) }}">{{__('View')}}</a></li>
                                            <li><a href="{{ route('seller.invoice.download', $order->id) }}">{{__('Download Invoice')}}</a></li>
                                          @endif
                                          @if(permission_check_all('orders') || permission_check_delete('orders'))
                                               <li><a onclick="confirm_modal('{{route('orders.destroy', $order->id)}}');">{{__('Delete')}}</a></li>
                                          @endif
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        @endif
                        @endfor
                     @endfor
            </tbody>
        </table>
        <div class="clearfix">
            <div class="pull-right">
                {{-- {{ $orders->appends(request()->input())->links() }} --}}
            </div>
        </div>
    </div>
</div>

@endsection


@section('script')
    <script type="text/javascript">
        function sort_orders(el){
            $('#sort_orders').submit();
        }
    </script>
@endsection
