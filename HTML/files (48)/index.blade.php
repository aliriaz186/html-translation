@extends('layouts.app')

@section('content')

@if(permission_check_all('raffles') || permission_check_post('raffles') )
<div class="row">
    <div class="col-sm-12">
        <a href="{{ route('raffles.create')}}" class="btn btn-rounded btn-info pull-right">
            {{__('Create Raffle')}}
        </a>
    </div>
</div>
@endif
<br>

<div class="panel">
    <div class="panel-heading bord-btm clearfix pad-all h-100">
        <h3 class="panel-title pull-left pad-no">{{__('Raffle')}}</h3>
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
                    <th>{{__('#')}}</th>
                    <th>{{__('Status')}}</th>
                    <th>{{__('S.Date')}}</th>
                    <th>{{__('C.Date')}}</th>
                    <th>{{__('E.Date')}}</th>
                    <th>{{__('Product')}}</th>
                    <th>{{__('Products Show')}}</th>
                    <th>{{__('Owner Reward')}}</th>
                    <th width="10%">{{__('Options')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($raffles as $key=>$raffle)
                    <tr>
                        <td>{{$key+1}}</td>
                        <td>
                            <label class="switch">
                               <input type="checkbox" {{$raffle->status == 1?'checked':''}} onchange="RaffleChange({{$raffle->id}})">
                               <span class="slider round"></span>
                          </label>
                        </td>
                        <td>{{$raffle->start_date}}</td>
                        <td>{{$raffle->cutoff_date}}</td>
                        <td>{{$raffle->end_date}}</td>
                        <td>
                            <div style="display: flex !important;">
                            @foreach(json_decode($raffle->product_image) as $image)
                            <a target="_blank" class="media-block">
                                <div class="media-left">
                                    <img loading="lazy"  class="img-md" src="{{ asset($image)}}" alt="Image">
                                </div>
                            </a>
                            @endforeach
                            </div>
                        </td>
                        <td>
                            @foreach(json_decode($raffle->product_to_show) as $product_to_show)
                                @php $pro = App\Product::find($product_to_show); @endphp
                                    {{$pro->name}} ,
                            @endforeach
                        </td>
                        <td>{{$raffle->reward==''?'Not get yet':$raffle->reward}}</td>
                        <td>
                            <div class="btn-group dropdown">
                                <button class="btn btn-primary dropdown-toggle dropdown-toggle-icon" data-toggle="dropdown" type="button">
                                    {{__('Actions')}} <i class="dropdown-caret"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-right">
                                    @if(permission_check_all('raffles') || permission_check_put('raffles') )
                                        <li><a href="{{route('raffles.edit', $raffle->id)}}">{{__('Edit')}}</a></li>
                                    @endif
                                    @if(permission_check_all('raffles') || permission_check_delete('raffles') )
                                        <li><a onclick="confirm_modal('{{route('raffles.destroy', $raffle->id)}}');">{{__('Delete')}}</a></li>
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
    function RaffleChange(id){

        $.post('{{ route('admin.raffles.status')}}',{_token:'{{ @csrf_token() }}' , id:id}, function(data){
                window.location.reload();
        });
    }
</script>
@endsection


