@extends('layouts.app')
@section('content')
<!-- Basic Data Tables -->
<!--===================================================-->
<div class="panel">
  <div class="panel-heading bord-btm clearfix pad-all h-100">
      <h3 class="panel-title pull-left pad-no">{{__('Forum Comment Reports')}}</h3>
  </div>
  <div class="panel-body">
    <table class="table table-striped res-table mar-no" cellspacing="0" width="100%">
      <thead>
        <tr>
          <th>#</th>
          <th width="30%">{{__('Report')}}</th>
          <th width="10%">{{__('Reported By')}}</th>
          <th width="40%">{{__('Comment')}}</th>
          <th width="10%">{{__('Date')}}</th>
        </tr>
      </thead>
      <tbody>
        @foreach($comment_report as $key => $report)
          <tr>
            <td>{{ ($key+1) + ($comment_report->currentPage() - 1)*$comment_report->perPage() }}</td>
            <td>{{ str_limit($report->message, 20)}}</td>
            <td>{{$report->name}}</td>
            <td>{{ $report->comment }}</td>
            <td>{{ $report->created_at }}</td>
          </tr>
        @endforeach
      </tbody>
    </table>
    <div class="clearfix">
      <div class="pull-right">
        {{ $comment_report->appends(request()->input())->links() }}
      </div>
    </div>
  </div>
</div>

@endsection
@section('script')
    <!-- <script type="text/javascript">
      function comment_report(el){
        $('#comment_report').submit();
      }
    </script> -->
@endsection
