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
                                        {{__('Seller Feedbacks')}}
                                    </h2>
                                </div>
                                <div class="col-md-6">
                                    <div class="float-md-right">
                                        <ul class="breadcrumb">
                                            <li><a href="{{ route('home') }}">{{__('Home')}}</a></li>
                                            <li><a href="{{ route('dashboard') }}">{{__('Dashboard')}}</a></li>
                                            <li class="active"><a href="{{ route('feedbacks.seller') }}">{{__('Seller Feedbacks')}}</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row  bg-white p-3 m-1 w-100">
                        <div class="col-lg-6">
                            <h5 class="text-center">Feedback Ratings</h5>
                            <table class="table table-stripped text-center table-bordered">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>1 month</th>
                                        <th>6 month</th>
                                        <th>12 months</th>
                                        <th>Lifetime</th>
                                    </tr>
                                </thead>
                                <tbody>
                                      <tr>
                                        <td>Positive</td>
                                        @php $id = Auth::user()->id ;
                                        @endphp
                                        <td>{{count(App\SellerFeedback::where('seller_id',$id)->where('status',1)->where('created_at','>',\Carbon\Carbon::now()->subMonths(1))->where('rating','>',3)->get())}}</td>
                                        <td>{{count(App\SellerFeedback::where('seller_id',$id)->where('status',1)->where('created_at','>',\Carbon\Carbon::now()->subMonths(6))->where('rating','>',3)->get())}}</td>
                                        <td>{{count(App\SellerFeedback::where('seller_id',$id)->where('status',1)->where('created_at','>',\Carbon\Carbon::now()->subMonths(12))->where('rating','>',3)->get())}}</td>
                                        <td>{{count(App\SellerFeedback::where('seller_id',$id)->where('status',1)->where('created_at','>',\Carbon\Carbon::now()->subYears(12))->where('rating','>',3)->get())}}</td>                   
                                    
                                    </tr>
                                     
                                    <tr>
                                        <td>Neutal</td>
                                        <td>{{count(App\SellerFeedback::where('seller_id',$id)->where('status',1)->where('created_at','>',\Carbon\Carbon::now()->subMonths(1))->where('rating',3)->get())}}</td>
                                        <td>{{count(App\SellerFeedback::where('seller_id',$id)->where('status',1)->where('created_at','>',\Carbon\Carbon::now()->subMonths(6))->where('rating',3)->get())}}</td>
                                        <td>{{count(App\SellerFeedback::where('seller_id',$id)->where('status',1)->where('created_at','>',\Carbon\Carbon::now()->subMonths(12))->where('rating',3)->get())}}</td>
                                        <td>{{count(App\SellerFeedback::where('seller_id',$id)->where('status',1)->where('created_at','>',\Carbon\Carbon::now()->subYears(12))->where('rating',3)->get())}}</td>                   
                                    
                                    </tr>
 				                     <tr>
                                        <td>Negative</td>
                                        <td>{{count(App\SellerFeedback::where('seller_id',$id)->where('status',1)->where('created_at','>',\Carbon\Carbon::now()->subMonths(1))->where('rating','<',3)->get())}}</td>
                                        <td>{{count(App\SellerFeedback::where('seller_id',$id)->where('status',1)->where('created_at','>',\Carbon\Carbon::now()->subMonths(6))->where('rating','<',3)->get())}}</td>
                                        <td>{{count(App\SellerFeedback::where('seller_id',$id)->where('status',1)->where('created_at','>',\Carbon\Carbon::now()->subMonths(12))->where('rating','<',3)->get())}}</td>
                                        <td>{{count(App\SellerFeedback::where('seller_id',$id)->where('status',1)->where('created_at','>',\Carbon\Carbon::now()->subYears(12))->where('rating','<',3)->get())}}</td>                   
                                    
                                      </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-lg-6">
                            <h5 class="text-center">Detailed Seller Raitngs</h5>
                            <br><br><br>
                            <div class="row">
                                <div class="col-md-6 border">
                                    <p style="margin: 0px">Accurate Description</p>
                                    <div class="star-rating star-rating-sm mt-1">
                                        @php $ratingADN = App\SellerFeedbackDetail::avg('ratingADN');
                                             $ratingDT = App\SellerFeedbackDetail::avg('ratingDT');
                                             $ratingCOMM = App\SellerFeedbackDetail::avg('ratingCOMM');
                                             $ratingACCD = App\SellerFeedbackDetail::avg('ratingACCD');
                                        @endphp
                                        {{ renderStarRating($ratingADN) }}
                                    </div>
                                </div>
                                <div class="col-md-6 border">
                                    <p style="margin: 0px">Delivery Time</p>
                                    <div class="star-rating star-rating-sm mt-1">
                                        {{ renderStarRating($ratingDT) }}
                                    </div>
                                </div>
                                <div class="col-md-6 border">
                                    <p style="margin: 0px">Communication</p>
                                    <div class="star-rating star-rating-sm mt-1">
                                        {{ renderStarRating($ratingCOMM) }}
                                    </div>
                                </div>
                                <div class="col-md-6 border">
                                    <p style="margin: 0px">Reasonable Postage Cost</p>
                                    <div class="star-rating star-rating-sm mt-1">
                                        {{ renderStarRating($ratingACCD) }}
                                    </div>
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
                                            <th>#</th>
                                            <th>{{__('Product')}}</th>
                                            <th>{{__('Order Code')}}</th>
                                            <th>{{__('Rating')}}</th>
                                            <th>{{__('Comment')}}</th>
                                            <th>{{__('Reply')}}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(count($feedbacks)>0)
                                        @foreach ($feedbacks as $key=>$feedback)
                                        <tr>
                                            <td>{{ ($key+1)}}</td>
                                            <td>{{App\Product::findOrFail(App\OrderDetail::where('order_id',$feedback->order_id)->first()->product_id)->name}}</td>
                                            <td>{{$feedback->order->code}}</td>
                                            <td>  
                                             <span class="star-rating star-rating-sm d-block">
                                           	@if($feedback->rating>0)
                                                  {{ renderStarRating($feedback->rating) }}
                                                @else 
                                                  {{ renderStarRating($feedback->rating) }}  
                                                @endif
                                             </span>
                                             </td>
                                             <td style="width:14%;">{{$feedback->message}}</td>
                                            @if($feedback->reply)
                                                  <td style="width:14%;">{!!$feedback->reply!!}</td>
                                            @else
                                             <td><button data-toggle="modal" data-target="#chatModal" class="btn btn-sm btn-primary">Reply</button></td>
                                             @endif
                                             
                                        </tr>
                                        @endforeach
                                        @else
                                        <tr>
                                            <td class="text-center pt-5 h4" colspan="100%">
                                                <i class="la la-meh-o d-block heading-1 alpha-5"></i>
                                                <span class="d-block">{{ __('No feedback found.') }}</span>
                                            </td>
                                        </tr>
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="pagination-wrapper py-4">
                            <ul class="pagination justify-content-end">
                                {{ $feedbacks->links() }}
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    @foreach ($feedbacks as $feedback)

    <div class="modal" id="chatModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-zoom product-modal" id="modal-size" role="document">
            <div class="modal-content position-relative">
                <div class="modal-header">
                    <h5 class="modal-title strong-600 heading-5">{{__('Reply Customer')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="" action="{{ route('feedback.rplay') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body gry-bg px-3 pt-3">
                        <div class="form-group">
                        <input type="text" class="form-control mb-3" name="title"  placeholder="User Name" value="{{App\User::findOrFail($feedback->customer_id)->name}}"  required readonly>
                        <input type="hidden" name="feedback_id" value="{{$feedback->id}}">
                    </div>
                        <div class="form-group">
                            <textarea class="form-control" rows="8" name="message" required placeholder="Your Reply"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-link" data-dismiss="modal">{{__('Cancel')}}</button>
                        <button type="submit" class="btn btn-base-1 btn-styled">{{__('Send')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endforeach

@endsection
