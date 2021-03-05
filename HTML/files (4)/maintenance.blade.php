@extends('layouts.app')

@section('content')


    <div class="col-lg-6 col-lg-offset-3">
        <div class="panel">
            <!--Horizontal Form-->

            <form class="form-horizontal" action="{{ route('maintenance.update') }}" method="POST" enctype="multipart/form-data">
            	@csrf
                <div class="panel-body">
                    <div class="form-group">
                        <label class="col-lg-3 control-label">{{__("Witelist IP's")}}</label>
                        <div class="col-lg-9">
			    <input type="text"  class="form-control" name="whitelistIps[]" placeholder="Type to add an IP" @if(App\MaintenanceWhitelist::first()) value="{{App\MaintenanceWhitelist::first()->whitelist}}" @endif data-role="tagsinput">
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
