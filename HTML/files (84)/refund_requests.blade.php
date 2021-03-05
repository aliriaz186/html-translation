@extends('layouts.app')

@section('content')

    <div class="panel">
        <div class="panel-heading bord-btm clearfix pad-all h-100">
            <h3 class="panel-title pull-left pad-no">{{__('Refund Requests')}}</h3>
            <div class="pull-right clearfix">
            </div>
        </div>
        <div class="panel-body">
            <div class="tab-base tab-stacked-left">
                <ul class="nav nav-tabs">
                    <li class="active">
                        <a data-toggle="tab" href="#demo-stk-lft-tab-1" aria-expanded="true">{{__('All Request')}}</a>
                    </li>
                    <li class="">
                        <a data-toggle="tab" href="#demo-stk-lft-tab-2" aria-expanded="false">{{__('Pending')}}</a>
                    </li>
                    <li class="">
                        <a data-toggle="tab" href="#demo-stk-lft-tab-4" aria-expanded="false">{{__('Authorised')}}</a>
                    </li>
                    <li class="">
                        <a data-toggle="tab" href="#demo-stk-lft-tab-5" aria-expanded="false">{{__('Unauthorised')}}</a>
                    </li>
                    <li class="">
                        <a data-toggle="tab" href="#demo-stk-lft-tab-3" aria-expanded="false">{{__('Cancelled returns')}}</a>
                    </li>
                    <li class="">
                        <a data-toggle="tab" href="#demo-stk-lft-tab-5" aria-expanded="false">{{__('Completed returns')}}</a>
                    </li>
                     <li class="">
                        <a data-toggle="tab" href="#demo-stk-lft-tab-6" aria-expanded="false">{{__('All Approved')}}</a>
                    </li>
                    <li class="">
                        <a data-toggle="tab" href="#demo-stk-lft-tab-7" aria-expanded="false">{{__('All confirmed ')}}</a>
                    </li>
                </ul>
                    <div class="tab-content">
                        @for($i=0;$i<=8;$i++)
                        <div id="demo-stk-lft-tab-{{$i+1}}" class="tab-pane fade {{$i==0?'active in':''}}">
                        <!-- Order history table -->
                            <div class="card no-border mt-4">
                                <div>
                                    <table class="table table-sm table-hover table-responsive-md">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>{{__('Order Code')}}</th>
                                            <th>{{__('Num. of Products')}}</th>
                                            <th>{{__('Customer')}}</th>
                                            <th>{{__('Amount')}}</th>
                                            <th>{{__('Delivery Status')}}</th>
                                            <th>{{__('Payment Status')}}</th>
                                            <th>{{__('Refund Type')}}</th>
                                            <th>{{__('Refund Amount')}}</th>
                                            <th style="width: 20%">{{__('Options')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if (count($orders)> 0)
                                        @foreach ($orders as $key => $order_id)
                                            @php
                                                $order = \App\Order::find($order_id->id);
                                            @endphp
                                            @if($order != null)
                                                <tr>
                                                    <td>
                                                        {{ $key+1}}
                                                    </td>
                                                    <td>
                                                        <a href="#{{ $order->code }}" onclick="show_order_details({{ $order->id }})">{{ $order->code }}</a>
                                                    </td>
                                                    <td>
                                                        {{ count($order->orderDetails->where('order_id', $order->id)) }}
                                                    </td>
                                                    <td>
                                                        @if ($order->user_id != null)
                                                            {{ $order->user->name }}
                                                        @else
                                                            Guest ({{ $order->guest_id }})
                                                        @endif
                                                    </td>
                                                    <td>
                                                        {{ single_price($order->orderDetails->where('order_id', $order->id)->sum('price')) }}
                                                    </td>
                                                    <td>
                                                        @php
                                                            $status = $order->orderDetails->first()->delivery_status;
                                                        @endphp
                                                        {{ ucfirst(str_replace('_', ' ', $status)) }}
                                                    </td>
                                                    <td>
                                                            <span class="badge badge--2 mr-4">
                                                                @if ($order->orderDetails->where('order_id', $order->id)->first()->payment_status == 'paid')
                                                                    <i class="bg-green"></i> {{__('Paid')}}
                                                                @else
                                                                    <i class="bg-red"></i> {{__('Unpaid')}}
                                                                @endif
                                                            </span>
                                                    </td>
                                                    <td>
                                                        {{$order_id->refund_type}}
                                                    </td>
                                                    <td>
                                                        {{$order_id->refund_amount}}
                                                    </td>
                                                    <td>
                                                        @if(permission_check_all('refund_reqeuest') || permission_check_delete('refund_reqeuest') ||  permission_check_put('refund_reqeuest'))
                                                        <span id="isSellerRequest" style="display: none">{{\App\RefundRequest::where('order_id', $order->id)->exists()}}</span>
                                                        @if($order->orderDetails->where('order_id', $order->id)->first()->is_refund_accepted == 0 || $order->orderDetails->where('order_id', $order->id)->first()->is_refund_accepted == '0')
                                                            <button class="btn btn-success btn-sm" onclick="refundOrderApproveModal({{$order->id}})" data-toggle="modal" data-target="#refundOrderRequest">Process Refund</button>
                                                            <button class="btn btn-danger btn-sm ml-2" onclick="refundOrderRejectModal({{$order->id}})" data-toggle="modal" data-target="#refundOrderRequest">Reject</button>
                                                        @endif
                                                        @if($order->orderDetails->where('order_id', $order->id)->first()->is_refund_accepted == 1 || $order->orderDetails->where('order_id', $order->id)->first()->is_refund_accepted == '1')
                                                            <div style="background: green; padding: 5px; border-radius: 5px; color: white; width: 75px;">Approved</div>
                                                        @endif
                                                    @endif
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                        @else
                                        <tr>
                                          <td class="text-center pt-5 h4" colspan="100%">
                                              <i class="la la-meh-o d-block heading-1 alpha-5"></i>
                                          <span class="d-block">{{ __('No history found.') }}</span>
                                          </td>
                                       </tr>
                                        @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        <div class="pagination-wrapper py-4">
                            <ul class="pagination justify-content-end">
                                {{--{{ $orders->links() }}--}}
                            </ul>
                        </div>
                    </div>
                    @endfor
                </div>
        </div>
    </div>


    <div class="modal fade" id="refundOrderRequest" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Refund Comfirmation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="{{route('admin.refund_request')}}">
                    @csrf
                    <div class="modal-body">
                        <h6 id="refund-type"></h6>
                        <div id="isApproveType" style="display: none">
                            <div class="form-group">
                                <select class="form-control" required name="refund_request" id="refundrequest">
                                   <option value="0">--please select--</option>
                                    <option value="Full Refund">Full Refund</option>
                                    <option value="Partial Refund">Partial Refund</option>
                                </select>
                                <div class="text-danger" id="refundrequestError" style="display: none">
                                    Please select option!
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">Amount to Refund (partial refund only)</label>
                                <input name="amount" id="refundAmount" type="text" class="form-control mb-3" sum="sum" placeholder="{{__('Enter Amount (ex 9.99)')}}">
                                <div class="text-danger" id="refundrequestAmountError" style="display: none">
                                    Please enter amount!
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="order_id" id="refund-modal-order-id">
                        <input type="hidden" name="incomming" value="admin.refund_requests">
                        <input type="hidden" name="type" id="refund-type-id">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary" id="continue-btn-click">Continue</button>
                    </div>
                </form>
            </div>
        </div>
    </div>



    <div class="modal fade" id="order_details" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-zoom product-modal" id="modal-size" role="document">
            <div class="modal-content position-relative">
                <div class="c-preloader">
                    <i class="fa fa-spin fa-spinner"></i>
                </div>
                <div id="order-details-modal-body">

                </div>
            </div>
        </div>
    </div>
    <script>
        function refundOrderApproveModal(id) {
            document.getElementById('refund-modal-order-id').value = id;
            document.getElementById('refund-type-id').value = "approve";
            document.getElementById('refund-type').innerHTML = "";
            document.getElementById('isApproveType').style.display = 'inline';
            if(document.getElementById("isSellerRequest").innerHTML === 1 || document.getElementById("isSellerRequest").innerHTML === "1"){
                document.getElementById('continue-btn-click').click();
            }
        }

        function refundOrderRejectModal(id) {
            document.getElementById('refund-modal-order-id').value = id;
            document.getElementById('refund-type-id').value = "reject";
            document.getElementById('refund-type').innerHTML = "Are you sure you want to reject the request?"

        }
    </script>
@endsection
