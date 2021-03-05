@extends('layouts.app')

@section('content')

<div class="col-lg-12">
    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title">{{__('Role Information')}}</h3>
        </div>

        <!--Horizontal Form-->
        <!--===================================================-->
        <form class="form-horizontal" action="{{ route('roles.update', $role->id) }}" method="POST" enctype="multipart/form-data">
            <input name="_method" type="hidden" value="PATCH">
        	@csrf
            <div class="panel-body">
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="name">{{__('Name')}}</label>
                    <div class="col-sm-9">
                        <input type="text" placeholder="{{__('Name')}}" id="name" name="name" class="form-control" value="{{ $role->name }}" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="message_before">{{__('Permissions')}}</label>
                    <div class="col-sm-9">
                        <div class="alert alert-info"> <i class="fa fa-info"></i>  Set the resource permissions for this key:</div>
                    </div>
                </div>
                <div class="form-group">
                    <a class="btn btn-sm btn-danger pull-right" onclick="deselectAll()">Deselect All</a>
                    <a class="btn btn-sm btn-primary pull-right" style="margin-right:13px;" onclick="selectAll()">Select All</a>
                </div>
                <div class="form-group" style="margin-left: 130px;margin-right:50px;">
                <table class="table" style="">
                    <thead>
                        <th></th>
                        <th  style="font-weight: normal;font-size:13px">All</th>
                        <th  style="font-weight: normal;font-size:13px">View(GET)</th>
                        <th  style="font-weight: normal;font-size:13px">Modify(PUT)</th>
                        <th  style="font-weight: normal;font-size:13px">Add(POST)</th>
                        <th  style="font-weight: normal;font-size:13px">Delete(DELETE)</th>
                    </thead>
                    <tbody>
                        @php
                        $all = json_decode($role->permissions_all);
                        $get = json_decode($role->permissions_get);
                        $put = json_decode($role->permissions_put);
                        $post = json_decode($role->permissions_post);
                        $delete = json_decode($role->permissions_delete);

                    @endphp

                        @php $tables = DB::select('SHOW TABLES')@endphp
                        @foreach ($tables as $key_main=>$table)
                <tr>
                            <td style="font-size:12px">{{$table->Tables_in_rizwan}}</td>
                            <td>
                                @php $all_find=true; @endphp
                                @foreach($all as $key=>$a )
                                    @if($a == $table->Tables_in_rizwan)
                                        @php $all_find=false; @endphp
                                            <input type="checkbox" id="all{{$key_main}}" name="all[]" value="{{$table->Tables_in_rizwan}}" checked style="margin-left: 10px">
                                    @endif
                                @endforeach
                                @if($all_find)
                                    <input type="checkbox" name="all[]" id="all{{$key_main}}" value="{{$table->Tables_in_rizwan}}" style="margin-left: 10px">
                                @endif
                            </td>
                            <td>
                                @php $get_find=true; @endphp
                                @foreach($get as $g )
                                    @if($g == $table->Tables_in_rizwan)
                                                @php $get_find=false; @endphp
                                            <input type="checkbox" name="get[]" id="get{{$key_main}}" value="{{$table->Tables_in_rizwan}}" checked style="margin-left: 10px">
                                    @endif
                                @endforeach
                                @if($get_find)
                                <input type="checkbox" name="get[]" id="get{{$key_main}}" value="{{$table->Tables_in_rizwan}}" style="margin-left: 10px">
                                @endif
                            </td>
                            <td>
                                @php $pur_find=true; @endphp
                                @foreach($put as $pu)
                                    @if($pu == $table->Tables_in_rizwan)
                                                @php $pur_find=false; @endphp
                                            <input type="checkbox" name="put[]" id="put{{$key_main}}" value="{{$table->Tables_in_rizwan}}" checked style="margin-left: 10px">
                                    @endif
                                @endforeach
                                @if($pur_find)
                                <input type="checkbox" name="put[]" id="put{{$key_main}}" value="{{$table->Tables_in_rizwan}}" style="margin-left: 10px">
                                @endif
                            </td>
                            <td>
                                @php $post_find=true; @endphp
                                @foreach($post as $po )
                                @if($po == $table->Tables_in_rizwan)
                                            @php $post_find=false; @endphp
                                        <input type="checkbox" name="post[]" id="post{{$key_main}}" value="{{$table->Tables_in_rizwan}}" checked style="margin-left: 10px">
                                @endif
                                @endforeach
                                @if($post_find)
                                    <input type="checkbox" name="post[]" id="post{{$key_main}}" value="{{$table->Tables_in_rizwan}}" style="margin-left: 10px">
                                @endif
                            </td>
                            <td>
                                @php $delete_find=true; @endphp
                                @foreach($delete as $d )
                                @if($d == $table->Tables_in_rizwan)
                                        @php $delete_find=false; @endphp
                                        <input type="checkbox" name="delete[]" id="delete{{$key_main}}" value="{{$table->Tables_in_rizwan}}" checked style="margin-left: 10px">
                                @endif
                                @endforeach
                                @if($delete_find)
                                    <input type="checkbox" name="delete[]" id="delete{{$key_main}}" value="{{$table->Tables_in_rizwan}}" style="margin-left: 10px">
                                @endif
                            </td>
                        </tr>
                        @endforeach
                        @php
                        $extras = ['inhouse_orders','inhouse_products' , 'duplicate','bulk_upload', 'export_product' , 'sales','SMTP'];
                        $extras_number = [117,118,119,120,121,122,123];
                        @endphp
                        @foreach ($extras as $key=>$extra)
                    <tr>
                        <td style="font-size:12px">{{$extras[$key]}}</td>
                        <td>
                            @php $all_find=true; @endphp
                            @foreach($all as $d )
                            @if($d == $extras[$key])
                                    @php $all_find=false; @endphp
                                    <input type="checkbox" name="all[]" id="all{{$extras_number[$key]}}" value="{{$extras[$key]}}" checked style="margin-left: 10px">
                            @endif
                            @endforeach
                            @if($all_find)
                                <input type="checkbox" name="all[]" id="all{{$extras_number[$key]}}" value="{{$extras[$key]}}" style="margin-left: 10px">
                            @endif
                        </td>
                        <td>
                            @php $get_find=true; @endphp
                            @foreach($get as $d )
                            @if($d == $extras[$key])
                                    @php $get_find=false; @endphp
                                    <input type="checkbox" name="get[]" id="get{{$extras_number[$key]}}" value="{{$extras[$key]}}" checked style="margin-left: 10px">
                            @endif
                            @endforeach
                            @if($get_find)
                                <input type="checkbox" name="get[]" id="get{{$extras_number[$key]}}" value="{{$extras[$key]}}" style="margin-left: 10px">
                            @endif
                        </td>
                        <td>
                            @php $put_find=true; @endphp
                            @foreach($put as $d )
                            @if($d == $extras[$key])
                                    @php $put_find=false; @endphp
                                    <input type="checkbox" name="put[]" id="put{{$extras_number[$key]}}" value="{{$extras[$key]}}" checked style="margin-left: 10px">
                            @endif
                            @endforeach
                            @if($put_find)
                                <input type="checkbox" name="put[]" id="put{{$extras_number[$key]}}" value="{{$extras[$key]}}" style="margin-left: 10px">
                            @endif
                        </td>
                        <td>
                            @php $post_find=true; @endphp
                            @foreach($post as $d )
                            @if($d == $extras[$key])
                                    @php $post_find=false; @endphp
                                    <input type="checkbox" name="post[]" id="post{{$extras_number[$key]}}" value="{{$extras[$key]}}" checked style="margin-left: 10px">
                            @endif
                            @endforeach
                            @if($post_find)
                                <input type="checkbox" name="post[]" id="post{{$extras_number[$key]}}" value="{{$extras[$key]}}" style="margin-left: 10px">
                            @endif
                        </td>
                        <td>
                            @php $delete_find=true; @endphp
                            @foreach($delete as $d )
                            @if($d == $extras[$key])
                                    @php $delete_find=false; @endphp
                                    <input type="checkbox" name="delete[]" id="delete{{$extras_number[$key]}}" value="{{$extras[$key]}}" checked style="margin-left: 10px">
                            @endif
                            @endforeach
                            @if($delete_find)
                                <input type="checkbox" name="delete[]" id="delete{{$extras_number[$key]}}" value="{{$extras[$key]}}" style="margin-left: 10px">
                            @endif
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
    <script>
        function all_data(el,id){
            if(el.checked==true){
                document.getElementById('get'+id).checked = true;
                document.getElementById('put'+id).checked = true;
                document.getElementById('post'+id).checked = true;
                document.getElementById('delete'+id).checked = true;
            }else{
                document.getElementById('get'+id).checked = false;
                document.getElementById('put'+id).checked = false;
                document.getElementById('post'+id).checked = false;
                document.getElementById('delete'+id).checked = false;
            }
        }

        function selectAll(){
            @foreach($tables as $key=>$table)
              document.getElementById('all'+{{$key}}).checked = true;
              document.getElementById('get'+{{$key}}).checked = true;
              document.getElementById('put'+{{$key}}).checked = true;
              document.getElementById('post'+{{$key}}).checked = true;
              document.getElementById('delete'+{{$key}}).checked = true;
            @endforeach

            @foreach($extras as $key=>$extra)
              document.getElementById('all'+{{$extras_number[$key]}}).checked = true;
              document.getElementById('get'+{{$extras_number[$key]}}).checked = true;
              document.getElementById('put'+{{$extras_number[$key]}}).checked = true;
              document.getElementById('post'+{{$extras_number[$key]}}).checked = true;
              document.getElementById('delete'+{{$extras_number[$key]}}).checked = true;
            @endforeach
        }


        function deselectAll(){
            @foreach($tables as $key=>$table)
              document.getElementById('all'+{{$key}}).checked = false;
              document.getElementById('get'+{{$key}}).checked = false;
              document.getElementById('put'+{{$key}}).checked = false;
              document.getElementById('post'+{{$key}}).checked = false;
              document.getElementById('delete'+{{$key}}).checked = false;
            @endforeach


            @foreach($extras as $key=>$extra)
              document.getElementById('all'+{{$extras_number[$key]}}).checked = false;
              document.getElementById('get'+{{$extras_number[$key]}}).checked = false;
              document.getElementById('put'+{{$extras_number[$key]}}).checked = false;
              document.getElementById('post'+{{$extras_number[$key]}}).checked = false;
              document.getElementById('delete'+{{$extras_number[$key]}}).checked = false;
            @endforeach

        }
    </script>
@endsection
