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
        <form class="form-horizontal" action="{{ route('shipping-api.store') }}" method="POST" enctype="multipart/form-data">
        	@csrf
            <div class="panel-body">
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="name">{{__('Status')}}</label>
                    <div class="col-sm-9" style="margin-top:10px">
                        <label class="switch">
                            <input type="checkbox" name="status">
                            <span class="slider round"></span>
                      </label>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="key">{{__('Key')}}</label>
                    <div class="col-sm-7">
                        <input name="key_generater" id="key" required placeholder="Press button to generate key" class="form-control">
                    </div>
                    <button type="button" class="col-sm-2 btn btn-danger" for="key" onclick="getRandomString(32)">{{__('Generate Key')}}</button>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="name">{{__('Private')}}</label>
                    <div class="col-sm-9" style="margin-top:10px">
                        <label class="switch">
                            <input type="checkbox" name="private">
                            <span class="slider round"></span>
                      </label>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="key_description">{{__('Type Of API')}}</label>
                    <div class="col-sm-9">
                     <input name="key_description" id="key_description" required placeholder="Message" class="form-control">
                    </div>
                </div>
                 <div class="form-group">
                    <label class="col-sm-3 control-label" for="key_description">{{__('Short Description')}}</label>
                    <div class="col-sm-9">
                     <input name="short_description" id="short_description" required placeholder="Short Description" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="message_before">{{__('Permissions')}}</label>
                    <div class="col-sm-9">
                        <div class="alert alert-info"> <i class="fa fa-info"></i>  Set the resource permissions for this key:</div>
                    </div>
                </div>
                <div>
                <input id="search_field" class="form-control" placeholder="Type & Search" name="search" style="width: 25%;float:right"> 
                  <button class="btn btn-primary" type="button" onclick="selectAll()" style="float:right;margin-right:1%">Select All</button>
                  <button class="btn btn-primary" type="button" onclick="deselectAll()" style="float:right;margin-right:1%">Deselect All</button>
                  
                </div>
                <div class="form-group" style="margin-left: 130px;margin-right:50px;" id="search">
                </div>
                <div class="form-group" style="margin-left: 130px;margin-right:50px;" id="search_without">
                <table class="table permissions">
                    <thead>
                        <th></th>
                        <th class="table_design">All</th>
                        <th class="table_design">View(GET)</th>
                        <th class="table_design">Modify(PUT)</th>
                        <th class="table_design">Add(POST)</th>
                        <th class="table_design">Delete(DELETE)</th>
                    </thead>
                    <tbody>
                        @php $tables = DB::select('SHOW TABLES')@endphp
                        @foreach ($tables as $key=>$table)
                        <tr>
                       		<td class="table_design">{{ucfirst(str_replace('_',' ',$table->Tables_in_rizwan))}}</td>
                                    <td>
                                        <input type="checkbox" style="margin-left:34%" name="all[]" value="{{$table->Tables_in_rizwan}}" id="all--{{$key}}"  onchange="all_select(this,{{$key}})">
                                    </td>
                                    <td>
                                        <input type="checkbox" style="margin-left:34%" name="get[]" value="{{$table->Tables_in_rizwan}}" id="get--{{$key}}"  >
                                    </td>
                                    <td>
                                        <input type="checkbox" style="margin-left:34%" name="put[]" value="{{$table->Tables_in_rizwan}}"  id="put--{{$key}}" >
                                    </td>
                                    <td>
                                        <input type="checkbox" style="margin-left:34%" name="post[]" value="{{$table->Tables_in_rizwan}}" id="post--{{$key}}" >
                                    </td>
                                    <td>
                                        <input type="checkbox" style="margin-left:34%" name="delete[]" value="{{$table->Tables_in_rizwan}}" id="delete--{{$key}}"  >
                                    </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
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
       $.get('{{ route('shipping-api-search') }}', {_token:'{{ csrf_token() }}', search:this.value}, function(data){
       if(data==0){
            $('#search').css('display','block'); $('#search').html(`
                <table class="table">
                    <thead>
                        <th></th>
                        <th class="table_design">All</th>
                        <th class="table_design">View(GET)</th>
                        <th class="table_design">Modify(PUT)</th>
                        <th class="table_design">Add(POST)</th>
                        <th class="table_design">Delete(DELETE)</th>
                    </thead>
                    <tbody>
                        <td class="table_design">Not Found!</td>
                    </tbody>
                 </table>
       `);
        $('#search_without').css('display','none');
       }
       else if(data==''){ $('#search').css('display','none'); $('#search_without').css('display','block');}
       
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