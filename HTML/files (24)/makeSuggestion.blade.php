@extends('layouts.app')

@section('content')

<div class="panel">
    <div class="panel-heading">
        <h3 class="panel-title">{{__('Suggestions')}}</h3>
    </div>
    <div class="panel-body">
        <table class="table table-striped table-bordered demo-dt-basic" cellspacing="0" width="100%">
            <thead>
                <tr>
                              <th>#</th>
                              <th>{{__('Email')}}</th>
                              <th>{{__('Title')}}</th>
                              <th>{{__('Message')}}</th>
                              <th>{{__('Action')}}</th>
                          </tr>
                          <tbody>
                              @foreach ($suggestions as $key=>$sug)
                                <td>{{ $key+1 }}</td>
                                <td>{{$sug->user->email}}</td>
                                <td>{{$sug->title}}</td>
                                <td>{{$sug->message}}</td>
                                <td>
                                    <div class="btn-group dropdown">
                                        <button class="btn btn-primary dropdown-toggle dropdown-toggle-icon" data-toggle="dropdown" type="button">
                                            {{__('Actions')}} <i class="dropdown-caret"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-right">
                                            @if(permission_check_all('make_suggestions') || permission_check_delete('make_suggestions') )
                                                 <li><a onclick="confirm_modal('{{route('makeSuggestion.admin.delete', $sug->id)}}');">{{__('Delete')}}</a></li>
                                            @endif
                                        </ul>
                                    </div>
                                </td>
                              @endforeach
                          </tbody>
                      </thead>
                  </table>
                </div>
            </div>
            @endsection

