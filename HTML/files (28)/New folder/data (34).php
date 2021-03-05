@extends('frontend.layouts.app')

@section('content')
    <section class="gry-bg py-4 profile">
        <div class="container">
            <div class="row cols-xs-space cols-sm-space cols-md-space">
                <div class="col-lg-9 mx-auto">
                    <div class="main-content">
                        <!-- Page title -->
                        <div class="page-title">
                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <h2 class="heading heading-6 text-capitalize strong-600 mb-0">
                                        {{__('Business Registration')}}
                                    </h2>
                                </div>
                                <div class="col-md-6">
                                    <div class="float-md-right">
                                        <ul class="breadcrumb">
                                            <li><a href="{{ route('home') }}">{{__('Home')}}</a></li>
                                            <li><a href="{{ route('dashboard') }}">{{__('Dashboard')}}</a></li>
                                            <li class="active"><a href="{{ route('shops.create') }}">{{__('Create Your Store')}}</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <section class="slice-sm footer-top-bar bg-white">
                                <div class="container sct-inner">
                                    <div class="row no-gutters">
                                        <div class="col-lg-3 col-md-6">
                                            <div class="footer-top-box text-center">
                                                <a href="{{ route('sellerpolicy') }}">
                                                    <i class="la la-file-text"></i>
                                                    <h4 class="heading-5">{{__('Seller Policy')}}</h4>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-6">
                                            <div class="footer-top-box text-center">
                                                <a href="{{ route('returnpolicy') }}">
                                                    <i class="la la-exchange"></i>
                                                    <h4 class="heading-5">{{__('Return Policy')}}</h4>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-6">
                                            <div class="footer-top-box text-center">
                                                <a href="{{ route('supportpolicy') }}">
                                                    <i class="la la-support"></i>
                                                    <h4 class="heading-5">{{__('Support Policy')}}</h4>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-6">
                                            <div class="footer-top-box text-center">
                                                <a href="{{ route('terms') }}">
                                                    <i class="la la-dashboard"></i>
                                                    <h4 class="heading-5">{{__('Terms & Conditions')}}</h4>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                            <section class="slice-sm footer-top-bar bg-white">
                                <div class="container sct-inner">
                                    <div class="row no-gutters">
                                        <div class="col-lg-3 col-md-6">
                                            <div class="footer-top-box text-center">
                                                <a href="{{ route('sellerpolicy') }}">
                                                    <i class="la la-user-secret"></i>
                                                    <h4 class="heading-5">{{__('Privacy Policy')}}</h4>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-6">
                                            <div class="footer-top-box text-center">
                                                <a href="{{ route('returnpolicy') }}">
                                                    <i class="la la-history"></i>
                                                    <h4 class="heading-5">{{__('Refund Policy')}}</h4>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-6">
                                            <div class="footer-top-box text-center">
                                                <a href="{{ route('supportpolicy') }}">
                                                    <i class="la la-file-o"></i>
                                                    <h4 class="heading-5">{{__('Selling Policy')}}</h4>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-6">
                                            <div class="footer-top-box text-center">
                                                <a href="{{ route('terms') }}">
                                                    <i class="la la-list"></i>
                                                    <h4 class="heading-5">{{__('Listing Policy')}}</h4>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                            @csrf
                            @if (!Auth::check())
                        <form class="" action="{{ route('shops.create.user') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-box bg-white mt-4">
                                    <div class="form-box-title px-3 py-2">
                                        {{__('Registration Details')}}
                                    </div>
                                    <div class="form-box-content p-3">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <!-- <label>{{ __('Username') }}</label> -->
                                                    <div class="input-group input-group--style-1">
                                                        <input type="text" id="username" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" value="{{ old('username') }}" placeholder="{{ __('Username') }}"  name="username">
                                                          <span class="input-group-addon">
	                                                    <i id="none" class="text-md la la-user"></i>
	                                                    <i id="tick"  style="display:none" class="text-md text-success">&#10003;</i>
	                                                    <i id="cross" style="display:none" class="text-md text-danger">x</i>
	                                                </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <!-- <label>{{ __('Name') }}</label> -->
                                                    <div class="input-group input-group--style-1">
                                                        <input type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{ old('name') }}" placeholder="{{ __('Name') }}"  name="name">
                                                        <span class="input-group-addon">
                                                            <i class="text-md la la-user"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <!-- <label>{{ __('Email') }}</label> -->
                                                    <div class="input-group input-group--style-1">
                                                        <input type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email') }}" placeholder="{{ __('Email') }}" name="email">
                                                        <span class="input-group-addon">
                                                            <i class="text-md la la-envelope"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <!-- <label>{{ __('Password') }}</label> -->
                                                    <div class="input-group input-group--style-1">
                                                        <input type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="{{ __('Password') }}" name="password">
                                                        <span class="input-group-addon">
                                                            <i class="text-md la la-lock"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <!-- <label>{{ __('Confirm Password') }}</label> -->
                                                    <div class="input-group input-group--style-1">
                                                        <input type="password" class="form-control" placeholder="{{ __('Confirm Password') }}" name="password_confirmation">
                                                        <span class="input-group-addon">
                                                            <i class="text-md la la-lock"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                    <!-- <label>{{ __('Phone Number') }}</label> -->
                                                    <div class="input-group input-group--style-1">
                                                        <input type="text" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" value="{{ old('phone') }}" placeholder="{{ __('Phone Number') }}"  name="phone">
                                                        <span class="input-group-addon">
                                                            <i class="text-md la la-phone"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <div class="checkbox pad-btm text-left">
                                            <input class="magic-checkbox" type="checkbox" name="checkbox_example_1" id="checkboxExample_1a" required>
                                            <label for="checkboxExample_1a" class="text-sm">{{__('By signing up you agree to our terms and conditions.')}}</label>
                                    </div>
                                </div>
                             </div>
                            <div class="text-right mt-4">
                                <button type="submit" class="btn btn-styled btn-base-1">{{__('Sign up')}}</button>
                            </div>
                        </form>
                            @else
                            <form class="" action="{{ route('shops.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                            <div class="form-box bg-white mt-4">
                                <div class="form-box-title px-3 py-2">
                                    {{__('Business Info')}}
                                </div>
                                <div class="form-box-content p-3">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label>{{__('Package')}} <span class="required-star">*</span></label>
                                        </div>
                                        <div class="col-md-10">
                                            @php $PS = App\product_subscription::where('user_id',Auth::user()->id)->first(); @endphp
                                                @if($PS ==null)
                                                <input type="button" required type="button" class="btn btn-styled btn-base-1" data-toggle="modal" data-target="#subscription" value="Choose a Package">
                                               @else
                                            <p> <strong class="text-uppercase">{{$PS->type}}</strong></p>
                                               @endif
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label>{{__('Store Name')}} <span class="required-star">*</span></label>
                                        </div>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control mb-3" id="searchName"  value="{{ old('name') }}" placeholder="{{__('Shop Name')}}" name="name" required>
                                        </div>
                                    <div class="spinner-border spinner_own {{$PS!=null?'package':'no_package'}}" id="spinner"></div>
                                            <div class="spinner_own {{$PS!=null?'package':'no_package'}}" id="tick">X</div>
                                            <div class="spinner_own {{$PS!=null?'package':'no_package'}}" id="cross">&check;</div>
                                    </div>
                                    <div class="row logo">
                                        <div class="col-md-2">
                                            <label>{{__('Logo')}}</label>
                                        </div>
                                        <div class="col-md-10">
                                            <input type="file" name="logo" value="{{ old('logo') }}" id="file-2" class="custom-input-file custom-input-file--4" data-multiple-caption="{count} files selected" accept="image/*" />
                                            <label for="file-2" class="mw-100 mb-3">
                                                <span></span>
                                                <strong>
                                                    <i class="fa fa-upload"></i>
                                                    {{__('Choose image')}}
                                                </strong>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label>{{__('Address')}} <span class="required-star">*</span></label>
                                        </div>
                                        <div class="col-md-10">
                                            <input  value="{{ old('address') }}" type="text" class="form-control mb-3" placeholder="{{__('Address')}}" name="address" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label>{{__('Phone Number')}} <span class="required-star">*</span></label>
                                        </div>
                                        <div class="col-md-10">
                                            <input  value="{{ old('phone') }}" type="text" class="form-control mb-3" placeholder="{{__('Phone Number')}}" name="phone" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label>{{__('Tax')}} <span class="required-star">*</span></label>
                                        </div>
                                        <div class="col-md-10">
                                            <select name="tax" class="form-control" onchange="selectTax(this)">
                                                <option value="default" selected>Please Select Type</option>
                                                <option value="vat">Vat</option>
                                                <option value="no_vat">No Vat</option>
                                            </select>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row" id="tax_id">
                                        <div class="col-md-2">
                                            <label>{{__('Tax Id')}} <span class="required-star">*</span></label>
                                        </div>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control mb-3" placeholder="{{__('Id')}}" name="tax_id" value="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                            <div class="text-right mt-4">
                              @auth()
                                @if(App\product_subscription::where('user_id',Auth::user()->id)->first() != null)
                                    <button type="submit" class="btn btn-styled btn-base-1">{{__('Save')}}</button>
                                @endif
                                @endauth
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="modal fade" id="subscription" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-content" style="width:130%">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Subscription</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                        <div class="row">
                                <!-- Free Tier -->
                                @if(count(App\subscription_products_prices::all())>0)
                                    @foreach (App\subscription_products_prices::all() as $table)
                                        <div class="col-lg-4">
                                                   <form method="POST" id="free_table" action="{{route('shop-subscription')}}">
                                                    @csrf
                                                    <div class="card mb-5 mb-lg-0 bg-primary text-white">
                                                    <div class="card-body">
                                                        <h5 class="card-title text-uppercase text-center text-white">{{$table->type}}</h5>
                                                        <h6 class="card-price text-center">${{$table->prices}}<span class="period">/month</span></h6>
                                                        <hr>
                                                        <ul class="fa-ul">
                                                            <li><span class="fa-li"><i class="la la-check-circle-o"></i></span><strong>{{$table->product}} products</strong></li>
                                                            <li><span class="fa-li"><i class="la la-check-circle-o"></i></span>{{$table->time}} Days</li>
                                                            <li><span class="fa-li"><i class="fas fa-times"></i></span>Unlimited Public Access</li>
                                                        </ul>
                                                    <input type="hidden" name="id" value="{{$table->id}}">
                                                    <input type="hidden" name="type" value="{{$table->type}}">
                                                             <input type="submit" class="btn btn-block  text-uppercase bg-white text-secondary"  value="pay">
                                                        </div>
                                                    </div>
                                            </form>
                                            </div>
                                    @endforeach
                                @endif
                              </div>
                </div>
            </div>
            </div>
        </div>

