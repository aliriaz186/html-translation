@extends('frontend.layouts.app')

@section('content')
<style>
.ml-bl{margin-left: -15px;border-left: 10px solid white;}
.fs1r{font-size:1rem;}
.w-48{width:48%;}
.m-l-a{margin-left: auto}
.modal-address{border: 1px dashed;display: grid;justify-items: left;padding-left: 14px;width: 44%;margin-left: 28%;}
.m-l-37{margin-left: 37%}
.w-ms-60{max-width: 60%;}
.w-mo-50{width:50% !important;}

@media only screen and (max-width: 600px) {
 .w-ms-60{max-width: 100%;}
 .modal-address{width:100%;margin-left: 0%;}
 .w-mo-50{width:100% !important;}
 .btn-purchase-block {display: block; width: 100%;}
 .fs1r{font-size:1rem;display: flex; justify-content: center;margin-bottom:4%}
 .product_img_part_bottom .text-right{text-align: left!important;}
 }
 
 @media (max-width: 900px) and (min-width: 600px) {
 .w-ms-60{max-width: 100%;}
 .modal-address{width:100%;margin-left: 0%;}
 .w-mo-50{width:100% !important;}
 .btn-purchase-block {display: block; width: 100%;}
 .fs1r{font-size:1rem;display: flex; justify-content: center;margin-bottom:4%}
 .product_img_part_bottom .text-right{text-align: right!important;}
 }
 
