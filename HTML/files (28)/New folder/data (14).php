@extends('frontend.layouts.app')

@section('content')

    <section class="gry-bg py-4 profile">
        <div class="container-fluid">
            <div class="row cols-xs-space cols-sm-space cols-md-space">

                <div class="col-lg-12">
                    <div class="main-content">
                        <!-- Page title -->
                        <div class="page-title">
                            <div class="row align-items-center">
                                <div class="col-md-6 col-12">
                                    <h2 class="heading heading-6 text-capitalize strong-600 mb-0">
                                        {{__('Customer Feedback')}}
                                    </h2>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="float-md-right">
                                        <ul class="breadcrumb">
                                            <li><a href="{{ route('home') }}">{{__('Home')}}</a></li>
                                            <li><a href="{{ route('dashboard') }}">{{__('Dashboard')}}</a></li>

                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card no-bloyal mt-4" style="background:none">
                            <div>
                                <section class="gry-bg pt-4 pb-3 ">
                                    <div class="container-fluid">
                                        <div class="row align-items-baseline">
                                            <div class="col-md-6">
                                                <div class="d-flex">
                                                    @if (Auth::user()->avatar_original != null)
                                                        <img height="70" class="lazyload" src="{{ asset('frontend/images/placeholder.jpg') }}" data-src="{{ asset(Auth::user()->avatar_original) }}" alt="User Logo">
                                                    @else
                                                    <img height="70" class="lazyload" src="{{ asset('frontend/images/user.png') }}"  alt="User Logo">
                                                    @endif
                                                    <div class="pl-4">
                                                        @php $user = App\User::findOrFail($id); @endphp
                                                         <h3 class="strong-700 heading-4 mb-0">{{ $user->name }}
                                                        </h3>
                                                        <div class="star-rating star-rating-sm mb-1">
                                                            @php $rating = App\Feedback::where('customer_id',$user->customer->id)->avg('rating'); @endphp
                                                            @if ($rating > 0)
                                                                {{ renderStarRating($rating) }} {{Customer_average_percentage(Auth::user()->customer->id)}}%
                                                            @else
                                                                {{ renderStarRating(0) }} {{Seller_average_percentage(Auth::user()->customer->id)}}%
                                                            @endif
                                                        </div>
                                                        <div class="location alpha-6 font-weight-bold">Registered member since {{ Carbon\Carbon::parse($user->created_at)->format('d/m/Y') }}</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            <table class="table table-stripped text-center table-bordered mb-4 pb-4 bg-white">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>1 month</th>
                                        <th>6 month</th>
                                        <th>12 months</th>
                                        <th>Lifetime</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $id = App\Customer::where('user_id',$id)->first()->id;
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

                            <div class="card no-bloyal mt-5 bg-white">
                                <div>
                                    <table class="table table-sm table-hover table-responsive-md">
                                        <thead>
                                        <tr>
                                            <th>{{__('#')}}</th>
                                            <th>{{__('Image')}}</th>
                                            <th>{{__('Product Name')}}</th>
                                            <th>{{__('Sold By')}}</th>
                                            <th>{{__('Rating')}}</th>
                                            <th>{{__('Feedback')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @php $feedback = App\Feedback::where('customer_id',$id)->paginate(8); @endphp
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
                                                 @if ($FB->product->added_by == 'seller' && \App\BusinessSetting::where('type', 'vendor_system_activation')->first()->value == 1)
                                                <td><a href="{{ route('shop.visit', $FB->product->user->shop->slug) }}">{{$FB->product->user->name }}</a> </td>
                                                @else
                                                <td>{{$FB->product->user->name }}</td>
                                                @endif
                                             
                                                <td>
                                                    <span class="star-rating star-rating-sm d-block">
                                                        @if ($FB->rating > 0)
                                                            {{ renderStarRating($FB->rating) }}
                                                        @else
                                                            {{ renderStarRating(0) }}
                                                        @endif
                                                    </span>
                                                </td>
                                                <td>{{$FB->feedback}}</td>
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
            </div>
        </div>
    </section>
@endsection
