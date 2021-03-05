@extends('frontend.layouts.app')

<style>
 .info-top{
   margin-top: -20px; margin-right: -16px;
 }
</style>
@section('content')

    <section class="gry-bg py-4 profile">
        <div class="container-fluid">
            <div class="row cols-xs-space cols-sm-space cols-md-space">
                <div class="col-lg-2-1 d-none d-lg-block">
                    @include('frontend.inc.seller_side_nav')
                </div>

                <div class="col-lg-9">
                    <div class="main-content">
                        <!-- Page title -->
                        <div class="page-title">
                            <div class="row align-items-center">
                                <div class="col-md-6 col-12 d-flex align-items-center">
                                    <h2 class="heading heading-6 text-capitalize strong-600 mb-0">
                                        {{__('Balance')}}
                                    </h2>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="float-md-right">
                                        <ul class="breadcrumb">
                                            <li><a href="{{ route('home') }}">{{__('Home')}}</a></li>
                                            <li><a href="{{ route('dashboard') }}">{{__('Dashboard')}}</a></li>
                                            <li class="active"><a href="{{ route('balance.index') }}">{{__('Balance')}}</a></li>
                                        </ul>
                                        <br>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3">
                                <div class="dashboard-widget text-center mt-4 c-pointer">
                                     <i class="fa fa-info-circle pull-right bg-white info-top" data-toggle="tooltip" title="All pending amount for order which hasn't been shipped"></i>
                                      <i class="fa fa-gbp"></i>
                                    @php 
                                    $available = 0; $pending=0; $reserve=0;
                                    $pendingBalances = App\OrderDetail::where('seller_id',Auth::user()->id)->where('delivery_status','!=','delivered')->where('delivery_status','!=','refunded')->where('delivery_status','!=','returned')->where('delivery_status','!=','cancelled')->get();
                                    $reserveBalances = App\OrderDetail::where('seller_id',Auth::user()->id)->where('delivery_status','delivered')->where('reserve_money',0)->get();
                                    
                                    foreach($pendingBalances as $balance){ $pending+= ($balance->price + $balance->shipping_cost + $balance->commission);}	                         
	                            foreach($reserveBalances as $balance){ $reserve+= ($balance->price + $balance->shipping_cost + $balance->commission);}
	                         
	                            @endphp
                                    <span class="d-block title heading-3 strong-400">{{ single_price($pending) }}</span>
                                    <span class="d-block sub-title">{{ __('Pending Balance') }}</span>

                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="dashboard-widget text-center mt-4 c-pointer">
                                <i class="fa fa-info-circle pull-right bg-white  info-top" data-toggle="tooltip" title="All reserved amount to allow time for delivery."></i>
                                   <i class="fa fa-gbp"></i>
                                    <span class="d-block title heading-3 strong-400">{{ single_price($reserve) }}</span>
                                    <span class="d-block sub-title">{{ __('Reserved Balance') }}</span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="dashboard-widget text-center mt-4 c-pointer"> 
                                 <i class="fa fa-info-circle pull-right bg-white info-top" data-toggle="tooltip" title="All available amount for withdrawal."></i>
                                   <i class="fa fa-gbp"></i>
                                    <span class="d-block title heading-3 strong-400">{{ single_price(Auth::user()->seller->available_balance + Auth::user()->seller->admin_to_pay_extra - $total) }}</span>
                                    <span class="d-block sub-title">{{ __('Available Balance') }}</span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="dashboard-widget text-center plus-widget mt-4 c-pointer" onclick="show_request_modal()">
                                    <i class="la la-plus"></i>
                                    <span class="d-block title heading-6 strong-400 c-base-1">{{ __('Request Payment') }}</span>
                                </div>
                            </div>
                            
                        </div>

                        <div class="card no-border mt-5">
                            <div class="card-header py-3">
                                <h4 class="mb-0 h6">Withdraw Request history</h4>
                            </div>
                            <div class="card-body">
                                <table class="table table-sm table-responsive-md mb-0  text-center">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>{{ __('Date') }}</th>
                                            <th>{{__('Amount')}}</th>
                                            <th>{{__('Status')}}</th>
                                            <th class="text-left">{{__('Message')}}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                           @forelse ($seller_withdraw_requests as $key => $seller_withdraw_request)
                                                <tr>
                                                    <td>{{ $key+1 }}</td>
                                                    <td>{{ date('d-m-Y', strtotime($seller_withdraw_request->created_at)) }}</td>
                                                    <td>{{ single_price($seller_withdraw_request->amount) }}</td>
                                                    <td>
                                                        @if ($seller_withdraw_request->status == 1)
                                                            <span class="ml-2" style="color:green"><strong>{{__('SENT')}}</strong></span>
                                                      @else
                                                            <span class="ml-2" style="color:red"><strong>{{__('PENDING')}}</strong></span>
                                                        @endif
                                                    </td>
                                                    <td class="text-left">
                                                        {{ $seller_withdraw_request->message }}
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
                            </div>
                        </div>
                        @if(count($seller_withdraw_requests) > 8)
                                        
                        <div class="pagination-wrapper py-1">
                            <ul class="pagination justify-content-end">
                                {{ $seller_withdraw_requests->links() }}
                            </ul>
                        </div>
                        @endif

                        <div class="card no-border mt-3">
                            <div class="card-header py-3">
                                <h4 class="mb-0 h6">Charges & Reimbursements</h4>
                            </div>
                            <div class="card-body">
                                <table class="table table-sm table-responsive-md mb-0 text-center">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>{{ __('Date') }}</th>
                                            <th>{{__('Amount')}}</th>
                                            <th>{{__('Status')}}</th>
                                            <th class="text-left">{{__('Message')}}</th>
                                            <th>{{__('Processed By')}}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                            @forelse ($admin_withdraw_requests as $key => $admin_withdraw_request)
                                                <tr>
                                                    <td>{{ $key+1 }}</td>
                                                    <td>{{ date('d-m-Y', strtotime($admin_withdraw_request->created_at)) }}</td>
                                                    <td>{{ single_price($admin_withdraw_request->amount) }}</td>
                                                    <td>
                                                        <span class="ml-2" style="color:green"><strong>{{__('COMPLETED')}}</strong></span>
                                                    </td>
                                                    <td class="text-left">
                                                        {{ $admin_withdraw_request->message }}
                                                    </td>
                                                    <td>
                                                            {{App\User::where('user_type','admin')->first()->name}}
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
                            </div>
                        </div>
                        @if(count($admin_withdraw_requests) > 9)
                                        
                        <div class="pagination-wrapper py-1">
                            <ul class="pagination justify-content-end">
                                {{ $admin_withdraw_requests->links() }}
                            </ul>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="modal fade" id="request_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-zoom product-modal" id="modal-size" role="document">
            <div class="modal-content position-relative">
                <div class="modal-header">
                    <h5 class="modal-title strong-600 heading-5">{{__('Send A Withdraw Request')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @if (Auth::user()->seller->available_balance - $total > 0)
                    <form class="" action="{{ route('balance.store') }}" method="post">
                        @csrf
                        <div class="modal-body gry-bg px-3 pt-3">
                            <div class="row">
                                <div class="col-md-3">
                                    <label>{{__('Amount')}} <span class="required-star">*</span></label>
                                </div>
                                <div class="col-md-9">
                                    <input type="number" class="form-control mb-3" name="amount" min="1" max="{{ Auth::user()->seller->available_balance }}" placeholder="Amount" required>
                                </div>
                            </div>
                           <!--> <div class="row">
                                <div class="col-md-3">
                                    <label>{{__('Message')}}</label>
                                </div>
                                <div class="col-md-9">
                                    <textarea name="message" rows="8" class="form-control mb-3"></textarea>
                                </div>
                            </div>
                            -->
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
    <script type="text/javascript">
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
