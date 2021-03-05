@extends('frontend.layouts.app')

@section('content')

    <div id="page-content">
        <section class="slice-xs sct-color-2 border-bottom">
            <div class="container container-sm">
                <div class="row cols-delimited justify-content-center">
                    <div class="col">
                        <div class="icon-block icon-block--style-1-v5 text-center ">
                            <div class="block-icon c-gray-light mb-0">
                                <i class="la la-shopping-cart"></i>
                            </div>
                            <div class="block-content d-none d-md-block">
                                <h3 class="heading heading-sm strong-300 c-gray-light text-capitalize">1. {{__('My Cart')}}</h3>
                            </div>
                        </div>
                    </div>

                    <div class="col">
                        <div class="icon-block icon-block--style-1-v5 text-center active">
                            <div class="block-icon mb-0">
                                <i class="la la-map-o"></i>
                            </div>
                            <div class="block-content d-none d-md-block">
                                <h3 class="heading heading-sm strong-300 c-gray-light text-capitalize">2. {{__('Shipping info')}}</h3>
                            </div>
                        </div>
                    </div>

                    <div class="col">
                        <div class="icon-block icon-block--style-1-v5 text-center">
                            <div class="block-icon mb-0 c-gray-light">
                                <i class="la la-truck"></i>
                            </div>
                            <div class="block-content d-none d-md-block">
                                <h3 class="heading heading-sm strong-300 c-gray-light text-capitalize">3. {{__('Delivery info')}}</h3>
                            </div>
                        </div>
                    </div>

                    <div class="col">
                        <div class="icon-block icon-block--style-1-v5 text-center">
                            <div class="block-icon c-gray-light mb-0">
                                <i class="la la-credit-card"></i>
                            </div>
                            <div class="block-content d-none d-md-block">
                                <h3 class="heading heading-sm strong-300 c-gray-light text-capitalize">4. {{__('Payment')}}</h3>
                            </div>
                        </div>
                    </div>

                    <div class="col">
                        <div class="icon-block icon-block--style-1-v5 text-center">
                            <div class="block-icon c-gray-light mb-0">
                                <i class="la la-check-circle"></i>
                            </div>
                            <div class="block-content d-none d-md-block">
                                <h3 class="heading heading-sm strong-300 c-gray-light text-capitalize">5. {{__('Confirmation')}}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="py-4 gry-bg">
            <div class="container-fluid p-4">
                <div class="row cols-xs-space cols-sm-space cols-md-space">
                    <div class="col-lg-9">
                        <form class="form-default" data-toggle="validator" action="{{ route('checkout.store_shipping_infostore') }}" role="form" method="POST">
                            @csrf
                            <div class="card">
                                @if(Auth::check())
                                    @php
                                        $user = Auth::user();
                                    @endphp
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="control-label">{{__('Address List')}}</label>
                                                            <select name="address" class="form-control" onchange="getShippinInfo(this)">
                                                                <option  value="{{$user->address_id}}">{{$user->address_name}} (Default)</option>
                                                                @foreach(App\ShippingAddress::where('user_id', Auth::user()->id)->whereNotNull('address')->get() as $address)
                                                                        <option  value="{{$address->id}}">{{$address->name}}</option>
                                                                @endforeach
                                                                <option value="add_a_new_adderss_shipping_info">Add a New Address</option>
                                                               
                                                            </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="control-label">{{__('Name')}}</label>
                                                    <input type="text" class="form-control" name="name" id="name" value="{{ $user->name }}" required>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="control-label">{{__('Email')}}</label>
                                                    <input type="email" class="form-control" readonly id="email" name="email" value="{{ $user->email }}" required>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="control-label">{{__('Address 1')}}</label>
                                                    <input type="text" class="form-control" id="address" name="address" value="{{ $user->address }}" required>
                                                </div>
                                            </div>

                                        </div>
                                           <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="control-label">{{__('Address 2')}}</label>
                                                    <input type="text" class="form-control" id="address2" name="address2" value="{{ $user->address2 }}" required>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group has-feedback">
                                                    <label class="control-label">{{__('City')}}</label>
                                                    <input type="text" class="form-control" id="city" value="{{ $user->city }}" name="city" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group has-feedback">
                                                    <label class="control-label">{{__('Postal code')}}</label>
                                                    <input type="text"  class="form-control" id="postal_code" value="{{ $user->postal_code }}" name="postal_code" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">{{__('Select your country')}}</label>
                                                    <select class="form-control selectpicker" id="country" data-live-search="true" name="country">
                                                        @foreach (\App\Country::all() as $key => $country)
                                                            <option  value="{{ str_replace(' ','_',$country->name) }}" @if ($country->code == $user->country) selected @endif>{{ $country->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group has-feedback">
                                                    <label class="control-label">{{__('Phone')}}</label>
                                                    <input type="text" min="0" class="form-control" id="phone" value="{{ $user->phone }}" name="phone" required>
                                                </div>
                                            </div>
                                        </div>

                                        <input type="hidden" name="checkout_type" value="logged">
                                    </div>
                                @else
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="control-label">{{__('Name')}}</label>
                                                    <input type="text" class="form-control" name="name"  id="name" placeholder="{{__('Name')}}" required>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="control-label">{{__('Email')}}</label>
                                                    <input type="text" class="form-control"  readonly name="email" id="email" placeholder="{{__('Email')}}" required>
                                                </div>
                                            </div>
                                        </div>

                                           <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="control-label">{{__('Address 1')}}</label>
                                                    <input type="text" class="form-control" id="address" name="address" value="{{ $user->address }}" required>
                                                </div>
                                            </div>

                                        </div>
                                           <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="control-label">{{__('Address 2')}}</label>
                                                    <input type="text" class="form-control" id="address2" name="address2" value="{{ $user->address2 }}" required>
                                                </div>
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
                                                <div class="form-group has-feedback">
                                                    <label class="control-label">{{__('Postal code')}}</label>
                                                    <input type="text" class="form-control" placeholder="{{__('Postal code')}}" id="postal_code" name="postal_code" required>
                                                </div>
                                            </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">{{__('Select your country')}}</label>
                                                    <select class="form-control selectpicker " data-live-search="true" id="country" name="country">
                                                        @foreach (\App\Country::all() as $key => $country)
                                                            <option value="{{ str_replace(' ','_',$country->name) }}">{{ $country->name }}</option>
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

                                        <input type="hidden" name="checkout_type" value="guest">
                                    </div>
                                @endif
                            </div>

                            <div class="row align-items-center pt-4">
                                <div class="col-md-6">
                                    <a href="{{ route('home') }}" class="link link--style-3">
                                        <i class="ion-android-arrow-back"></i>
                                        {{__('Return to shop')}}
                                    </a>
                                </div>
                                <div class="col-md-6 text-right">
                                    <button type="submit" class="btn btn-styled btn-base-1">{{__('Continue to Delivery Info')}}</a>
                                </div>
                            </div>
                            {{-- <div class="row align-items-center pt-4">
                                <div class="col-6">
                                    <a href="{{ route('home') }}" class="link link--style-3">
                                        <i class="ion-android-arrow-back"></i>
                                        {{__('Return to shop')}}
                                    </a>
                                </div>
                                <div class="col-6 text-right">
                                    <button type="submit" class="btn btn-styled btn-base-1">{{__('Continue to Delivery Info')}}</a>
                                </div>
                            </div> --}}
                        </form>
                    </div>

                    <div class="col-lg-3 ml-lg-auto">
                        @include('frontend.partials.cart_summary')
                    </div>
                </div>
            </div>
        </section>
    </div>



    <div class="modal fade" id="addressModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Address</h5>
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
                                                            <option value="{{ $country->code }}">{{ $country->name }}</option>
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


@endsection

@section('script')
        <script>
            function getShippinInfo(event){
                id = event.value;
                if(id == 'add_a_new_adderss_shipping_info'){
                	$('#addressModal').modal('show')
                }
                setValue('name','');
                setValue('email','');
                setValue('address','');
                setValue('city','');
                setValue('postal_code','');
                setValue('country','');
                setValue('phone','');
                $.get('{{route('checkout.shipping_info_select') }}',{_token:'{{csrf_token()}}' , id:id},function(data){
                        setValue('name',data.name);
                        setValue('email','{{Auth::user()->email}}');
                        setValue('address',data.address);
                        setValue('address2',data.address2);
                        setValue('city',data.city);
                        setValue('postal_code',data.postal_code);
                        setValue('country',data.country);
                        setValue('phone',data.phone);
                        
                })
            }


            function setValue(id,value){
                if(id=='country'){
                    var option = new Option(value, value, true, true);
                  $("#country").append(option).trigger('change');
                }
                $('#'+id).val(value);
        }
        </script>


@endsection
