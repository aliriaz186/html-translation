@extends('layouts.app')

@section('content')

    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title">{{__('Product Bulk Upload')}}</h3>
        </div>
        <div class="panel-body">
            <div class="alert" style="color: #004085;background-color: #cce5ff;border-color: #b8daff;margin-bottom:0;margin-top:10px;">
                <strong>Step 1:</strong>
                <p>1. Download the skeleton file and fill it with proper data.</p>
                <p>2. You can download the example file to understand how the data must be filled.</p>
                <p>3. Once you have downloaded and filled the skeleton file, upload it in the form below and submit.</p>
                <p>4. After uploading products you need to edit them and set product's images and choices.</p>
            </div>
            <br>
            <div class="">
                <a href="{{ asset('download/product_bulk_demo.xlsx') }}" download><button class="btn btn-primary">Download CSV</button></a>
                <a href="{{ route('pdf.download_all') }}" download><button class="btn btn-primary">Download All</button></a>
            </div>
            <div class="alert" style="color: #004085;background-color: #cce5ff;border-color: #b8daff;margin-bottom:0;margin-top:10px;">
                <strong>Step 2:</strong>
                <p>1. Category,Sub category,Sub Sub category and Brand should be in numerical ids.</p>
                <p>2. You can download the pdf to get Category,Sub category,Sub Sub category and Brand id.</p>
            </div>
            <br>
            <div class="">
                <a href="{{ route('pdf.download_category') }}"><button class="btn btn-primary">Download Category</button></a>
                <a href="{{ route('pdf.download_sub_category') }}"><button class="btn btn-primary">Download Sub category</button></a>
                <a href="{{ route('pdf.download_sub_sub_category') }}"><button class="btn btn-primary">Download Sub Sub category</button></a>
                <a href="{{ route('pdf.download_brand') }}"><button class="btn btn-primary">Download Brand</button></a>
                <a href="{{ route('pdf.download_return') }}"><button class="btn btn-primary">Download Return Policy</button></a>
            </div>
            <br>
        </div>
    </div>

    <div class="panel">
        <div class="panel-heading">
            <h1 class="panel-title"><strong>{{__('Upload Product File')}}</strong></h1>
        </div>
        <div class="panel-body">
            <form class="form-horizontal" action="{{ route('bulk_product_upload') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <input type="file" class="form-control" name="bulk_file" required>
                </div>
                @if(permission_check_all('bulk_upload') || permission_check_post('bulk_upload') )
                <div class="form-group">
                    <div class="col-lg-12">
                    @if(Session::get('rows')>0)
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#uploadProducts">{{ __('Upload Images') }}</button>
                    @else
                        <button class="btn btn-primary" type="submit">{{__('Upload CSV')}}</button>
                    @endif
                    </div>
                </div>
                @endif
            </form>
        </div>
    </div>


@if(Session::get('rows')>0)
<!-- Modal -->
<div class="modal fade" id="uploadProducts" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Upload Images</h5>
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
            <button type="submit" class="btn btn-primary" id="submit">Save Images</button>
        </div>
     </form>
    </div>
    </div>
</div>
@endif
@endsection

@section('script')
<script>
       $('#submit').css('opacity','0');

    @if(Session::get('rows')>0)
        $('#uploadProducts').modal('show')
    @endif
    $('input[type=file]').change(function () {
    fileCount = this.files.length;
    if(fileCount>{{Session::get('rows')}} ){
       alert("Please Upload {{Session::get('rows')}} Images you upload "+fileCount+" Images");
       $('#submit').css('opacity','0');
       throw new Error("Something went badly wrong!");
   }
   else if(fileCount=={{Session::get('rows')}} ){
    $('#submit').css('opacity',1);
   }
});
function deleteData(id){
    $.post('{{ route('delete_data') }}', {_token: '{{ csrf_token()}}', id:id}, function(data){
});}
</script>
@endsection
