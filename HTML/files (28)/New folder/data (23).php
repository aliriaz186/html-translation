@extends('frontend.layouts.app')

@section('content')
  <section class="gry-bg py-4">
      <div class="container">
        <div class="row my-2 mx-0">
          <div class="p-4 col-sm-8 bg-white">
            <h4 >News & Updates</h4>
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
        @if (count($news) > 0)
          <div class="row">
              @foreach ($news as $key => $val)
              <div class="col-sm-12 col-md-4 mb-2">
                <div class="p-4 bg-white">
                  <!-- <a href="{{ route('news-updates.show', ['id' => encrypt($val->id), 'date' => date('d-m-y',strtotime( $val->created_at))]) }}">
                    <img src="{{asset($val->image)}}" class="img-resposive" style="width: 100%;">
                  </a> -->
                  <span>Posted: {{date('d, M Y', strtotime($val->created_at))}}</span><br>
                  <a href="{{route('news-updates.show', ['id' => encrypt($val->id), 'date' => date('d-m-y',strtotime( $val->created_at))] )}}">
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
