@extends('layouts.app')

@section('content')
@if(permission_check_all('lotteries') || permission_check_post('lotteries') )
<div class="row">
    <div class="col-sm-12">
        <a href="{{ route('spin2win.create')}}" class="btn btn-rounded btn-info pull-right">
            {{__('Create Spin 2 Win')}}
        </a>
    </div>
</div>
@endif
<br>

<div class="panel">
    <div class="panel-heading bord-btm clearfix pad-all h-100">
        <h3 class="panel-title pull-left pad-no">{{__('Spin 2 Win')}}</h3>
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
                    <th>{{__('Status')}}</th>
                    <th>{{__('S.Date')}}</th>
                    <th>{{__('E.Date')}}</th>
                    <th>{{__('Product')}}</th>
                    <th>{{__('Owner Reward')}}</th>
                    <th>{{__('Amount')}}</th>
                    <th width="10%">{{__('Options')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($lotteries as $key=>$lottery)
                    <tr>
                        <td>{{$key+1}}</td>
                        <td>
                            <label class="switch">
                               <input type="checkbox" {{$lottery->status == 1?'checked':''}} onchange="lotteryChange({{$lottery->id}})">
                               <span class="slider round"></span>
                          </label>
                        </td>
                        <td>{{$lottery->start_date}}</td>
                        <td>{{$lottery->end_date}}</td>
                        <td>
                            <div style="display: flex !important;">
                                @if(isset($lottery->product_image))
                                    @foreach(json_decode($lottery->product_image) as $image)
                                    <a target="_blank" class="media-block">
                                        <div class="media-left">
                                            <img loading="lazy"  class="img-md" src="{{ asset($image)}}" alt="Image">
                                        </div>
                                    </a>
                                    @endforeach
                            @endif
                            </div>
                        </td>
                        <td>{{$lottery->reward==''?'Not get yet':$lottery->reward}}</td>
                        <td>{{$lottery->amount}}</td>
                        <td>
                            <div class="btn-group dropdown">
                                <button class="btn btn-primary dropdown-toggle dropdown-toggle-icon" data-toggle="dropdown" type="button">
                                    {{__('Actions')}} <i class="dropdown-caret"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-right">
                                @if(permission_check_all('lotteries') || permission_check_put('lotteries') )
                                    <li><a href="{{route('spin2win.edit', $lottery->id)}}">{{__('Edit')}}</a></li>
                                @endif
                                @if(permission_check_all('lotteries') || permission_check_delete('lotteries') )
                                    <li><a onclick="confirm_modal('{{route('spin2win.destroy', $lottery->id)}}');">{{__('Delete')}}</a></li>
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

<script>
    function lotteryChange(id){

        $.post('{{ route('admin.spin2win.status')}}',{_token:'{{ @csrf_token() }}' , id:id}, function(data){
                window.location.reload();
        });
    }
</script>
@endsection


