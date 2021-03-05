@extends('layouts.app')

@section('content')

<div class="panel">
    <div class="panel-heading bord-btm clearfix pad-all h-100">
        <h3 class="panel-title pull-left pad-no">{{__('User Search Report')}}</h3>
    </div>
    <div class="panel-body">
        <table class="table table-striped res-table mar-no" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>{{ __('Search By') }}</th>
                        <th>{{ __('Number searches') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($searches as $key => $searche)
                        <tr>
                            <td>{{ ($key+1) + ($searches->currentPage() - 1)*$searches->perPage() }}</td>
                            <td>{{ $searche->query }}</td>
                            <td>{{ $searche->count }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="aiz-pagination mt-4">
                {{ $searches->links() }}
            </div>
    </div>
</div>

@endsection
