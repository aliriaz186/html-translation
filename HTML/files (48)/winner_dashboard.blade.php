@extends('layouts.app')

@section('content')


<div class="panel">
    <div class="panel-heading bord-btm clearfix pad-all h-100">
        <h3 class="panel-title pull-left pad-no">{{__('Raffle Winners')}}</h3>
        <div class="pull-right clearfix">
            <form class="" id="sort_news" action="" method="GET">
                <div class="box-inline pad-rgt pull-left">
                    <div class="" style="min-width: 200px;">
                        <input type="text" class="form-control" id="search" name="search"@isset($sort_search) value="{{ $sort_search }}" @endisset placeholder=" Type name & Enter">
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
                    <th>{{__('Winner Ticket')}}</th>
                    <th>{{__('Email')}}</th>
                    <th>{{__('Status')}}</th>
                    <th>{{__('S.Date')}}</th>
                    <th>{{__('E.Date')}}</th>
                    <th width="10%">{{__('Options')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($winners as $key=>$winner)
                    <tr>
                        <td>{{$key+1}}</td>

                        <td>{{$winner->winner_ticket}}</td>
                        <td>{{$winner->winnerTicket->User->email}}</td>
                        <td>{{ucfirst($winner->claim)}}</td>
                        <td>{{$winner->start_date}}</td>
                        <td>{{$winner->end_date}}</td>
                        <td>
                            @if($winner->claim == 'request')
                           <button class="btn btn-success btn-sm" onclick="WinnerApproveModal({{$winner->id}})" data-toggle="modal" data-target="#WinnerRequest">Accept</button>
                           <button class="btn btn-danger btn-sm ml-2" onclick="WinnerRejectModal({{$winner->id}})" data-toggle="modal" data-target="#WinnerRequest">Reject</button>
                           @elseif($winner->claim == "approve")
                           <div style="background: green; padding: 5px; border-radius: 5px; color: white; width: 75px;">Approved</div>
                           @else
                           <div style="background: red; padding: 5px; border-radius: 5px; color: white; width: 75px;">Rejected</div>
                           @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="clearfix">
            <div class="pull-right">

            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="WinnerRequest" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Confirmation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="{{route('admin.raffles.winner_status')}}">
                @csrf
                <div class="modal-body">
                    <h6 id="winner-type"></h6>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="raffle_id" id="winner-modal-raffle-id">
                    <input type="hidden" name="type" id="winner-type-id">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Continue</button>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="modal fade" id="order_details" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-zoom product-modal" id="modal-size" role="document">
        <div class="modal-content position-relative">
            <div class="c-preloader">
                <i class="fa fa-spin fa-spinner"></i>
            </div>
            <div id="order-details-modal-body">

            </div>
        </div>
    </div>
</div>
<script>
    function WinnerApproveModal(id) {
        document.getElementById('winner-modal-raffle-id').value = id;
        document.getElementById('winner-type-id').value = "approve";
        document.getElementById('winner-type').innerHTML = "Are you sure you want to approve the request?"
    }

    function WinnerRejectModal(id) {
        document.getElementById('winner-modal-raffle-id').value = id;
        document.getElementById('winner-type-id').value = "reject";
        document.getElementById('winner-type').innerHTML = "Are you sure you want to reject the request?"

    }
</script>
@endsection


