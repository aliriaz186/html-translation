@extends('frontend.layouts.app')
@section('content')

<section class="gry-bg py-4 profile">
        <div class="container-fluid p-4">
            <div class="row cols-xs-space cols-sm-space cols-md-space">
                <div class="col-lg-2-1 d-none d-lg-block">@include('frontend.inc.seller_side_nav')</div>
                <div class="col-lg-9">
                    <!-- Page title -->
                    <div class="page-title">
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <h2 class="heading heading-6 text-capitalize strong-600 mb-0">
                                            {{__('Product Subscription')}}
                                </h2>
                            </div>
                            <div class="col-md-6">
                                <div class="float-md-right">
                                    <ul class="breadcrumb">
                                            <li><a href="{{ route('home') }}">{{__('Home')}}</a>
                                            </li>
                                            <li class="active"><a href="{{ route('seller.subscription') }}">{{__('Subscription')}}</a>
                                            </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="">
                        <div class="row">{{-- card no-border mt-4 --}}
                            <div style="width:100%">
                                 <div class="card no-border mt-4" style="width:100%">
                                        <section class="pricing py-5">
                                                <div class="alert alert-success w-100">Your Current package is <strong style="color:#dc3545!important;text-transform:uppercase"> {{$subscription->type}}</strong></div>
                                                <div class="container">
                                                  <div class="row">
                                                    <!-- Free Tier -->
                                                    @if(count(App\subscription_products_prices::all())>0)
                                                        @foreach (App\subscription_products_prices::all() as $key=>$table)
                                                            <div class="col-lg-3">
                                                                <div class="ribbon" style="background-color:{{$table->ribbon_color}}"><p>{{ucwords($table->feature)}}</p> </div>
                                                                <div class="card mb-5 mb-lg-0 text-white" style="background-color:{{$table->background_color}}!important;">
                                                                    <div class="card-body">
                                                                        <h5 class="card-title text-white text-uppercase text-center">{{$table->type}}</h5>
                                                                        <h6 class="card-price text-center">${{$table->prices}}<span class="period">/month</span></h6>
                                                                        <hr>
                                                                        <ul class="fa-ul">
                                                                            <li><span class="fa-li"><i class="la la-check-circle-o"></i></span><strong id="product">{{$table->product}} products</strong></li>
                                                                            <li><span class="fa-li"><i class="la la-check-circle-o"></i></span>{{$table->time}} Days</li>
                                                                            <li><span class="fa-li"><i class="la la-check-circle-o"></i></span> <a  data-toggle="{{json_decode($table->list)?'modal':''}}"  class="{{json_decode($table->list)?'cursor':''}}" data-target="#List--{{$key}}">{{json_decode($table->list)?'Learn more':'Unlimited Access'}}</a></li>
                                                                        </ul>
                                                                            <input type="hidden" name="type" value="{{$table->type}}">
                                                                            <input type="hidden" name="price" value="{{$table->prices}}">
                                                                            <input type="hidden" name="expire_date" value="{{$table->time}}">
                                                                        @if($table->type == $subscription->type && $subscription->status == 'successful')
                                                                            <input type="button" class="btn btn-block text-uppercase bg-danger text-white" readonly="1" value="Your Package" style="opacity:1">
                                                                        @else
                                                                            @php if($table->product<$your_product){$decide = 'loss'; $loss = $your_product-$table->product;}else{$decide = 'get'; $loss = $table->product;} @endphp
                                                                            <input type="button" class="btn btn-block text-uppercase btn-secondary text-secodary bg-white text-secondary" style="opacity:1" onclick="goToDb({{$loss}},'{{$table->type}}',{{$table->prices}},'{{$table->time}}','{{$table->id}}','{{$decide}}')" style="background:#fff;color:#000" value="pay">
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    @endif
                                                  </div>
                                                </div>
                                              </section>
                                 </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

        <div class="modal fade" id="payment_model" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <form method="POST"  action="{{route('shop-subscription')}}">@csrf
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Subscription</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            <div class="modal-body">
                                You have <strong>{{$subscription->type}}</strong> Package if you choose <span id="productType"></span> <span id="decide"> </span>  <strong id="productValue"> </strong> products.
                                <input type="hidden" name="id" id="table_id">
                                <input type="hidden" name="type" id="table_type">
                                <input type="hidden" name="product_subscription_id" value="{{$subscription->id}}">                         
                            </div>
                            <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <input type="submit" class="btn btn-primary" value = "Go" >
                            </div>
                        </div>
                    </div>
                </form>
        </div>

            @foreach (App\subscription_products_prices::all() as $key=>$table)
                <div class="modal fade" id="List--{{$key}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-zoom product-modal" id="modal-size" role="document">
                            <div class="modal-content position-relative">
                                <div class="modal-header">
                                    <h5 class="modal-title strong-600 heading-5">{{__($table->feature)}}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                        @php $list =  json_decode($table->list);  @endphp
                                        @if($list)
                                            <div class="card no-border" style="width:100%">
                                                <section class="pricing py-5">
                                                        <div class="container">
                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                                <div class="card mb-5 mb-lg-0">
                                                                    <div class="card-body">
                                                                        <h5 class="card-title text-muted text-uppercase text-center">{{$table->type}}</h5>
                                                                        <h6 class="card-price text-center">${{$table->prices}}<span class="period">/month</span></h6>
                                                                        <hr>
                                                                        <ul class="fa-ul">
                                                                        @foreach ($list as $li)
                                                                            <li><span class="fa-li"><i class="la la-check-circle-o"></i></span><strong >{{$li}}</strong></li>
                                                                        @endforeach
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        </div>
                                                </section>
                                            </div>
                                        @else
                                            <p>No mote data</p>
                                        @endif
                                </div>
                            </div>
                        </div>
                </div>
            @endforeach

            @endsection
            @section('script')
            <script>
                $('#free_table').submit(function(e){
                        e.preventDefault();
                        $('#model').modal('show');
                });

            function goToDb(loss,type,price,time,id,decide){
                    $('#table_id').val(id);
 		    $('#table_type').val(type);
                    $('#decide').html(decide);

                    $('#productValue').html(loss);

                    $('#productType').html(type);
                    $('#payment_model').modal('show');

                    $('#Pr_type').val(type);
                    $('#Pr_prices').val(price);
                    $('#Pr_expire').val(time);
            }
        </script>
        @endsection
