
@extends('frontend.layouts.app')
<style>
    .after_win{
        width: 100%;
    height: 12vh;
    position: absolute;
    align-items: center;
    text-align: center;
    font-size: 2em;
    top: 283%;
    padding-top: 14px;
    font-weight: bold;
    }
</style>
<link href="{{ asset('frontend/css/raffle.css')}}" rel="stylesheet">
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
                <div class="col-lg-7">
                    <div class="main-content">
                        <!-- Page title -->
                        <div class="page-title">
                            <div class="row align-items-center">
                                <div class="col-md-6 col-12">
                                    <h2 class="heading heading-6 text-capitalize strong-600 mb-0">
                                        {{__('Raffle')}}
                                    </h2>
                                </div>
                                <div class="col-md-6 col-12" style="    margin-left: 79%;margin-top: -25px;z-index:2">
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

                    <!-- loyal history table -->
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
                                            <p id="days"> </p><p id="hours"></p><p id="minutes"></p> <p id="seconds"></p>
                                        </div>
                                        @endif
                                </div>
                                <div>
                                    <div id="chart" style="position: absolute; left: 27%;;top:84%"></div>
                                    @if($myRaffle->raffle->winner_ticket)
                                    <div class="bg-primary after_win"> {{$myRaffle->raffle->winner_ticket}}</div>
                                    @endif
                                </div>
                            </div>
                    </div>
                </div>
                <div class="col-md-2 theme_color">
                    <div class="top bg-white mt-4">
                        <div class="upper text-center p-3">Total Members</div>
                        <div class="lower">
                            <h3 class="text-center">{{count($AllRaffle)}}<span>/user</span></h3>
                        </div>
                    </div>
                    <div class="bottom bg-white mt-2">
                        <div class="upper text-center p-3">Status</div>
                        <div class="lower">
                            @if($myRaffle->status == 'show')
                            <h3 class="text-center"> Waiting</h3>
                          @elseif($myRaffle->status == 'used')
                              <h3 class="text-center">{{$myRaffle->ticketNo==$myRaffle->raffle->winner_ticket?'WINNER':'Not Lucky'}}</h3>
                          @else
                              <h3 class="text-center">BE READY</h3>
                          @endif
                        </div>
                    </div>
                    <div class="top bg-white mt-2">
                        <div class="upper text-center p-3">My Ticket No.:</div>
                        <div class="lower">
                            <h3 class="text-center">{{$myRaffle->ticketNo}}</h3>
                        </div>
                    </div>

                    <div class="bottom bg-white mt-2">
                        <div class="upper text-center p-3">Winning Ticket</div>
                        <div class="lower">
                            @if($myRaffle->status == 'show')
                            <h3 class="text-center winner_ticket"> N0</h3>
                          @elseif($myRaffle->status == 'used')
                            <h3 class="text-center winner_ticket">{{$myRaffle->raffle->winner_ticket}}</h3>
                              @else
                              <h3 class="text-center winner_ticket"  style="font-size: 20px">BE READY</h3>
                          @endif
                        </div>
                    </div>

                      <div class="top bg-white mt-2">
                        <div class="upper text-center p-3">Claim Winning</div>
                        <div class="lower">
                            @if($myRaffle->ticketNo == $myRaffle->raffle->winner_ticket)
                                @if($myRaffle->raffle->claim==null)
                                     <a href="{{route('raffle.claim_winner',$myRaffle->raffle->id)}}" class="btn btn-primary text-center ml-5">Clam Now</a href="route('')">
                                @elseif($myRaffle->raffle->claim=="approve")
                               <span class="badge badge-lg badge-pill bg-green  ml-5" style="font-size:1rem;">Claimed</span>
                                @else
                                <span class="badge badge-lg badge-pill bg-red  ml-5" style="font-size:1rem;">{{ucfirst($myRaffle->raffle->claim)}}</span>
                                @endif
                                @else
                              <h3 class="text-center winner_ticket"  style="font-size: 20px">Next Time</h3>
                          @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @if($myRaffle->raffle->winner_ticket)
    <div class="modal fade" id="winnerModel" tabindex="-1" role="dialog" aria-labelledby="winnerModel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Raffle Status</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
               <div class="modal-body">
               @if($myRaffle->ticketNo == $myRaffle->raffle->winner_ticket)
                @php $image = json_decode($myRaffle->product_image); @endphp
                <img src="{{asset($image[0])}}" alt="" style="width: 100%">
                <input type="hidden" name="ticketNo" value="{{$myRaffle->ticketNo}}">
 	       @else
 	       	<h3 class="text-center">Better Luck Next Time! Winning Ticket is {{$myRaffle->raffle->winner_ticket}}</h3>
 	       @endif
            </div>
            <div class="modal-footer">
              <button type="button"  data-dismiss="modal" aria-label="Close" class="btn btn-primary">Close</button>
            </div>
        </div>
        </div>
    </div>
    @endif
        @endsection


@php $date = Carbon\Carbon::parse($myRaffle->raffle->end_date); @endphp
        @section('script')


        <script>
