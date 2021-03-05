@extends('layouts.app')

@section('content')

    <div class="col-lg-12">
        <div class="panel">
            <div class="panel-heading">
		 <h3 class="panel-title">{{__('Seller Max Limit')}}</h3>
	   </div>
	        <div class="panel-body">
	         <form method="GET" action="">
	           <input name="search" placeholder="Type & Search" value="@isset($sort_search){{$sort_search }}@endisset" class="form-control pull-right" style="width:25%">
		</form>	
			   <div class="tab-base">
				    <!--Nav tabs-->
				    <ul class="nav nav-tabs">
				        <li class="">
				            <a data-toggle="tab" href="#demo-stk-lft-tab-1" aria-expanded="true">{{__('Requests')}}</a>
				        </li>
                        		<li class="active">
				            <a data-toggle="tab" href="#demo-stk-lft-tab-2" aria-expanded="false">{{__('Set MaxLimit')}}</a>
				        </li>
				    </ul>

				    <!--Tabs Content-->
				    <div class="tab-content">
				    
				        <div id="demo-stk-lft-tab-1" class="tab-pane fade active in">
                            <table class="table table-striped res-table mar-no" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th width="20%">{{__('Seller Name')}}</th>
                                        <th width="20%">{{__('Email')}}</th>
                                        <th>{{__('Current Limit')}}</th>
                                        <th>{{__('Total Sold')}}</th>
                                        <th>{{__('Message')}}</th>
                                        <th>{{__('Options')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($PermissionsLimit as $key=>$permission_limit)
                                    @php
                                    $total_sales = 0;
                                         foreach (\App\OrderDetail::where('seller_id',$permission_limit->user->id)->get() as $orderDetail) { if($orderDetail->order->payment_status == 'paid'){$total_sales += ($orderDetail->price  + $orderDetail->shipping_cost); }}

                                     @endphp
                                       <td>{{$key+1}}</td>
                                       <td>{{$permission_limit->user->name}}</td>
                                       <td>{{$permission_limit->user->email}}</td>
                                       <td>{{$permission_limit->user->seller->max_limit}}</td>
                                       <td>{{$total_sales }}</td>
                                       <td>{{$permission_limit->message}}</td>
                                       <td>
                                        <div class="btn-group dropdown">
                                            <button class="btn btn-primary dropdown-toggle dropdown-toggle-icon" data-toggle="dropdown" type="button">
                                                {{__('Actions')}} <i class="dropdown-caret"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-right">
                                                @if(permission_check_all('permission_limits') || permission_check_put('permission_limits') || permission_check_all('products') || permission_check_put('products') )
                                                    <li><a href="#" onclick="approveLimit({{$permission_limit->user->seller->max_limit}} , {{$permission_limit->user->id}})"  data-toggle="modal" data-target="#approve"> {{__('Approve')}}</a></li>
                                                @endif
                                                @if(permission_check_all('permission_limits') || permission_check_delete('permission_limits') || permission_check_all('products') || permission_check_delete('products') )
                                                    <li><a onclick="confirm_modal('{{route('permission_limit.destroy', $permission_limit->id)}}');">{{__('Delete')}}</a></li>
                                                @endif
                                            </ul>
                                        </div>
                                       </td>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="clearfix">
                                <div class="pull-right">
                                    {{ $PermissionsLimit->links() }}
                                </div>
                            </div>
                        </div>
				        <div id="demo-stk-lft-tab-2" class="tab-pane fade">
                            <form class="form-horizontal" action="{{ route('business_settings.max_limit_post') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="panel-body">
                                
                                    <div class="row">
                                        <div class="col-lg-3">
                                        <label class="control-label">{{__('Max Limit')}}</label>
                                        </div>
                                        <div class="col-lg-9">
                                            <input  class="form-control" type="number"  min="0" name="max_limit"  value="{{get_setting('max_limit')}}"> 
                                        </div>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <button class="btn btn-purple" type="submit">{{__('Save')}}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>    
        </div>
    </div>

    <div class="modal fade" id="approve" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <form action="{{route('permission_limit.approve')}}" method="POST" >
           @csrf
            <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Approve Max Limit</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="form-group">
                  <label for="">New Seller Limit</label>
                  <input type="number" name="new_limit" id="old_limit" class="form-control">
                  <input type="hidden" name="user_id" id="seller_id" class="form-control"></div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Save</button>
            </div>
          </div>
        </form>
        </div>
      </div>
@endsection

@section('script')
    <script>
       function approveLimit(limit , id){
            $('#old_limit').val(limit);
            $('#seller_id').val(id);
        }
    </script>
@endsection
