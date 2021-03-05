@extends('layouts.app')

@section('content')

    <div class="col-lg-9 col-lg-offset-1">
        <div class="panel">
            <!--Horizontal Form-->

            <form class="form-horizontal" action="{{ route('products.buyer.tips.store') }}" method="POST" enctype="multipart/form-data">
            	@csrf
                <div class="panel-body">
                    <div class="form-group">
                        <label class="col-lg-3 control-label">{{__('Status')}}</label>
                        <label class="switch">
                            <input type="checkbox" name="status" @if(App\ClassifiedSellerTips::first()) {{App\ProductBuyerTips::first()->status==1?'checked':''}} @endif>
                            <span class="slider round"></span>
                        </label>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label">{{__('Buyer Tips')}}</label>
                        <div class="col-lg-9">
                            <textarea name="message" class="editor" id="" cols="30" rows="10"> @if(App\ProductBuyerTips::first()) {!!App\ProductBuyerTips::first()->message!!} @endif</textarea>
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
