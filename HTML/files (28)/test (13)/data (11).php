@extends('frontend.layouts.app')
@section('content')
<style>
@media print {
  @page { margin:.5cm }
  body { margin: 1.6cm; }
    .no-print, .no-print *
    {
        display: none !important;
    }
}

</style>
<section class="gry-bg py-4 profile">
   <div class="container-fluid p-4">
      <div class="row cols-xs-space cols-sm-space cols-md-space">
         <div class="col-lg-2-1 d-none d-lg-block">
            @include('frontend.inc.seller_side_nav')
         </div>
         <div class="col-lg-9">
            <div class="main-content">
               <!-- Page title -->
               <div class="page-title no-print">
                  <div class="row align-items-center">
                     <div class="col-md-6">
                        <h2 class="heading heading-6 text-capitalize strong-600 mb-0">
                           {{__('Orders')}}
                        </h2>
                     </div>
                     <div class="col-md-6">
                        <div class="float-md-right">
                           <ul class="breadcrumb">
                              <li><a href="{{ route('home') }}">{{__('Home')}}</a></li>
                              <li><a href="{{ route('dashboard') }}">{{__('Dashboard')}}</a></li>
                              <li class="active"><a href="{{ route('orders.index') }}">{{__('Orders')}}</a></li>
                           </ul>
                        </div>
                     </div>
                  </div>
               </div>
               <!-- Order history table -->
               <div class="card no-border mt-4">
                  <div class="card-header no-print">
                     <form id="sort_orders" action="{{route('orders.search')}}" method="GET">
                        @csrf
                        <div class="row">
                           <div class="col-md-3 text-center">
                            <button type="button"  class="btn btn-warning custom-block btn-sm"><input type="checkbox" name="bulk[]" onchange="checkAll(this)"> <span class="text-white">Bulk</span></button>
                            <button type="button" onclick="openUrl()" class="btn btn-danger custom-block btn-sm">Export</button>
                            <button type="button" data-toggle="modal" data-target="#import" class="btn btn-primary custom-block btn-sm">Import</button>
                            </div>
                           <div class="col-md-3">
                              <input type="text" class="form-control" id="search" name="search" @isset($sort_search) value="{{ $sort_search }}" @endisset placeholder="Type Order code & hit Enter">
                           </div>
                           <div class="col-md-3 ">
                              <select class="form-control mb-3 selectpicker" data-placeholder="{{__('Filter by Payment Status')}}" name="payment_status" onchange="sort_orders()">
                                 <option value="">{{__('Filter by Payment Status')}}</option>
                                 <option value="paid" @isset($payment_status) @if($payment_status == 'paid') selected @endif @endisset>{{__('Paid')}}</option>
                                 <option value="unpaid" @isset($payment_status) @if($payment_status == 'unpaid') selected @endif @endisset>{{__('Un-Paid')}}</option>
                              </select>
                           </div>
                           <div class="col-md-3">
                              <select class="form-control mb-3 selectpicker" data-placeholder="{{__('Filter by Order status')}}" name="delivery_status" onchange="sort_orders()">
                                 <option value="">{{__('Filter by Deliver Status')}}</option>
                                 <option value="pending" @isset($delivery_status) @if($delivery_status == 'pending') selected @endif @endisset>{{__('Pending')}}</option>
                                 <option value="on_review" @isset($delivery_status) @if($delivery_status == 'on_review') selected @endif @endisset>{{__('On review')}}</option>
                                 <option value="on_delivery" @isset($delivery_status) @if($delivery_status == 'on_delivery') selected @endif @endisset>{{__('On delivery')}}</option>
                                 <option value="delivered" @isset($delivery_status) @if($delivery_status == 'delivered') selected @endif @endisset>{{__('Shipped')}}</option>
                                 <option value="cancelled" @isset($delivery_status) @if($delivery_status == 'cancelled') selected @endif @endisset>{{__('Cancelled')}}</option>
                                 <option value="returned" @isset($delivery_status) @if($delivery_status == 'returned') selected @endif @endisset>{{__('Returned')}}</option>
                                 <option value="refunded" @isset($delivery_status) @if($delivery_status == 'refunded') selected @endif @endisset>{{__('Refunded')}}</option>
                                <option value="Authorised Request" @isset($delivery_status) @if($delivery_status == 'Authorised Request') selected @endif @endisset>{{__('Authorised Request')}}</option>
                                <option value="Unauthorised Request" @isset($delivery_status) @if($delivery_status == 'Unauthorised Request') selected @endif @endisset>{{__('Unauthorised Request')}}</option>
                             
                              </select>
                              
                           </div>
                        </div>
                        <br>
                         <div class="row">
                           <div class="col-md-3">
                              <select class="form-control mb-3 selectpicker" onchange="pageNo(this)" data-placeholder="{{__('Please select page no')}}"  >
                                 <option value="">{{__('Please select page no')}}</option>
                                 <option @isset($page_number) @if($page_number== 10) selected @endif @endisset value="10">10</option>
                                 <option @isset($page_number) @if($page_number== 20) selected @endif @endisset  value="20">20</option>
                                 <option @isset($page_number) @if($page_number== 30) selected @endif @endisset  value="30">30</option>
                                 <option @isset($page_number) @if($page_number== 40) selected @endif @endisset  value="40">40</option>
                                 <option @isset($page_number) @if($page_number== 50) selected @endif @endisset  value="50">50</option>
                                 <option @isset($page_number) @if($page_number== 100) selected @endif @endisset  value="100">100</option>
                                 <option @isset($page_number) @if($page_number== 500) selected @endif @endisset  value="500">500</option>
                              </select>
                           </div>
                           <div class="col-md-3"> <button type="button" class="btn btn-primary btn-block" onclick="collapseExpand()">  {{__('Collapse/Expand')}} </button>  </div>
                           <div class="col-md-2"> <button type="button" class="btn btn-info" onclick="printSheet()">  {{__('Print Pick Sheet')}} </button>  </div>
                           <div class="col-md-2"> <button type="button" class="btn btn-success" onclick="printList()">  {{__('Print Pick List')}} </button> </div>
                           <div class="col-md-2"> <button type="button" class="btn btn-danger" onclick="invoice()">  {{__('Print Invoice')}} </button> </div>
                        </div>
                     </form>
                  </div>
                  <div class="card-body">
                     @foreach ($orders as $key => $order_id)
                          @php 
                           $order = \App\Order::find($order_id->id);
                             $status = $order->orderDetails->where('seller_id', Auth::user()->id)->first()->delivery_status;  
                                                                    
                             $payment = $order->orderDetails->where('seller_id', Auth::user()->id)->first()->payment_status;
                             $feedback = $order->orderDetails->where('seller_id', Auth::user()->id)->first()->feedback;
                             $feedback_id = $order->orderDetails->where('seller_id', Auth::user()->id)->first()->id;
                    
                            $non_prem = ShippingPurchases($order);
                         @endphp
                         
                     <div class="product_oreder_part bg-white border">
                        <div class="oreder_part_block mb-3">
                           <div class="order_detail_track">
                              <div class="row">
                                 <div class="col-md-4 col-sm-4 col-xs-12">
                                    <input type="checkbox" name="bulk[]" value="{{$order->id}}">
                                    <span class="ml-2 mr-3 font-weight-bold cursor" style="font-size:1rem" type="button" data-toggle="collapse" data-target="#detailed--{{$key}}" aria-expanded="false" aria-controls="detailed">
                                    <i class="fa fa-plus"></i>
                                    <i class="fa fa-minus"></i>
                                    </span>
                                    <button class="btn btn-primary" onclick="show_order_details({{ $order->id }})"   href="#{{ $order->code }}" >
                                       {{ $order->code }}
                                    </button>
                                         @if($order->viewed==0)<span class="ml-2" style="color:green"><strong>({{ __('New') }})</strong></span></span>@endif                           
                                 </div>

                                 <div class="col-md-4 col-sm-4 col-xs-12">
                                    @if($non_prem)
                                    <p id="estimate" class="text-center">Deliver By <br> <span class="text-success font-weight-bold"> {{explode('##',$non_prem)[0]}} </span>  <span class="text-success  font-weight-bold" > {{explode('##',$non_prem)[1]}}</span></p>
                                    @endif   
                                 </div>
                                 <div class="col-md-4 col-sm-4 col-xs-12 order_track_item no-print">
                                    <div class="pull-right d-flex">
                                       <a href="#{{ $order->code }}" onclick="show_order_details({{ $order->id }})" class="btn btn-warning"> <i class="fa fa-clipboard"></i> Order Details</a>
                                      <a class="btn btn-primary text-white ml-1"data-toggle="modal" data-target="#shipOrderAll" onclick="ship_order_all({{$order->id}})">{{__('Ship Order')}}  <i class="ml-2 fa fa-shopping-cart"></i> </a>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="collapse" id="detailed--{{$key}}">
                            <div class="track_order_details_part">
                                <div class="col-md-12 details_part_product_img slingle_item_address_part">
                                @forelse (App\OrderDetail::where('order_id',$order->id)->orderBy('created_at', 'desc')->where('seller_id',Auth::user()->id)->get() as $order_detail_key => $orderDetails)
                                
                                @php $status = $orderDetails->delivery_status;  
                                 $status_message = StatusMessage($status,$order,$orderDetails->refund_type); 
                                 if($status == 'refund requested') $status ='Refund Pending';
                                 else if($status == 'delivered'){$status = "shipped";}
                            @endphp
                                    <div class="row">
                                        <div class="col-md-1 col-sm-2 col-xs-4">
                                        <a href="{{ route('product', $orderDetails->product->slug) }}" class="d-block product-image h-100">
                                            <img class="img-fit lazyload mx-auto" src="{{ asset('frontend/images/placeholder.jpg') }}" data-src="{{ asset($orderDetails->product->thumbnail_img) }}" alt="{{ __($orderDetails->product->name) }}">
                                        </a>
                                        </div>
                                        <div class="col-md-3 col-sm-6 col-xs-8">
                                            <a href="{{route('product',$orderDetails->product->slug)}}" target="_blank" title="{{$orderDetails->product->name}}" class="font-weight-bold"> {{ $orderDetails->product->name}} @if($order->delivery_viewed == 0 && $order->payment_status_viewed == 0)<span class="ml-2 text-success"><strong>({{ __('New') }})</strong></span>@endif 		  </a>
                                        <p>
                                            {{_('Price:')}} {{home_discounted_price($orderDetails->product->id)}}<br>
                                        {{_('Qty:')}}{{$orderDetails->quantity}}<br>
                                        {{_('SKU:')}} {{$orderDetails->product->sku}}<br>
                                        {{_('Variations:')}} {{$orderDetails->product->variation==''?'N/A':$orderDetails->product->variation}}<br>
                                        @if($orderDetails->product->wholesale)
                                        {{_('Wholesale Savings:')}} {{single_price($orderDetails->order->wholesale_discount)}}
                                        @endif
                                        </p>
                                        </div>
                                        <div class="col-md-4 col-sm-4 col-xs-12 no-print">
                                            <p class="font-weight-bold">{{ ucfirst(str_replace('_', ' ', $status)) }}</p>
                                            <p class="text-danger">  {{ $status_message }}  </p>
                                        </div>
                                        <div class="col-md-4 col-sm-3 col-xs-12 no-print">
                                           <div class="row">
                                               <div class="col-md-8">
                                                <p>
                                                    {{_('Customer:')}} <strong class="font-weight-bold">{{ ucfirst($order->user->username) }}</strong> <br>
                                                    {{_('Delivery status:')}} <strong class="font-weight-bold">{{ ucfirst(str_replace('_', ' ', $status)) }}</strong> <br>
                                                    {{_('Payment status:')}} <strong class="font-weight-bold">{{ ucfirst($payment) }}</strong> <br>
                                                    {{_('Payment method:')}} <strong class="font-weight-bold">{{ ucfirst(str_replace('_', ' ', $order->payment_type)) }}</strong>
                                                </p>
                                               </div>
                                               <div class="col-md-4">
                                                <div class="dropdown" style="margin-left:-11%">
                                                    <button class="btn btn-primary" type="button" id="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Options  <i class="ml-2 fa fa-ellipsis-v"></i>
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="">
                                                       <button onclick="show_order_detail_product({{ $order->id}},{{$orderDetails->id}})" class="dropdown-item">{{__('Order Details')}}</button>
                                                       <a href="{{ route('seller.invoice.download', $order->id) }}" class="dropdown-item">{{__('Download Invoice')}}</a>
                                                       <button onclick="show_chat_modal('{{$order->code}}',  '{{$order->id}}')" class="dropdown-item" data-toggle="modal" data-target="#chatModal">{{__('Contact Buyer')}}</button>
                                                       <button onclick="show_feedback_modal('{{ $order->code}}','{{$order->id}}')" class="dropdown-item"  data-toggle="modal" data-target="#feedbackChatModal">{{__('Request Feedback')}}</button>
                                                       <a data-toggle="modal" data-target="#shipOrder" onclick="ship_order({{$orderDetails->id}})" class="dropdown-item cursor">{{__('Ship Order')}}</a>
                                                       @if( $status == 'shipped' && $payment == 'paid' && $feedback == 0 && sevenDays()< Carbon\Carbon::today()->format('y/m/d'))
                                                       <button data-toggle="modal" data-target="#feedback{{$feedback_id}}" class="dropdown-item">{{__('Feedback')}}</button>
                                                       @endif
                                                       @if( $status == 'pending' ||  $status == 'review')
                                                       <button data-toggle="modal" data-target="#cancelRequest" class="dropdown-item" onclick="cancelOrderBySeller({{$orderDetails->id}})">{{__('Cancel Order')}}</button>
                                                       @endif
                                                       <button data-toggle="modal" data-target="#refundOrderRequest" onclick="refundOrderApproveModal({{$orderDetails->id}})" class="dropdown-item">{{__('Refund Order')}}</button>
                                                    </div>
                                                 </div>
                                               </div>
                                           </div>
                                            
                                        </div>
                                    </div>
                                @endforeach

                                    <div class="row product_img_part_bottom">
                                        <div class="col-md-6 col-sm-6 col-xs-12 text-left"><span>{{_('Ordered On ')}}</span class="font-weight-bold">{{ date('d-m-Y @ h:m:s', $order->date) }}</div>
                                        <div class="col-md-6 col-sm-6 col-xs-12 text-right no-print "><span>{{_('Order Total ')}}</span><span class="product_item_price_item font-weight-bold">  {{  single_price($order->orderDetails->where('seller_id', Auth::user()->id)->sum('price') + $order->orderDetails->where('seller_id', Auth::user()->id)->sum('tax') + $order->orderDetails->where('seller_id', Auth::user()->id)->sum('shipping_cost')) }}</span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                     </div>
                     @endforeach
                  </div>
               </div>
               <div class="pagination-wrapper py-4 no-print">
                  <ul class="pagination justify-content-end">
                     {{ $orders->links() }}
                  </ul>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>




