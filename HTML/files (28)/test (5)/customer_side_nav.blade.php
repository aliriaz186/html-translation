<div class="sidebar sidebar--style-3 no-border stickyfill p-0">
    <div class="widget mb-0">
        <div class="widget-profile-box text-center p-3">
            @if (Auth::user()->avatar_original != null)
                <div class="image" style="background-image:url('{{ asset(Auth::user()->avatar_original) }}')"></div>
            @else
                <img src="{{ asset('frontend/images/user.png') }}" class="image rounded-circle">
            @endif
            <div class="name">{{ Auth::user()->username }}</div>
                <span class="star-rating star-rating-sm d-block">
                    @php
                        if(isset(Auth::user()->customer->id)){$rating = App\Feedback::where('customer_id',Auth::user()->customer->id)->avg('rating');}
                        else{$rating=0;}
                        @endphp
                    @if ($rating > 0 && (Auth::user()->decide_type == 3 || Auth::user()->decide_type == 1 ))
                        {{ renderStarRating($rating) }}   {{Customer_average_percentage(Auth::user()->customer->id)}}%
                    @else
                        {{ renderStarRating(0) }} 0%
                    @endif
                </span>
        </div>
        <div class="sidebar-widget-title py-3">
            <span>{{__('Menu')}}</span>
        </div>
        <div class="widget-profile-menu py-3">
            <ul class="categories categories--style-3">
                <li>
                    <a href="{{ route('dashboard') }}" class="{{ areActiveRoutesHome(['dashboard'])}}">
                        <i class="la la-dashboard"></i>
                        <span class="category-name">
                            {{__('Dashboard')}}
                        </span>
                    </a>
                </li>

                @if(\App\BusinessSetting::where('type', 'classified_product')->first()->value == 1)
                <li>
                    <a href="{{ route('customer_products.index') }}" class="{{ areActiveRoutesHome(['customer_products.index', 'customer_products.create', 'customer_products.edit'])}}">
                        <i class="la la-diamond"></i>
                        <span class="category-name">
                            {{__('Classified Products')}}
                        </span>
                    </a>
                </li>
                @endif
                @php
                $delivery_viewed = App\Order::where('user_id', Auth::user()->id)->where('delivery_viewed', 0)->get()->count();
                $payment_status_viewed = App\Order::where('user_id', Auth::user()->id)->where('payment_status_viewed', 0)->get()->count();
                $refund_request_addon = \App\Addon::where('unique_identifier', 'refund_request')->first();
                $club_point_addon = \App\Addon::where('unique_identifier', 'club_point')->first();
                @endphp
                <li>
                    <a href="{{ route('purchases.index') }}" class="{{ areActiveRoutesHome(['purchases.index'])}}">
                        <i class="la la-file-text"></i>
                        <span class="category-name">
                            {{__('Purchases')}} @if($delivery_viewed > 0 || $payment_status_viewed > 0)<span class="ml-2" style="color:green"><strong>({{ __('New Notifications') }})</strong></span>@endif
                        </span>
                    </a>
                </li>

                @if ($refund_request_addon != null && $refund_request_addon->activated == 1)
                    <li>
                        <a href="{{ route('customer_refund_request') }}" class="{{ areActiveRoutesHome(['customer_refund_request'])}}">
                            <i class="la la-file-text"></i>
                            <span class="category-name">
                                {{__('Sent Refund Request')}}
                            </span>
                        </a>
                    </li>
                @endif

                <li>
                    <a href="{{ route('wishlists.index') }}" class="{{ areActiveRoutesHome(['wishlists.index'])}}">
                        <i class="la la-heart-o"></i>
                        <span class="category-name">
                            {{__('Wishlist')}}
                        </span>
                    </a>
                </li>
                     <li>
                    <a href="{{ route('best_seller.index') }}" class="{{ areActiveRoutesHome(['best_seller.index'])}}">
                        <i class="la la-user"></i>
                        <span class="category-name">
                            {{__('Saved Sellers')}}
                            @php $totalSeller = App\BestSellerByCustomer::where('user_id',Auth::user()->id)->where('is_viewed',1)->get(); @endphp
                              @if (count($totalSeller ) > 0)
                                    <span class="ml-2" style="color:green"><strong>({{ count($totalSeller) }})</strong></span>
                                @endif
                        </span>
                    </a>
                </li>
                @if (\App\BusinessSetting::where('type', 'conversation_system')->first()->value == 1)
                    @php
                        $conversation = \App\Conversation::where('sender_id', Auth::user()->id)->where('sender_viewed', 0)->get();
                    @endphp
                    <li>
                        <a href="{{ route('conversations.index') }}" class="{{ areActiveRoutesHome(['conversations.index', 'conversations.show'])}}">
                            <i class="la la-comment"></i>
                            <span class="category-name">
                                {{__('Conversations')}}
                                @if (count($conversation) > 0)
                                    <span class="ml-2" style="color:green"><strong>({{ count($conversation) }})</strong></span>
                                @endif
                            </span>
                        </a>
                    </li>
                @endif
                @if (\App\BusinessSetting::where('type', 'dispute_system')->first()->value == 1)
                    @php
                        $dispute = \App\Dispute::where('sender_id', Auth::user()->id)->where('sender_viewed', 0)->get();
                    @endphp
                    <li>
                        <a href="{{ route('disputes.index') }}" class="{{ areActiveRoutesHome(['disputes.index', 'disputes.show'])}}">
                            <i class="la la-comment"></i>
                            <span class="category-name">
                                {{__('Disputes')}}
                                @if (count($dispute) > 0)
                                    <span class="ml-2" style="color:green"><strong>({{ count($dispute) }})</strong></span>
                                @endif
                            </span>
                        </a>
                    </li>
                @endif
                <li>
                    <a href="{{ route('profile') }}" class="{{ areActiveRoutesHome(['profile'])}}">
                        <i class="la la-user"></i>
                        <span class="category-name">
                            {{__('Manage Profile')}}
                        </span>
                    </a>
                </li>
                @if (\App\BusinessSetting::where('type', 'wallet_system')->first()->value == 1)
                    <li>
                        <a href="{{ route('wallet.index') }}" class="{{ areActiveRoutesHome(['wallet.index'])}}">
                            <i class="la la-gbp"></i>
                            <span class="category-name">
                                {{__('My Wallet')}}
                            </span>
                        </a>
                    </li>
                @endif

                @if ($club_point_addon != null && $club_point_addon->activated == 1)
                    <li>
                        <a href="{{ route('earnng_point_for_user') }}" class="{{ areActiveRoutesHome(['earnng_point_for_user'])}}">
                            <i class="la la-gbp"></i>
                            <span class="category-name">
                                {{__('Earning Points')}}
                            </span>
                        </a>
                    </li>
                @endif

                @if (\App\Addon::where('unique_identifier', 'affiliate_system')->first() != null && \App\Addon::where('unique_identifier', 'affiliate_system')->first()->activated && Auth::user()->affiliate_user != null && Auth::user()->affiliate_user->status)
                    <li>
                        <a href="{{ route('affiliate.user.index') }}" class="{{ areActiveRoutesHome(['affiliate.user.index', 'affiliate.payment_settings'])}}">
                            <i class="la la-gbp"></i>
                            <span class="category-name">
                                {{__('Affiliate System')}}
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
                <li>
                    <a href="{{ route('support_ticket.index') }}" class="{{ areActiveRoutesHome(['support_ticket.index'])}}">
                        <i class="la la-support"></i>
                        <span class="category-name">
                            {{__('Support Ticket')}} @if($support_ticket > 0)<span class="ml-2" style="color:green"><strong>({{ $support_ticket }} {{ __('New') }})</strong></span></span>@endif
                        </span>
                    </a>
                </li>
            </ul>
        </div>
        @if (\App\BusinessSetting::where('type', 'vendor_system_activation')->first()->value == 1)
            <div class="widget-seller-btn pt-4">
                @if(App\Shop::where('user_id',Auth::user()->id)->first())
                    @if(Auth::user()->disabled_by_user==2)
                    <a class="btn btn-anim-primary w-100 " href="#"  data-toggle="tooltip" title="Seller Account Suspended Contact Admin to reopen it">{{__('Seller Dashboard')}}</a>
                    @else
                    <a href="{{ route('upgrade_customer_to_seller') }}" class="btn btn-anim-primary w-100">{{__('Seller Dashboard')}}</a>
                    @endif
                    @else
                    <a href="{{ route('shops.create') }}" class="btn btn-anim-primary w-100">{{__('Be A Seller')}}</a>
                @endif

            </div>
        @endif
    </div>
</div>
@if(App\AdvertismentDashboard::first())
<div class="sidebar sidebar--style-3 no-border stickyfill p-0 mt-3">
    <div class="widget mb-0">
        {!! App\AdvertismentDashboard::first()->firstAdvertisment !!}
    </div>
</div>
@endif
