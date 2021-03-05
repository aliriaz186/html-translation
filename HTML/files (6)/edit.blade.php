@extends('layouts.app')

@section('content')

<div class="col-lg-12">
    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title">{{__('Cashback Information')}}</h3>
        </div>

        <!--Horizontal Form-->
        <!--===================================================-->
        <form class="form-horizontal" action="{{ route('cashbacks.update',$cashback->id) }}" method="POST" enctype="multipart/form-data">
            <input name="_method" type="hidden" value="PATCH">
            @csrf
            <div class="panel-body">
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="taxes">{{__('Enable')}}</label>
                    <div class="col-sm-9">
                        <label class="switch">
                            <input type="checkbox" name="enable"  {{$cashback->enable=='1'?'checked':''}}>
                            <span class="slider round"></span>
                        </label>
                    </div>
                </div>
                    <div class="input-group rafferal_admin_form_info" >
                        <span class="input-group-addon">Ratio</span>
                        <input id="ratio" type="number" class="form-control" name="ratio" placeholder="{{currency_symbol()}}" value="{{$cashback->ratio}}" required>
                        <span class="input-group-addon">= 1 reward point.</span>
                      </div>
                    <br>
                    <div class="input-group rafferal_admin_form_info" >
                        <span class="input-group-addon">1 point = </span>
                        <input id="point" step="0.01" type="number" class="form-control" name="point"  placeholder="{{currency_symbol()}}"  value="{{$cashback->point}}"  required>
                        <span class="input-group-addon">for the discount.</span>
                    </div>
                    <br>

                    <div class="input-group rafferal_admin_form_info" >
                        <span class="input-group-addon">{{__('Validity period of a point')}}</span>
                        <input id="period" step="0.01" type="number" class="form-control" name="period"  placeholder="{{__('Period')}}"  value="{{$cashback->period}}" >
                    </div>
                    <br>

                    <div class="input-group rafferal_admin_form_info" >
                        <span class="input-group-addon">{{__('Voucher details')}}</span>
                        <input id="voucher_details" step="0.1"  type="text" class="form-control" name="voucher_details"  placeholder="{{__('Voucher details')}}"  value="{{$cashback->voucher_details}}"  required>

                    </div>
                    <br>

                    <div class="input-group rafferal_admin_form_info" >
                        <span class="input-group-addon">{{__('Amount/Points')}}</span>
                       <select name="selectType" id="amount_or_proints" class="form-control" onchange="val()">
                           <option value="selected">Plese select option</option>
                           <option {{$cashback->minimum_amount!=null?'selected':''}}  value="amount">Amount</option>
                           <option {{$cashback->minimum_point!=null?'selected':''}} value="point">Point</option>
                       </select>
                    </div>
                    <br>
                    <div id="amount" class="rafferal_admin_form_info" style="display: none">
                        <div class="input-group" >
                            <span class="input-group-addon">{{__('Minimum Amount')}}</span>
                            <input id="minimum_amount" step="0.1"  type="number" class="form-control" name="minimum_amount" value="{{$cashback->minimum_amount}}"  placeholder="{{__('Minimum amount')}}" >
                            <span class="input-group-addon">{{currency_symbol()}}</span>
                        </div>
                        <br>
                    </div>
                    <div id="point_1"class="rafferal_admin_form_info" style="display: none">
                        <div class="input-group" >
                            <span class="input-group-addon">{{__('Minimum Points')}}</span>
                            <input id="minimum_point" step="0.1"  type="number" class="form-control" name="minimum_point" value="{{$cashback->minimum_point}}"  placeholder="{{__('Minimum Points')}}" >
                            <span class="input-group-addon">{{__('Point')}}</span>
                        </div>
                        <br>
                    </div>


                    <div class="input-group rafferal_admin_form_info" >
                        <span class="input-group-addon">{{__('Apply taxes on the voucher')}}</span>
                        <label class="switch"  style="margin-top: 5px">
                            <input type="checkbox" name="taxes" {{$cashback->taxes=='1'?'checked':''}}>
                            <span class="slider round"></span>
                        </label>
                    </div>
                    <br>

                <div class="input-group rafferal_admin_form_info" >
                    <span class="input-group-addon">{{__('Points are awarded when the order is')}}</span>
                    <select name="points_awarded" id="points_awarded" class="form-control"  required>
                        <option value="select" selected>Select The option</option>
                        <option value="pending" {{$cashback->points_awarded=='pending'?'selected':''}} >Pending</option>
                        <option value="on_review" {{$cashback->points_awarded=='on_review'?'selected':''}}>On review</option>
                        <option value="on_delivery" {{$cashback->points_awarded=='on_delivery'?'selected':''}}>On delivery</option>
                        <option value="delivered" {{$cashback->points_awarded=='delivered'?'selected':''}}>Delivered</option>
                        <option value="shipped" {{$cashback->points_awarded=='shipped'?'selected':''}}>Shipped</option>
                        <option value="cancelled" {{$cashback->points_awarded=='cancelled'?'selected':''}}>Cancelled</option>
                        <option value="refunded" {{$cashback->points_awarded=='refunded'?'selected':''}}>Refunded</option>
                        <option value="returned" {{$cashback->points_awarded=='returned'?'selected':''}}>Returned</option>
                    </select>
                </div>
                <br>

                <div class="input-group rafferal_admin_form_info" >
                    <span class="input-group-addon">{{__('Points are cancelled when the order is')}}</span>
                    <select name="points_cancelled" id="points_cancelled" class="form-control"  required>
                        <option value="select" selected>Select The option</option>
                        <option value="pending" {{$cashback->points_cancelled=='pending'?'selected':''}} >Pending</option>
                        <option value="on_review" {{$cashback->points_cancelled=='on_review'?'selected':''}}>On review</option>
                        <option value="on_delivery" {{$cashback->points_cancelled=='on_delivery'?'selected':''}}>On delivery</option>
                        <option value="delivered" {{$cashback->points_cancelled=='delivered'?'selected':''}}>Delivered</option>
                        <option value="shipped" {{$cashback->points_cancelled=='shipped'?'selected':''}}>Shipped</option>
                        <option value="cancelled" {{$cashback->points_cancelled=='cancelled'?'selected':''}}>Cancelled</option>
                        <option value="refunded" {{$cashback->points_cancelled=='refunded'?'selected':''}}>Refunded</option>
                        <option value="returned" {{$cashback->points_cancelled=='returned'?'selected':''}}>Returned</option>
                    </select>
                </div>
                <br>

                <div class="input-group rafferal_admin_form_info" >
                    <span class="input-group-addon">{{__('Give points on discounted products')}}</span>
                    <label class="switch" style="margin-top: 5px" >
                        <input type="checkbox" name="discounted" {{$cashback->discounted=='1'?'checked':''}}>
                        <span class="slider round"></span>
                    </label>

                </div>
                <br>

                <div class="input-group rafferal_admin_form_info" >
                    <span class="input-group-addon">{{__('Vouchers created by the loyalty system can be used in the following categories:')}}</span>
                   
                </div>

                 <div class="input-group rafferal_admin_form_info">
                    <span class="input-group-addon">{{__('Products')}}</span> 
                      <select name="products[]" class="form-control demo-select2" multiple>
                          <option value="">{{__('Please Select multiple Products')}}</option>
			  @foreach(json_decode($cashback->products) as $product)
			     <option selected value="{{$product}}"> {{App\Product::findOrFail($product)->name}} </option>
			  @endforeach
			  @foreach(App\Product::all() as $product)
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
@endsection

@section('script')
<script>


        function val() {
            value = document.getElementById("amount_or_proints").value;
            console.log(value);
            if(value == 'amount'){
                    document.getElementById('amount').style.display = 'block';
                    document.getElementById('point_1').style.display = 'none';
                }else if(value == 'point'){
                    document.getElementById('point_1').style.display = 'block';
                    document.getElementById('amount').style.display = 'none';
                }else{
                    document.getElementById('point_1').style.display = 'none';
                    document.getElementById('amount').style.display = 'none';
                }

        }

    $(document).ready(function(){
        $('.demo-select2').select2();
        val();
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
