@extends('layouts.app')

@section('content')

@if(permission_check_all('news') || permission_check_get('news') )
<div class="row">
    <div class="col-sm-12">
        <a href="{{ route('news.create')}}" class="btn btn-rounded btn-info pull-right">
            {{__('Add News')}}
        </a>
    </div>
</div>
@endif
<br>

<!-- Basic Data Tables -->
<!--===================================================-->
<div class="panel">
    <div class="panel-heading bord-btm clearfix pad-all h-100">
        <h3 class="panel-title pull-left pad-no">{{__('News')}}</h3>
        <div class="pull-right clearfix">
            <form class="" id="sort_news" action="" method="GET">
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
                @foreach($news as $key => $v)
                    <tr>
                        <td>{{ ($key+1) + ($news->currentPage() - 1)*$news->perPage() }}</td>
                        <td>{{$v->title}}</td>
                        <td>
                            {{date('d m y, h:i:s', strtotime($v->created_at))}}
                            <!-- <img loading="lazy" class="img-md" src="{{ asset($v->image) }}" alt="{{$v->title}}"></td> -->
                        <td>
                            <div class="btn-group dropdown">
                                <button class="btn btn-primary dropdown-toggle dropdown-toggle-icon" data-toggle="dropdown" type="button">
                                    {{__('Actions')}} <i class="dropdown-caret"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-right">
                                    @if(permission_check_all('news') || permission_check_put('news') )
                                        <li><a href="{{route('news.edit', encrypt($v->id))}}">{{__('Edit')}}</a></li>
                                    @endif
                                    @if(permission_check_all('news') || permission_check_delete('news') )
                                        <li><a onclick="confirm_modal('{{route('news.destroy', $v->id)}}');">{{__('Delete')}}</a></li>
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
                {{ $news->appends(request()->input())->links() }}
            </div>
        </div>
    </div>
</div>

@endsection
@section('script')
    <script type="text/javascript">
        function sort_news(el){
            $('#sort_news').submit();
        }
    </script>
@endsection
