@extends('frontend.layouts.app')
<style>
    .clr{
        padding-left: 4% !important;
        color: #e62e04 !important;
    }
    #demo{
        display: flex;
    }
</style>
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
                                <div class="col-md-6">
                                    <h2 class="heading heading-6 text-capitalize strong-600 mb-0 d-inline-block">
                                        {{__('Disputes')}}
                                    </h2>
                                </div>
                                <div class="col-md-6">
                                    <div class="float-md-right">
                                        <ul class="breadcrumb">
                                            <li><a href="{{ route('home') }}">{{__('Home')}}</a></li>
                                            <li><a href="{{ route('dashboard') }}">{{__('Dashboard')}}</a></li>
                                            <li><a href="{{ route('disputes.index') }}">{{__('Disputes')}}</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card no-border mt-4 p-3">
                            <div class="py-4">

                                @foreach ($disputes as $key => $dispute)
                                    <div class="block block-comment border-bottom">
                                        <div class="row">
                                            <div class="col-1">
                                                <div class="block-image">
                                                    @if (Auth::user()->id == $dispute->sender_id)
                                                        <img @if ($dispute->receiver->avatar_original == null) src="{{ asset('frontend/images/user.png') }}" @else src="{{ asset($dispute->receiver->avatar_original) }}" @endif class="rounded-circle">
                                                    @else
                                                        <img @if ($dispute->sender->avatar_original == null) src="{{ asset('frontend/images/user.png') }}" @else src="{{ asset($dispute->sender->avatar_original) }}" @endif class="rounded-circle">
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-2">
                                                <p>
                                                    @if (Auth::user()->id == $dispute->sender_id)
                                                        <a href="javascript:;" style="color: black; font-weight: bold">{{ $dispute->receiver->name }}</a>
                                                    @else
                                                        <a href="javascript:;" style="color: black; font-weight: bold">{{ $dispute->sender->name }}</a>
                                                    @endif
                                                    <br>
                                                    <span class="comment-date">
                                                    @if($resolution[$key])
                                                        {{ date('h:i:m d-m-Y', strtotime($resolution[$key] ->created_at)) }}
                                                     @endif
                                                    </span>
                                                </p>
                                            </div>
                                            <div class="col-5">
                                                <div class="block-body">
                                                    <div class="block-body-inner pb-3">
                                                        <div class="row no-gutters">
                                                            <div class="col">
                                                                <h4 class="heading heading-6">
                                                                    <a href="{{ route('disputes.show', encrypt($dispute->id)) }}" style="color: #e62e04">
                                                                        {{ $dispute->title }}
                                                                    </a>
                                                                    @if ((Auth::user()->id == $dispute->sender_id && $dispute->sender_viewed == 0) || (Auth::user()->id == $dispute->receiver_id && $dispute->receiver_viewed == 0))
                                                                        <span class="badge badge-pill badge-danger">{{ __('New') }}</span>
                                                                    @endif
                                                                </h4>
                                                            </div>
                                                        </div>
                                                        <p class="comment-text mt-0">
                                                         @if($resolution[$key])
                                                            {{ $resolution[$key]->resolution}}
							@endif
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-4" id="demo{{$key}}" style="display: flex">
                                                <h4 class="heading heading-2 clr" id="days{{$key}}"></h4>
                                                <h4 class="heading heading-2 clr" id="hours{{$key}}"></h4>
                                                <h4 class="heading heading-2 clr" id="minutes{{$key}}"></h4>
                                                <h4 class="heading heading-2 clr" id="seconds{{$key}}"></h4>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="pagination-wrapper py-4">
                            <ul class="pagination justify-content-end">
                                {{ $disputes->links() }}
                            </ul>
                        </div>
                    </div>
                </div>


            </div>
        </div>
      </section>
   @foreach ($disputes as $key => $dispute )
      @php
       $db = Carbon\Carbon::createFromFormat('Y-m-d H:i:s' , $dispute->created_at);
        $nextWeek = $db->addDays(8);
      @endphp
<script>

    // Update the count down every 1 second
    var x = setInterval(function() {

    // Get today's date and time
    let now = new Date().getTime();

    // Find the distance between now and the count down date
    let distance = new Date("{{$nextWeek}}").getTime() - now;

    // Time calculations for days, hours, minutes and seconds
    let days = Math.floor(distance / (1000 * 60 * 60 * 24));
    let hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    let minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    let seconds = Math.floor((distance % (1000 * 60)) / 1000);

    // Display the result in the element with id="demo"
    document.getElementById("days{{$key}}").innerHTML = days + "d ";
    document.getElementById("hours{{$key}}").innerHTML = hours + "h ";
    document.getElementById("minutes{{$key}}").innerHTML = minutes + "m " ;
    document.getElementById("seconds{{$key}}").innerHTML = seconds + "s ";

    // If the count down is finished, write some text
    if (distance < 0) {
        clearInterval(x);
    document.getElementById("days{{$key}}").innerHTML = "";
    document.getElementById("hours{{$key}}").innerHTML = "";
    document.getElementById("minutes{{$key}}").innerHTML = "" ;
    document.getElementById("seconds{{$key}}").innerHTML = "";
    document.getElementById("demo{{$key}}").innerHTML = "EXPIRED";
    }
    }, 1000);
    </script>
@endforeach

@endsection
