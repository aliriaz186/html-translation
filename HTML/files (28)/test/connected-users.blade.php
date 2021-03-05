@extends('frontend.layouts.app')

@section('content')

    <section class="gry-bg py-4 profile">
        <div class="container-fluid p-4">
            <div class="row cols-xs-space cols-sm-space cols-md-space">
                <div class="col-lg-2-1 d-none d-lg-block">
                    @include('frontend.inc.api_user_side_nav')
                </div>

                <div class="col-lg-9">
                    <div class="main-content">
                        <!-- Page title -->
                        <div class="page-title">
                            <div class="row align-items-center">
                                <div class="col-md-6 col-12">
                                    <h2 class="heading heading-6 text-capitalize strong-600 mb-0">
                                        {{__('Connected Users')}}
                                    </h2>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="float-md-right">
                                        <ul class="breadcrumb">
                                            <li><a href="{{ route('home') }}">{{__('Home')}}</a></li>
                                            <li><a href="{{ route('api.user-dashboard') }}">{{__('Dashboard')}}</a></li>
                                            <li class="active"><a href="{{ route('api.connected-users') }}">{{__('Connected Users')}}</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Order history table -->
                            <div class="card no-border mt-4">
                                <div>
                                    <table class="table table-sm table-hover table-responsive-md">
                                        <thead>
                                        <tr>
                                            <th>{{__('#')}}</th>
                                            <th>{{__('Seller Key')}}</th>
                                            <th>{{__('Company Key')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($RegisterCompanySellers as $key=>$RegisterCompanySeller)
                                            <tr>
                                                <td>{{$key+1}}</td>
                                                <td><div class="d-flex"><input type="text" class="form-control" value="{{$RegisterCompanySeller ->seller_private_key}}" readonly="true" id="seller{{$key}}"> <button class="btn btn-sm btn-primary"  onclick="copyKey('seller{{$key}}')">Copy</button></div></td>
                                                <td><div class="d-flex"><input type="text" class="form-control" value="{{$RegisterCompanySeller ->company_private_key}}" readonly="true" id="company{{$key}}">  <button class="btn btn-sm btn-primary"  onclick="copyKey('company{{$key}}')">Copy</button></div></td>
                                            </tr>
                                        @empty 
                                        <tr>
                                            <td class="text-center pt-5 h4" colspan="100%">
                                                <i class="la la-meh-o d-block heading-1 alpha-5"></i>
                                            <span class="d-block">{{ __('No history found.') }}</span>
                                            </td>
                                        </tr>    
                                        @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        <div class="pagination-wrapper py-4">
                            <ul class="pagination justify-content-end">
                                    {{$RegisterCompanySellers->links()}}
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection


<script>
  function copyKey(id) {
  /* Get the text field */
  var copyText = document.getElementById(id);

  
  copyText.select(); 
  
  copyText.setSelectionRange(0, 99999); /*For mobile devices*/

  /* Copy the text inside the text field */
  document.execCommand("copy");

  
  /* Alert the copied text */
  
    showFrontendAlert('success','Copied Key');
} 


</script>
