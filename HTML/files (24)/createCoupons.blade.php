@extends('layouts.app')

@section('content')

<div class="panel">
    <div class="panel-heading">
        <h3 class="panel-title">{{__('Create Coupons')}}</h3>
    </div>
    <div class="panel-body">
        <table class="table table-striped table-bordered demo-dt-basic" cellspacing="0" width="100%">
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
                              <th>{{__('Action')}}</th>
                          </tr>
                          <tbody>

                            @foreach ($coupons as $key=>$coupon)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{$coupon->user->email}}</td>
                                <td>{{$coupon->type}}</td>
                                <td>{{$coupon->code}}</td>
                                <td>{{$coupon->amount}}</td>
                                <td>{{$coupon->valid_from}}</td>
                                <td>{{$coupon->valid_until}}</td>
                                <td>{{$coupon->sitewide}}</td>
                                <td>{{$coupon->min_order}}</td>
                                <td>{{$coupon->selected_product}}</td>
                                <td>
                                    <div class="btn-group dropdown">
                                        <button class="btn btn-primary dropdown-toggle dropdown-toggle-icon" data-toggle="dropdown" type="button">
                                            {{__('Actions')}} <i class="dropdown-caret"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-right">
                                            @if(permission_check_all('create_coupons') || permission_check_delete('create_coupons') )
                                            <li><a onclick="confirm_modal('{{route('createCoupons.admin.delete', $coupon->id)}}');">{{__('Delete')}}</a></li>
                                            @endif
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                          @endforeach
                        </tbody>
                      </thead>
                  </table>
                </div>
            </div>
            @endsection

