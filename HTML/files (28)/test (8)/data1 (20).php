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
 @php
 $date = Carbon\Carbon::today();
 $current_date = $date->format('y/m/d');
 $feedbacks = App\OrderDetail::
 whereBetween('created_at',[sevenDays(),$current_date])
 ->where('delivery_status','delivered')
 ->where('payment_status','paid')
 ->where('feedback',0)
 ->orderBy('created_at','ASC')->distinct()->get();
 @endphp
 @foreach ($feedbacks as $key=>$FB)
 <div class="modal" id="feedback{{$FB->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-zoom product-modal" id="modal-size" role="document">
       <div class="modal-content position-relative">
          <div class="modal-header">
             <h5 class="modal-title strong-600 heading-5" style="margin-left: auto">{{__('RATE CUSTOMER')}}</h5>
             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">&times;</span>
             </button>
          </div>
          <form class="" action="{{ route('leave-feedback.store') }}" method="POST" enctype="multipart/form-data">
             @csrf
             <div class="modal-body gry-bg px-3 pt-3">
                <div class="row">
                   <div class="col-lg-12">
                      <div class="form-group">
                         <input type="text" name="name" readonly class="form-control text-center" value="{{$FB->product->name}}" placeholder="PRODUCT NAME">
                         <input type="hidden" name="customer_id" value="{{$FB->order->user->customer->id}}">
                         <input type="hidden" name="orderdetail_id" value="{{$FB->id}}">
                      </div>
                   </div>
                </div>
                <div class="row">
                   <div class="col-lg-12">
                      <div class="form-group">
                         <textarea name="feedback" id="message" class="editor" cols="30" rows="10"></textarea>
                      </div>
                   </div>
                </div>
                <div class="row">
                   <div class="col-sm-12 d-flex justify-content-center">
                      <div class="c-rating mt-1 mb-1 clearfix d-inline-block">
                         <input type="radio" id="star5{{$key}}" name="rating" value="5" required/>
                         <label class="star" for="star5{{$key}}" title="Awesome" aria-hidden="true"></label>
                         <input type="radio" id="star4{{$key}}" name="rating" value="4" required/>
                         <label class="star" for="star4{{$key}}" title="Great" aria-hidden="true"></label>
                         <input type="radio" id="star3{{$key}}" name="rating" value="3" required/>
                         <label class="star" for="star3{{$key}}" title="Very good" aria-hidden="true"></label>
                         <input type="radio" id="star2{{$key}}" name="rating" value="2" required/>
                         <label class="star" for="star2{{$key}}" title="Good" aria-hidden="true"></label>
                         <input type="radio" id="star1{{$key}}" name="rating" value="1" required/>
                         <label class="star" for="star1{{$key}}" title="Bad" aria-hidden="true"></label>
                      </div>
                   </div>
                </div>
             </div>
             <div class="modal-footer"  style="justify-content: center;padding-left:10px">
                <button type="button" class="btn btn-base-1 btn-styled" data-dismiss="modal">{{__('Cancel')}}</button>
                <button type="submit" class="btn btn-base-1 btn-styled">{{__('Send')}}</button>
             </div>
          </form>
       </div>
    </div>
 </div>
 @endforeach
 
 <div class="modal fade" id="shipOrder" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
       <div class="modal-content">
          <div class="modal-header">
             <h5 class="modal-title" id="exampleModalLabel">Shipping Information</h5>
             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">&times;</span>
             </button>
          </div>
          <div class="modal-body">
             <form action="{{route('seller.set.courier')}}" method="Post">
                @csrf
                <div class="col-lg-12">
                   <div class="form-group">
                      <select name="shipping_courier_type" class="form-control courier_shipping_type">
                         <option value="" selected>Please select shipping method</option>
                            @foreach (App\Shipping::all() as $ship)
                                <option value="{{$ship->id}}">{{$ship->name}}</option>
                            @endforeach
                      </select>
                   </div>
                   
                   <div class="row">
                      <div class="col-md-6" id="premium_data1" style="display: none">
                         <a> <i data-toggle="tooltip" title="If you select this you have no price but get promote product" class="fa fa-info-circle text-danger" style="font-size:20px;margin-left:35%" data-toggle="modal" data-target="#info"></i></a>
                      </div>
                   </div>
                   
                   
                   <div class="form-group" >
                      <label for="Tracking">Tracking</label>
                      <input name="trackNumber" type="number" class="form-control">
                   </div>
                   
                   <div class="form-group">
                      <input type="hidden" name="id" class="form-control" id="order_id">
                   </div>
                </div>
          </div>
          <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
          </div>
          </form>
       </div>
    </div>
 </div>
 
 
 <div class="modal fade" id="shipOrderAll" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
       <div class="modal-content">
          <div class="modal-header">
             <h5 class="modal-title" id="exampleModalLabel">All Shipping Information </h5>
             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">&times;</span>
             </button>
          </div>
          <div class="modal-body">
             <form action="{{route('seller.set.courier.all')}}" method="Post">
                @csrf
                <div class="col-lg-12">
                   <div class="form-group">
                      <select name="shipping_courier_type" class="form-control courier_shipping_type">
                         <option value="">Please select shipping method</option>
                            @foreach (App\Shipping::all() as $ship)
                                <option value="{{$ship->id}}-{{$ship->premium}}">{{$ship->name}}</option>
                            @endforeach
                      </select>
                   </div>
                   <div class="row"  id="premium_data">
                      <div class="col-md-6">
                         <a> <i data-toggle="tooltip" title="If you select this you have no price but get promote product" class="fa fa-info-circle text-danger" style="font-size:20px" data-toggle="modal" data-target="#info"></i></a>
                      </div>
                   </div>
                   
                   <div class="form-group" id="premium_tracking">
                      <label for="Tracking">Tracking</label>
                      <input name="trackNumber" type="number" class="form-control">
                   </div>
                   <div class="form-group">
                      <input type="hidden" name="id" class="form-control" id="tracker_number_courier_all">
                   </div>
                </div>
          </div>
          <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
          </div>
          </form>
       </div>
    </div>
 </div>
 
 
    <div class="modal fade" id="cancelRequest" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form method="post" action="{{route('orders.seller_approved_cancel')}}" id="cancel-order-form">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Order Cancellation</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <label for="exampleFormControlTextarea1">Reason for Cancellation *</label>
                        <div class="form-group">
                            <select class="form-control" required>
	                      <option value="0">--please select--</option>
	                      <option value="duplicate-order">Duplicate Order</option>
	                      <option value="order-mistake">Customer Ordered By Mistake</option>
	                      <option value="no-longer">No Longer Needed By Customer</option>
	                      <option value="incomplete-address">Incomplete Details</option>
	                      <option value="undeliverable">Undeliverable Shipping Address</option>
	                      <option value="product-stock">Product Out of Stock</option>
	                      <option value="other-reasons">Other Reasons</option>
	                      
	                   </select>
                        </div>
                        <div class="text-danger" id="cancellationrequestError" style="display: none">
                            Please select reason!
                        </div>
                        
                          <div class="row">
                            <div class="col-md-12 source cursor">
	                             <input type="radio" name="refund" value="source" id="source"> 
                                     <span>Refund to source</span>
	                            <p>We'd refund the amount to the same payment method used (3 - 5 Working Days)</p>
                            </div>
                            <div class="col-md-12 source cursor">
	                             <input type="radio" name="refund" value="wallet" id="wallet">
                                        <span>Refund to wallet</span>
	                            <p>We'd refund the amount to your wallet (Within 24hrs)</p>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="order_id" id="can-modal-order-id">
                        <input type="hidden" name="status" value="cancelled">
                        <input type="hidden" name="incomming" value="orders.index">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
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
 <div class="modal fade" id="import" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
       <form method="post" action="{{route('seller.import.orders')}}"  enctype="multipart/form-data">
          @csrf
          <div class="modal-content">
             <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Import CSV</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
             </div>
             <div class="modal-body">
                <input type="file" name="csv" value="" accept=".csv" id="file-2" class="custom-input-file custom-input-file--4" data-multiple-caption="{count} files selected" />
                <label for="file-2" class="mw-100 mb-3">
                <span></span>
                <strong>
                <i class="fa fa-upload"></i>
                {{__('Choose csv')}}
                </strong>
                </label>   
             </div>
             <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Import</button>
             </div>
          </div>
       </form>
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
 <div class="modal" id="feedbackChatModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-zoom product-modal" id="modal-size" role="document">
       <div class="modal-content position-relative">
          <div class="modal-header">
             <h5 class="modal-title strong-600 heading-5">{{__('Request Feedback')}}</h5>
             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">&times;</span>
             </button>
          </div>
          <form class="" action="{{ route('conversations.store') }}" method="POST" enctype="multipart/form-data">
             @csrf
             <div class="modal-body gry-bg px-3 pt-3">
                <div class="form-group">
                   <input type="text" class="form-control mb-3" name="title" placeholder="Order Id" id="order-code-con" required readonly>
                   <input type="hidden" class="form-control mb-3" name="orderId" placeholder="Order Id" id="orderIdGet_feedback" required readonly>
                   <input type="hidden" class="form-control mb-3" name="orderType" value="Requset Feedback" required readonly>
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