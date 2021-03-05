@extends('layouts.app')

@section('content')

<div class="col-lg-12">
    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title">{{__('Loyalty Information')}}</h3>
        </div>        
        <form class="form-horizontal" action="{{ route('referral.update',$referral->id) }}" method="POST" enctype="multipart/form-data">
            <input name="_method" type="hidden" value="PATCH">
            @csrf
            <div class="panel-body">
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="taxes">{{__('Enable')}}</label>
                    <div class="col-sm-9">
                        <label class="switch">
                            <input type="checkbox" name="enable"  {{$referral->enable=='1'?'checked':''}}>
                            <span class="slider round"></span>
                        </label>
                    </div>
                </div>
                    <div class="input-group rafferal_admin_form_info" >
                        <span class="input-group-addon">{{__('Ratio')}}</span>
                        <input id="ratio" type="number" class="form-control" name="ratio" placeholder="£" value="{{$referral->ratio}}" required>
                        <span class="input-group-addon">{{__('= 1 reward point.')}}</span>
                      </div>
                    <br>
                    <div class="input-group rafferal_admin_form_info" >
                        <span class="input-group-addon">{{__('1 point = ')}}</span>
                        <input id="point" step="0.01" type="number" class="form-control" name="point"  placeholder="{{currency_symbol()}}"  value="{{$referral->point}}"  required>
                        <span class="input-group-addon">{{__('for the discount.')}}</span>
                    </div>
                    <br>

                    <div class="input-group rafferal_admin_form_info" >
                        <span class="input-group-addon">{{__('Validity period of a point')}}</span>
                        <input id="period" step="0.01" type="number" class="form-control" name="period"  placeholder="{{__('Period')}}"  value="{{$referral->period}}" >
                    </div>
                    <br>

                    <div class="input-group rafferal_admin_form_info" >
                        <span class="input-group-addon">{{__('Voucher details')}}</span>
                        <input id="voucher_details" step="0.1"  type="text" class="form-control" name="voucher_details"  placeholder="{{__('Voucher details')}}"  value="{{$referral->voucher_details}}"  required>

                    </div>
                    <br>

                    <div class="input-group rafferal_admin_form_info" >
                        <span class="input-group-addon">{{__('Amount/Points')}}</span>
                       <select name="selectType" class="form-control" onchange="amount_or_proints(this)">
                           <option value="selected">{{__('Plese select option')}}</option>
                           <option {{$referral->minimum_amount!=null?'selected':''}}  value="amount">{{__('Amount')}}</option>
                           <option {{$referral->minimum_point!=null?'selected':''}} value="point">{{__('Point')}}</option>
                       </select>
                    </div>
                    <br>
                    <div id="amount" class="rafferal_admin_form_info" style="{{$referral->minimum_amount==null?'display: none':''}}">
                        <div class="input-group" >
                            <span class="input-group-addon">{{__('Minimum Amount')}}</span>
                            <input id="minimum_amount" step="0.1"  type="number" class="form-control" name="minimum_amount" value="{{$referral->minimum_amount}}"  placeholder="{{__('Minimum amount')}}" >
                            <span class="input-group-addon">{{currency_symbol()}}</span>
                        </div>
                        <br>
                    </div>
                    <div id="point_1"class="rafferal_admin_form_info" style="{{$referral->minimum_point==null?'display: none':''}}">
                        <div class="input-group" >
                            <span class="input-group-addon">{{__('Minimum Points')}}</span>
                            <input id="minimum_point" step="0.1"  type="number" class="form-control" name="minimum_point" value="{{$referral->minimum_point}}"  placeholder="{{__('Minimum Points')}}" >
                            <span class="input-group-addon">{{__('Point')}}</span>
                        </div>
                        <br>
                    </div>


                    <div class="input-group rafferal_admin_form_info" >
                        <span class="input-group-addon">{{__('Apply taxes on the voucher')}}</span>
                        <label class="switch"  style="margin-top: 5px">
                            <input type="checkbox" name="taxes" {{$referral->taxes=='1'?'checked':''}}>
                            <span class="slider round"></span>
                        </label>
                    </div>
                    <br>

                <div class="input-group rafferal_admin_form_info" >
                    <span class="input-group-addon">{{__('Points are awarded when the order is')}}</span>
                    <select name="points_awarded" id="points_awarded" class="form-control"  required>
                        <option value="select" selected>Select The option</option>
                        <option value="pending" {{$referral->points_awarded=='pending'?'selected':''}} >{{__('Pending')}}</option>
                        <option value="on_review" {{$referral->points_awarded=='on_review'?'selected':''}}>{{__('On review')}}</option>
                        <option value="on_delivery" {{$referral->points_awarded=='on_delivery'?'selected':''}}>{{__('On delivery')}}</option>
                        <option value="delivered" {{$referral->points_awarded=='delivered'?'selected':''}}>{{__('Delivered')}}</option>
                        <option value="shipped" {{$referral->points_awarded=='shipped'?'selected':''}}>{{__('Shipped')}}</option>
                        <option value="cancelled" {{$referral->points_awarded=='cancelled'?'selected':''}}>{{__('Cancelled')}}</option>
                        <option value="refunded" {{$referral->points_awarded=='refunded'?'selected':''}}>{{__('Refunded')}}</option>
                        <option value="returned" {{$referral->points_awarded=='returned'?'selected':''}}>{{__('Returned')}}</option>
                    </select>
                </div>
                <br>

                <div class="input-group rafferal_admin_form_info" >
                    <span class="input-group-addon">{{__('Points are cancelled when the order is')}}</span>
                    <select name="points_cancelled" id="points_cancelled" class="form-control" required>
                        <option value="select" selected>{{__('Select The option')}}</option>
                        <option value="pending" {{$referral->points_cancelled=='pending'?'selected':''}}>{{__('Pending')}}</option>
                        <option value="on_review" {{$referral->points_cancelled=='on_review'?'selected':''}}>{{__('On review')}}</option>
                        <option value="on_delivery" {{$referral->points_cancelled=='on_delivery'?'selected':''}}>{{__('On delivery')}}</option>
                        <option value="delivered" {{$referral->points_cancelled=='delivered'?'selected':''}}>{{__('Delivered')}}</option>
                        <option value="shipped" {{$referral->points_cancelled=='shipped'?'selected':''}}>{{__('Shipped')}}</option>
                        <option value="cancelled" {{$referral->points_cancelled=='cancelled'?'selected':''}}>{{__('Cancelled')}}</option>
                        <option value="refunded" {{$referral->points_cancelled=='refunded'?'selected':''}}>{{__('Refunded')}}</option>
                        <option value="returned" {{$referral->points_cancelled=='returned'?'selected':''}}>{{__('Returned')}}</option>
                    </select>
                </div>
                <br>

                <div class="input-group rafferal_admin_form_info" >
                    <span class="input-group-addon">{{__('Give points on discounted products')}}</span>
                    <label class="switch" style="margin-top: 5px" >
                        <input type="checkbox" name="discounted" {{$referral->discounted=='1'?'checked':''}}>
                        <span class="slider round"></span>
                    </label>

                </div>
                <br>

                <div class="input-group rafferal_admin_form_info" >
                    <span class="input-group-addon">{{__('Vouchers created by the loyalty system can be used in the following categories:')}}</span>
                    <div class="">
                        <button class="btn btn-sm btn-primary mt-5" onclick="mark(1)" type="button">
                            {{__('Select All')}}
                       </button>
                       <button class="btn btn-sm btn-primary mt-5 " onclick="mark(0)" type="button">
                        {{__('Deselect All')}}
                      </button>
                    </div>
                </div>

                <div class="input-group rafferal_admin_form_info" >
                    <ul id="tree1" class="treeclass">
                        @foreach(App\Category::all() as $cat_key => $category)
                            <li>
                                    @php
                                     $selectedCategories = json_decode($referral->category);
                                     $selectedSubCategories = json_decode($referral->sub_category);
                                     $selectedSubSubCategories = json_decode($referral->sub_sub_category);
                                    @endphp
                                    <input type="checkbox" name="category[]" value="{{ $category->id }}" @if(in_array($category->id, $selectedCategories)) checked @endif>
                                    {{ $category->name }}
                                @if(count($category->subcategories))
                                <ul>
                                    @foreach($category->subcategories as $subcategories)
                                        <li>
                                            <input name="sub_category[]" value="{{  $subcategories->id }}"  type="checkbox" @if(in_array($subcategories->id, $selectedSubCategories)) checked @endif >
                                            {{ $subcategories->name }}
                                        @if(count($subcategories->subsubcategories))
                                        <ul>
                                            @foreach($subcategories->subsubcategories as $ssb)
                                                <li>
                                                    <input name="sub_sub_category[]" value="{{ $ssb->id }}" type="checkbox" @if(in_array($ssb->id, $selectedSubSubCategories)) checked @endif>
                                                    {{ $ssb->name }}
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
@endsection

@section('script')
<script>
        function amount_or_proints(el) {
            
            if(el.value == 'amount'){
                    $('#amount').css('display','block');
                    $('#point_1').css('display','none');
                }else if(el.value == 'point'){
                    $('#amount').css('display','none');
                    $('#point_1').css('display','block');
                }else{
                    $('#amount').css('display','none');
                    $('#point_1').css('display','none');
                }
        }

    $(document).ready(function(){
        $('.demo-select2').select2();
        amount_or_proints();
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
