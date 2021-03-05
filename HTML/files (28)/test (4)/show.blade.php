@extends('frontend.layouts.app')
<style>
    .condition{
        margin-left: 80%;
    background-color: red;
    color: white;
    border-radius: 4px;
    text-align: center;
}
.clr{
        padding-left: 4% !important;
        color: #e62e04 !important;
    }
#demo{
        display: flex !important;
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
                        <div class="card no-border p-3">
                            <div class="row">
                                <div class="col-md-6">
                                    <h2 class="heading heading-6 text-capitalize strong-600 mb-0 d-inline-block">
                                        {{ $dispute->title }}
                                    </h2>
                                    <br>
                                    {{__('Dispute between you and')}}
                                    @if ($dispute->sender_id == Auth::user()->id)
                                        {{ $dispute->receiver->name }}
                                    @else
                                        {{ $dispute->sender->name }}
                                    @endif
                                    <br>
                                    @if ($dispute->sender_id == Auth::user()->id && $dispute->receiver->shop != null)
                                        <a href="{{ route('shop.visit', $dispute->receiver->shop->slug) }}">{{ $dispute->receiver->shop->name }}</a>
                                    @endif
                                     <p class="condition">{{$dispute->condition}}</p>
                                </div>
                                <div class="col-md-6" style="display: flex">
                                    <h4 class="heading heading-2 clr" id="days"></h4>
                                    <h4 class="heading heading-2 clr" id="hours"></h4>
                                    <h4 class="heading heading-2 clr" id="minutes"></h4>
                                    <h4 class="heading heading-2 clr" id="seconds"></h4>
                                </div>
                            </div>

                        </div>

                        <div class="card no-border mt-4 p-3">
                            <div class="py-4">
                                <div id="resolutions">

                                    @foreach ($dispute->resolutions as $key => $resolution)
                                        @if (($resolution->user_id == Auth::user()->id && $dispute->appeal==0) || (Auth::user()->user_type == 'seller'  && $dispute->appeal > 0 ))
                                            <div class="block block-comment mb-3">
                                                <div class="d-flex flex-row-reverse">
                                                    <div class="pl-3">
                                                        <div class="block-image">
                                                            @if ($resolution->user->avatar_original != null)
                                                                <img src="{{ asset($resolution->user->avatar_original) }}" class="rounded-circle">
                                                            @else
                                                                <img src="{{ asset('frontend/images/user.png') }}" class="rounded-circle">
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1 ml-5 pl-5">
                                                        <div class="p-3 bg-gray rounded">
                                                            {{ $resolution->resolution }}
                                                        </div>
                                                        <span class="comment-date alpha-7 small mt-1 d-block text-right">
                                                            {{ date('h:i:m d-m-Y', strtotime($resolution->created_at)) }}
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        @elseif(Auth::user()->user_type == 'seller')
                                            <div class="block block-comment mb-3">
                                                <div class="d-flex">
                                                    <div class="pr-3">
                                                        <div class="block-image">
                                                            @if ($resolution->user->avatar_original != null)
                                                                <img src="{{ asset($resolution->user->avatar_original) }}" class="rounded-circle">
                                                            @else
                                                                <img src="{{ asset('frontend/images/user.png') }}" class="rounded-circle">
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1 mr-5 pr-5">
                                                        <div class="p-3 bg-gray rounded">
                                                            {{ $resolution->resolution }}
                                                        </div>
                                                        <span class="comment-date alpha-7 small mt-1 d-block">
                                                            {{ date('h:i:m d-m-Y', strtotime($resolution->created_at)) }}
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                                @if($dispute->status!='close' || (Auth::user()->user_type == 'seller'  && $dispute->appeal > 0 ))
                                <form class="mt-4" action="{{ route('resolutions.store') }}" method="POST" id="forms">
                                    @csrf
                                    <input type="hidden" name="dispute_id" value="{{ $dispute->id }}">
                                    <div class="row">
                                        <div class="col-md-12" >
                                            <textarea class="form-control" rows="4" name="resolution" placeholder="Type your reply" required></textarea>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <button type="button" id="execute" class="btn btn-base-2 mt-3 d-none" >{{__('Execute')}}</button>
                                        <button type="button"  data-toggle="modal" data-target="#closeModal" class="btn btn-base-2 mt-3" >{{__('Close Dispute')}}</button>
                                        <button type="submit" class="btn btn-base-1 mt-3">{{__('Send')}}</button>
                                    </div>
                                </form>
                                @else
                                    @php //&& $dispute->status != 'No Seller Fault'
                                     @endphp
                                <div> <p style="background-color: rgba(255, 0, 0, 0.42); color: white;padding: 10px;text-align: center;">The chat is closed and {{$dispute->condition}} is set by ADMIN</p></div>
                                @if(Auth::user()->user_type == 'seller' && $dispute->appeal== 0 )
                                    <a style="float: right" href="{{route('appeal-to-admin', $dispute->id )}}" class="btn btn-base-1 mt-3">{{__('Appeal')}}</a>
                                @endif
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="closeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                  <form  action="{{ route('disputes.close') }}" method="POST">
                    @csrf
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  The Close dispute will close the dispute and no return to you.
                  <input type="hidden" name="id" value="{{$dispute->id}}">
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-danger">Save changes</button>
                </form>
                </div>
              </div>
            </div>
          </div>
    </section>


@endsection

@php
       $db = Carbon\Carbon::createFromFormat('Y-m-d H:i:s' , $dispute->created_at);
       $nextWeek = $db->addDays(8);
 @endphp

<script>

    var dateEnd = "{{$nextWeek}}";
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
  document.getElementById("days").innerHTML = days + "d ";
  document.getElementById("hours").innerHTML = hours + "h ";
  document.getElementById("minutes").innerHTML = minutes + "m " ;
  document.getElementById("seconds").innerHTML = seconds + "s ";

  // If the count down is finished, write some text
  if (distance < 0) {
    clearInterval(x);
  document.getElementById("days").innerHTML = "";
  document.getElementById("hours").innerHTML = "";
  document.getElementById("minutes").innerHTML = "" ;
  document.getElementById("seconds").innerHTML = "";
  document.getElementById("demo").innerHTML = "EXPIRED";
  document.getElementById('execute').style.display = 'block';

  document.getElementById('forms').style.display = 'none';
  }
}, 1000);
</script>

@section('script')
      @if(($dispute->appeal == 0 && $dispute->status!='close'  ) || (Auth::user()->user_type == 'seller'  && $dispute->appeal > 0 ))
    <script type="text/javascript">
    function refresh_resolutions(){
        $.post('{{ route('disputes.refresh') }}', {_token:'{{ @csrf_token() }}', id:'{{ encrypt($dispute->id) }}'}, function(data){
            $('#resolutions').html(data);
        })
    }

    refresh_resolutions(); // This will run on page load
    setInterval(function(){
        refresh_resolutions() // this will run after every 5 seconds
    }, 4000);


    </script>
    @endif
@endsection
