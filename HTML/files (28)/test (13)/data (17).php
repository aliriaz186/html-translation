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
                                <div class="col-md-6 col-12">
                                    <h2 class="heading heading-6 text-capitalize strong-600 mb-0">
                                        {{__('Manage Profile')}}
                                    </h2>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="float-md-right">
                                        <ul class="breadcrumb">
                                            <li><a href="{{ route('home') }}">{{__('Home')}}</a></li>
                                            <li><a href="{{ route('dashboard') }}">{{__('Dashboard')}}</a></li>
                                            <li class="active"><a href="{{ route('profile') }}">{{__('Account Settings')}}</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <form class="" action="{{ route('seller.profile.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                        <br>
                        <div class="footer-top-box text-center bg-white">
                            <a href="#">
                                <label class="switch" data-toggle="tooltip" title="to delete your account, click on the information icon below">
                                    <input type="checkbox" onchange="updateDisabledBySeller( '{{Auth::user()->id}}')" {{Auth::user()->disabled_by_user == 1?'checked':''}} />
                                    <span class="slider round"></span>
                                </label>

                                <h4 class="heading-5">{{__('Deactivate or Delete Account')}}</h4>
                                <i class="fa fa-info-circle" data-toggle="modal" data-target="#info"></i>
                            </a>
                        </div>

                            <div class="form-box bg-white mt-4">
                                <div class="form-box-title px-3 py-2">
                                    {{__('Basic info')}}
                                    <p class="font-weight-bold pull-right">Registered as a seller on  <span >  {{Auth::user()->seller->created_at->format('d-m-Y @ h:i:s')}} </span> </p>                                </div>
 				  <div class="form-box-content p-3">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label>{{__('Username')}}</label>
                                        </div>
                                        <div class="col-md-10 form-group">
                                            <div class="input-group input-group--style-1">
                                                <input id="username" type="text" class="form-control" value="{{ Auth::user()->username }}" placeholder="{{ __('Your Username') }}" name="username">
                                                <span class="input-group-addon" style="border:1px solid #e8e7e7;">
                                                    <i id="none" class="text-md la la-user"></i>
                                                    <i id="tick"  style="display:none" class="text-md text-success">&#10003;</i>
                                                    <i id="cross" style="display:none" class="text-md text-danger">x</i>
                                                </span>
                                            </div>
                                         </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label>{{__('Your Name')}}</label>
                                        </div>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control mb-3" placeholder="{{__('Your Name')}}" name="name" value="{{ Auth::user()->name }}">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label>{{__('Your Email')}}</label>
                                        </div>
                                        <div class="col-md-8">
                                            <input type="email" class="form-control mb-3" placeholder="{{__('Your Email')}}" value="{{ Auth::user()->email }}" disabled>
                                        </div>
                                      <div class="col-md-2">
                                     		<a id="change_email" class="btn btn-primary text-white"> {{__('Change Email')}} </a>
                                     </div>
                                    </div>
                                     <div class="d-none mb-4" id="new_email" style="width: 82%;margin-left: 17%;">
                                       
                                            <div class="card">
                                                <div class="card-header">
                                                    <h5 class="mb-0 h6">{{ __('New Email Address')}}</h5>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-md-2">
                                                            <label>{{ __('Your Email') }}</label>
                                                        </div>
                                                        <div class="col-md-10">
                                                            <div class="input-group mb-3">
                                                                <input type="email" class="form-control" placeholder="{{ __('Your Email')}}" name="email" value="{{ Auth::user()->email }}" />
                                                                <div class="input-group-append">
                                                                <button type="button" class="btn btn-outline-secondary new-email-verification" >
                                                                    <span class="d-none loading">
                                                                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>{{ __('Sending Email...') }}
                                                                    </span>
                                                                    <span class="default">{{ __('Verify') }}</span>
                                                                </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label>{{__('Your Number')}}</label>
                                        </div>
                                        <div class="col-md-8">
                                            <input type="tel" class="form-control mb-3" placeholder="{{__('Your Personal Number')}}" id="pNo" name="personal_number" value="{{ Auth::user()->personal_number }}"  style="width: 360%">
                                            <input type="hidden" value="" id="countryCode" name="countryCode">
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label>{{__('Photo')}}</label>
                                        </div>
                                        <div class="col-md-10">
                                            <input type="file" name="photo" id="file-3" class="custom-input-file custom-input-file--4" data-multiple-caption="{count} files selected" accept="image/*" />
                                            <label for="file-3" class="mw-100 mb-3" style="height: 6vh">
                                                <span></span>
                                                <strong>
                                                    <i class="fa fa-upload"></i>
                                                    {{__('Choose image')}}
                                                </strong>
                                            </label>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label>{{__('Your Password')}}</label>
                                        </div>
                                        <div class="col-md-10">
                                            <input type="password" class="form-control mb-3" placeholder="{{__('New Password')}}" name="new_password">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label>{{__('Confirm Password')}}</label>
                                        </div>
                                        <div class="col-md-10">
                                            <input type="password" class="form-control mb-3" placeholder="{{__('Confirm Password')}}" name="confirm_password">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-box bg-white mt-4">
                                <div class="form-box-title px-3 py-2">
                                    {{__('My Address')}}
                                </div>
                                <div class="form-box-content p-3">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label>{{__('Name')}}</label>
                                        </div>
                                        <div class="col-md-10">
                                            <textarea class="form-control textarea-autogrow mb-3" placeholder="{{__('Your Name')}}" rows="1" name="name"></textarea>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label>{{__('Address')}}</label>
                                        </div>
                                        <div class="col-md-10">
                                            <textarea class="form-control textarea-autogrow mb-3" placeholder="{{__('Your Address')}}" rows="1" name="address">{{ Auth::user()->address }}</textarea>
                                        </div>
                                    </div>
                                      <div class="row">
                                        <div class="col-md-2">
                                            <label>{{__('Address 2')}}</label>
                                        </div>
                                        <div class="col-md-10">
                                            <textarea class="form-control textarea-autogrow mb-3" placeholder="{{__('Your Address 2')}}" rows="1" name="address2">{{ Auth::user()->address2 }}</textarea>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label>{{__('City')}}</label>
                                        </div>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control mb-3" placeholder="{{__('Your City')}}" name="city" value="{{ Auth::user()->city }}">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label>{{__('Postal code')}}</label>
                                        </div>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control mb-3" placeholder="{{__('Your Postal Code')}}" name="postal_code" value="{{ Auth::user()->postal_code }}">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label>{{__('Country')}}</label>
                                        </div>
                                        <div class="col-md-10">
                                            <div class="mb-3">
                                                <select class="form-control mb-3 selectpicker" data-placeholder="{{__('Select your country')}}" name="country">
                                                    @foreach (\App\Country::all() as $key => $country)
                                                        <option value="{{ $country->code }}" <?php if(Auth::user()->country == $country->code) echo "selected";?> >{{ $country->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label>{{__('Phone')}}</label>
                                        </div>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control mb-3" placeholder="{{__('Your Phone Number')}}" name="phone" value="{{ Auth::user()->phone }}">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-box bg-white mt-4">
                                <div class="form-box-title px-3 py-2">
                                    {{__('Payment Setting')}}
                                </div>
                                <div class="form-box-content p-3">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label>{{__('Cash Payment')}}</label>
                                        </div>
                                        <div class="col-md-10">
                                            <label class="switch mb-3">
                                                <input value="1" name="cash_on_delivery_status" type="checkbox" @if (Auth::user()->seller->cash_on_delivery_status == 1) checked @endif>
                                                <span class="slider round"></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label>{{__('Bank Payment')}}</label>
                                        </div>
                                        <div class="col-md-10">
                                            <label class="switch mb-3">
                                                <input value="1" name="bank_payment_status" type="checkbox" @if (Auth::user()->seller->bank_payment_status == 1) checked @endif>
                                                <span class="slider round"></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label>{{__('Bank Name')}}</label>
                                        </div>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control mb-3" placeholder="{{__('Bank Name')}}" value="{{ Auth::user()->seller->bank_name }}" name="bank_name">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label>{{__('Bank Account Name')}}</label>
                                        </div>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control mb-3" placeholder="{{__('Bank Account Name')}}" value="{{ Auth::user()->seller->bank_acc_name }}" name="bank_acc_name">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label>{{__('Bank Account Number')}}</label>
                                        </div>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control mb-3" placeholder="{{__('Bank Account Number')}}" value="{{ Auth::user()->seller->bank_acc_no }}" name="bank_acc_no">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label>{{__('Bank Routing Number')}}</label>
                                        </div>
                                        <div class="col-md-10">
                                            <input type="number" class="form-control mb-3" placeholder="{{__('Bank Routing Number')}}" value="{{ Auth::user()->seller->bank_routing_no }}" name="bank_routing_no">
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="text-right mt-4">
                                <a class="btn btn-styled btn-base-1 text-right" href="{{route('my_addressees')}}">{{__('Manage Shipping Addresses')}}</a>
                                <button type="submit" class="btn btn-styled btn-base-1">{{__('Update Profile')}}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="addressModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Manage Multiple Addresses</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @foreach($shippingAddress as $address)
                        <div id="shipping_address">
                            <form method="post" action="{{route('seller.shipping_update')}}">
                                    @csrf
                                    <input type="hidden" name="shippingId" value="{{$address->id}}">
                                    <div class="form-box bg-white mt-4" style="border: 2px dotted lightgrey">
                                        <div class="form-box-title px-3 py-2">
                                            {{__('Ship To Address / Billing Address')}}
                                        </div>
                                        <div class="form-box-content p-3">
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <label>{{__('Name')}}</label>
                                                </div>
                                                <div class="col-md-10">
                                                    <textarea class="form-control textarea-autogrow mb-3" placeholder="{{__('Your Name')}}" rows="1" name="name">{{ $address->name }}</textarea>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <label>{{__('Address')}}</label>
                                                </div>
                                                <div class="col-md-10">
                                                    <textarea class="form-control textarea-autogrow mb-3" placeholder="{{__('Your Address')}}" rows="1" name="address">{{ $address->address }}</textarea>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <label>{{__('City')}}</label>
                                                </div>
                                                <div class="col-md-10">
                                                    <input type="text" class="form-control mb-3" placeholder="{{__('Your City')}}" name="city" value="{{ $address->city }}">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <label>{{__('Postal Code')}}</label>
                                                </div>
                                                <div class="col-md-10">
                                                    <input type="text" class="form-control mb-3" placeholder="{{__('Your Postal Code')}}" name="postal_code" value="{{ $address->postal_code }}">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <label>{{__('Country')}}</label>
                                                </div>
                                                <div class="col-md-10">
                                                    <div class="mb-3">
                                                        <select class="form-control mb-3 selectpicker" data-placeholder="{{__('Select your country')}}" name="country">
                                                            @foreach (\App\Country::all() as $key => $country)
                                                                <option value="{{ $country->code }}" <?php if($address->country == $country->code) echo "selected";?> >{{ $country->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <label>{{__('Phone')}}</label>
                                                </div>
                                                <div class="col-md-10">
                                                    <input type="text" class="form-control mb-3" placeholder="{{__('Your Phone Number')}}" name="phone" value="{{ $address->phone }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3 ml-2">
                                            <button type="submit" class="btn btn-primary btn-sm">Save changes</button>
                                            <button type="button" class="btn btn-secondary btn-sm" onclick="updateCustomerShippingtoDefault({{$address->id}})">Set as Default</button>
                                            <button type="button" class="btn btn-danger btn-sm" onclick="deleteCustomerShippingtoDefault({{$address->id}})">Delete</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            @endforeach
                        <div class="mt-2 mb-2" style="text-align: center">
                                <button type="submit" class="btn btn-primary btn-sm" onclick="add_new_address()">Add A New Address</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <div class="modal" id="info" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-zoom product-modal" id="modal-size" role="document">
            <div class="modal-content position-relative">
                <div class="modal-header">
                    <p><strong>Please note:</strong> If you deactivate your account, you wouldn't be able to access your account any further. You would need to contact us to reactivate your account, as well as identifications may be required.</br>
                    <br>If you need to delete your account, please contact support by creating a ticket. Once your account is deleted, all the data we hold for you will also be removed and deleted.
                    <div class="text-center plus-widget mt-4 c-pointer" data-toggle="modal" data-target="#ticket_modal">
                                <i class="la la-plus"></i>
                                <span class="d-block title heading-6 strong-400 c-base-1">{{ __('Create a Ticket') }}</span>
                           </div>
                           </p>
                    </div>
                </div>
             </div>
        </div>

        <div class="modal fade" id="ticket_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-zoom product-modal" id="modal-size" role="document">
        <div class="modal-content position-relative">
            <div class="modal-header">
                <h5 class="modal-title strong-600 heading-5">{{__('Account Deletion Request')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body px-3 pt-3">
                <form class="" action="{{ route('support_ticket.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>Subject <span class="text-danger">*</span></label>
                        <input type="text" class="form-control mb-3" name="subject" placeholder="Type - Delete My Account" required>
                    </div>
                    <div class="form-group">
                        <label>Provide a detailed description <span class="text-danger">*</span></label>
                        <textarea class="form-control editor" name="details" placeholder="Additional infomation" data-buttons="bold,underline,italic,|,ul,ol,|,paragraph,|,undo,redo"></textarea>
                    </div>
                    <div class="text-right mt-4">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('Cancel')}}</button>
                        <button type="submit" class="btn btn-base-1">{{__('Send Request')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<script>

    function add_new_address(){
            script = `<form method="post" action="{{route('customer.shipping_update')}}">
                                @csrf
                                <input type="hidden" name="shippingId" value="{{$address->id}}">
                                <div class="form-box bg-white mt-4" style="border: 2px dotted lightgrey">
                                    <div class="form-box-title px-3 py-2">
                                        {{__('Ship To Address / Billing Address')}}
                                    </div>
                                    <div class="form-box-content p-3">
                                        <div class="row">
                                                <div class="col-md-2">
                                                    <label>{{__('Name')}}</label>
                                                </div>
                                                <div class="col-md-10">
                                                    <textarea class="form-control textarea-autogrow mb-3" placeholder="{{__('Your Name')}}" rows="1" name="name"></textarea>
                                                </div>
                                            </div>
                                        <div class="row">
                                            <div class="col-md-2">
                                                <label>{{__('Address')}}</label>
                                            </div>
                                            <div class="col-md-10">
                                                <textarea class="form-control textarea-autogrow mb-3" placeholder="{{__('Your Address')}}" rows="1" name="address"></textarea>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-2">
                                                <label>{{__('City')}}</label>
                                            </div>
                                            <div class="col-md-10">
                                                <input type="text" class="form-control mb-3" placeholder="{{__('Your City')}}" name="city" value="">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-2">
                                                <label>{{__('Postal Code')}}</label>
                                            </div>
                                            <div class="col-md-10">
                                                <input type="text" class="form-control mb-3" placeholder="{{__('Your Postal Code')}}" name="postal_code" value="">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-2">
                                                <label>{{__('Country')}}</label>
                                            </div>
                                            <div class="col-md-10">
                                                <div class="mb-3">
                                                    <select class="form-control mb-3 selectpicker" data-placeholder="{{__('Select your country')}}" name="country">
                                                        @foreach (\App\Country::all() as $key => $country)
                                                            <option value="{{ $country->code }}" <?php if($address->country == $country->code) echo "selected";?> >{{ $country->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-2">
                                                <label>{{__('Phone')}}</label>
                                            </div>
                                            <div class="col-md-10">
                                                <input type="text" class="form-control mb-3" placeholder="{{__('Your Phone Number')}}" name="phone" value="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3 ml-2">
                                        <button type="submit" class="btn btn-primary btn-sm">Save changes</button>
                                        <button type="button" class="btn btn-secondary btn-sm" onclick="updateCustomerShippingtoDefault({{$address->id}})">Set as Default</button>
                                        <button type="button" class="btn btn-danger btn-sm" onclick="deleteCustomerShippingtoDefault({{$address->id}})">Delete</button>
                                    </div>
                                </div>
                            </form>`;

                        $('#shipping_address').append(script);
                        $.post('{{ route('customer.shipping_new') }}',{_token:'{{ @csrf_token() }}'}, function(data){
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

        <script src="{{asset('js/intlTelInput.js')}}"></script>
        <script>
            var input = document.querySelector("#pNo");
          var data =   window.intlTelInput(input, {
            customPlaceholder: function(selectedCountryPlaceholder, selectedCountryData) {
                        return "e.g. " + selectedCountryPlaceholder;
                    },
            })
            ;

        $("#pNo").on("countrychange", function(e){
            dialCode = data.getSelectedCountryData()["dialCode"];
                $('#countryCode').val(dialCode)
        });

      $("#change_email").click(function(el){
	  $('#new_email').removeClass('d-none');
	});


        function updateDisabledBySeller(user_id){
    	    $.get('{{ route('sellers.disabled_by_user_update') }}',{_token:'{{ @csrf_token() }}', user_id:user_id}, function(data){
               window.location.href = '{{route('logout')}}';
           });
    }
    
        $('.new-email-verification').on('click', function() {
            $(this).find('.loading').removeClass('d-none');
            $(this).find('.default').addClass('d-none');
            var email = $("input[name=email]").val();
		console.log(email );
            $.post('{{ route('user.new.verify') }}', {_token:'{{ csrf_token() }}', email: email}, function(data){
                data = JSON.parse(data);
                console.log(data);
                $('.default').removeClass('d-none');
                $('.loading').addClass('d-none');
                if(data.status == 2)
                      showFrontendAlert('warning', data.message);
                else if(data.status == 1)
                      showFrontendAlert('success', data.message);
                else
                      showFrontendAlert('danger', data.message);
            });
        });
        
              
 $('#cross').css('display','none');
       	$('#tick').css('display','none');
	$( "#username" ).keyup(function() {
	     $.get('{{ route('username.check') }}', {_token: '{{ csrf_token()}}', username:this.value}, function(data){
	  
                       if(data==0){
                       	$('#cross').css('display','none');
                       	$('#tick').css('display','block');           	
       			$('#none').css('display','none');
       			$( "#update_btn" ).prop( "disabled", false);
                       }
                       else{
                       $( "#update_btn" ).prop( "disabled", true );
                       	$('#cross').css('display','block');
                       	$('#tick').css('display','none');
       			$('#none').css('display','none');
                       }
                    });
	});
    </script>
@endsection
