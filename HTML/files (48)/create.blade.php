
@extends('layouts.app')

@section('content')

<div class="col-lg-8 col-lg-offset-2">
    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title">{{__('Create Raffle')}}</h3>
        </div>
        <!--===================================================-->
        <form class="form-horizontal" action="{{ route('raffles.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="panel-body">
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="name">{{__('Status')}}</label>
                    <div class="col-sm-9" style="margin-top:10px">
                        <label class="switch">
                            <input type="checkbox" name="status">
                            <span class="slider round"></span>
                      </label>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="name">{{__('Start Date')}}</label>
                    <div class="col-sm-9">
                        <input type="datetime-local" id="start_date" name="start_date" class="form-control" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="end_date">{{__('End Date')}}</label>
                    <div class="col-sm-9">
                        <input type="datetime-local" id="end_date" name="end_date" class="form-control" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="end_date">{{__('Cut Off Date')}}</label>
                    <div class="col-sm-9">
                        <input type="datetime-local" id="end_date" name="cutoff_date" class="form-control" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">{{__('Product  Image')}}</label>
                    <div class="col-sm-9">
                        <input type="file" name="product_image[]" multiple accept="image/*" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">{{__('Products')}}</label>
                    <div class="col-sm-9">
                      <select name="product_to_show[]" id="product_to_show" class="demo-select2" multiple>
                          @foreach($products as $product)
                            <option value="{{$product->id}}">{{$product->name}}</option>
                          @endforeach
                        </select>
                    </div>
                </div>
               <div class="form-group">
                    <label class="col-sm-3 control-label">{{__('Short Description')}}</label>
                    <div class="col-sm-9">
                        <input ty class="form-control" name="short_desc" placeholder="{{__('Short Description')}}">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">{{__('Description')}}</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control editor" name="description" placeholder="{{__('Description')}}" >
                    </div>
                </div>
                 <div class="form-group">
                    <label class="col-sm-3 control-label">{{__('Term And Condations')}}</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control editor" name="termsAndCondations" placeholder="{{__('Term And Condations')}}" >
                    </div>
                </div>
           
            </div>
            <div class="panel-footer text-right">
                <button class="btn btn-purple" type="submit">{{__('Save')}}</button>
            </div>
        </form>
        <!--===================================================-->
        <!--End Horizontal Form-->
    </div>
</div>

@endsection

<script type="text/javascript">

    $(document).ready(function(){
        $('.demo-select2').select2();
    });

</script>
