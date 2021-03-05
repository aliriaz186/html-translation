@extends('frontend.layouts.app')
@section('content')

<style>
    .media-block:after {
    content: '';
    display: table;
    clear: both;
}
.media-block .media-left {
    display: block;
    float: left;
}
.img-md {
    height: auto;
}
.img-md {
    width: 64px;
    height: 64px;
}
</style>
<section class="gry-bg py-4 profile">
        <div class="container-fluid p-4">
            <div class="row cols-xs-space cols-sm-space cols-md-space">
                <div class="col-lg-2-1 d-none d-lg-block">@include('frontend.inc.seller_side_nav')</div>
                <div class="col-lg-9">
                    <!-- Page title -->
                    <div class="page-title">
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <h2 class="heading heading-6 text-capitalize strong-600 mb-0">
                                            {{__('Wordpress Import')}}
                                </h2>
                            </div>
                            <div class="col-md-6">
                                <div class="float-md-right">
                                    <ul class="breadcrumb">
                                            <li><a href="{{ route('home') }}">{{__('Home')}}</a>
                                            </li>
                                            <li class="active"><a href="{{ route('import_data.shopify') }}">{{__('Wordpress Import')}}</a>
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
                                        <h4 class="mb-0 h6">Wordpress</h4>
                                      <a href="{{route('wordpress.changePage')}}" class="pull-right btn btn-info" style="margin-top: -3%" >Change</a>
                                      <a href="{{route('wordpress.delete')}}" class="pull-right btn btn-danger mr-2" style="margin-top: -3%" >Delete</a>
                                    </div>
                                    <div class="card-body">
                                        <form action="{{route('countries.set_default_countries')}}" method="POST">
                                         @csrf
                                            <table class="table table-striped table-bordered demo-dt-basic" cellspacing="0" width="100%">
                                                <thead>
                                                    <tr>
                                                        <th width="10%">#</th>
                                                        <th>{{__('Image')}}</th>
                                                        <th>{{__('Name')}}</th>
                                                        <th>{{__('Description')}}</th>
                                                        <th>{{__('Show')}}</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($products as $key => $product)
                                                        <tr>
                                                            <td>{{ ($key+1)  }}</td>
                                                            <td>
                                                                <a target="_blank" class="media-block">
                                                                    <div class="media-left">
                                                                        <img loading="lazy"  class="img-md" src="{{ $product->images[0]->src}}" alt="Image">
                                                                    </div>

                                                                </a>
                                                            </td>
                                                            <td>{{ __($product->name) }}</td>
                                                            <td>{{strip_tags(htmlspecialchars_decode($product->description))}}</td>
                                                            <td>
                                                                    <a href="" class="btn btn-success" data-toggle="modal" data-target="#categorySelectModal_{{$product->id}}" id="product_category"> Import </a>
                                                                    <input type="hidden" name="category_id" id="category_id" value="" required>
                                                                    <input type="hidden" name="subcategory_id" id="subcategory_id" value="" required>
                                                                    <input type="hidden" name="subsubcategory_id" id="subsubcategory_id" value="">

                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                            <div class="clearfix">
                                                <div class="pull-right">
                                                </div>
                                            </div>
                                            <br>
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

    <!-- Modal -->
    @foreach ($products as $product)
      <div class="modal fade" id="categorySelectModal_{{$product->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                    <div class="modal-header">
                        <h6 class="modal-title" id="exampleModalLabel">Select Category</h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="target-category heading-6">
                            <span class="mr-3">{{__('Target Category')}}:</span>
                            <span>{{__('category')}} > {{__('subcategory')}} > {{__('subsubcategory')}}</span>
                        </div>
                        <div class="row no-gutters modal-categories mt-4 mb-2">
                            <div class="col-4">
                                <div class="modal-category-box c-scrollbar">
                                    <div class="sort-by-box">
                                        <form role="form" class="search-widget">
                                            <input class="form-control input-lg" type="text" placeholder="Search Category" onkeyup="filterListItems(this, 'categories')">
                                            <button type="button" class="btn-inner">
                                                <i class="fa fa-search"></i>
                                            </button>
                                        </form>
                                    </div>
                                    <div class="modal-category-list has-right-arrow">
                                        <ul id="categories">
                                            @foreach ($categories as $key => $category)
                                                <li onclick="get_subcategories_by_category(this, {{ $category->id }})">{{ __($category->name) }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="modal-category-box c-scrollbar" id="subcategory_list">
                                    <div class="sort-by-box">
                                        <form role="form" class="search-widget">
                                            <input class="form-control input-lg" type="text" placeholder="Search SubCategory" onkeyup="filterListItems(this, 'subcategories')">
                                            <button type="button" class="btn-inner">
                                                <i class="fa fa-search"></i>
                                            </button>
                                        </form>
                                    </div>
                                    <div class="modal-category-list has-right-arrow">
                                        <ul id="subcategories">

                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="modal-category-box c-scrollbar" id="subsubcategory_list">
                                    <div class="sort-by-box">
                                        <form role="form" class="search-widget">
                                            <input class="form-control input-lg" type="text" placeholder="Search SubSubCategory" onkeyup="filterListItems(this, 'subsubcategories')">
                                            <button type="button" class="btn-inner">
                                                <i class="fa fa-search"></i>
                                            </button>
                                        </form>
                                    </div>
                                    <div class="modal-category-list">
                                        <ul id="subsubcategories">

                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('cancel')}}</button>
                        {{-- <button type="submit" class="btn btn-primary">{{__('Confirm')}}</button> --}}
                        <button type="button" class="btn btn-primary" onclick="closeModal()">{{__('Confirm')}}</button>
                    </div>
            </div>
        </div>
    </div>
    @endforeach
    @if(count($products)>0)
    <form action="{{route('wordpress-import-product')}}" method="POST" id="form_wordpress">
        @csrf
        <input type="hidden" name="product_id" value="{{$product->id}}">
        <input type="hidden" name="category_id" id="categoreis_form">
        <input type="hidden" name="subcategory_id" id="sub_categoreis_form">
        <input type="hidden" name="subsubcategory_id" id="sub_sub_categoreis_form">
    </form>
