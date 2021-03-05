@extends('layouts.app')

@section('content')


    <div class="col-lg-9 col-lg-offset-2">
        <div class="panel">
            <!--Horizontal Form-->
              <div class="panel-heading">
                <h3 class="panel-title text-center">{{__('Custom Script')}}</h3>
            </div>

            <form class="form-horizontal" action="{{ route('business_settings.custom_script.update') }}" method="POST" enctype="multipart/form-data">
            	@csrf
                <div class="panel-body">
                    <div class="form-group">
                        <label class="col-lg-4 control-label">{{__("Header custom script - before </head>")}}</label>
                        <div class="col-lg-8">
			   <input type="hidden" name="types[]" value="header_script">
        		   <textarea name="header_script" rows="4" class="form-control" placeholder="<script>&#10;...&#10;</script>">{{ get_setting('header_script') }}</textarea>
                              <small>{{__('Write script with <script> tag') }}</small>
                        </div>
                    </div>
                     <div class="form-group">
                         <label class="col-md-4 col-from-label">{{__('Footer custom script - before </body>') }}</label>
                        <div class="col-lg-8">
			 <input type="hidden" name="types[]" value="footer_script">
        		<textarea name="footer_script" rows="4" class="form-control" placeholder="<script>&#10;...&#10;</script>">{{ get_setting('footer_script') }}</textarea>  
                            <small>{{__('Write script with <script> tag') }}</small>
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

@section('scripts')
 <script>
     $("input[data-role=tagsinput], select[multiple][data-role=tagsinput]").tagsinput();

     </script>
@endsection
