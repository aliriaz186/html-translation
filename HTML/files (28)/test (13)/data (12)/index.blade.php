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
                                <div class="col-md-6 col-12">
                                    <h2 class="heading heading-6 text-capitalize strong-600 mb-0">
                                        {{__('Leave Customer Feedback')}}
                                    </h2>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="float-md-right">
                                        <ul class="breadcrumb">
                                            <li><a href="{{ route('home') }}">{{__('Home')}}</a></li>
                                            <li><a href="{{ route('dashboard') }}">{{__('Dashboard')}}</a></li>
                                                <li class="active"><a href="{{ route('leave-feedback.index') }}">{{__('Feedback')}}</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    
                        <div class="card no-bloyal mt-4 ">
                            <div>
                                <table class="table table-sm table-hover table-responsive-md">
                                    <thead>
                                    <tr>
                                        <th>{{__('#')}}</th>
                                        <th>{{__('Image')}}</th>
                                        <th>{{__('Product Name')}}</th>
                                        <th>{{__('Username')}}</th>
                                        <th>{{__('Unit Price')}}</th>
                                        <th>{{__('Date')}}</th>
                                        <th>{{__('Option')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($feedback as $key => $FB)
                                        <tr>
                                            <td>{{ ($key+1) + ($feedback->currentPage() - 1)*$feedback->perPage() }}</td>
                                            <td>
                                                <a target="_blank" class="media-block">
                                                    <div class="media-left">
                                                        <img loading="lazy"  class="img-md" src="{{ asset($FB->product->thumbnail_img)}}" alt="Image">
                                                    </div>

                                                </a>
                                            </td>
                                            <td>{{$FB->product->name}}</td>
                                            <td>{{$FB->order->user->name}}</td>
                                            <td>{{$FB->product->unit_price}}</td>
                                            <td>{{Carbon\Carbon::parse($FB->product->created_at)->format('y/m/d')}}</td>
                                            <td><a href="{{route('leave-feedback.show',$FB->id)}}" class="btn btn-primary btn-sm">Leave Feedback</a></td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>

                                <div class="pagination-wrapper py-4 pr-4">
                                    <ul class="pagination justify-content-end">
                                        {{ $feedback->links() }}
                                    </ul>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    @endsection
