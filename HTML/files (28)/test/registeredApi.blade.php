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
                                        {{__('Registered Api')}}
                                    </h2>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="float-md-right">
                                        <ul class="breadcrumb">
                                            <li><a href="{{ route('home') }}">{{__('Home')}}</a></li>
                                            <li><a href="{{ route('api.registered-api') }}">{{__('Registered Api')}}</a></li>
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
                                            <th>{{__('Key')}}</th>
                                            <th>{{__('website')}}</th>
                                            <th>{{__('Description')}}</th>
                                            <th>{{__('Status')}}</th>
                                            <th>{{__('Options')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($RAPIC as $key=>$Api_company)
                                                <td>{{$key+1}}</td>
                                                <td>{{$Api_company->key}}</td>
                                                <td>{{$Api_company->website_url}}</td>
                                                <td>{{$Api_company->key_description}}</td>
                                                <td> @if($Api_company->status=='on')
                                                 <span class="text-success font-weight-bold">
                                                 	Completed
                                                 </span>
                                                 @else
                                                 <span class="text-danger font-weight-bold">
                                                          Pending
                                                 </span>
                                                 @endif
                                                 </td>
                                                <td><button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#remove_modal" onclick="show_remove_modal({{$Api_company->id}} , '{{$Api_company->key}}', '{{$Api_company->key_description}}' , '{{$Api_company->website_url}}')">Remove</button></td>
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

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <div class="modal" id="remove_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-zoom product-modal" id="modal-size" role="document">
            <div class="modal-content position-relative">
                <div class="modal-header">
                    <h5 class="modal-title strong-600 heading-5">{{__('Remove Company')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="" action="{{ route('api.registerApi.remove') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" id="api_id">
                    <div class="modal-body gry-bg px-3 pt-3">
                        <div class="row">
                            <label for="" class="col-md-3">Api Key</label>
                            <div class="col-md-9">
                                <div class="form-group">
                                    <input type="text" class="form-control mb-3" name="api_key" placeholder="Api id" id="api_key" required readonly>
                                </div>        
                            </div>
                        </div>

                        <div class="row">
                            <label for="" class="col-md-3">Key Description</label>
                            <div class="col-md-9">
                                <div class="form-group">
                                    <input type="text" class="form-control mb-3" name="key_description" placeholder="Key Description" id="key_description" required readonly>
                                </div>        
                            </div>
                        </div>
                        

                        <div class="row">
                            <label for="" class="col-md-3">Applicaiton Url</label>
                            <div class="col-md-9">
                                <div class="form-group">
                                    <input type="text" class="form-control mb-3" name="website_url" placeholder="Application Url" id="website_url" required readonly>
                                </div>        
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-link" data-dismiss="modal">{{__('Cancel')}}</button>
                        <button type="submit" class="btn btn-base-1 btn-styled">{{__('Remove')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection


@section('script')
<script type="text/javascript">

        function show_remove_modal(api_id,api_key,key_description,website_url){
           $('#api_id').val(api_id);
           $('#api_key').val(api_key);
           $('#key_description').val(key_description);
           $('#website_url').val(website_url);

        }

     </script>

@endsection
