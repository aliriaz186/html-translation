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
                                        {{__('Flash Deal')}}
                                    </h2>
                                </div>
                                <div class="col-md-6">
                                    <div class="float-md-right">
                                        <ul class="breadcrumb">
                                            <li><a href="{{ route('home') }}">{{__('Home')}}</a></li>
                                            <li><a href="{{ route('dashboard') }}">{{__('Dashboard')}}</a></li>
                                            <li><a href="{{ route('seller.flashDeal') }}">{{__('Flash Deal')}}</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4 offset-md-4">
                                <a class="cursor dashboard-widget text-center plus-widget mt-4 d-block"  data-toggle="modal" data-target="#flashDeals">
                                    <i class="la la-plus"></i>
                                    <span class="d-block title heading-6 strong-400 c-base-1">{{ __('Add New Flash Deal') }}</span>
                                </a>
                            </div>
                        </div>

                        <div class="card no-border mt-4">
                            <div class="card-header py-2">
                                <div class="row align-items-center">
                                    <div class="col-md-6 col-xl-3">
                                        <h6 class="mb-0">All Flash deals</h6>
                                    </div>
                                    <div class="col-md-6 col-xl-3 ml-auto">
                                        <form class="" action="" method="GET">
                                            <input type="text" class="form-control" id="search" name="search" @isset($search) value="{{ $search }}" @endisset placeholder="Search Flash Deal">
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <table class="table table-sm table-hover table-responsive-md">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>{{__('First Flash Deal')}}</th>
                                            <th>{{__('Second Flash Deal')}}</th>
                                            <th>{{__('Third Flash Deal')}}</th>
                                            <th>{{__('Date')}}</th>
                                            <th>{{__('Option')}}</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($flashDeals as $key => $FD)
                                            <tr>
                                                <td>{{ ($key+1) }}</td>
                                               @if($FD->firstDeal) <td>{{str_limit(App\Product::where('id',$FD->firstDeal)->first()->name, $limit = 10, $end="...") }}</td>@else <td> </td>@endif
                                               @if($FD->secondDeal) <td>{{str_limit(App\Product::where('id',$FD->secondDeal)->first()->name, $limit = 10, $end="...") }}</td>@else <td> </td>@endif
                                               @if($FD->thirdDeal) <td>{{str_limit(App\Product::where('id',$FD->thirdDeal)->first()->name, $limit = 10, $end="...") }}</td>@else <td> </td>@endif

                                              <td>{{explode(' ',$FD->created_at)[0]}}</td>
                                                <td><div class="dropdown">
                                                        <button class="btn" type="button" id="dropdownMenuButton-{{ $key }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <i class="fa fa-ellipsis-v"></i>
                                                        </button>
                                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton-{{ $key }}">
                                                            <a data-toggle="modal" data-target="#status" class="dropdown-item">{{__('Status')}}</a>
                                                            <button onclick="confirm_modal('{{route('seller.flashDeal.destroy', $FD->id)}}')" class="dropdown-item">{{__('Delete')}}</button>
                                                        </div>
                                                    </div>
                                                </td>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="pagination-wrapper py-4">
                            <ul class="pagination justify-content-end">
                                {{-- {{ $coupons->links() }} --}}
                            </ul>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

    @php $FD = App\FlashDealSeller::where('user_id',Auth::user()->id)->first(); @endphp

