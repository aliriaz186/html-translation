@extends('frontend.layouts.app')

@section('content')

    <section class="gry-bg py-4 profile">
        <div class="container-fluid p-4">
            <div class="row cols-xs-space cols-sm-space cols-md-space">
                <div class="col-lg-2-1 d-none d-lg-block">
                    @include('frontend.inc.seller_side_nav')
                </div>
                <div class="col-lg-9">
                    <div class="main-content">
                        <!-- Page title -->
                        <div class="page-title">
                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <h2 class="heading heading-6 text-capitalize strong-600 mb-0">
                                        {{__('Orders csv')}}
                                    </h2>
                                </div>
                                <div class="col-md-6">
                                    <div class="float-md-right">
                                        <ul class="breadcrumb">
                                            <li><a href="{{ route('home') }}">{{__('Home')}}</a></li>
                                            <li><a href="{{ route('dashboard') }}">{{__('Dashboard')}}</a></li>
                                            <li class="active"><a href="{{ route('orders.index') }}">{{__('Orders csv')}}</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Order history table -->
                        <div class="card no-border mt-4">
                            <div class="card-header">
                             <h2 class="heading heading-6 text-capitalize strong-600 mb-0">
                                        {{__('Orders csv')}}
                               </h2>
                            </div>
                            <div class="card-body">
                            <form method="post" action="{{route('seller.import.orders.update')}}" >
                            @csrf
                            <input type="hidden" name="orders" value="{{json_encode($orders)}}">
                                   <table class="table table-sm table-hover table-responsive-md">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>{{__('Order Id')}}</th>
                                            <th>{{__('Product Id')}}</th>
                                            <th>{{__('Payment Status')}}</th>
                                            <th width="10%">{{__('Delivery Status')}}</th>
                                            <th>{{__('Shipping Type')}}</th>
                                            <th>{{__('Tracking Number')}}</th>
                                            <th>{{__('Shipping Cost')}}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($orders as $key=>$order)
                                        @if($key==0) @continue @endif
                                         <tr>
                                            <td> {{ $key }}  </td>
                                            <td> {{ $order[0] }}  </td>
                                            <td> {{ $order[1] }}  </td>
                                            <td> {{ ucfirst($order[7]) }}  </td>
                                            <td> {{ ucfirst($order[8]) }}  </td>
                                            <td> {{ str_replace('_',' ',ucfirst($order[9])) }}  </td>
                                            <td> {{ $order[11] }}  </td>
                                            <td> {{ $order[5] }}  </td>
                                         </tr>   
                                        @empty
                                        @endforelse
                                    
                                    </tbody>
                                </table>
				<input type="submit" class="btn btn-primary pull-right" value="Update">
				</form>
                            </div>
                        </div>

                      
                    </div>
                </div>
            </div>
        </div>
    </section>

 @endsection