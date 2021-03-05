@extends('layouts.app')
@section('content')
<br>
<div class="panel">
        <!--Panel heading-->
        <div class="panel-heading bord-btm clearfix pad-all h-100">
           <h3 class="panel-title pull-left pad-no">{{ __('Register Brands') }}</h3>
        </div>
        <div class="panel-body">

            <div class="tab-content">
              <div id="Dashboard" class="tab-pane fade in active">
                  <table class="table table-striped res-table mar-no subscriptionTable_admin" cellspacing="0" width="100%">
                      <thead>
                          <tr>
                              <th>#</th>
                              <th>{{__('Email')}}</th>
                              <th>{{__('Title')}}</th>
                              <th>{{__('Message')}}</th>
                          </tr>
                          <tbody>
                              @foreach ($suggestions as $key=>$sug)
                              <td>{{ $key+1 }}</td>
                                <td>{{$sug->email}}</td>
                                <td>{{$sug->title}}</td>
                                <td>{{$sug->message}}</td>
                              @endforeach
                          </tbody>
                      </thead>
                  </table>
                </div>
            </div>
        </div>
</div>
@endsection
