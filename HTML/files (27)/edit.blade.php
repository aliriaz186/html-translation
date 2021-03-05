@extends('layouts.app')

@section('content')

<div class="col-lg-6 col-lg-offset-3">
    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title">{{__('Return Policy Date')}}</h3>
        </div>

        <form class="form-horizontal" action="{{ route('free_return_days.update',$FreeReturn->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input name="_method" type="hidden" value="PATCH">

            <div class="panel-body">

                <div class="row">
                    <div class="col-sm-10">
                        <label class="control-label">{{ __('Status') }}</label>
                    </div>
                    <div class="col-sm-2">
                        <label class="switch">
                            <input type="checkbox" name="status" {{$FreeReturn->status==1?'checked':''}} class="form-control demo-sw">
                            <span class="slider round"></span>
                        </label>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-sm-10">
                        <label class="control-label">{{ __('Days') }}</label>
                    </div>
                    <div class="col-sm-2">
                        <input type="text" placeholder="{{__('Days')}}" id="days" name="days" value="{{$FreeReturn->days}}" class="form-control" required>
                    </div>
                </div>
                <br>
            </div>
            <div class="panel-footer text-right">
                <button class="btn btn-purple" type="submit">{{__('Upload')}}</button>
            </div>
        </form>
    </div>
</div>

@endsection
