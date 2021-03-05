
@extends('frontend.layouts.app')
@section('content')

<style>
    .spinnerButton{
        position: relative;
    width: 60vw;
    /* top: 20px; */
    max-width: 400px;
    padding: 20px;
    font-weight: 700;
    font-size: 2rem;
    color: #ededed;
    border-radius: 6px;
    border: none;
    box-shadow: 0 2px 0 #D71559;
    cursor: pointer;
    font-family: Montserrat, sans-serif;
    margin-left: 36%;
    }
    .toast p{
        clear: both;
    font-family: Montserrat, Arial, sand-serif;
    margin: 23px;
    font-size: 30px;
    color: #ededed;
    letter-spacing: 0;
    -webkit-touch-callout: none;
    -webkit-user-select: none;
    -khtml-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    line-height: 32px;
    -webkit-transition: line-height .2s ease;
    transition: line-height .2s ease;
    text-align: center;
    }
    </style>
    <section class="gry-bg py-4 profile">
        <div class="container-fluid p-4">
            <div class="row cols-xs-space cols-sm-space cols-md-space">
                <div class="col-lg-2-1 d-none d-lg-block">
                    @include('frontend.inc.customer_side_nav')
                </div>
                <div class="col-lg-7">
                    <div class="main-content">
                        <!-- Page title -->
                        <div class="page-title">
                            <div class="row align-items-center">
                                <div class="col-md-6 col-12">
                                    <h2 class="heading heading-6 text-capitalize strong-600 mb-0">
                                        {{__('Lotteries')}}
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

                    <!-- loyal history table -->
                    <div class="card no-bloyal mt-4">
                        <div class="card no-border p-3">
                            <div class="row">
                                    @if($lottery->quantity > 0)
                                     <div class="col-md-12 d-flex justify-content-center">
                                        <div id="days_back"><span class="text-white">DAYS</span ><p id="days"> </p></div>
                                        <div id="days_back"><span class="text-white">HOURS</span><p id="hours"></p></div>
                                        <div id="days_back"><span class="text-white">MINUTES</span><p id="minutes"></p></div>
                                        <div id="days_back"><span class="text-white">SECONDS</span> <p id="seconds"></p> </div>
                                     </div>
                                    @else
                                    <div class="col-md-12 text-center text-primary">
                                        <p id="days"> </p><p id="hours"></p><p id="minutes"></p> <p id="seconds"></p>
                                    </div>
                                    @endif
                            </div>
                        </div>
                        <div id="container mr-5">
                            <button class="spinnerButton spinBtn mr-5" style="margin-left: 24%;">CLICK TO SPIN!</button>
                            <div class="wheelContainer">
                                <svg class="wheelSVG" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" text-rendering="optimizeSpeed" preserveAspectRatio="xMidYMin meet">
                                    <defs>
                                        <filter id="shadow" x="-100%" y="-100%" width="550%" height="550%">
                                            <feOffset in="SourceAlpha" dx="0" dy="0" result="offsetOut"></feOffset>
                                            <feGaussianBlur stdDeviation="9" in="offsetOut" result="drop" />
                                            <feColorMatrix in="drop" result="color-out" type="matrix" values="0 0 0 0   0  0 0 0 0   0  0 0 0 0   0    0 0 0 .3 0" />
                                            <feBlend in="SourceGraphic" in2="color-out" mode="normal" />
                                        </filter>
                                    </defs>
                                    <g class="mainContainer">
                                        <g class="wheel">
                                        </g>
                                    </g>
                                    <g class="centerCircle" />
                                    <g class="wheelOutline" />
                                    <g class="pegContainer" opacity="1">
                                        <path class="peg" fill="#EEEEEE" d="M22.139,0C5.623,0-1.523,15.572,0.269,27.037c3.392,21.707,21.87,42.232,21.87,42.232 s18.478-20.525,21.87-42.232C45.801,15.572,38.623,0,22.139,0z" />
                                    </g>
                                    <g class="valueContainer" />
                                    <g class="centerCircleImageContainer" />
                                </svg>
                                <div class="toast">
                                    <p></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-2 mt-1 theme_color">
                <div class="top bg-white mt-5 ">
                    <div class="upper text-center p-3">Left Lottery</div>
                    <div class="lower">
                        <h3 class="text-center">{{$lottery->quantity}}<span>/time</span></h3>
                    </div>
                </div>
                <div class="bottom bg-white mt-2">
                    <div class="upper text-center p-3">Status</div>
                    <div class="lower">
                        @if($lottery->quantity>0)
                        <h3 class="text-center winner_ticket"> Active</h3>
                      @else
                      <h3 class="text-center winner_ticket"> Sold</h3>
                      @endif
                    </div>
                </div>
                <div class="top bg-white mt-2">
                    <div class="upper text-center p-3">Winner Ticket</div>
                    <div class="lower">
                        @if($lottery->quantity>0)
                          <h3 class="text-center winner_ticket" style="font-size: 20px">No</h3>
                        @else
                        <h3 class="text-center winner_ticket" style="font-size: 20px">{{App\LotteryWinner::where('product_id',$product_id)->count()}}/tk</h3>
                      @endif
                    </div>
                </div>
            </div>
                </div>
            </div>
        </div>
    </section>

    @php

        $ids = array();
        foreach(json_decode($lottery->product_id) as $ids_loop){

             array_push($ids,$ids_loop);
        }

     $ides = implode('-',$ids);

     if($lottery->quantity>0){
        $file = '../../../../public/frontend/spinner/json/wheel_data-'.$ides.'.json';}
     else{
       $file = '../../../../public/frontend/spinner/json/wheel_data.json';
     }
     @endphp
    <script src='https://cdnjs.cloudflare.com/ajax/libs/gsap/2.1.3/TweenMax.min.js'></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/draggable/1.0.0-beta.11/draggable.min.js" integrity="sha512-QI6aQaepouUL5Ex4YWHx81Y8BylV+wQrEhjaVq4q6n0x7KgEfHkl9miARkObhuNXxhtIe20F2gslO2YPPo0n9A==" crossorigin="anonymous"></script>
    <script src="{{asset('frontend/spinner/js/ThrowPropsPlugin.min.js')}}"></script>
    <script src="{{asset('frontend/spinner/js/Spin2WinWheel.js')}}"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/gsap/2.1.3/plugins/TextPlugin.min.js'></script>
   <script>
       var file = '{{$file}}';
            function loadJSON(callback) {
            var xobj = new XMLHttpRequest();
            xobj.overrideMimeType("application/json");
            xobj.open('GET', file, true);
            xobj.onreadystatechange = function() {
            if (xobj.readyState == 4 && xobj.status == "200") {
                callback(xobj.responseText);
            }
            };
            xobj.send(null);
            }

