@extends('layouts.app')

@section('content')

@if(permission_check_all('classified_sub_sub_categories') || permission_check_post('classified_sub_sub_categories'))
<div class="row">
    <div class="col-sm-12">
        <a href="{{ route('classified_subsubcategories.create')}}" class="btn btn-rounded btn-info pull-right">{{__('Add New Classified Sub Subcategory')}}</a>
    </div>
</div>
@endif

<!--===================================================-->
<div class="panel">
    <div class="panel-heading bord-btm clearfix pad-all h-100">
        <h3 class="panel-title pull-left pad-no">{{__('Classified Sub-Sub-categories')}}</h3>
        <div class="pull-right clearfix">
            <form class="" id="sort_subsubcategories" action="" method="GET">
                <div class="box-inline pad-rgt pull-left">
                    <div class="" style="min-width: 200px;">
                        <input type="text" class="form-control" id="search" name="search"@isset($sort_search) value="{{ $sort_search }}" @endisset placeholder=" Type name & Enter">
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="panel-body">
        <table class="table table-striped res-table mar-no" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>#</th>
                    <th>{{__('C.Sub Subcategory')}}</th>
                    <th>{{__('C.Subcategory')}}</th>
                    <th>{{__('C.Category')}}</th>
                    {{-- <th>{{__('Attributes')}}</th> --}}
                    <th width="10%">{{__('Options')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($subsubcategories as $key => $subsubcategory)
                    <tr>
                        <td>{{ ($key+1) + ($subsubcategories->currentPage() - 1)*$subsubcategories->perPage() }}</td>
                        <td>{{__($subsubcategory->name)}}</td>
                        <td>{{$subsubcategory->classifiedSubcategory->name}}</td>
                        <td>{{$subsubcategory->classifiedSubcategory->classifiedCategory->name}}</td>
                        <td>
                            <div class="btn-group dropdown">
                                <button class="btn btn-primary dropdown-toggle dropdown-toggle-icon" data-toggle="dropdown" type="button">
                                    {{__('Actions')}} <i class="dropdown-caret"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-right">
                                    @if(permission_check_all('classified_sub_sub_categories') || permission_check_put('classified_sub_sub_categories'))
                                        <li><a href="{{route('classified_subsubcategories.edit', encrypt($subsubcategory->id))}}">{{__('Edit')}}</a></li>
                                    @endif
                                    @if(permission_check_all('classified_sub_sub_categories') || permission_check_delete('classified_sub_sub_categories'))
                                        <li><a onclick="confirm_modal('{{route('classified_subsubcategories.destroy', $subsubcategory->id)}}');">{{__('Delete')}}</a></li>
                                    @endif
                                </ul>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="clearfix">
            <div class="pull-right">
                {{ $subsubcategories->appends(request()->input())->links() }}
            </div>
        </div>
    </div>
</div>

@endsection
