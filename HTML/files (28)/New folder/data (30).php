@extends('frontend.layouts.app')

@section('content')

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
                        <div class="page-title">
                            <div class="row align-items-center">
                                <div class="col-md-6 col-12">
                                    <h2 class="heading heading-6 text-capitalize strong-600 mb-0">
                                        {{__('Purchases')}}
                                    </h2>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="float-md-right">
                                        <ul class="breadcrumb">
                                            <li><a href="{{ route('home') }}">{{__('Home')}}</a></li>
                                            <li><a href="{{ route('dashboard') }}">{{__('Dashboard')}}</a></li>
                                            <li class="active"><a href="{{ route('purchases.index') }}">{{__('Purchases')}}</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                            <div id="card" class="no-border mt-4">
                                 <div class="card-header no-print">
		                     <form id="sort_orders" action="{{route('purchases.search')}}" method="GET">
		                        @csrf
		                        <div class="row">
		                          
		                           <div class="col-md-4">
		                              <input type="text" class="form-control" id="search" name="search" @isset($sort_search) value="{{ $sort_search }}" @endisset placeholder="Type Order code & hit Enter">
		                           </div>
		                           <div class="col-md-4 ">
		                              <select class="form-control mb-3 selectpicker" data-placeholder="{{__('Filter by Payment Status')}}" name="payment_status" onchange="sort_orders()">
		                                 <option value="">{{__('Filter by Payment Status')}}</option>
		                                 <option value="paid" @isset($payment_status) @if($payment_status == 'paid') selected @endif @endisset>{{__('Paid')}}</option>
		                                 <option value="unpaid" @isset($payment_status) @if($payment_status == 'unpaid') selected @endif @endisset>{{__('Un-Paid')}}</option>
		                              </select>
		                           </div> 
		                           <div class="col-md-4">
		                              <select class="form-control mb-3 selectpicker" data-placeholder="{{__('Filter by Order status')}}" name="delivery_status" onchange="sort_orders()">
		                                 <option value="">{{__('Filter by Deliver Status')}}</option>
	                                        <option value="pending" @isset($delivery_status) @if($delivery_status == 'pending' ) selected @endif @endisset> {{__('Pending')}} </option>
	                                        <option value="delivered" @isset($delivery_status) @if($delivery_status == 'delivered' ) selected @endif @endisset> {{__('Shipped')}} </option>
	                                        <option value="refunded" @isset($delivery_status) @if($delivery_status == 'refunded' ) selected @endif @endisset> {{__('refunded')}} </option>
	                                        <option value="returned" @isset($delivery_status) @if($delivery_status == 'returned' ) selected @endif @endisset> {{__('returned')}} </option> 
	                                        <option value="cancelled" @isset($delivery_status) @if($delivery_status == 'cancelled' ) selected @endif @endisset> {{__('cancelled')}} </option>
	                                        <option value="refund requested" @isset($delivery_status) @if($delivery_status == 'refund requested' ) selected @endif @endisset> {{__('Refund requested')}} </option>
	                                        <option value="Cancelled Return" @isset($delivery_status) @if($delivery_status == 'Cancelled Return' ) selected @endif @endisset> {{__('Cancelled Return')}} </option>
	                                        <option value="return requested" @isset($delivery_status) @if($delivery_status == 'return requested' ) selected @endif @endisset> {{__('Return requested')}} </option>
	                                        <option value="Cancellation Pending" @isset($delivery_status) @if($delivery_status == 'Cancellation Pending' ) selected @endif @endisset> {{__('Cancellation Pending')}} </option>
	                                        <option value="Cancelled Request" @isset($delivery_status) @if($delivery_status == 'Cancelled Request' ) selected @endif @endisset> {{__('Cancelled Request')}} </option>
	                                        <option value="Processing Refund" @isset($delivery_status) @if($delivery_status == 'Processing Refund' ) selected @endif @endisset> {{__('Processing Refund')}} </option>
	                                        <option value="Authorised Request" @isset($delivery_status) @if($delivery_status == 'Authorised Request' ) selected @endif @endisset> {{__('Authorised Request')}} </option>
	                                        <option value="Unauthorised Request" @isset($delivery_status) @if($delivery_status == 'Unauthorised Request' ) selected @endif @endisset> {{__('Unauthorised Request')}} </option>                 
		                              </select>               
		                           </div>
		                        </div>
		                        
		                     </form>
		                  </div>
		                  <div class="card-body">
                                    @forelse ($orders as $key => $order)
                                    <div class="product_oreder_part bg-white">
                                      <div class="oreder_part_block mb-3">
                                        <div class="order_detail_track">
                                            <div class="row">
                                                <div class="col-md-4 col-sm-4 col-xs-12">
                                                   <button class="btn btn-primary"  href="#{{ $order->code }}" onclick="show_purchase_history_details({{ $order->id }})">{{ $order->code }}</button>                      
                                                </div>
                                                @php $non_prem = ShippingPurchases($order);
                                                @endphp
                                                    <div class="col-md-4 col-sm-4 col-xs-12"> 
                                                      @if($non_prem)
                                                        <p id="estimate" class="text-center">{{__('Estimated Delivery')}} <br> <span class="text-success font-weight-bold"> {{explode('##',$non_prem)[0]}} </span>  <span class="text-success  font-weight-bold" > {{explode('##',$non_prem)[1]}}</span></p>
                                                     @endif   
                                                     </div>
                                                    <div class="col-md-4 col-sm-4 col-xs-12 order_track_item">
                                                        <div class="pull-right">
                                                            @if ($qty=BuyNow($order) > 0)<button  class="btn btn-primary  btn-styled  btn-sm text-white" data-toggle="modal" data-target="#BuyNowModal{{$key}}"><i class="fa fa-shopping-cart"></i> {{__('Buy Again')}}</button>
                                                            @else <button  class="btn btn-styled btn-base-3 btn-sm text-white" disabled>{{__('Out Of Stock')}} </button>
                                                            @endif
                                                            <a href="#{{ $order->code }}" onclick="show_purchase_history_details({{ $order->id }})" class="btn btn-warning"><i class="fa fa-clipboard"></i> {{__('Order Details')}} </a>
                                                        </div>
                                                    </div>
                                            </div>
                                        </div>
                                        <div class="track_order_details_part" >
                                            <div class="col-md-12 details_part_product_img slingle_item_address_part">             
                                                @forelse ($order->orderDetails as $order_detail_key => $orderDetails)
                                                @php $status = $orderDetails->delivery_status; $status_message =  StatusMessage($status , $order ,$orderDetails->refund_type);  if($status == 'return requested'){$status = "Return Pending";}else if($status == 'refund requested'){$status = "Refund Pending";}else if($status == 'delivered'){$status = "shipped";}  @endphp
                                                    <div class="row">
                                                        <div class="col-md-1 col-sm-2 col-xs-4">
                                                            <a href="{{ route('product', $orderDetails->product->slug) }}" class="d-block product-image h-100">
                                                                <img class="img-fit lazyload mx-auto" src="{{ asset('frontend/images/placeholder.jpg') }}" data-src="{{ asset($orderDetails->product->thumbnail_img) }}" alt="{{ __($orderDetails->product->name) }}">
                                                            </a>
                                                        </div>
                                                        <div class="col-md-4 col-sm-6 col-xs-8">
                                                            <a href="{{route('product',$orderDetails->product->slug)}}" target="_blank" title="{{$orderDetails->product->name}}" class="font-weight-bold"> {{ $orderDetails->product->name}} </a>
                                                            <p>
                                                                {{__('Price:')}} {{home_discounted_price($orderDetails->product->id)}}<br>
                                                                {{__('Qty:')}} {{$orderDetails->quantity}}<br>
                                                            </p>
                                                        </div>
                                                        <div class="col-md-5 col-sm-4 col-xs-12">  
                                                        <strong class="font-weight-bold">{{ ucfirst(str_replace('_', ' ', $orderDetails->delivery_status=='delivered'?'shipped':$orderDetails->delivery_status)) }}</strong><br>
                                                                <p class="text-danger">  {{ $status_message}}  </p>  
                                                                @if($orderDetails->is_accepted_cancellation|| $orderDetails->is_accepted_return|| $orderDetails->is_refund_accepted)
                                                                    <span class="text-danger">This Order Has Been {{$status}} on {{Carbon\Carbon::parse($orderDetails->updated_at)->format('d-m-Y @ h:i:s')}}</span><br>
                                                                    <strong> {{__('Reason:')}}</strong>
                                                                    <label style="text-danget">{{__('We cancelled this product due to stock . Thanks for order. Claim your refund is applicable. (Not for COD payment)')}}</label>	    
                                                                @endif   
                                                        </div>
                                                        <div class="col-md-2 col-sm-7 col-xs-12 col-md-offset-5 text-right">
                                                            <div class="dropdown">
                                                                <button class="btn" type="button" id="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{__('Options')}}  <i class="ml-2 fa fa-ellipsis-v"></i> </button>
                                                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="">
                                                                    <button onclick="show_purchase_history_details({{ $orderDetails->id }})" class="dropdown-item">{{__('Order Details')}}</button>
                                                                    @if($status=='shipped')<a class="dropdown-item" href="{{route('customer.track.order',$orderDetails->id)}}">{{__('Track Order')}}</a>@endif
                                                                    <button data-toggle="modal" data-target="#chatModal" onclick="show_chat_modal('{{ $order->code }}','{{$orderDetails->id}}')" class="dropdown-item">{{__('Contact Seller')}}</button>
                                                                    @if($orderDetails->delivery_status == 'pending' || $orderDetails->delivery_status == 'review') <button data-toggle="modal" data-target="#cancelRequest" class="dropdown-item" onclick="cancelOrderModal({{$orderDetails->id}})">{{__('Cancel Order')}}</button> @endif
                                                                    @if($orderDetails->delivery_status == 'shipped')  <button class="dropdown-item" data-toggle="modal" data-target="#returnRequest" onclick="returnOrderModal({{$orderDetails->id}})">{{__('Return Request')}}</button>@endif
                                                                    @if($orderDetails->delivery_status == 'shipped' || $orderDetails->delivery_status == 'delivery') <button class="dropdown-item" data-toggle="modal" data-target="#refundRequest" onclick="refundOrderModal({{$orderDetails->id}})">{{__('Refund Request')}}</button>@endif
                                                                    @if(($orderDetails->delivery_status == 'shipped' || $orderDetails->delivery_status == 'delivery') &&  !App\Dispute::where('title',$order->code )->get()->isEmpty()) <button data-toggle="modal" data-target="#disputeModal{{$order->id}}" onclick="dispute_modal('{{ $order->code }}','{{$orderDetails->id}}')" class="dropdown-item">{{__('Dispute')}}</button>  @endif
                                                                    <button data-toggle="modal" data-target="#productFeedback"  class="dropdown-item" onclick="product_feedback({{$orderDetails->id}})">{{__('Leave Product Review')}}</button>
                                                                    <button data-toggle="modal" data-target="#sellerFeedback" class="dropdown-item" onclick="seller_feedback({{$orderDetails->id}})">{{__('Leave Seller Feedback')}}</button>
                                                                    @if($orderDetails->is_accepted_return == 1) @php $returnAddress = json_decode(App\ReturnAddres::where('user_id',$orderDetails->seller_id)->first()->address); $RA = App\ReturnAddres::where('user_id',$orderDetails->seller_id)->first(); @endphp  <button class="dropdown-item" data-toggle="modal" data-target="#downloadReturnAddress" onclick="show_return_address_modal('{{$returnAddress->name}}' ,'{{$returnAddress->address}}' ,'{{$returnAddress->city}}' , '{{$returnAddress->postal_code}}', '{{$returnAddress->country}}', {{$returnAddress->phone}}, {{$order->id}} , '{{$RA->seller_instruction}}', '{{$RA->admin_instruction}}')">{{__('Return Address')}}</button>@endif
                                                                    <a href="{{ route('customer.invoice.download', $order->id) }}" class="dropdown-item">{{__('Download Invoice')}}</a>
                                                                </div>
                                                        </div>
                                                        </div>
                                                    </div> 
                                                 @empty
                                                                                                    
                                                @endforelse
                                                <div class="row product_img_part_bottom">
                                                    <div class="col-md-6 col-sm-6 col-xs-12 text-left"><span>{{__('Ordered On ')}}</span class="font-weight-bold">{{ date('d-m-Y @ h:m:s', $order->date) }}</div>
                                                    <div class="col-md-6 col-sm-6 col-xs-12 text-right"><span>{{__('Order Total ')}} </span><span class="product_item_price_item font-weight-bold">  {{ single_price($order->grand_total) }}</span></div>
                                                </div>
                                            </div>
                                    </div>
                                </div>    
                            </div>
                                @empty
				     <div class="product_oreder_part bg-white">
				    <div class="oreder_part_block mb-3">
				         
				          <div class="track_order_details_part" >
				              <div class="col-md-12 details_part_product_img slingle_item_address_part">             
				                  <div class="row text-center d-block">
				                        <i class="la la-meh-o d-block heading-1 alpha-5"></i>
				                        <span class="d-block">{{ __('No history found.') }}</span>
				                  </div>
				                 
				              </div>
				          </div>
				    </div>    
				  </div>
                            @endforelse
                            </div>
                           </div>
                           @if(!isset($delivery_status))
                             @if(!isset($payment_status))
	                        <div class="pagination-wrapper py-4">
	                            <ul class="pagination justify-content-end">
	                                {{ $orders->links() }}
	                            </ul>
	                        </div>
	                        @endif
	                   @endif     
                    </div>
                </div>
            </div>
        </div>
    </section>


 @foreach($orders as $key => $order)
