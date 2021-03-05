@extends('layouts.app')

@section('content')

<!-- Basic Data Tables -->
<!--===================================================-->
<div class="panel">
    <div class="panel-heading bord-btm clearfix pad-all h-100">
        <h3 class="panel-title pull-left pad-no">{{__('Sellers Payments')}}</h3>
        <div class="pull-right clearfix">
            <form class="" id="sort_sellers" action="" method="GET">
                <div class="box-inline pad-rgt pull-left">
                    <div class="select" style="min-width: 300px;">
                        <select class="form-control demo-select2" name="approved_status" id="approved_status" onchange="sort_sellers()">
                            <option value="">{{__('Filter by Status')}}</option>
                            <option value="0"  @isset($approved) @if($approved == '0') selected @endif @endisset>{{__('Add')}}</option>
                            <option value="1"  @isset($approved) @if($approved == '1') selected @endif @endisset>{{__('Remove')}}</option>
                        </select>
                    </div>
                </div>
                <div class="box-inline pad-rgt pull-left">
                    <div class="" style="min-width: 200px;">
                        <input type="text" class="form-control" id="search" name="search"@isset($sort_search) value="{{ $sort_search }}" @endisset placeholder="Type name or email & Enter">
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="panel-body">
        <div class="table-responsive">
            <table class="table table-striped table-responsive mar-no" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>{{__('Date')}}</th>
                        <th>{{__('Seller')}}</th>
                        <th>{{__('Amount')}}</th>
                        <th>{{ __('Payment Method') }}</th>
                        <th>{{__('Add/Remove')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($payments as $key => $payment)
                        @if (\App\Seller::find($payment->seller_id) != null && \App\Seller::find($payment->seller_id)->user != null)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $payment->created_at }}</td>
                                <td>
                                    @if (\App\Seller::find($payment->seller_id) != null)
                                        {{ \App\Seller::find($payment->seller_id)->user->name }} ({{ \App\Seller::find($payment->seller_id)->user->shop->name }})
                                    @endif
                                </td>
                                <td>
                                    @if($payment->status==0)
                                    {{ single_price($payment->amount) }}
                                    @else
                                            {{ single_price(-$payment->amount) }}
                                    @endif
                                </td>

                                <td>{{ ucfirst(str_replace('_', ' ', $payment->payment_method)) }} @if ($payment->txn_code != null) (TRX ID : {{ $payment->txn_code }}) @endif</td>
                                <td>
                                    @if ($payment->status == 1)
                                    <span class="ml-2" style="color:red"><strong>{{__('DUDUCED')}}</strong></span>
                                @else
                                    <span class="ml-2" style="color:green"><strong>{{__('ADD')}}</strong></span>
                                @endif
                                </td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
            <div class="clearfix">
                <div class="pull-right">
                    {{ $payments->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
    <script>
         function sort_sellers(el){
            $('#sort_sellers').submit();
        }

        </script>
@endsection