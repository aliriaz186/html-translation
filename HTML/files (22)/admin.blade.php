@extends('layouts.app')

@section('content')

<!-- Basic Data Tables -->
<!--===================================================-->
<div class="panel">
    <div class="panel-heading bord-btm clearfix pad-all h-100">
        <h3 class="panel-title pull-left pad-no">{{__('Admin Feedbacks')}}</h3>
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
                    <th>{{__('Order Code')}}</th>
                    <th>{{__('Customer Email')}}</th>
                    <th>{{__('Message')}}</th>
                    <th>{{__('Rating')}}</th>
                    <th>{{__('Reply')}}</th>
                    <th>{{__('Status')}}</th>
                    <th width="10%">{{__('Options')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($SellerFeedbacks as $key => $feedback)
                    <tr>
                        <td>{{ ($key+1) + ($SellerFeedbacks->currentPage() - 1)*$SellerFeedbacks->perPage() }}</td>
                        <td>{{$feedback->order->code}}</td>
                        <td>{{App\User::findOrFail($feedback->customer_id)->email}}</td>
                        <td>{{$feedback->message}}</td>
                        <td>
                            <div>
                            <span class="star-rating star-rating-lg d-block">
                                @if ($feedback->rating > 0)
                                	{{ renderStarRating($feedback->rating) }}
                                @else
                                        {{ renderStarRating(0) }}
                                @endif
                            </span>
                        </div>
                        @if($feedback->reply=='')
                            <td><button type="button" data-toggle="modal" data-target="#chatModal--{{$key}}" class="btn btn-sm btn-primary">Reply</button></td>
                        @else
                           <td>{{$feedback->reply}}</td>
                        @endif
                        <td>
                                <label class="switch">
                                    <input type="checkbox" value="{{$feedback->id}}" onchange="update_feedback(this)" {{$feedback->status == 1 ? 'checked' : ''}}>
                                    <span class="slider round"></span>
                                </label>
                            </td>
                        <td>
                            <div class="btn-group dropdown">
                                <button class="btn btn-primary dropdown-toggle dropdown-toggle-icon" data-toggle="dropdown" type="button">
                                    {{__('Actions')}} <i class="dropdown-caret"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-right">
                                    <li><a onclick="confirm_modal('{{route('admin.customer_feedback_destroy', $feedback->id)}}');">{{__('Delete')}}</a></li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="clearfix">
            <div class="pull-right">
                {{ $SellerFeedbacks->appends(request()->input())->links() }}
            </div>
        </div>
    </div>
</div>
 @foreach ($SellerFeedbacks as $key=>$feedback)

    <div class="modal" id="chatModal--{{$key}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-zoom product-modal" id="modal-size" role="document">
            <div class="modal-content position-relative">
                <div class="modal-header">
                    <h5 class="modal-title strong-600 heading-5">{{__('Reply Customer')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="" action="{{ route('feedback.rplay') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body gry-bg px-3 pt-3">
                        <div class="form-group">
                        <input type="text" class="form-control mb-3" name="title"  placeholder="User Name" value="{{App\User::findOrFail($feedback->customer_id)->name}}"  required readonly>
                        <input type="hidden" name="feedback_id" value="{{$feedback->id}}">
                    </div>
                        <div class="form-group">
                            <textarea class="form-control" rows="8" name="message" required placeholder="Your Reply"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-link" data-dismiss="modal">{{__('Cancel')}}</button>
                        <button type="submit" class="btn btn-primary">{{__('Send')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endforeach
@endsection

@section('script')
<script>
            function update_feedback(el){
            if(el.checked){
                var status = 1;
            }
            else{
                var status = 0;
            }
            $.get('{{ route('admin.seller_feedback_status') }}', {_token:'{{ csrf_token() }}', id:el.value, status:status}, function(data){
                if(data == 1){
                    showAlert('success', 'Feedback set successfully');
                    location.reload();
                }
                else{
                    showAlert('danger', 'Something went wrong');
                    location.reload();

                }
            });
        }
</script>
@endsection
