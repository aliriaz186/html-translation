@extends('frontend.layouts.app')
<style>
                    		     .w-40{
                    		       width:45% !important;
                    		     }
                    			.progress_status ul li{
					    margin-left: -87%;
					    text-align: center;
                    			}
                    			.down_arrow{
                    			font-size:2rem !important;
                    			}
                    		</style>
@section('content')

    <section class="gry-bg py-4 profile">
        <div class="container">
            <div class="row cols-xs-space cols-sm-space cols-md-space">
                <div class="col-lg-12 mx-auto">
                    <div class="main-content">
                        <!-- Page title -->
                        <div class="page-title">
                            <div class="row align-items-center">
                                <div class="col-md-12">
                                    <h2 class="heading heading-2 text-center text-capitalize strong-600 mb-0">
                                        {{__('Track Order')}}
                                    </h2>
                                    <p class="text-center">
                                       {{__('Need the status of your shipment or a proof of delivery? Enter your order number or tracking number below in the relevant field.')}}
                                    </p>
                                </div>
                            </div>
                        </div>


                        <form class="" action="{{ route('orders.track') }}" method="GET" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-12">

                                    <div class="form-box bg-white mt-4">
                                        <div class="form-box-title px-3 py-2">
                                            {{__('Order Info')}}
                                        </div>
                                        <div class="form-box-content p-3">
                                            <div class="row">
                                                <div class="col-md-5">
                                                 <input type="text" class="form-control mb-3" placeholder="{{__('Order Code')}}" name="order_code" value="@isset($order_code) {{$order_code}} @endisset">
                                                   </div>
                                                <div class="col-md-1 text-center mt-2">
                                                     {{__('OR')}}
                                                </div>
                                                <div class="col-md-5">
                                                        <input type="text" class="form-control mb-3" placeholder="{{__('Tracker No')}}" value="@isset($tracking_number) {{$tracking_number}} @endisset" name="tracking_number" >
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="text-right mt-4">
                                <button type="submit" class="btn btn-styled btn-base-1">{{__('Track')}}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @if(isset($order_code) || isset($tracking_number))
               <div class="card mt-4">
                <div class="card-body p-4">
                    <div class="row">
                    <div class="col-md-12">
                           @php  $status = $order->orderDetails[0]->delivery_status;@endphp
                    		
                    	<p class="text-center">{{__('Order ID: ')}} {{$order->code}}</p>
                    </div>	
            	      <div class="col-md-6 text-left">
            	         @foreach($order->orderDetails as $orderDetail)
            	         <p>{{$orderDetail->product->name}}</p>
            	         @endforeach
                      </div>
                      <div class="col-md-12">
                        <div class="offset-md-5 pl-3">
                          <div class="col-md-5 progress_status">
                          
                    		<p class="text-center border p-1 w-40 font-weight-bold">{{__('Order Status')}}</p>
                    		<ul>
                    		   <li>
                    		      <p class="down_arrow">&#8595;</p>
                    		      <p class="font-weight-bold">Order Placed</p>
                    		      <p>{{__('Order successfully placed and currently in progress on ')}} {{$order->orderDetails[0]->created_at->format('d-m-Y @ H:i:s')}}</p>
                    		      <p class="down_arrow">&#8595;</p>
                    		   </li>
                    		   <li>
	                               <p class="font-weight-bold">Pending</p>
	                    	       <p>{{__('Order placed successfully and awaiting shipment confirmation.')}}</p>
                    		   </li>
                    		   @if($status == 'delivered' || $status == 'returned' || $status == 'refunded' || $status == 'cancelled'  )
                    		   <li>
	                    	       <p class="down_arrow">&#8595;</p>
                    		       <p class="font-weight-bold">{{ucfirst($status)}}</p>
                    		       <p>{{__('Your order has been successfully packed and dispatched on')}}  {{$order->orderDetails[0]->updated_at->format('d-m-Y @ H:i:s')}}</p>
                    		   </li>
                    		   @endif
                    		</ul>
                    	  </div>
                    	</div>  
                    </div>
                    </div>
                </div>
               </div>  
               
               @endif           
        </div>
    </section>

@endsection
