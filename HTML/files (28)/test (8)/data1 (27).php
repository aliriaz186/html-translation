<div class="keyword">
    @if (sizeof($keywords) > 0)
        <div class="title">{{__('Popular Suggestions')}}</div>
        <ul>
            @foreach ($keywords as $key => $keyword)
                <li><a href="{{ route('suggestion.search', $keyword) }}">{{ $keyword }}</a></li>
            @endforeach
        </ul>
    @endif
</div>
<div class="category">
    @if (count($subsubcategories) > 0)
        <div class="title">{{__('Category Suggestions')}}</div>
        <ul>
            @foreach ($subsubcategories as $key => $subsubcategory)
                <li><a href="{{ route('products.subsubcategory', $subsubcategory->slug) }}">{{ __($subsubcategory->name) }}</a></li>
            @endforeach
        </ul>
    @endif
</div>
<div class="product">
    @if (count($products) > 0)
        <div class="title">{{__('Products')}}</div>
        <ul>
            @foreach ($products as $key => $product)
                <li>
                    <a href="{{ route('product', $product->slug) }}">
                        <div class="d-flex search-product align-items-center">
                            <div class="image" style="background-image:url('{{ asset($product->thumbnail_img) }}');">
                            </div>
                            <div class="w-100 overflow--hidden">
                                <div class="product-name text-truncate">
                                    {{ __($product->name) }}  @if(App\promote::where('product_id',$product->id)->first())<span class="badge badge-danger pull-right mb-2 mt-2 mr-2">Promoted</span> @endif                      
                                                              @if($product->FreeReturn_id) <span class="badge badge-success pull-right mb-2 mt-2 mr-2">Free Return</span> @endif
                                </div>
                                <div class="clearfix">
                                    <div class="price-box float-left">
                                        @if(home_base_price($product->id) != home_discounted_base_price($product->id))
                                            <del class="old-product-price strong-400">{{ home_base_price($product->id) }}</del>
                                        @endif
                                        <span class="product-price strong-600">{{ home_discounted_base_price($product->id) }}</span>
                                    </div>
                                    {{-- <div class="stock-box float-right">
                                        @php
                                            $qty = 0;
                                            foreach (json_decode($product->variations) as $key => $variation) {
                                                $qty += $variation->qty;
                                            }
                                        @endphp
                                        @if(count(json_decode($product->variations, true)) >= 1)
                                            @if ($qty > 0)
                                                <span class="badge badge-pill bg-green">{{__('In stock')}}</span>
                                            @else
                                                <span class="badge badge badge-pill bg-red">{{__('Out of stock')}}</span>
                                            @endif
                                        @endif
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                    </a>
                </li>
            @endforeach
        </ul>
    @endif
</div>
@if(\App\BusinessSetting::where('type', 'vendor_system_activation')->first()->value == 1)
    <div class="product">
        @if (count($shops) > 0)
            <div class="title">{{__('Shops')}}</div>
            <ul>
                @foreach ($shops as $key => $shop)
                    <li>
                        <a href="{{ route('shop.visit', $shop->slug) }}">
                            <div class="d-flex search-product align-items-center">
                                <div class="image" style="background-image:url('{{ asset($shop->logo) }}');">
                                </div>
                                <div class="w-100 overflow--hidden ">
                                    <div class="product-name text-truncate heading-6 strong-600">
                                        {{ $shop->name }}

                                        <div class="stock-box d-inline-block">
                                            @if($shop->user->seller->verification_status == 1)
                                                <span class="ml-2"><i class="fa fa-check-circle" style="color:green"></i></span>
                                            @else
                                                <span class="ml-2"><i class="fa fa-times-circle" style="color:red"></i></span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="price-box alpha-6">
                                        {{ $shop->address }}
                                    </div>
                                </div>
                            </div>
                        </a>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
@endif

<div class="product">
    @if (count($users) > 0)
        <div class="title">{{__('Usernames')}}</div>
        <ul>
            @foreach ($users as $key => $user)
                <li>
                    <a href="{{ route('user.feedback', encrypt($user->id)) }}">
                        <div class="d-flex search-product align-items-center">
                            @if ($user->avatar_original != null)
                            <div class="image" style="background-image:url('{{ asset($user->avatar_original) }}')"></div>
                        @else
                            <img src="{{ asset('frontend/images/user.png') }}" class="image rounded-circle">
                        @endif
                            <div class="w-100 overflow--hidden ">
                                <div class="product-name text-truncate heading-6 strong-600">
                                    {{ $user->name }}
                                </div>
                                <div class="price-box alpha-6">
                                    {{ $user->address }}
                                </div>
                            </div>
                        </div>
                    </a>
                </li>
            @endforeach
        </ul>
    @endif
</div>
