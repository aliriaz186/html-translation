@extends('frontend.layouts.app')

@section('content')
  <section class="gry-bg py-4">
    <div class="container">
      <div class="row">
        <div class="col-sm-12 bg-white mb-2">
          <div class="p-4 "> 
            <strong>Date:</strong> {{date('d,M Y', strtotime($forum->created_at))}}
            <h3>{{$forum->title}}</h3>
            <p>{{str_replace('&nbsp;', ' ', strip_tags($forum->description))}}</p>
          </div>
        </div>
        <hr>
        <div class="col-sm-12 bg-white">
          <div class="p-4 "> 
            <h4>Comments</h4>
            <hr>
            <div class="row">
              @foreach($forum_comments as $comment)
              <div class="col-sm-12 col-md-1 text-center">
                <img src="{{asset($comment->avatar_original)}}" style="width: 75px;height: 75px;border-radius: 10px;border: 1px solid #e1e1e1;padding: 5px;">
              </div>
              <div class="col-sm-12 col-md-11">
                <p>{{$comment->comment}}</p>
                <p class="comment-info">
                  <span class="mr-2"><b>Date:</b>
                  {{date('d, M Y', strtotime($comment->created_at))}}
                    @  {{date('h:i A', strtotime($comment->created_at))}},
                  </span>
                  <span class="mr-2"><b>{{$comment->name}}</b></span>
                  <span class="mr-2">
                    <button class="btn btn-sm btn-info like" data-id="{{$comment->id_forum_comment}}" data-token="{{ csrf_token() }}">
                      <b>{{$comment->likes}}</b> <i class="fa fa-thumbs-o-up"></i>
                    </button>
                  </span>
                  <span class="mr-2">
                    <button class="btn btn-sm btn-warning report-btn" data-id="{{$comment->id_forum_comment}}">
                      <i class="fa fa-flag"></i>
                    </button>
                  </span>
                  {{--@if( $comment->message != null)
                    <div class="row">
                      <div class="col-sm-12 col-md-10">
                        <span><b>Reply:</b></span>
                        <p>{{$comment->message}}</p>
                      </div>
                    </div>
                  @endif--}}
                  <form class="report-comment" id="report-comment-{{$comment->id_forum_comment}}" style="display: none;" method="post">
                  <p><strong>Please briefly explain why you feel this comment should be removed.</strong></p>
                    @csrf
                    <textarea rows="7" class="form-control" name="report_comment" style="width: 100%;"></textarea>
                    <input type="hidden" name="id" value="{{$comment->id_forum_comment}}" />
                    <p><strong>KINDLY NOTE :</strong> We'll NOT remove negative comments unless they are abusive or offensive. Once a comment has been reported, it cannot be retracted and it'd be sent to our moderators for review.</p>
                    <button type="button" class="btn btn-sm btn-success post-btn" data-id="{{$comment->id_forum_comment}}">
                      Report Comment
                    </button>
                  </form>
                </p>
                <hr>
              </div>
              @endforeach
            </div>
            <hr>
            @if(Auth::user()->user_type == 'seller')
              <div class="col-sm-12 col-md-11">
                <form action="{{route('forum-comment')}}" method="post">
                  @csrf
                  <textarea rows="7" name="comment" class="form-control"></textarea><br>
                  <input type="hidden" name="id_forum" value="<?php echo $forum->id; ?>">
                  <button type="submit" class="btn btn-success">Comment</button>
                </form>
              </div>
            @endif
          </div>
        </div>
      </div>
      <div class="col-sm-12">
        <hr>
        <a href="{{route('seller-forum')}}">
          Back to Forum
        </a><br>
        </br>
        <a href="{{route('dashboard')}}"> 
          Back to dashboard
        </a>
      </div>
    </div>
  </section>
@endsection
