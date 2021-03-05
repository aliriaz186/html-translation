@extends('layouts.app')

<link rel="stylesheet" href="{{asset('css/intlTelInput.css')}}">

<style>
    .iti .iti--allow-dropdown{
        width: 100% !important;
    }
</style>

@section('content')
<div class="col-lg-12">
    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title">{{__('Seller Information')}}</h3>
        </div>
        <!--Horizontal Form-->
        <!--===================================================-->
        <form class="form-horizontal" action="{{ route('customers.update', $customer->id) }}" method="POST" enctype="multipart/form-data">
            <input name="_method" type="hidden" value="PATCH">
        	@csrf
            <div class="panel-body">
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="name">{{__('Name')}}</label>
                    <div class="col-sm-9">
                        <input type="text" placeholder="{{__('Name')}}" id="name" name="name" class="form-control" value="{{$customer->user->name}}" required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-3 control-label" for="email">{{__('Email Address')}}</label>
                    <div class="col-sm-9">
                        <input type="text" placeholder="{{__('Email Address')}}" id="email" name="email" class="form-control" value="{{$customer->user->email}}" required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-3 control-label" for="pNo">{{__('Personal Number')}}</label>
                    {{-- pattern="[0-9+]{2,3}-[0-9]{6,10}" --}}
                    <div class="col-sm-9">
                        <input type="tel" placeholder="{{__('Personal Number')}}" id="pNo" name="personal_number" class="form-control" value="{{$customer->user->personal_number}}" required style="width:120%">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-3 control-label" for="password">{{__('Password')}}</label>
                    <div class="col-sm-9">
                        <input type="password" placeholder="{{__('Password')}}" id="password" name="password" class="form-control">
                    </div>
                </div>
            </div>
            <hr>
            <div class="panel-footer text-right">
                <button class="btn btn-purple" type="submit">{{__('Save')}}</button>
            </div>
        </form>
        <hr>
        <!--===================================================-->

        <!--End Horizontal Form-->
    </div>
</div>

@section('script')
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
            document.getElementById('pNo').value = '+'+dialCode;
});

        </script>
@endsection


@endsection

