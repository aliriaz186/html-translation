
@extends('frontend.layouts.app')
@section('content')

    <section class="gry-bg py-4 profile">
        <div class="container-fluid p-4">
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
                                        {{__('Promotions')}}
                                    </h2>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="float-md-right">
                                        <ul class="breadcrumb">
                                            <li><a href="{{ route('home') }}">{{__('Home')}}</a></li>
                                            <li><a href="{{ route('dashboard') }}">{{__('Dashboard')}}</a></li>
                                            <li class="active"><a href="{{ route('customer.raffle.index') }}">{{__('Raffle')}}</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <!--Raffle all-->
                    <div class="card no-bloyal mt-4">
                        <div>
                            <table class="table table-sm table-hover table-responsive-md">
                                <thead>
                                <tr>
                                    <th>{{__('#')}}</th>
                                    <th>{{__('Start Date')}}</th>
                                    <th>{{__('End Date')}}</th>
                                    <th>{{__('Status')}}</th>
                                    <th>{{__('Description')}}</th>
                                    <th>{{__('Option')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                              @forelse (App\Raffle::whereDate('end_date',Carbon\Carbon::now())->get() as $key => $Raffle)
                                   <tr>
                                        <td>{{($key+1)}}</td>
                                        <td>{{Carbon\Carbon::parse($Raffle->start_date)->format('d-m-Y')}}</td>
                                        <td>{{Carbon\Carbon::parse($Raffle->end_date)->format('d-m-Y')}}</td>
                                        <td>
                                            {{$Raffle->status==1?'Active':'Not Active'}}
                                        </td>
                                           <td>{{$Raffle->short_desc}}</td>
                                        <td>
                                           <a href="{{route('raffle_promotions',$Raffle->id)}}" class="btn btn-sm btn-primary">{{__('View')}}</a>
                                         </td>
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

                        <br>
                        <h2 class="heading heading-6 text-capitalize strong-600 mb-0">
                            {{__('Raffle')}}
                        </h2>
                    <!-- Raffle Table table -->
                    <div class="card no-bloyal mt-4">
                        <div>
                            <table class="table table-sm table-hover table-responsive-md">
                                <thead>
                                <tr>
                                    <th>{{__('#')}}</th>
                                    <th>{{__('Date')}}</th>
                                    <th>{{__('Purchased Product')}}</th>
                                    <th>{{__('Product')}}</th>
                                    <th>{{__('Your Ticket Number')}}</th>
                                    <th>{{__('Option')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse ($myRaffles as $key => $myRaffle)
                                  <tr>
                                        <td>{{($key+1)}}</td>
                                        <td>{{Carbon\Carbon::parse($myRaffle->raffle->end_date)->format('d-m-Y')}}</td>
                                        <td>{{$myRaffle->product->name}} </td>
                                        <td>
                                        @if($myRaffle->raffle->winner_ticket==null)
                                            Not Assigned Yet
                                        @elseif($myRaffle->raffle->winner_ticket == $myRaffle->ticketNo)
                                          <div class="media-left">
                                            <img loading="lazy"  class="img-md" src="{{ asset(json_decode($myRaffle->raffle->product_image)[0])}}" alt="Image">
                                        </div>
                                        @else
                                          Better luck next time
                                        @endif
                                        </td>
                                        <td>{{$myRaffle->ticketNo}}</td>
                                        <td>
                                           <a href="customer/{{$myRaffle->id}}" class="btn btn-sm btn-primary">{{__('View')}}</a>
                                         </td>
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
                    </div>
                </div>
            </div>
        </div>
    </section>
        @endsection
