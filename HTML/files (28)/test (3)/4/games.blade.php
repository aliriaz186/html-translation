@extends('frontend.layouts.app')
<style>
    .image_size{
        width: 100%;height: 34.5vh;
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
                        <div class="page-title">
                            <div class="row align-items-center">
                                <div class="col-md-6 col-12">
                                    <h2 class="heading heading-6 text-capitalize strong-600 mb-0">
                                        {{__('Games')}}
                                    </h2>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="float-md-right">
                                        <ul class="breadcrumb">
                                            <li><a href="{{ route('home') }}">{{__('Home')}}</a></li>
                                            <li><a href="{{ route('dashboard') }}">{{__('Dashboard')}}</a></li>
                                            <li class="active"><a href="{{ route('raffle.games') }}">{{__('Games')}}</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Page title -->
                        <div class="card no-border p-3">
                            <div class="row text-center">
                                <div class="col-lg-2-1 border p-2 ml-4">
                                   <a href="{{route('games.chess')}}"> <img class="image_size" src="{{asset('frontend/games/images/chess.gif')}}" alt="3D-Hartwig-chess-set">
                                    <p class="heading-6 mt-3">{{__('3D-Hartwig-chess-set')}}</p></a>
                                    <a class="btn btn-primary btn-block mt-3" href="{{route('games.chess')}}"> {{__('Play')}} </a>
                                </div>
                                <div class="col-lg-2-1 border p-2 ml-4">
                                   <a href="{{route('games.twoZeroFourEight')}}"> <img class="image_size" src="{{asset('frontend/games/images/2048.jpg')}}" alt="2048">
                                    <p class="heading-6 mt-3"> {{__('2048')}}</p></a>
                                    <a class="btn btn-primary btn-block mt-3" href="{{route('games.twoZeroFourEight')}}"> {{__('Play')}} </a>

                                </div>
                                <div class="col-lg-2-1 border p-2 ml-4">
                                   <a href="{{route('games.astray')}}"> <img class="image_size" src="{{asset('frontend/games/images/astray-master.jpg')}}" alt="Astray-master">
                                    <p class="heading-6 mt-3"> {{__('Astray-master')}}</p></a>
                                    <a class="btn btn-primary btn-block mt-3" href="{{route('games.astray')}}"> {{__('Play')}} </a>
                                </div>

                                <div class="col-lg-2-1 border p-2 ml-4">
                                   <a href="{{route('games.browserQuest')}}"> <img class="image_size" src="{{asset('frontend/games/images/BrowserQuest-master.png')}}" alt="BrowserQuest-master">
                                    <p class="heading-6 mt-3"> {{__('BrowserQuest-master')}}</p></a>
                                    <a class="btn btn-primary btn-block mt-3" href="{{route('games.browserQuest')}}"> {{__('Play')}} </a>
                                </div>
                            </div>
                            <br>
                            <div class="row text-center">
                                <div class="col-lg-2-1 border p-2 ml-4">
                                   <a href="{{route('games.clumsy-bird')}}"> <img class="image_size" src="{{asset('frontend/games/images/clumsy-bird-master.jpg')}}" alt="clumsy-bird-master">
                                    <p class="heading-6 mt-3"> {{__('clumsy-bird-master')}}</p></a>
                                    <a class="btn btn-primary btn-block mt-3" href="{{route('games.clumsy-bird')}}"> {{__('Play')}} </a>
                                </div>
                                <div class="col-lg-2-1 border p-2 ml-4">
                                   <a href="{{route('games.HexGL')}}"> <img class="image_size" src="{{asset('frontend/games/images/HexGL-master.png')}}" alt="HexGL-master">
                                    <p class="heading-6 mt-3"> {{__('HexGL-master')}}</p></a>
                                    <a class="btn btn-primary btn-block mt-3" href="{{route('games.HexGL')}}"> {{__('Play')}} </a>

                                </div>
                                <div class="col-lg-2-1 border p-2 ml-4">
                                   <a href="{{route('games.hextris_gh_pages')}}"> <img class="image_size" src="{{asset('frontend/games/images/hextris-gh-pages.jpg')}}" alt="hextris-gh-pages">
                                    <p class="heading-6 mt-3"> {{__('hextris-gh-pages')}}</p></a>
                                    <a class="btn btn-primary btn-block mt-3" href="{{route('games.hextris_gh_pages')}}"> {{__('Play')}} </a>
                                </div>

                                <div class="col-lg-2-1 border p-2 ml-4">
                                   <a href="{{route('games.javascript_racer')}}"> <img class="image_size" src="{{asset('frontend/games/images/javascript-racer-masterr.png')}}" alt="javascript-racer-masterr">
                                    <p class="heading-6 mt-3"> {{__('javascript-racer-master')}}</p></a>
                                    <a class="btn btn-primary btn-block mt-3" href="{{route('games.javascript_racer')}}"> {{__('Play')}} </a>
                                </div>
                            </div>
                            <br>
                            <div class="row text-center">
                                <div class="col-lg-2-1 border p-2 ml-4">
                                   <a href="{{route('games.PixelDefense')}}"> <img class="image_size" src="{{asset('frontend/games/images/PixelDefense.jpg')}}" alt="PixelDefense">
                                    <p class="heading-6 mt-3"> {{__('PixelDefense')}}</p></a>
                                    <a class="btn btn-primary btn-block mt-3" href="{{route('games.PixelDefense')}}"> {{__('Play')}} </a>
                                </div>
                                <div class="col-lg-2-1 border p-2 ml-4">
                                   <a href="{{route('games.last_colony')}}"> <img class="image_size" src="{{asset('frontend/games/images/last-colony-master.jpg')}}" alt="last-colony-master">
                                    <p class="heading-6 mt-3"> {{__('last-colony-master')}}</p></a>
                                    <a class="btn btn-primary btn-block mt-3" href="{{route('games.last_colony')}}"> {{__('Play')}} </a>

                                </div>
                                <div class="col-lg-2-1 border p-2 ml-4">
                                   <a href="{{route('games.mimstris')}}"> <img class="image_size" src="{{asset('frontend/games/images/mimstris-master.jpg')}}" alt="mimstris-master">
                                    <p class="heading-6 mt-3"> {{__('mimstris-master')}}</p></a>
                                    <a class="btn btn-primary btn-block mt-3" href="{{route('games.mimstris')}}"> {{__('Play')}} </a>
                                </div>

                                <div class="col-lg-2-1 border p-2 ml-4">
                                   <a href="{{route('games.mkjs')}}"> <img class="image_size" src="{{asset('frontend/games/images/mk.js-master.jpg')}}" alt="mk.js-master">
                                    <p class="heading-6 mt-3"> {{__('mk.js-master')}}</p></a>
                                    <a class="btn btn-primary btn-block mt-3" href="{{route('games.mkjs')}}"> {{__('Play')}} </a>
                                </div>
                            </div>
                            <br>
                            <div class="row text-center">
                                <div class="col-lg-2-1 border p-2 ml-4">
                                   <a href="{{route('games.pacman')}}"> <img class="image_size" src="{{asset('frontend/games/images/pacman.png')}}" alt="pacman-canvas-master">
                                    <p class="heading-6 mt-3"> {{__('pacman-canvas-master')}}</p></a>
                                    <a class="btn btn-primary btn-block mt-3" href="{{route('games.pacman')}}"> {{__('Play')}} </a>
                                </div>
                                <div class="col-lg-2-1 border p-2 ml-4">
                                   <a href="{{route('games.DuckHunt')}}"> <img class="image_size" src="{{asset('frontend/games/images/DuckHunt-JS.jpeg')}}" alt="DuckHunt-JS">
                                    <p class="heading-6 mt-3"> {{__('DuckHunt-JS')}}</p></a>
                                    <a class="btn btn-primary btn-block mt-3" href="{{route('games.DuckHunt')}}"> {{__('Play')}} </a>

                                </div>
                                <div class="col-lg-2-1 border p-2 ml-4">
                                   <a href="{{route('games.diablo')}}"> <img class="image_size" src="{{asset('frontend/games/images/diablo-js.jpeg')}}" alt="diablo-js">
                                    <p class="heading-6 mt-3"> {{__('diablo-js')}}</p></a>
                                    <a class="btn btn-primary btn-block mt-3" href="{{route('games.diablo')}}"> {{__('Play')}} </a>
                                </div>

                            </div>
                            <br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      </section>
      @endsection
