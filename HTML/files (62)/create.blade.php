@extends('layouts.app')

@section('content')

@section('styles')
    <style>
        .border{
            border: 1px dashed gray;
            padding:14px;
            margin-bottom: 5px;
        }
    </style>
@endsection
<div class="col-lg-6 col-lg-offset-3">
    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title">{{__('Shipping Information')}}</h3>
        </div>

        <!--Horizontal Form-->
        <!--===================================================-->
        <form class="form-horizontal" action="{{ route('admin.store-shipping') }}" method="POST" enctype="multipart/form-data">
        	@csrf
            <div class="panel-body">
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="name">{{__('Type')}}</label>
                    <div class="col-sm-9">
                         <select name="type" class="form-control" onchange="shippingType(this)">
                           <option value="courier">Courier Shipping</option>
                           @if(!App\Shipping::where('type','free')->first())<option value="free">Free Shipping</option>@endif
                           @if(!App\Shipping::where('type','flat_rate')->first())<option value="flat_rate">Flat Rate Shipping</option>@endif
                         </select>
                    </div>
                </div>
             <div id="shipping_type"> 
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="name">{{__('Name')}}</label>
                    <div class="col-sm-9">
                        <input type="text" placeholder="{{__('Name')}}" id="name" name="name" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="extra">{{__('Extra')}}</label>
                    <div class="col-sm-9">
                        <input type="text" placeholder="{{__('Extra')}}" id="extra" name="extra" class="form-control" >
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="price">{{__('Premium')}}</label>
                    <div class="col-sm-9">
                        <label class="switch">
                            <input type="checkbox" name="premium" id="premium" onchange="premium_update(this)">
                            <span class="slider round"></span>
                        </label>
                    </div>
                </div>
                <div class="without_premium" id="without_premium">
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="url">{{__('Url')}}</label>
                        <div class="col-sm-9">
                            <input type="url" placeholder="{{__('Url')}}" id="url" name="url" class="form-control">
                        </div>
                    </div>
                </div>
	      </div>
                <div id="non-premium" class="mb-5">
                    <div class="border">
                        No # 1
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="date">{{__('Dates')}}</label>
                            <div class="col-sm-9">
                                <select name="date[]" class="form-control" id="date" required>
                                    <option value="Mon">Monday</option>
                                    <option value="Tue">Tuesday</option>
                                    <option value="Wed">Wednesday</option>
                                    <option value="Thu">Thursday</option>
                                    <option value="Fri">Friday</option>
                                    <option value="Sat">Saturtday</option>
                                    <option value="Sun">Sunday</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="shipped">{{__('Shipped by')}}</label>
                            <div class="col-sm-9">
                                <select name="shipped[]" class="form-control" id="shipped" required>
                                    <option value="same_date">Same Date</option>
                                    <option value="Mon">Monday</option>
                                    <option value="Tue">Tuesday</option>
                                    <option value="Wed">Wednesday</option>
                                    <option value="Thu">Thursday</option>
                                    <option value="Fri">Friday</option>
                                    <option value="Sat">Saturtday</option>
                                    <option value="Sun">Sunday</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="at">{{__('At')}}</label>
                            <div class="col-sm-9">
                                <input type="time" id="at" name="at[]" required class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="day_by">{{__('Delivery Time')}}</label>
                            <div class="col-sm-4">
                                <input type="number" placeholder="{{__('Day by')}}" id="day_by" name="day_by[]" class="form-control">
                            </div>
                            <label class="col-sm-1 control-label" for="day_to">{{__('#')}}</label>
                            <div class="col-sm-4">
                                <input type="number" placeholder="{{__('Day to')}}" id="day_to" name="day_to[]" class="form-control">
                            </div>
                        </div>
                    </div>
                   </div>
                <button type="button" class="btn btn-sm btn-primary pull-right" onclick="addMoreShipping()">Add more</button>


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
    function premium_update(el){
            if(el.checked){
                $('#non-premium').fadeOut();
            }else{
                $('#non-premium').fadeIn();
            }
        }
var addMoreShip = 2;
        function addMoreShipping(){
            data = `
            <div class="border">
                        No # ${addMoreShip}
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="date_${addMoreShip}">{{__('Dates')}}</label>
                            <div class="col-sm-9">
                                <select name="date[]" class="form-control" id="date_${addMoreShip}" required>
                                    <option value="Mon">Monday</option>
                                    <option value="Tue">Tuesday</option>
                                    <option value="Wed">Wednesday</option>
                                    <option value="Thu">Thursday</option>
                                    <option value="Fri">Friday</option>
                                    <option value="Sat">Saturtday</option>
                                    <option value="Sun">Sunday</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="shipped_${addMoreShip}">{{__('Shipped by')}}</label>
                            <div class="col-sm-9">
                                <select name="shipped[]" class="form-control" id="shipped_${addMoreShip}" required>
                                    <option value="same_date">Same Date</option>
                                    <option value="Mon">Monday</option>
                                    <option value="Tue">Tuesday</option>
                                    <option value="Wed">Wednesday</option>
                                    <option value="Thu">Thursday</option>
                                    <option value="Fri">Friday</option>
                                    <option value="Sat">Saturtday</option>
                                    <option value="Sun">Sunday</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="at_${addMoreShip}">{{__('At')}}</label>
                            <div class="col-sm-9">
                                <input type="time" id="at_${addMoreShip}" name="at[]" required class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="day_by_${addMoreShip}">{{__('Delivery Time')}}</label>
                            <div class="col-sm-4">
                                <input type="number" placeholder="{{__('Day by')}}" id="day_by_${addMoreShip}" name="day_by[]" class="form-control">
                            </div>
                            <label class="col-sm-1 control-label" for="day_to_${addMoreShip}">{{__('#')}}</label>
                            <div class="col-sm-4">
                                <input type="number" placeholder="{{__('Day to')}}" id="day_to_${addMoreShip}" name="day_to[]" class="form-control">
                            </div>
                        </div>
                    </div>
            `;

            $('#non-premium').append(data);
            addMoreShip++;
        }
        
        function shippingType(el){
        
        if(el.value=='courier'){
           $('#shipping_type').fadeIn();
        }else
          $('#shipping_type').fadeOut();
        }
</script>

@endsection
