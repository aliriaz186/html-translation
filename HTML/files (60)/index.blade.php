@extends('layouts.app')

@section('content')


    <div class="row">
        <div class="col-sm-12">
           <a href="{{ route('sellers.create')}}" class="btn btn-rounded btn-info pull-right">{{__('Add New Seller')}}</a>
        </div>
    </div>

    <br>

    <!-- Basic Data Tables -->
    <!--===================================================-->
    <div class="panel">
        <div class="panel-heading bord-btm clearfix pad-all h-100">
            <h3 class="panel-title pull-left pad-no">{{__('Sellers')}}</h3>
            <div class="pull-right clearfix">
                <form class="" id="sort_sellers" action="" method="GET">
                    <div class="box-inline pad-rgt pull-left">
                        <div class="select" style="min-width: 300px;">
                            <select class="form-control demo-select2" name="approved_status" id="approved_status" onchange="sort_sellers()">
                                <option value="">{{__('Filter by Approval')}}</option>
                                <option value="1"  @isset($approved) @if($approved == 'paid') selected @endif @endisset>{{__('Approved')}}</option>
                                <option value="0"  @isset($approved) @if($approved == 'unpaid') selected @endif @endisset>{{__('Non-Approved')}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="box-inline pad-rgt pull-left">
                        <div class="" style="min-width: 200px;">
                            <input type="text" class="form-control" id="search" name="search"@isset($sort_search) value="{{ $sort_search }}" @endisset placeholder="Type name or email & Enter">
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
                    <th>{{__('Phone')}}</th>
                    <th>{{__('Email Address')}}</th>
                    <th>{{__('Verification Info')}}</th>
                    @if(permission_check_all('sellers') || permission_check_post('sellers')  )<th>{{__('Approval')}}</th> @endif
                    <th>{{__('Reg. Date')}}</th>
                    @if(permission_check_all('sellers') || permission_check_post('sellers')  )<th>{{__('Status')}}</th> @endif
                    <th>{{ __('Products') }}</th>
                    <th>{{ __('Due') }}({{currency_symbol()}})</th>
                    @if(permission_check_all('sellers') || permission_check_post('sellers')  )<th>{{__('Disabled by Seller')}}</th> @endif
                    @if(permission_check_all('sellers') || permission_check_post('sellers')  )<th>{{__('Disabled by Customer')}}</th> @endif
                    <th>{{__('Cart')}}</th>
                    <th width="10%">{{__('Options')}}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($sellers as $key => $seller)
                    @if($seller->user != null)
                        <tr>
                            <td>{{ ($key+1) + ($sellers->currentPage() - 1)*$sellers->perPage() }}</td>
                            <td>{{$seller->user->name}}</td>
                            <td>{{$seller->user->phone}}</td>
                            <td>{{$seller->user->email}}</td>
                            <td>
                                @if ($seller->verification_info != null)
                                    <a href="{{ route('sellers.show_verification_request', $seller->id) }}">
                                        <div class="label label-table label-info">
                                            {{__('Show')}}
                                        </div>
                                    </a>
                                @endif
                            </td>
                            <td>
                                @if(permission_check_all('sellers') || permission_check_delete('sellers')  )
                                <label class="switch">
                                    <input onchange="update_approved(this)" value="{{ $seller->id }}" type="checkbox" <?php if($seller->verification_status == 1) echo "checked";?> >
                                    <span class="slider round"></span>
                                </label>
                                @endif
                            </td>
                            <td>{{$seller->user->created_at}}</td>
                            <td>
                                @if(permission_check_all('sellers') || permission_check_post('sellers')  )
                                <label class="switch">
                                    <input type="checkbox" onchange="updateSellerStatus({{$seller->id}})" {{$seller->status == 1 ? 'checked' : ''}}>
                                    <span class="slider round"></span>
                                </label>
                                @endif
                            </td>
                            <td>{{ \App\Product::where('user_id', $seller->user->id)->count() }}</td>
                            <td>
                                @if ($seller->admin_to_pay >= 0)
                                    {{ single_price($seller->admin_to_pay) }}
                                @else
                                    {{ single_price(abs($seller->admin_to_pay)) }} (Due to Admin)
                                @endif
                            </td>
                            <td>
                                @if(permission_check_all('sellers') || permission_check_post('sellers')  )
                                @php  $user = App\User::where('id',$seller->user_id)->first(); @endphp
                                    <label class="switch">
                                        <input type="checkbox" onchange="updateDisableBothCustomerSeller(this,'{{$user->id}}')" {{($user->disabled_by_user == 1 ||$user->disabled_by_user == 2) ?'checked':''}}>
                                        <span class="slider round"></span>
                                    </label>
                                @endif
                            </td>
                            <td>
                                @if(permission_check_all('sellers') || permission_check_post('sellers')  )
                                @php  $user = App\User::where('id',$seller->user_id)->first(); @endphp
                                    <label class="switch">
                                        <input type="checkbox" onchange="updateDisableOnlyCustomer(this,'{{$user->id}}')" {{$user->disabled_by_user == 1?'checked':''}}>
                                        <span class="slider round"></span>
                                    </label>
                                @endif
                            </td>
                            <td>
                                @if($seller->user->cart!='') {{count(json_decode($seller->user->cart))}} @endif
                            </td>
                            <td>
                                <div class="btn-group dropdown">
                                    <button class="btn btn-primary dropdown-toggle dropdown-toggle-icon" data-toggle="dropdown" type="button">
                                        {{__('Actions')}} <i class="dropdown-caret"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-right">
                                        <li><a data-toggle="modal" data-target="#addOrRemove" onclick="addOrRemove({{$seller->id}})" style="cursor: pointer">{{__('Add/Remove')}}</a></li>
                                        <li><a onclick="show_seller_profile('{{$seller->id}}');">{{__('Profile')}}</a></li>
                                         @if(permission_check_all('sellers') || permission_check_post('sellers')  )
                                            <li><a style="cursor: pointer" onclick="show_seller_payment_modal('{{$seller->id}}');">{{__('Pay Now')}}</a></li>
                                        @endif
                                        @if(permission_check_all('sellers') || permission_check_get('sellers')  )
                                            <li><a href="{{route('sellers.payment_history', encrypt($seller->id))}}">{{__('Payment History')}}</a></li>
                                        @endif
                                        @if(permission_check_all('sellers') || permission_check_put('sellers')  )
                                            <li><a href="{{route('sellers.edit', encrypt($seller->id))}}">{{__('Edit')}}</a></li>
                                        @endif
                                        @if(permission_check_all('sellers') || permission_check_delete('sellers')  )
                                            <li><a onclick="confirm_modal('{{route('sellers.destroy', $seller->id)}}');">{{__('Delete')}}</a></li>
                                        @endif
                                        @if(permission_check_all('sellers') || permission_check_get('sellers')  )
                                            <li><a onclick="sellerLoginByAdmin({{$seller->user_id}})" style="cursor: pointer">{{__('Login')}}</a></li>
                                        @endif
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    @endif
                @endforeach
                </tbody>
            </table>
            <div class="clearfix">
                <div class="pull-right">
                    {{ $sellers->appends(request()->input())->links() }}
                </div>
            </div>
        </div>
    </div>

   <div class="modal fade" id="addOrRemove" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                <select name="type" id="" class="form-control" required>
                    <option selected value="select">Please select Add-Minus</option>
                    <option value="add">Add(+)</option>
                    <option value="minus">Minus(-)</option>
                </select>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <label class="col-sm-3 control-label" for="amount">{{__('Amount')}}</label>
                <div class="col-sm-9">
                    <input type="number" min="0" step="0.01" name="amount" id="amount"  class="form-control" required>
                    <input type="hidden"  id="seller_id_modal" name="seller_id" class="form-control">
                    <input type="hidden" name="place" class="form-control" required value="withdraw">
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                    <label class="col-sm-3 control-label" for="message">{{__('Message')}}</label>
                <div class="col-sm-9">
                    <textarea name="message" class="form-control" id="message" cols="30" rows="10"> </textarea>
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


    <div class="modal fade" id="payment_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" id="modal-content">

            </div>
        </div>
    </div>

    <div class="modal fade" id="profile_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" id="modal-content">

            </div>
        </div>
    </div>
    <a href="{{route('dashboard')}}" id="seller-dashboard-link" style="display: none">dashboard</a>

@endsection

@section('script')
    <script type="text/javascript">
        function show_seller_payment_modal(id){
            $.post('{{ route('sellers.payment_modal') }}',{_token:'{{ @csrf_token() }}', id:id}, function(data){
            console.log(data,id);
                $('#payment_modal #modal-content').html(data);
                $('#payment_modal').modal('show', {backdrop: 'static'});
                $('.demo-select2-placeholder').select2();
            });
        }

        function show_seller_profile(id){
            $.post('{{ route('sellers.profile_modal') }}',{_token:'{{ @csrf_token() }}', id:id}, function(data){
                $('#profile_modal #modal-content').html(data);
                $('#profile_modal').modal('show', {backdrop: 'static'});
            });
        }

        function update_approved(el){
            if(el.checked){
                var status = 1;
            }
            else{
                var status = 0;
            }
            $.post('{{ route('sellers.approved') }}', {_token:'{{ csrf_token() }}', id:el.value, status:status}, function(data){
                if(data == 1){
                    showAlert('success', 'Approved sellers updated successfully');
                }
                else{
                    showAlert('danger', 'Something went wrong');
                }
            });
        }

        function sort_sellers(el){
            $('#sort_sellers').submit();
        }

        function sellerLoginByAdmin(userId) {
            $.post('{{ route('sellers.admin.login') }}',{_token:'{{ @csrf_token() }}', id:userId}, function(data){
               if (data){
                  document.getElementById('seller-dashboard-link').click();
               }
            });
        }

        function updateSellerStatus(userId) {
            $.post('{{ route('sellers.admin.status_update') }}',{_token:'{{ @csrf_token() }}', id:userId}, function(data){
                var res = JSON.parse(data);
                if (res.status){
                    window.location.reload();
                }
            });
        }

        
        function addOrRemove(id) {
            document.getElementById('seller_id_modal').value = id;
        }

       function updateDisableBothCustomerSeller(el,userId) {
        if(el.checked){var status = 1;}else{var status = 0;}
            $.post('{{ route('sellers.admin.disabled_by_both_disable_Admin') }}',{_token:'{{ @csrf_token() }}',status:status, userId:userId}, function(data){
                var res = JSON.parse(data);
                if (res.disabled_by_user){
                  window.location.reload();
                }
            });
        }

        function updateDisableOnlyCustomer(el,userId) {
        if(el.checked){var status = 1;}else{var status = 0;}
            $.post('{{ route('sellers.admin.disabled_by_customer_disable_Admin') }}',{_token:'{{ @csrf_token() }}',status:status, userId:userId}, function(data){
                var res = JSON.parse(data);
                if (res.disabled_by_user){
                  window.location.reload();
                }
            });
        }

        $(document).ready(function(){
            $('#container').removeClass('mainnav-lg').addClass('mainnav-sm');
        });
    </script>
@endsection
