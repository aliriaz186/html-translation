@extends('layouts.app')

@section('content')

<div class="panel">
    <div class="panel-heading">
        <h3 class="panel-title">{{__('Submit Offer')}}</h3>
    </div>
    <div class="panel-body">
        <table class="table table-striped table-bordered demo-dt-basic" cellspacing="0" width="100%">
            <thead>
                <tr>
                              <th>#</th>
                              <th>{{__('Email')}}</th>
                              <th>{{__('Selected Gifts')}}</th>
                              <th>{{__('Min purchase')}}</th>
                              <th>{{__('Quantity')}}</th>
                              <th>{{__('Product Name')}}</th>
                              <th>{{__('Product Image')}}</th>
                              <th>{{__('Product Desc')}}</th>
                              <th>{{__('Valid from')}}</th>
                              <th>{{__('Valid until')}}</th>
                              <th>{{__('Action')}}</th>
                          </tr>
                      </thead>
                      <tbody>
                          @foreach ($offers as $key=>$offer)
                          <tr>
                            <td>{{ $key+1}}</td>
                            <td>{{$offer->user->email}}</td>
                            <td>{{ $offer->selectGifts }}</td>
                            <td>{{ $offer->min_purchase }}</td>
                            <td>{{ $offer->pr_qty }}</td>
                            <td>{{ $offer->product_name }}</td>
                            <td>{{ $offer->image }}</td>
                            <td>{{ $offer->product_des }}</td>
                            <td>{{ $offer->valid_from }}</td>
                            <td>{{ $offer->valid_until }}</td>
                            <td>
                                <div class="btn-group dropdown">
                                    <button class="btn btn-primary dropdown-toggle dropdown-toggle-icon" data-toggle="dropdown" type="button">
                                        {{__('Actions')}} <i class="dropdown-caret"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-right">
                                        @if(permission_check_all('submit_offers') || permission_check_delete('submit_offers') )
                                        <li><a onclick="confirm_modal('{{route('submitOffer.admin.delete', $offer->id)}}');">{{__('Delete')}}</a></li>
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

