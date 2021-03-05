@extends('frontend.layouts.app')

@section('content')

    <section class="gry-bg py-4 profile">
        <div class="container-fluid p-4">
            <div class="row cols-xs-space cols-sm-space cols-md-space">
                <div class="col-lg-2-1 d-none d-lg-block">
                    @include('frontend.inc.api_user_side_nav')
                </div>
                <div class="col-lg-9">
                    <!-- Page title -->
                    <div class="page-title">
                        <div class="row align-items-center">
                            <div class="col-md-6 col-12">
                                <h2 class="heading heading-6 text-capitalize strong-600 mb-0">
                                    {{__('Dashboard')}}
                                </h2>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="float-md-right">
                                    <ul class="breadcrumb">
                                        <li><a href="{{ route('home') }}">{{__('Home')}}</a></li>
                                        <li class="active"><a href="{{ route('dashboard') }}">{{__('Dashboard')}}</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- dashboard content -->
                    <div class="">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="dashboard-widget text-center  mt-4 c-pointer">
                                    <a href="javascript:;" class="d-block">
                                        <i class="la la-buysellads"></i>
                                        @if(App\ShippingApi::where('key',Auth::user()->api_key)->get())
                                            <span class="d-block title">{{count(App\ShippingApi::where('key',Auth::user()->api_key)->where('private',0)->get())}} {{__('Api(s)')}}</span>
                                        @else
                                            <span class="d-block title">0 {{__('Api')}}</span>
                                        @endif
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="dashboard-widget text-center  mt-4 c-pointer">
                                    <a href="javascript:;" class="d-block">
                                        <i class="la la-sort-numeric-asc"></i>
                                        <span class="d-block title">{{count(App\ShippingApi::where('private',0)->get()) }} {{__('Total API(s)')}}</span> 
                                    </a>
                                </div>
                            </div>
                        </div>
                        <br>
                        <section class="slice-sm footer-top-bar bg-white">
                            <div class="container sct-inner">
                                <div class="row no-gutters">
                                    <div class="col-lg-3 col-md-6">
                                        <div class="footer-top-box text-center">
                                            <a href="{{route('api.list')}}">
                                                <i class="la la-list-ol"></i>
                                                <h4 class="heading-5">{{__('Api Lists')}}</h4>
                                            </a>
                                        </div>
                                    </div>
                                    <div

                                    class="col-lg-3 col-md-6">
                                        <div class="footer-top-box text-center">
                                            <a href="{{ route('api.register-api') }}">
                                                <i class="la la-registered"></i>
                                                <h4 class="heading-5">{{__('Register Website')}}</h4>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6">
                                        <div class="footer-top-box text-center">
                                            <a href="{{ route('api.change-api') }}">
                                                <i class="la la-repeat"></i>
                                                <h4 class="heading-5">{{__('Change Api')}}</h4>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6">
                                        <div class="footer-top-box text-center">
                                            <a href="{{ route('api.update-api-profile') }}">
                                                <i class="la la-user"></i>
                                                <h4 class="heading-5">{{__('Edit Profile')}}</h4>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <section class="slice-sm footer-top-bar bg-white">
                            <div class="container sct-inner">
                                <div class="row no-gutters">
                                    <div class="col-lg-3 col-md-6">
                                        <div class="footer-top-box text-center">
                                            <a href="{{route('api.list')}}">
                                                <i class="fa fa-file-pdf-o"></i>
                                                <h4 class="heading-5">{{__('Documentation')}}</h4>
                                            </a>
                                        </div>
                                    </div>
                                    <div

                                    class="col-lg-3 col-md-6">
                                        <div class="footer-top-box text-center">
                                            <a href="{{ route('api.register-api') }}">
                                                <i class="fa fa-envelope-o"></i>
                                                <h4 class="heading-5">{{__('Email')}}</h4>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6">
                                        <div class="footer-top-box text-center">
                                            <a href="tel:+441415360882">
                                                <i class="la la-phone"></i>
                                                <h4 class="heading-5">{{__('Phone')}}</h4>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6">
                                        <div class="footer-top-box text-center">
                                            <a target="_blank" href="/chat/seller-support/help.php" onclick="window.open('chat/seller-support/help.php','USC Chat Widget','width=600,height=600')">
                                                <i class="la la-comment"></i>
                                                <h4 class="heading-5">{{__('Chat')}}</h4>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-box bg-white mt-4">
                                    <div class="form-box-title px-3 py-2 clearfix ">
                                        {{__('API Info')}}
                                    </div>
                                    <div class="form-box-content p-3">
                                        <table>
                                            <tr>
                                                <td>{{__('API Key')}}:</td>
                                                 <td class="p-2">{{ Auth::user()->api_key }}</td> 
                                            </tr>
                                            <tr>
                                                <td>{{__('API Type')}}:</td>
                                                <td class="p-2">{{ App\ShippingApi::where('key',Auth::user()->api_key)->first()->key_description }}</td> 
                                            </tr>

                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-box bg-white mt-4">
                                    <div class="form-box-title px-3 py-2 clearfix ">
                                        {{__('Account Details')}}
                                         <div class="float-right">
                                            <a href="{{ route('api.update-api-profile') }}" class="btn btn-link btn-sm">{{__('Edit')}}</a>
                                        </div>
                                    </div>
                                    <div class="form-box-content p-3">
                                        <table>
                                            <tr>
                                                <td>{{__('Name')}}:</td>
                                                 <td class="p-2">{{ Auth::user()->name}}</td> 
                                            </tr>
                                            <tr>
                                                <td>{{__('Email')}}:</td>
                                                <td class="p-2">{{ Auth::user()->email }}</td>
                                            </tr>

                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
    
     <section class="gry-bg profile">
	<div class="container-fluid py-1 p-4">
	    <div class="row cols-xs-space cols-sm-space cols-md-space">
	        <div class="col-lg-2-1 d-none d-lg-block">
	        </div>
	         <div class="col-lg-9 d-none d-lg-block">
	         	 @if(App\AdvertismentDashboard::first())
	                            {!! App\AdvertismentDashboard::first()->secondAdvertisment !!}
	                @endif
	         </div>
	    </div>
	 </div>
    </section> 
    
    @endsection
