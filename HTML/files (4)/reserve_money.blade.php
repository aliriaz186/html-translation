@extends('layouts.app')

@section('content')

    <div class="col-lg-6 col-lg-offset-3">
        <div class="panel">
          <div class="panel-title">
          {{__('Reserve Money Management')}}
          </div>
            <!--Horizontal Form-->

            <form class="form-horizontal" action="{{ route('business_settings.reserve_money_post') }}" method="POST" enctype="multipart/form-data">
            	@csrf
                <div class="panel-body">
                 
                    <div class="row">
                        <div class="col-lg-3">
                           <label class="control-label">{{__('Reserve Money')}}</label>
                        </div>
                        <div class="col-lg-9">
                            <input  class="form-control" type="number"  min="0" max="100" name="reserve_money"  value="{{get_setting('reserve_money')}}"> 
                        </div>
                    </div>
                </div>
                <div class="panel-footer text-right">
                    <button class="btn btn-purple" type="submit">{{__('Save')}}</button>
                </div>
            </form>
        </div>
    </div>
    
     <div class="col-lg-6 col-lg-offset-3">
        <div class="panel">
          <div class="panel-title">
          {{__('Cashback Reserve Money Management')}}
          </div>
            <!--Horizontal Form-->

            <form class="form-horizontal" action="{{ route('business_settings.reserve_money_post') }}" method="POST" enctype="multipart/form-data">
            	@csrf
                <div class="panel-body">
                 
                    <div class="row">
                        <div class="col-lg-3">
                           <label class="control-label">{{__('Reserve Money')}}</label>
                        </div>
                        <div class="col-lg-9">
                            <input  class="form-control" type="number"  min="0" max="100" name="cashback_reserve_money"  value="{{get_setting('cashback_reserve_money')}}"> 
                        </div>
                    </div>
                </div>
                <div class="panel-footer text-right">
                    <button class="btn btn-purple" type="submit">{{__('Save')}}</button>
                </div>
            </form>
        </div>
    </div>
@endsection
