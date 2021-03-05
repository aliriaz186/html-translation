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
                                    <table class="table mb-0 table-bordered" style="font-size:14px;background-color: #cce5ff;border-color: #b8daff">
                                        <tr>
                                            <td>{{__('1. Download the skeleton file and fill it with data.')}}:</td>
                                        </tr>
                                        <tr >
                                            <td>{{__('2. You can download the example file to understand how the data must be filled.')}}:</td>
                                        </tr>
                                        <tr>
                                            <td>{{__('3. Once you have downloaded and filled the skeleton file, upload it in the form below and submit.')}}:</td>
                                        </tr>
                                        <tr>
                                            <td>{{__('4. After uploading products you need to set products images and choices By Assending Orders.')}}</td>
                                        </tr>
                                    </table>
                                    <a href="{{ asset('download/product_bulk_demo.xlsx') }}" download><button class="btn btn-styled btn-base-1 mt-2">Download CSV</button></a>
                                </div>
                            </div>

                            <div class="form-box bg-white mt-4">
                                <div class="form-box-content p-3">
                                    <table class="table mb-0 table-bordered" style="font-size:14px;background-color: #cce5ff;border-color: #b8daff">
                                        <tr>
                                            <td>{{__('1. Category,Sub category,Sub Sub category and Brand should be in numerical ids.')}}:</td>
                                        </tr>
                                        <tr >
                                            <td>{{__('2. You can download the pdf to get Category,Sub category,Sub Sub category and Brand id.')}}:</td>
                                        </tr>
                                    </table>
                                    <a href="{{ route('pdf.download_category') }}"><button class="btn btn-styled btn-base-1 mt-2">Download Category</button></a>
                                    <a href="{{ route('pdf.download_sub_category') }}"><button class="btn btn-styled btn-base-1 mt-2">Download Sub category</button></a>
                                    <a href="{{ route('pdf.download_sub_sub_category') }}"><button class="btn btn-styled btn-base-1 mt-2">Download Sub Sub category</button></a>
                                    <a href="{{ route('pdf.download_brand') }}"><button class="btn btn-styled btn-base-1 mt-2">Download Brand</button></a>
                                    <a href="{{ route('pdf.download_all') }}"><button class="btn btn-styled btn-base-2 mt-2">Download All</button></a>

                                </div>
                            </div>

                            <form class="form-horizontal" action="{{ route('bulk_product_upload') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-box bg-white mt-4">
                                    <div class="form-box-title px-3 py-2">
                                        {{__('Upload CSV File')}}
                                    </div>
                                    <div class="form-box-content p-3">
                                        <div class="row">
                                            <div class="col-md-2">
                                                <label>{{__('CSV')}}</label>
                                            </div>
                                            <div class="col-md-10">
                                                <input type="file" name="bulk_file" id="file-6" class="custom-input-file custom-input-file--4"/>
                                                <label for="file-6" class="mw-100 mb-3">
                                                    <span></span>
                                                    <strong>
                                                        <i class="fa fa-upload"></i>
                                                        {{__('Choose CSV File')}}
                                                    </strong>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-box mt-4 text-right">
                                    @if(Session::get('rows')>0)
                                    <button type="button" class="btn btn-styled btn-base-1" data-toggle="modal" data-target="#uploadProducts">{{ __('Upload Images') }}</button>
                                    @else
                                    <button type="submit" class="btn btn-styled btn-base-1">{{ __('Upload') }}</button>
                                    @endif
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    @if(Session::get('rows')>0)
            <!-- Modal -->
            <div class="modal fade" id="uploadProducts" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <form  action="{{ route('bulk_product_upload_images') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                    <div class="modal-body text-center">
                        <p class="">Please Enter {{Session::get('rows')}} Images</p>
                        <input type="file" name="images[]" id="images" multiple>
                        <input type="hidden" value="{{Session::get('rows')}}" name="rows">
                    </div>
                    <div class="modal-footer">
                        <button type="button" onclick="deleteData({{Auth::user()->id}})" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger">Save changes</button>
                    </div>
                 </form>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endif

<script>

    $('input[type=file]').change(function () {
    fileCount = this.files.length;
    if(fileCount>{{Session::get('rows')}} ){
       alert("Please Upload {{Session::get('rows')}} Images you upload "+fileCount+" Images");
       throw new Error("Something went badly wrong!");
   }
});

function deleteData(id){
    $.post('{{ route('delete_data') }}', {_token: '{{ csrf_token()}}', id:id}, function(data){
                        console.log(data);
                    });

}

</script>
@endsection
