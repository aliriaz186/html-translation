
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
     @if(is_null($api_id))
        @forelse($ShippingApi as $key=>$api)
	        <tr>
	        
	            <td class="table_design">{{ucfirst(str_replace('_',' ',$api->Tables_in_rizwan))}}</td>
	                 <td>
	                     <input type="checkbox" style="margin-left:34%" name="all[]" value="{{$api->Tables_in_rizwan}}" id="all--{{$key}}"  onchange="all_select(this,{{$key}})">
	                 </td>
	                 <td>
	                     <input type="checkbox" style="margin-left:34%" name="get[]" value="{{$api->Tables_in_rizwan}}" id="get--{{$key}}"  >
	                 </td>
	                 <td>
	                     <input type="checkbox" style="margin-left:34%" name="put[]" value="{{$api->Tables_in_rizwan}}"  id="put--{{$key}}" >
	                 </td>
	                 <td>
	                     <input type="checkbox" style="margin-left:34%" name="post[]" value="{{$api->Tables_in_rizwan}}" id="post--{{$key}}" >
	                 </td>
	                 <td>
	                     <input type="checkbox" style="margin-left:34%" name="delete[]" value="{{$api->Tables_in_rizwan}}" id="delete--{{$key}}"  >
	                 </td>
	     </tr>
	@empty
	        <tr>
	        
	            <td class="table_design">Nothing Found!</td>
	                 
	        </tr>
        @endforelse
        @else
        
                @php
                $data = App\ShippingApi::findOrFail($api_id);
                            $all = json_decode($data->all);
                            $get = json_decode($data->get);
                            $put = json_decode($data->put);
                            $post = json_decode($data->post);
                            $delete = json_decode($data->delete);
                        @endphp
                        
        @forelse ($ShippingApi as $key=>$table)
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
        @empty
            <tr>
                    
                <td class="table_design">Nothing Found!</td>
                    
            </tr>                     
        @endforelse
        @endif
    </tbody>
</table>