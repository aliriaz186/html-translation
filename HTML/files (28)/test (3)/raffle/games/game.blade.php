@extends('frontend.layouts.app')
<style>
    .size_of_iframe{
        height:100vh;width:100%
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
			<div class="page-title">
                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <h2 class="heading heading-6 text-capitalize strong-600 mb-0 d-inline-block">
                                        {{__('Games')}}
                                    </h2>
                                </div>
                                <div class="col-md-6">
                                    <div class="float-md-right">
                                        <ul class="breadcrumb">
                                            <li><a href="{{ route('home') }}">{{__('Home')}}</a></li>
                                            <li><a href="{{ route('dashboard') }}">{{__('Dashboard')}}</a></li>
                                            <li><a href="{{ route('raffle.games') }}">{{__('Games')}}</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card no-border p-3">
                            @if($game=='chess')
                                 <iframe src="{{asset('frontend/games/3D-Hartwig-chess/index.html')}}" class="size_of_iframe"> </iframe>
                            @elseif($game=='twoZeroFourEight')
                                <iframe src="{{asset('frontend/games/2048/index.html')}}" class="size_of_iframe"> </iframe>
                            @elseif($game=='astray')
                                <iframe src="{{asset('frontend/games/Astray/index.html')}}" class="size_of_iframe"> </iframe>
                            @elseif($game=='browserQuest')
                                <iframe src="{{asset('frontend/games/BrowserQuest/client/index.html')}}" class="size_of_iframe"> </iframe>
                            @elseif($game=='clumsy-bird')
                                <iframe src="{{asset('frontend/games/clumsy-bird/index.html')}}" class="size_of_iframe"> </iframe>
                            @elseif($game=='HexGL')
                                <iframe src="{{asset('frontend/games/HexGL/index.html')}}" class="size_of_iframe"> </iframe>
                            @elseif($game=='hextris-gh-pages')
                                <iframe src="{{asset('frontend/games/hextris-gh-pages/index.html')}}" class="size_of_iframe"> </iframe>
                            @elseif($game=='javascript-racer')
                                <iframe src="{{asset('frontend/games/javascript-racer/index.html')}}" class="size_of_iframe"> </iframe>
                            @elseif($game=='last-colony')
                                <iframe src="{{asset('frontend/games/last-colony/index.html')}}" class="size_of_iframe"> </iframe>
                            @elseif($game=='mimstris')
                                <iframe src="{{asset('frontend/games/mimstris/index.html')}}" class="size_of_iframe"> </iframe>
                            @elseif($game=='mk.js')
                                <iframe src="{{asset('frontend/games/mk.js/index.html')}}" class="size_of_iframe"> </iframe>
                            @elseif($game=='PixelDefense')
                                <iframe src="{{asset('frontend/games/PixelDefense/index.html')}}" class="size_of_iframe"> </iframe>
                            @elseif($game=='tower_game')
                                <iframe src="{{asset('frontend/games/tower_game/index.html')}}" class="size_of_iframe"> </iframe>
                            @elseif($game=='diablo-js')
                                <iframe src="{{asset('frontend/games/diablo-js/index.html')}}" class="size_of_iframe"> </iframe>
                            @elseif($game=='DuckHunt-JS')
                                <iframe src="{{asset('frontend/games/DuckHunt-Js/dist/index.html')}}" class="size_of_iframe"> </iframe>
                            @elseif($game=='pacman-canvas')
                                <iframe src="{{asset('frontend/games/pacman-canvas/index.html')}}" class="size_of_iframe"> </iframe>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
      </section>
      @endsection
