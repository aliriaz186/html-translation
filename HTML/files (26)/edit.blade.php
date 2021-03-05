@extends('layouts.app')
  @section('content')
    <div class="col-lg-8 col-lg-offset-2">
      <div class="panel">
        <div class="panel-heading">
          <h3 class="panel-title">{{__('Forum Information')}}</h3>
        </div>
        <!--Horizontal Form-->
        <!--===================================================-->
        <form class="form-horizontal" action="{{ route('forumcomment.update', $forum_comment->id_forum_comment) }}" method="POST">
          <input name="_method" type="hidden" value="PATCH">
        	@csrf
          <div class="panel-body">
            <div class="form-group">
              <label class="col-sm-2 control-label" for="title">{{__('Comment')}}</label>
              <div class="col-sm-10">
                <input type="text" placeholder="{{__('Comment')}}" id="comment" name="comment" class="form-control" required value="{{ $forum_comment->comment }}">
              </div>
            </div>
          </div>
          <div class="panel-footer text-right">
            <input type="hidden" name="is_ban" value="{{ $forum_comment->is_ban }}">
            <button class="btn btn-purple" type="submit">{{__('Save')}}</button>
          </div>
        </form>
        <!--===================================================-->
        <!--End Horizontal Form-->
      </div>
    </div>
  @endsection