$('#winnerModel').modal('show');
            var ticket_number_form_spin = null;
            var padding = {top:20, right:40, bottom:0, left:0},
            w = 400 - padding.left - padding.right,
            h = 400 - padding.top  - padding.bottom,
            r = Math.min(w, h)/2,
            rotation = 0,
            oldrotation = 0,
            picked = 100000,
            oldpick = [],
            color = d3.scale.category20();//category20c()
            randomNumbers = getRandomNumbers();
        var data = [
                @foreach($AllRaffle as $key=>$raffle)
                    {"label":'{{$raffle->ticketNo}}',  "value":{{$key+1}} },
                @endforeach


        ];
        var svg = d3.select('#chart')
            .append("svg")
            .data([data])
            .attr("width",  w + padding.left + padding.right)
            .attr("height", h + padding.top + padding.bottom);
        var container = svg.append("g")
            .attr("class", "chartholder")
            .attr("transform", "translate(" + (w/2 + padding.left) + "," + (h/2 + padding.top) + ")");
        var vis = container
            .append("g");

        var pie = d3.layout.pie().sort(null).value(function(d){return 1;});

        var arc = d3.svg.arc().outerRadius(r);

        var arcs = vis.selectAll("g.slice")
            .data(pie)
            .enter()
            .append("g")
            .attr("class", "slice");

        arcs.append("path")
            .attr("fill", function(d, i){ return color(i); })
            .attr("d", function (d) { return arc(d); });

        arcs.append("text").attr("transform", function(d){
                d.innerRadius = 0;
                d.outerRadius = r;
                d.angle = (d.startAngle + d.endAngle)/2;
                return "rotate(" + (d.angle * 180 / Math.PI - 90) + ")translate(" + (d.outerRadius -10) +")";
            })
            .attr("text-anchor", "end")
            .text( function(d, i) {
                return data[i].label;
            });

        function spin(d){

            container.on("click", null);
            if(oldpick.length == data.length){
                container.on("click", null);
                return;
            }
            var  ps       = 360/data.length,
                 pieslice = Math.round(1440/data.length),
                 rng      = Math.floor((Math.random() * 1440) + 360);

            rotation = (Math.round(rng / ps) * ps);

            picked = Math.round(data.length - (rotation % 360)/ps);
            picked = picked >= data.length ? (picked % data.length) : picked;
            if(oldpick.indexOf(picked) !== -1){
                d3.select(this).call(spin);
                return;
            } else {
                oldpick.push(picked);
            }
            rotation += 90 - Math.round(ps/2);
            vis.transition()
                .duration(3000)
                .attrTween("transform", rotTween)
                .each("end", function(){
                    d3.select(".slice:nth-child(" + (picked + 1) + ") path")
                        .attr("fill", "#111");
                    d3.select("#question h1")
                        .text(data[picked].label);
                    oldrotation = rotation;
                    container.append("text")
                    .attr("x", 0)
                    .attr("y", 15)
                    .attr("text-anchor", "middle")
                    @if($myRaffle->raffle->winner_ticket)
                    .text("{{$myRaffle->raffle->winner_ticket}}")
                    @else
                    .text(" ")
                    .text(data[picked].label)
                    @endif
                    .style({"font-weight":"bold", "font-size":"20px"});

                    $.post('{{ route('customer.winner_select') }}', {_token: '{{ csrf_token()}}', winner_code:data[picked].label}, function(data){
                        location.reload();
                    });

                });
        }

        svg.append("g")
            .attr("transform", "translate(" + (w + padding.left + padding.right) + "," + ((h/2)+padding.top) + ")")
            .append("path")
            .attr("d", "M-" + (r*.15) + ",0L0," + (r*.05) + "L0,-" + (r*.05) + "Z")
            .style({"fill":"black"});

        container.append("circle")
            .attr("cx", 0)
            .attr("cy", 0)
            .attr("r", 60)
            .style({"fill":"white","cursor":"pointer"});

        function rotTween(to) {
          var i = d3.interpolate(oldrotation % 360, rotation);
          return function(t) {
            return "rotate(" + i(t) + ")";
          };
        }

        function getRandomNumbers(){
            var array = new Uint16Array(1000);
            var scale = d3.scale.linear().range([360, 1440]).domain([0, 100000]);
            if(window.hasOwnProperty("crypto") && typeof window.crypto.getRandomValues === "function"){
                window.crypto.getRandomValues(array);
                console.log("works");
            } else {
                //no support for crypto, get crappy random numbers
                for(var i=0; i < 1000; i++){
                    array[i] = Math.floor(Math.random() * 100000) + 1;
                }
            }
            return array;
        }

        function getRandomString(length) {
    var randomChars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    var result = '';
    for ( var i = 0; i < length; i++ ) {
        result += randomChars.charAt(Math.floor(Math.random() * randomChars.length));
    }
    return result;

}


var dateEnd = "{{$date}}";
@if(!$myRaffle->raffle->winner_ticket)

var countDownDate = new Date(dateEnd).getTime();
var x = setInterval(
	function() {
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

	    @if(!$myRaffle->raffle->winner_ticket)

	           @if($myRaffle->status == 'hidden' || $myRaffle->status=='show' )
                     $.post('{{ route('customer.timePassed') }}', {_token: '{{ csrf_token()}}', id:{{$myRaffle->id}},status:'show'}, function(data){
                    location.reload();
                    });
                  @endif
                    spin();
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
            @endsection
