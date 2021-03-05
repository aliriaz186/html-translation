<div class="sidebar sidebar--style-3 no-border stickyfill p-0">
    <div class="widget mb-0">
        <div class="widget-profile-box text-center p-3">
            @if (Auth::user()->avatar_original != null)
                <div class="image" style="background-image:url('{{ asset(Auth::user()->avatar_original) }}')"></div>
            @else
                <img src="{{ asset('frontend/images/user.png') }}" class="image rounded-circle">
            @endif

            @if(Auth::user()->seller->verification_status == 1)
                <div class="name mb-0">{{ Auth::user()->username }} <span class="ml-2"><i class="fa fa-check-circle text-success"></i></span></div>
            @else
                <div class="name mb-0">{{ Auth::user()->username }} <span class="ml-2"><i class="fa fa-times-circle text-danger"></i></span></div>
            @endif
            <span class="star-rating star-rating-sm">
                @php
                    $rating = App\SellerFeedback::where('seller_id',Auth::user()->id)->avg('rating');
                @endphp
                @if ($rating > 0)
                    {{ renderStarRating($rating) }}  {{Seller_average_percentage(Auth::user()->id)}}%
                @else
                    {{ renderStarRating(0) }}  {{Seller_average_percentage(Auth::user()->id)}}%
                @endif
            </span>
        </div>
        <div class="sidebar-widget-title py-3">
            <span>{{__('Menu')}}</span>
        </div>
        <div class="widget-profile-menu py-3">
            <ul class="categories categories--style-3">
                <li class="position-relative border-bottom-custom">
                    <a href="{{ route('dashboard') }}" class="{{ areActiveRoutesHome(['dashboard'])}}">
                        <i class="font-size-2rem la la-dashboard"></i>
                        <span class="category-name">
                            {{__('Dashboard')}}
                        </span>
                    </a>
                </li>
                @php
                    $delivery_viewed = App\Order::where('user_id', Auth::user()->id)->where('delivery_viewed', 0)->get()->count();
                    $payment_status_viewed = App\Order::where('user_id', Auth::user()->id)->where('payment_status_viewed', 0)->get()->count();
                    $refund_request_addon = \App\Addon::where('unique_identifier', 'refund_request')->first();
                    $club_point_addon = \App\Addon::where('unique_identifier', 'club_point')->first();
                @endphp
                <li class="position-relative border-bottom-custom">
                    <a href="{{ route('purchases.index') }}" class="{{ areActiveRoutesHome(['purchase_history.index'])}}">
                        <i class="font-size-2rem la la-file-text"></i>
                        <span class="category-name">
                            {{__('Purchases')}} @if($delivery_viewed > 0 || $payment_status_viewed > 0)<span class="ml-2 text-success"><strong>({{ __(' New Notifications') }})</strong></span>@endif
                        </span>
                    </a>
                </li>
                <li class="position-relative border-bottom-custom">
                    <a href="{{ route('wishlists.index') }}" class="{{ areActiveRoutesHome(['wishlists.index'])}}">
                        <i class="font-size-2rem la la-heart-o"></i>
                        <span class="category-name">
                            {{__('Wishlist')}}
                        </span>
                    </a>
                </li>
                <li class="position-relative border-bottom-custom">
                    <a data-toggle="collapse" href="#product" aria-expanded="true" aria-controls="product">
                        <i class="font-size-2rem la la-diamond"></i>
                        <span class="category-name">
                            {{__('Products')}}
                        </span>
                        <i class="fa fa-angle-right rotate-icon pull-right"></i>
                    </a>
                    <ul class="collapse inner-nav bg-white" id="product">
                        <li class="border-bottom-inner {{ areActiveRoutesHome(['seller.products.upload', 'seller.products.edit'])}}">
                            <a class="nav-link" href="{{route('seller.products.upload')}}">{{__('Add Products')}}</a>
                        </li>
                        <li class="border-bottom-inner {{ areActiveRoutesHome(['seller.products'])}}">
                            <a class="nav-link" href="{{route('seller.products')}}">{{__('All Products')}}</a>
                        </li>
                        @if(\App\BusinessSetting::where('type', 'classified_product')->first()->value == 1)
                            <li class="border-bottom-inner {{ areActiveRoutesHome(['customer_products.index', 'customer_products.create', 'customer_products.edit'])}}">
                                <a class="nav-link" href="{{route('customer_products.index')}}">{{__('Classified Products')}}</a>
                            </li>
                        @endif
                        
                        <li class="border-bottom-inner {{ areActiveRoutesHome(['product_bulk_upload.index'])}}">
                            <a class="nav-link" href="{{route('product_bulk_upload.index')}}">{{__('Product Bulk Upload')}}</a>
                        </li>
                        <li class="border-bottom-inner {{ areActiveRoutesHome(['import_data.index'])}}">
                            <a class="nav-link" href="{{route('import_data.index')}}">{{__('Store Import')}}</a>
                        </li>
                    </ul>
                </li>


                @php
                    $orders = DB::table('orders')
                                ->orderBy('code', 'desc')
                                ->join('order_details', 'orders.id', '=', 'order_details.order_id')
                                ->where('order_details.seller_id', Auth::user()->id)
                                ->where('orders.viewed', 0)
                                ->select('orders.id')
                                ->distinct()
                                ->count();
                @endphp
                <li class="position-relative border-bottom-custom">
                    <a data-toggle="collapse" href="#orders" aria-expanded="true" aria-controls="orders">
                        <i class="font-size-2rem la la-file-text"></i>
                        <span class="category-name">
                            {{__('Orders')}}
                        </span>
                        <i class="fa fa-angle-right rotate-icon pull-right"></i>
                    </a>
                    <ul class="collapse inner-nav bg-white" id="orders">
                        <li class="border-bottom-inner {{ areActiveRoutesHome(['orders.index'])}}">
                            <a class="nav-link" href="{{route('orders.index')}}">{{__('All Orders')}}
                                @if($orders > 0)<span class="ml-2 text-success"><strong>({{ $orders }} {{ __('New') }})</strong></span></span>@endif
                            </a>
                        </li>
                        <li class="border-bottom-inner {{ areActiveRoutesHome(['orders.cancellation_requests'])}}">
                            <a class="nav-link" href="{{route('orders.cancellation_requests')}}">{{__('Cancellation Requests')}}
                                @if (\App\RequestsNotification::where(['type' => 'cancel', 'seller_id' => Auth::user()->id])->exists())
                                <span class="ml-2 text-success"><strong>({{ \App\RequestsNotification::where(['type' => 'cancel', 'seller_id' => Auth::user()->id])->count() }})</strong></span></span>@endif
                            </a>
                        </li>
                        <li class="border-bottom-inner {{ areActiveRoutesHome(['orders.return_requests'])}}">
                            <a class="nav-link" href="{{route('orders.return_requests')}}">{{__('Return Requests')}}
                                @if (\App\RequestsNotification::where(['type' => 'return', 'seller_id' => Auth::user()->id])->exists())
                                <span class="ml-2 text-success"><strong>({{ \App\RequestsNotification::where(['type' => 'return', 'seller_id' => Auth::user()->id])->count() }})</strong></span>
                                @endif
                            </a>
                        </li>
                        <li class="border-bottom-inner {{ areActiveRoutesHome(['orders.refund_requests'])}}">
                            <a class="nav-link" href="{{route('orders.refund_requests')}}">{{__('Refund Requests')}}
                                @if (\App\RequestsNotification::where(['type' => 'refund', 'seller_id' => Auth::user()->id])->exists())
                                    <span class="ml-2 text-success"><strong>({{ \App\RequestsNotification::where(['type' => 'refund', 'seller_id' => Auth::user()->id])->count() }})</strong></span>
                                @endif
                            </a>
                        </li>
                    </ul>
                </li>


                @php
                    $review_count = DB::table('reviews')
                                ->orderBy('code', 'desc')
                                ->join('products', 'products.id', '=', 'reviews.product_id')
                                ->where('products.user_id', Auth::user()->id)
                                ->where('reviews.viewed', 0)
                                ->select('reviews.id')
                                ->distinct()
                                ->count();
                     $feedback = App\SellerFeedback::where('seller_id',Auth::user()->id)->where('viewed',1)->count();
                @endphp

                <li class="position-relative border-bottom-custom">
                    <a data-toggle="collapse" href="#reviews" aria-expanded="true" aria-controls="reviews">
                        <i class="font-size-2rem la la-star-o"></i>
                        <span class="category-name">
                            {{__('Review & Feedback')}}
                        </span>
                        <i class="fa fa-angle-right rotate-icon pull-right"></i>
                    </a>
                    <ul class="collapse inner-nav bg-white" id="reviews">
                        <li class="border-bottom-inner {{ areActiveRoutesHome(['feedbacks.seller'])}}">
                            <a class="nav-link" href="{{route('feedbacks.seller')}}">{{__('Seller Feedback')}}
                                @if($feedback > 0)<span class="ml-2 text-success"><strong>({{ $feedback }} {{ __('New') }})</strong></span>@endif
                            </a>
                        </li>

                       <li class="border-bottom-inner {{ areActiveRoutesHome(['leave-feedback.index'])}}">
                            <a class="nav-link" href="{{route('leave-feedback.index')}}">{{__('Leave Feedback')}}
                                @if($feedback > 0)<span class="ml-2 text-success"><strong>({{ $feedback }} {{ __('New') }})</strong></span>@endif
                            </a>
                        </li>
                        <li class="border-bottom-inner {{ areActiveRoutesHome(['reviews.seller'])}}">
                            <a class="nav-link" href="{{route('reviews.seller')}}">{{__('Product Reviews')}}
                                @if($review_count > 0)<span class="ml-2 text-success"><strong>({{ $review_count }} {{ __('New') }})</strong></span>@endif
                            </a>
                        </li>
                    </ul>
                </li>

                @if (\App\BusinessSetting::where('type', 'conversation_system')->first()->value == 1 || \App\BusinessSetting::where('type', 'dispute_system')->first()->value == 1)
                    @php
                        $conversation_sent = \App\Conversation::where('sender_id', Auth::user()->id)->where('sender_viewed', 0)->get();
                        $conversation_recieved = \App\Conversation::where('receiver_id', Auth::user()->id)->where('receiver_viewed', 0)->get();
                        $dispute_sent = \App\Dispute::where('sender_id', Auth::user()->id)->where('sender_viewed', 0)->get();
                        $dispute_recieved = \App\Dispute::where('receiver_id', Auth::user()->id)->where('receiver_viewed', 0)->get();
                    @endphp
                <li class="position-relative border-bottom-custom">
                    <a data-toggle="collapse" href="#message" aria-expanded="true" aria-controls="message">
                        <i class="font-size-2rem la la-file-text"></i>
                        <span class="category-name">
                            {{__('Message')}}
                        </span>
                        <i class="fa fa-angle-right rotate-icon pull-right"></i>
                    </a>
                    <ul class="collapse inner-nav bg-white" id="message">
                        <li class="border-bottom-inner {{ areActiveRoutesHome(['conversations.index', 'conversations.show'])}}">
                            <a class="nav-link" href="{{ route('conversations.index')}}">{{__('Conversations')}}
                            @if (count($conversation_sent)+count($conversation_recieved) > 0)
                                <span class="ml-2 text-success"><strong>({{ count($conversation_sent)+count($conversation_recieved) }})</strong></span>
                            @endif
                            </a>
                        </li>
                        @if (\App\BusinessSetting::where('type', 'dispute_system')->first()->value == 1)
                            <li class="border-bottom-inner {{ areActiveRoutesHome(['disputes.index', 'disputes.show'])}}">
                                <a class="nav-link" href="{{route('disputes.index')}}">{{__('Disputes')}}
                                    @if (count($dispute_sent)+count($dispute_recieved) > 0)
                                        <span class="ml-2 text-success"><strong>({{ count($dispute_sent)+count($dispute_recieved) }})</strong></span>
                                    @endif
                                </a>
                            </li>
                        @endif
                         @if (\App\BusinessSetting::where('type', 'product_query')->first()->value == 1)
                            <li class="border-bottom-inner {{ areActiveRoutesHome(['product_query.index', 'product_query.show'])}}">
                                <a class="nav-link" href="{{route('product_query.index')}}">{{__('Product Query')}}
                                @php $product_query = App\ProductQuery::where('user_id',Auth::user()->id)->where('is_viewed',1)->count(); @endphp
                                 @if ($product_query > 0)
                                        <span class="ml-2 text-success"><strong>({{ $product_query  }})</strong></span>
                                    @endif
                                </a>
                            </li>
                        @endif
                    </ul>
                </li>
                @endif

                @if (\App\Addon::where('unique_identifier', 'pos_system')->first() != null && \App\Addon::where('unique_identifier', 'pos_system')->first()->activated)
                    <li class="position-relative border-bottom-custom">
                        <a href="{{route('poin-of-sales.seller_index')}}" class="{{ areActiveRoutesHome(['poin-of-sales.seller_index'])}}">
                            <i class="font-size-2rem la la-fax"></i>
                            <span class="category-name">
                                {{__('POS Manager')}}
                            </span>
                        </a>
                    </li>
                @endif

                @if ($refund_request_addon != null && $refund_request_addon->activated == 1)
                    <li class="position-relative border-bottom-custom">
                        <a href="{{ route('vendor_refund_request') }}" class="{{ areActiveRoutesHome(['vendor_refund_request'])}}">
                            <i class="font-size-2rem la la-file-text"></i>
                            <span class="category-name">
                                {{__('Recieved Refund Request')}}
                            </span>
                        </a>
                    </li>

                    <li class="position-relative border-bottom-custom">
                        <a href="{{ route('customer_refund_request') }}" class="{{ areActiveRoutesHome(['customer_refund_request'])}}">
                            <i class="font-size-2rem la la-file-text"></i>
                            <span class="category-name">
                                {{__('Sent Refund Request')}}
                            </span>
                        </a>
                    </li>
                @endif

                @if ($refund_request_addon != null && $refund_request_addon->activated == 1)
                    <li class="position-relative border-bottom-custom">
                        <a href="{{ route('vendor_refund_request') }}" class="{{ areActiveRoutesHome(['vendor_refund_request'])}}">
                            <i class="font-size-2rem la la-file-text"></i>
                            <span class="category-name">
                                {{__('Recieved Refund Request')}}
                            </span>
                        </a>
                    </li>

                    <li class="position-relative border-bottom-custom">
                        <a href="{{ route('customer_refund_request') }}" class="{{ areActiveRoutesHome(['customer_refund_request'])}}">
                            <i class="font-size-2rem la la-file-text"></i>
                            <span class="category-name">
                                {{__('Sent Refund Request')}}
                            </span>
                        </a>
                    </li>
                @endif

                <li class="position-relative border-bottom-custom">
                    <a href="{{ route('shops.index') }}" class="{{ areActiveRoutesHome(['shops.index'])}}">
                        <i class="font-size-2rem la la-cog"></i>
                        <span class="category-name">
                            {{__('Shop Setting')}}
                        </span>
                    </a>
                </li>

                <li class="position-relative border-bottom-custom">
                    <a data-toggle="collapse" href="#payment" aria-expanded="true" aria-controls="payment">
                        <i class="font-size-2rem la la-file-text"></i>
                        <span class="category-name">
                            {{__('Payment')}}
                        </span>
                        <i class="fa fa-angle-right rotate-icon pull-right"></i>
                    </a>
                    <ul class="collapse inner-nav bg-white" id="payment">
                        <li class="border-bottom-inner {{ areActiveRoutesHome(['payments.index'])}}">
                            <a class="nav-link" href="{{ route('payments.index')}}">{{__('Payment History')}}</a>
                        </li>
                        <li class="border-bottom-inner {{ areActiveRoutesHome(['balance.index'])}}">
                            <a class="nav-link" href="{{route('balance.index')}}"> {{__('Account Balance')}}</a>
                        </li>
                    </ul>
                </li>

                <li class="position-relative border-bottom-custom">
                    <a href="{{ route('profile') }}" class="{{ areActiveRoutesHome(['profile'])}}">
                        <i class="font-size-2rem la la-user"></i>
                        <span class="category-name">
                            {{__('Manage Profile')}}
                        </span>
                    </a>
                </li>

                @if (\App\BusinessSetting::where('type', 'wallet_system')->first()->value == 1)
                    <li class="position-relative border-bottom-custom">
                        <a href="{{ route('wallet.index') }}" class="{{ areActiveRoutesHome(['wallet.index'])}}">
                            <i class="font-size-2rem la la-gbp"></i>
                            <span class="category-name">
                                {{__('My Wallet')}}
                            </span>
                        </a>
                    </li>
                @endif
                @if (\App\Addon::where('unique_identifier', 'affiliate_system')->first() != null && \App\Addon::where('unique_identifier', 'affiliate_system')->first()->activated && Auth::user()->affiliate_user != null && Auth::user()->affiliate_user->status)
                    <li class="position-relative border-bottom-custom">
                        <a href="{{ route('affiliate.user.index') }}" class="{{ areActiveRoutesHome(['affiliate.user.index', 'affiliate.payment_settings'])}}">
                            <i class="font-size-2rem la la-gbp"></i>
                            <span class="category-name">
                                {{__('Affiliate System')}}
                            </span>
                        </a>
                    </li>
                @endif
                @if ($club_point_addon != null && $club_point_addon->activated == 1)
                    <li class="position-relative border-bottom-custom">
                        <a href="{{ route('earnng_point_for_user') }}" class="{{ areActiveRoutesHome(['earnng_point_for_user'])}}">
                            <i class="font-size-2rem la la-gbp"></i>
                            <span class="category-name">
                                {{__('Earning Points')}}
                            </span>
                        </a>
                    </li>
                @endif
                @php
                    $support_ticket = DB::table('tickets')
                                ->where('client_viewed', 0)
                                ->where('user_id', Auth::user()->id)
                                ->count();
                @endphp
                <li class="position-relative border-bottom-custom">
                    <a href="{{ route('support_ticket.index') }}" class="{{ areActiveRoutesHome(['support_ticket.index', 'support_ticket.show'])}}">
                        <i class="font-size-2rem la la-support"></i>
                        <span class="category-name">
                            {{__('Support Ticket')}} @if($support_ticket > 0)<span class="ml-2 text-success"><strong>({{ $support_ticket }} {{ __('New') }})</strong></span></span>@endif
                        </span>
                    </a>
                </li>
            </ul>
        </div>

        <div class="widget-seller-btn pt-4">
            <a href="{{route('downgrade_seller_to_customer')}}" class="btn btn-anim-primary w-100" >{{__('Customer Dashboard')}}</a>
        </div>

        <div class="sidebar-widget-title py-3">
            <span>{{__('Sold Amount')}}</span>
        </div>
        <div class="widget-balance pb-3 pt-1">
            <div class="text-center">
                <div class="heading-4 strong-700 mb-4">
                    @php
                        $orderDetails = \App\OrderDetail::where('seller_id', Auth::user()->id)->where('created_at', '>=', date('-30d'))->get();
                        $total = 0;
                        foreach ($orderDetails as $key => $orderDetail) {
                            if($orderDetail->order->payment_status == 'paid'){
                                if(($orderDetail->delivery_status == 'canceled' || $orderDetail->delivery_status == 'returned' ||$orderDetail->delivery_status == 'refunded') &&  $orderDetail->order->payment_type == 'cash_on_delivery'){
                                    $total = $total;
                                }else{
                                    $total += ($orderDetail->price + $orderDetail->shipping_cost);
                                }
                            }
                        }
                    @endphp
                    <small class="d-block text-sm alpha-5 mb-2">{{__('Your sold amount (current month)')}}</small>
                    <span class="p-2 bg-base-1 rounded">{{ single_price($total) }}</span>
                </div>
                <table class="text-left mb-0 table w-75 m-auto">
                    <tr>
                        @php
                            $orderDetails = \App\OrderDetail::where('seller_id', Auth::user()->id)->get();
                            $total = 0;

                            foreach ($orderDetails as $key => $orderDetail) {

                                if($orderDetail->order->payment_status == 'paid'){
                                    $total += ($orderDetail->price  + $orderDetail->shipping_cost);
                                }
                            }
                        @endphp
                        <td class="p-1 text-sm">
                            {{__('Total Sold')}}:
                        </td>
                        <td class="p-1">
                            {{ single_price($total) }}
                        </td>
                    </tr>
                    <tr>
                        @php
                            $orderDetails = \App\OrderDetail::where('seller_id', Auth::user()->id)->where('created_at', '>=', date('-60d'))->where('created_at', '<=', date('-30d'))->get();

                            $total = 0;
                            foreach ($orderDetails as $key => $orderDetail) {
                                if($orderDetail->order->payment_status == 'paid'){
                                    $total += $orderDetail->price;
                                }
                            }
                        @endphp
                        <td class="p-1 text-sm">
                            {{__('Last Month Sold')}}:
                        </td>
                        <td class="p-1">
                            {{ single_price($total) }}
                        </td>
                    </tr>
                </table>
            </div>
        </div>
       
    </div>
</div>

@if(App\AdvertismentDashboard::first())
<div class="sidebar sidebar--style-3 no-border stickyfill p-0 mt-3">
    <div class="widget mb-0">
        {!! App\AdvertismentDashboard::first()->firstAdvertisment !!}
    </div>
</div>
@endif
