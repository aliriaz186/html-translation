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
            <h3 class="panel-title">{{__('Cashback Information')}}</h3>
        </div>

        <!--Horizontal Form-->
        <!--===================================================-->
        <form class="form-horizontal" action="{{ route('cashbacks.store') }}" method="POST" enctype="multipart/form-data">
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
                        <span class="input-group-addon">Ratio</span>
                        <input id="ratio" type="number" step="0.01"  class="form-control" name="ratio" placeholder="{{currency_symbol()}}"  required>
                        <span class="input-group-addon">= 1 cashback point.</span>
                      </div>
                    <br>
                    <div class="input-group form_custom">
                        <span class="input-group-addon">1 point = </span>
                        <input id="point" step="0.01"  type="number" class="form-control" name="point"  placeholder="{{currency_symbol()}}"  required >
                        <span class="input-group-addon">for the discount.</span>
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
                       <select name="selectType" id="st" class="form-control" onchange="val()"  required>
                           <option value="">Plese select option</option>
                           <option value="amount">Amount</option>
                           <option value="point">Point</option>
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
                            <span class="input-group-addon">{{__('Minimum Cashbacks')}}</span>
                            <input id="minimum_point" step="0.1"  type="number" class="form-control" name="minimum_point"  placeholder="{{__('Minimum Cashbacks')}}" >
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
                    <span class="input-group-addon">{{__('Cashback are awarded when the order is')}}</span>
                    <select name="points_awarded" id="points_awarded" class="form-control"  required>
                        <option value="">Select The option</option>
                        <option value="pending">Pending</option>
                        <option value="on_review">On review</option>
                        <option value="on_delivery">On delivery</option>
                        <option value="delivered">Delivered</option>
                        <option value="delivered">Shipped</option>
                        <option value="cancelled">Cancelled</option>
                        <option value="refunded">Refunded</option>
                        <option value="returned">Returned</option>
                    </select>
                </div>
                <br>

                <div class="input-group form_custom">
                    <span class="input-group-addon">{{__('Cashback are cancelled when the order is')}}</span>
                    <select name="points_cancelled" id="points_cancelled" class="form-control"  required>
                        <option value="">Select The option</option>
                        <option value="pending">Pending</option>
                        <option value="on_review">On review</option>
                        <option value="on_delivery">On delivery</option>
                        <option value="delivered">Delivered</option>
                        <option value="delivered">Shipped</option>
                        <option value="cancelled">Cancelled</option>
                        <option value="refunded">Refunded</option>
                        <option value="returned">Returned</option>
                    </select>
                </div>
                <br>

                <div class="input-group form_custom">
                    <span class="input-group-addon">{{__('Give cashback on discounted products')}}</span>
                    <label class="switch" style="margin-top: 5px">
                        <input type="checkbox" name="discounted">
                        <span class="slider round"></span>
                    </label>

                </div>
                <br>

                <div class="input-group form_custom">
                    <span class="input-group-addon">{{__('Vouchers created by the cashback system can be used in the following categories:')}}</span>
              
                </div>
               @php 
               $products_contains = '';
               foreach(App\Cashback::all() as $cashback){
                   $products_contains = $products_contains.','.$cashback->products;
		}
               @endphp
               <div class="input-group form_custom">
                    <span class="input-group-addon">{{__('Products')}}</span> 
                      <select name="products[]" class="form-control demo-select2" multiple>
                          <option value="">{{__('Please Select multiple Products')}}</option>
			  @foreach(App\Product::all() as $product)
			     @php if(str_contains($products_contains , $product->id)){continue;} @endphp
			     <option value="{{$product->id}}"> {{$product->name}} </option>
			  @endforeach
	                </select>
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
    function val() {
        d = document.getElementById("st").value;

        if(d == 'amount'){
            document.getElementById('amount').style.display = 'block';
            document.getElementById('point_1').style.display = 'none';
        }else{
            document.getElementById('point_1').style.display = 'block';
            document.getElementById('amount').style.display = 'none';
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

