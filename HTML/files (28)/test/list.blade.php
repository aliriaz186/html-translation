@extends('frontend.layouts.app')

@section('content')

    <section class="gry-bg py-4 profile">
        <div class="container-fluid p-4">
            <div class="row cols-xs-space cols-sm-space cols-md-space">
                <div class="col-lg-2-1 d-none d-lg-block">
                    @include('frontend.inc.api_user_side_nav')
                </div>

                <div class="col-lg-9">
                    <div class="main-content">
                        <!-- Page title -->
                        <div class="page-title">
                            <div class="row align-items-center">
                                <div class="col-md-6 col-12">
                                    <h2 class="heading heading-6 text-capitalize strong-600 mb-0">
                                        {{__('API LIST')}}
                                    </h2>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="float-md-right">
                                        <ul class="breadcrumb">
                                            <li><a href="{{ route('home') }}">{{__('Home')}}</a></li>
                                            <li><a href="{{ route('api.user-dashboard') }}">{{__('Dashboard')}}</a></li>
                                            <li class="active"><a href="{{ route('api.list') }}">{{__('Api List')}}</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Order history table -->
                            <div class="card no-border mt-4">
                                <div>
                                    <table class="table table-sm table-hover table-responsive-md">
                                        <thead>
                                        <tr>
                                            <th>{{__('#')}}</th>
                                            <th>{{__('Type Of API')}}</th>
                                            <th>{{__('Description')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($ShippingApi as $key=>$api)
                                            <tr>
                                                <td>{{$key+1}}</td>
                                                <td>{{$api->key_description}}</td>
                                                <td>{{$api->short_description}}</td>
                                            </tr>
                                        @empty 
                                        <tr>
                                            <td class="text-center pt-5 h4" colspan="100%">
                                                <i class="la la-meh-o d-block heading-1 alpha-5"></i>
                                            <span class="d-block">{{ __('No history found.') }}</span>
                                            </td>
                                        </tr>    
                                        @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        <div class="pagination-wrapper py-4">
                            <ul class="pagination justify-content-end">
                                    {{$ShippingApi->links()}}
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection



