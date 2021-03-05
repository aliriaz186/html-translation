@extends('frontend.layouts.app')

@section('content')
  <section class="gry-bg py-4">
      <div class="container">
        <div class="row">
          <div class="col-sm-12">
            <div class="p-4 bg-white">
              <!-- <img src="{{asset($news->image)}}" class="img-resposive" style="width: 100%;;max-height: 300px;border-bottom: 1px solid #e1e1e1;" /> -->
              <span>{{date('d, M Y', strtotime($news->created_at))}}</span>
              <h2>{{$news->title}}</h2>
              <p>{{$news->description}}</p>
            </div>
          </div>
          <div class="col-sm-12">
            <hr>
            <p><a href="{{route('news-updates')}}">Back to News & Updates</a></p>
            <a href="{{route('dashboard')}}">Back to Dashboard</a>
          </div>
        </div>
      </div>
  </section>
@endsection
