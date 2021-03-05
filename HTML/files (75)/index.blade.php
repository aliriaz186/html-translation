@extends('layouts.app')

@section('content')

    <div class="col-lg-6 col-lg-offset-3">
        <div class="panel">
          <div class="panel-title">
          {{__('Tax Management')}}
          </div>
            <!--Horizontal Form-->

            <form class="form-horizontal" action="{{ route('tax.store') }}" method="POST" enctype="multipart/form-data">
            	@csrf
                <div class="panel-body">
                 
                    <div class="row">
                        <div class="col-lg-1">
                           <label class="control-label">{{__('Tax')}}</label>
                        </div>
                        <div class="col-lg-9">
                            <input  class="form-control" type="number"  min="0" step="0.01" name="tax"  value="@isset(App\Tax::first()->tax){{App\Tax::first()->tax}}@endisset"> 
                        </div>
                        <div class="col-lg-2">
                           <select class="form-control selectpicker" name="tax_type" data-minimum-results-for-search="Infinity">
	                      <option @isset(App\Tax::first()->tax){{App\Tax::first()->tax_type=='amount'?'selected':''}} @endisset value="amount">{{currency_symbol()}}</option>
	                      <option @isset(App\Tax::first()->tax){{App\Tax::first()->tax_type=='percent'?'selected':''}} @endisset value="percent">{{__('%')}}</option>
	                   </select>
                        </div>
                    </div>
                </div>
                <div class="panel-footer text-right">
                    <button class="btn btn-purple" type="submit">{{__('Save')}}</button>
                </div>
            </form>
        </div>
    </div>
@endsection
