@extends('layouts.app')

@section('content')

    <div class="col-lg-6 col-lg-offset-3">
        <div class="panel">
            <!--Horizontal Form-->

            <form class="form-horizontal" action="{{ route('seller_store_name.add') }}" method="POST" enctype="multipart/form-data">
            	@csrf
                <div class="panel-body">
                    <div class="form-group">
                        <input type="hidden" name="type" >
                        <label class="col-lg-3 control-label">{{__('Shop Name')}}</label>
                        <div class="col-lg-7">
                            <input type="text" min="0" step="0.01"  name="name" class="form-control">
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
