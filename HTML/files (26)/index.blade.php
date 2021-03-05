@extends('layouts.app')
@section('content')
<!-- Basic Data Tables -->
<!--===================================================-->
<div class="panel">
  <div class="panel-heading bord-btm clearfix pad-all h-100">
        <h3 class="panel-title pull-left pad-no">{{__('Forum Comments')}}</h3>
        <div class="pull-right clearfix">
            <form id="sort_forum" action="" method="GET">
                <div class="box-inline pad-rgt pull-left">
                    <div class="" style="min-width: 200px;">
                        <input type="text" class="form-control" id="search" name="search"@isset($sort_search) value="{{ $sort_search }}" @endisset placeholder=" Type name & Enter">
                    </div>
                </div>
            </form>
        </div>
    </div>
  <div class="panel-body">
    <table class="table table-striped res-table mar-no" cellspacing="0" width="100%">
      <thead>
        <tr>
          <th>#</th>
          <th>{{__('Title')}}</th>
          <th>{{__('Seller Name')}}</th>
          <th>{{__('Action')}}</th>
          <th>{{__('Date')}}</th>
          <th width="10%">{{__('Options')}}</th>
        </tr>
      </thead>
      <tbody>

        @foreach($forum_comments as $key => $forum)
          <tr>
            <td>{{ ($key+1) + ($forum_comments->currentPage() - 1)*$forum_comments->perPage() }}</td>
            <td>{{ str_limit($forum->comment, 20)}}</td>
            <td>{{$forum->name}}</td>
            <td>
              <form action="{{ route('forumcomment.update', $forum->id_forum_comment) }}" method="POST">
                <input name="_method" type="hidden" value="PATCH">
                @csrf
                <input type="hidden" name="is_ban" value="{{$forum->is_ban}}">
                <input type="hidden" name="comment" value="{{$forum->comment}}">
                @if(permission_check_all('forum_comments') || permission_check_get('forum_comments') )
                    @if($forum->is_ban == 0)
                    <button class="btn btn-info" type="submit">Hide</button>
                    @else
                    <button class="btn btn-success" type="submit">Show</button>
                    @endif
                @endif
              </form>
            </td>
            <td>{{ $forum->created_at }}</td>
            <td>
              <div class="btn-group dropdown">
                <button class="btn btn-primary dropdown-toggle dropdown-toggle-icon" data-toggle="dropdown" type="button">
                    {{__('Actions')}} <i class="dropdown-caret"></i>
                </button>
                <ul class="dropdown-menu dropdown-menu-right">
                    @if(permission_check_all('forum_comments') || permission_check_get('forum_comments') )
                         <li><a href="{{route('forumcomment.edit', encrypt($forum->id_forum_comment))}}">{{__('Edit')}}</a></li>
                    @endif

                @if(permission_check_all('forum_comments') || permission_check_delete('forum_comments') )
                    <li><a onclick="confirm_modal('{{ route('forumcomment.destroy', $forum->id_forum_comment) }}');">{{__('Delete')}}</a></li>
                @endif
                </ul>
              </div>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
    <div class="clearfix">
      <div class="pull-right">
        {{ $forum_comments->appends(request()->input())->links() }}
      </div>
    </div>
  </div>
</div>

@endsection
@section('script')
    <script type="text/javascript">
      function forum_comments(el){
        $('#forum_comments').submit();
      }
    </script>
@endsection
