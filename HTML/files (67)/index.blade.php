@extends('layouts.app')

@section('content')

@if(permission_check_all('staffs') || permission_check_post('staffs') )
<div class="row">
    <div class="col-sm-12">
        <a href="{{ route('staffs.create')}}" class="btn btn-rounded btn-info pull-right">{{__('Add New Staff')}}</a>
    </div>
</div>
@endif
<br>

<!-- Basic Data Tables -->
<!--===================================================-->
<div class="panel">
    <div class="panel-heading">
        <h3 class="panel-title">{{__('Staffs')}}</h3>
    </div>
    <div class="panel-body">
        <table class="table table-striped table-bordered demo-dt-basic" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th width="10%">#</th>
                    <th>{{__('Name')}}</th>
                    <th>{{__('Email')}}</th>
                    <th>{{__('Phone')}}</th>
                    <th>{{__('Role')}}</th>
                    <th width="10%">{{__('Options')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($staffs as $key => $staff)
                    <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$staff->user->name}}</td>
                        <td>{{$staff->user->email}}</td>
                        <td>{{$staff->user->phone}}</td>
                        <td>{{$staff->role->name}}</td>
                        <td>
                            <div class="btn-group dropdown">
                                <button class="btn btn-primary dropdown-toggle dropdown-toggle-icon" data-toggle="dropdown" type="button">
                                    {{__('Actions')}} <i class="dropdown-caret"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-right">
                                    @if(permission_check_all('staffs') || permission_check_put('staffs') )
                                        <li><a href="{{route('staffs.edit', encrypt($staff->id))}}">{{__('Edit')}}</a></li>
                                    @endif
                                    @if(permission_check_all('staffs') || permission_check_delete('staffs') )
                                        <li><a onclick="confirm_modal('{{route('staffs.destroy', $staff->id)}}');">{{__('Delete')}}</a></li>
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
