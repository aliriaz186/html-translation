
	
<div class="modal" id="downloadReturnAddress" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-zoom product-modal" id="modal-size" role="document" style="max-width: 60%">
        <div class="modal-content position-relative">
            <div class="modal-header">
                <h5 class="modal-title strong-600 heading-5" style="margin-left: auto">{{__('RETURN INFORAMTION')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="" action="{{ route('return_address.store') }}" method="POST">
                @csrf
                <div class="modal-body gry-bg px-3 pt-3">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">{{__('Name')}}</label>
                                <input type="text" class="form-control" name="name"  id="name" placeholder="{{__('Name')}}" readonly="true" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">{{__('Address')}}</label>
                                <input type="text" class="form-control" name="address"  id="address" placeholder="{{__('Address')}}"  readonly="true" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group has-feedback">
                                <label class="control-label">{{__('City')}}</label>
                                <input type="text" class="form-control" placeholder="{{__('City')}}"  readonly="true" id="city" name="city" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group has-feedback">
                                <label class="control-label">{{__('Postal code')}}</label>
                                <input type="text" min="0" class="form-control" placeholder="{{__('Postal code')}}"  readonly="true" id="postal_code" name="postal_code" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">{{__('Select your country')}}</label>
                                 <input type="text" min="0"  readonly="true" class="form-control" id="country" placeholder="{{__('Country')}}" name="country" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group has-feedback">
                                <label class="control-label" >{{__('Phone')}}</label>
                                <input type="number" min="0"  readonly="true" class="form-control" id="phone" placeholder="{{__('Phone')}}" name="phone" required>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="control-label" >{{__('Order id')}}</label>
                                <input type="number" min="0"  readonly="true" class="form-control" id="order_id" placeholder="{{__('Order_id')}}" name="order_id" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <textarea id="seller_instruction" name="seller_instruction" readonly disabled cols="30" rows="4" class="form-control" placeholder="Seller Instructions">
                                </textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <textarea id="admin_instruction" name="admin_instruction" cols="30" rows="14" class="form-control editor" readonly placeholder="Admin Instruction"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer"  style="justify-content: center;padding-left:10px">
                    <button type="button" class="btn btn-base-1 btn-styled" data-dismiss="modal">{{__('Cancel')}}</button>
                    <button type="submit" class="btn btn-base-1 btn-styled">{{__('Download')}}</button>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="modal disputes" id="disputeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-zoom product-modal" style="max-width:60%" id="modal-size" role="document">
        <div class="modal-content position-relative">
            <div class="modal-header">
                <h5 class="modal-title strong-600 heading-5">{{__('Dispute and Resolution')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="" action="{{ route('disputes.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-lg-6">
                         <div class="modal-body gry-bg px-3 pt-3">
                            <div class="form-group">
                            <input type="text" class="form-control mb-3" name="title" placeholder="Order Id" id="product-code-con-dispute" required readonly>
                            <input type="hidden" class="form-control mb-3" name="orderId" placeholder="Order Id" id="order-id-get-dispute" required readonly>
                            </div>
                            <div class="form-group">
                                <select class="form-control" required name="dispute" id="dispute">
                                    <option value="0">--please select--</option>
                                    <option value="wrong-order">Wrong Order Received</option>
                                    <option value="not-as-described">Item Not As Described</option>
                                    <option value="damaged-item">Damaged Item</option>
                                    <option value="sold-as-new">Used Sold As New</option>
                                    <option value="order-not-received">Order Not Received</option>
                                    <option value="return-postage">Return Postage Not Refunded</option>
                                    <option value="replacement">I Want A Replacement</option>
                                    <option value="refund-order">I Want A Refund</option>
                            </select>
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" rows="8" name="resolution" required placeholder="More Information Needed"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 gry-bg " style="margin-left: -15px;border-left: 10px solid white;">
                        <h5 class="title strong-600 heading-5">{{__('First Step')}}</h5>
                        <p> Before opening adispute, we recommend that you contact the seller. Most of the times the seller will help to resolve the issue.  <a class="btn btn-danger text-white" onclick="show_chat_modal_test()"  class="contactSeller" > CONTACT SELLER</a></p>
                        <h5 class="title strong-600 heading-5">{{__('Second Step')}}</h5>
                        <p>If you and the seller can't come to an agreement, you can ask us to step in and at this point we'd step in to help on <span style="color: red">@php $nextWeek = Carbon\Carbon::now()->addDays(7) @endphp {{$nextWeek->format('d/m/y')}}</span></p>
                    </div>
                    <div class="modal-footer" style="margin-left: 37%">
                        <button type="button" class="btn btn-link" data-dismiss="modal">{{__('Cancel')}}</button>
                        <button type="submit" class="btn btn-base-1 btn-styled">{{__('Send Request')}}</button>
                    </div>
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



    <div class="modal fade" id="returnRequest" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form method="post" action="{{route('purchase_history.return_product')}}" id="returnRequestform">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Return Request</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <select class="form-control" required name="return_request" id="returnrequest">
                                <option value="0">--please select--</option>
                                <option value="item-not-as-described">Item not as described</option>
                                <option value="incompatible">Incompatible</option>
                                <option value="not-useful-for-intended-purpose">Not useful for intended purpose</option>
                                <option value="damaged">Damaged</option>
                                <option value="wrong-item-received">Wrong Item Received</option>
                                <option value="others">Others</option>
                            </select>
                            <div class="text-danger" id="returnrequestError" style="display: none">
                                Please select reason!
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Reason</label>
                            <textarea class="form-control" name="return_reason" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="order_id" id="return-modal-order-id">
                        <input type="hidden" name="status" value="return requested">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="cancelRequest" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form method="post" action="{{route('purchase_history.cancel')}}" id="cancel-order-form">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Order Cancellation Request</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <label for="exampleFormControlTextarea1">Reason for Cancellation *</label>
                        <div class="form-group">
                            <select class="form-control" required name="cancellation_request" id="cancellationrequest">
                                <option value="0">--please select--</option>
                                <option value="duplicate-order">Duplicate Order</option>
                                <option value="order-mistake">Ordered By Mistake</option>
                                <option value="no-longer">No Longer Needed</option>
                                <option value="other">Other</option>
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
                        <input type="hidden" name="status" value="Cancellation Pending">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>


    <div class="modal fade" id="refundRequest" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form method="post" action="{{route('purchase_history.refund')}}" id="refund-order-form">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Order Refund Request</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <label for="exampleFormControlTextarea1">Reason for Refund *</label>
                        <div class="form-group">
                            <select class="form-control" required name="refund_request" id="refundrequest">
                                <option value="0">--please select--</option>
                                <option value="duplicate-order">Duplicate Order</option>
                                <option value="order-mistake">Ordered By Mistake</option>
                                <option value="no-longer">No Longer Needed</option>
                                <option value="other">Other</option>
                            </select>
                        </div>
                        <div class="text-danger" id="refundrequestError" style="display: none">
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
                        <input type="hidden" name="order_id" id="refund-modal-order-id">
                        <input type="hidden" name="status" value="refund requested">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade" id="sellerFeedback" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Leave Seller Feedback</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="{{route('purchase_history.seller_feedback')}}" id="refund-order-form-feedback">
                    @csrf
                <div class="modal-body">
                    <h4>Rate Seller</h4>
                   
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="c-rating mt-1 mb-1 clearfix d-inline-block">
                                <input type="radio" id="star5" name="rating" value="5" required/>
                                <label class="star" for="star5" title="Awesome" aria-hidden="true"></label>
                                <input type="radio" id="star4" name="rating" value="4" required/>
                                <label class="star" for="star4" title="Great" aria-hidden="true"></label>
                                <input type="radio" id="star3" name="rating" value="3" required/>
                                <label class="star" for="star3" title="Very good" aria-hidden="true"></label>
                                <input type="radio" id="star2" name="rating" value="2" required/>
                                <label class="star" for="star2" title="Good" aria-hidden="true"></label>
                                <input type="radio" id="star1" name="rating" value="1" required/>
                                <label class="star" for="star1" title="Bad" aria-hidden="true"></label>
                            </div>
                        </div>
                    </div>     
                        <div class="form-group">
                             <input name="title" class="form-control" placeholder="Subject Header">	    	
			</div>
                        <div class="form-group">
                            <div class="form-group">
                                <input type="hidden" id="order-id-feedback" name="order_id">
                                <textarea class="form-control" name="message" rows="4" placeholder="{{__('Enter Seller Review & Feedback')}}"></textarea>
                            </div>
                        </div>
                        <div id="detailed">
                            <h5>Leave Seller Feedback</h5>
                            <div class="row">
                                <div class="col-lg-6">
                                    <p style="margin:0px">Accurate description</p>
                                            <input type="hidden" id="order-id-feedback-detailed" value="{{session('order_id')}}" name="order_id">
                                            <div class="c-rating mt-1 mb-1  d-inline-block">
                                                <input type="radio" id="star50" name="ratingADN" value="5" required/>
                                                <label class="star" for="star50" title="Awesome" aria-hidden="true"></label>
                                                <input type="radio" id="star40" name="ratingADN" value="4" required/>
                                                <label class="star" for="star40" title="Great" aria-hidden="true"></label>
                                                <input type="radio" id="star30" name="ratingADN" value="3" required/>
                                                <label class="star" for="star30" title="Very good" aria-hidden="true"></label>
                                                <input type="radio" id="star20" name="ratingADN" value="2" required/>
                                                <label class="star" for="star20" title="Good" aria-hidden="true"></label>
                                                <input type="radio" id="star10" name="ratingADN" value="1" required/>
                                                <label class="star" for="star10" title="Bad" aria-hidden="true"></label>
                                            </div>
                                </div>
                                <div class="col-lg-6">
                                    <p style="margin:0px">Delivery Time</p>
                                            <div class="c-rating mt-1 mb-1 d-inline-block">
                                                <input type="radio" id="star59" name="ratingDT" value="5" required/>
                                                <label class="star" for="star59" title="Awesome" aria-hidden="true"></label>
                                                <input type="radio" id="star49" name="ratingDT" value="4" required/>
                                                <label class="star" for="star49" title="Great" aria-hidden="true"></label>
                                                <input type="radio" id="star39" name="ratingDT" value="3" required/>
                                                <label class="star" for="star39" title="Very good" aria-hidden="true"></label>
                                                <input type="radio" id="star29" name="ratingDT" value="2" required/>
                                                <label class="star" for="star29" title="Good" aria-hidden="true"></label>
                                                <input type="radio" id="star19" name="ratingDT" value="1" required/>
                                                <label class="star" for="star19" title="Bad" aria-hidden="true"></label>
                                            </div>
                                </div>
                                <div class="col-lg-6">
                                    <p style="margin:0px">Reasonable postage</p>
                                            <div class="c-rating mt-1 mb-1 d-inline-block">
                                                <input type="radio" id="star58" name="ratingACCD" value="5" required/>
                                                <label class="star" for="star58" title="Awesome" aria-hidden="true"></label>
                                                <input type="radio" id="star48" name="ratingACCD" value="4" required/>
                                                <label class="star" for="star48" title="Great" aria-hidden="true"></label>
                                                <input type="radio" id="star38" name="ratingACCD" value="3" required/>
                                                <label class="star" for="star38" title="Very good" aria-hidden="true"></label>
                                                <input type="radio" id="star28" name="ratingACCD" value="2" required/>
                                                <label class="star" for="star28" title="Good" aria-hidden="true"></label>
                                                <input type="radio" id="star18" name="ratingACCD" value="1" required/>
                                                <label class="star" for="star18" title="Bad" aria-hidden="true"></label>
                                            </div>
                                </div>
                                <div class="col-lg-6">
                                    <p style="margin:0px">Communication</p>
                                            <div class="c-rating mt-1 mb-1 d-inline-block">
                                                <input type="radio" id="star57" name="ratingCOMM" value="5" required/>
                                                <label class="star" for="star57" title="Awesome" aria-hidden="true"></label>
                                                <input type="radio" id="star47" name="ratingCOMM" value="4" required/>
                                                <label class="star" for="star47" title="Great" aria-hidden="true"></label>
                                                <input type="radio" id="star37" name="ratingCOMM" value="3" required/>
                                                <label class="star" for="star37" title="Very good" aria-hidden="true"></label>
                                                <input type="radio" id="star27" name="ratingCOMM" value="2" required/>
                                                <label class="star" for="star27" title="Good" aria-hidden="true"></label>
                                                <input type="radio" id="star17" name="ratingCOMM" value="1" required/>
                                                <label class="star" for="star17" title="Bad" aria-hidden="true"></label>
                                            </div>
                                        </div>
                            </div>
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit"  class="btn btn-primary">Submit</button>
                </div>
                </form>
            </div>
        </div>
    </div>


    <div class="modal fade" id="productFeedback" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Leave Product Feedback</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="{{route('purchase_history.product_feedback')}}" id="refund-order-form">
                    @csrf
                <div class="modal-body">
                    <h4>Product Rating</h4>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="c-rating mt-1 mb-1 clearfix d-inline-block">
                                <input type="radio" id="starP5" name="rating" value="5" required/>
                                <label class="star" for="starP5" title="Awesome" aria-hidden="true"></label>
                                <input type="radio" id="starP4" name="rating" value="4" required/>
                                <label class="star" for="starP4" title="Great" aria-hidden="true"></label>
                                <input type="radio" id="starP3" name="rating" value="3" required/>
                                <label class="star" for="starP3" title="Very good" aria-hidden="true"></label>
                                <input type="radio" id="starP2" name="rating" value="2" required/>
                                <label class="star" for="starP2" title="Good" aria-hidden="true"></label>
                                <input type="radio" id="starP1" name="rating" value="1" required/>
                                <label class="star" for="starP1" title="Bad" aria-hidden="true"></label>
                            </div>
                        </div>
                    </div>
                        <div class="form-group">
                            <div class="form-group">
                                <input type="hidden" id="order-id-pro-feedback" name="order_id">
                                <label for="exampleFormControlTextarea1"></label>
                                <textarea class="form-control" name="message" rows="4" placeholder="{{__('Enter Product Review & Feedback')}}"></textarea>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
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

    <div class="modal" id="chatModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-zoom product-modal" id="modal-size" role="document">
            <div class="modal-content position-relative">
                <div class="modal-header">
                    <h5 class="modal-title strong-600 heading-5">{{__('Contact Seller')}}</h5>
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
