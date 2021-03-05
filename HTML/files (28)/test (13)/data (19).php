@extends('frontend.layouts.app')

@section('content')

<section class="gry-bg py-4 profile">
    <div class="container-fluid p-4">
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
                                {{__('Product Promote')}}
                            </h2>
                        </div>
                        <div class="col-md-6">
                            <div class="float-md-right">
                                <ul class="breadcrumb">
                                    <li><a href="{{ route('home') }}">{{__('Home')}}</a></li>
                                    <li class="active"><a href="{{ route('promoteproducts') }}">{{__('Promote')}}</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="">
                    <div class="row">
                        <div class="card no-border mt-4" style="width:100%">
                            <div>
                               	<table class="table table-striped res-table mar-no table-responsive-md" cellspacing="0" ;width="100%">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>{{__('Name')}}</th>
                                            <th>{{__('Price')}}</th>
                                            <th>{{__('Start time')}}</th>
                                            <th>{{__('Expire Time')}}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($promotedProducts as $key => $promote)
                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td>{{$promote->name}}</td>
                                            <td>{{$promote->price}}</td>
                                            <td> @php $date = explode(" ",$promote->created_at);@endphp {{$date[0]}}</td>
                                            <td>
                                                @php
                                                   echo date('Y-m-d', strtotime($date[0]. ' + '.$promote->days.' days'));
                                                @endphp</td>
                                          </tr>
                                         @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
</section>
@endsection