</style>
    <section class="gry-bg py-4 profile">
        <div class="container-fluid p-4">
            <div class="row cols-xs-space cols-sm-space cols-md-space">
                <div class="col-lg-2-1 d-none d-lg-block">
                    @if(Auth::user()->user_type == 'seller')
                        @include('frontend.inc.seller_side_nav')
                    @elseif(Auth::user()->user_type == 'customer')
                        @include('frontend.inc.customer_side_nav')
                    @endif
                </div>

                <div class="col-lg-9">
                    <div class="main-content">
                        <!-- Page title -->
                        <div class="page-title">
                            <div class="row align-items-center">
                                <div class="col-md-6 col-12">
                                    <h2 class="heading heading-6 text-capitalize strong-600 mb-0">
                                        {{__('Refund Request')}}
                                    </h2>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="float-md-right">
                                        <ul class="breadcrumb">
                                            <li><a href="{{ route('home') }}">{{__('Home')}}</a></li>
                                            <li><a href="{{ route('dashboard') }}">{{__('Dashboard')}}</a></li>
                                            <li class="active"><a href="{{ route('purchases.refund_request') }}">{{__('Refund Request')}}</a></li>
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
                                    <div class="tab-pane fade @if($i==0)show active @endif" id="{{$id}}" role="tabpanel" aria-labelledby="{{$id}}-tab">
                                                  <div id="card" class="no-border mt-4">
                                                        @foreach ($orders as $key => $order)
                                                        @php
                                                                $status = $order->delivery_status;
                                                                $status_message = StatusMessage($status,$order,$order->refund_type); 
                                                                
                                                                if($status == 'refund requested') $status ='Refund Pending';
                                                                else if($status == 'delivered'){$status = "shipped";}
                                                                
                                                                if(($status != 'Refund Pending' && $status != 'Processing Refund') && $i==1)continue;                          
                                                                else if($status != 'Authorised Request' && $i==2)continue;
                                                                else if($status != 'Unauthorised Request' && $i==3)continue;
                                                                else if(($status =='Unauthorised Request' || $status == 'Authorised Request' || $status == 'Cancelled Request' || $status == 'Refund Pending') && $i==4)continue;
                                                                else if($status != 'Cancelled Return' && $i==5)continue;
                                                                else if($status != 'Cancelled Request' && $i==6)continue;
                                                    
                                                                $non_prem = ShippingPurchases($order->order);         
                                                                $ReturnRequestTracker = App\ReturnRequestTracker::where('order_detail_id',$order->id)->first();
                                                           @endphp
                                                            <div class="product_oreder_part bg-white">
                                                            <div class="oreder_part_block mb-3">
                                                                <div class="order_detail_track">
                                                                    <div class="row">
                                                                        <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                                                                            <span class="ml-2 mr-3 font-weight-bold cursor fs1r" type="button" data-toggle="collapse" data-target="#detailed--{{$id}}--{{$key}}" aria-expanded="false" aria-controls="detailed">
                                                                            <i class="fa fa-plus"></i>
                                                                            <i class="fa fa-minus"></i>
                                                                            </span>  
                                                                            <a class="btn btn-primary btn-purchase-block"  href="#{{ $order->code }}" onclick="show_purchase_history_details({{ $order->id }})">{{ $order->code }}</a>                           
                                                                        </div>
                                                                        <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12"> 
                                                                            @if($non_prem) <p id="estimate" class="text-center">{{__('Estimated Delivery')}} <br> <span class="text-success font-weight-bold"> {{explode('##',$non_prem)[0]}} </span>  <span class="text-success  font-weight-bold" > {{explode('##',$non_prem)[1]}}</span></p>@endif   
                                                                        </div>
                                                                        <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12 order_track_item ">
                                                                           <a class="btn btn-warning pull-right btn-purchase-block" href="#{{ $order->code }}" onclick="show_purchase_history_details({{ $order->order->id }})" ><i class="fa fa-clipboard"></i> {{__('Order Details')}} </a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div  id="detailed--{{$id}}--{{$key}}" class="collapse track_order_details_part">
                                                                    <div class="col-md-12 details_part_product_img slingle_item_address_part">
                                                                        <div class="row">
                                                                            <div class="col-md-1 col-sm-2 col-xs-4">
                                                                                <a href="{{ route('product', $order->product->slug) }}" class="d-block product-image h-100">
                                                                                    <img class="img-fit lazyload mx-auto" src="{{ asset('frontend/images/placeholder.jpg') }}" data-src="{{ asset($order->product->thumbnail_img) }}" alt="{{ __($order->product->name) }}">
                                                                                </a>
                                                                            </div>
                                                                            <div class="col-md-4 col-sm-6 col-xs-8">
                                                                                <a href="{{route('product',$order->product->slug)}}" target="_blank" title="{{$order->product->name}}" class="font-weight-bold">{{ $order->product->name}}</a>
                                                                                <p>
                                                                                    {{__('Price:')}}' {{home_discounted_price($order->product->id)}}<br>
                                                                                    {{__('Qty:')}}' {{$order->quantity}}
                                                                                </p>
                                                                            </div>
                                                                            
                                                                            <div class="col-md-4 col-sm-4 col-xs-12 no-print">
                                                                                <p class="font-weight-bold">
                                                                                    {{ ucfirst(str_replace('_', ' ', $status)) }}<br>
                                                                                    <span class="text-danger  font-weight-normal">  {{ $status_message}}  </span><br><br>
                                                                                    <span class="font-weight-bold">{{ ucfirst(str_replace('-',' ',$order->refund_request)) }}</span><br>                                                                    </p>    
                                                                                     @if($order->refund_type == 'source')
                                                                                            <span class=" font-weight-normal">Refund to Source</span><br>
                                                                                            <span class=" font-weight-normal">We'd refund the amount to the same payment method used (3 - 5 Working Days)</span>
                                                                                        @else
                                                                                             <span class=" font-weight-normal">Refund to Wallet</span><br>
                                                                                            <span class=" font-weight-normal"> We'd refund the amount to your wallet (Within 24hrs)<span>
                                                                                        @endif                                                                             </div>
                                                                            <div class="col-md-3 col-sm-12 col-xs-12 col-md-offset-5 text-right">
                                                                            @if($status != "refunded" || $status != "Processing Refund")
                                                                             @if(App\Dispute::where('title',$order->code )->get()->isEmpty() && $order->is_accepted_cancellation!=0)
                                                                                <button data-toggle="modal" data-target="#disputeModal{{$order->id}}" onclick="dispute_modal('{{ $order->code }}','{{$order->id}}')" class="dropdown-item">{{__('Dispute')}}</button>
                                                                            @endif
                                                                              <button class="btn btn-block btn-primary mb-1" onclick="cancelation_request('{{route('purchases.cancellation_request.destroy', $order->id)}}')">{{__('Cancel Request')}}</button>
                                                                            @endif
                                                                            </div>                                                                        
                                                                        </div>
                                                                        <div class="row product_img_part_bottom">
                                                                            <div class="col-md-6 col-sm-6 col-xs-12 text-left"><span class="font-weight-bold">{{__('Ordered On ')}}</span>{{ date('d-m-Y @ h:m:s', $order->date) }}</div>
                                                                            <div class="col-md-6 col-sm-6 col-xs-12 text-right"><span>{{__('Order Total')}} </span><span class="product_item_price_item font-weight-bold">  {{ single_price($order->grand_total) }}</span></div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>    
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                <div class="pagination-wrapper">
                                                    <ul class="pagination justify-content-end">
                                                        {{ $orders->links() }}
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


  <div class="modal" id="disputeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"> 
         <div class="modal-dialog modal-dialog-centered modal-dialog-zoom product-modal w-ms-60"  id="modal-size" role="document">
          <div class="modal-content position-relative">
              <form class="" action="{{ route('disputes.store') }}" method="POST" enctype="multipart/form-data">
        	    @csrf
                <div class="modal-header">
                    <h5 class="modal-title strong-600 heading-5">{{__('Dispute and Resolution')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body gry-bg px-3 pt-3">
                <div class="row">
                    <div class="col-lg-6">
                            <div class="form-group">
                                <input type="text" class="form-control mb-3" name="title" placeholder="Order Id" id="product-code-con-dispute" required readonly>
                                <input type="hidden" class="form-control mb-3" name="orderId" placeholder="Order Id" id="order-id-get-dispute" required readonly>
                            </div>
                            <div class="form-group">
                                <select class="form-control" required name="dispute">
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
                    <div class="col-lg-6 gry-bg ml-bl">
                        <h5 class="title strong-600 heading-5">{{__('First Step')}}</h5>
                        <p> Before opening adispute, we recommend that you contact the seller. Most of the times the seller will help to resolve the issue.  <a class="btn btn-danger text-white" onclick="show_chat_modal_test()"  class="contactSeller" > CONTACT SELLER</a></p>
                        <h5 class="title strong-600 heading-5">{{__('Second Step')}}</h5>
                        <p>If you and the seller can't come to an agreement, you can ask us to step in and at this point we'd step in to help on <span style="color: red">@php $nextWeek = Carbon\Carbon::now()->addDays(7) @endphp {{$nextWeek->format('d/m/y')}}</span></p>
                    </div>
                </div>
                </div>  
                <div class="modal-footer m-l-37" >
                    <button type="button" class="btn btn-link" data-dismiss="modal">{{__('Cancel')}}</button>
                    <button type="submit" class="btn btn-base-1 btn-styled">{{__('Send Request')}}</button>
                </div>
    	      </form>
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
<div class="modal fade" id="cancelation-request" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                {{-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> --}}
                <h4 class="modal-title" id="myModalLabel">{{__('Confirmation')}}</h4>
            </div>

            <div class="modal-body">
                <p>{{__('Are you sure you want to cancel this request')}}</p>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">{{__('Cancel')}}</button>
                <a id="delete_link" class="btn btn-danger btn-ok">{{__('Delete')}}</a>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')

    <script type="text/javascript">

        function dispute_modal(code, id){
            $('#chatModal').modal('hide');
            $('#disputeModal').modal('show');
            document.getElementById("product-code-con-dispute").value = code;
            document.getElementById("order-id-get-dispute").value = id;
        }
        
         function cancelation_request(delete_url)
    {
        jQuery('#cancelation-request').modal('show', {backdrop: 'static'});
        document.getElementById('delete_link').setAttribute('href' , delete_url);
    }

 $('body').removeClass('modal-open');
$('.modal-backdrop').remove();

</script>
@endsection