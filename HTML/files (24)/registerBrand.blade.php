@extends('layouts.app')

@section('content')


<!-- Basic Data Tables -->
<!--===================================================-->
<div class="panel">
    <div class="panel-heading">
        <h3 class="panel-title">{{__('Register Brand')}}</h3>
    </div>
    <div class="panel-body">
        <table class="table table-striped table-bordered demo-dt-basic" cellspacing="0" width="100%">
            <thead>
                <tr>
                              <th>#</th>
                              <th>{{__('First Name')}}</th>
                              <th>{{__('Last Name')}}</th>
                              <th>{{__('Email')}}</th>
                              <th>{{__('Phone')}}</th>
                              <th>{{__('Trademark Name')}}</th>
                              <th>{{__('Trademark No')}}</th>
                              <th>{{__('Country Reg')}}</th>
                              <th>{{__('Trademark Url')}}</th>
                              <th>{{__('Person Contact')}}</th>
                              <th>{{__('Full Address')}}</th>
                              <th>{{__('Website Address')}}</th>
                              <th>{{__('Primary Email')}}</th>
                              <th>{{__('Mobile Email')}}</th>
                              <th>{{__('Action')}}</th>
                            </tr>
                      </thead>
                      <tbody>
                          @foreach ($brands as $key=>$brand)
                          <tr>
                          <td>{{ $key+1 }}</td>
                            <td>{{$brand->firstName}}</td>
                            <td>{{$brand->lastName}}</td>
                            <td>{{$brand->email}}</td>
                            <td>{{$brand->phoneNumber}}</td>
                            <td>{{$brand->trademarkName}}</td>
                            <td>{{$brand->trademarkNumber}}</td>
                            <td>{{$brand->countryOfRegister}}</td>
                            <td>{{$brand->trademarlUrl}}</td>
                            <td>{{$brand->personOfContact}}</td>
                            <td>{{$brand->fullAddress}}</td>
                            <td>{{$brand->websiteAddress}}</td>
                            <td>{{$brand->primaryEmail}}</td>
                            <td>{{$brand->mobileNumber}}</td>
                            <td>
                                <div class="btn-group dropdown">
                                    <button class="btn btn-primary dropdown-toggle dropdown-toggle-icon" data-toggle="dropdown" type="button">
                                        {{__('Actions')}} <i class="dropdown-caret"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-right">
                                        @if(permission_check_all('register_brands') || permission_check_delete('register_brands') )
                                            <li><a onclick="confirm_modal('{{route('registerABrand.admin.delete', $brand->id)}}');">{{__('Delete')}}</a></li>
                                        @endif
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

