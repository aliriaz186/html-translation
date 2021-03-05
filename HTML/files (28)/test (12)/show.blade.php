@extends('frontend.layouts.app')

@section('content')

    <section class="gry-bg py-4 profile">
        <div class="container-fluid">
            <div class="row cols-xs-space cols-sm-space cols-md-space">
                <div class="col-lg-2-1 d-none d-lg-block">
                    @include('frontend.inc.seller_side_nav')
                </div>

                <div class="col-lg-9">
                    <div class="main-content">
                        <!-- Page title -->
                        <div class="page-title">
                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <h2 class="heading heading-6 text-capitalize strong-600 mb-0">
                                        {{__('Bulk Products upload')}}
                                    </h2>
                                </div>
                                <div class="col-md-6">
                                    <div class="float-md-right">
                                        <ul class="breadcrumb">
                                            <li><a href="{{ route('home') }}">{{__('Home')}}</a></li>
                                            <li><a href="{{ route('dashboard') }}">{{__('Dashboard')}}</a></li>
                                            <li><a href="#">{{__('Bulk Products upload')}}</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="form-box bg-white mt-4">
                                <div class="form-box-content p-3">
                                <form action="{{route('shipping-companies.store')}}" method="POST">
                                    @csrf
                                    <table class="table mb-0 table-bordered" style="font-size:14px;background-color: #cce5ff;border-color: #b8daff">
                                        <tr>
                                            <td>{{__('1. Generate your Private Key')}}: <button type="button" class="btn btn-danger text-white pull-right" onclick="Generate(42)">Key Generate</button></td>
                                        </tr>
                                        <tr >
                                            <td>{{__('2. After Generate your Key show here')}}: <span id="key" style=" color:#bd2502;"></span></td>
                                            <input type="hidden" name="private_key_seller" id="private_key_seller" required>
                                            <input type="hidden" name="private_key_company" value="{{$RegisterApiCompany->private_key}}" required>
                                            <input type="hidden" name="public_key_admin" value="{{$RegisterApiCompany->key}}" required>

                                        </tr>
                                        <tr>
                                            <td>{{__('3. After Getting your Id you have to connect with Comapny')}} <a href="{{$RegisterApiCompany->website_url}}/login" target="__blank" class="btn btn-success text-white pull-right">Sign In</a>:</td>
                                        </tr>
                                        <tr>
                                            <td>{{__('4. After Successfully sign in lets combine both sites')}} <button class="btn btn-info text-white pull-right" >Combine</a>:</td>
                                        </tr>
                                    </form>
                                    </table>
                                </div>
                            </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

<script>

function Generate(length){
    var randomChars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    var result = '';
    for ( var i = 0; i < length; i++ ) {
        result += randomChars.charAt(Math.floor(Math.random() * randomChars.length));
    }
    document.getElementById('key').innerHTML = result;
    document.getElementById('private_key_seller').value = result;


}

</script>

@endsection
