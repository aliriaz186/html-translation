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

                <div class="col-lg-9">
                    <div class="main-content">
                        <!-- Page title -->
                        <div class="page-title">
                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <h2 class="heading heading-6 text-capitalize strong-600 mb-0">
                                        {{__('My Address')}}
                                    </h2>
                                </div>
                                <div class="col-md-6">
                                    <div class="float-md-right">
                                        <ul class="breadcrumb">
                                            <li><a href="{{ route('home') }}">{{__('Home')}}</a></li>
                                            <li><a href="{{ route('dashboard') }}">{{__('Dashboard')}}</a></li>
                                            <li><a href="{{ route('my_addressees') }}">{{__('My Addresses')}}</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4 offset-md-4 cursor">
                                <a class="dashboard-widget text-center plus-widget mt-4 d-block"  data-toggle="modal" data-target="#addressModal">
                                    <i class="la la-plus"></i>
                                    <span class="d-block title heading-6 strong-400 c-base-1">{{ __('Add New Address') }}</span>
                                </a>
                            </div>
                        </div>

                        <div class="card no-border mt-4">
                            <div class="card-header py-2">
                                   <h6>Saved My Address</h6>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                @foreach($shippingAddress as $key=>$MyAddress)
                                    <div class="col-md-6">
                                            <div class="addresses">
                                                <p class="bb-1">Address {{$key+1}} @if($MyAddress->is_default)<span class="pull-right">Default </span> @endif </p>
                                                <p class="mb-0"> Name :<span>{{$MyAddress->name}}</span></p>
                                                <p class="mb-0"> Address 1:<span>{{$MyAddress->address}}</span></p>
                                                <p class="mb-0"> Address 2:<span>{{$MyAddress->address2}}</span></p>
                                                <p class="mb-0">City :<span>{{$MyAddress->city}}</span></p>
                                                <p class="mb-0">Postal Code:<span>{{$MyAddress->postal_code}}</span></p>
                                                <p class="mb-0">Country:<span>{{$MyAddress->country}}</span></p>
                                                <p class="mb-0">Phone :<span>{{$MyAddress->phone}}</span></p>

                                            <button class="btn  btn-sm btn-primary"  onclick="updateCustomerShippingtoDefault({{$MyAddress->id}})" >Make Default</button>
                                                    <button onclick="deleteCustomerShippingtoDefault({{$MyAddress->id}})" class="btn  btn-sm btn-danger">{{__('Delete')}}</button>
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


    <div class="modal fade" id="addressModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Manage Multiple Addresses</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="shipping_address">
                        <form method="post" action="{{route('customer.add_shipping_new')}}">
                                @csrf
                                <div class="form-box bg-white mt-4" style="border: 2px dotted lightgrey">
                                    <div class="form-box-title px-3 py-2">
                                        {{__('Ship To Address / Billing Address')}}
                                    </div>
                                    <div class="form-box-content p-3">
                                        <div class="row">
                                            <div class="col-lg-2-1">
                                                <label>{{__('Name')}}</label>
                                            </div>
                                            <div class="col-lg-9">
                                                <textarea class="form-control textarea-autogrow mb-3" placeholder="{{__('Your Name')}}" rows="1" name="name"></textarea>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-2-1">
                                                <label>{{__('Address 1')}}</label>
                                            </div>
                                            <div class="col-lg-9">
                                                <textarea class="form-control textarea-autogrow mb-3" placeholder="{{__('Your Address 1')}}" rows="1" name="address"></textarea>
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-lg-2-1">
                                                <label>{{__('Address 2')}}</label>
                                            </div>
                                            <div class="col-lg-9">
                                                <textarea class="form-control textarea-autogrow mb-3" placeholder="{{__('Your Address 2')}}" rows="1" name="address2"></textarea>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-2-1">
                                                <label>{{__('City')}}</label>
                                            </div>
                                            <div class="col-lg-9">
                                                <input type="text" class="form-control mb-3" placeholder="{{__('Your City')}}" name="city" value="">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-2-1">
                                                <label>{{__('Postal Code')}}</label>
                                            </div>
                                            <div class="col-lg-9">
                                                <input type="text" class="form-control mb-3" placeholder="{{__('Your Postal Code')}}" name="postal_code" value="">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-2-1">
                                                <label>{{__('Country')}}</label>
                                            </div>
                                            <div class="col-lg-9">
                                                <div class="mb-3">
                                                    <select class="form-control mb-3 selectpicker" data-placeholder="{{__('Select your country')}}" name="country">
                                                        @foreach (\App\Country::all() as $key => $country)
                                                            <option value="{{ $country->name}}">{{ $country->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-2-1">
                                                <label>{{__('Phone')}}</label>
                                            </div>
                                            <div class="col-lg-9">
                                                <input type="text" class="form-control mb-3" placeholder="{{__('Your Phone Number')}}" name="phone" value="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3 ml-2">
                                        <button type="submit" class="btn btn-primary btn-sm">Save changes</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                </div>
            </div>
        </div>
    </div>


    @foreach($shippingAddress as $key=>$address)
    <div class="modal fade" id="EditAddress{{$key}}"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Manage Multiple Addresses</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="shipping_address">
                        <form method="post" action="{{route('customer.shipping_update')}}">
                                @csrf
                                <input type="hidden" name="shippingId" value="{{$address->id}}">
                                <div class="form-box bg-white mt-4" style="border: 2px dotted lightgrey">
                                    <div class="form-box-title px-3 py-2">
                                        {{__('Ship To Address / Billing Address')}}
                                    </div>
                                    <div class="form-box-content p-3">
                                        <div class="row">
                                            <div class="col-lg-2-1">
                                                <label>{{__('Name')}}</label>
                                            </div>
                                            <div class="col-lg-9">
                                                <textarea class="form-control textarea-autogrow mb-3" placeholder="{{__('Your Name')}}" rows="1" name="name">{{ $address->name }}</textarea>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-2-1">
                                                <label>{{__('Address')}}</label>
                                            </div>
                                            <div class="col-lg-9">
                                                <textarea class="form-control textarea-autogrow mb-3" placeholder="{{__('Your Address 1')}}" rows="1" name="address">{{ $address->address }}</textarea>
                                            </div>
                                        </div>
                                         <div class="row">
                                            <div class="col-lg-2-1">
                                                <label>{{__('Address 2')}}</label>
                                            </div>
                                            <div class="col-lg-9">
                                                <textarea class="form-control textarea-autogrow mb-3" placeholder="{{__('Your Address 2')}}" rows="1" name="address2">{{ $address->address2 }}</textarea>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-2-1">
                                                <label>{{__('City')}}</label>
                                            </div>
                                            <div class="col-lg-9">
                                                <input type="text" class="form-control mb-3" placeholder="{{__('Your City')}}" name="city" value="{{ $address->city }}">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-2-1">
                                                <label>{{__('Postal Code')}}</label>
                                            </div>
                                            <div class="col-lg-9">
                                                <input type="text" class="form-control mb-3" placeholder="{{__('Your Postal Code')}}" name="postal_code" value="{{ $address->postal_code }}">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-2-1">
                                                <label>{{__('Country')}}</label>
                                            </div>
                                            <div class="col-lg-9">
                                                <div class="mb-3">
                                                    <select class="form-control mb-3 selectpicker" data-placeholder="{{__('Select your country')}}" name="country">
                                                        @foreach (\App\Country::all() as $key => $country)
                                                            <option value="{{ $country->name}}" <?php if($address->country == $country->code) echo "selected";?> >{{ $country->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-2-1">
                                                <label>{{__('Phone')}}</label>
                                            </div>
                                            <div class="col-lg-9">
                                                <input type="text" class="form-control mb-3" placeholder="{{__('Your Phone Number')}}" name="phone" value="{{ $address->phone }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3 ml-2">
                                        <button type="submit" class="btn btn-primary btn-sm">Save changes</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</section>




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



function updateCustomerShippingtoDefault(id) {
    $.post('{{ route('customer.shipping_default') }}',{_token:'{{ @csrf_token() }}', shippingId:id}, function(data){
        window.location.reload();
    });
}

function deleteCustomerShippingtoDefault(id) {
    $.post('{{ route('customer.shipping_delete') }}',{_token:'{{ @csrf_token() }}', shippingId:id}, function(data){
        console.log(data);
        if(data === false || data === 'false'){
            alert('Default Address cannot be deleted')
        }
        setTimeout(function () {
            window.location.reload();
        },1000);
    });
}
</script>



@endsection
