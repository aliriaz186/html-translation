<div class="panel-heading">
    <h3 class="panel-title">{{__('Add Your Saller Base Coupon')}}</h3>
</div>
<div class="form-group">
    <label class="col-lg-3 control-label" for="coupon_code">{{__('Coupon code')}}</label>
    <div class="col-lg-9">
        <input type="text" placeholder="{{__('Coupon code')}}" id="coupon_code" name="coupon_code" class="form-control" required>
    </div>
</div>


<div class="form-group">
    <label class="col-lg-3 control-label" for="saller">{{__('Sellers')}}</label>
    <div class="col-lg-9">
        <select class="demo-select2" name="seller_ids[]" onchange="selectSeller(this)" multiple>
            @foreach ($sellers as $sal)
                <option value="{{$sal->id}}">{{$sal->name}}</option>
            @endforeach

          </select>
    </div>
</div>

    <div class="">

        <div class="hide_custom">
        <div class="form-group">
            <label class="col-lg-3 control-label" for="options">{{__('Type')}}</label>
            <div class="col-lg-9">
                <input type="hidden" id="seller_id">
                <select name="option_type[]" class="form-control" onchange="option_type_fun(this)">
                    <option value="allMoney">{{__('money')}} {{currency_symbol()}} {{__('off all products')}}</option>
                    <option value="selectedMoney">{{__('money')}} {{currency_symbol()}} {{__('off selected products')}}</option>
                </select>
        </div>
        </div>

        <div class="hide_custom_product">
            <div class="product-choose">
            <div class="form-group " id="subcategory">
                <label class="col-lg-3 control-label">{{__('Select Products')}}</label>
                <div class="col-lg-9">
                <select class="form-control subcategory_id demo-select2 selected_products"  id="selectProducts" name="selectProducts[]" multiple>
                </select>
            </div>
        </div>
        </div>
        </div>
    </div>
</div>

<div class="form-group">
    <label class="col-lg-3 control-label">{{__('Quantity')}}</label>
    <div class="col-lg-9">
       <input type="number" min="0" placeholder="{{__('Quantity')}}" name="pr_qty" class="form-control" required>
    </div>
 </div>
<div class="form-group">
    <label class="col-lg-3 control-label" for="start_date">{{__('Date')}}</label>
    <div class="col-lg-9">
        <div id="demo-dp-range">
            <div class="input-daterange input-group" id="datepicker">
                <input type="text" class="form-control" name="start_date">
                <span class="input-group-addon">{{__('to')}}</span>
                <input type="text" class="form-control" name="end_date">
            </div>
        </div>
    </div>
</div>

<div class="form-group">
    <label class="col-lg-3 control-label">{{__('Minimum Shopping')}}</label>
    <div class="col-lg-9">
       <input type="number" min="0" step="0.01" placeholder="{{__('Minimum Shopping')}}" name="min_buy" class="form-control" required>
    </div>
 </div>
 <div class="form-group">
    <label class="col-lg-3 control-label">{{__('Discount')}}</label>
    <div class="col-lg-8">
       <input type="number" min="0" step="0.01" placeholder="{{__('Discount')}}" name="discount" class="form-control" required>
    </div>
    <div class="col-lg-1">
       <select class="demo-select2" name="discount_type">
          <option value="amount">{{currency_symbol()}}</option>
          <option value="percent">{{__('%')}}</option>
       </select>
    </div>
 </div>
 <div class="form-group">
    <label class="col-lg-3 control-label">{{__('Maximum Discount Amount')}}</label>
    <div class="col-lg-9">
       <input type="number" min="0" step="0.01" placeholder="{{__('Maximum Discount Amount')}}" name="max_discount" class="form-control" required>
    </div>
 </div>

 <div class="form-group">
    <label class="col-lg-3 control-label">{{__('Voucher')}}</label>
    <div class="col-lg-9">
        <label class="switch">
        <input  type="checkbox" name="voucher">
        <span class="slider round"></span></label>
    </div>
 </div>
 <div class="form-group">
    <label class="col-lg-3 control-label">{{__('Description')}}</label>
    <div class="col-lg-9">
       <textarea name="description" id="desc" cols="30" rows="10" class="form-control"></textarea>
    </div>
 </div>

<script>

    $(document).ready(function() {
        $('.hide_custom').hide();
        $('.hide_custom_product').hide();
    $('.selected_products').select2();
    $('.demo-select2').select2();

});

    function selectSeller(el){
        var seller_id = $(el).val();

    $('#seller_id').val(seller_id);
    $('.hide_custom').show();

    }

    function option_type_fun(el){
        $('.hide_custom_product').show();
        var seller_id = $('#seller_id').val();

       var length_string =   (seller_id.split(",").length - 1) ;

        $.get('{{ route('products.get_products_by_seller') }}',{_token:'{{ csrf_token() }}', seller_id:seller_id , length:length_string }, function(data){
            for(var j =0 ; j<length_string+1;j++){

                for (var i = 0; i < data[j].length; i++) {

                $('#selectProducts').append($('<option>', {
                    value: data[j][i].id,
                    text: data[j][i].name
                }));
            }
            }

        });

    }


    </script>

