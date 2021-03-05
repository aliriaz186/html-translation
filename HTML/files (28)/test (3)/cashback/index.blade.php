@extends('frontend.layouts.app')
@section('content')

    <section class="gry-bg py-4 profile">
        <div class="container-fluid p-4">
            <div class="row cols-xs-space cols-sm-space cols-md-space">
                <div class="col-lg-2-1 d-none d-lg-block">
                    @if(Auth::user()->user_type == 'seller')
                        @include('frontend.inc.seller_side_nav')
                    @elseif(Auth::user()->user_type == 'customer')
                        @include('frontend.inc.customer_side_nav')
                    @endif
                </div>
                <div class="col-lg-7">
                    <div class="main-content">
                        <!-- Page title -->
                        <div class="full-strach" style="width:128%">
                            <div class="page-title">
                                <div class="row align-items-center">
                                    <div class="col-md-6 col-12">
                                        <h2 class="heading heading-6 text-capitalize strong-600 mb-0">
                                            {{__('Cashback')}}
                                        </h2>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="float-md-right">
                                            <ul class="breadcrumb">
                                                <li><a href="{{ route('home') }}">{{__('Home')}}</a></li>
                                                <li><a href="{{ route('dashboard') }}">{{__('Dashboard')}}</a></li>
                                                <li class="active"><a href="{{ route('cashback.index') }}">{{__('Cashback')}}</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @if($Cashback->minimum_amount!='')
                                <div class="info bg-white mt-3 p-3"> <i class="la la-info text-danger" style="font-size: 1rem"></i>{{__('Minimum amount to be converted into a Voucher / Transfer to Wallet / Withdraw to Bank is ')}} <strong>{{single_price($Cashback->minimum_amount)}}</strong></div>
                            @else
                                <div class="info bg-white mt-3 p-4"> <i class="la la-info text-danger" style="font-size: 1rem"></i>{{__('Minimum Amount to be converted into a voucher is')}}<strong>{{$Cashback->minimum_point}} {{__('points')}}</strong></div>
                            @endif
                        </div>
                        @php
                                $pending=0; $reserve=0;$point_earned = 0;$pending_cashback=0;
                                $pendingBalances = App\CustomerCashback::where('user_id',Auth::user()->id)->where('status','pending')->get();
                                $reserveBalances = App\CustomerCashback::where('user_id',Auth::user()->id)->where('status','validation_done')->where('reserved_money',0)->get();
                                $customerCashback = App\CustomerCashback::where('user_id',Auth::user()->id)->get();

                                foreach($pendingBalances as $balance){ $pending+= ($balance->reward);}
	                        foreach($reserveBalances as $balance){ $reserve+= $balance->reward;}
                                foreach ($customerCashback as $key => $customer_cashback){$point_earned+=$customer_cashback->point_earned; $pending_cashback+=$customer_cashback->cashback->point * $customer_cashback->point_earned; }
			  @endphp
                        <div class="row">
                            <div class="col-md-3 col-6">
                                <div class="dashboard-widget text-center mt-4 c-pointer">
                                    <a href="javascript:;" class="d-block">
                                        <i class="fa fa-hourglass"></i>
                                        <span class="d-block title heading-3 strong-400">{{ $point_earned }}</span>
                                        <span class="d-block sub-title">{{__('Cashback Points')}}</span>
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-3 col-6">
                                <div class="dashboard-widget text-center mt-4 c-pointer">
                                    <a href="javascript:;" class="d-block">
                                        <i class="fa fa-hourglass"></i>
                                        <span class="d-block title heading-3 strong-400">{{single_price($pending_cashback)}}</span>
                                        <span class="d-block sub-title">{{__('Total Cashback')}}</span>
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-3 col-6">
                                <div class="dashboard-widget text-center mt-4 c-pointer">
                                    <a href="javascript:;" class="d-block">
                                        <i class="fa fa-hourglass"></i>
                                        <span class="d-block title heading-3 strong-400">{{single_price($pending)}}</span>
                                        <span class="d-block sub-title">{{__('Pending Cashback')}}</span>
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-3 col-6">
                            <div class="dashboard-widget text-center plus-widget mt-4 c-pointer" onclick="show_wallet_modal()">
                                    <i class="la la-plus"></i>
                                    <span class="d-block title heading-6 strong-400 c-base-1">{{ __('Transfer to Wallet') }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="card no-bloyal mt-4">
                            <div>
                                <table class="table table-sm table-hover table-responsive-md">
                                    <thead>
                                    <tr>
                                        <th>{{__('#')}}</th>
                                        <th>{{__('Date')}}</th>
                                        <th>{{__('Order Code')}}</th>
                                        <th>{{__('Purchased Item')}}</th>
                                        <th>{{__('Status')}}</th>
                                        <th>{{__('Point Earned')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @php $totalPoints = 0; $totalRewards = 0; $totalPendingRewards = 0; @endphp
                                            @forelse ($CustomerCashback as $key => $cashback)
                                                <tr>
                                                    <td>{{($key+1)}}</td>
                                                    <td>{{$cashback->dates}}</td>
                                                    <td>{{$cashback->order_code}} </td>
                                                    <td>{{$cashback->product->name}} </td>
                                                    <td>
                                                        @if($cashback->status=='pending'){{__('Awaiting validation')}}
                                                        @elseif($cashback->status=='used'){{__('Used')}}
                                                        @elseif($cashback->status=='validation_cancel'){{__('Validation Cancel')}}
                                                        @elseif($cashback->status=='validation_done'){{__('Validation Done')}}
                                                        @endif
                                                    </td>
                                                @if($cashback->status=='validation_done')
                                                    @php $totalPoints+=$cashback->point_earned;$totalRewards+=$cashback->reward;@endphp
                                                @endif
                                                    <td>{{$cashback->point_earned}} </td>
                                                    @php
                                                        if($cashback->status=='pending'){$totalPendingRewards+=$cashback->reward;}
                                                    @endphp
                                                </tr>
                                                @empty
                                                <tr>
                                                    <td class="text-center pt-5 h4" colspan="100%">
                                                        <i class="la la-meh-o d-block heading-1 alpha-5"></i>
                                                    <span class="d-block">{{ __('No History Yet.') }}</span>
                                                    </td>
                                                </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                                <div class="pagination-wrapper py-4 pr-4 {{count($CustomerCashback )>5?'':'d-none'}}">
                                    <ul class="pagination justify-content-end">
                                        {{ $CustomerCashback ->links() }}
                                    </ul>
                                </div>

                            </div>
                        </div>

                         <h2 class="heading heading-6 text-capitalize strong-600 mt-4">
                            {{__('Bank Transactions')}}
                        </h2>
                        <div class="card no-bloyal mt-4">
                            <!--Wallet-->
                             <table class="table table-sm table-hover table-responsive-md">
                                      <thead>
                                   <tr class="text-center">
                                        <th>#</th>
                                        <th>{{__('Date')}}</th>
                                        <th>{{__('Amount')}}</th>
                                        <th>{{__('Status')}}</th>
                                        <th>{{__('Payment Ref')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                         @forelse ($CustomerWithdrawRequest as $key => $customer_withdraw_request)
                                                <tr class="text-center">
                                                    <td>{{ $key+1 }}</td>
                                                    <td class="text-center">{{ $customer_withdraw_request->created_at->format('d-m-Y @ H:i:s') }}</td>
                                                    <td>{{ single_price($customer_withdraw_request->amount) }}</td>
                                                    <td>
                                                        @if ($customer_withdraw_request->status == 1)
                                                            <span class="ml-2" style="color:green"><strong>{{__('SENT')}}</strong></span>
                                                      @else
                                                            <span class="ml-2" style="color:red"><strong>{{__('PENDING')}}</strong></span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        {{ $customer_withdraw_request->payment_ref}}
                                                    </td>
                                                </tr>
                                             @empty  
                                             <tr>
                                                <td class="text-center pt-5 h4" colspan="100%">
                                                    <i class="la la-meh-o d-block heading-1 alpha-5"></i>
                                                <span class="d-block">{{ __('No history found.') }}</span>
                                                </td>
                                            </tr>
                                            @endforelse
                                </tbody>
                            </table>
                            <div class="clearfix">
                                <div class="pull-right">
                                    {{ $CustomerWithdrawRequest->links() }}
                                </div>
                            </div>
                        </div>
                        <!--End Wallet -->

                        @if(session('MyCustomerCashback') || isset($MyCustomerCashbackView))
                            <div class="col-md-6 col-12 mt-3">
                                <h2 class="heading heading-6 text-capitalize strong-600 mb-0">
                                    {{__('MY VOUCHERS FROM CASHBACK POINTS')}}
                                </h2>
                            </div>
                            <div class="card no-bloyal mt-4">
                                <div>
                                    <table class="table table-sm table-hover table-responsive-md">
                                        <thead>
                                        <tr>
                                            <th>{{__('#')}}</th>
                                            <th>{{__('Created')}}</th>
                                            <th>{{__('Value')}}</th>
                                            <th>{{__('Code')}}</th>
                                            <th>{{__('Valid From')}}</th>
                                            <th>{{__('Valid Until')}}</th>
                                            <th>{{__('Status')}}</th>
                                            <th>{{__('Detail')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @php $MyCustomerCashback =  App\MyCustomerCashback::where('user_id',Auth::user()->id)->paginate(5);@endphp
                                            @foreach ($MyCustomerCashback as $key => $myCashback)
                                                <tr>
                                                    <td>{{($key+1)}}</td>
                                                    <td>{{$myCashback->created_at->format('d-m-Y')}}</td>
                                                    <td>{{$myCashback->value}} </td>
                                                    <td>{{$myCashback->code}} </td>
                                                    <td>{{$myCashback->valid_from}}</td>
                                                    <td>{{$myCashback->valid_until}}</td>
                                                    <td>{{$myCashback->status}}</td>
                                                    <td>
                                                        <div class="dropdown">
                                                            <button class="btn" type="button" id="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                <i class="fa fa-ellipsis-v"></i>
                                                            </button>
                                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="">
                                                            @php $MyCustomerCashbackView = json_decode($myCashback->order_id ); @endphp
                                                            @foreach ($MyCustomerCashbackView as $mLV)
                                                                <a class="dropdown-item" href="{{route('visit.name', $mLV)}}">@php $order = App\Order::where('id',$mLV)->first(); @endphp
                                                                    {{$order->code}}
                                                                </a>
                                                            @endforeach
                                                        </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <div class="pagination-wrapper py-4 pr-4 {{count($MyCustomerCashback)>5?'':'d-none'}}">
                                        <ul class="pagination justify-content-end">
                                            {{ $MyCustomerCashback->links() }}
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                    @if( ( ($Cashback->minimum_point!=null && $totalPoints  >= $Cashback->minimum_point) ||  $Cashback->minimum_amount!=null && ($totalRewards  >= $Cashback->minimum_amount && Auth::user()->customer->available_balance >= $Cashback->minimum_amount)) && $totalRewards>0 )
                        <div class="bottom_code text-center">
                            <div class="box mt-4 form-group" >
                                <a  onclick="confirm_modal_loyality('{{route('transfer-points-cashback',$totalRewards)}}');" class="btn btn-sm btn-danger text-white">{{__('Transfer my Points into a Voucher of ')}} {{single_price($totalRewards)}}</a>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="col-md-2 theme_color" style="margin-top:5.5rem">
                    <div class="col-md-12 col-6">
                        <div class="dashboard-widget text-center mt-4 c-pointer">
                            <a href="javascript:;" class="d-block">
                                <span class="d-block sub-title">{{__('Reserved Cashback')}}</span>
                                <span class="d-block title heading-3 strong-400">{{(number_format($reserve,2))}}/{{currency_symbol()}}</span>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-12 col-6">
                        <div class="dashboard-widget text-center mt-4 c-pointer">
                            <a href="javascript:;" class="d-block">
                                <span class="d-block sub-title"> {{__('Available Cashback')}}</span>
                                <span class="d-block title heading-3 strong-400">{{single_price(number_format(Auth::user()->customer->available_balance - $total,2))}}</span>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-12 col-6">
                        <div class="dashboard-widget text-center mt-4 c-pointer">
                            <a href="javascript:;" class="d-block">
                                <span class="d-block sub-title">{{__('Bank Details')}}</span>
                                <p class="pl-1">
                                    <span class="font-weight-bold d-block ml-auto mr-auto text-center"> {{__('Name of Bank')}} </span> <span class="d-block ml-auto mr-auto text-center text-center">{{Auth::user()->customer->bank_name?Auth::user()->customer->bank_name:'N/A'}} </span>
                                    <span class="font-weight-bold d-block ml-auto mr-auto text-center"> {{__('Account Name')}} </span> <span class="d-block ml-auto mr-auto text-center text-center">{{Auth::user()->customer->bank_acc_name?Auth::user()->customer->bank_acc_name:'N/A'}}</span>
                                    <span class="font-weight-bold d-block ml-auto mr-auto text-center"> {{__('Account Number')}} </span>  <span class="d-block ml-auto mr-auto text-center text-center">{{Auth::user()->customer->bank_acc_no?Auth::user()->customer->bank_acc_no:'N/A'}} </span>
                                    <span class="font-weight-bold d-block ml-auto mr-auto text-center"> {{__('Routing Number')}} </span> <span class="d-block ml-auto mr-auto text-center text-center">{{Auth::user()->customer->bank_routing_no?Auth::user()->customer->bank_routing_no:'N\A'}}</span>
                                    </p>
                                    @if(Auth::user()->customer->bank_name==null)
                                       <button  class="d-block ml-auto mr-auto btn btn-primary" data-toggle="modal" data-target="#bank_detail"> {{__('Add Bank Details')}}</button>
                                    @else
                                       <button onclick="add_data('{{Auth::user()->customer->bank_name}}','{{Auth::user()->customer->bank_acc_name}}','{{Auth::user()->customer->bank_acc_no}}', '{{Auth::user()->customer->bank_routing_no}}')" style="margin-left: auto;margin-right: auto;display: block;" class="btn btn-primary" data-toggle="modal" data-target="#bank_detail">Edit Bank Details</button>
                                    @endif
                            </a>
                        </div>
                    </div>
                    <div class="col-md-12 col-6">
                        <div class="dashboard-widget text-center mt-4 c-pointer">
                            <a href="javascript:;" class="d-block">
                                <button class="d-block ml-auto mr-auto btn btn-primary"  onclick="show_request_modal()"> {{__('Transfer to Bank')}}</button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="modal fade" id="bank_detail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <form method="POST" action="{{route('customer.bank_details')}}">
            @csrf
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"> {{__('Bank Details')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="name_of_bank"> {{__('Name of Bank')}}</label>
                    <input name="name_of_bank" type="text"  class="form-control" id="name_of_bank">
                </div>
                <div class="form-group">
                    <label for="account_name"> {{__('Account Name')}}</label>
                    <input name="account_name" type="text"  class="form-control" id="account_name">
                </div>
                <div class="form-group">
                    <label for="account_number"> {{__('Account Number')}}</label>
                    <input name="account_number" type="text"   class="form-control" id="account_number">
                </div>
                <div class="form-group">
                    <label for="routing_number"> {{__('Routing Number')}}</label>
                    <input name="routing_number" type="text" class="form-control" id="routing_number">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"> {{__('Close')}}</button>
                <button type="submit" class="btn btn-primary"> {{__('Save changes')}}</button>
            </div>
            </div>
        </form>
        </div>
    </div>
    <div class="modal fade" id="wallet_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-zoom product-modal" id="modal-size" role="document">
            <div class="modal-content position-relative">
                <div class="modal-header">
                    <h5 class="modal-title strong-600 heading-5">{{__('Withdraw To Bank')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @if (Auth::user()->customer->available_balance - $total > 0)
                    <form class="" action="{{ route('wallet.store') }}" method="post">
                        @csrf
                        <div class="modal-body gry-bg px-3 pt-3">
                            <div class="row">
                                <div class="col-md-3">
                                    <label>{{__('Amount')}} <span class="required-star">*</span></label>
                                </div>
                                <div class="col-md-9">
                                    <input type="number" class="form-control mb-3" name="amount" min="1" max="{{ Auth::user()->customer->available_balance}}" placeholder="Amount" readonly="" required value="{{Auth::user()->customer->available_balance}}">
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-base-1">{{__('Send')}}</button>
                        </div>
                    </form>
                @else
                    <div class="modal-body gry-bg px-3 pt-3">
                        <div class="p-5 heading-3">
                            {{__("You don't have an available balance for withdrawal")}}
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    
    <div class="modal fade" id="request_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-zoom product-modal" id="modal-size" role="document">
            <div class="modal-content position-relative">
                <div class="modal-header">
                    <h5 class="modal-title strong-600 heading-5">{{__('Send A Withdraw Request')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @if (Auth::user()->customer->available_balance - $total> 0)
                    <form class="" action="{{ route('balance.store_customer') }}" method="post">
                        @csrf
                        <div class="modal-body gry-bg px-3 pt-3">
                            <div class="row">
                                <div class="col-md-3">
                                    <label>{{__('Amount')}} <span class="required-star">*</span></label>
                                </div>
                                <div class="col-md-9">
                                    <input type="number" class="form-control mb-3" name="amount" min="1" max="{{ Auth::user()->customer->available_balance }}" readonly="true" value="{{Auth::user()->customer->available_balance}}" placeholder="Amount" required>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-base-1">{{__('Send')}}</button>
                        </div>
                    </form>
                @else
                    <div class="modal-body gry-bg px-3 pt-3">
                        <div class="p-5 heading-3">
                            You don't have an available balance for withdrawal
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        function add_data(name_of_bank ,account_name,account_number, routing_number){
            $('#name_of_bank').val(name_of_bank);
            $('#account_name').val(account_name);
            $('#account_number').val(account_number);
            $('#routing_number').val(routing_number);
        }
            function show_wallet_modal(){
        $('#wallet_modal').modal('show');
    }

    function show_request_modal(){
        $('#request_modal').modal('show');
    }

    function show_message_modal(id){
        $.post('{{ route('balance.message_modal') }}',{_token:'{{ @csrf_token() }}', id:id}, function(data){
            $('#message_modal .modal-content').html(data);
            $('#message_modal').modal('show', {backdrop: 'static'});
        });
    }
    </script>
@endsection
