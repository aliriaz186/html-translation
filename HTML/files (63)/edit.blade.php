@extends('layouts.app')
@section('content')
<style>
    .table_design{
    font-weight: normal;font-size:13px
    }
</style>
<div class="col-lg-11 col-lg-offset-1">
    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title">{{__('Shipping Api')}}</h3>
        </div>

        <!--Horizontal Form-->
        <!--===================================================-->
        <form class="form-horizontal" action="{{ route('shipping-api.update',$ShippingApi->id) }}" method="POST" enctype="multipart/form-data">
            <input name="_method" type="hidden" value="PATCH">
            @csrf
            <div class="panel-body">
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="name">{{__('Status')}}</label>
                    <div class="col-sm-9" style="margin-top:10px">
                        <label class="switch">
                            <input type="checkbox" name="status" {{$ShippingApi->status?'checked':''}}>
                            <span class="slider round"></span>
                      </label>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="key">{{__('Key')}}</label>
                    <div class="col-sm-7">
                          <input name="key_generater" id="key" value="{{$ShippingApi->key}}" required placeholder="Press button to generate key" class="form-control">
                    </div>
                    <button type="button" class="col-sm-2 btn btn-danger" for="key" onclick="getRandomString(32)">{{__('Generate Key')}}</button>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="key_description">{{__('Key Description')}}</label>
                    <div class="col-sm-9">
                        <textarea name="key_description" id="key_description"  class="form-control" required  rows="4" placeholder="Message">{{$ShippingApi->key_description}}
                        </textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="message_before">{{__('Permissions')}}</label>
                    <div class="col-sm-9">
                        <div class="alert alert-info"> <i class="fa fa-info"></i>  Set the resource permissions for this key:</div>
                    </div>
                </div>
                <div>
                    <input id="search_field" data-table-id = "{{$ShippingApi->id}}" class="form-control" placeholder="Type & Search" name="search" style="width: 25%;float:right"> 
                      <button class="btn btn-primary" type="button" onclick="selectAll()" style="float:right;margin-right:1%">Select All</button>
                      <button class="btn btn-primary" type="button" onclick="deselectAll()" style="float:right;margin-right:1%">Deselect All</button>
                    </div>
                    <div class="form-group" style="margin-left: 130px;margin-right:50px;" id="search">
                </div>
                <div class="form-group" style="margin-left: 130px;margin-right:50px;" id="search_without">
                    <table class="table permissions" style="">
                        <thead>
                            <th></th>
                            <th class="table_design">All</th>
                            <th class="table_design">View(GET)</th>
                            <th class="table_design">Modify(PUT)</th>
                            <th class="table_design">Add(POST)</th>
                            <th class="table_design">Delete(DELETE)</th>
                        </thead>
                        <tbody>
                            @php
                            $all = json_decode($ShippingApi->all);
                            $get = json_decode($ShippingApi->get);
                            $put = json_decode($ShippingApi->put);
                            $post = json_decode($ShippingApi->post);
                            $delete = json_decode($ShippingApi->delete);
                        @endphp

                            @php $tables = DB::select('SHOW TABLES')@endphp
                            @foreach ($tables as $key=>$table)
                            <tr>
                                <td class="table_design">{{ucfirst(str_replace('_',' ',$table->Tables_in_rizwan))}}</td>
                                        <td>
                                            @php $all_find=true; @endphp
                                            @foreach($all as $key=>$a )
                                                @if($a == $table->Tables_in_rizwan)
                                                    @php $all_find=false; @endphp
                                                    <input type="checkbox" name="all[]" value="{{$table->Tables_in_rizwan}}" checked style="margin-left: 10px">
                                                @endif
                                            @endforeach
                                            @if($all_find)
                                              <input type="checkbox" name="all[]" value="{{$table->Tables_in_rizwan}}" style="margin-left: 10px">
                                            @endif
                                        </td>
                                        <td>
                                            @php $get_find=true; @endphp
                                            @foreach($get as $g )
                                                @if($g == $table->Tables_in_rizwan)
                                                        @php $get_find=false; @endphp
                                                        <input type="checkbox" name="get[]" value="{{$table->Tables_in_rizwan}}" checked style="margin-left: 10px">
                                                @endif
                                            @endforeach
                                            @if($get_find)
                                            <input type="checkbox" name="get[]" value="{{$table->Tables_in_rizwan}}" style="margin-left: 10px">
                                        @endif
                                        </td>
                                        <td>
                                            @php $pur_find=true; @endphp
                                            @foreach($put as $pu)
                                                @if($pu == $table->Tables_in_rizwan)
                                                        @php $pur_find=false; @endphp
                                                        <input type="checkbox" name="put[]" value="{{$table->Tables_in_rizwan}}" checked style="margin-left: 10px">
                                                @endif
                                            @endforeach
                                            @if($pur_find)
                                               <input type="checkbox" name="put[]" value="{{$table->Tables_in_rizwan}}" style="margin-left: 10px">
                                            @endif
                                        </td>
                                        <td>
                                            @php $post_find=true; @endphp
                                            @foreach($post as $po )
                                                @if($po == $table->Tables_in_rizwan)
                                                        @php $post_find=true; @endphp
                                                        <input type="checkbox" name="post[]" value="{{$table->Tables_in_rizwan}}" checked style="margin-left: 10px">
                                                @endif
                                            @endforeach
                                            @if($pur_find)
                                                <input type="checkbox" name="post[]" value="{{$table->Tables_in_rizwan}}" style="margin-left: 10px">
                                            @endif
                                        </td>
                                        <td>
                                            @php $delete_find=true; @endphp
                                            @foreach($delete as $d )
                                                @if($d == $table->Tables_in_rizwan)
                                                        @php $delete_find=false; @endphp
                                                        <input type="checkbox" name="delete[]" value="{{$table->Tables_in_rizwan}}" checked style="margin-left: 10px">
                                                @endif
                                            @endforeach
                                            @if($delete_find)
                                                <input type="checkbox" name="delete[]" value="{{$table->Tables_in_rizwan}}" style="margin-left: 10px">
                                            @endif
                                        </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="panel-footer text-right">
                <button class="btn btn-purple" type="submit">{{__('Update')}}</button>
            </div>
        </form>
    </div>
