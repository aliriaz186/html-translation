@extends('layouts.app')

@section('content')

    <div class="col-lg-9">
        <div class="panel">
          <div class="panel-heading">
              <h3 class="panel-title">{{__('Cookeis Information')}}</h3>
           </div>
            <form action="{{ route('cookies_update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="panel-body">
	               <div class="form-group row">
	                    <label class="col-md-3 col-from-label">{{__('Show Cookies Agreement?')}}</label>
	                    <div class="col-md-8">
		                     <label class="switch">
		                            <input type="checkbox" name="show_cookies_agreement"  {{\App\BusinessSetting::where('type', 'show_cookies_agreement')->first()->value == 1 ? "checked" : ""}}>
		                            <span class="slider round"></span>
		                      </label>
	                    </div>
	                </div>
	                <br>
	                <div class="form-group row">
	                    <label class="col-md-3 col-from-label">{{ __('Cookies Agreement Text') }}</label>
	                    <div class="col-md-8">
	                        <textarea name="cookies_agreement_text" rows="4" class="editor form-control">{!! \App\BusinessSetting::where('type', 'cookies_agreement_text')->first()->value !!}</textarea>
	                    </div>
	                </div>
                 </div>
                <div class="panel-footer text-right">
                    <button class="btn btn-purple" type="submit">{{__('Update')}}</button>
                </div>
            </form>
        </div>
    </div>


@endsection

