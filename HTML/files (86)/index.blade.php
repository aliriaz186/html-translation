@extends('layouts.app')

@section('content')

@if(permission_check_all('apply') || permission_check_post('apply') )
<div class="row">
    <div class="col-sm-12">
        <a href="{{ route('apply.create')}}" class="btn btn-rounded btn-info pull-right">{{__('Add New Apply')}}</a>
    </div>
</div>
@endif
<br>
<!-- Basic Data Tables -->
<!--===================================================-->
<div class="panel">
    <div class="panel-heading bord-btm clearfix pad-all h-100">
        <h3 class="panel-title pull-left pad-no">{{__('Apply')}}</h3>
        <div class="pull-right clearfix">
            <form class="" id="sort_pages" action="" method="GET">
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
                    <th>{{__('Title')}}</th>
                    <th>{{__('Date')}}</th>
                    <th>{{__('View')}}</th>
                    <th width="10%">{{__('Options')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($apply as $key => $val)
                    <tr>
                        <td>{{ ($key+1) + ($apply->currentPage() - 1)*$apply->perPage() }}</td>
                        <td>{{$val->title}}</td>
                        <td>
                            {{$val->created_at}}
                        </td>
                        @if(permission_check_all('apply') || permission_check_get('apply') )
                        <td>
                            <a href="{{route('apply.show', $val->slug)}}" class="btn btn-info" target="_blank">
                              View
                            </a>
                        </td>
                        @endif
                        <td>
                            <div class="btn-group dropdown">
                                <button class="btn btn-primary dropdown-toggle dropdown-toggle-icon" data-toggle="dropdown" type="button">
                                    {{__('Actions')}} <i class="dropdown-caret"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-right">
                                @if(permission_check_all('apply') || permission_check_post('apply') )
                                    <li><a href="{{route('apply.edit', encrypt($val->id))}}">{{__('Edit')}}</a></li>
                                @endif
                                @if(permission_check_all('apply') || permission_check_post('apply') )
                                    <li><a onclick="confirm_modal('{{route('apply.destroy', $val->id)}}');">{{__('Delete')}}</a></li>
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
                {{ $apply->appends(request()->input())->links() }}
            </div>
        </div>
    </div>
</div>

@endsection
@section('script')
    <script type="text/javascript">
        function sort_pages(el){
            $('#sort_pages').submit();
        }
    </script>
@endsection
