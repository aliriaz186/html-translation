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
                                        {{__('Product Query')}}
                                    </h2>
                                </div>
                                <div class="col-md-6">
                                    <div class="float-md-right">
                                        <ul class="breadcrumb">
                                            <li><a href="{{ route('home') }}">{{__('Home')}}</a></li>
                                            <li><a href="{{ route('dashboard') }}">{{__('Dashboard')}}</a></li>
                                            <li class="active"><a href="{{ route('product_query.index') }}">{{__('Product Query')}}</a></li>
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
                                            <th>#</th>
                                            <th>{{__('Product')}}</th>
                                            <th class="w-50">{{__('Question')}}</th>
                                            <th class="w-50">{{__('Reply')}}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($product_queries as $key=>$product_query)
                                        <tr>
                                            <td>{{ ($key+1)}}</td>
                                            <td><a href="{{ route('product', $product_query->product->slug) }}" target="_blank">{{ __($product_query->product->name) }}</a></td>
                                            <td>{{$product_query->question}}</td>
                                            @if($product_query->replay)
                                                  <td style="width:14%;">{!!$product_query->replay!!}</td>
                                            @else
                                             <td><button type="button" onclick="show_chat_modal('{{$product_query->product->name}}' , {{$product_query->id}})" class="btn btn-sm btn-primary">Reply</button></td>
                                             @endif
                                    </tr>
                                        @empty
                                        <tr>
                                            <td class="text-center pt-5 h4" colspan="100%">
                                                <i class="la la-meh-o d-block heading-1 alpha-5"></i>
                                                <span class="d-block">{{ __('No histroy found.') }}</span>
                                            </td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="pagination-wrapper py-4">
                            <ul class="pagination justify-content-end">
                                {{ $product_queries->links() }}
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <div class="modal" id="chat_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-zoom product-modal" id="modal-size" role="document">
            <div class="modal-content position-relative">
                <div class="modal-header">
                    <h5 class="modal-title strong-600 heading-5">{{__('Reply User')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="" action="{{ route('seller.product_query.reply') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body gry-bg px-3 pt-3">
                        <div class="form-group">
                        <input type="text" class="form-control mb-3" id="name"  placeholder="Query Product"  required readonly>
                        <input type="hidden" id="query_id" name="query_id" >
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



@endsection

@section('script')

    <script>
        
        function show_chat_modal(name , query_id){
          
            $('#name').val(name);
            $('#query_id').val(query_id);
            $('#chat_modal').modal('show');    
        }

    </script>
@endsection
    