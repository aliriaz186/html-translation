@extends('layouts.app')

@section('content')

<div class="col-lg-10 ">
    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title">{{__('Role Information')}}</h3>
        </div>

        <!--Horizontal Form-->
        <!--===================================================-->
        <form class="form-horizontal" action="{{ route('roles.store') }}" method="POST" enctype="multipart/form-data">
        	@csrf
            <div class="panel-body">
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="name">{{__('Name')}}</label>
                    <div class="col-sm-9">
                        <input type="text" placeholder="{{__('Name')}}" id="name" name="name" class="form-control" required>
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
                    <th>#</th>
                    <th>Table</th>
                    <th  style="font-weight: normal;font-size:13px">All</th>
                    <th  style="font-weight: normal;font-size:13px">View(GET)</th>
                    <th  style="font-weight: normal;font-size:13px">Modify(PUT)</th>
                    <th  style="font-weight: normal;font-size:13px">Add(POST)</th>
                    <th  style="font-weight: normal;font-size:13px">Delete(DELETE)</th>
                </thead>
                <tbody>
                    @php $tables = DB::select('SHOW TABLES')@endphp
                    @foreach ($tables as $key=>$table)

                    <tr>

                                <td>{{$key+1}}</td>
                                <td style="font-size:12px">{{$table->Tables_in_rizwan}}</td>
                                <td>
                                    <input type="checkbox"  id="all{{$key}}" onclick="all_data(this,{{$key}})"  name="all[]" value="{{$table->Tables_in_rizwan}}" style="margin-left: 10px">
                                </td>
                                <td>
                                    <input type="checkbox"  id="get{{$key}}" name="get[]" value="{{$table->Tables_in_rizwan}}" style="margin-left: 10px">
                                </td>
                                <td>
                                    <input type="checkbox"  id="put{{$key}}" name="put[]" value="{{$table->Tables_in_rizwan}}" style="margin-left: 10px">
                                </td>
                                <td>
                                    <input type="checkbox" id="post{{$key}}" name="post[]" value="{{$table->Tables_in_rizwan}}" style="margin-left: 10px">
                                </td>
                                <td>
                                    <input type="checkbox" id="delete{{$key}}" name="delete[]" value="{{$table->Tables_in_rizwan}}" style="margin-left: 10px">
                                </td>
                    </tr>
                    @endforeach

                    <tr> <td></td> <td></td> <td> Without</td> <td> table</td> <td></td> <td></td> <td></td></tr>
                    @php
                        $extras = ['inhouse_orders','inhouse_products' , 'duplicate','bulk_upload', 'export_product' , 'sales','SMTP'];
                        $extras_number = [117,118,119,120,121,122,123];
                        @endphp
                        @foreach ($extras as $key=>$extra)

                    <tr>
                        <td>{{$extras_number[$key]+1}}</td>
                        <td style="font-size:12px">{{$extras[$key]}}</td>

                        <td>
                            <input type="checkbox"  id="all{{$extras_number[$key]}}" onclick="all_data(this,{{$extras_number[$key]}})"  name="all[]" value="{{$extras[$key]}}" style="margin-left: 10px">
                        </td>

                        <td>
                            <input type="checkbox"  id="get{{$extras_number[$key]}}" name="get[]" value="{{$extras[$key]}}" style="margin-left: 10px">
                        </td>
                        <td>
                            <input type="checkbox"  id="put{{$extras_number[$key]}}" name="put[]" value="{{$extras[$key]}}" style="margin-left: 10px">
                        </td>
                        <td>
                            <input type="checkbox" id="post{{$extras_number[$key]}}" name="post[]" value="{{$extras[$key]}}" style="margin-left: 10px">
                        </td>
                        <td>
                            <input type="checkbox" id="delete{{$extras_number[$key]}}" name="delete[]" value="{{$extras[$key]}}" style="margin-left: 10px">
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
