@extends('layouts.app')

@section('content')

<div class="col-lg-12">
    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title">#{{ $dispute->title }} (Between @if($dispute->sender != null) {{ $dispute->sender->name }} @endif and @if($dispute->receiver != null) {{ $dispute->receiver->name }} @endif)
            </h3>
        </div>

        <div class="panel-body">
            @foreach($dispute->resolutions as $resolution)
                <div class="form-group">
                    <a class="media-left" href="#"><img class="img-circle img-sm" alt="Profile Picture" @if($resolution->user != null)src="{{ asset($resolution->user->avatar_original) }}" @endif>
                    </a>
                    <div class="media-body">
                        <div class="comment-header">
                            <a href="#" class="media-heading box-inline text-main text-bold">
                                @if ($resolution->user != null)
                                    {{ $resolution->user->name }}
                                @endif
                            </a>
                            <p class="text-muted text-sm">{{$resolution->created_at}}</p>
                        </div>
                        <p>
                            {{ $resolution->resolution }}
                        </p>
                    </div>
                </div>
            @endforeach
            @if (Auth::user()->id == $dispute->receiver_id)
                <form action="{{ route('resolutions.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="dispute_id" value="{{ $dispute->id }}">
                    <div class="row">
                        <div class="col-md-12">
                            <textarea class="form-control" rows="4" name="resolution" placeholder="Type your reply" required></textarea>
                        </div>
                    </div>
                    <br>
                    <div class="text-right">
                        <button type="submit" class="btn btn-info">{{__('Send')}}</button>
                    </div>
                </form>
            @endif
        </div>
    </div>
</div>

@endsection
