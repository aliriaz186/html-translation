@extends('layouts.app')

@section('content')

<div class="panel">
    <div class="panel-heading">
        <h3 class="panel-title">{{__('Submit Offer')}}</h3>
    </div>
    <div class="panel-body">
        <table class="table table-striped table-bordered demo-dt-basic" cellspacing="0" width="100%">
            <thead>
                <tr>
                              <th>#</th>
                              <th>{{__('Email')}}</th>
                              <th>{{__('Name')}}</th>
                              <th>{{__('Action')}}</th>
                          </tr>
                          <tbody>
                              @foreach ($brands as $key=>$brand)
                              <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{$brand->user->email}}</td>
                                <td>
                                    <a target="_blank" class="media-block">
                                        <div class="media-left">
                                            <img loading="lazy"  class="img-md" src="{{ asset($brand->image)}}" alt="Image">
                                        </div>
                                        <div class="media-body">{{ __($brand->name) }}</div>
                                    </a>
                                </td>
                                <td>
                                    <div class="btn-group dropdown">
                                        <button class="btn btn-primary dropdown-toggle dropdown-toggle-icon" data-toggle="dropdown" type="button">
                                            {{__('Actions')}} <i class="dropdown-caret"></i>
                                        </button>
                                        @if(permission_check_all('brands') || permission_check_delete('brands'))
                                            <ul class="dropdown-menu dropdown-menu-right">
                                                <li><a onclick="confirm_modal('{{route('addBrandAdmin.admin.delete', $brand->id)}}');">{{__('Delete')}}</a></li>
                                            </ul>
                                         @endif
                                    </div>
                                </td>
                            </tr>
                              @endforeach
                          </tbody>
                      </thead>
                  </table>

                </div>
            </div>
            @endsection

