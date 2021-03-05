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
                                        {{__('Register API')}}
                                    </h2>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="float-md-right">
                                        <ul class="breadcrumb">
                                            <li><a href="{{ route('home') }}">{{__('Home')}}</a></li>
                                            <li><a href="{{ route('api.user-dashboard') }}">{{__('Dashboard')}}</a></li>
                                            <li class="active"><a href="{{ route('api.register-api') }}">{{__('Register API')}}</a></li>
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
                                            <th>{{__('Description')}}</th>
                                            <th>{{__('Key')}}</th>
                                            <th>{{__('Status')}}</th>
                                            <th>{{__('Options')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($ShippingApi as $key=>$api)
                                            <tr>
                                                <td>{{$key+1}}</td>
                                                <td>{{$api->key_description}}</td>
                                                <td>{{$api->key}}</td>
                                                <td>
                                                                @if ($api->company->status=='on')
                                                                 <span class="text-success font-weight-bold"> {{__('Accepted')}} </span>
                                                                @else
                                                                     <span class="text-danger font-weight-bold"> </i> {{__('Pending')}}</span>
                                                                @endif
                                                 </span>
                                                <td><button  data-toggle="modal" data-target="#copy_modal" onclick="show_copy_modal('{{$api->key}}','{{$api->key_description}}')" class="btn btn-sm btn-primary">Register</button></td>
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
                                    {{$ShippingApi->links()}}
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <div class="modal" id="copy_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-zoom product-modal" id="modal-size" role="document" style="max-width:635px">
            <div class="modal-content position-relative">
                <div class="modal-header">
                    <h5 class="modal-title strong-600 heading-5">{{__('Register Api')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="" action="{{ route('api.registerApi.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body gry-bg px-3 pt-3">
                     
                         <div class="row">
                         	<label class="col-md-2">{{__('Type Of API:')}}</label>
	                        <div class="col-md-10 form-group">
	                           <input type="text" class="form-control mb-3" name="key_description" placeholder="Your Question" id="key_description" required readonly>
                        	</div>
                        </div>	
                        <div class="row">
                         	<label class="col-md-2">{{__('Public Key:')}}</label>
	                        <div class="col-md-10 form-group">
                            	      <input type="text" class="form-control mb-3" name="api_key" placeholder="Api id" id="api_key" required readonly>
	                      </div>
                        </div>
                        
                         <div class="row">
                         	<label class="col-md-2">{{__('Private Key:')}}</label>
	                        <div class="col-md-10 form-group">
                            	  <input type="text" class="form-control mb-3" name="private_key" placeholder="Private Key" id="private_key" required readonly>
                        	</div>
                        </div>
                          <div class=" row form-group">
         	           <label class="col-md-2">{{__('Application Url:')}}</label>
                            <div class="col-md-10">
                                    <div class="input-group input-group--style-1">
                                            <input type="url" class="form-control" name="website_url" placeholder="Application Url" id="application_api" required >   
                                            <span class="input-group-addon border" data-toggle="tooltip" title="Must have https://">
                                              <i class="text-md la la-question"></i>
                                            </span>
                                    </div>
                            </div>
                         </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-link" data-dismiss="modal">{{__('Cancel')}}</button>
                        <button type="submit" class="btn btn-base-1 btn-styled">{{__('Send')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection


<script type="text/javascript">

      function  generate_private_key(){
            var randomChars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
            var result = '';
            for ( var i = 0; i < 42; i++ ) {
                result += randomChars.charAt(Math.floor(Math.random() * randomChars.length));
            }
            return result;
        }
        document.getElementById('private_key').value = result;

        function show_copy_modal(api_key,key_description){
           
           document.getElementById('api_key').value = api_key;
           document.getElementById('key_description').value = key_description;
           document.getElementById('private_key').value = generate_private_key();

        }

     </script>

