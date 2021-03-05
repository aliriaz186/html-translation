@extends('frontend.layouts.app') @section('content')

<style>.font-size-9px{font-size:9px}</style>
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<section class="gry-bg profile">
	<div class="container-fluid p-4">
		<div class="row cols-xs-space cols-sm-space cols-md-space">
			<div class="sidebar-left d-none d-lg-block z-index-above">@include('frontend.inc.seller_side_nav')</div>
			<div class="wrapper  z-index-below">
				<!-- Page title -->
				<div class="page-title">
					<div class="row align-items-center">
						<div class="col-md-6">
							<div id="hamburger-side-nav" class="navbar-light category-menu-icon nav-side text-center pull-right  d-flex justify-content-center align-items-center position-absolute ">
								<span class="navbar-toggler-icon"></span>
							</div>
							<h2 class="heading heading-6 text-capitalize strong-600 mb-0 pl-5">
			                                {{__('Account Health')}}
			                            </h2>
						</div>
						<div class="col-md-6">
							<div class="float-md-right">
								<ul class="breadcrumb">
									<li>
										<a href="{{ route('home') }}">{{__('Home')}}</a>
									</li>
									<li class="active">
										<a href="{{ route('accountHealth') }}">{{__('Account Health')}}</a>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
				<div class="row m-1 bg-white p-3">
					<div class="col-lg-8">
						<button type="button" onclick="calendar('day')" class="btn btn-primary btn-sm text-white mr-1">{{__('Day')}}</button>
						<button type="button" onclick="calendar('month')" class="btn btn-primary btn-sm text-white mr-1">{{__('Month')}}</button>
						<button type="button" onclick="calendar('year')" class="btn btn-primary btn-sm text-white mr-1">{{__('Year')}}</button>
						<button type="button" onclick="calendar('last_day')" class="btn btn-primary btn-sm text-white mr-1">{{__('Day-1')}}</button>
						<button type="button" onclick="calendar('last_month')" class="btn btn-primary btn-sm text-white mr-1">{{__('Month-1')}}</button>
						<button type="button" onclick="calendar('last_year')" class="btn btn-primary btn-sm text-white mr-1">{{__('Year-1')}}</button>
					</div>
					<div class="col-lg-4">
						<div id="reportrange" class="cursor pull-right p-1">
							<i class="fa fa-calendar"></i>&nbsp;
                            
							<span></span>
							<i class="fa fa-caret-down"></i>
						</div>
					</div>
				</div>
				<div class="mt-3">
					<div class="row">
						<div class="col-md-3">
							<div class="seller-top-products-box bg-white sidebar-box mb-3">
								<div class="box-title">
                                        {{__('ACTIVITY OVERVIEW')}}
                                    </div>
								<div class="box-content">
									<div class="row p-2">
										<div class="col-md-10">
											<a href="">Online Visitors</a>
											<small class="text-muted">
												<br>
                                                  in the last 30 minutes
                                                
												</small>
											</div>
											<div class="col-md-2">
												<span class="data_value size_xxl">
													<span class="heading-4">{{count(App\Visitors::all())}}</span>
												</span>
											</div>
										</div>
										<div class="row p-2 border-top">
											<div class="col-md-10">
												<a href="">Active Shopping Carts</a>
												<small class="text-muted">
													<br>
                                                  in the last 30 minutes
                                                
													</small>
												</div>
												<div class="col-md-2">
													<span class="data_value size_xxl">
                                                @php
                                                   $cart = 0;
                                                   $carts = App\Cart::all();
                                                   foreach($carts as $inner_cart){
                                                     if($inner_cart->product->seller == Auth::user()->id){
                                                        $cart++;
                                                     }
                                                   }
                                                @endphp
                                                    
														<span class="heading-4">{{$cart}}</span>
													</span>
												</div>
											</div>
											<div class="row border-bottom border-top">
												<div class="col-md-12">
													<section>
														<header class="bg-primary text-white mt-2 mb-2 p-1">
															<i class="icon-time"></i> Currently Pending
														</header>
														<ul class="data_list">
                                                      @php
                                                      $order = DB::table('orders')
                                                        ->orderBy('code', 'desc')
                                                        ->join('order_details', 'orders.id', '=', 'order_details.order_id')
                                                        ->where('order_details.seller_id', Auth::user()->id)
                                                        ->where('orders.viewed', 0)
                                                        ->select('orders.id')
                                                        ->distinct()
                                                        ->count();

                                                    $abandoned_carts= 0;
                                                    $users = App\User::all();
                                                    foreach($users as $user){$carts = json_decode($user->cart);
                                                    if($carts){foreach($carts as $key=>$cart){if($cart){$c = json_decode($cart); $seller = App\Product::findOrFail($c->id)->user_id;if($seller == Auth::user()->id){$abandoned_carts++;} } } } }
                                                        $stock= 0;
                                                        $conversation_sent = \App\Conversation::where('sender_id', Auth::user()->id)->where('sender_viewed', 0)->get();
                                                        $conversation_recieved = \App\Conversation::where('receiver_id', Auth::user()->id)->where('receiver_viewed', 0)->get();
                                                        $dispute_sent = \App\Dispute::where('sender_id', Auth::user()->id)->where('sender_viewed', 0)->get();
                                                        $dispute_recieved = \App\Dispute::where('receiver_id', Auth::user()->id)->where('receiver_viewed', 0)->get();
                                                       @endphp
                                                      
															<li>
																<span class="data_label">
																	<a href="{{route('orders.index')}}">Orders</a>
																</span>
																<span class="pull-right heading-6">
																	<span id="pending_orders">{{$order}}</span>
																</span>
															</li>
															<li>
																<span class="data_label">
																	<a href="{{route('orders.return_requests')}}">Return/Exchanges</a>
																</span>
																<span class="pull-right heading-6">
																	<span id="return_exchanges">{{ \App\RequestsNotification::where(['type' => 'return', 'seller_id' => Auth::user()->id])->count() }}</span>
																</span>
															</li>
															<li>
																<span class="data_label">
																	<a href="">Abandoned Carts</a>
																</span>
																<span class="pull-right heading-6">
																	<span id="abandoned_cart">{{$abandoned_carts}}</span>
																</span>
															</li>
															<li>
																<span class="data_label">
																	<a href="">Out of Stock Products</a>
																</span>
																<span class="pull-right heading-6">
																	<span id="products_out_of_stock">{{$stock}}</span>
																</span>
															</li>
														</ul>
													</section>
												</div>
											</div>
											<section id="dash_notifications" class="">
												<header class="bg-primary text-white mt-2 mb-2 p-1">
													<i class="icon-exclamation-sign"></i> Notifications
												</header>
												<ul class="data_list">
													<li>
														<span class="data_label">
															<a href="{{route('conversations.index')}}">Conversations</a>
														</span>
														<span class="pull-right heading-6">
															<span id="pending_orders">{{ count($dispute_sent)+count($dispute_recieved) }}</span>
														</span>
													</li>
													<li>
														<span class="data_label">
															<a href="{{route('disputes.index')}}">Disputes</a>
														</span>
														<span class="pull-right heading-6">
															<span id="return_exchanges">{{ count($dispute_sent)+count($dispute_recieved) }}</span>
														</span>
													</li>
													<li>
														<span class="data_label">
															<a href="{{route('product_query.index')}}">Product Query</a>
														</span>
														<span class="pull-right heading-6">
															<span id="abandoned_cart">{{App\ProductQuery::where('seller_id',Auth::user()->id)->where('is_viewed',1)->count()}}</span>
														</span>
													</li>
												</ul>
											</section>
											<section id="dash_notifications" class="">
												<header class="bg-primary text-white mt-2 mb-2 p-1">
													<i class="icon-exclamation-sign"></i> Wishlist
												</header>
												<ul class="data_list_vertical">
													<li>
														<span class="data_label">
															<a href="index.php?controller=AdminCustomerThreads&amp;token=0b4bf8775e8e018a83039097a4115501">Total Wishlist</a>
														</span>
														<span class="data_value size_l">
                                                             @php  $products= App\Wishlist::all(); $wishlist=0;foreach($products as $product){if($product->seller_id == Auth::user()->id){$wishlist++;}} @endphp         
															<span id="new_messages" class="text-center">{{$wishlist}}</span>
														</span>
													</li>
												</ul>
											</section>
											<section id="dash_notifications" class="">
												<ul class="data_list_vertical">
													<li>
														<a href="{{route('seller.flashDeal')}}" class="btn btn-primary btn-block mb-1">Create Flash Deals</a>
													</li>
													<li>
														<a href="{{route('create-coupons')}}" class="btn btn-secondary btn-block mb-1">Create Coupon</a>
													</li>
													<li>
														<a href="{{route('submit-offers')}}" class="btn btn-warning text-white btn-block">Submit Offers</a>
													</li>
												</ul>
											</section>
										</div>
									</div>
								</div>
								<div class="col-lg-6">
									<div class="seller-top-products-box bg-white sidebar-box mb-3">
										<div class="box-title"> {{__('Dashboard')}} </div>
                                    @php
                                    $thisMonthSales = 0;   $totalAmountSold = 0;   $lastMonthSold = 0; $earning = 0;
                                    $totalAmountSoldData = \App\OrderDetail::where('seller_id', Auth::user()->id)->get();
                                    $lastMonthSoldData = \App\OrderDetail::where('seller_id', Auth::user()->id)->whereMonth('created_at', Carbon\Carbon::now()->subMonth())->get();
                                    $thisMonthSalesData = \App\OrderDetail::where('seller_id', Auth::user()->id)->where('created_at', '>=', date('-30d'))->get();

                                   $orderDetails = \App\OrderDetail::where('seller_id', Auth::user()->id)->get();
                                   $total_sales = 0;
                                   $pending=0;

                                    foreach ($orderDetails as $key => $orderDetail) { if($orderDetail->order->payment_status == 'paid'){$total_sales += ($orderDetail->price  + $orderDetail->shipping_cost); }}
                                    foreach ($lastMonthSoldData as $key => $orderDetail) {if($orderDetail->order->payment_status == 'paid'){  $lastMonthSold += ($orderDetail->price  + $orderDetail->shipping_cost);  } }
			            foreach ($thisMonthSalesData as $key => $orderDetail) { if($orderDetail->order->payment_status == 'paid'){if(($orderDetail->delivery_status == 'canceled' || $orderDetail->delivery_status == 'returned' ||$orderDetail->delivery_status == 'refunded') &&  $orderDetail->order->payment_type == 'cash_on_delivery'){$thisMonthSales = $thisMonthSales;}else{$thisMonthSales += ($orderDetail->price + $orderDetail->shipping_cost); }} }

                                    $availableBalance = count(\App\OrderDetail::where('seller_id', Auth::user()->id)->where('delivery_status', 'cancelled')->get());
                                    $refundedAmount = count(\App\OrderDetail::where('seller_id', Auth::user()->id)->get());
                                    $commission =  App\BusinessSetting::where('type','vendor_commission')->first('value');
                                    $commission_pay =  App\BusinessSetting::where('type','payment_commission')->first('value');
                                    $pendingBalances = App\OrderDetail::where('seller_id',Auth::user()->id)->where('delivery_status','!=','delivered')->where('delivery_status','!=','refunded')->where('delivery_status','!=','returned')->where('delivery_status','!=','cancelled') ->get();

	                             foreach($pendingBalances as $balance){ $pending+= ($balance->price + $balance->shipping_cost + $balance->commission);}
                                $admin_to_pay_extra = App\Seller::findOrFail(Auth::user()->id)->admin_to_pay_extra;
                                foreach(\App\OrderDetail::where('seller_id', Auth::user()->id)->where('delivery_status','!=','returned')->where('delivery_status','!=','refunded')->where('delivery_status','!=','pending')->get() as $orderDetail){$earning+= ($orderDetail->price+$orderDetail->shipping_cost + $orderDetail->tax + $orderDetail->commission + $admin_to_pay_extra); }

                           @endphp
                                    
										<div class="box-content">
											<div class="row p-1">
												<div class="col-md-3 border text-center">
													<p>{{single_price($total_sales)}}</p>
													<span class="font-size-9px">  {{__('Total Amount Sold')}}</span>
												</div>
												<div class="col-md-3 border text-center">
													<p>{{single_price($lastMonthSold)}}</p>
													<span class="font-size-9px">  {{__('Last Month Sales')}}</span>
												</div>
												<div class="col-md-3 border text-center">
													<p>{{single_price($thisMonthSales)}}</p>
													<span class="font-size-9px">  {{__('This Month Sales')}}</span>
												</div>
												<div class="col-md-3 border text-center">
													<p>{{ single_price($earning) }}</p>
													<span class="font-size-9px">  {{__('Total Earnings')}}</span>
												</div>
											</div>                      
											<div class="row p-1">
												<div class="col-md-3 border text-center">
													<p>{{ $refundedAmount }}</p>
													<span class="font-size-9px">  {{__('Refunded Amount')}}</span>
												</div>
												<div class="col-md-3 border text-center">
													<p>{{number_format($pending,2)}}</p>
													<span class="font-size-9px">  {{__('Current Balance')}}</span>
												</div>
												<div class="col-md-3 border text-center">
													<p>{{number_format(Auth::user()->seller->available_balance + Auth::user()->seller->admin_to_pay_extra,2)}}</p>
													<span class="font-size-9px">  {{__('Available Balance')}}</span>
												</div>
						                                                    @php
						                                                    $commission=0;
						                                                        foreach(App\OrderDetail::where('seller_id',Auth::user()->id)->get() as $orderDetail){
						                                                            $commission+=$orderDetail->commission;
						                                                        }
						                                                    @endphp
						                                                
												<div class="col-md-3 border text-center">
													<p>{{single_price(abs($commission))}}</p>
													<span class="font-size-9px">  {{__('Total Fees')}}</span>
												</div>
											</div>
										</div>
									</div>
									<div class="seller-top-products-box bg-white sidebar-box mb-3">
										<div class="box-content">
											<select class="pull-right border" onchange="chartTypeChange(this)">
												<option value="line">{{__('Line')}}</option>
												<option value="bar">{{__('Bar')}}</option>
												<option value="radar">{{__('Radar')}}</option>
												<option value="pie">{{__('Pie')}}</option>
												<option value="polar">{{__('Polar')}}</option>
											</select>
											<canvas id="canvas" width="600" height="400"></canvas>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="seller-top-products-box bg-white sidebar-box mb-3 text-center ">
												<div class="box-title">{{__('Selling Limit')}}</div>
												<div class="box-content text-center heading-4 font-weight-bold">
	                                          {{currency_symbol()}}{{(Auth::user()->seller->max_limit)}}k
	                                      </div>
											</div>
										</div>
										<div class="col-md-6">
											<div class="seller-top-products-box bg-white sidebar-box mb-3 text-center ">
												<div class="box-title">{{__('Request an Increase')}} </div>
												<div class="box-content text-center">
													@if(!App\PermissionLimit::where('user_id',Auth::user()->id)->first())
                                                        <button class="btn btn-primary text-white btn-sm"  data-toggle="modal" data-target="#request_permission" >{{__('Increase Limit')}}</button>
                                                    @else 
                                                        <button class="btn btn-primary text-white btn-sm" disabled >{{__('Increase Limit')}}</button>
                                                    @endif
                                                </div>
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-3">
									<div class="seller-top-products-box bg-white sidebar-box mb-3">
										<div class="box-title">{{__('Top Selling Products')}} </div>
										<div class="box-content">
                                            @foreach (filter_products(\App\Product::where('user_id', Auth::user()->id)->orderBy('num_of_sale', 'desc'))->limit(7)->get() as $key => $top_product)
                                                <div class="mb-3 product-box-3">
                                                    <div class="clearfix">
                                                        <div class="product-image float-left">
                                                            <a href="{{ route('product', $top_product->slug) }}">
                                                                <img class="img-fit lazyload" src="{{ asset('frontend/images/placeholder.jpg') }}" data-src="{{ asset($top_product->thumbnail_img) }}" alt="{{ __($top_product->name) }}">
                                                            </a>
                                                        </div>
                                                        <div class="product-details float-left">
                                                            <h4 class="title text-truncate">
                                                                <a href="{{ route('product', $top_product->slug) }}" class="d-block">{{ $top_product->name }}</a>
                                                            </h4>
                                                            <div class="star-rating star-rating-sm mt-1">{{ renderStarRating($top_product->rating) }}  </div>
                                                            <div class="price-box">
                                                                <span class="product-price strong-600">{{ home_discounted_base_price($top_product->id) }}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<div class="seller-top-products-box bg-white sidebar-box mb-3">
											<div class="box-title">{{__('Transactions')}}</div>
											<div class="box-content">
												<table class="table table-bordered table-stripped">
													<thead>
														<th>{{__('Date')}}</th>
														<th>{{__('Transaction Type')}}</th>
														<th>{{__('Order ID')}}</th>
														<th>{{__('Product Details')}}</th>
														<th>{{__('Product Cost')}}</th>
														<th>{{__('Shipping Cost')}}</th>
														<th width="10%">{{__('Fees')}}</th>
														<th>{{__('Total')}}</th>
														<th>{{__('Earnings')}}</th>
													</thead>
													<tbody>
                                                    @foreach ($orders as $order)
                                                        <tr>
                                                            <td>{{$order->created_at->format('d-m-y')}}</td>
                                                            <td>{{'Sale'}}</td>
                                                            <td><a onclick="show_order_details({{ $order->id }})" href="#{{ $order->code }}">{{$order->code}}</a></td>
                                                            <td>{{Illuminate\Support\Str::limit($order->product->name,35,'...')}}</td>
                                                            <td>{{single_price($order->price)}}</td>
                                                            <td>{{single_price($order->shipping_cost)}}</td>
                                                            <td>-{{single_price(abs($order->commission))}} </td>
                                                            <td>{{single_price($order->price + $order->tax + $order->shipping_cost)}}</td>
                                                            <td>{{ single_price($order->price + $order->tax + $order->shipping_cost + $order->commission)}}</td>
                                                        </tr>
                                                    @endforeach
													</tbody>
												</table>
												<div class="clearfix">
													<div class="pull-right">
                                                        {{ $orders->links() }}
                                                    </div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
   
    
