@extends('layouts.app')
@section('content')
<!-- Basic Data Tables -->
<!--===================================================-->
<div class="panel">
    <div class="panel-heading">
        <h3 class="panel-title">{{__('Subscription')}}</h3>
    </div>
    <div class="panel-body">
        <table class="table table-striped table-bordered demo-dt-basic" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>#</th>
                    <th>{{__('Price')}}</th>
                    <th>{{__('User Email')}}</th>
                    <th>{{__('Type')}}</th>
                    <th>{{__('Start time')}}</th>
                    <th>{{__('Expire Time')}}</th>
                    <th>{{__('Action')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($subscriptionProducts as $key => $subscription)
                <tr>
                    <td>{{ $key+1 }}</td>
                    <td>{{$subscription->price}}</td>
                    <td>{{$subscription->user->email}}</td>
                    <td>{{$subscription->type}}</td>
                    <td> @php $date = explode(" ",$subscription->created_at);@endphp {{$date[0]}}</td>
                    <td>@php $date = explode(" ",$subscription->expire_date);@endphp {{$date[0]}}</td>
                    <td>
                        <div class="btn-group dropdown">
                            <button class="btn btn-primary dropdown-toggle dropdown-toggle-icon" data-toggle="dropdown" type="button">
                                {{__('Actions')}} <i class="dropdown-caret"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-right">
                                @if(permission_check_all('product_subscriptions') || permission_check_post('product_subscriptions') )
                                    <li><a data-toggle="modal" data-target="#upgrade_downgrade__{{$key}}">{{__('Update/Downgrade')}}</a></li>

                                    @endif
                                    @if(permission_check_all('product_subscriptions') || permission_check_delete('product_subscriptions'))
                                    <li><a onclick="confirm_modal('{{route('subscribe-destroy', $subscription->id)}}');">{{__('Delete')}}</a></li>
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
                {{ $subscriptionProducts->links() }}
            </ul>
        </div>
    </div>
</div>



@foreach ($subscriptionProducts as $key => $subscription)
  <div class="modal fade" id="upgrade_downgrade__{{$key}}" tabindex="-1" role="dialog" aria-labelledby="upgrade_downgrade__{{$key}}" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <form action="{{route('subscription_list.admin')}}" method="POST">
        @csrf
        <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="upgrade_downgradeLabel__{{$key}}">Upgrade And Downgrade</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <label for="type">Type</label>
              <select name="type" id="type" class="form-control">
                    @foreach(App\subscription_products_prices::all() as $subscription_products_price)
                    <option value="{{$subscription_products_price->feature}}" {{$subscription->type == $subscription_products_price->feature?'selected':''}}>{{ucfirst($subscription_products_price->feature)}}</option>
                    @endforeach
                </select>
                <input type="hidden" name="id" value="{{$subscription->id}}">
            </div>
            <div class="form-group">
                <label for="message">Message</label>
                <textarea name="message" id="message" cols="30" rows="10" class="form-control editor"></textarea>
            </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </form>
    </div>
  </div>
@endforeach

@endsection

@section('script')
<script>
        function selectDays(el){
            value = el.value;
            console.log(value);
            $.get('{{ route('get-price') }}',{_token:'{{ csrf_token() }}', value:value}, function(data){
                         if(data == 'not_Allowed' ){
                                showFrontendAlert('danger', 'Something went wrong');
                         }else{
                             console.log(data);
                            var placeholder = $(".modal-body").find('.promoted_price');
                            placeholder.val(data);
                         }
                     });
        }
  </script>
@endsection
