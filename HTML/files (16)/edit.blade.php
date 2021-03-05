@extends('layouts.app')

@section('content')

<div class="col-lg-8 col-lg-offset-2">
    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title">{{__('Custom Offers Information')}}</h3>
        </div>
        <!--===================================================-->
        <form class="form-horizontal" action="{{ route('customeroffers.update', $customer_offers->id) }}" method="POST" enctype="multipart/form-data">
            <input name="_method" type="hidden" value="PATCH">
        	@csrf
            <div class="panel-body">
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="name">{{__('Title')}}</label>
                    <div class="col-sm-9">
                        <input type="text" placeholder="{{__('Title')}}" id="title" name="title" class="form-control" required value="{{ $customer_offers->title }}">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="image">{{__('Image')}}</label>
                    <div class="col-sm-9">
                        <input type="file" id="image" name="image" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="quantity">{{__('Quantity')}}</label>
                    <div class="col-sm-9">
                        <input type="number" id="quantity" name="quantity" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="voucher">{{__('Voucher')}}</label>
                    <div class="col-sm-9">
                        <input type="text" id="voucher" name="voucher" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="description">{{__('Description')}}</label>
                    <div class="col-sm-9">
                        <textarea id="description" name="description" class="form-control editor" rows="5" >
                            {{ $customer_offers->description }}
                        </textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">{{__('Meta Title')}}</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="meta_title" value="{{ $customer_offers->meta_title }}" placeholder="{{__('Meta Title')}}">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">{{__('Meta Description')}}</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="meta_description" value="{{ $customer_offers->meta_description }}" placeholder="{{__('Meta Description')}}">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="name">{{__('Slug')}}</label>
                    <div class="col-sm-9">
                        <input type="text" placeholder="{{__('Slug')}}" id="slug" name="slug" value="{{ $customer_offers->slug }}" class="form-control">
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