<!-- Modal -->
<div class="modal fade" id="request_permission" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
    <form action="{{route('request-permission-limit')}}" method="POST">  
       @csrf
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Request Permission</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="orders">Total Orders</label>
                    <input type="number" id="orders" class="form-control" readonly name="orders" value="{{App\OrderDetail::where('seller_id',Auth::user()->id)->count()}}">
                </div>
                <div class="form-group">
                    <label for="limit">Total Limit</label>
                    <input type="number" id="limit" class="form-control" readonly name="max_limit" value="{{Auth::user()->seller->max_limit}}">
                </div>
                <div class="form-group">
                    <label for="message">Message</label>
                    <textarea name="message" class="form-control" id="message" cols="30" rows="10"></textarea>
                </div>    
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Send</button>
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
    @endsection

				<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
    @section('script')
<script>
    var type = 'line';
    var main_start = 0;
    var main_end = 0;

    window.onload = function() {
        calendar('month',type);
};


function MakeChart(type ,labels  , data  ,canvas_id){
    var ctx = document.getElementById('canvas').getContext('2d');

    var myChart = new Chart(ctx, {
        type: type,
        data: getData(labels,data),
        options: getOption('Total Orders: ' , 'Date: ')
    });
}

  function chartTypeChange(el){
      type = el.value;

      var start = main_start;
        var end = main_end;

        function cb(start, end) {
            range = start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY');
            start = start.format('MMMM D, YYYY') ;
            end = end.format('MMMM D, YYYY');

            $.get('{{ route('account-health-line-chart') }}', {_token: '{{ csrf_token()}}',  start:start,end:end }, function(data){MakeChart(type,data.dates,data.product_total_sales,type);});
            $('#reportrange span').html(start + ' - ' + end);
        }

        $('#reportrange').daterangepicker({startDate: start,endDate: end}, cb);
         cb(start, end);

  }

