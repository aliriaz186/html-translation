

<div class="panel-heading">
    <h3 class="panel-title">{{__('Add Your Gifts Base Coupon')}}</h3>
</div>
<div class="form-group">
    <label class="col-lg-3 control-label" for="coupon_code">{{__('Coupon code')}}</label>
    <div class="col-lg-9">
        <input type="text" placeholder="{{__('Coupon code')}}" id="coupon_code" name="code" class="form-control" required value="{{$coupon->code}}">
    </div>
</div>
<div class="form-group">
    <label class="col-lg-3 control-label" for="Type">{{__('Type')}}</label>
    <div class="col-lg-9">
        <select name="type" id="type"  class="form-control" onchange="typeOfForm()" >
            <option value="select">Select Type</option>
            <option value="product" @if($coupon->type == 'product') selected @endif>Product</option>
            <option value="sitewide"  @if($coupon->type == 'sitewide') selected @endif>Site Wide</option>
        </select>
    </div>
</div>

@if($coupon->type == 'product')
<div id="productOne"  @if($coupon->type != 'product') style="display: none" @endif >
    <div class="form-group ">
        <label class="col-lg-3 control-label">{{__('Product')}}</label>
        <div class="col-lg-9">
                <select name="products[]" id="products"  class="form-control demo-select2" multiple>
                    @foreach (json_decode($coupon->product) as $pr)
                        <option value="{{$pr->id}}" selected>{{$pr->name}}</option>
                    @endforeach
                    @foreach (App\Product::all() as $pr)
                        <option value="{{$pr->id}}">{{$pr->name}}</option>
                    @endforeach
                </select>
        </div>
     </div>
</div>
@endif

@if($coupon->type == 'sitewide')
<div id="siteWise" @if($coupon->type != 'sitewide') style="display: none" @endif>
    <div class="form-group">
        <label class="col-lg-3 control-label">{{__('Minimum Order Amount')}}</label>
        <div class="col-lg-9">
           <input type="number" min="0" step="0.01" placeholder="{{__('Minimum Order Amount')}}" value="{{$coupon->min_order}}"  name="min_order" class="form-control" >
        </div>
     </div>
</div>
@endif
<div class="form-group">
    <label class="col-lg-3 control-label">{{__('Quantity')}}</label>
    <div class="col-lg-9">
       <input type="number" min="0" step="0.01" placeholder="{{__('Quantity')}}" name="min_buy" value="{{$coupon->quantity}}" class="form-control" required>
    </div>
 </div>

<div class="form-group">
    <label class="col-lg-3 control-label">{{__('Description')}}</label>
    <div class="col-lg-9">
    <textarea name="description" id="" cols="30" class="form-control" rows="10" >{{$coupon->description}}</textarea>
    </div>
</div>
<script type="text/javascript">

    $(document).ready(function(){
        $('.demo-select2').select2();
    });

    function typeOfForm(){
        var type_value = $('#type').val();
        if(type_value == 'product'){
            $('#siteWise').css('display','none');
            $('#productOne').toggle();
        }else{
            $('#siteWise').toggle();
            $('#productOne').css('display','none');
        }
    }

</script>
