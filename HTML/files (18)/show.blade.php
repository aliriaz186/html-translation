@extends('layouts.app')
<style>
    .condation{
        float: right;
    background: red;
    color: white;
    padding: 10px;
    border-radius: 5px;
    margin-top: -33px;
    }
</style>
@section('content')

<div class="col-lg-12">
    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title">#{{ $dispute->title }} (Between @if($dispute->sender != null) {{ $dispute->sender->name }} @endif and @if($dispute->receiver != null) {{ $dispute->receiver->name }} @endif)
            </h3>
           @if($dispute->status=="close")
            <p class="condation"> {{$dispute->condition}} Case Close</p>
            @endif
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
            @if (Auth::user()->id && $dispute->status != 'close' ||(Auth::user()->id && $dispute->appeal>0 ) )
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
                        @if($dispute->appeal>0)
                        <a class="btn btn-primary"  data-toggle="modal" data-target="#Reimburse_Seller">Close $ Reimburse Seller</a>
                        @else
                        <a class="btn btn-primary"  data-toggle="modal" data-target="#Reimburse_Customer">Close $ Reimburse Customer</a>
                        <a class="btn btn-primary" href="{{route('close-and-refund',$dispute->id )}}">Close Dispute & Refund Customer</a>
                        <a class="btn btn-primary" href="{{route('seller-not-fault',$dispute->id )}}">Close Dispute - Saller Not At Fault</a>

                        @endif
                        <button type="submit" class="btn btn-info">{{__('Send')}}</button>
                    </div>
                </form>
            @endif
        </div>
    </div>
</div>



<!-- Modal  href="" -->
<div class="modal fade" id="Reimburse_Customer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Reimburse Customer</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="{{route('close-and-reimbuse')}}">
              <div class="form-group">
                  <label for="reimburse_customer">Reimburse Customer Amount</label>
                  <input type="number" id="reimburse_customer" placeholder="Amount To Reimburse" name="amount" class="form-control">
                  <input type="hidden" name="dispute_id" value="{{$dispute->id}}">
                </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>

        </form>
    </div>
      </div>
    </div>
  </div>



<!-- Modal  href="" -->
<div class="modal fade" id="Reimburse_Seller" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Reimburse Seller</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="{{route('close-and-reimbuse-seller')}}">
              <div class="form-group">
                  <label for="reimburse_customer">Reimburse Seller Amount</label>
                  <input type="number" id="reimburse_customer" placeholder="Amount To Reimburse" name="amount" class="form-control">
                  <input type="hidden" name="dispute_id" value="{{$dispute->id}}">
                </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>

        </form>
    </div>
      </div>
    </div>
  </div>


@endsection
