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
                                        {{__('Seller Reviews')}}
                                    </h2>
                                </div>
                                <div class="col-md-6">
                                    <div class="float-md-right">
                                        <ul class="breadcrumb">
                                            <li><a href="{{ route('home') }}">{{__('Home')}}</a></li>
                                            <li><a href="{{ route('dashboard') }}">{{__('Dashboard')}}</a></li>
                                            <li class="active"><a href="{{ route('ratings.seller') }}">{{__('Seller Reviews')}}</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <!-- Order history table -->
                        <div class="card no-border mt-4">
                            <div>
                                <table class="table table-sm table-responsive-md">
                                    <thead>
                                    <tr>
                                        <th>{{__('Order')}}</th>
                                        <th>{{__('Customer')}}</th>
                                        <th>{{__('Rating')}}</th>
                                        <th>{{__('Comment')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if (count($reviews) > 0)
                                        @foreach ($reviews as $key => $value)
                                            @php
                                                $review = \App\SellerFeedback::find($value->id);
                                            @endphp
                                            @if($review != null)
                                                <tr>
                                                    <td>
                                                        <a href="#{{ $value->order_code }}" onclick="show_purchase_history_details({{ $value->order_id }})">{{ $value->order_code }}</a>
                                                    </td>
                                                    <td>{{ \App\User::where('id', $review->user_id)->first()['name'] }} ({{ \App\User::where('id', $review->user_id)->first()['email'] }})</td>
                                                    <td>
                                                        <div class="star-rating star-rating-sm mt-1">
                                                            @for ($i=0; $i < floor($review->rating); $i++)
                                                                <i class="fa fa-star active"></i>
                                                            @endfor
                                                            @for ($i=0; $i < ceil(5-$review->rating); $i++)
                                                                <i class="fa fa-star
                                                                        @if($i==0 && ($review->rating - floor($review->rating)) > 0 && ($review->rating - floor($review->rating)) <= 0.5)
                                                                        half
@elseif($i==0 && (ceil($review->rating) - $review->rating) > 0 && (ceil($review->rating) - $review->rating) <= 0.5)
                                                                        active
@endif">
                                                                </i>
                                                            @endfor
                                                        </div>
                                                    </td>
                                                    <td>{{ $review->message }}</td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    @else
                                        <tr>
                                            <td class="text-center pt-5 h4" colspan="100%">
                                                <i class="la la-meh-o d-block heading-1 alpha-5"></i>
                                                <span class="d-block">{{ __('No review found.') }}</span>
                                            </td>
                                        </tr>
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="modal fade" id="order_details" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-zoom product-modal" id="modal-size" role="document">
            <div class="modal-content position-relative">
                <div class="c-preloader">
                    <i class="fa fa-spin fa-spinner"></i>
                </div>
                <div id="order-details-modal-body">

                </div>
            </div>
        </div>
    </div>
<script>
    $('#order_details').on('hidden.bs.modal', function () {
        location.reload();
    })
</script>
@endsection
