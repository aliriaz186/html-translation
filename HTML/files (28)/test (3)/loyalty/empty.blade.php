@extends('frontend.layouts.app')
@section('content')
    <section class="gry-bg py-4 profile">
        <div class="container-fluid p-4">
            <div class="row cols-xs-space cols-sm-space cols-md-space">
                <div class="col-lg-2-1 d-none d-lg-block">
                    @include('frontend.inc.customer_side_nav')
                </div>

                <div class="col-lg-7">
                    <div class="main-content">
                          <div class="page-title">
                                <div class="row align-items-center">
                                    <div class="col-md-6 col-12">
                                        <h2 class="heading heading-6 text-capitalize strong-600 mb-0">
                                            {{__('Loyalty')}}
                                        </h2>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="float-md-right">
                                            <ul class="breadcrumb">
                                                <li><a href="{{ route('home') }}">{{__('Home')}}</a></li>
                                                <li><a href="{{ route('dashboard') }}">{{__('Dashboard')}}</a></li>
                                                <li class="active"><a href="{{ route('loyalty.index') }}">{{__('Loyalty')}}</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        <div class="card no-bloyal mt-4">
                            <div>
                                <table class="table table-sm table-hover table-responsive-md">
                                    <thead>
                                    <tr>
                                        <th>{{__('#')}}</th>
                                        <th>{{__('Date')}}</th>
                                        <th>{{__('Loyal Code')}}</th>
                                        <th>{{__('Purchase Item')}}</th>
                                        <th>{{__('Point Status')}}</th>
                                        <th>{{__('Point Earned')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="text-center pt-5 h4" colspan="100%">
                                                <i class="la la-meh-o d-block heading-1 alpha-5"></i>
                                            <span class="d-block">{{ __('Loyality is not available yet.') }}</span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-2 mt-1 theme_color">
                    <div class="top bg-white mt-5 ">
                        <div class="upper text-center p-3">{{__('Total Points')}}</div>
                        <div class="lower">
                            <h3 class="text-center">{{__('0')}}<span>{{__('/p')}}</span></h3>
                        </div>
                    </div>
                    <div class="bottom bg-white mt-2">
                        <div class="upper text-center p-3">{{__('Points Value')}}</div>
                        <div class="lower">
                        <h3 class="text-center">{{__('0')}}</h3>
                        </div>
                    </div>

                    <div class="top bg-white mt-2">
                        <div class="upper text-center p-3">{{__('Total Rewards')}}</div>
                        <div class="lower">
                                <h3 class="text-center">{{currency_symbol()}}{{__('0')}}</h3>
                        </div>
                    </div>

                    <div  class="bottom bg-white mt-2 "id="pandingReward">
                        <div class="upper text-center p-3">{{__('Panding Rewards')}}</div>
                        <div class="lower">
                            <h3 class="text-center">{{currency_symbol()}}{{__('0')}}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

