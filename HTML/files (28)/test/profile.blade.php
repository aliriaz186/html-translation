@extends('frontend.layouts.app')
<link rel="stylesheet" href="{{asset('css/intlTelInput.css')}}">

@section('content')

    <section class="gry-bg py-4 profile">
        <div class="container-fluid p-4">
            <div class="row cols-xs-space cols-sm-space cols-md-space">
                <div class="col-lg-2-1 d-none d-lg-block">
                    @if(Auth::user()->user_type == 'api_user')
                        @include('frontend.inc.api_user_side_nav')
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
                                            <li class="active"><a href="{{ route('api.update-api-profile') }}">{{__('Manage Profile')}}</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <form class="" action="{{ route('customer.profile.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <br>
                            <div class="form-box bg-white mt-4">
                                <div class="form-box-title px-3 py-2">
                                    {{__('Basic info')}}
                                </div>
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
                                                                <button type="button" class="btn btn-outline-secondary new-email-verification">
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
                                       <div class="col-md-10">
                                            <input type="tel" class="form-control mb-3 " style="width:360%" placeholder="{{__('Your Personal Number')}}" id="pNo" name="personal_number" value="{{ Auth::user()->personal_number }}">
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
                                            <label for="file-3" class="mw-100 mb-3" style="height:6vh">
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
                            <div class="text-right mt-4">
                                <button type="submit" class="btn btn-styled btn-base-1" >{{__('Update Profile')}}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    
    </section>
@endsection


@section('script')
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