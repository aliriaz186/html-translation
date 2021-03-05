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
                              <th>{{__('Name')}}</th>
                              <th>{{__('Image')}}</th>
                          </tr>
                          <tbody>
                              @foreach ($brands as $key=>$brand)
                              <td>{{ $key+1 }}</td>
                          <td>{{$brand->email}}</td>
                          <td>{{$brand->name}}</td>
                          <td>{{$brand->logo}}</td>
                              @endforeach
                          </tbody>
                      </thead>
                  </table>
                </div>
            </div>
        </div>
</div>
@endsection
