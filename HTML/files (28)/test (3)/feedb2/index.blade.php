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
                                <div class="col-md-6 col-12">
                                    <h2 class="heading heading-6 text-capitalize strong-600 mb-0">
                                        {{__('Feedback')}}
                                    </h2>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="float-md-right">
                                        <ul class="breadcrumb">
                                            <li><a href="{{ route('home') }}">{{__('Home')}}</a></li>
                                            <li><a href="{{ route('dashboard') }}">{{__('Dashboard')}}</a></li>
                                            @if(Auth::user()->user_type == 'seller')
                                                <li class="active"><a href="{{ route('leave-feedback.index') }}">{{__('Feedback')}}</a></li>
                                            @else
                                                <li class="active"><a href="{{ route('customer-feedback.index') }}">{{__('Feedback')}}</a></li>
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card no-bloyal mt-4">
                            <div>
                            <table class="table table-stripped text-center table-bordered mb-4 pb-4 bg-white">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>1 month</th>
                                        <th>6 month</th>
                                        <th>12 months</th>
                                        <th> Lifetime</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $id = Auth::user()->customer->id;
                                    @endphp
                                  <tr>
                                        <td>Positive</td>
                                        <td>{{count(App\Feedback::where('customer_id',$id)->where('status',1)->where('created_at','>',\Carbon\Carbon::now()->subMonths(1))->where('rating','>',3)->get())}}</td>
                                        <td>{{count(App\Feedback::where('customer_id',$id)->where('status',1)->where('created_at','>',\Carbon\Carbon::now()->subMonths(6))->where('rating','>',3)->get())}}</td>
                                        <td>{{count(App\Feedback::where('customer_id',$id)->where('status',1)->where('created_at','>',\Carbon\Carbon::now()->subMonths(12))->where('rating','>',3)->get())}}</td>
                                        <td>{{count(App\Feedback::where('customer_id',$id)->where('status',1)->where('created_at','>',\Carbon\Carbon::now()->subYears(12))->where('rating','>',3)->get())}}</td>   
                                     </tr>
                                  
                                    <tr>
                                        <td>Neutal</td>
                                        <td>{{count(App\Feedback::where('customer_id',$id)->where('status',1)->where('created_at','>',\Carbon\Carbon::now()->subMonths(1))->where('rating',3)->get())}}</td>
                                        <td>{{count(App\Feedback::where('customer_id',$id)->where('status',1)->where('created_at','>',\Carbon\Carbon::now()->subMonths(6))->where('rating',3)->get())}}</td>
                                        <td>{{count(App\Feedback::where('customer_id',$id)->where('status',1)->where('created_at','>',\Carbon\Carbon::now()->subMonths(12))->where('rating',3)->get())}}</td>
                                        <td>{{count(App\Feedback::where('customer_id',$id)->where('status',1)->where('created_at','>',\Carbon\Carbon::now()->subYears(12))->where('rating',3)->get())}}</td>  

                                    </tr> 
                                     <tr>
                                        <td>Negative</td>
                                        <td>{{count(App\Feedback::where('customer_id',$id)->where('status',1)->where('created_at','>',\Carbon\Carbon::now()->subMonths(1))->where('rating','<',3)->get())}}</td>
                                        <td>{{count(App\Feedback::where('customer_id',$id)->where('status',1)->where('created_at','>',\Carbon\Carbon::now()->subMonths(6))->where('rating','<',3)->get())}}</td>
                                        <td>{{count(App\Feedback::where('customer_id',$id)->where('status',1)->where('created_at','>',\Carbon\Carbon::now()->subMonths(12))->where('rating','<',3)->get())}}</td>
                                        <td>{{count(App\Feedback::where('customer_id',$id)->where('status',1)->where('created_at','>',\Carbon\Carbon::now()->subYears(12))->where('rating','<',3)->get())}}</td>  
                                      </tr>
                                </tbody>
                            </table>
                            <br><br>
                        </div> 
                        </div>   
                        <div class="card no-bloyal mt-4">
                                <table class="table table-sm table-hover table-responsive-md">
                                    <thead>
                                    <tr>
                                        <th>{{__('#')}}</th>
                                        <th>{{__('Image')}}</th>
                                        <th>{{__('Product Name')}}</th>
                                        <th>{{__('Sold By')}}</th>
                                        <th>{{_('Rating')}}</th>
                                        <th style="width:30%">{{__('Feedback')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(count($feedback)>0)
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
                                            <td>{{$FB->product->user->name}}</td>
                                             
                                            <td>
                                                <span class="star-rating star-rating-sm d-block">
                                                    @if ($FB->rating > 0) 
                                               
                                                        {{ renderStarRating($FB->rating) }}  
                                                    @else
                                                        {{ renderStarRating(0) }}  {{$average_percentage}}%
                                                    @endif
                                                </span>
                                            </td>
                                            <td>{!!$FB->feedback!!}</td>
                                        </tr>
                                    @endforeach
                                    @else
                                    <tr>
                                        <td class="text-center pt-5 h4" colspan="100%">
                                            <i class="la la-meh-o d-block heading-1 alpha-5"></i>
                                            <span class="d-block">{{ __('No Feedback found.') }}</span>
                                        </td>
                                    </tr>
                                @endif
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