<div class="modal fade" id="BuyNowModal{{$key}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Products</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <table class="table table-sm table-hover table-responsive-md">
                <thead>
                <tr>
                    <th width="16%">{{__('Image')}}</th>
                    <th>{{__('Name')}}</th>
                    <th>{{__('Options')}}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($order->orderDetails as $order_detail_key => $orderDetails)
	                <tr>
		                <td>
		                 <a href="{{ route('product', $orderDetails->product->slug) }}" class="d-block product-image h-100">
	                                <img class="img-fit lazyload mx-auto" src="{{ asset('frontend/images/placeholder.jpg') }}" data-src="{{ asset($orderDetails->product->thumbnail_img) }}" alt="{{ __($orderDetails->product->name) }}">
	                          </a>
		                </td>
		                <td>
		                   <a href="{{ route('product', $orderDetails->product->slug) }}" class="d-block product-image h-100">
		                    {{Illuminate\Support\Str::limit($orderDetails->product->name,35,'(...)')}}
		                     </a>
		                </td>
		                <td>
		       		  @if (BuyNow($order) > 0)
		                    <button  class="btn btn-primary  btn-styled  btn-sm text-white" onclick="showAddToCartModal({{ $orderDetails->product->id }})">
		                     <i class="fa fa-shopping-cart"></i> Add To Cart </button>
		                  @else 
		                        <button  class="btn btn-styled btn-base-3 btn-sm text-white" disabled>Out Of Stock </button>
		                  @endif
		                  </td>   
	                  </tr>
	                  
	                   <form id="option-choice-form">
                                @csrf
                                <input type="hidden" name="id" value="{{ $orderDetails->product->id }}">
                           </form>     

                  @endforeach           
		</tbody>
              </table>  
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>	
@endforeach

