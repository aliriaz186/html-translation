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
                                        {{__('Return Address')}}
                                    </h2>
                                </div>
                                <div class="col-md-6">
                                    <div class="float-md-right">
                                        <ul class="breadcrumb">
                                            <li><a href="{{ route('home') }}">{{__('Home')}}</a></li>
                                            <li><a href="{{ route('dashboard') }}">{{__('Dashboard')}}</a></li>
                                            <li><a href="{{ route('return_address.index') }}">{{__('return Address')}}</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4 offset-md-4 cursor">
                                <a class="dashboard-widget text-center plus-widget mt-4 d-block"  data-toggle="modal" data-target="#createAddress">
                                    <i class="la la-plus"></i>
                                    <span class="d-block title heading-6 strong-400 c-base-1">{{ __('Add New Return Address') }}</span>
                                </a>
                            </div>
                        </div>

                        <div class="card no-border mt-4">
                            <div class="card-header py-2">
                                   <h6>Saved Return Address</h6>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                        @foreach (App\ReturnAddres::where('user_id',Auth::user()->id)->get() as $key=>$RA)
                                    <div class="col-md-6">
                                        @php $ReturnAddress =  json_decode($RA->address); @endphp
                                            <div class="addresses">
                                                <p class="bb1">Address {{$key+1}} @if($RA->is_default)<span class="pull-right">Default </span> @endif </p>
                                                <p class="mb-0"> Name :<span>{{$ReturnAddress->name}}</span></p>
                                                <p class="mb-0"> Address 1:<span>{{$ReturnAddress->address}}</span></p>
                                                <p class="mb-0"> Address 2:<span>{{$ReturnAddress->address2}}</span></p>
                                                <p class="mb-0">City :<span>{{$ReturnAddress->city}}</span></p>
                                                <p class="mb-0">Postal Code:<span>{{$ReturnAddress->postal_code}}</span></p>
                                                <p class="mb-0">Country:<span>{{$ReturnAddress->country}}</span></p>
                                                <p class="mb-0">Phone :<span>{{$ReturnAddress->phone}}</span></p>

                                            <button class="btn  btn-sm btn-primary"  onclick="makeDefault({{$RA->id}})" >Make Default</button>
                                                    <button onclick="confirm_modal('{{route('return_address.destroy', $RA->id)}}')" class="btn  btn-sm btn-danger">{{__('Delete')}}</button>
                                                    <a href="" class="btn  btn-sm btn-info"  data-toggle="modal" data-target="#EditAddress{{$key}}">Edit</a>
                                            </div>
                                    </div>
                                        @endforeach
                                </div>
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
{{-- Make coupons  --}}
<div class="modal" id="createAddress" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-zoom product-modal" id="modal-size" role="document" style="max-width: 60%">
        <div class="modal-content position-relative">
            <div class="modal-header">
                <h5 class="modal-title strong-600 heading-5" style="margin-left: auto">{{__('RETURN INFORAMTION')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="" action="{{ route('return_address.store') }}" method="POST">
                @csrf
                <div class="modal-body gry-bg px-3 pt-3">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">{{__('Name')}}</label>
                                <input type="text" class="form-control" name="name"  id="name" placeholder="{{__('Name')}}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group has-feedback">
                                <label class="control-label">{{__('City')}}</label>
                                <input type="text" class="form-control" placeholder="{{__('City')}}" id="city" name="city" required>
                            </div>
                        </div>
                        
                    </div>


                    <div class="row">
                    	<div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">{{__('Address 1')}}</label>
                                <input type="text" class="form-control" name="address"  id="address" placeholder="{{__('Address')}}" required>
                            </div>
                        </div>
                         <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">{{__('Address 2')}}</label>
                                <input type="text" class="form-control" name="address2"  id="address2" placeholder="{{__('Address 2')}}" required>
                            </div>
                        </div>
                    </div>
                   
                    <div class="row">
                        
                        <div class="col-md-12">
                            <div class="form-group has-feedback">
                                <label class="control-label">{{__('Postal code')}}</label>
                                <input type="number" min="0" class="form-control" placeholder="{{__('Postal code')}}" id="postal_code" name="postal_code" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">{{__('Select your country')}}</label>
                                <select class="form-control custome-control demo-select2" data-live-search="true" id="country" name="country">
                                    @foreach (\App\Country::all() as $key => $country)
                                        <option value="{{ $country->name }}">{{ $country->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group has-feedback">
                                <label class="control-label">{{__('Phone')}}</label>
                                <input type="number" min="0" class="form-control" id="phone" placeholder="{{__('Phone')}}" name="phone" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <textarea name="seller_instruction" cols="30" rows="4" class="form-control" placeholder="Seller Instructions"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <textarea name="admin_instruction" cols="30" rows="14" class="form-control editor" readonly placeholder="Admin Instruction">@if(App\AdminInstructionStore::first()) {!! App\AdminInstructionStore::first()->Instruction !!} @else No Instruction Availavle @endif</textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer"  style="justify-content: center;padding-left:10px">
                    <button type="button" class="btn btn-base-1 btn-styled" data-dismiss="modal">{{__('Cancel')}}</button>
                    <button type="submit" class="btn btn-base-1 btn-styled">{{__('Save')}}</button>
                </div>
            </form>
        </div>
    </div>
</div>


{{-- ================================================EDIT========================================================= --}}
{{-- Make coupons  --}}
@foreach (App\ReturnAddres::where('user_id',Auth::user()->id)->get() as $key=>$RA)
@php $ReturnAddress =  json_decode($RA->address); @endphp
<div class="modal" id="EditAddress{{$key}}" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-zoom product-modal" id="modal-size" role="document" style="max-width: 60%">
        <div class="modal-content position-relative">
            <div class="modal-header">
                <h5 class="modal-title strong-600 heading-5" style="margin-left: auto">{{__('RETURN INFORAMTION')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="" action="{{ route('return_address.update', $RA->id) }}" method="POST"  enctype="multipart/form-data">
             <input name="_method" type="hidden" value="PATCH">
                @csrf
                <div class="modal-body gry-bg px-3 pt-3">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">{{__('Name')}}</label>
                                <input type="text" class="form-control" name="name" value="{{$ReturnAddress->name}}"  id="name" placeholder="{{__('Name')}}" required>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                     <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">{{__('Address 1')}}</label>
                                <input type="text" class="form-control" name="address"  id="address" value="{{$ReturnAddress->address}}" placeholder="{{__('Address 1')}}" required>
                            </div>
                        </div>
                         <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">{{__('Address 2')}}</label>
                                <input type="text" class="form-control" name="address2"  id="address2" value="{{$ReturnAddress->address2}}" placeholder="{{__('Address 2')}}" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group has-feedback">
                                <label class="control-label">{{__('City')}}</label>
                                <input type="text" class="form-control" placeholder="{{__('City')}}" value="{{$ReturnAddress->city}}" id="city" name="city" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group has-feedback">
                                <label class="control-label">{{__('Postal code')}}</label>
                                <input type="number" min="0" class="form-control" placeholder="{{__('Postal code')}}" value="{{$ReturnAddress->postal_code}}" id="postal_code" name="postal_code" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">{{__('Select your country')}}</label>
                                <select class="form-control custome-control demo-select2" data-live-search="true" id="country" name="country">
                                    @foreach (\App\Country::all() as $key => $country)
                                        <option value="{{ $country->name }}">{{ $country->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group has-feedback">
                                <label class="control-label">{{__('Phone')}}</label>
                                <input type="number" min="0" class="form-control" id="phone" placeholder="{{__('Phone')}}" value="{{$ReturnAddress->phone}}" name="phone" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <textarea name="seller_instruction" cols="30" rows="4" class="form-control" placeholder="Seller Instructions">{{$RA->seller_instruction}}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <textarea name="admin_instruction" cols="30" rows="14" class="form-control" readonly="true" placeholder="Admin Instruction">
                                     @if(App\AdminInstructionStore::first()) {!!  App\AdminInstructionStore::first()->Instruction !!}  @else No Instruction Availavle @endif
                                </textarea>
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
@endforeach


@endsection
@section('script')
<script>


    $('#sitewide').on('change', function() {
                 if(this.value == 'no'){
                    $('.demo-select2').select2();
                    $('#hidden').toggle();
                }else{
                    $('#hidden').css('display','none');

                }

        });


    function makeDefault(id){
        $.get('{{ route('return.default') }}',{_token:'{{ csrf_token() }}', id:id}, function(data){
                           if(data==1){
                            showFrontendAlert('success', 'Default Done');
                           }else{
                            showFrontendAlert('error', 'Try Latter');
                           }
                            location.reload();
    });
    }





</script>

@endsection
