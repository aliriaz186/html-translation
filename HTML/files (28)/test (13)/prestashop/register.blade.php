@extends('frontend.layouts.app')
@section('content')

<section class="gry-bg py-4 profile">
        <div class="container-fluid">
            <div class="row cols-xs-space cols-sm-space cols-md-space">
                <div class="col-lg-2-1 d-none d-lg-block">@include('frontend.inc.seller_side_nav')</div>
                <div class="col-lg-9">
                    <!-- Page title -->
                    <div class="page-title">
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <h2 class="heading heading-6 text-capitalize strong-600 mb-0">
                                            {{__('Prestashop Import')}}
                                </h2>
                            </div>
                            <div class="col-md-6">
                                <div class="float-md-right">
                                    <ul class="breadcrumb">
                                            <li><a href="{{ route('home') }}">{{__('Home')}}</a>
                                            </li>
                                            <li class="active"><a href="{{ route('import_data.prestashop') }}">{{__('Prestashop Import')}}</a>
                                            </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="">
                        <div class="row">{{-- card no-border mt-4 --}}
                            <div style="width:100%">
                                <div class="card no-border mt-4" style="width:100%">
                                    <div class="card-header py-3">
                                        <h4 class="mb-0 h6">Prestashop Register</h4>
                                    </div>
                                    <div class="card-body">
                                        <form action="{{route('prestashop.register')}}" method="POST">
                                        @csrf
                                            <div class="form-group">
                                                <label for="PRESTASHOP_URL">PRESTASHOP_URL</label>
                                                <input type="url" id="PRESTASHOP_URL" required class="form-control" name="PRESTASHOP_URL" placeholder="http://localhost/prestashop" value="{{ old('PRESTASHOP_URL')}}">
                                            </div>
                                            <div class="form-group">
                                                <label for="PRESTASHOP_TOKEN">PRESTASHOP_TOKEN</label>
                                                <input type="text" id="PRESTASHOP_TOKEN" required class="form-control" name="PRESTASHOP_TOKEN" placeholder="Api Key" >
                                            </div>
                                            <div class="form-group">
                                                <input type="submit" value="Register" class="btn btn-success pull-right">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>
@endsection
