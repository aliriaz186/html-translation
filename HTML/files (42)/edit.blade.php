@extends('layouts.app')

@section('content')

<div class="col-lg-8 col-lg-offset-2">
    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title">{{__('Page Information')}}</h3>
        </div>

        <!--Horizontal Form-->
        <!--===================================================-->
        <form class="form-horizontal" action="{{ route('pages.update', $page->id) }}" method="POST" enctype="multipart/form-data">
            <input name="_method" type="hidden" value="PATCH">
        	@csrf
            <div class="panel-body">
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="name">{{__('Name')}}</label>
                    <div class="col-sm-9">
                        <input type="text" placeholder="{{__('Name')}}" id="title" name="title" class="form-control" required value="{{ $page->title }}">
                    </div>
                </div>
                <!-- <div class="form-group">
                    <label class="col-sm-3 control-label" for="logo">{{__('Logo')}} </label>
                    <div class="col-sm-10">
                        <input type="file" id="logo" name="logo" class="form-control">
                    </div>
                </div> -->
             
                 <br>
                <div class="form-group">
                    <label class="col-sm-3 control-label">{{__('Content')}}</label>
                    <div class="col-sm-9">
                        <textarea class="editor" name="description" rows="8" class="form-control">{{ $page->description }}</textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">{{__('Meta Title')}}</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="meta_title" value="{{ $page->meta_title }}" placeholder="{{__('Meta Title')}}">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">{{__('Meta Description')}}</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="meta_description" value="{{ $page->meta_description }}" placeholder="{{__('Meta Description')}}">
                    </div>
                </div>
                 <div class="form-group">
                    <label class="col-sm-3 control-label" for="name">{{__('Slug')}}</label>
                    <div class="col-sm-9">
                        <input type="text" placeholder="{{__('Slug')}}" id="slug" name="slug" value="{{ $page->slug }}" class="form-control">
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
