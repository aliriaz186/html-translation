@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-sm-12">
            <a href="{{ route('cashbacks.create')}}" class="btn btn-rounded btn-info pull-right">{{__('Add New Cashback')}}</a>
        </div>
    </div>

    <br>

<!-- Basic Data Tables -->
<!--===================================================-->
<div class="panel">
    <div class="panel-heading">
        <h3 class="panel-title">{{__('Cashbacks')}}</h3>
    </div>
    <div class="panel-body">
        <table class="table table-striped table-bordered demo-dt-basic" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>#</th>
                    <th>{{__('Enable')}}</th>
                    <th>{{__('Ratio')}}</th>
                    <th>{{__('Point')}}</th>
                    <th>{{__('Taxes')}}</th>
                    <th>{{__('Voucher Detail')}}</th>
                    <th>{{__('Period')}}</th>
                    <th width="10%">{{__('Options')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cashbacks as $key=>$cashback)
                <tr>
                     <td>{{$key+1}}</td>
                     <td>
                        <label class="switch">
                            <input type="checkbox" name="enable" onchange="updateCashback({{$cashback->id}})" {{$cashback->enable == 1 ? 'checked':''  }}>
                            <span class="slider round"></span>
                        </label>
                     </td>
                     <td>{{$cashback->ratio}}</td>
                     <td>{{$cashback->point}}</td>
                     <td>
                        <label class="switch">
                            <input type="checkbox" name="enable" onchange="updateTaxes(this,{{$cashback->id}})" {{$cashback->taxes == 1 ? 'checked':''  }}>
                            <span class="slider round"></span>
                        </label>
                     <td>{{$cashback->voucher_details}}</td>
                     <td>{{$cashback->period}}</td>
                     <td>
                        <div class="btn-group dropdown">
                            <button class="btn btn-primary dropdown-toggle dropdown-toggle-icon" data-toggle="dropdown" type="button">
                                {{__('Actions')}} <i class="dropdown-caret"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-right">
                                <li><a href="{{route('cashbacks.edit', $cashback->id)}}">{{__('Edit')}}</a></li>
                                <li><a onclick="confirm_modal('{{route('cashbacks.destroy', $cashback->id)}}');">{{__('Delete')}}</a></li>
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
    function updateCashback(id){
        $.post('{{ route('cashbacks.change') }}',{_token:'{{ csrf_token() }}', id:id}, function(data){
            location.reload();
        });
    }
    function updateTaxes(el,id){
        if(el.value == 1){
            status = 1;
        }else{
            status = 0
        }
        $.get('{{ route('cashbacks.taxes') }}',{_token:'{{ csrf_token() }}', id:id,status:status}, function(data){
            location.reload();
        });
    }

</script>