@section('script')

        <script>

$(document).ready(function () {
 $('#searchName').keyup(function(){
    $('#spinner').css('display','block');
    $('#cross').css('display','none');
    $('#tick').css('display','none');
    var query = $(this).val();
    if(query != ''){
       $.ajax({
        url:"{{ route('shops.create.search') }}",
        method:"GET",
        data:{_token: '{{ csrf_token()}}', name:query},
        success:function(data){
            console.log(data == "true");

            if(data == "false"){
                $('#spinner').css('display','none');
                $('#cross').css('display','block');
                $('#tick').css('display','none');
            }else{
                $('#spinner').css('display','none');
                $('#cross').css('display','none');
                $('#tick').css('display','block');
            }
    }
});
        }
        });

});


function selectTax(el){

            if(el.value=='vat'){
                $('#tax_id').css('display','flex');
            }else if(el.value=='no_vat'){
                $('#tax_id').css('display','none');
            }else{
                $('#tax_id').css('display','none');
            }
        }
        
         $('#cross').css('display','none');
       	$('#tick').css('display','none');
	$( "#username" ).keyup(function() {
	     $.get('{{ route('username.check') }}', {_token: '{{ csrf_token()}}', username:this.value}, function(data){
	  
                       if(data==0){
                       	$('#cross').css('display','none');
                       	$('#tick').css('display','block');           	
       			$('#none').css('display','none');
       			$( "#save_btn" ).prop( "disabled", false);
                       }
                       else{
                       $( "#save_btn" ).prop( "disabled", true );
                       	$('#cross').css('display','block');
                       	$('#tick').css('display','none');
       			$('#none').css('display','none');
                       }
                    });
	});
	
            </script>

@endsection

@endsection