function getData(labels,data)
{
  return {
            labels: labels,
            datasets: [{
                label: 'Product / Total Orders',
                data:data,
                backgroundColor: [
                    'rgba(0, 123, 255, 1)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(0, 123, 255, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        };
}

function getOption(x , y){
  return  {
            showTooltips: true,
            tooltips: {
                callbacks: {
                    label: function(tooltipItems, data) {
                        return  x + tooltipItems.yLabel;
                    },
                    title: function(tooltipItems, data) {
                        return y + tooltipItems[0].xLabel;
                }
                }
            },
            scales: {
            yAxes: [{
                ticks: {
                    suggestedMin: 0,
                    stepSize: 1
                }
            }],
            xAxes: [{
                ticks: {
                    autoSkip: false,
                    maxRotation: 90,
                    minRotation: 90
                }
            }]
        }
};
}

    $(function() {

        var start = moment().clone().startOf('month');
        var end = moment();

        function cb(start, end) {
            range = start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY');
            start = start.format('MMMM D, YYYY') ;
            end = end.format('MMMM D, YYYY');

            $.get('{{ route('account-health-line-chart') }}', {_token: '{{ csrf_token()}}',  start:start,end:end }, function(data){MakeChart(type,data.dates,data.product_total_sales,type);});
            $('#reportrange span').html(start + ' - ' + end);
        }

        $('#reportrange').daterangepicker({startDate: start,endDate: end}, cb);
         cb(start, end);

    });

   function calendar(date,type){
       start = '';
       end = '';
       if(date=='day'){start = moment(); end = moment();}
       else if(date=='month'){start = moment().clone().startOf('month'); end = moment();}
       else if(date=='year'){ start = moment().clone().startOf('year'); end = moment(); }
       else if(date=='last_day'){start = moment().subtract(1, 'days');  end = moment();}
       else if(date=='last_month'){start = moment().subtract(1, 'months'); end = moment();}
       else if(date=='last_year'){start = moment().subtract(1,"year").add(1,"day"); end = moment();}

        main_start = start;
        main_end = end;

        start = start.format('MMMM D, YYYY');
        end = end.format('MMMM D, YYYY');


        $.get('{{ route('account-health-line-chart') }}', {_token: '{{ csrf_token()}}', start:start , end:end }, function(data){
            MakeChart(type,data.dates,data.product_total_sales,type);
        });

            $('#reportrange span').html(start + ' - ' + end);

    };


    //open_side_nav();

</script>

@endsection
