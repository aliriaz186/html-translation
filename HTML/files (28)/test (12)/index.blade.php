@extends('frontend.layouts.app')

@section('content')

    <section class="gry-bg py-4 profile">
        <div class="container-fluid">
            <div class="row cols-xs-space cols-sm-space cols-md-space">
                <div class="col-lg-2-1 d-none d-lg-block">
                        @include('frontend.inc.seller_side_nav')
                </div>

                <div class="col-lg-9">
                    <div class="main-content">
                        <!-- Page title -->
                        <div class="page-title">
                            <div class="row align-items-center">
                                <div class="col-md-6 col-12">
                                    <h2 class="heading heading-6 text-capitalize strong-600 mb-0">
                                        {{__('Companies List')}}
                                    </h2>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="float-md-right">
                                        <ul class="breadcrumb">
                                            <li><a href="{{ route('home') }}">{{__('Home')}}</a></li>
                                            <li><a href="{{ route('dashboard') }}">{{__('Dashboard')}}</a></li>
                                            <li class="active"><a href="{{ route('shipping-companies') }}">{{__('Register companies')}}</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                            <div class="card no-border mt-4">
                                <div>
                                    <table class="table table-sm table-hover table-responsive-md">
                                        <thead>
                                        <tr>
                                            <th>{{__('#')}}</th>
                                            <th style="width: 100%">{{__('Name')}}</th>
                                            {{-- <th>{{__('Website Url')}}</th>
                                            <th>{{__('Created At')}}</th> --}}
                                            <th>{{__('Connect')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($RegisterApiCompany as $key=>$RAIC)
                                            <tr>
                                                @php
                                                    $url = $RAIC->website_url;
                                                    $parts = parse_url($url);
                                                    $str = $parts['host'];
                                                    $company_name_without_com = str_replace(".com","",$str);
                                                    $company_name = str_replace("www.","",$company_name_without_com);

                                                @endphp
                                                    <td> {{ ($key+1) + ($RegisterApiCompany->currentPage() - 1)*$RegisterApiCompany->perPage() }}</td>

                                                    <td>{{$company_name}}</td>
                                                    <td><a class="btn btn-success" href="{{route('shipping-companies.show',$RAIC->id)}}">Connect</a></td>
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
                        <div class="pagination-wrapper py-1">
                            <ul class="pagination justify-content-end">
                                {{$RegisterApiCompany->links()}}
                            </ul>
                        </div>
                        
                        <div class="col-md-6 col-12">
                                    <h2 class="heading heading-6 text-capitalize strong-600 mb-0">
                                        {{__('Registered Companies')}}
                                    </h2>
                                </div>
                                
                        <div class="card no-border mt-3">
                            <div>
                                <table class="table table-sm table-hover table-responsive-md">
                                    <thead>
                                    <tr>
                                        <th>{{__('#')}}</th>
                                        <th>{{__('Name')}}</th>
                                        <th>{{__('Public Key')}}</th>
                                        <th>{{__('Private Key')}}</th>
                                        <th>{{__('Created At')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($RegisterApiCompany_Registered as $key=>$RAIC_REG)
                                        <tr>
                                                <td> {{ ($key+1) + ($RegisterApiCompany_Registered->currentPage() - 1)*$RegisterApiCompany_Registered->perPage() }}</td>
                                                <td>{{$RAIC_REG->company->key_description}}</td>
                                                <td>{{$RAIC_REG->public_api_key}}</td>
                                                <td>{{$RAIC_REG->seller_private_key}}</td>
                                                <td>{{Carbon\Carbon::parse($RAIC_REG->created_at)->format('d-m-Y')}}</td>
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
                    <div class="pagination-wrapper py-1">
                        <ul class="pagination justify-content-end">
                            {{$RegisterApiCompany_Registered->links()}}
                        </ul>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
