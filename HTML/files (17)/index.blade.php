@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-sm-12">
        <!-- <a href="{{ route('customers.create')}}" class="btn btn-info pull-right">{{__('add_new')}}</a> -->
    </div>
</div>
<br>

<!-- Basic Data Tables -->
<!--===================================================-->
<div class="panel">
    <div class="panel-heading bord-btm clearfix pad-all h-100">
        <h3 class="panel-title pull-left pad-no">{{__('Customers')}}</h3>
        <div class="pull-right clearfix">
            <form class="" id="sort_customers" action="" method="GET">
                <div class="box-inline pad-rgt pull-left">
                    <div class="" style="min-width: 200px;">
                        <input type="text" class="form-control" id="search" name="search"@isset($sort_search) value="{{ $sort_search }}" @endisset placeholder=" Type email or name & Enter">
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="panel-body">
        <table class="table table-striped res-table mar-no" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>#</th>
                    <th>{{__('Name')}}</th>
                    <th>{{__('Email Address')}}</th>
                    <th>{{__('Phone')}}</th>
                    <th>{{__('Status')}}</th>
                    <th>{{__('Reg. Date')}}</th>
                    <th>{{__('Package')}}</th>
                    <th>{{__('Wallet Balance')}}</th>
                    <th>{{__('Disabled by Customer')}}</th>
                    <th>{{__('Cart')}}</th>
                    <th width="10%">{{__('Options')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($customers as $key => $customer)
                    <tr>
                        <td>{{ ($key+1) + ($customers->currentPage() - 1)*$customers->perPage() }}</td>
                        <td>{{$customer->user->name}}</td>
                        <td>{{$customer->user->email}}</td>
                        <td>{{$customer->user->phone}}</td>
                        <td>
                                <label class="switch">
                                    <input type="checkbox" onchange="updateCustomerStatus({{$customer->id}})" {{$customer->status == 1 ? 'checked' : ''}}>
                                    <span class="slider round"></span>
                                </label>
                            </td>
                        <td>{{ $customer->user->created_at }}</td>
                        <td>
                            @if ($customer->user->customer_package != null)
                                {{$customer->user->customer_package->name}}
                            @endif
                        </td>
                        <td>{{single_price($customer->user->balance)}}</td>
                        <td>
                            @php  $user = App\User::where('id',$customer->user_id)->first(); @endphp
                                <label class="switch">
                                    <input type="checkbox" onchange="updateDisabledBycustomer('{{$user->id}}')" {{$user->disabled_by_user == 1?'checked':''}}>
                                    <span class="slider round"></span>
                                </label>
                        </td>
                        <td>
                            @if($customer->user->cart!='') {{count(json_decode($customer->user->cart))}} @endif

                        </td>
                        <td>
                            <div class="btn-group dropdown">
                                <button class="btn btn-primary dropdown-toggle dropdown-toggle-icon" data-toggle="dropdown" type="button">
                                    {{__('Actions')}} <i class="dropdown-caret"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-right">
                                    <li><a href="{{route('customers.edit', encrypt($customer->id))}}">{{__('Edit')}}</a></li>
                                    <li><a data-toggle="modal" data-target="#cart{{$key}}">{{__('Cart')}}</a></li>
                                    <li><a onclick="confirm_modal('{{route('customers.destroy', $customer->id)}}');">{{__('Delete')}}</a></li>
                                    <li><a onclick="customersLoginByAdmin({{$customer->user_id}});">{{__('Login')}}</a></li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="clearfix">
            <div class="pull-right">
                {{ $customers->appends(request()->input())->links() }}
            </div>
        </div>
    </div>
</div>
<a href="{{route('dashboard')}}" id="customers-dashboard-link" style="display: none">dashboard</a>




@foreach($customers as $key => $customer)
<!-- Modal -->
<div class="modal fade" id="cart{{$key}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Cart {{$customer->user->email}} </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{route('sellers.add_or_remove')}}" method="POST">
            @csrf
        <div class="modal-body">
                <table class="table table-striped res-table mar-no" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{{__('Name')}}</th>
                            <th>{{__('Image')}}</th>
                            <th>{{__('Price')}}</th>
                            <th>{{__('Quantity')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                            <tr>
                                @if($customer->user->cart!='')
                                    @foreach (json_decode($customer->user->cart) as $key=>$cart)
                                    @php
                                        $cart = json_decode($cart);
                                        $product = App\Product::findOrFail($cart->id);
                                    @endphp
                                    <td>{{$key+1}}</td>
                                   <td> {{$product->name}}</td>
                                   <td>
                                    <a target="_blank" class="media-block">
                                        <div class="media-left">
                                            <img loading="lazy"  class="img-md" src="{{ asset($product->thumbnail_img)}}" alt="Image">
                                        </div>
                                    </a>
                                     </td>
                                    <td> {{$cart->price}}</td>
                                    <td>{{$cart->quantity}}</td>
                                    @endforeach
                                @endif
                            </tr>
                    </tbody>
                </table>
            </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
        </form>

      </div>
    </div>
  </div>
    @endforeach




@endsection
@section('script')
    <script type="text/javascript">
        function sort_customers(el){
            $('#sort_customers').submit();
        }
        function customersLoginByAdmin(userId) {
            $.post('{{ route('customers.admin.login') }}',{_token:'{{ @csrf_token() }}', id:userId}, function(data){
                if (data){
                    document.getElementById('customers-dashboard-link').click();
                }
            });
        }

        function updateCustomerStatus(userId) {
            $.post('{{ route('customers.admin.status_update') }}',{_token:'{{ @csrf_token() }}', id:userId}, function(data){
                var res = JSON.parse(data);
                if (res.status){
                    window.location.reload();
                }
            });
        }
        function updateDisabledByCustomer(userId) {
            $.post('{{ route('customers.admin.disabled_by_user_disable_Admin') }}',{_token:'{{ @csrf_token() }}', userId:userId}, function(data){
                var res = JSON.parse(data);

                if (res.disabled_by_user){
                  window.location.reload();
                }
            });
        }
    </script>
@endsection