@include('frontend/partials/purchase_history_modal')

@endsection
@section('script')

    <script type="text/javascript">


        function show_chat_modal(code, id){
            document.getElementById("product-code-con").value = code;
            document.getElementById("orderIdGet").value = id;
        }
        function show_return_address_modal(name , address , city , postal_code , country , phone , order_id , seller_instruction, admin_instruction){
            document.getElementById("name").value = name;
            document.getElementById("address").value = address;
            document.getElementById("city").value = city;
            document.getElementById("postal_code").value = postal_code;
            document.getElementById("country").value = country;
            document.getElementById("phone").value = phone;
            document.getElementById("order_id").value = order_id;
            
              var editor = new Jodit('#seller_instruction');
              editor.value =seller_instruction ;
              
                 var editor = new Jodit('#admin_instruction');
              editor.value =admin_instruction;

        }
        function show_chat_modal_test(){
            $('.disputes').modal('hide');
            $('#chatModal').modal('show');
            document.getElementById("product-code-con-dispute").value = document.getElementById("product-code-con").value;
            document.getElementById("order-id-get-dispute").value = document.getElementById("orderIdGet").value;
        }
        function dispute_modal(code, id){
            document.getElementById("product-code-con").value = code;
            document.getElementById("orderIdGet").value = id;
        }

        function seller_feedback(id){
             document.getElementById("order-id-feedback").value = id;
             document.getElementById("order-id-feedback-detailed").value = id;
        }
        function product_feedback(id){
             document.getElementById("order-id-pro-feedback").value = id;
        }
        $('#order_details').on('hidden.bs.modal', function () {
            location.reload();
        })
        function cancelOrderModal(id) {
            document.getElementById('can-modal-order-id').value = id;
        }

        function returnOrderModal(id) {
            document.getElementById('return-modal-order-id').value = id;
        }

        function refundOrderModal(id) {
            document.getElementById('refund-modal-order-id').value = id;
        }

        $('#cancel-order-form').submit(function(){
            document.getElementById('cancellationrequestError').style.display = "none";
            if (document.getElementById('cancellationrequest').value === "0" ||document.getElementById('cancellationrequest').value === 0 || document.getElementById('cancellationrequest').value === '') {
                document.getElementById('cancellationrequestError').style.display = "inline";
                return false;
            }
        });

        $('#returnRequestform').submit(function(){
            document.getElementById('returnrequestError').style.display = "none";
            if (document.getElementById('returnrequest').value === "0" ||document.getElementById('returnrequest').value === 0 || document.getElementById('returnrequest').value === '') {
                document.getElementById('returnrequestError').style.display = "inline";
                return false;
            }
        });


$('.source').click(function() {
  $(this).find('input').prop('checked', true)    
});

$('.wallet').click(function() {
  $(this).find('input').prop('checked', true)    
});

 function sort_orders(el){
            $('#sort_orders').submit();
        }
</script>



@endsection
