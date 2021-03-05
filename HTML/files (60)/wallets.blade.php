@extends('layouts.app')

@section('content')

<!-- Basic Data Tables -->
<!--===================================================-->
<div class="panel">
    <div class="panel-heading bord-btm clearfix pad-all h-100">
        <h3 class="panel-title pull-left pad-no">{{__('Sellers wallets')}}</h3>
        <div class="pull-right clearfix">
            <form class="" id="sort_sellers" action="" method="GET">
                <div class="box-inline pad-rgt pull-left">
                    <div class="select" style="min-width: 300px;">
                        <select class="form-control demo-select2" name="approved_status" id="approved_status" onchange="sort_sellers()">
                            <option value="">{{__('Filter by Status')}}</option>
                            <option value="0"  @isset($approved) @if($approved == '0') selected @endif @endisset>{{__('Add')}}</option>
                            <option value="1"  @isset($approved) @if($approved == '1') selected @endif @endisset>{{__('Remove')}}</option>
                        </select>
                    </div>
                </div>
                <div class="box-inline pad-rgt pull-left">
                    <div class="" style="min-width: 200px;">
                        <input type="text" class="form-control" id="search" name="search"@isset($sort_search) value="{{ $sort_search }}" @endisset placeholder="Type name or email & Enter">
                    </div>
                </div>
                @if(permission_check_all('wallets') || permission_check_post('wallets')  )
                <div class="box-inline pad-rgt pull-right ml-3">
                    <div class="" style="min-width: 200px;">
                        <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#addOrRemove" >ADD/REMOVE</button>
                    </div>
                </div>
               @endif
            </form>
        </div>
    </div>
    <div class="panel-body">
        <div class="table-responsive">
            <table class="table table-striped table-responsive mar-no" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>{{__('Date')}}</th>
                        <th>{{__('Seller')}}</th>
                        <th>{{__('Amount')}}</th>
                        <th>{{__('Payment Type')}}</th>
                        <th>{{__('Add/Remove')}}</th>
                        <th>{{__('Message')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($wallets as $key => $wallet)
                        @if (\App\Seller::where('user_id',$wallet->user_id) != null && $wallet->user->user_type == 'seller')
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $wallet->created_at }}</td>
                                <td>
                                    @if (\App\Seller::where('user_id',$wallet->user_id) != null)
                                    {{ $wallet->user->name}} ({{ $wallet->user->shop->name }})
                                @endif
                                </td>
                                <td>
                                    @if($wallet->status==0)
                                    {{ single_price($wallet->amount) }}
                                    @else
                                            {{ single_price(-$wallet->amount) }}
                                    @endif
                                </td>
                                <td>
                                	{{strtoupper($wallet->payment_method)}}
                                </td>
                                 <td>
                                    @if ($wallet->status == 1)
                                    <span class="ml-2" style="color:red"><strong>{{__('DUDUCED')}}</strong></span>
                                @else
                                    <span class="ml-2" style="color:green"><strong>{{__('ADD')}}</strong></span>
                                @endif
                                </td>
                                <td>
                                    {{$wallet->message}}
                                </td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
            <div class="clearfix">
                <div class="pull-right">
                    {{ $wallets->links() }}
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="addOrRemove" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Or Remove</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <form action="{{route('sellers.add_or_remove')}}" method="POST">
            @csrf
        <div class="modal-body">
            <div class="form-group">
                <div class="row">
                    <label class="col-sm-3 control-label" for="type">{{__('Type')}}</label>
                    <div class="col-sm-9">
                    <select name="type" class="form-control">
                        <option value="selected" selected>Please select Add-Minus</option>
                        <option value="add">Add(+)</option>
                        <option value="minus">Minus(-)</option>
                    </select>
                    </div>
                </div>
            </div>
        <div class="form-group">
            <div class="row">
                <label class="col-sm-3 control-label" for="Seller">{{__('Seller')}}</label>
                <div class="col-sm-9">
                <select name="seller_id" class="form-control demo-select2" id="seller_id">
                    @foreach (App\User::where('user_type','seller')->get() as $user)
                            <option value="{{$user->seller->id}}">{{$user->name}}</option>
                    @endforeach
                </select>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <label class="col-sm-3 control-label" for="amount">{{__('Amount')}}</label>
                <div class="col-sm-9">
                    <input type="number" min="0" step="0.01" name="amount" id="amount"  class="form-control" required placeholder="Amount">
                    <input type="hidden" name="place" class="form-control" required value="wallet">
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <label class="col-sm-3 control-label" for="amount">{{__('Message')}}</label>
                <div class="col-sm-9">
                    <textarea name="message" id="" cols="30" rows="10" class="form-control editor" placeholder="Message.."></textarea>
                </div>
            </div>
        </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
        </form>
      </div>
    </div>
  </div>

@endsection


@section('script')
    <script>
         function sort_sellers(el){
            $('#sort_sellers').submit();
        }


        $(document).ready(function(){
        $('.demo-select2').select2();
    });

</script>


@endsection
