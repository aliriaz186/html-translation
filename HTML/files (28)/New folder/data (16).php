@extends('frontend.layouts.app')

@section('content')
  <section class="gry-bg py-4">
      <div class="container-fluid">
        @if(App\AdvertismentForum::first())
            <div class="row my-2" style="width: 14%; margin-left: 0%;position: absolute; top: 6.5%;">
                {!! App\AdvertismentForum::first()->firstAdvertisment !!}
            </div>
        @endif
          <div class="row my-2" style="width: 69%;margin-left: 15%;">
      		<div class="p-4 col-sm-6 bg-white">
      			<h4>Seller Forum</h4>
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
          <div class="p-4 col-sm-2 bg-white">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
              Start a topic
            </button>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <form action="{{ route('post-forum-seller') }}" method="post">
                  @csrf
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Start a conversation</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <div class="form-group">
                        <label class="col-sm-2 control-label"><b>{{__('Topic*')}}</b></label>
                        <div class="col-sm-12">
                          <input type="text" placeholder="{{__('Title')}}" id="title" name="title" class="form-control" required>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label"><b>{{__('Description*')}}</b></label>
                        <div class="col-sm-12">
                          <textarea name="description" rows="8" class="form-control editor" required></textarea>
                        </div>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-primary">Post</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
          </div>

        @if(App\AdvertismentForum::first())
        <div class="row my-2" style="width: 14%;margin-left: 83%;;position: absolute; top: 6.5%;">
            {!! App\AdvertismentForum::first()->secondAdvertisment !!}
        </div>
    @endif
        @if (count($forums) > 0)
            <div class="row" style="width: 69%;margin-left: 15%;">
              @foreach ($forums as $key => $val)
              <div class="col-sm-12 bg-white">
                <div class="p-4 ">
                  <a href="#">
                    <h5>{{$val->title}}</h5>
                  </a>
                  <p>{{str_replace('&nbsp;', ' ', strip_tags($val->description))}}</p>
                  <p>
                    <span class="mr-2">
                      <strong>Date:</strong> {{date('d,M Y', strtotime($val->created_at))}},
                    </span>
                    <span class="mr-2">
                      <strong>Comments:</strong> {{$val->count}},
                    </span>
                    <span class="mr-2">
                      <strong>Posted By:</strong> {{$val->name}}
                    </span>
                      <a class="btn btn-sm btn-primary float-right" href="{{route('seller-forum.show', $val->slug)}}" style="font-size: 20px;">
                        <i class="fa fa-eye"></i> View
                      </a>
                  </p>
                </div>
                <hr>
              </div>
              @endforeach
            </div>
          @endif
          <div class="col-sm-12" style="width: 69%;margin-left: 15%;">
            <hr>
            <a href="{{route('dashboard')}}">Back to dashboard</a>
          </div>
      </div>
  </section>
@endsection
