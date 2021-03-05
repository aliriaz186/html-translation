@extends('frontend.layouts.app')

@section('content')
    <section class="gry-bg py-4">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="p-4 bg-white">
                        <h3>{{$apply->title}}</h3>
                        {!! $apply->description !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
