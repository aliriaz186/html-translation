@extends('layouts.app')

@section('content')

@if(permission_check_all('shippings') || permission_check_post('shippings') )
    <div class="row">
        <div class="col-sm-12">
            <a href="{{ route('admin.create-shipping')}}" class="btn btn-rounded btn-info pull-right">{{__('Add New Shipping')}}</a>
        </div>
    </div>
@endif
    <br>

<!-- Basic Data Tables -->
<!--===================================================-->
<div class="panel">
    <div class="panel-heading">
        <h3 class="panel-title">{{__('Shipping')}}</h3>
    </div>
    <div class="panel-body">
        <table class="table table-striped table-bordered demo-dt-basic" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>#</th>
                    <th>{{__('Name')}}</th>
                    <th>{{__('Url')}}</th>
                    <th>{{__('Extra')}}</th>
                    <th>{{__('Premium')}}</th>
                    <th width="10%">{{__('Options')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach(App\Shipping::where('type','free')->orWhere('type','flat_rate')->get() as $key => $ship)
                     <tr>
                        <td>{{$key+1}}</td>
                        <td>{{ucfirst($ship->name)}}</td>
                        <td>{{$ship->url}}</td>
                        <td>{{$ship->extra==null?'Standard':$ship->extra}}</td>
                        <td>{{$ship->premium!=null?'Premium':'Non-Premium'}}</td>
                        <td>
                            <div class="btn-group dropdown">
                                <button class="btn btn-primary dropdown-toggle dropdown-toggle-icon" data-toggle="dropdown" type="button">
                                    {{__('Actions')}} <i class="dropdown-caret"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-right">
                                    @if(permission_check_all('shippings') || permission_check_put('shippings') )
                                        <li><a href="{{route('admin.edit-shipping', $ship->id)}}">{{__('Edit')}}</a></li>
                                    @endif
                                    @if(permission_check_all('shippings') || permission_check_delete('shippings') )
                                        <li><a onclick="confirm_modal('{{route('admin.destroy-shipping', $ship->id)}}');">{{__('Delete')}}</a></li>
                                    @endif
                                </ul>
                            </div>
                        </td>
                    </tr>
                 @endforeach
                    
                @foreach($shipping as $key => $ship)
                    <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$ship->name}}</td>
                        <td>{{$ship->url}}</td>
                        <td>{{$ship->extra==null?'Standard':$ship->extra}}</td>
                        <td>{{$ship->premium!=null?'Premium':'Non-Premium'}}</td>
                        <td>
                            <div class="btn-group dropdown">
                                <button class="btn btn-primary dropdown-toggle dropdown-toggle-icon" data-toggle="dropdown" type="button">
                                    {{__('Actions')}} <i class="dropdown-caret"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-right">
                                    @if(permission_check_all('shippings') || permission_check_put('shippings') )
                                        <li><a href="{{route('admin.edit-shipping', $ship->id)}}">{{__('Edit')}}</a></li>
                                    @endif
                                    @if(permission_check_all('shippings') || permission_check_delete('shippings') )
                                        <li><a onclick="confirm_modal('{{route('admin.destroy-shipping', $ship->id)}}');">{{__('Delete')}}</a></li>
                                    @endif
                                </ul>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</div>
@endsection
