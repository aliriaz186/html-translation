@extends('frontend.layouts.app')

@section('content')

    <section class="gry-bg py-4 profile">
        <div class="container-fluid">
            <div class="row cols-xs-space cols-sm-space cols-md-space">
                <div class="col-lg-2-1 d-none d-lg-block">
                    @if(Auth::user()->user_type == 'seller')
                        @include('frontend.inc.seller_side_nav')
                    @elseif(Auth::user()->user_type == 'customer')
                        @include('frontend.inc.customer_side_nav')
                    @endif
                </div>

                <div class="col-lg-9">
                    <div class="main-content">
                        <!-- Page title -->
                        <div class="page-title">
                            <div class="row align-items-center">
                                <div class="col-md-6 col-12">
                                    <h2 class="heading heading-6 text-capitalize strong-600 mb-0">
                                        {{__('Saved Seller')}}
                                    </h2>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="float-md-right">
                                        <ul class="breadcrumb">
                                            <li><a href="{{ route('home') }}">{{__('Home')}}</a></li>
                                            <li><a href="{{ route('dashboard') }}">{{__('Dashboard')}}</a></li>
                                            <li class="active"><a href="{{ route('best_seller.index') }}">{{__('Saved Seller')}}</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Wishlist items -->
			@if(count($BestSellers)==0)
				<div class="card no-border mt-5">
                            <div class="card-header py-3">
                                <h4 class="mb-0 h6">{{__('Saved Seller')}}</h4>
                            </div>
                            <div class="card-body">
                                <table class="table table-sm table-responsive-md mb-0">
                                    <thead>
                                    </thead>
                                    <tbody>
                                            <tr>
                                                <td class="text-center pt-5 h4" colspan="100%">
                                                    <i class="la la-meh-o d-block heading-1 alpha-5"></i>
                                                <span class="d-block">{{__('No history found.') }}</span>
                                                </td>
                                            </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
			@else
                        <div class="row shop-default-wrapper shop-cards-wrapper shop-tech-wrapper mt-4">
                            @foreach ($BestSellers as $key => $seller)
                                @if ($seller != null)
                                    <div class="col-xl-4 col-6" id="wishlist_{{ $seller->id }}">
                                        <div class="card card-product mb-3 product-card-2">
                                            <div class="card-body p-3">
                                                <div class="card-image">
               						@php $newSeller =  App\User::findOrFail($seller->seller_id); @endphp
                                                    <a href="{{  route('shop.visit',$newSeller->shop->slug)  }}" class="d-block" style="height: 193px;background-repeat: no-repeat; background-size: cover;background-image:url('{{  asset($newSeller->shop->logo) }}');">
                                                    </a>
                                                </div>
                                                <h2 class="heading heading-6 strong-600 mt-2 text-truncate-2">
                                                    <a href="{{ route('shop.visit', $newSeller->shop->slug) }}">{{ __($newSeller->shop->name) }}</a>
                                                </h2>
                                                @php
                                                   $total = App\SellerFeedback::where('seller_id',$seller->seller_id)->where('status',1)->avg('rating');
                                                   $total = $total==null?0:$total;
                                                    $average_percentage = Seller_average_percentage($seller->seller_id);
                                            @endphp
                                                <div class="star-rating star-rating-sm mb-1">
                                                    {{ renderStarRating($total) }} {{$average_percentage}}% 
                                                </div>
                                               
                                            </div>
                                            <div class="card-footer p-3">
                                                <div class="product-buttons">
                                                    <div class="row align-items-center">
                                                        <div class="col-2">
                                                            <a href="#" class="link link--style-3" data-toggle="tooltip" data-placement="top" title="Remove from saved seller" onclick="removeFromSeller({{ $seller->id }})">
                                                                <i class="la la-trash"></i>
                                                            </a>
                                                        </div>
                                                        <div class="col-10">
                                                            <a href="{{ route('shop.visit', $newSeller->shop->slug) }}" class="btn btn-primary btn-block icon-anim">
                                                                {{ __('Visit Store') }} <i class="la la-angle-right text-sm"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
			@endif
			
                        <div class="pagination-wrapper py-4">
                            <ul class="pagination justify-content-end">
                                {{ $BestSellers->links() }}
                            </ul>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="modal fade" id="addToCart" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-zoom product-modal" id="modal-size" role="document">
            <div class="modal-content position-relative">
                <div class="c-preloader">
                    <i class="fa fa-spin fa-spinner"></i>
                </div>
                <button type="button" class="close absolute-close-btn" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div id="addToCart-modal-body">

                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script type="text/javascript">
        function removeFromSeller(id){
            $.post('{{ route('best_seller.remove') }}',{_token:'{{ csrf_token() }}', id:id}, function(data){
            if(data==1){
                showFrontendAlert('success', 'Item has been removed from saved seller');
            }else{
             showFrontendAlert('error', 'Try Again later...');
            }
                location.reload();
            })
        }
    </script>
@endsection
