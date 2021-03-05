@extends('frontend.layouts.app')

@section('content')
  <section class="gry-bg py-4">
      <div class="container">
        <div class="row my-2 mx-0">
          <div class="p-4 col-sm-8 bg-white">
            <h4 >My Offers</h4>
          </div>
          <div class="col-sm-4 bg-white">
            <div class="p-4">
              <form action="#">
                <div class="input-group mb-3">
                  <input type="text" class="form-control" placeholder="Search..." name="search">
                  <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="submit">Search</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
        @if (count($my_offers) > 0)
          <div class="row">
              @foreach ($my_offers as $key => $val)
              <div class="col-sm-12 col-md-4 mb-2">
                <div class="p-4 bg-white">
                  <a href="{{ route('myoffer', ['slug' => $val->slug]) }}">
                    <img src="{{asset($val->image)}}" class="img-resposive" style="width: 100%;height: 200px;">
                  </a>
                  <hr>
                  <span>Posted: {{date('d, M Y', strtotime($val->created_at))}}</span><br>
                  <a href="{{route('myoffer', ['slug' => $val->slug] )}}">
                    <h5>{{ \Illuminate\Support\Str::words($val->title, 4, ' ...') }}</h5>
                  </a>
                  <p>
                    {{ \Illuminate\Support\Str::words($val->description, 6, ' ...') }}
                  </p>
                </div>
              </div>
              @endforeach
          </div>
          @endif
        <div class="col-sm-12">
          <hr>
          <a href="{{route('dashboard')}}">Back to dashboard</a>
        </div>
      </div>
  </section>
@endsection
