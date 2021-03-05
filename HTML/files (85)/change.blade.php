@extends('layouts.app')

@section('content')

    <!-- Basic Data Tables -->
    <!--===================================================-->
    <div class="panel">
        <div class="panel-heading bord-btm clearfix pad-all h-100">
            <h3 class="panel-title pull-left pad-no">{{__('API Change Requests')}}</h3>
            <div class="pull-right clearfix">
                <form class="" action="" method="GET">
                    <div class="box-inline pad-rgt pull-left">
                        <div class="" style="min-width: 200px;">
                            <input type="text" class="form-control"  id="search" name="search"@isset($sort_search) value="{{ $sort_search }}" @endisset placeholder="Type name or email & Enter">
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="panel-body">
            <table class="table table-striped res-table mar-no" cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th>#</th>
                    <th>{{__('Email Address')}}</th>
                    <th>{{__('API Key')}}</th>
                    <th>{{__('Reason')}}</th> 
                    <th width="10%">{{__('Options')}}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($change_apis as $key => $change_api)
                        <tr>
                            <td>{{ ($key+1)}}</td>
                            <td>{{$change_api->user->email}}</td>
                            <td>{{$change_api->api_key}}</td>
                            <td>{{$change_api->reason}}</td>
                            <td>
                                <div class="btn-group dropdown">
                                    <button class="btn btn-primary dropdown-toggle dropdown-toggle-icon" data-toggle="dropdown" type="button">
                                        {{__('Actions')}} <i class="dropdown-caret"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-right">
                                        @if(permission_check_all('api_users') || permission_check_put('api_users')  )
                                            <li class="cursor" data-toggle="modal" data-target="#change_modal"  onclick="show_change_modal({{$change_api->id}},'{{$change_api->api_key}}' , '{{$change_api->api->key_description}}' ,{{$change_api->user->id}} )"><a >{{__('Change')}}</a></li>
                                        @endif
                                        @if(permission_check_all('api_users') || permission_check_delete('api_users')  )
                                            <li class="cursor"><a onclick="confirm_modal('{{route('api-user-change-delete', $change_api->id)}}');">{{__('Delete')}}</a></li>
                                        @endif
                                    </ul>
                                </div>
                            </td>
                        </tr>
                @endforeach
                </tbody>
            </table>
            <div class="clearfix">
                <div class="pull-right">
                </div>
            </div>
        </div>
    </div>

    <div class="modal" id="change_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-zoom product-modal" id="modal-size" role="document">
            <div class="modal-content position-relative">
                <div class="modal-header">
                    <h5 class="modal-title strong-600 heading-5">{{__('Change Api')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="" action="{{ route('admin.change-api-save') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body gry-bg px-3 pt-3">
                       <div class="row form-group">
                         	<label class="col-md-3">Key Description</label>
                         	<div class="col-md-9">
                                    <input type="hidden" class="form-control mb-3" name="api_id" placeholder="Api id" id="api_id" required readonly>
                                    <input type="hidden" class="form-control mb-3" name="user_id" placeholder="User id" id="user_id" required readonly>
                                    <input type="text" class="form-control mb-3" name="api_key" placeholder="Api key Description" id="api_key_description" required readonly>
                                 </div>
                        </div>
                         <br>
                         <div class="row form-group">
                         	<label class="col-md-3">Api Key</label>
                         	<div class="col-md-9">
                               	    <input type="text" class="form-control mb-3" name="api_key" placeholder="Api key" id="api_key" required readonly>
                               </div>
                         </div>
                         <br>
                         <div class="row form-group">
                         	<label class="col-md-3">New Api Key</label>
                         	<div class="col-md-9">
                                    <select name="new_key" id="" class="form-control" required>
	                                <option value="selected" selected>{{ __('Type of Api') }}</option>
	                                @foreach (App\ShippingApi::where('status',1)->where('private',0)->get() as $SAI)
	                                    <option value="{{$SAI->key}}">{{$SAI->key}}</option>
	                                @endforeach
	                           </select>
                                     </div>
                         </div>
                         <br>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-link" data-dismiss="modal">{{__('Cancel')}}</button>
                        <button type="submit" class="btn btn-base-1 btn-primary">{{__('Change')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    

@endsection

@section('script')
<script type="text/javascript">

        function show_change_modal(api_id,api_key,api_key_description,user_id){
           
           $('#api_id').val(api_id);
           $('#user_id').val(user_id);
           $('#api_key').val(api_key);
            $('#api_key_description').val(api_key_description);
        }

     </script>

@endsection
