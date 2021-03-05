@extends('layouts.app')

@section('content')


    <div class="row">
        <div class="col-sm-12">
            <a href="{{ route('api-user.create')}}" class="btn btn-rounded btn-info pull-right">{{__('Add New Api User')}}</a>
        </div>
    </div>

    <br>

    <!-- Basic Data Tables -->
    <!--===================================================-->
    <div class="panel">
        <div class="panel-heading bord-btm clearfix pad-all h-100">
            <h3 class="panel-title pull-left pad-no">{{__('API Users List')}}</h3>
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
                    <th>{{__('Name')}}</th>
                    <th>{{__('Phone')}}</th>
                    <th>{{__('Email Address')}}</th>
                    <th>{{__('API Key')}}</th>
                    <th>{{__('Status')}}</th> 
                    <th width="10%">{{__('Options')}}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($apiUsers as $key => $api_user)
                    @if($api_user->user != null)
                        <tr>
                            <td>{{ ($key+1) + ($apiUsers->currentPage() - 1)*$apiUsers->perPage() }}</td>
                            <td>{{$api_user->user->name}}</td>
                            <td>{{$api_user->user->phone}}</td>
                            <td>{{$api_user->user->email}}</td>
                            <td>{{$api_user->user->api_key}}</td>
    
                            <td>
                                @if(permission_check_all('api_users') || permission_check_post('api_users')  )
                                <label class="switch">
                                    <input type="checkbox" onchange="updateApiStatus({{$api_user->id}})" {{$api_user->status == 1 ? 'checked' : ''}}>
                                    <span class="slider round"></span>
                                </label>
                                @endif
                            </td>

                            <td>
                                <div class="btn-group dropdown">
                                    <button class="btn btn-primary dropdown-toggle dropdown-toggle-icon" data-toggle="dropdown" type="button">
                                        {{__('Actions')}} <i class="dropdown-caret"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-right">
                                      
                                        @if(permission_check_all('api_users') || permission_check_put('api_users')  )
                                            <li><a href="{{route('api-user.edit', encrypt($api_user->id))}}">{{__('Edit')}}</a></li>
                                        @endif
                                        @if(permission_check_all('api_users') || permission_check_delete('api_users')  )
                                            <li><a onclick="confirm_modal('{{route('api-user.destroy', $api_user->id)}}');">{{__('Delete')}}</a></li>
                                        @endif
                                        @if(permission_check_all('api_users') || permission_check_get('api_users')  )
                                            <li><a onclick="api_userLoginByAdmin({{$api_user->user_id}})" style="cursor: pointer">{{__('Login')}}</a></li>
                                        @endif
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    @endif
                @endforeach
                </tbody>
            </table>
            <div class="clearfix">
                <div class="pull-right">
                    {{ $apiUsers->appends(request()->input())->links() }}
                </div>
            </div>
        </div>
    </div>



@endsection

@section('script')
    <script type="text/javascript">

        
      function updateApiStatus(userId) {
            $.post('{{ route('api-user.admin.status_update') }}',{_token:'{{ @csrf_token() }}', id:userId}, function(data){
                var res = JSON.parse(data);
                if (res.status){
                    window.location.reload();
                }
            });
        }
       
    
       
        
    </script>
@endsection
