@extends('frontend.layouts.app')
@section('content')

<section class="gry-bg py-4 profile">
        <div class="container">
            <div class="row cols-xs-space cols-sm-space cols-md-space">
                <div class="col-lg-3 d-none d-lg-block">@include('frontend.inc.seller_side_nav')</div>
                <div class="col-lg-9">
                    <!-- Page title -->
                    <div class="page-title">
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <h2 class="heading heading-6 text-capitalize strong-600 mb-0">
                                            {{__('Shopify Import')}}
                                </h2>
                            </div>
                            <div class="col-md-6">
                                <div class="float-md-right">
                                    <ul class="breadcrumb">
                                            <li><a href="{{ route('home') }}">{{__('Home')}}</a>
                                            </li>
                                            <li class="active"><a href="{{ route('import_data.shopify') }}">{{__('Shopify Import')}}</a>
                                            </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="">
                        <div class="row">{{-- card no-border mt-4 --}}
                            <div style="width:100%">
                                <div class="card no-border mt-4" style="width:100%">
                                    <div class="card-header py-3">
                                        <h4 class="mb-0 h6">Shopify Register</h4>
                                    </div>
                                    <div class="card-body">
                                        <form action="{{route('shopify.register')}}" method="POST">
                                        @csrf
                                            <div class="form-group">
                                                <label for="SHOPIFY_API_KEY">SHOPIFY_API_KEY</label>
                                                <input type="text" id="SHOPIFY_API_KEY" required class="form-control" name="SHOPIFY_API_KEY" placeholder="Api key" value="{{ old('SHOPIFY_API_KEY')}}">
                                            </div>
                                            <div class="form-group">
                                                <label for="SHOPIFY_API_SECRET">SHOPIFY_API_SECRET</label>
                                                <input type="password" id="SHOPIFY_API_SECRET" required class="form-control" name="SHOPIFY_API_SECRET" placeholder="Password" >
                                            </div>
                                            <div class="form-group">
                                                <label for="SHOPIFY_API_KEY">SHOPIFY_ACCESS_TOKEN</label>
                                                <input type="text" id="SHOPIFY_ACCESS_TOKEN" required class="form-control" name="SHOPIFY_ACCESS_TOKEN" placeholder="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" value="{{ old('SHOPIFY_ACCESS_TOKEN')}}">
                                            </div>
                                            <div class="form-group">
                                                <label for="SHOPIFY_API_KEY">SHOPIFY_SHOP_DOMAIN</label>
                                                <input type="text" id="SHOPIFY_SHOP_DOMAIN" required class="form-control" name="SHOPIFY_SHOP_DOMAIN" placeholder="shopfytolaravel.myshopify.com" value="{{ old('SHOPIFY_SHOP_DOMAIN')}}">
                                            </div>
                                            <div class="form-group">
                                                <input type="submit" value="Register" class="btn btn-success pull-right">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>
@endsection