@include('frontend.partials.orders_modal')
@endsection
@section('script')
<script type="text/javascript">
   function show_chat_modal(code , id){
        document.getElementById("product-code-con").value = 'More Information Regarding Order '+code;
        document.getElementById("orderIdGet").value = id;
    }
   
    function show_feedback_modal(code,id){
        document.getElementById("order-code-con").value = 'Feedback Request For Order ' + code;
        document.getElementById("orderIdGet_feedback").value = id;
   
    }
    
    
    function ship_order(id){
        document.getElementById("order_id").value =id;
   
    }
    
    
    function ship_order_all(id){
        document.getElementById("tracker_number_courier_all").value =id;
   
    }
    
    
    function cancelOrderBySeller(id) {
        document.getElementById('can-modal-order-id').value = id;
    }
    $('#cancel-order-form').submit(function(){
        document.getElementById('cancellationrequestError').style.display = "none";
        if (document.getElementById('cancellationrequest').value === "0" ||document.getElementById('cancellationrequest').value === 0 || document.getElementById('cancellationrequest').value === '') {
            document.getElementById('cancellationrequestError').style.display = "inline";
            return false;
        }
    });
    function refundOrderModal(id) {
        document.getElementById('refundAmount').value;
        document.getElementById('refund-modal-order-id').value = id;
    }
    $('#refund-order-form').submit(function(){
        document.getElementById('refundrequestError').style.display = "none";
        document.getElementById('refundrequestAmountError').style.display = "none";
        if (document.getElementById('refundrequest').value === "0" ||document.getElementById('returnrequest').value === 0 || document.getElementById('returnrequest').value === '') {
            document.getElementById('refundrequestError').style.display = "inline";
            return false;
        }
   
        if (document.getElementById('refundAmount').value === "" || document.getElementById('refundAmount').value === '' || document.getElementById('refundAmount').value === undefined || document.getElementById('refundAmount').value === 'undefined') {
            document.getElementById('refundrequestAmountError').style.display = "inline";
            return false;
        }
    });
    function refundOrderApproveModal(id) {
        document.getElementById('refund-modal-order-id').value = id;
        document.getElementById('refund-type-id').value = "approve";
        document.getElementById('refund-type').innerHTML = "";
        document.getElementById('isApproveType').style.display = 'inline';
    }
   
    $( document ).ready(function() {
           @if(isset($id))
            $('#feedback{{$id}}').modal('show');
           @endif
              $('#premium_data').hide();
    });
   
        function sort_orders(el){
            $('#sort_orders').submit();
        }
   
   $(document).on("change",'.courier_shipping_type',function(){
    premium = this.value;
            premium = premium.split('-');
            if(premium[1]=='on'){
                $('#premium_data').show();
            }else{
                $('#premium_data').hide();
            }
   
   });
   
   function openUrl(){
     ids = [];
    $(':checkbox').each(function() {
         if(this.checked){ids.push(this.value);}});
      
      var query = {id: ids,}
   
    var url = "{{route('seller.export.orders')}}?" + $.param(query);
    window.open(url, '_blank');
   }
   function checkAll(el){
   if(el.checked){value = true;}else{value = false;}
   $(':checkbox').each(function() {
            this.checked = value;                        
        });
   }
   
   function pageNo(el){
   	  var query = {page_number: el.value }
          
      var url = "{{route('orders.index')}}?" + $.param(query);
      location.href= url;
   }
   
   
   function collapseExpand(){
   $('.collapse').collapse('toggle')
   }
   
   function printSheet(){
    window.print();
   }
   
   function printList(){
   	       
      var url = "{{route('seller.invoice.download.list')}}";
      location.href=url;
   }
   
   
   function invoice(){
        number = 0;
    $(':checkbox').each(function() {
         if(this.checked){number++;}
         });
       
          var query = {number : number }
          
      var url = "{{route('seller.invoice.download.all')}}?" + $.param(query);
      window.open(url);
     
   }

</script>
@endsection