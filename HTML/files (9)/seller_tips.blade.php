@extends('layouts.app')

@section('content')

    <div class="col-lg-9 col-lg-offset-1">
        <div class="panel">
            <!--Horizontal Form-->

            <form class="form-horizontal" action="{{ route('classified.seller.tips.store') }}" method="POST" enctype="multipart/form-data">
            	@csrf
                <div class="panel-body">
                    <div class="form-group">
                        <label class="col-lg-3 control-label">{{__('Status')}}</label>
                        <label class="switch">
                            <input type="checkbox" name="status" @if(App\ClassifiedSellerTips::first()) {{App\ClassifiedSellerTips::first()->status==1?'checked':''}} @endif>
                            <span class="slider round"></span>
                        </label>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label">{{__('Seller Tips')}}</label>
                        <div class="col-lg-9">
                            <textarea name="message" class="editor" id="" cols="30" rows="10"> @if(App\ClassifiedSellerTips::first()) {!!App\ClassifiedSellerTips::first()->message!!} @endif</textarea>
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
