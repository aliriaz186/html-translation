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
                              <th>{{__('Type')}}</th>
                              <th>{{__('Code')}}</th>
                              <th>{{__('Amount')}}</th>
                              <th>{{__('Valid From')}}</th>
                              <th>{{__('Valid Until')}}</th>
                              <th>{{__('SiteWide')}}</th>
                              <th>{{__('Min Order')}}</th>
                              <th>{{__('Selected Products')}}</th>
                          </tr>
                          <tbody>

                            @foreach ($coupons as $key=>$coupon)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{$users[$key]->email}}</td>
                                <td>{{$coupon->type}}</td>
                                <td>{{$coupon->code}}</td>
                                <td>{{$coupon->amount}}</td>
                                <td>{{$coupon->valid_from}}</td>
                                <td>{{$coupon->valid_until}}</td>
                                <td>{{$coupon->sitewide}}</td>
                                <td>{{$coupon->min_order}}</td>
                                <td>{{$coupon->selected_product}}</td>
                            </tr>
                          @endforeach
                        </tbody>
                      </thead>
                  </table>
                </div>
            </div>
        </div>
</div>
@endsection
