@extends('layouts.app')

@section('content')

<div class="col-lg-11 col-lg-offset-1">
    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title">{{__('Developer Api')}}</h3>
        </div>

        <!--Horizontal Form-->
        <!--===================================================-->
        <form class="form-horizontal" action="{{ route('api.user-register') }}" method="POST" enctype="multipart/form-data">
        	@csrf
            <div class="panel-body">

                <div class="form-group">
                    <label class="col-sm-3 control-label" for="key_description">{{__('Key Description')}}</label>
                    <div class="col-sm-9">
                        <textarea name="key_description" id="key_description" class="form-control" required  rows="4" placeholder="Message"></textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-3 control-label" for="firstname">{{__('First Name')}}</label>
                    <div class="col-sm-9">
                        <input name="firstname" id="firstname" required placeholder="Name" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="email">{{__('Email')}}</label>
                    <div class="col-sm-9">
                        <input name="email" type="email" id="email" required placeholder="Email" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="password">{{__('Password')}}</label>
                    <div class="col-sm-9">
                        <input name="password" id="password" required placeholder="Password" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="confirm-password">{{__('Confirm Password')}}</label>
                    <div class="col-sm-9">
                        <input name="confirm-password" id="confirm-password" required placeholder="Confirm Password" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <!-- <label>{{ __('confirm_password') }}</label> -->
                    <div class="input-group input-group--style-1">
                       <select name="api_key" id="" class="form-control" required>
                            <option value="selected" selected>{{ __('Type of Api') }}</option>
                            @foreach (App\ShippingApi::all() as $SAI)
                                <option value="{{$SAI->key}}">{{$SAI->key_description}}</option>
                            @endforeach
                       </select>
                    </div>
                </div>

            </div>
            <div class="panel-footer text-right">
                <button class="btn btn-purple" type="submit">{{__('Save')}}</button>
            </div>
        </form>
        <!--===================================================-->
        <!--End Horizontal Form-->

    </div>
</div>

@endsection
