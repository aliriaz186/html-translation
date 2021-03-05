@extends('layouts.app')
@section('content')
<br>
<div class="panel">
        <!--Panel heading-->
        <div class="panel-heading bord-btm clearfix pad-all h-100">
           <h3 class="panel-title pull-left pad-no">{{ __('Submit Offers') }}</h3>
        </div>
        <div class="panel-body">

            <div class="tab-content">
              <div id="Dashboard" class="tab-pane fade in active">
                  <table class="table table-striped res-table mar-no subscriptionTable_admin" cellspacing="0" width="100%">
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
                          </tr>
                      </thead>
                      <tbody>
                          @foreach ($offers as $key=>$offer)
                          <tr>
                          <td>{{ $key+1}}</td>
                      <td>{{ $offer->selectGifts }}</td>
                      <td>{{ $offer->min_purchase }}</td>
                      <td>{{ $offer->pr_qty }}</td>
                      <td>{{ $offer->product_name }}</td>
                      <td>{{ $offer->image }}</td>
                      <td>{{ $offer->product_des }}</td>
                      <td>{{ $offer->valid_from }}</td>
                      <td>{{ $offer->valid_until }}</td>
                    </tr>
                          @endforeach
                      </tbody>
                  </table>
                </div>
            </div>
        </div>
</div>
@endsection
