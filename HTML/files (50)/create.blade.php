@extends('layouts.app')

@section('content')
<style>
    .form_custom{
        width: 67%;margin-left: 20%;
    }
</style>
<div class="col-lg-12">
    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title">{{__('Loyalty Information')}}</h3>
        </div>

        <!--Horizontal Form-->
        <!--===================================================-->
        <form class="form-horizontal" action="{{ route('referral.store') }}" method="POST" enctype="multipart/form-data">
        	@csrf
            <div class="panel-body">
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="taxes">{{__('Enable')}}</label>
                    <div class="col-sm-9">
                        <label class="switch">
                            <input type="checkbox" name="enable">
                            <span class="slider round"></span>
                        </label>
                    </div>
                </div>
                    <div class="input-group form_custom">
                        <span class="input-group-addon">{{__('Ratio')}}</span>
                        <input id="ratio" type="number" step="0.01"  class="form-control" name="ratio" placeholder="{{currency_symbol()}}" required>
                        <span class="input-group-addon">{{__('= 1 reward point.')}}</span>
                      </div>
                    <br>
                    <div class="input-group form_custom">
                        <span class="input-group-addon">{{__('1 point = ')}}</span>
                        <input id="point" step="0.01"  type="number" class="form-control" name="point"  placeholder="{{currency_symbol()}}" required >
                        <span class="input-group-addon">{{__('for the discount.')}}</span>
                    </div>
                    <br>

                    <div class="input-group form_custom">
                        <span class="input-group-addon">{{__('Validity period of a point')}}</span>
                        <input id="period" type="number" class="form-control" name="period"  placeholder="{{__('Period')}}" >
                    </div>
                    <br>

                    <div class="input-group form_custom">
                        <span class="input-group-addon">{{__('Voucher details')}}</span>
                        <input id="voucher_details" step="0.1"  type="text" class="form-control" name="voucher_details"  required  placeholder="{{__('Voucher details')}}" >
                    </div>
                    <br>

                    <div class="input-group form_custom">
                        <span class="input-group-addon">{{__('Amount/Points')}}</span>
                       <select name="selectType"  class="form-control" onchange="amount_point(this)"  required>
                           <option value="">{{__('Plese select option')}}</option>
                           <option value="amount">{{__('Amount')}}</option>
                           <option value="point">{{__('Point')}}</option>
                       </select>
                    </div>
                    <br>
                    <div id="amount" style="display: none">
                        <div class="input-group form_custom">
                            <span class="input-group-addon">{{__('Minimum Amount')}}</span>
                            <input id="minimum_amount" step="0.1"  type="number" class="form-control" name="minimum_amount"  placeholder="{{__('Minimum amount')}}" >
                            <span class="input-group-addon">{{currency_symbol()}}</span>
                        </div>
                        <br>
                    </div>
                    <div id="point_1" style="display: none">
                        <div class="input-group form_custom">
                            <span class="input-group-addon">{{__('Minimum Points')}}</span>
                            <input id="minimum_point" step="0.1"  type="number" class="form-control" name="minimum_point"  placeholder="{{__('Minimum Points')}}" >
                            <span class="input-group-addon">{{__('Point')}}</span>
                        </div>
                        <br>
                    </div>


                    <div class="input-group form_custom">
                        <span class="input-group-addon">{{__('Apply taxes on the voucher')}}</span>
                        <label class="switch"  style="margin-top: 5px">
                            <input type="checkbox" name="taxes">
                            <span class="slider round"></span>
                        </label>
                    </div>
                    <br>

                <div class="input-group form_custom">
                    <span class="input-group-addon">{{__('Points are awarded when the order is')}}</span>
                    <select name="points_awarded" id="points_awarded" class="form-control"  required>
                        <option value="">{{__('Select The option')}}</option>
                        <option value="pending">{{__('Pending')}}</option>
                        <option value="on_review">{{__('On review')}}</option>
                        <option value="on_delivery">{{__('On delivery')}}</option>
                        <option value="delivered">{{__('Delivered')}}</option>
                        <option value="delivered">{{__('Shipped')}}</option>
                        <option value="cancelled">{{__('Cancelled')}}</option>
                        <option value="refunded">{{__('Refunded')}}</option>
                        <option value="returned">{{__('Returned')}}</option>
                    </select>
                </div>
                <br>

                <div class="input-group form_custom">
                    <span class="input-group-addon">{{__('Points are cancelled when the order is')}}</span>
                    <select name="points_cancelled" id="points_cancelled" class="form-control"  required>
                        <option value="">{{__('Select The option')}}</option>
                        <option value="pending">{{__('Pending')}}</option>
                        <option value="on_review">{{__('On review')}}</option>
                        <option value="on_delivery">{{__('On delivery')}}</option>
                        <option value="delivered">{{__('Delivered')}}</option>
                        <option value="delivered">{{__('Shipped')}}</option>
                        <option value="cancelled">{{__('Cancelled')}}</option>
                        <option value="refunded">{{__('Refunded')}}</option>
                        <option value="returned">{{__('Returned')}}</option>
                    </select>
                </div>
                <br>

                <div class="input-group form_custom">
                    <span class="input-group-addon">{{__('Give points on discounted products')}}</span>
                    <label class="switch" style="margin-top: 5px">
                        <input type="checkbox" name="discounted">
                        <span class="slider round"></span>
                    </label>

                </div>
                <br>

                <div class="input-group form_custom">
                    <span class="input-group-addon">{{__('Vouchers created by the loyalty system can be used in the following categories:')}}</span>
                    <div class="">
                        <button class="btn btn-sm btn-primary mt-1" onclick="mark(1)" type="button">
                            {{__('Select All')}}
                       </button>
                       <button class="btn btn-sm btn-primary mt-1 " onclick="mark(0)" type="button">
                        {{__('Deselect All')}}
                      </button>
                    </div>
                </div>
                <div class="input-group form_custom">
                    <ul id="tree1" style="border: 1px solid gainsboro;height: 33vh;scroll-behavior: auto;overflow-y: auto;">
                        @foreach(App\Category::all() as $category)
                            <li>
                                    <input type="checkbox" name="category[]" value="{{ $category->id }}">
                                    {{ $category->name }}
                                @if(count($category->subcategories))
                                <ul>
                                    @foreach($category->subcategories as $subcategories)
                                        <li>
                                        <input type="checkbox" name="sub_category[]" value="{{ $subcategories->id }}">
                                            {{ $subcategories->name }}
                                        @if(count($subcategories->subsubcategories))
                                        <ul>
                                            @foreach($subcategories->subsubcategories as $subsubcategories)
                                                <li>
                                                    <input name="sub_sub_category[]" value="{{ $subsubcategories->id }}" type="checkbox">
                                                    {{ $subsubcategories->name }}
                                                </li>
                                            @endforeach
                                            </ul>
                                            @endif
                                        </li>
                                    @endforeach
                                    </ul>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                </div>
                <br>
            </div>
            <div class="panel-footer text-right">
                <button class="btn btn-purple" type="submit">{{__('Save')}}</button>
            </div>
        </form>
        <!--===================================================-->
        <!--End Horizontal Form-->

    </div>
</div>
<script>
    function amount_point(el) {
        if(el.value == 'amount'){
            $('#amount').show();
            $('#point_1').hide();
        }else{
            $('#point_1').show();
            $('#amount').hide();
        }
    }

$(document).ready(function(){
    $('.demo-select2').select2();
});

function mark(select){
 if(select == 1){
    $('#tree1 :input').each(function(){
		this.checked = 1;
    });
    }
    else{
        $('#tree1 :input').each(function(){
		this.checked = 0;
    });
    }
}
    </script>

@endsection

