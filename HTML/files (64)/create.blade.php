@extends('layouts.app')

@section('content')

<div class="col-lg-6 col-lg-offset-3">
    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title">{{__('Shipping Date')}}</h3>
        </div>

        <!--Horizontal Form-->
        <!--===================================================-->
        <form class="form-horizontal" action="{{ route('admin.shipping-date.store') }}" method="POST" enctype="multipart/form-data">
        	@csrf
            <div class="panel-body">
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="name">{{__('Enable')}}</label>
                    <div class="col-sm-9" style="margin-top:10px">
                        <label class="switch">
                            <input type="checkbox" name="enable" onchange="updateSellerSettings()">
                            <span class="slider round"></span>
                      </label>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="date">{{__('Dates')}}</label>
                    <div class="col-sm-9">
                        <select name="date" class="form-control" id="date" required>
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
                    <label class="col-sm-3 control-label" for="shipped">{{__('Shipped')}}</label>
                    <div class="col-sm-9">
                        <select name="shipped" class="form-control" id="shipped" required>
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
                        <input type="time" id="at" name="at" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="message_before">{{__('Message before')}}</label>
                    <div class="col-sm-9">
                        <textarea name="message_before" id="message_before" class="form-control editor" required  rows="4" placeholder="Message">Order within the next #timer# so your order is delivered tomorrow</textarea>
                    </div>
                </div>
                <button type="button" class="btn btn-sm btn-danger pull-right" onclick="AddSecond()">Add dump</button> <br> <br>
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="message_after">{{__('Message after')}}</label>
                    <div class="col-sm-9">
                        <textarea name="message_after" id="message_after" class="form-control editor" required  rows="4" placeholder="Message">Order within the next #timer# so your order is delivered tomorrow</textarea>
                    </div>
                </div>
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
<script type="text/javascript">


function AddFirst(){
    console.log(1);
    document.getElementById('message_before').innerHTML = 'Rizwan';
}

function AddFirst(){
    console.log(1);
    document.getElementById('message_after').innerHTML = 'Rizwnnnnnnnnnnnnnnnnnnnnan';
}

 </script>
