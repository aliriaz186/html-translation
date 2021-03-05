@extends('layouts.app')

@section('content')

<div class="col-lg-12 ">
    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title">{{__('Admin Instruction')}}</h3>
        </div>

        <!--Horizontal Form-->
        <!--===================================================-->
        <form class="form-horizontal" action="{{ route('returnAddress.adminInstruction_store') }}" method="POST" enctype="multipart/form-data">
        	@csrf
            <div class="panel-body">
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="name">{{__('Instructions')}}</label>
                    <div class="col-sm-9">
                    <textarea name="Instructions"  id="" cols="30" rows="10" class="form-control editor">
                        @if(isset($Instruction)){{$Instruction}}
                        @endif
                    </textarea>
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