</div>

@endsection

@section('script')
<script type="text/javascript">

function getRandomString(length) {
    var randomChars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    var result = '';
    for ( var i = 0; i < length; i++ ) {
        result += randomChars.charAt(Math.floor(Math.random() * randomChars.length));
    }
    document.getElementById('key').value = result;
}


function all_select(el,id_number){
	if(el.checked){
	$('#post--'+id_number).prop("checked",true);
	$('#delete--'+id_number).prop("checked",true);
	$('#get--'+id_number).prop("checked",true);
	$('#put--'+id_number).prop("checked",true);
	}else{
	$('#post--'+id_number).prop("checked",false);
	$('#delete--'+id_number).prop("checked",false);
	$('#get--'+id_number).prop("checked",false);
	$('#put--'+id_number).prop("checked",false);
	
	}
}


$("#search_field").keyup(function(el){
    data = $("#search_field").data('table-id');
    console.log(data);
       $.get('{{ route('shipping-api-search') }}', {_token:'{{ csrf_token() }}', search:this.value,api_id:data}, function(data){
   
   if(data==''){ $('#search').css('display','none'); $('#search_without').css('display','block');}
       
       else{        
            $('#search').css('display','block');
            $('#search').html(data);
            $('#search_without').css('display','none');
         }
            
        });
});

	function selectAll(){
		$('.permissions :checkbox').each(function() {
            this.checked = true;                        
        });
  }
	
	function deselectAll(){
	$('.permissions :checkbox').each(function() {
            this.checked = false;                        
        });
  }
 </script>
 @endsection