@endif
    @endsection


@section('script')
    <script>
        var category_name = "";
        var subcategory_name = "";
        var subsubcategory_name = "";

        var category_id = null;
        var subcategory_id = null;
        var subsubcategory_id = null;

        $(document).ready(function(){

            $('#subcategory_list').hide();
            $('#subsubcategory_list').hide();
        });

        function ondelete(event,id){
                // $(event).parents(".col-md-3").remove();
            }

        function list_item_highlight(el){
            $(el).parent().children().each(function(){
                $(this).removeClass('selected');
            });
            $(el).addClass('selected');
        }

        function get_subcategories_by_category(el, cat_id){
            list_item_highlight(el);
            category_id = cat_id;
            subcategory_id = null;
            subsubcategory_id = null;
            category_name = $(el).html();
            $('#subcategories').html(null);
            $('#subsubcategory_list').hide();
            $.post('{{ route('subcategories.get_subcategories_by_category') }}',{_token:'{{ csrf_token() }}', category_id:category_id}, function(data){
                for (var i = 0; i < data.length; i++) {
                    $('#subcategories').append('<li onclick="get_subsubcategories_by_subcategory(this, '+data[i].id+')">'+data[i].name+'</li>');
                }
                $('#subcategory_list').show();
            });
        }

        function get_subsubcategories_by_subcategory(el, subcat_id){
            list_item_highlight(el);
            subcategory_id = subcat_id;
            subsubcategory_id = null;
            subcategory_name = $(el).html();
            $('#subsubcategories').html(null);
            $.post('{{ route('subsubcategories.get_subsubcategories_by_subcategory') }}',{_token:'{{ csrf_token() }}', subcategory_id:subcategory_id}, function(data){
                for (var i = 0; i < data.length; i++) {
                    $('#subsubcategories').append('<li onclick="confirm_subsubcategory(this, '+data[i].id+')">'+data[i].name+'</li>');
                }
                $('#subsubcategory_list').show();
            });
        }

        function confirm_subsubcategory(el, subsubcat_id){
            list_item_highlight(el);
            subsubcategory_id = subsubcat_id;
            subsubcategory_name = $(el).html();
        }

        function get_attributes_by_subsubcategory(subsubcategory_id){
            $.post('{{ route('subsubcategories.get_attributes_by_subsubcategory') }}',{_token:'{{ csrf_token() }}', subsubcategory_id:subsubcategory_id}, function(data){
                $('#choice_attributes').html(null);
                for (var i = 0; i < data.length; i++) {
                    $('#choice_attributes').append($('<option>', {
                        value: data[i].id,
                        text: data[i].name
                    }));
                }
            });
        }

        function filterListItems(el, list){
            filter = el.value.toUpperCase();
            li = $('#'+list).children();
            for (i = 0; i < li.length; i++) {
                if ($(li[i]).html().toUpperCase().indexOf(filter) > -1) {
                    $(li[i]).show();
                } else {
                    $(li[i]).hide();
                }
            }
        }

        function closeModal(){
            if(category_id > 0 && subcategory_id > 0){
                $('#category_id').val(category_id);
                $('#subcategory_id').val(subcategory_id);
                $('#subsubcategory_id').val(subsubcategory_id);

                $('#categoreis_form').val(category_id);
                $('#sub_categoreis_form').val(subcategory_id);
                $('#sub_sub_categoreis_form').val(subsubcategory_id);

                $('#form_wordpress').submit();
                $('#categorySelectModal').modal('hide');
            }
            else{
                alert('Please choose categories...');
            }
        }


            </script>
@endsection
