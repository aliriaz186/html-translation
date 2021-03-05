@extends('frontend.layouts.app')

@section('content')

    <section class="gry-bg py-4 profile">
        <div class="container-fluid">
            <div class="row cols-xs-space cols-sm-space cols-md-space">
                <div class="col-lg-2-1 d-none d-lg-block">
                    @include('frontend.inc.seller_side_nav')
                </div>

                <div class="col-lg-9">
                    <!-- Page title -->
                    <div class="page-title">
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <h2 class="heading heading-6 text-capitalize strong-600 mb-0">
                                    {{__('Import Data')}}
                                </h2>
                            </div>
                            <div class="col-md-6">
                                <div class="float-md-right">
                                    <ul class="breadcrumb">
                                        <li><a href="{{ route('home') }}">{{__('Home')}}</a></li>
                                        <li class="active"><a href="{{ route('import_data.index') }}">{{__('Import Data')}}</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="">
                        <div class="row">
                            <div class="col-md-3 col-6">
                                <div class="dashboard-widget text-center  mt-4 c-pointer">
                                    <a href="{{route('product_bulk_upload.index')}}" class="d-block">
                                        <img src="https://www.pngkit.com/png/full/129-1298403_upload-files-bank.png" alt="" class="img">
                                        <span class="d-block title heading-3 strong-400">Bulk Upload</span>
                                        <span class="d-block sub-title">{{__('Own Website')}}</span>
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-3 col-6">
                                <div class="dashboard-widget text-center  mt-4 c-pointer">
                                    <a href="{{route('import_data.prestashop')}}" class="d-block">
                                        <img src="https://image.flaticon.com/icons/png/512/825/825533.png" alt="" class="img">
                                        <span class="d-block title heading-3 strong-400">Prestashop</span>
                                        <span class="d-block sub-title">{{__('Framework')}}</span>
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-3 col-6">
                                <div class="dashboard-widget text-center  mt-4 c-pointer">
                                    <a href="{{route('import_data.wordpress')}}" class="d-block">
                                        <img src="https://img.pngio.com/wordpress-icon-papirus-apps-iconset-papirus-development-team-wordpress-icon-png-512_512.png" class="img" alt="">
                                        <span class="d-block title heading-3 strong-400">Wordpress</span>
                                        <span class="d-block sub-title">{{__('ERP')}}</span>
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-3 col-6">
                                <div class="dashboard-widget text-center mt-4 c-pointer">
                                    <a href="{{route('import_data.shopify')}}" class="d-block">
                                        <img src="https://cdn3.iconfinder.com/data/icons/social-media-2068/64/_shopping-512.png" alt="" class="img">
                                        <span class="d-block title heading-3 strong-400">Shopify</span>
                                        <span class="d-block sub-title">{{__('ERP')}}</span>
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-3 col-6">
                                <div class="dashboard-widget text-center mt-4 c-pointer">
                                    <a href="{{route('import_data.amazon')}}" class="d-block">
                                        <img src="https://thumbor.forbes.com/thumbor/fit-in/416x416/filters%3Aformat%28jpg%29/https%3A%2F%2Fspecials-images.forbesimg.com%2Fimageserve%2F5d825aa26de3150009a4616c%2F0x0.jpg%3Fbackground%3D000000%26cropX1%3D0%26cropX2%3D416%26cropY1%3D0%26cropY2%3D416" alt="" class="img">
                                        <span class="d-block title heading-3 strong-400">Amazon</span>
                                        <span class="d-block sub-title">{{__('Marketplace')}}</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
