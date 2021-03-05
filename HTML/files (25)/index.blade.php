@extends('layouts.app')

@section('content')

@if(permission_check_all('forum') || permission_check_get('forum') )
<div class="row">
    <div class="col-sm-12">
        <a href="{{ route('forum.create')}}" class="btn btn-rounded btn-info pull-right">
            {{__('Add New')}}
        </a>
    </div>
</div>
@endif
<br>

<!-- Basic Data Tables -->
<!--===================================================-->
<div class="panel">
    <div class="panel-heading bord-btm clearfix pad-all h-100">
        <h3 class="panel-title pull-left pad-no">{{__('Forum')}}</h3>
        <div class="pull-right clearfix">
            <form class="" id="sort_forum" action="" method="GET">
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
                    <th width="10%">{{__('Options')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($forums as $key => $forum)
                    <tr>
                        <td>{{ ($key+1) + ($forums->currentPage() - 1)*$forums->perPage() }}</td>
                        <td>{{$forum->title}}</td>
                        <td>{{ $forum->created_at }}</td>
                        <td>
                            <div class="btn-group dropdown">
                                <button class="btn btn-primary dropdown-toggle dropdown-toggle-icon" data-toggle="dropdown" type="button">
                                    {{__('Actions')}} <i class="dropdown-caret"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-right">
                                    @if(permission_check_all('customer_offers') || permission_check_get('customer_offers') )
                                        <li><a href="{{route('forum.edit', encrypt($forum->id))}}">{{__('Edit')}}</a></li>
                                    @endif
                                    @if(permission_check_all('customer_offers') || permission_check_get('customer_offers') )
                                        <li><a onclick="confirm_modal('{{route('forum.destroy', $forum->id)}}');">{{__('Delete')}}</a></li>
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
                {{ $forums->appends(request()->input())->links() }}
            </div>
        </div>
    </div>
</div>

@endsection
@section('script')
    <script type="text/javascript">
        function forums(el){
            $('#forums').submit();
        }
    </script>
@endsection
