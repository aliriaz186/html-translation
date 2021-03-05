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
        <div class="title">{{__('Classified Category Suggestions')}}</div>
        <ul>
            @foreach ($subsubcategories as $key => $subsubcategory)
                <li><a href="{{ route('customer_products.subsubcategory', $subsubcategory->slug) }}">{{ __($subsubcategory->name) }}</a></li>
            @endforeach
        </ul>
    @endif
</div>
<div class="product">
    @if (count($products) > 0)
        <div class="title">{{__('Classified Products')}}</div>
        <ul>
            @foreach ($products as $key => $product)

                <li>
                    <a href="{{ route('customer.products', $product->slug) }}">
                        <div class="d-flex search-product align-items-center">
                            <div class="image" style="background-image:url('{{ asset($product->thumbnail_img) }}');">
                            </div>
                            <div class="w-100 overflow--hidden">
                                <div class="product-name text-truncate">

                                    {{ __($product->name) }} <span class="badge badge-danger pull-right mb-2 mt-2 mr-2">{{ucfirst($product->conditon)}}</span>
                                </div>
                                <div class="clearfix">
                                    <div class="price-box float-left">

                                            <span class="product-price strong-400">{{ $product->unit_price }}  Unit Price</span>/<span class=" strong-600">{{ $product->unit }} Unit</span>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </a>
                </li>
            @endforeach
        </ul>
    @endif
</div>
