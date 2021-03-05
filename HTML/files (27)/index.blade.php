@extends('layouts.app')

@section('content')

@if(permission_check_all('free_returns') || permission_check_post('free_returns')  )
<div class="row">
    <div class="col-sm-12">
        <a href="{{ route('free_return_days.create')}}" class="btn btn-rounded btn-info pull-right">{{__('Add New Days')}}</a>
    </div>
</div>
@endif
<br>

<!-- Basic Data Tables -->
<!--===================================================-->
<div class="panel">
    <div class="panel-heading">
        <h3 class="panel-title">{{__('Free Return Days')}}</h3>
    </div>
    <div class="panel-body">
        <table class="table table-striped table-bordered demo-dt-basic" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th width="10%">#</th>
                    <th>{{__('Days')}}</th>
                    <th>{{__('Status')}}</th>
                    <th width="10%">{{__('Options')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($FreeReturn as $key => $FRD)
                    <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$FRD->days}}</td>
                        <td>
                            <label class="switch">
                                    <input type="checkbox" name="status"  {{$FRD->status==1?'checked':''}} onchange="changeStatus(this)" value="{{ $FRD->id }}" class="form-control demo-sw">
                                    <span class="slider round"></span>
                            </label>
                        </td>
                        <td>
                            <div class="btn-group dropdown">
                                <button class="btn btn-primary dropdown-toggle dropdown-toggle-icon" data-toggle="dropdown" type="button">
                                    {{__('Actions')}} <i class="dropdown-caret"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-right">
                                     @if(permission_check_all('free_return_days') || permission_check_put('free_return_days')  )
                                        <li><a href="{{route('free_return_days.edit', $FRD->id)}}">{{__('Edit')}}</a></li>
                                    @endif
                                    @if(permission_check_all('free_return_days') || permission_check_delete('free_return_days')  )
                                        <li><a onclick="confirm_modal('{{route('free_return_days.destroy', $FRD->id)}}');">{{__('Delete')}}</a></li>
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

@section('script')
<script>
    function changeStatus(el){
            if(el.checked){
                var status = 1;
            }
            else{
                var status = 0;
            }
            $.post('{{ route('free_return_days.free_return_date_status') }}', {_token:'{{ csrf_token() }}', id:el.value, status:status}, function(data){
                if(data == 1){
                    showAlert('success', 'Free Return updated successfully');
                }
                else{
                    showAlert('danger', 'Something went wrong');
                }
            });
        }
</script>

@endsection
