@extends('layouts.app')

@section('content')

<div class="col-lg-6 col-lg-offset-3">
    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title">{{__('Free Return Date')}}</h3>
        </div>

        <form class="form-horizontal" action="{{ route('free_return_days.store') }}" method="POST" enctype="multipart/form-data">
        	@csrf
            <div class="panel-body">
                <div class="row">
                    <div class="col-sm-2">
                        <label class="control-label">{{ __('Status') }}</label>
                    </div>
                    <div class="col-sm-10">
                        <label class="switch">
                            <input type="checkbox" name="status" class="form-control demo-sw">
                            <span class="slider round"></span>
                        </label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-2">
                        <label class="control-label">{{ __('Days') }}</label>
                    </div>
                    <div class="col-sm-10">
                        <input type="number" placeholder="{{__('Days')}}" min="0" id="days" name="days" class="form-control" required>
                    </div>
                </div>
                <br>
            </div>
            <div class="panel-footer text-right">
                <button class="btn btn-purple" type="submit">{{__('Save')}}</button>
            </div>
        </form>
    </div>
</div>
@endsection
