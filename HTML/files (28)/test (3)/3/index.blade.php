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
                        <div class="full-strach" style="width:130%">
                            <div class="page-title">
                                <div class="row align-items-center">
                                    <div class="col-md-6 col-12">
                                        <h2 class="heading heading-6 text-capitalize strong-600 mb-0">
                                            {{__('Loyality')}}
                                        </h2>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="float-md-right">
                                            <ul class="breadcrumb">
                                                <li><a href="{{ route('home') }}">{{__('Home')}}</a></li>
                                                <li><a href="{{ route('dashboard') }}">{{__('Dashboard')}}</a></li>
                                                <li class="active"><a href="{{ route('loyalty.index') }}">{{__('Loyality')}}</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @if($referral->minimum_amount!='')
                                <div class="info bg-white mt-3 p-3"> <i class="la la-info text-danger" style="font-size: 1rem"></i>{{__('Minimum Amount to be converted into a voucher is ')}}<strong>{{single_price($referral->minimum_amount)}}</strong></div>
                            @else
                            <div class="info bg-white mt-3 p-3"> <i class="la la-info text-danger" style="font-size: 1rem"></i>{{__('Minimum Amount to be converted into a voucher is ')}}<strong>{{$referral->minimum_point}} {{__('points')}}</strong></div>
                            @endif
                        </div>
                    <div class="card no-bloyal mt-4">
                        <div>
                            <table class="table table-sm table-hover table-responsive-md">
                                <thead>
                                <tr>
                                    <th>{{__('#')}}</th>
                                    <th>{{__('Date')}}</th>
                                    <th>{{__('Order Code')}}</th>
                                    <th>{{__('Purchase Item')}}</th>
                                    <th>{{__('Point Status')}}</th>
                                    <th>{{__('Point Earned')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @php $totalPoints = 0; @endphp
                                    @php $totalRewards = 0; @endphp
                                    @php $totalPendingRewards = 0; @endphp
                                    @forelse ($loyality as $key => $loyal)
                                        <tr>
                                            <td>{{($key+1)}}</td>
                                            <td>{{$loyal->dates}}</td>
                                            <td>{{$loyal->order_code}} </td>
                                            <td>{{$loyal->product->name}} </td>
                                            <td>
                                                @if($loyal->status=='panding')
                                                   {{__('Awaiting validation')}}
                                                @elseif($loyal->status=='used')
                                                   {{__('Used')}}
                                                @elseif($loyal->status=='validation_cancel')
                                                   {{__('Validation Cancel')}}
                                                @elseif($loyal->status=='validation_done')
                                                   {{__('Validation Done')}}
                                                @endif
                                            </td>
                                        @if($loyal->status=='validation_done')
                                            @php $totalPoints+=$loyal->point_earned;$totalRewards+=$loyal->reward;@endphp
                                        @endif
                                            <td>{{$loyal->point_earned}} </td>
                                            @php
                                                if($loyal->status=='pending'){$totalPendingRewards+=$loyal->reward;}
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

                            <div class="pagination-wrapper py-4 pr-4 {{count($loyality)>5?'':'d-none'}}">
                                <ul class="pagination justify-content-end">
                                    {{ $loyality->links() }}
                                </ul>
                            </div>

                        </div>
                    </div>
                    @if(session('myLoyality') || isset($myLoyalityView))
                        <div class="col-md-6 col-12 mt-3">
                            <h2 class="heading heading-6 text-capitalize strong-600 mb-0">
                                {{__('MY VOUCHERS FROM LOYALTY POINTS')}}
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
                                        @php $ML =  App\myLoyality::where('user_id',Auth::user()->id)->paginate(5);@endphp
                                    @foreach ($ML as $key => $myLoyal)
                                        <tr>
                                            <td>{{($key+1)}}</td>
                                            <td>{{$myLoyal->created_at->format('d-m-Y')}}</td>
                                            <td>{{$myLoyal->value}} </td>
                                            <td>{{$myLoyal->code}} </td>
                                            <td>{{$myLoyal->valid_from}}</td>
                                            <td>{{$myLoyal->valid_until}}</td>
                                            <td>{{$myLoyal->status}}</td>
                                            <td>
                                                <div class="dropdown">
                                                    <button class="btn" type="button" id="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="fa fa-ellipsis-v"></i>
                                                    </button>
                                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="">
                                                    @php $myLoyalityView = json_decode($myLoyal->order_id ); @endphp
                                                    @foreach ($myLoyalityView as $mLV)
                                                            <a class="dropdown-item" href="{{route('visit.name', $mLV)}}">
                                                            @php $order = App\Order::where('id',$mLV)->first(); @endphp
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
                                <div class="pagination-wrapper py-4 pr-4 {{count($ML)>5?'':'d-none'}}">
                                    <ul class="pagination justify-content-end">
                                        {{ $ML->links() }}
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endif
                    </div>
                    @if( ( ($totalPoints  >= $referral->minimum_point && $referral->minimum_point!=null) ||  ($totalRewards  >= $referral->minimum_amount) && $referral->minimum_amount!=null) && $totalRewards>0 )
                        <div class="bottom_code text-center">
                            <div class="box mt-4 form-group" >
                                <a  onclick="confirm_modal_loyality('{{route('transferPoints',$totalRewards)}}');" class="btn btn-sm btn-danger text-white">{{__('Transfer my Points into a Voucher of ')}} {{single_price($totalRewards)}}</a>
                            </div>
                        </div>
                    @endif
                </div>
              <div class="col-md-2 theme_color" style="margin-top:5.5rem">
    <div class="col-md-12 col-6">
        <div class="dashboard-widget text-center mt-4 c-pointer">
            <a href="javascript:;" class="d-block">
                <span class="d-block sub-title">{{__('Total Points')}}</span>
                <span class="d-block title heading-3 strong-400">{{$totalPoints<10?'0'.$totalPoints:$totalPoints}}{{__('/p')}}</span>
            </a>
        </div>
    </div>
    <div class="col-md-12 col-6">
        <div class="dashboard-widget text-center mt-4 c-pointer">
            <a href="javascript:;" class="d-block">
                <span class="d-block sub-title"> {{__('Points Value')}}</span>
                <span class="d-block title heading-3 strong-400">{{$referral->point}}</span>
            </a>
        </div>
    </div>
    <div class="col-md-12 col-6">
        <div class="dashboard-widget text-center mt-4 c-pointer">
            <a href="javascript:;" class="d-block">
                <span class="d-block sub-title"> {{__('Total Rewards')}}</span>
                <span class="d-block title heading-3 strong-400">{{single_price($totalRewards)}}</span>
            </a>
        </div>
    </div>
    <div class="col-md-12 col-6">
        <div class="dashboard-widget text-center mt-4 c-pointer">
            <a href="javascript:;" class="d-block">
                <span class="d-block sub-title"> {{__('Pending Rewards')}}</span>
                <span class="d-block title heading-3 strong-400">{{single_price($totalPendingRewards)}}</span>
            </a>
        </div>
    </div>
   
  
</div>
            </div>
        </div>
    </section>    
@endsection

