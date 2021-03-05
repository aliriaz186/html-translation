@extends('frontend.layouts.app')
<style>
.disableClick{
    pointer-events: none;
}
</style>
@section('content')
      <section class="gry-bg py-4 profile">
        <div class="container-fluid p-4" >
            <div class="row cols-xs-space cols-sm-space cols-md-space">
                <div class="col-lg-2-1 d-none d-lg-block">
                    @include('frontend.inc.customer_side_nav')
                </div>

                <div class="col-lg-9">
                    <div class="main-content">
                        <!-- Page title -->
                            <div class="card no-border p-3">
                                <div class="row">
                                        @if(!$myRaffle->raffle->winner_ticket)
                                         <div class="col-md-12 d-flex justify-content-center">
                                            <div id="days_back"><span class="text-white">DAYS</span ><p id="days"> </p></div>
                                            <div id="days_back"><span class="text-white">HOURS</span><p id="hours"></p></div>
                                            <div id="days_back"><span class="text-white">MINUTES</span><p id="minutes"></p></div>
                                            <div id="days_back"><span class="text-white">SECONDS</span> <p id="seconds"></p> </div>
                                         </div>
                                        @else
                                        <div class="col-md-12 text-center text-primary">
                                        
                                            <h3>WINNER TICKET IS {{$myRaffle->raffle->winner_ticket}}</h3>
                                           
                                            @if($myRaffle->raffle->winner_ticket == $myRaffle->ticketNo)
                                            <p>YOU ARE THE WINNER &#129321</p>
                                        @elseif($myRaffle->raffle->winner_ticket == $myRaffle->ticketNo)
                                            <p>BETTER TRY NEXT TIME</p>
                                        @endif
                                            <p id="days"> </p><p id="hours"></p><p id="minutes"></p> <p id="seconds"></p>
                                        </div>
                                        @endif
                                </div>
                            </div>

                        <div class="card no-border mt-4 p-3">
                            <div class="py-4">
                                <div class="row">
                                        <div class="col-md-7"><img style="width:100%;height:50vh" class="img img-responsive" src="{{ asset(json_decode($myRaffle->raffle->product_image)[0])}}"></div>
                                        <div class="col-md-5">
                                            <div class="text-center mb-1 p-3 text-white" style="background: #0069d9; ">
                                                <p style="mb-2  margin-top:-15px">YOUR TICKET NUMBER</p>
                                                
                                                <span style="background: white; padding: 0px 63px 0px 63px;padding-bottom: -19px;color: black;margin-top: 10px;font-size: 20px;">{{$myRaffle->ticketNo}}</span>
                                            </div>
                                            @php if($myRaffle->status=='show'){$status='View Raffle Status';$class='';} else if($myRaffle->status=='used'){$status="Raffle Result";$class='';}else{ $status='NOT READY';$class='disableClick';}@endphp
                                            <a id="five_minutes" href="{{route('raffle.visit_page',$myRaffle->product_id)}}" class="btn btn-block btn-primary {{$class}}" > {{$status}}</a>
                                            <a href="{{route('raffle.spin',$myRaffle->product_id)}}" class="btn btn-block btn-primary">SPIN 2 WIN WHEEL</a>
                                            <a href="{{route('raffle.dashboard')}}" class="btn btn-block btn-primary">RAFFLE DASHBOARD</a>
                                            <a href="{{route('raffle.games')}}" class="btn btn-block btn-primary">VISIT APPS & GAMES</a>
                                            <a href="{{route('raffle.back')}}" class="btn btn-block btn-primary">BACK TO MY BASHBOARD</a>
                                        </div>
                                </div>
                                <br>
                                <div class="row">
                                        <div class="col-md-6" style="overflow:scroll">
                                                <h5 class="text-center">Description</h5>
                                                <div class="pl-1">@php echo html_entity_decode($myRaffle->description); @endphp</div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="text-center">
                                                <h5>Terms And Condations</h5>
                                                 <div class="pl-1">@php echo html_entity_decode($myRaffle->raffle->termsAndCondations); @endphp</div>
                                            </div>
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

@endsection

@php
    $now = Carbon\Carbon::now(); //to
    $start_date = $myRaffle->start_date; //from

    $difference = $now->diffInMinutes($start_date);
@endphp
{{--
@if(  $difference <= 0)
         --}}
<script>
@if(!$myRaffle->raffle->winner_ticket)

    var dateEnd = "{{$myRaffle->raffle->end_date}}";
// Set the date we're counting down to
var countDownDate = new Date(dateEnd).getTime();

// Update the count down every 1 second
var x = setInterval(function() {

  // Get today's date and time
  var now = new Date().getTime();

  // Find the distance between now and the count down date
  var distance = countDownDate - now;

  // Time calculations for days, hours, minutes and seconds
  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);

  // Display the result in the element with id="demo"
  document.getElementById("days").innerHTML = days + "";
  document.getElementById("hours").innerHTML = hours + "";
  document.getElementById("minutes").innerHTML = minutes + "" ;
  document.getElementById("seconds").innerHTML = seconds + "";
  // If the count down is finished, write some text

if(distance < 300000 && distance > 0 ){
	document.getElementById('five_minutes').innerHTML = 'LESS THEN 5 MINUTES';
	document.getElementById('five_minutes').classList.remove("disableClick");
}
  if (distance < 0) {

  @if($myRaffle->status == 'hidden')
    $.post('{{ route('customer.timePassed') }}', {_token: '{{ csrf_token()}}', id:{{$myRaffle->id}},status:'hidden'}, function(data){
                      location.reload();
     });
   @endif
    clearInterval(x);
  document.getElementById("days").innerHTML = "";
  document.getElementById("hours").innerHTML = "";
  document.getElementById("minutes").innerHTML = "" ;
  document.getElementById("seconds").innerHTML = "";
  }
}, 1000);
@endif
</script>

{{-- @endif --}}
