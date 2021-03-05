@extends('frontend.layouts.app')

@section('content')
<section class="gry-bg py-4 profile">
    <div class="container-fluid p-4">
        <div class="row cols-xs-space cols-sm-space cols-md-space">
            <div class="col-lg-2-1 d-none d-lg-block">
                @if(Auth::user()->user_type == 'seller')
                    @include('frontend.inc.seller_side_nav')
                @elseif(Auth::user()->user_type == 'customer')
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
                                    {{__('Notes')}}
                                </h2>
                            </div>
                            <div class="col-md-6">
                                <div class="float-md-right">
                                    <ul class="breadcrumb">
                                        <li><a href="{{ route('home') }}">{{__('Home')}}</a></li>
                                        <li><a href="{{ route('dashboard') }}">{{__('Dashboard')}}</a></li>
                                        <li><a href="{{ route('support_ticket.index') }}">{{__('Notes')}}</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 offset-md-4">
                            <div class="dashboard-widget text-center plus-widget mt-4 c-pointer" data-toggle="modal" data-target="#notes_modal">
                                <i class="la la-plus"></i>
                                <span class="d-block title heading-6 strong-400 c-base-1">{{ __('Create Notes') }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="card no-border mt-4">
                        <table class="table table-sm table-hover table-responsive-md">
                            <thead>
                                <tr>
                                    <th>{{ __('Title') }}</th>
                                    <th>{{ __('Note') }}</th>
                                    <th>{{ __('Date Added') }}</th>
                                    <th>{{__('Options')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($seller_notes) > 0)
                                    @foreach ($seller_notes as $key => $seller_note)
                                        <tr>
                                            <td>{{ $seller_note->title }}</td>
                                            <td>{{ $seller_note->description }}</td>
                                            <td>{{ $seller_note->created_at }}</td>
                                            <td>
                                                <button class="btn btn-info" class="dropdown-item" data-toggle="modal" data-target="#notes_modaledit_{{$seller_note->id}}" hidden="true">
                                                    {{__('Edit')}}
                                                </button>
                                                <button class="btn btn-danger" onclick="confirm_modal('{{route('sellernotes.destroy', $seller_note->id)}}')" class="dropdown-item">{{__('Delete')}}</button>
                                            </td>
                                        </tr>

                                        <div class="modal fade" id="notes_modaledit_{{$seller_note->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-dialog-zoom product-modal" id="modal-size" role="document">
                                                <div class="modal-content position-relative">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title strong-600 heading-5">{{__('Note')}}</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body px-3 pt-3">
                                                        <form class="" action="{{route('sellernotes.update', $seller_note->id)}}" method="post" enctype="multipart/form-data">
                                                            <input name="_method" type="hidden" value="PATCH">
                                                            @csrf
                                                            <div class="form-group">
                                                                <label>Title <span class="text-danger">*</span></label>
                                                                <input type="text" class="form-control mb-3" name="title" placeholder="Title" required value="{{$seller_note->title}}">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Note <span class="text-danger">*</span></label>
                                                                <input type="text" class="form-control mb-3" name="description" placeholder="Note" required value="{{$seller_note->description}}">
                                                            </div>
                                                            <div class="text-right mt-4">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('cancel')}}</button>
                                                                <button type="submit" class="btn btn-base-1">{{__('Update')}}</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    @endforeach
                                @else
                                    <tr>
                                        <td class="text-center pt-5 h4" colspan="100%">
                                            <i class="la la-meh-o d-block heading-1 alpha-5"></i>
                                            <span class="d-block">{{ __('No history found.') }}</span>
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="pagination-wrapper py-4">
                        <ul class="pagination justify-content-end">
                            {{ $seller_notes->links() }}
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="modal fade" id="notes_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-zoom product-modal" id="modal-size" role="document">
        <div class="modal-content position-relative">
            <div class="modal-header">
                <h5 class="modal-title strong-600 heading-5">{{__('Create Note')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body px-3 pt-3">
                <form class="" action="{{route('sellernotes.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>Title <span class="text-danger">*</span></label>
                        <input type="text" class="form-control mb-3" name="title" placeholder="Title" required>
                    </div>
                    <div class="form-group">
                        <label>Note <span class="text-danger">*</span></label>
                        <input type="text" class="form-control mb-3" name="description" placeholder="Enter details (100 characters max.)" required>
                    </div>
                    <div class="text-right mt-4">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('cancel')}}</button>
                        <button type="submit" class="btn btn-base-1">{{__('Submit')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
