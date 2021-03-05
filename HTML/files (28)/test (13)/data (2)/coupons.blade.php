@extends('frontend.layouts.app')

@section('content')

    <section class="gry-bg py-4 profile">
        <div class="container-fluid p-4">
            <div class="row cols-xs-space cols-sm-space cols-md-space">
                <div class="col-lg-2-1 d-none d-lg-block">
                    @include('frontend.inc.seller_side_nav')
                </div>

                <div class="col-lg-9">
                    <div class="main-content">
                        <!-- Page title -->
                        <div class="page-title">
                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <h2 class="heading heading-6 text-capitalize strong-600 mb-0">
                                        {{__('coupons')}}
                                    </h2>
                                </div>
                                <div class="col-md-6">
                                    <div class="float-md-right">
                                        <ul class="breadcrumb">
                                            <li><a href="{{ route('home') }}">{{__('Home')}}</a></li>
                                            <li><a href="{{ route('dashboard') }}">{{__('Dashboard')}}</a></li>
                                            <li><a href="{{ route('create-coupons') }}">{{__('coupons')}}</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                            <div class="row">
                                <div class="col-md-4 offset-md-4">
                                    <a class="cursor dashboard-widget text-center plus-widget mt-4 d-block"  data-toggle="modal" data-target="#createCoupons">
                                        <i class="la la-plus"></i>
                                        <span class="d-block title heading-6 strong-400 c-base-1">{{ __('Add New coupon') }}</span>
                                    </a>
                                </div>
                            </div>

                        <div class="card no-border mt-4">
                            <div class="card-header py-2 cursor">
                                <div class="row align-items-center">
                                    <div class="col-md-6 col-xl-3">
                                        <h6 class="mb-0">All coupons</h6>
                                    </div>
                                    <div class="col-md-6 col-xl-3 ml-auto">
                                        <form class="" action="" method="GET">
                                            <input type="text" class="form-control" id="search" name="search" @isset($search) value="{{ $search }}" @endisset placeholder="Search coupon">
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <table class="table table-sm table-hover table-responsive-md">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>{{__('Type')}}</th>
                                            <th>{{__('Price')}}</th>
                                            <th>{{__('From')}}</th>
                                            <th>{{__('Until')}}</th>
                                            <th>{{__('Sidewide')}}</th>
                                            <th>{{__('Min orders')}}</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($coupons as $key => $coupon)
                                            <tr>
                                                <td>{{ ($key+1) }}</td>
                                                <td>{{$coupon->type}}</td>
                                                <td>{{$coupon->amount}}</td>
                                                <td>{{$coupon->valid_from}}</td>
                                                <td>{{$coupon->valid_until}}</td>
                                                <td>{{$coupon->sitewide}}</td>
                                                <td>{{$coupon->min_order}}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="pagination-wrapper py-4">
                            <ul class="pagination justify-content-end">
                                {{ $coupons->links() }}
                            </ul>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

@include('frontend.partials.forms')

@endsection
@section('script')
<script>


    $('#sitewide').on('change', function() {
                 if(this.value == 'no'){
                    $('.demo-select2').select2();
                    $('#hidden').toggle();
                }else{
                    $('#hidden').css('display','none');

                }

        });




</script>

@endsection
