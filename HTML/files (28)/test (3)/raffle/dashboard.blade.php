
@extends('frontend.layouts.app')


<link href="{{ asset('frontend/css/raffle.css')}}" rel="stylesheet">
@section('content')
   <section class="gry-bg py-4 profile">
        <div class="container-fluid p-4" >
            <div class="row cols-xs-space cols-sm-space cols-md-space">
                <div class="col-lg-2-1 d-none d-lg-block">
                    @if(Auth::user()->user_type == 'seller')
                    @include('frontend.inc.seller_side_nav')
                @elseif(Auth::user()->user_type == 'customer')
                    @include('frontend.inc.customer_side_nav')
                @endif
                </div>
                <div class="col-lg-9">
                    <div class="main-content">
                        <!-- Page title -->
                        <div class="page-title">
                            <div class="row align-items-center">
                                <div class="col-md-6 col-12">
                                    <h2 class="heading heading-6 text-capitalize strong-600 mb-0">
                                        {{__('Lottery')}}
                                    </h2>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="float-md-right">
                                        <ul class="breadcrumb">
                                            <li><a href="{{ route('home') }}">{{__('Home')}}</a></li>
                                            <li><a href="{{ route('dashboard') }}">{{__('Dashboard')}}</a></li>
                                            <li class="active"><a href="{{ route('customer.raffle.index') }}">{{__('Lottery')}}</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    {{-- Lottery --}}
                    <!-- loyal history table -->
                    <div class="card no-bloyal mt-4">
                    <div>
                        <table class="table table-sm table-hover table-responsive-md">
                            <thead>
                            <tr>
                                <th>{{__('#')}}</th>
                                <th>{{__('Gift Date')}}</th>
                                <th>{{__('Product Name')}}</th>
                                <th>{{__('Coupon code/Gift')}}</th>
                            </tr>
                            </thead>
                            <tbody>
				@if(count($lotteries)>0)
	                                @foreach ($lotteries as $key => $ly)
	                                <tr>
	                                    <td>{{($key+1)}}</td>
	                                        @php $pr = $ly->lottery->end_date; $pr = explode(' ',$pr);  @endphp
	                                    <td>{{$pr[0]}}</td>
	                                    <td>{{$ly->product_name}}</td>
	                                    <td>{{$ly->coupon_code}}</td>
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
                        <div class="clearfix" style="padding-bottom:10px;padding-right:5px">
                            <div class="pull-right">
                                {{ $lotteries->links() }}
                            </div>
                        </div>
                    </div>
                </div>
                  <!-- Raffles -->
                  <div class="card no-bloyal mt-4">
                    <div>
                        <table class="table table-sm table-hover table-responsive-md">
                            <thead>
                            <tr>
                                <th>{{__('#')}}</th>
                                <th>{{__('Gift Date')}}</th>
                                <th>{{__('Product')}}</th>
                                <th>{{__('Amount')}}</th>
                                <th>{{__('Gift')}}</th>
                                <th>{{__('Ticket Number')}}</th>
                                <th>{{__('show')}}</th>
                            </tr>
                            </thead>
                            <tbody>
				@if(count($myRaffles)>0)
	                            @foreach ($myRaffles as $key => $myRaffle)
	                                <tr>
	                                    <td>{{($key+1)}}</td>
	                                        @php $pr = $myRaffle->end_date; $pr = explode(' ',$pr);  @endphp
	                                    <td>{{$pr[0]}}</td>
	                                        @php $gifts = App\Product::find($myRaffle->reward_product); @endphp
	                                    <td>{{$myRaffle->product->name}} </td>
	                                    <td>{{$myRaffle->amount}} </td>
	                                    <td>
	                                        <div style="display: flex !important;">
	                                            <a target="_blank" class="media-block">
	                                                <div class="media-left">
	                                                    <img loading="lazy"  class="img-md" src="{{ asset($myRaffle->reward_product)}}" alt="Image">
	                                                </div>
	                                            </a>
	                                        </div>
	                                    </td>
	                                    <td>{{$myRaffle->reward_product==null?'Not Assigned Yet':$myRaffle->reward_product}}</td>
	                                    <td>{{$myRaffle->ticketNo}}</td>
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
                        <div class="clearfix" style="padding-bottom:10px;padding-right:5px">
                            <div class="pull-right">
                                {{ $myRaffles->links() }}
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
