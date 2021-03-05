@extends('layouts.app')

@section('content')

<div class="panel">
    <div class="panel-heading">
        <h3 class="panel-title">{{__('Disputes')}}</h3>
    </div>
    <div class="panel-body">
        <table class="table table-striped table-bordered demo-dt-basic" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>#</th>
                    <th>{{ __('Date') }}</th>
                    <th>{{__('Title')}}</th>
                    <th>{{__('Sender')}}</th>
                    <th>{{__('Receiver')}}</th>
                    <th width="10%">{{__('Options')}}</th>
                </tr>
            </thead>
            <tbody>
                    @foreach ($disputes as $key => $dispute)
                    <tr>
                        <td>{{$key+1}}</td>
                        <td>{{ $dispute->created_at }}</td>
                        <td>{{ $dispute->title }}</td>
                        <td>
                            @if ($dispute->sender != null)
                                {{ $dispute->sender->name }}
                                @if ($dispute->receiver_viewed == 0)
                                    <span class="pull-right badge badge-info">{{ __('New') }}</span>
                                @endif
                            @endif
                        </td>
                        <td>
                            @if ($dispute->receiver != null)
                                {{ $dispute->receiver->name }}
                                @if ($dispute->sender_viewed == 0)
                                    <span class="pull-right badge badge-info">{{ __('New') }}</span>
                                @endif
                            @endif
                        </td>
                        <td>
                            <div class="btn-group dropdown">
                                <button class="btn btn-primary dropdown-toggle dropdown-toggle-icon" data-toggle="dropdown" type="button">
                                    {{__('Actions')}} <i class="dropdown-caret"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-right">
                                    @if(permission_check_all('disputes') ||  permission_check_put('disputes'))
                                        <li><a href="{{route('disputes.admin_show', encrypt($dispute->id))}}">{{__('View')}}</a></li>
                                    @endif
                                    @if(permission_check_all('disputes') || permission_check_delete('disputes') )
                                        <li><a onclick="confirm_modal('{{route('disputes.destroy', encrypt($dispute->id))}}');">{{__('Delete')}}</a></li>
                                    @endif
                                </ul>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</div>

@endsection
