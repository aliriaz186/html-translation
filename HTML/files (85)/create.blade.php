@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-sm-12">
        <a href="{{ route('shipping-api.create')}}" class="btn btn-rounded btn-info pull-right">{{__('Add New Api')}}</a>
    </div>
</div>

<div class="col-lg-6 col-lg-offset-3">
<div class="panel">
    <div class="panel-heading">
        <h3 class="panel-title">{{__('Api User Information')}}</h3>
    </div>

    <!--Horizontal Form-->
    <!--===================================================-->
    <form class="form-horizontal" action="{{ route('api-user.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="panel-body">
            <div class="form-group">
                <label class="col-sm-3 control-label" for="name">{{__('Name')}}</label>
                <div class="col-sm-9">
                    <input type="text" placeholder="{{__('Name')}}" id="name" name="name" class="form-control" required>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="email">{{__('Email Address')}}</label>
                <div class="col-sm-9">
                    <input type="text" placeholder="{{__('Email Address')}}" id="email" name="email" class="form-control" required>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="password">{{__('Password')}}</label>
                <div class="col-sm-9">
                    <input type="password" placeholder="{{__('Password')}}" id="password" name="password" class="form-control" required>
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-sm-3 control-label" for="password">{{__('Api Key')}}</label>
                <div class="col-sm-9">
                    <select name="api_key" id="" class="form-control" required>
                        <option value="">{{ __('Type of Api') }}</option>
                        @foreach (App\ShippingApi::where('status',1)->get() as $SAI)
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
