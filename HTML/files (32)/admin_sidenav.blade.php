
<nav id="mainnav-container">
    <div id="mainnav">

        <!--Menu-->
        <!--================================-->
        <div id="mainnav-menu-wrap">
            <div class="nano">
                <div class="nano-content">
			  <div class="px-20px mb-3">
			       <a class="mainnav-toggle" href="#">
			        <i class="fa fa-search" id="search_icon"></i>
			       </a> 
		                <input class="form-control bg-soft-secondary border-0 form-control-sm text-white" type="text" name="" placeholder="Search in menu" style="width: 90%;margin-left: 10px;" id="menu-search" onkeyup="menuSearch()">
		           </div>

                    <div id="mainnav-shortcut" class="hidden">
                        <ul class="list-unstyled shortcut-wrap">
                            <li class="col-xs-3" data-content="My Profile">
                                <a class="shortcut-grid" href="#">
                                    <div class="icon-wrap icon-wrap-sm icon-circle bg-mint">
                                    <i class="demo-pli-male"></i>
                                    </div>
                                </a>
                            </li>
                            <li class="col-xs-3" data-content="Messages">
                                <a class="shortcut-grid" href="#">
                                    <div class="icon-wrap icon-wrap-sm icon-circle bg-warning">
                                    <i class="demo-pli-speech-bubble-3"></i>
                                    </div>
                                </a>
                            </li>
                            <li class="col-xs-3" data-content="Activity">
                                <a class="shortcut-grid" href="#">
                                    <div class="icon-wrap icon-wrap-sm icon-circle bg-success">
                                    <i class="demo-pli-thunder"></i>
                                    </div>
                                </a>
                            </li>
                            <li class="col-xs-3" data-content="Lock Screen">
                                <a class="shortcut-grid" href="#">
                                    <div class="icon-wrap icon-wrap-sm icon-circle bg-purple">
                                    <i class="demo-pli-lock-2"></i>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <!--================================-->
                    <!--End shortcut buttons-->

			<ul class="list-group" id="search-menu">
            		</ul>
                    <ul id="mainnav-menu" class="list-group">


                        <li class="{{ areActiveRoutes(['admin.dashboard'])}}">
                            <a class="nav-link" href="{{route('admin.dashboard')}}">
                                <i class="fa fa-home"></i>
                                <span class="menu-title">{{__('Dashboard')}}</span>
                            </a>
                        </li>

                        @if (\App\Addon::where('unique_identifier', 'pos_system')->first() != null && \App\Addon::where('unique_identifier', 'pos_system')->first()->activated)

                            <li class="{{ areActiveRoutes(['poin-of-sales.index', 'poin-of-sales.create'])}}">
                                <a class="nav-link" href="{{ route('poin-of-sales.index') }}">
                                    <i class="fa fa-print"></i>
                                    <span class="menu-title">{{__('POS Manager')}}</span>
                                </a>
                            </li>

                        @endif

                        <!-- Product Menu -->
                        @if(permission_check_all('products') || permission_check_get('products') || permission_check_put('products') || permission_check_delete('products') || permission_check_post('products'))

                            <li>
                                <a href="#">
                                    <i class="fa fa-shopping-cart"></i>
                                    <span class="menu-title">{{__('Products')}}</span>
                                    <i class="arrow"></i>
                                </a>


                                <ul class="collapse">
                                    @if(permission_check_all('brands') || permission_check_get('brands') || permission_check_put('brands') || permission_check_delete('brands') || permission_check_post('brands'))
                                        <li class="{{ areActiveRoutes(['brands.index', 'brands.create', 'brands.edit'])}}">
                                            <a class="nav-link" href="{{route('brands.index')}}">
                                                <span class="menu-title">{{__('Brand')}}</span>
                                            </a>
                                    @endif
                                    @if(permission_check_all('inhouse_products') || permission_check_get('inhouse_products') || permission_check_put('inhouse_products') || permission_check_delete('inhouse_products') || permission_check_post('inhouse_products'))
                                    <li class="{{ areActiveRoutes(['products.admin', 'products.create', 'products.admin.edit'])}}">
                                            <a class="nav-link" href="{{route('products.admin')}}">
                                                <span class="menu-title">{{__('In House Products')}}</span>
                                            </a>
                                    </li>
                                    @endif
                                    @if(permission_check_all('products') || permission_check_get('products') || permission_check_put('products') || permission_check_delete('products') || permission_check_post('products'))
                                        @if(\App\BusinessSetting::where('type', 'vendor_system_activation')->first()->value == 1)
                                            <li class="{{ areActiveRoutes(['products.seller', 'products.seller.edit'])}}">
                                                <a class="nav-link" href="{{route('products.seller')}}">
                                                    <span class="menu-title">{{__('Seller Products')}}</span>
                                                </a>
                                            </li>
                                        @endif
                                    @endif
                                    @if(permission_check_all('products') || permission_check_get('products') || permission_check_put('products') || permission_check_delete('products') || permission_check_post('products'))
                                        @if(\App\BusinessSetting::where('type', 'vendor_system_activation')->first()->value == 1)
                                            <li class="{{ areActiveRoutes(['products.seller', 'products.seller.edit'])}}">
                                                <a class="nav-link" href="{{route('products.seller')}}">
                                                    <span class="menu-title">{{__('Wholesale Products')}}</span>
                                                </a>
                                            </li>
                                        @endif
                                    @endif
                                    @if(permission_check_all('customer_products') || permission_check_get('customer_products') || permission_check_put('customer_products') || permission_check_delete('customer_products') || permission_check_post('customer_products'))
                                        @if(\App\BusinessSetting::where('type', 'classified_product')->first()->value == 1)
                                            <li class="{{ areActiveRoutes(['classified_products'])}}">
                                                <a class="nav-link" href="{{route('classified_products')}}">
                                                    <span class="menu-title">{{__('Classified Product')}}</span>
                                                </a>
                                            </li>
                                        @endif
                                    @endif
                                    @if(permission_check_all('bulk_upload') || permission_check_get('bulk_upload') || permission_check_put('bulk_upload') || permission_check_delete('bulk_upload') || permission_check_post('bulk_upload'))
                                        <li class="{{ areActiveRoutes(['product_bulk_upload.index'])}}">
                                            <a class="nav-link" href="{{route('product_bulk_upload.index')}}">
                                                <span class="menu-title">{{__('Bulk Import')}}</span>
                                            </a>
                                        </li>
                                        <li class="{{ areActiveRoutes(['product_bulk_export.export'])}}">
                                            <div @if(permission_check_get('app')) @endif></div>
                                            <a class="nav-link" href="{{route('product_bulk_export.index')}}">
                                                <span class="menu-title">{{__('Bulk Export')}}</span>
                                            </a>
                                        </li>
                                    @endif

                                    @if(permission_check_all('reviews') || permission_check_get('reviews') || permission_check_put('reviews') || permission_check_delete('reviews') || permission_check_post('reviews'))
                                        @php
                                            $review_count = DB::table('reviews')
                                                        ->orderBy('code', 'desc')
                                                        ->join('products', 'products.id', '=', 'reviews.product_id')
                                                        ->where('products.user_id', Auth::user()->id)
                                                        ->where('reviews.viewed', 0)
                                                        ->select('reviews.id')
                                                        ->distinct()
                                                        ->count();
                                        @endphp
                                        <li class="{{ areActiveRoutes(['reviews.index'])}}">
                                            <a class="nav-link" href="{{route('reviews.index')}}">
                                                <span class="menu-title">{{__('Product Reviews')}}</span> @if($review_count > 0)<span class="pull-right badge badge-info">{{ $review_count }}</span>@endif
                                            </a>
                                        </li>
                                    @endif
                                    @if(permission_check_all('promotes') || permission_check_put('promotes') || permission_check_post('promotes') || permission_check_get('promotes') || permission_check_delete('promotes') )
                                        <li class="{{ areActiveRoutes(['promote'])}}">
                                            <a class="nav-link" href="{{ route('promote') }}">
                                            <span class="menu-title">{{__('Promote Products')}}</span>
                                            </a>
                                        </li>
                                    @endif
                                    @if(permission_check_all('product_buyer_tips') || permission_check_put('product_buyer_tips') || permission_check_post('product_buyer_tips') || permission_check_get('product_buyer_tips') || permission_check_delete('product_buyer_tips') )
                                        <li class="{{ areActiveRoutes(['products.buyer.tips.index'])}}">
                                            <a class="nav-link" href="{{ route('products.buyer.tips.index') }}">
                                            <span class="menu-title">{{__('Buyer Tips')}}</span>
                                            </a>
                                        </li>
                                    @endif
                                    @if(permission_check_all('product_tax') || permission_check_put('product_tax') || permission_check_post('product_tax') || permission_check_get('product_tax') || permission_check_delete('product_tax') )
                                        <li class="{{ areActiveRoutes(['tax.index'])}}">
                                            <a class="nav-link" href="{{ route('tax.index') }}">
                                            <span class="menu-title">{{__('Tax')}}</span>
                                            </a>
                                        </li>
                                    @endif

                                </ul>
                            </li>
                        @endif
                        @if(permission_check_all('categories') || permission_check_get('categories') || permission_check_put('categories') || permission_check_delete('categories') || permission_check_post('categories'))
                          <li>
                            <a href="#">
                                <i class="fa fa-list"></i>
                                <span class="menu-title">{{__('Category')}}</span>
                                <i class="arrow"></i>
                            </a>
                            <ul class="collapse">

                                <li class="{{ areActiveRoutes(['categories.index', 'categories.create', 'categories.edit'])}}">
                                    <a class="nav-link" href="{{route('categories.index')}}">
                                        <span class="menu-title">{{__('Category')}}</span>
                                    </a>
                                </li>
                                @if(permission_check_all('sub_categories') || permission_check_put('sub_categories'))
                                <li class="{{ areActiveRoutes(['subcategories.index', 'subcategories.create', 'subcategories.edit'])}}">
                                    <a class="nav-link" href="{{route('subcategories.index')}}">
                                        <span class="menu-title">{{__('Subcategory')}}</span>
                                    </a>
                                </li>
                                @endif
                                @if(permission_check_all('sub_sub_categories') || permission_check_put('sub_sub_categories') || permission_check_post('sub_sub_categories') || permission_check_get('sub_sub_categories') || permission_check_delete('sub_sub_categories') )
                                    <li class="{{ areActiveRoutes(['subsubcategories.index', 'subsubcategories.create', 'subsubcategories.edit'])}}">
                                        <a class="nav-link" href="{{route('subsubcategories.index')}}">
                                             <span class="menu-title">{{__('Sub Subcategory')}}</span>
                                        </a>
                                    </li>
                                @endif
                                @if(permission_check_all('permission_sellers') || permission_check_put('permission_sellers') || permission_check_post('permission_sellers') || permission_check_get('permission_sellers') || permission_check_delete('permission_sellers') )
                                <li class="{{ areActiveRoutes(['categories.permission.request'])}}">
                                    <a class="nav-link" href="{{route('categories.permission.request')}}">
                                        <span class="menu-title">{{__('Permission Request')}}</span>
                                    </a>
                                </li>
                                @endif
                            </ul>
                        </li>
                        @endif
			<!--Wholesale End -->
                     @if(permission_check_all('categories') || permission_check_get('categories') || permission_check_put('categories') || permission_check_delete('categories') || permission_check_post('categories'))
                        <li>
                          <a href="#">
                              <i class="fa fa-fax"></i>
                              <span class="menu-title">{{__('Classified Category')}}</span>
                              <i class="arrow"></i>
                          </a>
                          <ul class="collapse">

                              <li class="{{ areActiveRoutes(['classified_categories.index', 'classified_categories.create', 'classified_categories.edit'])}}">
                                  <a class="nav-link" href="{{route('classified_categories.index')}}">
                                    <span class="menu-title">{{__('Classified Category')}}</span>
                                </a>
                              </li>
                              @if(permission_check_all('classified_sub_categories') || permission_check_put('classified_sub_categories'))
                              <li class="{{ areActiveRoutes(['classified_subcategories.index', 'classified_subcategories.create', 'classified_subcategories.edit'])}}">
                                  <a class="nav-link" href="{{route('classified_subcategories.index')}}">
                                    <span class="menu-title">{{__('Classified Subcategory')}}</span>
                                </a>
                              </li>
                              @endif
                              @if(permission_check_all('classified_sub_sub_categories') || permission_check_put('classified_sub_sub_categories') || permission_check_post('classified_sub_sub_categories') || permission_check_get('classified_sub_sub_categories') || permission_check_delete('classified_sub_sub_categories') )
                                  <li class="{{ areActiveRoutes(['classified_subsubcategories.index', 'classified_subsubcategories.create', 'classified_subsubcategories.edit'])}}">
                                      <a class="nav-link" href="{{route('classified_subsubcategories.index')}}">
                                        <span class="menu-title">{{__('Classified Sub Subcategory')}}</span>
                                    </a>
                                  </li>
                              @endif
                              @if(permission_check_all('permission_classified_sellers') || permission_check_put('permission_classified_sellers') || permission_check_post('permission_classified_sellers') || permission_check_get('permission_classified_sellers') || permission_check_delete('permission_classified_sellers') )
                              <li class="{{ areActiveRoutes(['classified_categories.permission.request'])}}">
                                  <a class="nav-link" href="{{route('classified_categories.permission.request')}}">
                                    <span class="menu-title">{{__('Permission Classified Request')}}</span>
                                </a>
                              </li>
                              @endif
                              @if(permission_check_all('classified_seller_tips') || permission_check_put('classified_seller_tips') || permission_check_post('classified_seller_tips') || permission_check_get('classified_seller_tips') || permission_check_delete('permission_classified_sellers') )
                              <li class="{{ areActiveRoutes(['classified.seller.tips.index'])}}">
                                  <a class="nav-link" href="{{route('classified.seller.tips.index')}}">
                                    <span class="menu-title">{{__('Classified Seller Tips')}}</span>
                                </a>
                              </li>
                              @endif
                          </ul>
                      </li>
                      @endif

                        @if(permission_check_all('flash_deals') || permission_check_put('flash_deals') || permission_check_post('flash_deals') || permission_check_get('flash_deals') || permission_check_delete('flash_deals') )
                       <li class="{{ areActiveRoutes(['flash_deals.index', 'flash_deals.create', 'flash_deals.edit'])}}">
                            <a class="nav-link" href="{{ route('flash_deals.index') }}">
                                <i class="fa fa-bolt"></i>
                                <span class="menu-title">{{__('Flash Deal')}}</span>
                            </a>
                        </li>
                        @endif
                        @if(permission_check_all('orders') || permission_check_put('orders') || permission_check_post('orders') || permission_check_get('orders') || permission_check_delete('orders') )
                        @php
                            $orders = DB::table('orders')
                                        ->orderBy('code', 'desc')
                                        ->join('order_details', 'orders.id', '=', 'order_details.order_id')
                                        ->where('order_details.seller_id', \App\User::where('user_type', 'admin')->first()->id)
                                        ->where('orders.viewed', 0)
                                        ->select('orders.id')
                                        ->distinct()
                                        ->count();
                            @endphp
                        <li>
                            <a href="#">
                                <i class="fa fa-shopping-basket"></i>
                                 <span class="menu-title">{{__('Orders')}}</span>
                                <i class="arrow"></i>
                            </a>

                            <ul class="collapse">
                                <li class="{{ areActiveRoutes(['orders.index.admin', 'orders.show'])}}">
                                    <a class="nav-link" href="{{ route('orders.index.admin') }}" >
                                        <span class="menu-title">{{__('Inhouse Orders')}}</span>  @if($orders > 0)<span class="pull-right badge badge-info">{{ $orders }}</span>@endif
                                </a>
                                </li>
                                <li class="{{ areActiveRoutes(['orders.index.seller', 'orders.show'])}}">
                                    <a class="nav-link" href="{{route('orders.index.seller')}}">
                                        <span class="menu-title">{{__('Seller Orders')}}</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        @endif
                        @if(permission_check_all('pickup_points') || permission_check_put('pickup_points') || permission_check_post('pickup_points') || permission_check_get('pickup_points') || permission_check_delete('pickup_points') )
                        <li class="{{ areActiveRoutes(['pick_up_point.order_index','pick_up_point.order_show'])}}">
                            <a class="nav-link" href="{{ route('pick_up_point.order_index') }}">
                                <i class="fa fa-money"></i>
                                <span class="menu-title">{{__('Pick-up Point Order')}}</span>
                            </a>
                        </li>
                        @endif

                        @if(permission_check_all('referrals') || permission_check_put('referrals') || permission_check_post('referrals') || permission_check_get('referrals') || permission_check_delete('referrals') )
                        <li class="{{ areActiveRoutes(['referral.index', 'referral.edit', 'referral.create'])}}">
                            <a class="nav-link" href="{{ route('referral.index') }}">
                                <i class="fa fa-ticket"></i>
                                <span class="menu-title">{{__('Loyalty Points')}}</span>
                            </a>
                        </li>
                        @endif

                        @if(permission_check_all('cashbacks') || permission_check_put('cashbacks') || permission_check_post('cashbacks') || permission_check_get('cashbacks') || permission_check_delete('cashbacks') )
                        <li class="{{ areActiveRoutes(['cashbacks.index', 'cashbacks.edit', 'cashbacks.create'])}}">
                            <a class="nav-link" href="{{ route('cashbacks.index') }}">
                                <i class="fa fa-ticket"></i>
                                <span class="menu-title">{{__('Cashbacks')}}</span>
                            </a>
                        </li>
                        @endif

                        @if(permission_check_all('orders') || permission_check_put('orders') || permission_check_post('orders') || permission_check_get('orders') || permission_check_delete('orders') )
                        <li class="{{ areActiveRoutes(['sales.index', 'sales.show'])}}">
                            <a class="nav-link" href="{{ route('sales.index') }}">
                                <i class="fa fa-money"></i>
                                <span class="menu-title">{{__('Total sales')}}</span>
                            </a>
                        </li>
                        @endif

                        @if (\App\Addon::where('unique_identifier', 'refund_request')->first() != null)

                            <li>
                                <a href="#">
                                    <i class="fa fa-refresh"></i>
                                    <span class="menu-title">{{__('Refund Request')}}</span>
                                    <i class="arrow"></i>
                                </a>


                                <ul class="collapse">
                                    <li class="{{ areActiveRoutes(['refund_requests_all', 'reason_show'])}}">
                                        <a class="nav-link" href="{{route('refund_requests_all')}}"><span class="menu-title">{{__('Refund Requests')}}</span>
                                            @if(count(\App\RefundRequest::where('admin_seen',0)->get()) > 0)<span class="pull-right badge badge-info">{{ count(\App\RefundRequest::where('admin_seen',0)->get()) }}</span>@endif
                                        </a>
                                    </li>
                                    <li class="{{ areActiveRoutes(['paid_refund'])}}">
                                        <a class="nav-link" href="{{route('paid_refund')}}">
                                            <span class="menu-title">{{__('Approved Refund')}}</span>
                                        </a>
                                    </li>
                                    <li class="{{ areActiveRoutes(['refund_time_config'])}}">
                                        <a class="nav-link" href="{{route('refund_time_config')}}">
                                            <span class="menu-title">{{__('Refund Configuration')}}</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        @endif
                        @if(permission_check_all('sellers') || permission_check_put('sellers') || permission_check_post('sellers') || permission_check_get('sellers') || permission_check_delete('sellers') )
                         <li>
                            <a href="#">
                                <i class="fa fa-user-plus"></i>
                                <span class="menu-title">{{__('Sellers')}}</span>
                                <i class="arrow"></i>
                            </a>


                            <ul class="collapse">
                                <li class="{{ areActiveRoutes(['sellers.index', 'sellers.create', 'sellers.edit', 'sellers.payment_history','sellers.approved','sellers.profile_modal','returnAddress.adminInstruction','free_return.index','free_return.create','free_return.edit'])}}">
                                    @php
                                        $sellers = \App\Seller::where('verification_status', 0)->where('verification_info', '!=', null)->count();
                                        //$withdraw_req = \App\SellerWithdrawRequest::where('viewed', '0')->get();
                                    @endphp
                                    <a class="nav-link" href="{{route('sellers.index')}}">
                                        <span class="menu-title">{{__('Seller List')}}</span> @if($sellers > 0)<span class="pull-right badge badge-info">{{ $sellers }}</span> @endif</a>
                                </li>
                                <li class="{{ areActiveRoutes(['balance_all'])}}">
                                    <a class="nav-link" href="{{ route('balance_all') }}">
                                         <span class="menu-title">{{__('Seller Withdraw Requests')}}</span>
                                    </a>
                                </li>
                                <li class="{{ areActiveRoutes(['sellers.payment_histories'])}}">
                                    <a class="nav-link" href="{{ route('sellers.payment_histories') }}">
                                        <span class="menu-title">{{__('Seller Payments')}}</span>
                                    </a>
                                </li>
                                 @if(permission_check_all('business_settings') || permission_check_put('business_settings') || permission_check_post('business_settings') || permission_check_get('business_settings') || permission_check_delete('business_settings') )
                                    <li class="{{ areActiveRoutes(['business_settings.vendor_commission'])}}">
                                        <a class="nav-link" href="{{ route('business_settings.vendor_commission') }}">
                                            <span class="menu-title">{{__('Seller Commission')}}</span>
                                        </a>
                                    </li>
                                 @endif
                                @if(permission_check_all('sellers') || permission_check_put('sellers') || permission_check_post('sellers') || permission_check_get('sellers') || permission_check_delete('sellers') )
                                    <li class="{{ areActiveRoutes(['seller_verification_form.index'])}}">
                                        <a class="nav-link" href="{{route('seller_verification_form.index')}}">
                                             <span class="menu-title">{{__('Seller Verification Form')}}</span>
                                            </a>
                                    </li>
                                @endif
                                @if(permission_check_all('wallets') || permission_check_put('wallets') || permission_check_post('wallets') || permission_check_get('wallets') || permission_check_delete('wallets') )
                                    <li class="{{ areActiveRoutes(['sellers.wallet'])}}">
                                        <a class="nav-link" href="{{route('sellers.wallet')}}">
                                            <span class="menu-title">{{__('Seller Wallet')}}</span>
                                        </a>
                                    </li>
                                @endif
                                @if(permission_check_all('return_addres') || permission_check_put('return_addres') || permission_check_post('return_addres') || permission_check_get('return_addres') || permission_check_delete('return_addres') )
                                    <li class="{{ areActiveRoutes(['returnAddress.adminInstruction'])}}">
                                        <a class="nav-link" href="{{route('returnAddress.adminInstruction')}}">
                                             <span class="menu-title">{{__('Admin Return Instruction')}}</span>
                                        </a>
                                    </li>
                                @endif
                                @if(permission_check_all('return_policy_dates') || permission_check_put('return_policy_dates') || permission_check_post('return_policy_dates') || permission_check_get('return_policy_dates') || permission_check_delete('return_policy_dates') )
                                    <li class="{{ areActiveRoutes(['return_days.index','return_days.edit','return_days.create'])}}">
                                        <a class="nav-link" href="{{route('return_days.index')}}">
                                             <span class="menu-title">{{__('Admin Return Date')}}</span>
                                        </a>
                                    </li>
                                @endif
                                @if(permission_check_all('free_returns') || permission_check_put('free_returns') || permission_check_post('free_return') || permission_check_get('free_return') || permission_check_delete('return_policy_dates') )
                                    <li class="{{ areActiveRoutes(['free_return.index','free_return.edit','free_return.create'])}}">
                                        <a class="nav-link" href="{{route('free_return_days.index')}}">
                                            <span class="menu-title">{{__('Admin Free Return Date')}}</span>
                                        </a>
                                    </li>
                                 @endif

				               @if(permission_check_all('order_details') || permission_check_put('order_details') || permission_check_post('order_details') || permission_check_get('order_details') || permission_check_delete('order_details') )
                                    <li class="{{ areActiveRoutes(['seller.cancellation_requests'])}}">
                                        <a class="nav-link" href="{{route('seller.cancellation_requests')}}">
                                            <span class="menu-title">{{__('Cancellation')}}</span>
                                        </a>
                                    </li>
                                 @endif

  				                @if(permission_check_all('order_details') || permission_check_put('order_details') || permission_check_post('order_details') || permission_check_get('order_details') || permission_check_delete('order_details') )
                                    <li class="{{ areActiveRoutes(['seller.return_requests'])}}">
                                        <a class="nav-link" href="{{route('seller.return_requests')}}">
                                            <span class="menu-title">{{__('Returns')}}</span>
                                        </a>
                                    </li>
                                 @endif

   				                 @if(permission_check_all('order_details') || permission_check_put('order_details') || permission_check_post('order_details') || permission_check_get('order_details') || permission_check_delete('order_details') )
                                    <li class="{{ areActiveRoutes(['seller.refund_requests'])}}">
                                        <a class="nav-link" href="{{route('seller.refund_requests')}}">
                                            <span class="menu-title">{{__('Refunds')}}</span>
                                        </a>
                                    </li>
                                 @endif

                            </ul>
                        </li>
                        @endif

                        @if(permission_check_all('customers') || permission_check_put('customers') || permission_check_post('customers') || permission_check_get('customers') || permission_check_delete('customers') )
                        <li>
                            <a href="#">
                                <i class="fa fa-user-plus"></i>
                                <span class="menu-title">{{__('Customers')}}</span>
                                <i class="arrow"></i>
                            </a>


                            <ul class="collapse">
                                <li class="{{ areActiveRoutes(['customers.index'])}}">
                                    <a class="nav-link" href="{{ route('customers.index') }}"><span class="menu-title">{{__('Customers list')}}</span></a>
                                </li>
                                @if(permission_check_all('customer_packages') || permission_check_put('customer_packages') || permission_check_post('customer_packages') || permission_check_get('customer_packages') || permission_check_delete('customer_packages') )
                                <li class="{{ areActiveRoutes(['customer_packages.index','customer_packages.edit'])}}">
                                    <a class="nav-link" href="{{ route('customer_packages.index') }}"><span class="menu-title">{{__('Classified Packages')}}</span></a>
                                </li>
                                @endif
                                @if(permission_check_all('wallets') || permission_check_put('wallets') || permission_check_post('wallets') || permission_check_get('wallets') || permission_check_delete('wallets') )
                                    <li class="{{ areActiveRoutes(['customers.wallet'])}}">
                                        <a class="nav-link" href="{{route('customers.wallet')}}"><span class="menu-title">{{__('Customers Wallet')}}</span></a>
                                    </li>
                                 @endif
                            </ul>
                        </li>
                        @endif




                         @if(permission_check_all('shipping_apis') || permission_check_put('shipping_apis') || permission_check_post('shipping_apis') || permission_check_get('shipping_apis') || permission_check_delete('shipping_apis')  ||
                        permission_check_all('registered_companies') || permission_check_put('registered_companies') || permission_check_post('registered_companies') || permission_check_get('registered_companies') || permission_check_delete('registered_companies')||
                        permission_check_all('api_users') || permission_check_put('api_users') || permission_check_post('api_users') || permission_check_get('api_users') || permission_check_delete('api_users')
                        )
                          <li>
                              <a href="#">
                                  <i class="fa fa-user-plus"></i>
                                  <span class="menu-title">{{__('Api User')}}</span>
                                  <i class="arrow"></i>
                              </a>
                              <ul class="collapse">

                                @if(permission_check_all('api_users') || permission_check_put('api_users') || permission_check_post('api_users') || permission_check_get('api_users') || permission_check_delete('api_users'))
                                  <li class="{{ areActiveRoutes(['api_users'])}}">
                                      <a class="nav-link" href="{{ route('api-user.index') }}"> <span class="menu-title">{{__('Api Users List')}}</span></a>
                                  </li>
                                @endif
	                        @if(permission_check_all('registered_companies') || permission_check_put('registered_companies') || permission_check_post('registered_companies') || permission_check_get('registered_companies') || permission_check_delete('shipping_apis'))
	                              <li class="{{ areActiveRoutes(['admin.change-api'])}}">
	                                  <a class="nav-link" href="{{ route('admin.change-api') }}"> <span class="menu-title">{{__('Change Request')}}</span></a>
	                              </li>
	                        @endif
                                  @if(permission_check_all('shipping_apis') || permission_check_put('shipping_apis') || permission_check_post('shipping_apis') || permission_check_get('shipping_apis') || permission_check_delete('shipping_apis'))
                                              <li class="{{ areActiveRoutes(['shipping-api.index'])}}">
                                                  <a class="nav-link" href="{{ route('shipping-api.index') }}"> <span class="menu-title">{{__('Create Api')}}</span></a>
                                              </li>
                                  @endif
                                  @if(permission_check_all('registered_companies') || permission_check_put('registered_companies') || permission_check_post('registered_companies') || permission_check_get('registered_companies') || permission_check_delete('shipping_apis'))
                                              <li class="{{ areActiveRoutes(['admin.registered-company'])}}">
                                                  <a class="nav-link" href="{{ route('admin.registered-company') }}"> <span class="menu-title">{{__('Registered Compinies')}}</span></a>
                                              </li>
                                  @endif
                              </ul>
                          </li>
                          @endif



                        @if(permission_check_all('product_subscriptions') || permission_check_put('product_subscriptions') || permission_check_post('product_subscriptions') || permission_check_get('product_subscriptions') || permission_check_delete('product_subscriptions')
                       || permission_check_all('subscriptions_product_prices') || permission_check_put('subscriptions_product_prices') || permission_check_post('subscriptions_product_prices') || permission_check_get('subscriptions_product_prices') || permission_check_delete('subscriptions_product_prices') )

                        <li>
                            <a href="#">
                                <i class="fa fa-address-card"></i>
                                <span class="menu-title">{{__('Subscription')}}</span>
                                <i class="arrow"></i>
                            </a>


                            <ul class="collapse">
                                @if(permission_check_all('product_subscriptions') || permission_check_put('product_subscriptions') || permission_check_post('product_subscriptions') || permission_check_get('product_subscriptions') || permission_check_delete('product_subscriptions'))
                                        <li class="{{ areActiveRoutes(['subscription_list.index'])}}">
                                            <a class="nav-link" href="{{ route('subscription_list.index') }}"><span class="menu-title">{{__('All Subscriptions')}}</span></a>
                                        </li>
                                @endif

                                @if(permission_check_all('subscription_products_prices') || permission_check_put('subscription_products_prices') || permission_check_post('subscription_products_prices') || permission_check_get('subscription_products_prices') || permission_check_delete('subscription_products_prices') )
                                    <li class="{{ areActiveRoutes(['subscription_list.set'])}}">
                                        <a class="nav-link" href="{{ route('subscription_list.set') }}"><span class="menu-title">{{__('Set Subscriptions')}}</span></a>
                                    </li>
                                @endif
                            </ul>
                        </li>
                        @endif

                        @if(permission_check_all('cancellation_requests') || permission_check_put('cancellation_requests') || permission_check_post('cancellation_requests') || permission_check_get('cancellation_requests') || permission_check_delete('cancellation_requests') )
                       <li class="{{ areActiveRoutes(['admin.cancellation_requests'])}}">
                            <a class="nav-link" href="{{ route('admin.cancellation_requests') }}">
                                <i class="fa fa-trash"></i>
                                <span class="menu-title">{{__('Cancellation Requests')}}</span>
                                @if (\App\RequestsNotification::where(['type' => 'cancel', 'seller_id' => Auth::user()->id])->exists() || \App\CancellationRequests::where(['viewed' => 0])->exists())
                                    <span class="pull-right badge badge-info">{{ \App\RequestsNotification::where(['type' => 'cancel', 'seller_id' => Auth::user()->id])->count() + \App\CancellationRequests::where(['viewed' => 0])->count()}}</span>
                                @endif
                            </a>
                        </li>
                        @endif

                        @if(permission_check_all('orders') || permission_check_put('orders') || permission_check_post('orders') || permission_check_get('orders') || permission_check_delete('orders') )
                       <li class="{{ areActiveRoutes(['admin.return_requests'])}}">
                            <a class="nav-link" href="{{ route('admin.return_requests') }}">
                                <i class="fa fa-backward"></i>
                                <span class="menu-title">{{__('Return Requests')}}</span>
                                @if (\App\RequestsNotification::where(['type' => 'return', 'seller_id' => Auth::user()->id])->exists())
                                    <span class="pull-right badge badge-info">{{ \App\RequestsNotification::where(['type' => 'return', 'seller_id' => Auth::user()->id])->count()}}</span>
                                @endif
                            </a>
                        </li>
                        @endif

                        @if(permission_check_all('refund_requests') || permission_check_put('refund_requests') || permission_check_post('refund_requests') || permission_check_get('refund_requests') || permission_check_delete('refund_requests') )
                        <li class="{{ areActiveRoutes(['admin.refund_requests'])}}">
                            <a class="nav-link" href="{{ route('admin.refund_requests') }}">
                                <i class="fa fa-money"></i>
                                <span class="menu-title">{{__('Refund Requests')}}</span>
                                @if (\App\RequestsNotification::where(['type' => 'refund', 'seller_id' => Auth::user()->id])->exists() || \App\RefundRequest::where(['viewed' => 0])->exists())
                                    <span class="pull-right badge badge-info">{{ \App\RequestsNotification::where(['type' => 'refund', 'seller_id' => Auth::user()->id])->count() + \App\RefundRequest::where(['viewed' => 0])->count()}}</span>
                                @endif
                            </a>
                        </li>
                        @endif

                        @if(permission_check_all('conversations') || permission_check_put('conversations') || permission_check_post('conversations') || permission_check_get('conversations') || permission_check_delete('conversations') )
                        @php
                            $conversation = \App\Conversation::where('receiver_id', Auth::user()->id)->where('receiver_viewed', '1')->get();
                        @endphp
                        <li class="{{ areActiveRoutes(['conversations.admin_index', 'conversations.admin_show'])}}">
                            <a class="nav-link" href="{{ route('conversations.admin_index') }}">
                                <i class="fa fa-comment"></i>
                                <span class="menu-title">{{__('Conversations')}}</span>
                                @if (count($conversation) > 0)
                                    <span class="pull-right badge badge-info">{{ count($conversation) }}</span>
                                @endif
                            </a>
                        </li>
                        @endif

                        @if(permission_check_all('disputes') || permission_check_put('disputes') || permission_check_post('disputes') || permission_check_get('disputes') || permission_check_delete('disputes') )
                         @php
                            $dispute = \App\Dispute::where('receiver_id', Auth::user()->id)->where('receiver_viewed', '1')->get();
                        @endphp
                        <li class="{{ areActiveRoutes(['disputes.admin_index', 'disputes.admin_show'])}}">
                            <a class="nav-link" href="{{ route('disputes.admin_index') }}">
                                <i class="fa fa-comments"></i>
                                <span class="menu-title">{{__('Disputes')}}</span>
                                @if (count($dispute) > 0)
                                    <span class="pull-right badge badge-info">{{ count($dispute) }}</span>
                                @endif
                            </a>
                        </li>
                        @endif

                        @if(permission_check_all('pages') || permission_check_put('pages') || permission_check_post('pages') || permission_check_get('pages') || permission_check_delete('pages') )
                        <li>
                            <a href="#">
                                <i class="fa fa-file-text-o"></i>
                                <span class="menu-title">{{__('Custom Pages')}}</span>
                                <i class="arrow"></i>
                            </a>


                            <ul class="collapse">
                                <li class="{{ areActiveRoutes(['pages.index'])}}">
                                    <a class="nav-link" href="{{ route('pages.index') }}"><span class="menu-title">{{__('Pages')}}</span></a>
                                </li>
                                <li class="{{ areActiveRoutes(['apply.index'])}}">
                                    <a class="nav-link" href="{{ route('apply.index') }}"><span class="menu-title">{{__('Apply')}}</span></a>
                                </li>
                            </ul>
                        </li>
                        @endif

                        @if(permission_check_all('customer_offers') || permission_check_put('customer_offers') || permission_check_post('customer_offers') || permission_check_get('customer_offers') || permission_check_delete('customer_offers') )
                        <li>
                            <a href="#">
                                <i class="fa fa-gift"></i>
                                <span class="menu-title">{{__('Offers')}}</span>
                                <i class="arrow"></i>
                            </a>

                            <ul class="collapse">
                                <li class="{{ areActiveRoutes(['customeroffers.index'])}}">
                                    <a class="nav-link" href="{{ route('customeroffers.index') }}"><span class="menu-title">{{__('Customer Offers')}}</span></a>
                                </li>
                            </ul>
                        </li>
                        @endif

                        @if(permission_check_all('news') || permission_check_put('news') || permission_check_post('news') || permission_check_get('news') || permission_check_delete('news') ||
                        (permission_check_all('forums') || permission_check_put('forums') || permission_check_post('forums') || permission_check_get('forums') || permission_check_delete('forums')))
                            <li class="{{areActiveRoutes(['news.index'])}}">
                                <a href="#">
                                    <i class="fa fa-newspaper-o"></i>
                                    <span class="menu-title">{{__('News & Forum')}}</span>
                                    <i class="arrow"></i>
                                </a>

                                <ul class="collapse">
                                    <li class="{{areActiveRoutes(['news.index'])}}">
                                        <a class="nav-link" href="{{route('news.index')}}"> <span class="menu-title">{{__('News')}}</span></a>
                                    </li>
                                    @if(permission_check_all('forums') || permission_check_put('forums') || permission_check_post('forums') || permission_check_get('forums') || permission_check_delete('forums') )
                                        <li class="{{areActiveRoutes(['forum.index'])}}">
                                            <a class="nav-link" href="{{route('forum.index')}}"> <span class="menu-title">{{__('Forum')}}</span></a>
                                        </li>
                                    @endif

                                    @if(permission_check_all('forums_comments_like') || permission_check_put('forums_comments_like') || permission_check_post('forums_comments_like') || permission_check_get('forums_comments_like') || permission_check_delete('forums_comments_like') )
                                        <li class="{{areActiveRoutes(['forum_comment.index'])}}">
                                            <a class="nav-link" href="{{route('forumcomment.index')}}"> <span class="menu-title">{{__('Forum Comments')}}</span></a>
                                        </li>
                                    @endif

                                    @if(permission_check_all('forums_comments_reports') || permission_check_put('forums_comments_reports') || permission_check_post('forums_comments_reports') || permission_check_get('forums_comments_reports') || permission_check_delete('forums_comments_reports') )
                                        <li class="{{areActiveRoutes(['reportcomment'])}}">
                                            <a class="nav-link" href="{{route('reportcomment')}}"> <span class="menu-title">{{__('Forum Reports')}}</span>{</a>
                                        </li>
                                    @endif
                                </ul>
                            </li>
                        @endif

                        @if(permission_check_all('ads') || permission_check_put('ads') || permission_check_post('ads') || permission_check_get('ads') || permission_check_delete('ads') )
                          <li>
                                    <a href="#">
                                        <i class="fa fa-bullhorn"></i>
                                        <span class="menu-title">{{__('Ad Space')}}</span>
                                        <i class="arrow"></i>
                                    </a>

                                    <ul class="collapse">
                                        @if(permission_check_all('ads') || permission_check_put('ads') || permission_check_post('ads') || permission_check_get('ads') || permission_check_delete('ads') )
                                            <li class="{{ areActiveRoutes(['ads'])}}">
                                                <a class="nav-link" href="{{ route('ads') }}"><span class="menu-title">{{__('Detailed Page')}}</span></a>
                                            </li>
                                        @endif

                                        @if(permission_check_all('advertisment_dashboards') || permission_check_put('advertisment_dashboards') || permission_check_post('advertisment_dashboards') || permission_check_get('advertisment_dashboards') || permission_check_delete('advertisment_dashboards') )
                                            <li class="{{ areActiveRoutes(['ads.dashboard'])}}">
                                                <a class="nav-link" href="{{route('ads.dashboard')}}"><span class="menu-title">{{__('Dashboard')}}</span></a>
                                            </li>
                                        @endif

                                        @if(permission_check_all('advertisment_forums') || permission_check_put('advertisment_forums') || permission_check_post('advertisment_forums') || permission_check_get('advertisment_forums') || permission_check_delete('advertisment_forums') )
                                            <li class="{{ areActiveRoutes(['ads.forum'])}}">
                                                <a class="nav-link" href="{{route('ads.forum')}}"><span class="menu-title">{{__('Forum')}}</span></a>
                                            </li>
                                        @endif

                                        @if(permission_check_all('advertisement_classifieds') || permission_check_put('advertisement_classifieds') || permission_check_post('advertisement_classifieds') || permission_check_get('advertisement_classifieds') || permission_check_delete('advertisement_classifieds') )
                                        <li class="{{ areActiveRoutes(['ads.classified'])}}">
                                            <a class="nav-link" href="{{route('ads.classified')}}"><span class="menu-title">{{__('Classified')}}</span></a>
                                        </li>
                                        @endif
                                    </ul>
                                </li>
                        @endif



                        @if(permission_check_all('reports') || permission_check_put('reports') || permission_check_post('reports') || permission_check_get('reports') || permission_check_delete('reports') )
                        <li>
                            <a href="#">
                                <i class="fa fa-file"></i>
                                <span class="menu-title">{{__('Reports')}}</span>
                                <i class="arrow"></i>
                            </a>


                            <ul class="collapse">
                                <li class="{{ areActiveRoutes(['stock_report.index'])}}">
                                    <a class="nav-link" href="{{ route('stock_report.index') }}"> <span class="menu-title">{{__('Stock Report')}}</span></a>
                                </li>
                                <li class="{{ areActiveRoutes(['in_house_sale_report.index'])}}">
                                    <a class="nav-link" href="{{ route('in_house_sale_report.index') }}"> <span class="menu-title">{{__('In House Sale Report')}}</span></a>
                                </li>
                                <li class="{{ areActiveRoutes(['seller_report.index'])}}">
                                    <a class="nav-link" href="{{ route('seller_report.index') }}"> <span class="menu-title">{{__('Seller Report')}}</span></a>
                                </li>
                                <li class="{{ areActiveRoutes(['seller_sale_report.index'])}}">
                                    <a class="nav-link" href="{{ route('seller_sale_report.index') }}"> <span class="menu-title">{{__('Seller Based Selling Report')}}</span></a>
                                </li>
                                <li class="{{ areActiveRoutes(['wish_report.index'])}}">
                                    <a class="nav-link" href="{{ route('wish_report.index') }}"> <span class="menu-title">{{__('Product Wish Report')}}</span></a>
                                </li>
                                <li class="{{ areActiveRoutes(['admin.reports'])}}">
                                    <a class="nav-link" href="{{ route('admin.reports') }}"> <span class="menu-title">{{__('Product Reports')}}</span> </a>
                                </li>
                                <li class="{{ areActiveRoutes(['user_search_report'])}}">
                                    <a class="nav-link" href="{{ route('user_search_report') }}"> <span class="menu-title">{{__('User Searches')}}</span> </a>
                                </li>
                            </ul>
                        </li>
                    @endif

                    @if(permission_check_all('messages') || permission_check_put('messages') || permission_check_post('messages') || permission_check_get('messages') || permission_check_delete('messages') )
                    <li>
                            <a href="#">
                                <i class="fa fa-envelope"></i>
                                <span class="menu-title">{{__('Messaging')}}</span>
                                <i class="arrow"></i>
                            </a>


                            <ul class="collapse">
                                @if(permission_check_all('subscribers') || permission_check_put('subscribers') || permission_check_post('subscribers') || permission_check_get('subscribers') || permission_check_delete('subscribers') ||
                                    permission_check_all('users') || permission_check_put('users') || permission_check_post('users') || permission_check_get('users') || permission_check_delete('users'))
                                    <li class="{{ areActiveRoutes(['newsletters.index'])}}">
                                        <a class="nav-link" href="{{route('newsletters.index')}}"> <span class="menu-title">{{__('Newsletters')}}</span></a>
                                    </li>
                                @endif
                                @if (\App\Addon::where('unique_identifier', 'otp_system')->first() != null)
                                    <li class="{{ areActiveRoutes(['sms.index'])}}">
                                        <a class="nav-link" href="{{route('sms.index')}}"> <span class="menu-title">{{__('SMS')}}</span></a>
                                    </li>
                                @endif
                                @if(permission_check_all('users') || permission_check_put('users') || permission_check_post('users') || permission_check_get('users') || permission_check_delete('users') )
                                <li class="{{ areActiveRoutes(['cart_email.index'])}}">
                                    <a class="nav-link" href="{{route('cart_email.index')}}"> <span class="menu-title">{{__('Cart')}}</span></a>
                                </li>
                                @endif
                            </ul>
                        </li>
                        @endif

                         @if(permission_check_all('seller_feedback') || permission_check_put('seller_feedback') || permission_check_post('seller_feedback') || permission_check_get('seller_feedback') || permission_check_delete('seller_feedback') )

    				<li>
                            <a href="#">
                                <i class="fa fa-briefcase"></i>
                                <span class="menu-title">{{__('Feedbacks')}}</span>
                                <i class="arrow"></i>
                            </a>
                            <ul class="collapse">
                                <li class="{{ areActiveRoutes(['admin.seller_feedback'])}}">
                                    <a class="nav-link" href="{{route('admin.seller_feedback')}}"><span class="menu-title">{{__('Seller Feedback')}}</span></a>
                                </li>
                                <li class="{{ areActiveRoutes(['admin.customer_feedback'])}}">
                                    <a class="nav-link" href="{{ route('admin.customer_feedback') }}"><span class="menu-title">{{__('Customer Feedback')}}</span></a>
                                </li>

                                <li class="{{ areActiveRoutes(['admin.feedback'])}}">
                                    <a class="nav-link" href="{{ route('admin.feedback') }}"><span class="menu-title">{{__('Admin Feedback')}}</span></a>
                                </li>
                            </ul>
                        </li>
                     @endif
                        <li>
                            <a href="#">
                                <i class="fa fa-briefcase"></i>
                                <span class="menu-title">{{__('Business Settings')}}</span>
                                <i class="arrow"></i>
                            </a>


                            <ul class="collapse">
                             @if(permission_check_all('business_settings') || permission_check_put('business_settings') || permission_check_post('business_settings') || permission_check_get('business_settings') || permission_check_delete('business_settings') )
                                <li class="{{ areActiveRoutes(['activation.index'])}}">
                                    <a class="nav-link" href="{{route('activation.index')}}"> <span class="menu-title">{{__('Activation')}}</span></a>
                                </li>
                             @endif   
                              @if(permission_check_all('business_settings') || permission_check_put('business_settings') || permission_check_post('business_settings') || permission_check_get('business_settings') || permission_check_delete('business_settings') )    
                                <li class="{{ areActiveRoutes(['payment_method.index'])}}">
                                    <a class="nav-link" href="{{ route('payment_method.index') }}"> <span class="menu-title">{{__('Payment method')}}</span></a>
                                </li>
                             @endif   
                              @if(permission_check_all('business_settings') || permission_check_put('business_settings') || permission_check_post('business_settings') || permission_check_get('business_settings') || permission_check_delete('business_settings') )
                                  <li class="{{ areActiveRoutes(['smtp_settings.index'])}}">
                                    <a class="nav-link" href="{{ route('smtp_settings.index') }}"> <span class="menu-title">{{__('SMTP Settings')}}</span></a>
                                </li>
                             @endif   
                              @if(permission_check_all('business_settings') || permission_check_put('business_settings') || permission_check_post('business_settings') || permission_check_get('business_settings') || permission_check_delete('business_settings') )
                        
                                <li class="{{ areActiveRoutes(['google_analytics.index'])}}">
                                    <a class="nav-link" href="{{ route('google_analytics.index') }}"> <span class="menu-title">{{__('Google Analytics')}}</span></a>
                                </li>
                             @endif   
                              @if(permission_check_all('business_settings') || permission_check_put('business_settings') || permission_check_post('business_settings') || permission_check_get('business_settings') || permission_check_delete('business_settings') )
                                <li class="{{ areActiveRoutes(['facebook_chat.index'])}}">
                                    <a class="nav-link" href="{{ route('facebook_chat.index') }}"> <span class="menu-title">{{__('Facebook Chat & Pixel')}}</span></a>
                                </li>
                             @endif   
                              @if(permission_check_all('business_settings') || permission_check_put('business_settings') || permission_check_post('business_settings') || permission_check_get('business_settings') || permission_check_delete('business_settings') )
                                <li class="{{ areActiveRoutes(['social_login.index'])}}">
                                    <a class="nav-link" href="{{ route('social_login.index') }}"> <span class="menu-title">{{__('Social Media Login')}}</span></a>
                                </li>
                             @endif   
                              @if(permission_check_all('business_settings') || permission_check_put('business_settings') || permission_check_post('business_settings') || permission_check_get('business_settings') || permission_check_delete('business_settings') )
                                <li class="{{ areActiveRoutes(['currency.index'])}}">
                                    <a class="nav-link" href="{{route('currency.index')}}"> <span class="menu-title">{{__('Currency')}}</span></a>
                                </li>
                             @endif   
                              @if(permission_check_all('languages') || permission_check_put('languages') || permission_check_post('languages') || permission_check_get('languages') || permission_check_delete('languages') )                       
                                <li class="{{ areActiveRoutes(['languages.index', 'languages.create', 'languages.store', 'languages.show', 'languages.edit'])}}">
                                    <a class="nav-link" href="{{route('languages.index')}}"> <span class="menu-title">{{__('Languages')}}</span></a>
                                </li>
                             @endif   
                              @if(permission_check_all('business_settings') || permission_check_put('business_settings') || permission_check_post('business_settings') || permission_check_get('business_settings') || permission_check_delete('business_settings') )
                                <li class="{{ areActiveRoutes(['maintenance.index'])}}">
                                    <a class="nav-link" href="{{route('maintenance.index')}}"> <span class="menu-title">{{__('Maintenance Whitelist')}}</span></a>
                                </li>
                             @endif   
                              @if(permission_check_all('business_settings') || permission_check_put('business_settings') || permission_check_post('business_settings') || permission_check_get('business_settings') || permission_check_delete('business_settings') )
                                 <li class="{{ areActiveRoutes(['system_server'])}}">
                                    <a class="nav-link" href="{{route('system_server')}}"> <span class="menu-title">{{__('Server Status')}}</span></a>
                                </li>
                             @endif   
                            
                             @if(permission_check_all('activity_logs') || permission_check_put('activity_logs') || permission_check_post('activity_logs') || permission_check_get('activity_logs') || permission_check_delete('activity_logs') )
                            <li class="{{ areActiveRoutes(['business_settings.activity_logs'])}}">
                                <a class="nav-link" href="{{route('business_settings.activity_logs')}}">
                                    <span class="menu-title">{{__('Activity Logs')}}</span>
                                </a>
                            </li>
                                    </li>
                                 @endif
                                     @if(permission_check_all('custom_scripts') || permission_check_put('custom_scripts') || permission_check_post('custom_scripts') || permission_check_get('custom_scripts') || permission_check_delete('custom_scripts') )
                                    <li class="{{ areActiveRoutes(['business_settings.custom_script'])}}">
                                        <a class="nav-link" href="{{route('business_settings.custom_script')}}">
                                            <span class="menu-title">{{__('Custom Script')}}</span>
                                        </a>
                                    </li>
                                 @endif
                                 
                              @if(permission_check_all('business_settings') || permission_check_put('business_settings') || permission_check_post('business_settings') || permission_check_get('business_settings') || permission_check_delete('business_settings') )
                                 <li class="{{ areActiveRoutes(['business_settings.reserve_money'])}}">
                                        <a class="nav-link" href="{{route('business_settings.reserve_money')}}">
                                            <span class="menu-title">{{__('Reserve Money')}}</span>
                                        </a>
                                </li>
                             @endif   
                              @if(permission_check_all('business_settings') || permission_check_put('business_settings') || permission_check_post('business_settings') || permission_check_get('business_settings') || permission_check_delete('business_settings') )
                        
                                <li class="{{ areActiveRoutes(['business_settings.max_limit'])}}">
                                    <a class="nav-link" href="{{route('business_settings.max_limit')}}">
                                        <span class="menu-title">{{__('Max Limit')}}</span>
                                    </a>
                                </li>
                             @endif   
                            </ul>
                        </li>

                        @if(
                        permission_check_all('add_brands') || permission_check_put('add_brands') || permission_check_post('add_brands') || permission_check_get('add_brands') || permission_check_delete('add_brands') ||
                        permission_check_all('make_suggestions') || permission_check_put('make_suggestions') || permission_check_post('make_suggestions') || permission_check_get('make_suggestions') || permission_check_delete('make_suggestions') ||
                        permission_check_all('create_coupons') || permission_check_put('create_coupons') || permission_check_post('create_coupons') || permission_check_get('create_coupons') || permission_check_delete('create_coupons') ||
                        permission_check_all('flash_deals') || permission_check_put('flash_deals') || permission_check_post('flash_deals') || permission_check_get('flash_deals') || permission_check_delete('flash_deals') ||
                        permission_check_all('submit_offers') || permission_check_put('submit_offers') || permission_check_post('submit_offers') || permission_check_get('submit_offers') || permission_check_delete('submit_offers') ||
                        permission_check_all('register_brands') || permission_check_put('register_brands') || permission_check_post('register_brands') || permission_check_get('register_brands') || permission_check_delete('register_brands')
                        )
                        <li>
                            <a href="#">
                                <i class="fa fa-user-plus"></i>
                                <span class="menu-title">{{__('Forms')}}</span>
                                <i class="arrow"></i>
                            </a>


                            <ul class="collapse">
                            @if(permission_check_all('register_brands') || permission_check_put('register_brands') || permission_check_post('register_brands') || permission_check_get('register_brands') || permission_check_delete('register_brands'))
                                <li class="{{ areActiveRoutes(['registerABrand.admin'])}}">
                                    <a class="nav-link" href="{{ route('registerABrand.admin') }}"> <span class="menu-title">{{__('Register A Brand')}}</span></a>
                                </li>
                            @endif
                            @if(permission_check_all('submit_offers') || permission_check_put('submit_offers') || permission_check_post('submit_offers') || permission_check_get('submit_offers') || permission_check_delete('submit_offers'))
                                <li class="{{ areActiveRoutes(['submitOffers.admin'])}}">
                                    <a class="nav-link" href="{{ route('submitOffers.admin') }}"> <span class="menu-title">{{__('Submit Offers')}}</span></a>
                                </li>
                            @endif
                            @if(permission_check_all('add_brands') || permission_check_put('add_brands') || permission_check_post('add_brands') || permission_check_get('add_brands') || permission_check_delete('add_brands'))
                                <li class="{{ areActiveRoutes(['addABrand.admin'])}}">
                                    <a class="nav-link" href="{{ route('addABrand.admin') }}"> <span class="menu-title">{{__('Add A Brand')}}</span></a>
                                </li>
                            @endif
                            @if(permission_check_all('make_suggestions') || permission_check_put('make_suggestions') || permission_check_post('make_suggestions') || permission_check_get('make_suggestions') || permission_check_delete('make_suggestions'))
                                <li class="{{ areActiveRoutes(['makeSuggestion.admin'])}}">
                                    <a class="nav-link" href="{{route('makeSuggestion.admin')}}"> <span class="menu-title">{{__('Make Suggestion')}}</span></a>
                                </li>
                            @endif
                            @if(permission_check_all('create_coupons') || permission_check_put('create_coupons') || permission_check_post('create_coupons') || permission_check_get('create_coupons') || permission_check_delete('create_coupons'))
                                <li class="{{ areActiveRoutes(['createCoupons.admin'])}}">
                                    <a class="nav-link" href="{{route('createCoupons.admin')}}"> <span class="menu-title">{{__('Create Coupons')}}</span></a>
                                </li>
                            @endif
                            @if(permission_check_all('flash_deals') || permission_check_put('flash_deals') || permission_check_post('flash_deals') || permission_check_get('flash_deals') || permission_check_delete('flash_deals'))
                                <li class="{{ areActiveRoutes(['flashDeal.admin'])}}">
                                    <a class="nav-link" href="{{route('flashDeal.admin')}}"> <span class="menu-title">{{__('Flash Deals')}}</span></a>
                                </li>
                            @endif
                            </ul>
                        </li>
                        @endif

                        @if(permission_check_all('shippings') || permission_check_put('shippings') || permission_check_post('shippings') || permission_check_get('shippings') || permission_check_delete('shippings'))
                        <li>
                            <a href="#">
                                <i class="fa fa-truck"></i>
                                <span class="menu-title">{{__('Shipping')}}</span>
                                <i class="arrow"></i>
                            </a>


                            <ul class="collapse">
                                <li class="{{ areActiveRoutes(['admin.make-shipping','admin.create-shipping','admin.edit-shipping'])}}">
                                    <a class="nav-link" href="{{ route('admin.make-shipping') }}"><span class="menu-title">{{__('Make Shipping')}}</span></a>
                                </li>
                                @if(permission_check_all('shipping_dates') || permission_check_put('shipping_dates') || permission_check_post('shipping_dates') || permission_check_get('shipping_dates') || permission_check_delete('shipping_dates'))
                                    <li class="{{ areActiveRoutes(['admin.shipping-date'])}}">
                                        <a class="nav-link" href="{{ route('admin.shipping-date') }}"><span class="menu-title">{{__('Shipping Date')}}</span></a>
                                    </li>
                                @endif

                                @if(permission_check_all('shipping_profile') || permission_check_put('shipping_profile') || permission_check_post('shipping_dates') || permission_check_get('shipping_dates') || permission_check_delete('shipping_dates'))
                                    <li class="{{ areActiveRoutes(['admin.shipping-profile'])}}">
                                        <a class="nav-link" href="{{ route('admin.shipping-profile') }}"><span class="menu-title">{{__('Shipping Profile')}}</span></a>
                                    </li>
                                @endif


                                @if(permission_check_all('countries') || permission_check_put('countries') || permission_check_post('countries') || permission_check_get('countries') || permission_check_delete('countries'))
                                <li class="{{ areActiveRoutes(['countries.index','countries.edit','countries.update'])}}">
                                    <a class="nav-link" href="{{route('countries.index')}}"><span class="menu-title">{{__('Shipping Countries')}}</span></a>
                                </li>
                                @endif

                                @if(permission_check_all('shipping_countries') || permission_check_put('shipping_countries') || permission_check_post('shipping_countries') || permission_check_get('shipping_countries') || permission_check_delete('shipping_countries'))
                                    <li class="{{ areActiveRoutes(['admin.set-countries'])}}">
                                        <a class="nav-link" href="{{ route('admin.set-countries') }}"><span class="menu-title">{{__('Amin Set Shipping Countries')}}</span></a>
                                    </li>
                                @endif
                            </ul>
                        </li>
                        @endif

                        @if(permission_check_all('banners') || permission_check_put('banners') || permission_check_post('banners') || permission_check_get('banners') || permission_check_delete('banners'))

                        <li>
                            <a href="#">
                                <i class="fa fa-desktop"></i>
                                <span class="menu-title">{{__('Frontend Settings')}}</span>
                                <i class="arrow"></i>
                            </a>

                            <ul class="collapse">
                                @if(permission_check_all('sliders') || permission_check_put('sliders') || permission_check_post('sliders') || permission_check_get('sliders') || permission_check_delete('sliders'))
                                    <li class="{{ areActiveRoutes(['home_settings.index', 'home_banners.index', 'sliders.index', 'home_categories.index', 'home_banners.create', 'home_categories.create', 'home_categories.edit', 'sliders.create'])}}">
                                        <a class="nav-link" href="{{route('home_settings.index')}}"><span class="menu-title">{{__('Home')}}</span></a>
                                    </li>
                                @endif

                                @if(permission_check_all('policies') || permission_check_put('policies') || permission_check_post('policies') || permission_check_get('policies') || permission_check_delete('policies'))
                                <li>
                                    <a href="#">
                                        <span class="menu-title">{{__('Policy Pages')}}</span>
                                        <i class="arrow"></i>
                                    </a>


                                    <ul class="collapse">
                                        <li class="{{ areActiveRoutes(['sellerpolicy.index'])}}">
                                            <a class="nav-link" href="{{route('sellerpolicy.index', 'seller_policy')}}">  <span class="menu-title">{{__('Seller Policy')}}</span></a>
                                        </li>
                                        <li class="{{ areActiveRoutes(['returnpolicy.index'])}}">
                                            <a class="nav-link" href="{{route('returnpolicy.index', 'return_policy')}}">  <span class="menu-title">{{__('Return Policy')}}</span></a>
                                        </li>
                                        <li class="{{ areActiveRoutes(['supportpolicy.index'])}}">
                                            <a class="nav-link" href="{{route('supportpolicy.index', 'support_policy')}}">  <span class="menu-title">{{__('Support Policy')}}</span></a>
                                        </li>
                                        <li class="{{ areActiveRoutes(['terms.index'])}}">
                                            <a class="nav-link" href="{{route('terms.index', 'terms')}}">  <span class="menu-title">{{__('Terms & Conditions')}}</span></a>
                                        </li>
                                        <li class="{{ areActiveRoutes(['privacypolicy.index'])}}">
                                            <a class="nav-link" href="{{route('privacypolicy.index', 'privacy_policy')}}">  <span class="menu-title">{{__('Privacy Policy')}}</span></a>
                                        </li>

                                    </ul>

                                </li>
                                @endif

                                @if(permission_check_all('links') || permission_check_put('links') || permission_check_post('links') || permission_check_get('links') || permission_check_delete('policies'))
                                    <li class="{{ areActiveRoutes(['links.index', 'links.create', 'links.edit'])}}">
                                        <a class="nav-link" href="{{route('links.index')}}">  <span class="menu-title">{{__('Useful Link')}}</span></a>
                                    </li>
                                @endif

                                 @if(permission_check_all('business_settings') || permission_check_put('business_settings') || permission_check_post('business_settings') || permission_check_get('business_settings') || permission_check_delete('business_settings') )
                                   <li class="{{ areActiveRoutes(['cookies'])}}">
                                        <a class="nav-link" href="{{route('cookies')}}">  <span class="menu-title">{{__('Cookies')}}</span></a>
                                    </li>
                                @endif


                                @if(permission_check_all('general_settings') || permission_check_put('general_settings') || permission_check_post('general_settings') || permission_check_get('general_settings') || permission_check_delete('general_settings'))
                                    <li class="{{ areActiveRoutes(['generalsettings.index'])}}">
                                        <a class="nav-link" href="{{route('generalsettings.index')}}">  <span class="menu-title">{{__('General Settings')}}</span></a>
                                    </li>

                                    <li class="{{ areActiveRoutes(['generalsettings.logo'])}}">
                                        <a class="nav-link" href="{{route('generalsettings.logo')}}">  <span class="menu-title">{{__('Logo Settings')}}</span></a>
                                    </li>
                                @endif

                                @if(permission_check_all('colors') || permission_check_put('colors') || permission_check_post('colors') || permission_check_get('colors') || permission_check_delete('colors'))
                                    <li class="{{ areActiveRoutes(['generalsettings.color'])}}">
                                        <a class="nav-link" href="{{route('generalsettings.color')}}">  <span class="menu-title">{{__('Color Settings')}}</span></a>
                                    </li>
                                @endif

  				@if(permission_check_all('shops') || permission_check_put('shops') || permission_check_post('shops') || permission_check_get('shops') || permission_check_delete('shops'))
                                    <li class="{{ areActiveRoutes(['generalsettings.color'])}}">
                                        <a class="nav-link" href="{{route('admin.shop')}}">  <span class="menu-title">{{__('Shop Settings')}}</span></a>
                                    </li>
                                @endif
                            </ul>
                        </li>
                        @endif

                        @if(permission_check_all('coupons') || permission_check_put('coupons') || permission_check_post('coupons') || permission_check_get('coupons') || permission_check_delete('coupons') ||
                        permission_check_all('attributes') || permission_check_put('attributes') || permission_check_post('attributes') || permission_check_get('attributes') || permission_check_delete('attributes') ||
                        permission_check_all('pickup_points') || permission_check_put('pickup_points') || permission_check_post('pickup_points') || permission_check_get('pickup_points') || permission_check_delete('pickup_points') )
                        <li>
                            <a href="#">
                                <i class="fa fa-gear"></i>
                                <span class="menu-title">{{__('E-commerce Setup')}}</span>
                                <i class="arrow"></i>
                            </a>


                            <ul class="collapse">
                        @if(permission_check_all('attributes') || permission_check_put('attributes') || permission_check_post('attributes') || permission_check_get('attributes') || permission_check_delete('attributes'))
                                <li class="{{ areActiveRoutes(['attributes.index','attributes.create','attributes.edit'])}}">
                                    <a class="nav-link" href="{{route('attributes.index')}}">  <span class="menu-title">{{__('Attribute')}}</span></a>
                                </li>
                        @endif
                        @if(permission_check_all('attributes') || permission_check_put('attributes') || permission_check_post('attributes') || permission_check_get('attributes') || permission_check_delete('attributes'))
                                <li class="{{ areActiveRoutes(['coupon.index','coupon.create','coupon.edit'])}}">
                                    <a class="nav-link" href="{{route('coupon.index')}}">  <span class="menu-title">{{__('Coupon')}}</span></a>
                                </li>
                        @endif

                        @if(permission_check_all('attributes') || permission_check_put('attributes') || permission_check_post('attributes') || permission_check_get('attributes') || permission_check_delete('attributes'))
                                <li class="{{ areActiveRoutes(['pick_up_points.index','pick_up_points.create','pick_up_points.edit'])}}">
                                    <a class="nav-link" href="{{route('pick_up_points.index')}}">  <span class="menu-title">{{__('Pickup Point')}}</span></a>
                                </li>
                            </ul>
                        </li>
                        @endif

                        @endif

                        @if (\App\Addon::where('unique_identifier', 'affiliate_system')->first() != null)
                            <li>
                                <a href="#">
                                    <i class="fa fa-link"></i>
                                    <span class="menu-title">{{__('Affiliate System')}}</span>
                                    <i class="arrow"></i>
                                </a>


                                <ul class="collapse">
                                    <li class="{{ areActiveRoutes(['affiliate.configs'])}}">
                                        <a class="nav-link" href="{{route('affiliate.configs')}}"><span class="menu-title">{{__('Affiliate Configurations')}}</span></a>
                                    </li>
                                    <li class="{{ areActiveRoutes(['affiliate.index'])}}">
                                        <a class="nav-link" href="{{route('affiliate.index')}}"><span class="menu-title">{{__('Affiliate Options')}}</span></a>
                                    </li>
                                    <li class="{{ areActiveRoutes(['affiliate.users', 'affiliate_users.show_verification_request', 'affiliate_user.payment_history'])}}">
                                        <a class="nav-link" href="{{route('affiliate.users')}}"><span class="menu-title">{{__('Affiliate Users')}}</span></a>
                                    </li>
                                </ul>
                            </li>
                        @endif


                        @if (\App\Addon::where('unique_identifier', 'offline_payment')->first() != null)
                            <li>
                                <a href="#">
                                    <i class="fa fa-bank"></i>
                                    <span class="menu-title">{{__('Offline Payment System')}}</span>
                                    <i class="arrow"></i>
                                </a>


                                <ul class="collapse">
                                    <li class="{{ areActiveRoutes(['manual_payment_methods.index', 'manual_payment_methods.create', 'manual_payment_methods.edit'])}}">
                                        <a class="nav-link" href="{{ route('manual_payment_methods.index') }}"> <span class="menu-title">{{__('Manual Payment Methods')}}</span></a>
                                    </li>
                                </ul>
                            </li>
                        @endif

                        @if (\App\Addon::where('unique_identifier', 'paytm')->first() != null)
                            <li>
                                <a href="#">
                                    <i class="fa fa-mobile"></i>
                                    <span class="menu-title">{{__('Paytm Payment Gateway')}}</span>
                                    <i class="arrow"></i>
                                </a>


                                <ul class="collapse">
                                    <li class="{{ areActiveRoutes(['paytm.index'])}}">
                                        <a class="nav-link" href="{{route('paytm.index')}}"> <span class="menu-title">{{__('Set Paytm Credentials')}}</span></a>
                                    </li>
                                </ul>
                            </li>
                        @endif

                        @if (\App\Addon::where('unique_identifier', 'club_point')->first() != null)
                            <li>
                                <a href="#">
                                    <i class="fa fa-btc"></i>
                                    <span class="menu-title">{{__('Club Point System')}}</span>
                                    <i class="arrow"></i>
                                </a>


                                <ul class="collapse">
                                    <li class="{{ areActiveRoutes(['club_points.configs'])}}">
                                        <a class="nav-link" href="{{route('club_points.configs')}}"><span class="menu-title">{{__('Club Point Configurations')}}</span></a>
                                    </li>
                                    <li class="{{ areActiveRoutes(['set_product_points', 'product_club_point.edit'])}}">
                                        <a class="nav-link" href="{{route('set_product_points')}}"><span class="menu-title">{{__('Set Product Point')}}</span></a>
                                    </li>
                                    <li class="{{ areActiveRoutes(['club_points.index', 'club_point.details'])}}">
                                        <a class="nav-link" href="{{route('club_points.index')}}"><span class="menu-title">{{__('User Points')}}</span></a>
                                    </li>
                                </ul>
                            </li>
                        @endif

                        @if (\App\Addon::where('unique_identifier', 'otp_system')->first() != null)
                            <li>
                                <a href="#">
                                    <i class="fa fa-mobile"></i>
                                    <span class="menu-title">{{__('OTP System')}}</span>
                                    <i class="arrow"></i>
                                </a>


                                <ul class="collapse">
                                    <li class="{{ areActiveRoutes(['otp.configconfiguration'])}}">
                                        <a class="nav-link" href="{{route('otp.configconfiguration')}}"><span class="menu-title">{{__('OTP Configurations')}}</span></a>
                                    </li>
                                    <li class="{{ areActiveRoutes(['otp_credentials.index'])}}">
                                        <a class="nav-link" href="{{route('otp_credentials.index')}}"><span class="menu-title">{{__('Set OTP Credentials')}}</span></a>
                                    </li>
                                </ul>
                            </li>
                        @endif

                        @if(permission_check_all('tickets') || permission_check_put('tickets') || permission_check_post('tickets') || permission_check_get('tickets') || permission_check_delete('tickets'))
                        @php
                                $support_ticket = DB::table('tickets')
                                            ->where('viewed', 0)
                                            ->select('id')
                                            ->count();
                            @endphp
                        <li class="{{ areActiveRoutes(['support_ticket.admin_index', 'support_ticket.admin_show'])}}">
                            <a class="nav-link" href="{{ route('support_ticket.admin_index') }}">
                                <i class="fa fa-support"></i>
                                <span class="menu-title">{{__('Suppot Ticket')}} @if($support_ticket > 0)<span class="pull-right badge badge-info">{{ $support_ticket }}</span>@endif</span>
                            </a>
                        </li>
                        @endif

                        @if(permission_check_all('seosettings') || permission_check_put('seosettings') || permission_check_post('seosettings') || permission_check_get('seosettings') || permission_check_delete('seosettings'))

                        <li class="{{ areActiveRoutes(['seosetting.index'])}}">
                            <a class="nav-link" href="{{ route('seosetting.index') }}">
                                <i class="fa fa-search"></i>
                                <span class="menu-title">{{__('SEO Setting')}}</span>
                            </a>
                        </li>
                        @endif

                        @if(permission_check_all('staffs') || permission_check_put('staffs') || permission_check_post('staffs') || permission_check_get('staffs') || permission_check_delete('staffs') ||
                        permission_check_all('roles') || permission_check_put('roles') || permission_check_post('roles') || permission_check_get('roles') || permission_check_delete('roles')
                        )
                        <li>
                            <a href="#">
                                <i class="fa fa-user"></i>
                                <span class="menu-title">{{__('Staffs')}}</span>
                                <i class="arrow"></i>
                            </a>


                            <ul class="collapse">
                                @if(permission_check_all('staffs') || permission_check_put('staffs') || permission_check_post('staffs') || permission_check_get('staffs') || permission_check_delete('staffs'))
                                    <li class="{{ areActiveRoutes(['staffs.index', 'staffs.create', 'staffs.edit'])}}">
                                        <a class="nav-link" href="{{ route('staffs.index') }}"> <span class="menu-title">{{__('All Staffs')}}</span></a>
                                    </li>
                                @endif

                                @if(permission_check_all('roles') || permission_check_put('roles') || permission_check_post('roles') || permission_check_get('roles') || permission_check_delete('roles'))
                                    <li class="{{ areActiveRoutes(['roles.index', 'roles.create', 'roles.edit'])}}">
                                        <a class="nav-link" href="{{route('roles.index')}}"> <span class="menu-title">{{__('Staff permissions')}}</span></a>
                                    </li>
                                @endif
                            </ul>
                        </li>
                        @endif



                      @if(permission_check_all('raffles') || permission_check_put('raffles') || permission_check_post('raffles') || permission_check_get('raffles') || permission_check_delete('raffles'))
                       <li>
                            <a href="#">
                                <i class="fa fa-ticket"></i>
                                <span class="menu-title">{{__('Raffles')}}</span>
                                <i class="arrow"></i>
                            </a>


                            <ul class="collapse">
                              @if(permission_check_all('raffles') || permission_check_put('raffles') || permission_check_post('raffles') || permission_check_get('raffles') || permission_check_delete('raffles'))
                                <li class="{{ areActiveRoutes(['raffles.index'])}}">
                                    <a class="nav-link" href="{{ route('raffles.index') }}"> <span class="menu-title">{{__('Raffles')}}</span></a>
                                </li>
                              @endif

                              @if(permission_check_all('lotteries') || permission_check_put('lotteries') || permission_check_post('lotteries') || permission_check_get('lotteries') || permission_check_delete('lotteries'))
                                <li class="{{ areActiveRoutes(['lotteries.index'])}}">
                                    <a class="nav-link" href="{{ route('spin2win.index') }}"> <span class="menu-title">{{__('Spin2Win')}}</span></a>
                                </li>
                              @endif
                                @if(permission_check_all('lotteries') || permission_check_put('lotteries') || permission_check_post('lotteries') || permission_check_get('lotteries') || permission_check_delete('lotteries'))
                                <li class="{{ areActiveRoutes(['lotteries.index'])}}">
                                    <a class="nav-link" href="{{ route('admin.raffles.winner_dashboard') }}"> <span class="menu-title">{{__('Raffle Winners')}}</span></a>
                                </li>
                              @endif
                            </ul>
                        </li>
                        @endif

                    </ul>
                </div>
            </div>
        </div>

    </div>
</nav>
