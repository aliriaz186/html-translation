@extends('layouts.app')

@section('content')

<div class="panel">
    <div class="panel-heading">
        <h3 class="panel-title">{{__('Activity Logs')}}</h3>
    </div>
    <div class="panel-body">
        <table class="table table-striped table-bordered demo-dt-basic" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th width="10%">#</th>
                    <th>{{__('Log Name')}}</th>
                    <th>{{__('Description')}}</th>
                    <th>{{__('Subject id')}}</th>
                    <th>{{__('Subject Type')}}</th>
                    <th>{{__('Cause Id')}}</th>
                    <th>{{__('Properties')}}</th>
                    <th width="10%">{{__('Options')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($ActivityLogs as $key => $activity_log)
                <tr>
                    <td>{{$key+1}}</td>
                    <td>{{$activity_log->log_name}}</td>
                    <td>{{$activity_log->description}}</td>
                    <td>{{$activity_log->subject_id}}</td>
                    <td>{{$activity_log->subject_type}}</td>
                    <td>{{$activity_log->causer_id}}</td>
                    <td>{{$activity_log->properties}}</td>
                    <td>
                        <div class="btn-group dropdown">
                      <button class="btn btn-primary dropdown-toggle dropdown-toggle-icon" data-toggle="dropdown" type="button">
                          {{__('Actions')}} <i class="dropdown-caret"></i>
                      </button>
                      <ul class="dropdown-menu dropdown-menu-right">
                    
                          @if(permission_check_all('activity_log') || permission_check_delete('activity_log') )
                            <li><a onclick="confirm_modal('{{route('shipping-api.delete', $activity_log->id)}}');">{{__('Delete')}}</a></li>
                          @endif
                      </ul>
                  </div>
              </td>
            </tr>
                @endforeach
            </tbody>
        </table>
        <div class="pagination-wrapper py-4 pr-4">
            <ul class="pagination justify-content-end">
                {{ $ActivityLogs->links() }}
            </ul>
        </div>
    </div>
</div>

@endsection
