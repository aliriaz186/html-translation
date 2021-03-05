@extends('layouts.app')

@section('content')


<br>

<div class="panel">
    <!--Panel heading-->
    <div class="panel-heading bord-btm clearfix pad-all h-100">
        <h3 class="panel-title pull-left pad-no">{{ __(' Reports') }}</h3>
        <div class="pull-right clearfix">

        </div>
    </div>


    <div class="panel-body">
        <table class="table table-striped res-table mar-no" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>#</th>
                    <th width="20%">{{__('Email')}}</th>
                    <th>{{__('Product Name')}}</th>
                    <th>{{__('Seller Name')}}</th>
                    <th>{{__('Message')}}</th>
                    <th>{{__('Options')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($reports as $key => $report)
                <tr>
                    <td>{{ ($key+1)  }}</td>
                    <td> {{$report->user->email}} </td>
                    @if(!empty($report->product))
                    <td>{{ $report->product->name}}</td>
                    <td> {{App\User::where('id',$report->product->user_id)->first()['email']}} </td>
                    @else
                    <td></td>
                    <td></td>
                    @endif

                    <td> {{$report->message}}</td>
                    <td>
                        <div class="btn-group dropdown">
                            <button class="btn btn-primary dropdown-toggle dropdown-toggle-icon" data-toggle="dropdown" type="button">
                                {{__('Actions')}} <i class="dropdown-caret"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-right">
                                <li><a onclick="confirm_modal('{{route('admin.reports.destroy', $report->id)}}');">{{__('Delete')}}</a></li>
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

