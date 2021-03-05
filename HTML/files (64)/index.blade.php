@extends('layouts.app')

@section('content')

@if(permission_check_all('shipping_dates') || permission_check_post('shipping_dates') )
<div class="row">
    <div class="col-sm-12">
        <a href="{{ route('admin.shipping-date.create')}}" class="btn btn-rounded btn-info pull-right">{{__('Add New Shipping Date')}}</a>
    </div>
</div>
@endif
<br>

<!-- Basic Data Tables -->
<!--===================================================-->
<div class="panel">
    <div class="panel-heading">
        <h3 class="panel-title">{{__('Staffs')}}</h3>
    </div>
    <div class="panel-body">
        <table class="table table-striped table-bordered demo-dt-basic" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th width="10%">#</th>
                    @if(permission_check_all('shipping_dates') || permission_check_post('shipping_dates') )
                    <th>{{__('Enable')}}</th>
                    @endif
                    <th>{{__('Include')}}</th>
                    <th>{{__('Date')}}</th>
                    <th>{{__('at')}}</th>
                    <th>{{__('Message Before')}}</th>
                    <th>{{__('Message After')}}</th>
                    <th width="10%">{{__('Options')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($shippingDate as $key=>$date)
                    <tr>
                        <td>{{$key+1}}</td>
                    @if(permission_check_all('shipping_dates') || permission_check_post('shipping_dates') )
                        <td>
                                <label class="switch">
                                    <input type="checkbox" {{$date->enable == 1?'checked':''}} onchange="shippingDateChange({{$date->id}})">
                                    <span class="slider round"></span>
                            </label>
                        </td>
                    @endif
                         <td>{{$date->include}}</td>
                        <td>{{$date->date}}</td>
                        <td>{{$date->at}}</td>
                        <td>@php echo html_entity_decode($date->message_before); @endphp </td>
                        <td>@php echo html_entity_decode($date->message_after); @endphp</td>
                        <td>
                              <div class="btn-group dropdown">
                            <button class="btn btn-primary dropdown-toggle dropdown-toggle-icon" data-toggle="dropdown" type="button">
                                {{__('Actions')}} <i class="dropdown-caret"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-right">
                                @if(permission_check_all('shipping_dates') || permission_check_put('shipping_dates') )
                                    <li><a href="{{route('shipping-date.edit', encrypt($date->id))}}">{{__('Edit')}}</a></li>
                                @endif
                                @if(permission_check_all('shipping_dates') || permission_check_delete('shipping_dates') )
                                <li><a onclick="confirm_modal('{{route('shipping-date.destroy', $date->id)}}');">{{__('Delete')}}</a></li>
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

<script>
    function shippingDateChange(id){
        $.post('{{ route('admin.shipping_date.enable')}}',{_token:'{{ @csrf_token() }}' , id:id}, function(data){
                window.location.reload();
        });
    }
</script>
