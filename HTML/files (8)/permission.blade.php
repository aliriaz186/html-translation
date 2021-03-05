@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-sm-12">
     {{-- <a href="{{ route('permissions.create')}}" class="btn btn-rounded btn-info pull-right">{{__('Add New permission')}}</a> --}}
    </div>
</div>

<br>

<!-- Basic Data Tables -->
<!--===================================================-->
<div class="panel">
    <div class="panel-heading bord-btm clearfix pad-all h-100">
        <h3 class="panel-title pull-left pad-no">{{__('Classified Permissions Request')}}</h3>
        <div class="pull-right clearfix">
            <form class="" id="sort_permissions" action="" method="GET">
                <div class="box-inline pad-rgt pull-left">
                    <div class="" style="min-width: 200px;">
                        <input type="text" class="form-control" id="search" name="search"@isset($sort_search) value="{{ $sort_search }}" @endisset placeholder=" Type name & Enter">
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
                    <th>{{__('Email')}}</th>
                    <th>{{__('Icon')}}</th>
                  <!--   <th>{{__('Message')}}</th> -->
                    <td>{{__('Allow')}}</td>
                    <th width="10%">{{__('Options')}}</th>
                </tr>
            </thead>
            <tbody>

                @foreach($permissions as $key => $permission)
                <tr>
                    <td>{{ ($key+1) + ($permissions->currentPage() - 1)*$permissions->perPage() }}</td>
                    <td>{{__($permission->classifiedCategory->name)}}</td>
                    <td>{{__($permission->seller->email)}}</td>
                    <td><img loading="lazy"  class="img-xs" src="{{ asset($permission->classifiedCategory->icon) }}" alt="{{__('icon')}}"></td>
                  <!--  <td>{{__($permission->message)}}</td> -->
                    <td>
                        <label class="switch">
                        <input onchange="update_permission(this)" value="{{ $permission->id }}" type="checkbox" <?php if($permission->status == 1) echo "checked";?> >
                        <span class="slider round"></span></label>
                    </td>
                    <td>
                        <div class="btn-group dropdown">

                            <button class="btn btn-primary dropdown-toggle dropdown-toggle-icon" data-toggle="dropdown" type="button">
                                {{__('Actions')}} <i class="dropdown-caret"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-right">
                                @if(permission_check_all('permission_classified_sellers') || permission_check_delete('permission_classified_sellers'))
                                    <li><a onclick="confirm_modal('{{route('classified_categories.permission.delete', $permission->id)}}');">{{__('Delete')}}</a></li>
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
                <div class="clearfix">
                    <div class="pull-right">
                        {{ $permissions->appends(request()->input())->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
  <script>
        function update_permission(el){
            if(el.checked){
                var status = 1;
            }
            else{
                var status = 0;
            }
            $.get('{{ route('classified_categories.permission.status') }}', {_token:'{{ csrf_token() }}', id:el.value, status:status}, function(data){
                if(data == 1){
                    showAlert('success', 'Seller permissions Granted successfully');
                }
                else{
                    console.log(data);
                    showAlert('danger', 'Something went wrong');
                }
            });
        }
    </script>
@endsection
