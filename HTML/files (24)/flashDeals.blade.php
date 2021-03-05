@extends('layouts.app')
@section('content')
<br>
<div class="panel">
      <!--Panel heading-->
      <div class="panel-heading bord-btm clearfix pad-all h-100">
         <h3 class="panel-title pull-left pad-no">{{ __('Flash Deals') }}</h3>
      </div>
      <div class="panel-body">

          <div class="tab-content">
            <div id="Dashboard" class="tab-pane fade in active">
                <table class="table table-striped res-table mar-no" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{{__('Email')}}</th>
                            <th>{{__('First Flash Deal')}}</th>
                            <th>{{__('Second Flash Deal')}}</th>
                            <th>{{__('Third Flash Deal')}}</th>
                            <th>{{__('Date')}}</th>
                            <th>{{__('Option')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($flashDeals as $key => $FD)
                        <td>{{$key+1}}</td>
                        <td>{{$FD->user->email}}</td>
                        <td>{{str_limit(App\Product::where('id',$FD->firstDeal)->first()->name, $limit = 10, $end="...") }}</td>
                        <td>{{str_limit(App\Product::where('id',$FD->secondDeal)->first()->name, $limit = 10, $end="...") }}</td>
                        <td>{{str_limit(App\Product::where('id',$FD->thirdDeal)->first()->name, $limit = 10, $end="...") }}</td>
                        <td>{{explode(' ',$FD->created_at)[0]}}</td>
                        <td>

                        <div class="btn-group dropdown">
                            <button class="btn btn-primary dropdown-toggle dropdown-toggle-icon" data-toggle="dropdown" type="button">
                                {{__('Actions')}} <i class="dropdown-caret"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-right">
                                @if(permission_check_all('flash_deals') || permission_check_post('flash_deals') )
                                <li><a data-toggle="modal" data-target="#status{{$key}}" >{{__('Status')}}</a></li>
                                @endif
                                @if(permission_check_all('flash_deals') || permission_check_delete('flash_deals') )
                                <li><a onclick="confirm_modal('{{route('seller.flashDeal.destroy', $FD->id)}}');">{{__('Delete')}}</a></li>
                                @endif

                            </ul>
                        </div>
                        </td>
                        @endforeach
                    </tbody>
                </table>
            </div>
          </div>
      </div>
</div>

@foreach (App\FlashDealSeller::all() as $key=>$FD)

<div class="modal" id="status{{$key}}" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-zoom product-modal" id="modal-size" role="document">
        <div class="modal-content position-relative">
            <div class="modal-header">
                <h5 class="modal-title strong-600 heading-5" style="margin-left: auto">{{__('STATUS FLASH DEAL')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="GET">
                @php $FD = App\FlashDealSeller::first(); @endphp
                <div class="modal-body gry-bg px-3 pt-3">
                   @if($FD->first_status!=null)
                    <div class="row">
                        <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="first">First Deal</label>
                                    <input style="width:80%" readonly class="form-control" type="text" value="{{str_limit(App\Product::where('id',$FD->firstDeal)->first()->name, $limit = 10, $end="...") }}">
                                    <td><label class="switch" style="top: -28px;left: 86%;">
                                    @if($FD->first_set_by_admin==1)
                                        <button id="first" onclick="update_status(this,{{$FD->id}},null)" class="btn btn-sm btn-danger">x</button>
                                    @else
                                        <button  type="button" id="first" onclick="update_status(this,{{$FD->id}},1)" class="btn btn-sm btn-success">&#10003;</button>
                                    @endif
                                    </td>
                                </div>
                        </div>
                    </div>
                    @endif
                    @if($FD->second_status!=null)
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="second">Second Deal</label>
                                <input style="width:80%" readonly class="form-control" type="text" value="{{str_limit(App\Product::where('id',$FD->secondDeal)->first()->name, $limit = 10, $end="...") }}">
                                <td><label class="switch" style="top: -28px;left: 86%;">
                                    @if($FD->second_set_by_admin==1)
                                    <button id="second" onclick="update_status(this,{{$FD->id}},null)" class="btn btn-sm btn-danger">x</button>
                                @else
                                    <button  type="button" id="second" onclick="update_status(this,{{$FD->id}},1)" class="btn btn-sm btn-success">&#10003;</button>
                                @endif  </td>
                            </div>
                    </div>
                    </div>
                    @endif
                    @if($FD->third_status!=null)
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="third">Third Deal</label>
                                <input style="width:80%" readonly class="form-control" type="text" value="{{str_limit(App\Product::where('id',$FD->thirdDeal)->first()->name, $limit = 10, $end="...") }}">
                                <td><label class="switch" style="top: -28px;left: 86%;">
                                    @if($FD->third_set_by_admin==1)
                                    <button id="third" onclick="update_status(this,{{$FD->id}},null)" class="btn btn-sm btn-danger">x</button>
                                @else
                                    <button  type="button" id="third" onclick="update_status(this,{{$FD->id}},1)" class="btn btn-sm btn-success">&#10003;</button>
                                @endif    </td>
                            </div>
                    </div>

                    </div>
                    @endif
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach

@endsection



@section('script')
<script>

function update_status(el,DB_id,status){

            console.log(DB_id);
            $.get('{{ route('flashDeal.admin.updateStatus') }}', {_token:'{{ csrf_token() }}',id:DB_id, status:status,status_number:el.id}, function(data){
                if(data == 1){
                    showAlert('success', 'Status updated successfully');
                    location.reload();
                }
                else{
                    showAlert('danger', 'Something went wrong');
                    location.reload();

                }

            });
        }

$(document).ready(function(){
        $('.demo-select2').select2();
    });

</script>

@endsection
