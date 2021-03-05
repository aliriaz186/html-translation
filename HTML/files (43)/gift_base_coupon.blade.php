<div class="panel-heading">
    <h3 class="panel-title">{{__('Add Your Gifts Base Coupon')}}</h3>
</div>
<div class="form-group">
    <label class="col-lg-3 control-label" for="coupon_code">{{__('Coupon code')}}</label>
    <div class="col-lg-9">
        <input type="text" placeholder="{{__('Coupon code')}}" id="coupon_code" name="code" class="form-control" required>
    </div>
</div>
<div class="form-group">
    <label class="col-lg-3 control-label" for="Type">{{__('Type')}}</label>
    <div class="col-lg-9">
        <select name="type" id="type"  class="form-control" onchange="typeOfForm()" >
            <option value="select" selected>{{__('Select Type')}}</option>
            <option value="product">{{__('Product')}}</option>
            <option value="sitewide">{{__('Site Wide')}}</option>
        </select>
    </div>
</div>

<div id="productOne" style="display: none">
    <div class="form-group ">
        <label class="col-lg-3 control-label">{{__('Product')}}</label>
        <div class="col-lg-9">
                <select name="products[]" id="products"  class="form-control demo-select2" multiple>
                    @foreach (App\Product::all() as $pr)
                        <option value="{{$pr->id}}">{{$pr->name}}</option>
                    @endforeach
                </select>
        </div>
     </div>

</div>

<div id="siteWise" style="display: none">
    <div class="form-group">
        <label class="col-lg-3 control-label">{{__('Minimum Order Amount')}}</label>
        <div class="col-lg-9">
           <input type="number" min="0" step="0.01" placeholder="{{__('Minimum Order Amount')}}" name="min_order" class="form-control" >
        </div>
     </div>
</div>

<div class="form-group">
    <label class="col-lg-3 control-label">{{__('Quantity')}}</label>
    <div class="col-lg-9">
       <input type="number" min="0" step="0.01" placeholder="{{__('Quantity')}}" name="quantity" class="form-control" required>
    </div>
 </div>

<div class="form-group">
    <label class="col-lg-3 control-label">{{__('Description')}}</label>
    <div class="col-lg-9">
        <textarea name="description" id="" cols="30" class="form-control" rows="10"></textarea>
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