function myGameEnd(e) {
console.log(e);
}
function myResult(e) {
    console.log(e.msg);
    var str = e.msg;
    var result = str.split("--");
    code =result[1];
    $.get('{{ route('lottery.setWinner') }}',{_token:'{{ csrf_token() }}', id:{{$lottery->id}} ,code:code,product_id:{{$product_id}}}, function(data){
        history.go(-1);
        });
}
function myError(e) {
  console.log('Spin Count: ' + e.spinCount + ' - ' + 'Message: ' +  e.msg);
}
function myGameEnd(e) {
  console.log(e);
}
function init() {

  loadJSON(function(response) {
    var jsonData = JSON.parse(response);
    var mySpinBtn = document.querySelector('.spinBtn');
    var myWheel = new Spin2WinWheel();

    myWheel.init({data:jsonData, onResult:myResult, onGameEnd:myGameEnd, onError:myError, spinTrigger: mySpinBtn});
  });
}
init();
       </script>
        @endsection
@php $date = Carbon\Carbon::parse($lottery->end_date) @endphp
        @section('script')
<script>
 function getRandomString(length) {
    var randomChars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    var result = '';
    for ( var i = 0; i < length; i++ ) {
        result += randomChars.charAt(Math.floor(Math.random() * randomChars.length));
    }
    return result;
}


var dateEnd = "{{$date}}";

var countDownDate = new Date(dateEnd).getTime();
var x = setInterval(function() {
var now = new Date().getTime();
var distance = countDownDate - now;

var days = Math.floor(distance / (1000 * 60 * 60 * 24));
var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
var seconds = Math.floor((distance % (1000 * 60)) / 1000);

document.getElementById("days").innerHTML = days + "";
document.getElementById("hours").innerHTML = hours + "";
document.getElementById("minutes").innerHTML = minutes + "" ;
document.getElementById("seconds").innerHTML = seconds + "";

if (distance < 0) {
clearInterval(x);

document.getElementById("days").innerHTML = "";
document.getElementById("hours").innerHTML = "";
document.getElementById("minutes").innerHTML = "" ;
document.getElementById("seconds").innerHTML = "";
document.getElementById("Result").innerHTML = "";
document.getElementById('Result').style.display = 'block';

}
}, 1000);
        </script>
@endsection
