@extends('frontend.layouts.app')

@section('content')

    <section class="gry-bg py-4 profile">
        <div class="container-fluid p-4">
            <div class="row cols-xs-space cols-sm-space cols-md-space">
                <div class="col-lg-2-1 d-none d-lg-block">
                    @include('frontend.inc.customer_side_nav')
                </div>

                <div class="col-lg-9">
                    <div class="main-content">
                        <!-- Page title -->
                        <div class="page-title">
                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <h2 class="heading heading-6 text-capitalize strong-600 mb-0">
                                        {{__('Vouchers')}}
                                    </h2>
                                </div>
                                <div class="col-md-6">
                                    <div class="float-md-right">
                                        <ul class="breadcrumb">
                                            <li><a href="{{ route('home') }}">{{__('Home')}}</a></li>
                                            <li><a href="{{ route('dashboard') }}">{{__('Dashboard')}}</a></li>
                                            <li class="active"><a href="{{ route('vouchers.index') }}">{{__('Vouchers')}}</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Order history table -->
                        <div class="card no-border mt-4">
                            <div class="card-header">
                                {{__('Vouchers  List')}}
                            </div>
                            <div class="card-body">
                                    <table class="table table-sm table-hover table-responsive-md">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>{{__('Code')}}</th>
                                                <th>{{__('Discount')}}</th>
                                                <th>{{__('Min Buy')}}</th>
                                                <th>{{__('Max Discount')}}</th>
                                                <th>{{__('Description')}}</th>
                                                <th>{{__('Validity')}}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @if(count($vouchers)>0)
                                                @foreach ($vouchers as $key=>$voucher)
                                                    <tr>
                                                        <td>{{ $key+1 }} </td>
                                                        <td> <span class="badge badge-lg badge-pill bg-blue" style="font-size:1rem;">{{$voucher->coupon_code}}</span></td>
                                                        <td>{{$voucher->discount}}</td>
                                                        <td>{{$voucher->min_buy}}</td>
                                                        <td>{{$voucher->max_discount}}</td>
                                                        <td>{{$voucher->description}}</td>
                                                        <td>{{ date('d-m-Y', $voucher->start_date ) }} to {{ date('d-m-Y', $voucher->end_date ) }}</td>
                                                    </tr>
                                                @endforeach
                                         @else
                                         	 <tr>
                                                <td class="text-center pt-5 h4" colspan="100%">
                                                    <i class="la la-meh-o d-block heading-1 alpha-5"></i>
                                                <span class="d-block">{{ __('No history found.') }}</span>
                                                </td>
                                            </tr>
                                         @endif       
                                        </tbody>
                                    </table>
                            </div>
                        </div>
                        <div class="pagination-wrapper py-4">
                            <ul class="pagination justify-content-end">
                                {{ $vouchers->links() }}
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

