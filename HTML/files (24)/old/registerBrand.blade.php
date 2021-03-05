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
                              <th>{{__('First Name')}}</th>
                              <th>{{__('Last Name')}}</th>
                              <th>{{__('Email')}}</th>
                              <th>{{__('Phone')}}</th>
                              <th>{{__('Trademark Name')}}</th>
                              <th>{{__('Trademark No')}}</th>
                              <th>{{__('Country Reg')}}</th>
                              <th>{{__('Trademark Url')}}</th>
                              <th>{{__('Person Contact')}}</th>
                              <th>{{__('Full Address')}}</th>
                              <th>{{__('Website Address')}}</th>
                              <th>{{__('Primary Email')}}</th>
                              <th>{{__('Mobile Email')}}</th>
                              <th>{{__('Action')}}</th>
                          </tr>
                      </thead>
                      <tbody>
                          @foreach ($brands as $key=>$brand)
                            <td>{{ $key+1 }}</td>
                            <td>{{$brand->firstname}}</td>
                            <td>{{$brand->lastname}}</td>
                            <td>{{$brand->email}}</td>
                            <td>{{$brand->phoneNumber}}</td>
                            <td>{{$brand->trademarkName}}</td>
                            <td>{{$brand->trademarkNumber}}</td>
                            <td>{{$brand->countryOfRegrester}}</td>
                            <td>{{$brand->trademarlUrl}}</td>
                            <td>{{$brand->personOfContact}}</td>
                            <td>{{$brand->fullAddress}}</td>
                            <td>{{$brand->websiteAddress}}</td>
                            <td>{{$brand->priimaryEmail}}</td>
                            <td>{{$brand->mobileNumber}}</td>
                          @endforeach
                          <tr>

                          </tr>
                      </tbody>
                  </table>
                </div>
            </div>
        </div>
</div>
@endsection