@if($FD)
<div class="modal" id="flashDeals" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-zoom product-modal" id="modal-size" role="document">
        <div class="modal-content position-relative">
            <div class="modal-header">
                <h5 class="modal-title strong-600 heading-5" style="margin-left: auto">{{__('CREATE FLASH DEAL')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <form class="" action="{{ route('seller.flashDeal.update',$FD->id) }}" method="POST">
                @csrf
             <input type="hidden" name="_method" value="PATCH">
                <div class="modal-body gry-bg px-3 pt-3">
                    @if($FD->first_status==null)
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="first">First Deal</label>
                                <select name="firstDeal" id="first" class="form-control demo-select2">
                                    <option value="default" selected>Please select First Flash Deal</option>
                                    @foreach (App\Product::where('user_id',Auth::user()->id)->get() as $product)
                                        <option value="{{$product->id}}">{{$product->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    @endif
                    @if($FD->second_status==null)
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="second">Second Deal</label>
                                <select name="secondDeal" id="second" class="form-control demo-select2">
                                    <option value="default" selected>Please select Seond Flash Deal</option>
                                    @foreach (App\Product::where('user_id',Auth::user()->id)->get() as $product)
                                        <option value="{{$product->id}}">{{$product->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    @endif
                    @if($FD->third_status==null)
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="third">Third Deal</label>
                                <select name="thirdDeal" id="third" class="form-control demo-select2">
                                    <option value="default" selected>Please select Third Flash Deal</option>
                                    @foreach (App\Product::where('user_id',Auth::user()->id)->get() as $product)
                                        <option value="{{$product->id}}">{{$product->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    @endif
                    @if($FD->first_status!=null && $FD->second_status!=null && $FD->third_status!=null)
                    <p  class="heading-3 text-center">All three are active now </p>
                @endif

                </div>
                <div class="modal-footer"  style="justify-content: center;padding-left:10px">
                    <button type="button" class="btn btn-base-1 btn-styled" data-dismiss="modal">{{__('Cancel')}}</button>
                    @if($FD->first_status==null || $FD->second_status==null || $FD->third_status==null)
                    <button type="submit" class="btn btn-base-1 btn-styled">{{__('Send')}}</button>
                    @endif
                </div>
            </form>
        </div>
    </div>
</div>
@else
<div class="modal" id="flashDeals" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-zoom product-modal" id="modal-size" role="document">
        <div class="modal-content position-relative">
            <div class="modal-header">
                <h5 class="modal-title strong-600 heading-5" style="margin-left: auto">{{__('CREATE FLASH DEAL')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <form class="" action="{{ route('seller.flashDeal.store') }}" method="POST">
                @csrf
                <div class="modal-body gry-bg px-3 pt-3">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="first">First Deal</label>
                                <select name="firstDeal" id="first" class="form-control demo-select2" required>
                                    <option value="default" selected>Please select First Flash Deal</option>
                                    @foreach (App\Product::where('user_id',Auth::user()->id)->get() as $product)
                                        <option value="{{$product->id}}">{{$product->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="second">Second Deal</label>
                                <select name="secondDeal" id="second" class="form-control demo-select2" required>
                                    <option value="default" selected>Please select Seond Flash Deal</option>
                                    @foreach (App\Product::where('user_id',Auth::user()->id)->get() as $product)
                                        <option value="{{$product->id}}">{{$product->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="third">Third Deal</label>
                                <select name="thirdDeal" id="third" class="form-control demo-select2" required>
                                    <option value="default" selected>Please select Third Flash Deal</option>
                                    @foreach (App\Product::where('user_id',Auth::user()->id)->get() as $product)
                                        <option value="{{$product->id}}">{{$product->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer"  style="justify-content: center;padding-left:10px">
                    <button type="button" class="btn btn-base-1 btn-styled" data-dismiss="modal">{{__('Cancel')}}</button>
                    <button type="submit" class="btn btn-base-1 btn-styled">{{__('Send')}}</button>
                </div>
            </form>
        </div>
    </div>
</div>


@endif



@if($FD)
{{-- =======================================Status========================================== --}}

<div class="modal" id="status" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-zoom product-modal" id="modal-size" role="document">
        <div class="modal-content position-relative">
            <div class="modal-header">
                <h5 class="modal-title strong-600 heading-5" style="margin-left: auto">{{__('STATUS FLASH DEAL')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <form class="" action="{{ route('seller.flashDeal.store') }}" method="POST">
                @csrf
                @php $FD = App\FlashDealSeller::first(); @endphp
                <div class="modal-body gry-bg px-3 pt-3">
                   @if($FD->first_status!=null)
                    <div class="row">
                        <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="first">First Deal</label>
                                    <input style="width:80%" readonly class="form-control" type="text" value="{{str_limit(App\Product::where('id',$FD->firstDeal)->first()->name, $limit = 10, $end="...") }}">
                                    <td><label class="switch" style="top: -28px;left: 86%;">
                                        <button id="first" onclick="update_status(this)" class="btn btn-sm btn-danger">x</button>
                                    </td>
                                </div>
                        </div>
                    </div>
                    @endif
                    @if($FD->second_status!=null)
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="second">Second Deal</label>
                                <input style="width:80%" readonly class="form-control" type="text" value="{{str_limit(App\Product::where('id',$FD->secondDeal)->first()->name, $limit = 10, $end="...") }}">
                                <td><label class="switch" style="top: -28px;left: 86%;">
                                    <button id="second" onclick="update_status(this)" class="btn btn-sm btn-danger">x</button>
                                </td>
                            </div>
                    </div>
                    </div>
                    @endif
                    @if($FD->third_status!=null)
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="third">Third Deal</label>
                                <input style="width:80%" readonly class="form-control" type="text" value="{{str_limit(App\Product::where('id',$FD->thirdDeal)->first()->name, $limit = 10, $end="...") }}">
                                <td><label class="switch" style="top: -28px;left: 86%;">
                                    <button id="third" onclick="update_status(this)" class="btn btn-sm btn-danger">x</button>
                                </td>
                            </div>
                    </div>

                    </div>
                    @endif
                </div>
                <div class="modal-footer"  style="justify-content: center;padding-left:10px">
                    <button type="button" class="btn btn-base-1 btn-styled" data-dismiss="modal">{{__('Cancel')}}</button>
                    <button type="submit" class="btn btn-base-1 btn-styled">{{__('Send')}}</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif

@endsection


@section('script')
<script>

function update_status(el,DB_id){
            status = 0;
            $.post('{{ route('seller.flashDeal.updateStatus') }}', {_token:'{{ csrf_token() }}', id:DB_id, status:status,status_number:el.id}, function(data){
                if(data == 1){
                    showFrontendAlert('success', 'Status updated successfully');
                    location.reload();
                }
                else if(data==2){
                    showFrontendAlert('warning', 'Its set by admin');
                    location.reload();

                }
                else{
                    showFrontendAlert('danger', 'Something went wrong');
                    location.reload();

                }

            });
        }



$(document).ready(function(){
        $('.demo-select2').select2();
    });




</script>

@endsection
