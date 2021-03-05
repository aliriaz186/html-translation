@extends('layouts.app')

@section('content')

@if(permission_check_all('return_policy_dates') || permission_check_post('return_policy_dates')  )
<div class="row">
    <div class="col-sm-12">
        <a href="{{ route('return_days.create')}}" class="btn btn-rounded btn-info pull-right">{{__('Add New Days')}}</a>
    </div>
</div>
@endif
<br>

<!-- Basic Data Tables -->
<!--===================================================-->
<div class="panel">
    <div class="panel-heading">
        <h3 class="panel-title">{{__('Return Days')}}</h3>
    </div>
    <div class="panel-body">
        <table class="table table-striped table-bordered demo-dt-basic" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th width="10%">#</th>
                    <th>{{__('Days')}}</th>
                    <th>{{__('Message')}}</th>
                    <th>{{__('Status')}}</th>
                    <th width="10%">{{__('Options')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($returnPolicyDates as $key => $RPD)
                    <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$RPD->days}}</td>
                        <td>{!! $RPD->message !!}</td>
                        <td>
                            <label class="switch">
                                    <input type="checkbox" name="status"  {{$RPD->status==1?'checked':''}} onchange="changeStatus(this)" value="{{ $RPD->id }}" class="form-control demo-sw">
                                    <span class="slider round"></span>
                            </label>
                        </td>
                        <td>
                            <div class="btn-group dropdown">
                                <button class="btn btn-primary dropdown-toggle dropdown-toggle-icon" data-toggle="dropdown" type="button">
                                    {{__('Actions')}} <i class="dropdown-caret"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-right">
                                     @if(permission_check_all('return_policy_dates') || permission_check_put('return_policy_dates')  )
                                        <li><a href="{{route('return_days.edit', $RPD->id)}}">{{__('Edit')}}</a></li>
                                    @endif
                                    @if(permission_check_all('return_policy_dates') || permission_check_delete('return_policy_dates')  )
                                        <li><a onclick="confirm_modal('{{route('return_days.destroy', $RPD->id)}}');">{{__('Delete')}}</a></li>
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
            $.post('{{ route('return_days.returnDate_status') }}', {_token:'{{ csrf_token() }}', id:el.value, status:status}, function(data){
                if(data == 1){
                    showAlert('success', 'Featured products updated successfully');
                }
                else{
                    showAlert('danger', 'Something went wrong');
                }
            });
        }
</script>

@endsection
