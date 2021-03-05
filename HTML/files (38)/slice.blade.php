
@extends('layouts.app')

    <style>
        .box_border{
            border: 1px dashed #e4dddd;
             padding: 10px;
        }
        </style>


@section('content')

<div class="col-lg-8 col-lg-offset-2">

    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title">{{__('Create Slicce')}}</h3>
        </div>

        <!--===================================================-->
        <form class="form-horizontal" action="{{ route('spin2win.slice.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="panel-body">
                <div id="box">
                        <div class="box_border">
                            <p>Slice #1</p>
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="name">{{__('Coupon Type')}}</label>
                            <div class="col-sm-9">
                                <select name="type[]" id="" class="form-control" onchange="change(this,1)">
                                    <option value="percentage">Percentage</option>
                                    <option value="fixed">Fixed</option>
                                    <option value="free_shipping">Free Shipping</option>
                                    <option value="gifts">Gifts</option>
                                    <option value="free">Free Offer</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group" id="gifts1" style="display: none">
                            <label class="col-sm-3 control-label" for="end_date">{{__('Gifts')}}</label>
                            <div class="col-sm-9">
                                <select name="gifts[][]" id="gif1" class="form-control demo-select2">
                                    @foreach ($gifts as $gift)
                                            <option value="{{$gift->id}}">{{$gift->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group" id="free_text1" style="display: none">
                            <label class="col-sm-3 control-label" for="end_date">{{__('Product Name')}}</label>
                            <div class="col-sm-9">
                                <input type="text" name="product_name[]" placeholder="Name which offer" class="form-control">
                            </div>
                        </div>
                        <div class="form-group" id="free_image1" style="display: none">
                            <label class="col-sm-3 control-label" for="end_date">{{__('Product Image')}}</label>
                            <div class="col-sm-9">
                                <input type="file" name="product_image[]">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="label">{{__('Label')}}</label>
                            <div class="col-sm-9">
                                <input type="text" name="label[]" class="form-control">
                            </div>
                        </div>
                        <div class="form-group" id="discount1">
                            <label class="col-sm-3 control-label" for="value">{{__('Discount')}}</label>
                            <div class="col-sm-8">
                                <input type="text" name="value[]" value="" class="form-control">
                                <input type="hidden" name="code[]" id="coupon1">
                            </div>
                            <div class="col-sm-1">
                                    <select class="demo-select2" name="discount_type[]">
                                       <option value="amount" >$</option>
                                       <option value="percent">%</option>
                                    </select>
                            </div>
                        </div>



                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="value">{{__('Win')}}</label>
                            <div class="col-sm-9">
                                    <select name="win[]" id="" class="form-control">
                                        <option value="true">True</option>
                                        <option value="false">False</option>
                                    </select>
                                </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">{{__('Gravity')}}</label>
                            <div class="col-sm-9">
                                <input type="number" min="0" max="100" name="gravity[]" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel-footer text-right">
                <button class="btn btn-info" type="button" onclick="addMore()">{{__('Add More')}}</button>
                <button class="btn btn-purple" type="submit">{{__('Save')}}</button>
            </div>
        </form>
        <!--===================================================-->
        <!--End Horizontal Form-->
    </div>
</div>

@endsection

@section('script')
<script type="text/javascript">


    document.getElementById('coupon1').value = randomNumberAndLetters(6);

    function randomNumberAndLetters(length) {
       var result           = '';
       var characters       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
       var charactersLength = characters.length;
       for ( var i = 0; i < length; i++ ) {
          result += characters.charAt(Math.floor(Math.random() * charactersLength));
       }
       return result;
    }

    var number = 2;

        $(document).ready(function(){
            $('.demo-select2').select2();
        });

    function change(e,key){
        selected_value = e.value;
         console.log(selected_value);
                if(selected_value == 'gifts'){
                    $('#gifts'+key).css('display','block');
                    $('#free_text'+key).css('display','none');
                    $('#free_image'+key).css('display','none');
                    $('#discount'+key).css('display','none');
                }else if (selected_value == 'free'){
                    $('#free_text'+key).css('display','block');
                    $('#free_image'+key).css('display','block');
                    $('#gifts'+key).css('display','none');
                    $('#discount'+key).css('display','none');
                }
                else{
                    $('#free_text'+key).css('display','none');
                    $('#free_image'+key).css('display','none');
                    $('#gifts'+key).css('display','none');
                    $('#discount'+key).css('display','block');
                }
          }




    function addMore(){
        var body = `
        <div class="box_border" style="margin-top:10px">
            <p>Slice #${number}</p>
        <div class="form-group">
                        <label class="col-sm-3 control-label" for="typr">{{__('Coupon Type')}}</label>
                        <div class="col-sm-9">
                            <select name="type[]" id="" class="form-control" onchange="change(this,${number})">
                                <option value="percentage">Percentage</option>
                                <option value="fixed">Fixed</option>
                                <option value="free_shipping">Free Shipping</option>
                                <option value="gifts">Gifts</option>
                                <option value="free">Free Offer</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group" id="free_text${number}" style="display: none">
                                <label class="col-sm-3 control-label" for="end_date">{{__('Product Name')}}</label>
                                <div class="col-sm-9">
                                    <input type="text" name="product_name[]" placeholder="Name which offer" class="form-control">
                                </div>
                            </div>
                            <div class="form-group" id="free_image${number}" style="display: none">
                                <label class="col-sm-3 control-label" for="end_date">{{__('Product Image')}}</label>
                                <div class="col-sm-9">
                                    <input type="file" name="product_image[]">
                                </div>
                            </div>
                    <div class="form-group" id="gifts${number}" style="display: none">
                        <label class="col-sm-3 control-label" for="gifts${number}">{{__('Gifts')}}</label>
                        <div class="col-sm-9">
                            <select name="gifts[][]" id="gifts${number}" class="form-control demo-select2">
                                @foreach ($gifts as $gift)
                                        <option value="{{$gift->id}}">{{$gift->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="label">{{__('Label')}}</label>
                        <div class="col-sm-9">
                            <input type="text" name="label[]" class="form-control" id="label">
                        </div>
                    </div>
                    <div class="form-group" id="free_text${number}" style="display: none">
                        <label class="col-sm-3 control-label" for="free_text${number}">{{__('Product Name')}}</label>
                           <div class="col-sm-9">
                               <input type="text" name="product_name[]" placeholder="Name which offer" class="form-control">
                           </div>
                    </div>
                    <div class="form-group" id="free_image${number}" style="display: none">
                        <label class="col-sm-3 control-label" for="free_image${number}">{{__('Product Image')}}</label>
                           <div class="col-sm-9">
                              <input type="file" name="product_image[]">
                          </div>
                    </div>
                    <div class="form-group" id="discount${number}">
                        <label class="col-sm-3 control-label">{{__('Discount')}}</label>
                        <div class="col-sm-8">
                            <input type="number" name="value[]" class="form-control">
                            <input type="hidden" name="code[]" id="coupon${number}">
                        </div>
                        <div class="col-sm-1">
                                    <select class="demo-select2" name="discount_type[]">
                                       <option value="amount" >$</option>
                                       <option value="percent">%</option>
                                    </select>
                            </div>
                    </div>
                    <div class="form-group">
                                <label class="col-sm-3 control-label" for="value">{{__('Win')}}</label>
                                <div class="col-sm-9">
                                        <select name="win[]" id="" class="form-control">
                                            <option value="true">True</option>
                                            <option value="false">False</option>
                                        </select>
                                    </div>
                            </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">{{__('Gravity')}}</label>
                        <div class="col-sm-9">
                            <input type="number" min="0" max="100" name="gravity[]" class="form-control">
                        </div>
                    </div>
                </div>
                </div>
        `;
        $('#box').append(body);
        document.getElementById(`coupon${number}`).value = randomNumberAndLetters(6);
        number++;

    }



    </script>
@endsection

