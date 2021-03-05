@extends('frontend.layouts.app')

@section('content')

    <section class="gry-bg py-4 profile">
        <div class="container-fluid p-4">
            <div class="row cols-xs-space cols-sm-space cols-md-space">
                <div class="col-lg-2-1 d-none d-lg-block">
                    @if(Auth::user()->user_type == 'seller')
                     @include('frontend.inc.seller_side_nav')
                    @else
                    @include('frontend.inc.customer_side_nav')
                    @endif
                </div>

                <div class="col-lg-9">
                    <div class="main-content">
                        <!-- Page title -->
                        <div class="page-title">
                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <h2 class="heading heading-6 text-capitalize strong-600 mb-0">
                                        {{__('Categories Commission')}}
                                    </h2>
                                </div>
                                <div class="col-md-6">
                                    <div class="float-md-right">
                                        <ul class="breadcrumb">
                                            <li><a href="{{ route('home') }}">{{__('Home')}}</a></li>
                                            <li><a href="{{ route('dashboard') }}">{{__('Dashboard')}}</a></li>
                                            <li class="active"><a href="{{ route('seller.categories.commission') }}">{{__('Categories Commission')}}</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                     <div class="card no-border mt-4">
                            <div class="card-header py-2">
                                <div class="row align-items-center">
                                    <div class="col-md-6 col-xl-3">
                                        <h6 class="mb-0">All Commision</h6>
                                    </div>
                                    <div class="col-md-6 col-xl-3 ml-auto">
                                        <form class="" action="" method="GET">
                                            <input type="text" class="form-control" id="search" name="search" @isset($search) value="{{ $search }}" @endisset placeholder="Search Category Name">
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <table class="table table-sm table-hover table-responsive-md">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>{{__('Category Name')}}</th>
                                            <th>{{__('Commission')}}</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                           		@foreach($categories as $key=>$category)
                           			<tr>
                           			<td> {{$key+1}}</td>
                           			<td>{{$category->name}}</td>
                           			<td>{{number_format($category->commision_rate,2)}}</td>
                       				</tr>
                           		@endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="pagination-wrapper py-4">
                            <ul class="pagination justify-content-end">
                               {{ $categories->links() }}
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
 
@endsection
