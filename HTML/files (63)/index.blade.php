@extends('layouts.app')

@section('content')

@if(permission_check_all('shipping_apis') || permission_check_post('shipping_apis') )
<div class="row">
    <div class="col-sm-12">
        <a href="{{ route('shipping-api.create')}}" class="btn btn-rounded btn-info pull-right">{{__('Add New Api')}}</a>
        <a href="{{ route('shipping-api-dev')}}" class="btn btn-rounded btn-danger pull-right">{{__('Add New Developer Api')}}</a>

    </div>
</div>
@endif
<br>

<!-- Basic Data Tables -->
<!--===================================================-->
<div class="panel">
    <div class="panel-heading">
        <h3 class="panel-title">{{__('API')}}</h3>
    </div>
    <div class="panel-body">
        <table class="table table-striped table-bordered demo-dt-basic" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th width="10%">#</th>
                    <th>{{__('Status')}}</th>
                    <th>{{__('Key')}}</th>
                    <th>{{__('Key Description')}}</th>
                    <th width="10%">{{__('Options')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($shippingApi as $key => $SAi)
                <tr>
                    <td>{{$key+1}}</td>
                    <td>
                        <label class="switch">
                           <input type="checkbox" {{$SAi->status == 1?'checked':''}} onchange="shippingApiChange({{$SAi->id}})">
                           <span class="slider round"></span>
                      </label>
                    </td>
                    <td>{{$SAi->key}}</td>
                    <td>{{$SAi->key_description}}</td>
                    <td>
                        <div class="btn-group dropdown">
                      <button class="btn btn-primary dropdown-toggle dropdown-toggle-icon" data-toggle="dropdown" type="button">
                          {{__('Actions')}} <i class="dropdown-caret"></i>
                      </button>
                      <ul class="dropdown-menu dropdown-menu-right">
                        @if(permission_check_all('shipping_apis') || permission_check_delete('shipping_apis') )
                          <li><a href="{{route('shipping-api.edit',$SAi->id)}}">{{__('Edit')}}</a></li>
                        @endif
                          @if(permission_check_all('shipping_apis') || permission_check_delete('shipping_apis') )
                            <li><a onclick="confirm_modal('{{route('shipping-api.delete', $SAi->id)}}');">{{__('Delete')}}</a></li>
                          @endif
                      </ul>
                  </div>
              </td>
            </tr>
                @endforeach
            </tbody>
        </table>
        <div class="pagination-wrapper py-4 pr-4">
            <ul class="pagination justify-content-end">
                {{ $shippingApi->links() }}
            </ul>
        </div>
    </div>
</div>

@endsection

<script>
    function shippingApiChange(id){
        $.get('{{ route('admin.shipping-api.status')}}',{_token:'{{ @csrf_token() }}' , id:id}, function(data){
                window.location.reload();
                // console.log(data);
        });
    }
</script>

