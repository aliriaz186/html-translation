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
                                        {{__('Return Requests')}}
                                    </h2>
                                </div>
                                <div class="col-md-6">
                                    <div class="float-md-right">
                                        <ul class="breadcrumb">
                                            <li><a href="{{ route('home') }}">{{__('Home')}}</a></li>
                                            <li><a href="{{ route('dashboard') }}">{{__('Dashboard')}}</a></li>
                                            <li class="active"><a href="{{ route('orders.return_requests') }}">{{__('Return Requests')}}</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <ul class="nav nav-tabs mt-3" id="myTab" role="tablist">
                            <li class="nav-item"><a class="nav-link active" id="all-tab" data-toggle="tab" href="#all" role="tab" aria-controls="all" aria-selected="true">All Request</a></li>
                            <li class="nav-item"><a class="nav-link " id="pending-tab" data-toggle="tab" href="#pending" role="tab" aria-controls="pending" aria-selected="false">Pending</a></li>
                            <li class="nav-item"><a class="nav-link " id="auth-tab" data-toggle="tab" href="#auth" role="tab" aria-controls="auth" aria-selected="false">Authorised</a></li>
                            <li class="nav-item"><a class="nav-link" id="unauth-tab" data-toggle="tab" href="#unauth" role="tab" aria-controls="unauth" aria-selected="false">Unauthorised </a></li>
                            <li class="nav-item"><a class="nav-link" id="cancelled-seller-tab" data-toggle="tab" href="#cancelled-customer" role="tab" aria-controls="cancelled-customer" aria-selected="false">Cancelled returns</a> </li>
                            <li class="nav-item"><a class="nav-link" id="cancelled-customer-tab" data-toggle="tab" href="#cancelled-seller" role="tab" aria-controls="cancelled-seller" aria-selected="false">Cancelled request</a> </li>
                            <li class="nav-item"><a class="nav-link" id="complete-tab" data-toggle="tab" href="#complete" role="tab" aria-controls="complete" aria-selected="false">Completed returns</a> </li>
                       </ul>

                        <div class="tab-content" id="myTabContent">
                            @for($i=0;$i<7;$i++)
                                @php if($i==0){$id='all';}else if($i==1){$id='pending';}else if($i==2){$id='auth';}else if($i==3){$id='unauth';}else if($i==4){$id='complete';}else if($i==5){$id='cancelled-customer';}else if($i==6){$id='cancelled-seller';} @endphp
                             <div class="tab-pane fade  @if($i==0) show active @endif" id="{{$id}}" role="tabpanel" aria-labelledby="{{$id}}-tab">
                                <div id="card" class="no-border mt-4">
                                    <div>
                                        @foreach ($orders as $key => $order_id)
                                        @php 
                                        $order = \App\Order::find($order_id->id); 
                                        $orderDetails = $order->orderDetails->first();
                                        $status = $orderDetails->delivery_status;
                                        $msg = StatusMessage($status,$order,$orderDetails->refund_type);
                                        
                                       if($status == 'return requested'){$status = "Return Pending";}
                                       else if($status == 'delivered'){$status = "shipped";}
                                       
                                             if($status != 'Return Pending' && $i==1)continue;                          
                                        else if($status != 'Authorised Request' && $i==2)continue;
                                        else if($status != 'Unauthorised Request' && $i==3)continue;
                                        else if(($status == 'Unauthorised Request' || $status == 'Authorised Request' || $status == 'Cancelled Request') && $i==4)continue;
                                        else if($status != 'Cancelled Return' && $i==5)continue;
                                        else if($status != 'Cancelled Request' && $i==6)continue;
                                       
                                        $non_prem = ShippingPurchases($order);  
                                        @endphp
                                            <div class="product_oreder_part bg-white border">
                                                <div class="oreder_part_block mb-3">
                                                <div class="order_detail_track">
                                                    <div class="row">
                                                        <div class="col-md-4 col-sm-4 col-xs-12">
                                                            <span class="ml-2 mr-3 font-weight-bold cursor" style="font-size:1rem" type="button" data-toggle="collapse" data-target="#detailed--{{$id}}--{{$key}}" aria-expanded="false" aria-controls="detailed">
                                                           <i class="fa fa-plus"></i>
       							   <i class="fa fa-minus"></i>
                                                            
                                                            </span>
                                                            <button class="btn btn-primary" onclick="show_order_details({{ $order->id }})" href="#{{ $order->code }}" >
                                                                {{ $order->code }}
                                                            </button> 
                                                            @if (\App\RequestsNotification::where(['type' => 'return', 'seller_id' => Auth::user()->id,'order_id'=>$orderDetails->id])->exists())
								<span class="ml-2" style="color:green"><strong>(New)</strong></span>
							    @endif                         
							</div>
                                                        <div class="col-md-4 col-sm-4 col-xs-12">
                                                            @if($non_prem)
                                                            <p id="estimate" class="text-center">Deliver By <br> <span class="text-success font-weight-bold"> {{explode('##',$non_prem)[0]}} </span>  <span class="text-success  font-weight-bold" > {{explode('##',$non_prem)[1]}}</span></p>
                                                            @endif   
                                                        </div>
                                                        <div class="col-md-4 col-sm-4 col-xs-12 order_track_item no-print">
                                                            <div class="pull-right d-flex">
                                                            <a href="#{{ $order->code }}" onclick="show_order_details({{ $order->id }})" class="btn btn-warning">
                                                            <i class="fa fa-clipboard"></i> Order Details
                                                            </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="collapse" id="detailed--{{$id}}--{{$key}}">
                                                    <div class="track_order_details_part">
                                                        <div class="col-md-12 details_part_product_img slingle_item_address_part">
                                                            <div class="row">
                                                                <div class="col-md-1 col-sm-2 col-xs-4">
                                                                <a href="{{ route('product', $orderDetails->product->slug) }}" class="d-block product-image h-100">
                                                                <img class="img-fit lazyload mx-auto" src="{{ asset('frontend/images/placeholder.jpg') }}" data-src="{{ asset($orderDetails->product->thumbnail_img) }}" alt="{{ __($orderDetails->product->name) }}">
                                                                </a>
                                                                </div>
                                                                <div class="col-md-4 col-sm-6 col-xs-8">
                                                                    <a href="{{route('product',$orderDetails->product->slug)}}" target="_blank" title="{{$orderDetails->product->name}}" class="font-weight-bold">{{ $orderDetails->product->name}} @if($order->delivery_viewed == 0 && $order->payment_status_viewed == 0)<span class="ml-2 text-success"><strong>({{ __('New') }})</strong></span>@endif 		  </a>
                                                                    <div>Price: {{single_price($orderDetails->product->unit_price)}}</div>
                                                                    <div>Qty: {{$orderDetails->quantity}}</div>
                                                                    <div>SKU: {{$orderDetails->product->sku}}</div>
                                                                    <div>Variations: {{$orderDetails->product->variation==''?'NAN':$orderDetails->product->variation}}</div>
                                                                </div>
                                                                <div class="col-md-4 col-sm-4 col-xs-12 no-print">
                                                                <strong class="font-weight-bold">{{ ucfirst(str_replace('_', ' ', $status)) }}</strong><br>
                                                                <p class="text-danger">  {{ $msg}}  </p>

                                                                <strong class="font-weight-bold">{{ ucfirst($orderDetails->return_request) }}</strong><br>
                                                                <p>  {{ ucfirst($orderDetails->return_reason)}}  </p>
                                                                
                                                                </div>
                                                                <div class="col-md-3 col-sm-7 col-xs-12 col-md-offset-5 text-right">
                                                                    @if($order->orderDetails->where('seller_id', Auth::user()->id)->first()->is_accepted_return == 0 || $order->orderDetails->where('seller_id', Auth::user()->id)->first()->is_accepted_return == '0')
                                                                        @if($order->orderDetails->where('seller_id', Auth::user()->id)->first()->delivery_status == 'Authorised Request')
                                                                            <button class=" btn btn-block btn-success mb-1" onclick="returnOrderApproveModal({{$order->id}},'approve')" data-toggle="modal" data-target="#returnOrderRequest">Accept</button>
                                                                            <button class="btn btn-block btn-danger mb-1" onclick="returnOrderRejectModal({{$order->id}},'reject')" data-toggle="modal" data-target="#returnOrderRequest">Reject</button>
                                                                            <button class="btn btn-block btn-warning mb-1" onclick="refundOrderApproveModal({{$order->id}})" data-toggle="modal" data-target="#refundOrderRequest">Refund Now</button>
                                                                      
                                                                       @elseif($order->orderDetails->where('seller_id', Auth::user()->id)->first()->delivery_status == 'Unauthorised Request' || 
                                                                       $order->orderDetails->where('seller_id', Auth::user()->id)->first()->delivery_status == 'Cancelled Request' || 
                                                                       $order->orderDetails->where('seller_id', Auth::user()->id)->first()->delivery_status == 'Cancelled Return')
                                                                       
                                                                            <button data-toggle="modal" data-target="#ticket_modal" onclick="ticket_modal('{{ $order->code }}')" class="btn btn-primary btn-block mb-1">{{__('Contact Support')}}</button>
                                                                            <button onclick="show_chat_modal('{{$order->code}}',  '{{$order->id}}')" class="btn btn-block btn-primary mb-1" data-toggle="modal" data-target="#chatModal">Contact Buyer</button>
                                                                       @else
                                                                            <button class="btn btn-block btn-success mb-1" onclick="returnOrderApproveModal({{$order->id}},'authroised')" data-toggle="modal" data-target="#returnOrderRequest">Authroised</button>
                                                                            <button class="btn btn-block btn-danger mb-1" onclick="returnOrderRejectModal({{$order->id}} , 'unauthroised')" data-toggle="modal" data-target="#returnOrderRequest">Unauthroised</button>   
                                                                        @endif
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="row product_img_part_bottom">
                                                                <div class="col-md-6 col-sm-6 col-xs-12 text-left"><span>Ordered On </span class="font-weight-bold">{{ date('d-m-Y @ h:m:s', $order->date) }}</div>
                                                                <div class="col-md-6 col-sm-6 col-xs-12 text-right no-print "><span>Order Total </span><span class="product_item_price_item font-weight-bold">  {{ single_price($order->grand_total) }}</span></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="pagination-wrapper py-4">
                                    <ul class="pagination justify-content-end">
                                       
                                    </ul>
                                </div>  
                            </div>
                            @endfor                    
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="modal" id="chatModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-zoom product-modal" id="modal-size" role="document">
           <div class="modal-content position-relative">
              <div class="modal-header">
                 <h5 class="modal-title strong-600 heading-5">{{__('Contact Buyer')}}</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                 <span aria-hidden="true">&times;</span>
                 </button>
              </div>
              <form class="" action="{{ route('conversations.store') }}" method="POST" enctype="multipart/form-data">
                 @csrf
                 <div class="modal-body gry-bg px-3 pt-3">
                    <div class="form-group">
                       <input type="text" class="form-control mb-3" name="title" placeholder="Order Id" id="product-code-con" required readonly>
                       <input type="hidden" class="form-control mb-3" name="orderId" placeholder="Order Id" id="orderIdGet" required readonly>
                       <input type="hidden" class="form-control mb-3" name="orderType" value="Contact Buyer" required readonly>
                    </div>
                    <div class="form-group">
                       <textarea class="form-control" rows="8" name="message" required placeholder="Your Question"></textarea>
                    </div>
                 </div>
                 <div class="modal-footer">
                    <button type="button" class="btn btn-link" data-dismiss="modal">{{__('Cancel')}}</button>
                    <button type="submit" class="btn btn-base-1 btn-styled">{{__('Send')}}</button>
                 </div>
              </form>
           </div>
        </div>
     </div>
    <div class="modal fade" id="returnOrderRequest" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Confirmation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="{{route('orders.seller_return')}}">
                    @csrf
                    <div class="modal-body">
                        <h6 id="return-type"></h6>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="order_id" id="return-modal-order-id">
                        <input type="hidden" name="incomming" value="orders.return_requests">
                        <input type="hidden" name="type" id="return-type-id">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Continue</button>
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


 <div class="modal fade" id="refundOrderRequest" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
       <div class="modal-content">
          <div class="modal-header">
             <h5 class="modal-title" id="exampleModalLabel">Refund Comfirmation</h5>
             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">&times;</span>
             </button>
          </div>
          <form method="post" action="{{route('orders.seller_refund_request')}}">
             @csrf
             <div class="modal-body">
                <h6 id="refund-type"></h6>
                <div id="isApproveType" style="display: none">
                   <div class="form-group">
                      <select class="form-control" required name="refund_request" id="refundrequest">
                         <option value="0">--please select--</option>
                         <option value="full-refund">Full Refund</option>
                         <option value="partial-refund">Partial Refund</option>
                      </select>
                      <div class="text-danger" id="refundrequestError" style="display: none">
                         Please select option!
                      </div>
                   </div>
                   <div class="form-group">
                      <label for="exampleFormControlTextarea1">Amount to Refund (partial refund only)</label>
                      <input name="amount" id="refundAmount" type="number" class="form-control mb-3" sum="sum" placeholder="{{__('Enter Amount (ex £9.99)')}}">
                      <div class="text-danger" id="refundrequestAmountError" style="display: none">
                         Please enter amount!
                      </div>
                   </div>
                </div>
             </div>
             <div class="modal-footer">
                <input type="hidden" name="order_id" id="refund-modal-order-id">
                <input type="hidden" name="incomming" value="orders.index">
                <input type="hidden" name="type" id="refund-type-id">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary">Continue</button>
             </div>
          </form>
       </div>
    </div>
 </div>
 
     <div class="modal fade" id="ticket_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-zoom product-modal" id="modal-size" role="document">
            <div class="modal-content position-relative">
                <div class="modal-header">
                    <h5 class="modal-title strong-600 heading-5">{{__('Problem with this order')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body px-3 pt-3">
                    <form class="" action="{{ route('support_ticket.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>Subject <span class="text-danger">*</span></label>
                            <input type="text" id="subject" class="form-control mb-3" name="subject" placeholder="Subject" required>
                        </div>
                        <div class="form-group">
                            <label>Provide a detailed description <span class="text-danger">*</span></label>
                            <textarea class="form-control editor" name="details" placeholder="Type your reply" data-buttons="bold,underline,italic,|,ul,ol,|,paragraph,|,undo,redo"></textarea>
                        </div>
                        <div class="form-group">
                            <input type="file" name="attachments[]" id="file-2" class="custom-input-file custom-input-file--2" data-multiple-caption="{count} files selected" multiple />
                            <label for="file-2" class=" mw-100 mb-0">
                                <i class="fa fa-upload"></i>
                                <span>Attach files.</span>
                            </label>
                        </div>
                        <div class="text-right mt-4">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('cancel')}}</button>
                            <button type="submit" class="btn btn-base-1">{{__('Send Ticket')}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        
       function show_chat_modal(code , id){
        document.getElementById("product-code-con").value = 'More Information Regarding Order '+code;
        document.getElementById("orderIdGet").value = id;
         }
        function returnOrderApproveModal(id,type) {
            document.getElementById('return-modal-order-id').value = id;
            document.getElementById('return-type-id').value = type;
            document.getElementById('return-type').innerHTML = `Are you sure you want to ${type} the request?`;
        }

        function returnOrderRejectModal(id,type) {
            document.getElementById('return-modal-order-id').value = id;
            document.getElementById('return-type-id').value = type;
            document.getElementById('return-type').innerHTML = `Are you sure you want to ${type} the request?`

        }
        function ticket_modal(code){
            document.getElementById('subject').value = code;
        }
        function refundOrderApproveModal(id) {
        document.getElementById('refund-modal-order-id').value = id;
        document.getElementById('refund-type-id').value = "approve";
        document.getElementById('refund-type').innerHTML = "";
        document.getElementById('isApproveType').style.display = 'inline';
    }
    @if(count($orders)>0)
    $.post('{{ route('update-notification-returnRequest') }}', {_token:'{{ @csrf_token() }}',order_id:{{$order->id}}});
   @endif
    </script>
@endsection
