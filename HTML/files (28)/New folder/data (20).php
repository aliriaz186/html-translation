@extends('frontend.layouts.app')
<style>
    .code{
        background: #e62e04;
    display: block;
    justify-content: center;
    width: 24%;
    margin-left: auto;
    margin-right: auto;
    color: white;
    }

</style>

@section('content')
    <section class="gry-bg py-4">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="p-4 bg-white">
                        <img src="{{asset($my_offer->image)}}" alt="{{$my_offer->title}}" width="500px" style="max-height: 500px;margin: 0 auto;display: block;">
                        <h3 class="text-center">{{$my_offer->title}}</h3>
                        <div id="box" style="display: none"><h5 class="text-center code ">{{$my_offer->voucher}}</h5></div>
                       <div class="buttons text-center">
                            <button class="btn btn-primary">{{$my_offer->quantity}} AVAILABLE</button>
                            <button class="btn btn-secondary">{{$my_offer->clamed}} CLAMED</button>
                            <button id="reveal" onclick="openDiv()" class="btn btn-danger" >REVEAL CODE</button>
                       </div>
                       <br>
                        <p>{{ str_replace('&nbsp;', '   ', strip_tags($my_offer->description)) }}</p>
                    </div>
                </div>
                <div class="col-sm-12">
                    <hr>
                    <a href="{{route('myoffers')}}">Back to MY Offers</a>
                </div>
            </div>
        </div>
    </section>
@endsection

<script>
    console.log(document.getElementById('reveal'));
    function openDiv(){

        console.log(document.getElementById('box').style.display ='block');
    }
</script>
