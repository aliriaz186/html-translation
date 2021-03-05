@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-sm-12">
            <a href="{{ route('referral.create')}}" class="btn btn-rounded btn-info pull-right">{{__('Add New Loyalty')}}</a>
        </div>
    </div>

    <br>

<!-- Basic Data Tables -->
<!--===================================================-->
<div class="panel">
    <div class="panel-heading">
        <h3 class="panel-title">{{__('Loyalty')}}</h3>
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
                @foreach ($referrals as $key=>$referral)
                <tr>
                     <td>{{$key+1}}</td>
                     <td>
                        <label class="switch">
                            <input type="checkbox" name="enable" onchange="updateReferral({{$referral->id}})" {{$referral->enable == 1 ? 'checked':''  }}>
                            <span class="slider round"></span>
                        </label>
                     </td>
                     <td>{{$referral->ratio}}</td>
                     <td>{{$referral->point}}</td>
                     <td>
                        <label class="switch">
                            <input type="checkbox" name="enable" onchange="updateTaxes(this,{{$referral->id}})" {{$referral->taxes == 1 ? 'checked':''  }}>
                            <span class="slider round"></span>
                        </label>
                     <td>{{$referral->voucher_details}}</td>
                     <td>{{$referral->period}}</td>
                     <td>
                        <div class="btn-group dropdown">
                            <button class="btn btn-primary dropdown-toggle dropdown-toggle-icon" data-toggle="dropdown" type="button">
                                {{__('Actions')}} <i class="dropdown-caret"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-right">
                                <li><a href="{{route('referral.edit', $referral->id)}}">{{__('Edit')}}</a></li>
                                <li><a onclick="confirm_modal('{{route('referral.destroy', $referral->id)}}');">{{__('Delete')}}</a></li>
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
    function updateReferral(id){
        $.post('{{ route('referral.change') }}',{_token:'{{ csrf_token() }}', id:id}, function(data){
            location.reload();
        });
    }
    function updateTaxes(el,id){
        if(el.value == 1){
            status = 1;
        }else{
            status = 0
        }
        $.get('{{ route('referral.taxes') }}',{_token:'{{ csrf_token() }}', id:id,status:status}, function(data){
            location.reload();
        });
    }

</script>
