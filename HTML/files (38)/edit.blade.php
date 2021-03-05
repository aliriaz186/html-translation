
@extends('layouts.app')

@section('content')

<div class="col-lg-10 col-lg-offset-1">
    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title">{{__('Edit Lottery')}}</h3>
        </div>
        <!--===================================================-->
        <form class="form-horizontal" action="{{ route('spin2win.update',$lottery->id) }}"  method="POST" enctype="multipart/form-data">
            <input name="_method" type="hidden" value="PATCH">
            @csrf
            <div class="panel-body">
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="name">{{__('Status')}}</label>
                    <div class="col-sm-9" style="margin-top:10px">
                        <label class="switch" {{$lottery->status == 1?'checked':''}}>
                            <input type="checkbox" name="status">
                            <span class="slider round"></span>
                      </label>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="name">{{__('Start Date')}}</label>
                    <div class="col-sm-9">
                        <input type="datetime-local" id="start_date" name="start_date" class="form-control" required value="{{ $lottery->start_date }}">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="end_date">{{__('End Date')}}</label>
                    <div class="col-sm-9">
                        <input type="datetime-local" id="end_date" name="end_date" class="form-control" required value="{{ $lottery->end_date }}">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">{{__('Product  Image')}}</label>
                    <div class="col-sm-9">
                        @foreach (json_decode($lottery->product_image) as $key => $photo)
                        <div class="col-md-4 col-sm-4 col-xs-6">
                            <div class="img-upload-preview">
                                <img loading="lazy"  src="{{ asset($photo) }}" alt="" class="img-responsive">
                                <input type="hidden" name="previous_photos[]" value="{{ $photo }}">
                                <button type="button" class="btn btn-danger close-btn remove-files"><i class="fa fa-times"></i></button>
                            </div>
                        </div>
                    @endforeach
                    <input type="file" name="product_image[]" multiple accept="image/*" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">{{__('Products Name')}}</label>
                    <div class="col-sm-9">
                      <input type="text" name="product_name" class="form-control" value="{{$lottery->product_name}}">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">{{__('Products To Show')}}</label>
                    <div class="col-sm-9">
                      <select name="product_id[]" id="product_to_show" class="demo-select2" multiple>
                        @foreach(json_decode($lottery->product_id) as $product_to_show)
                               @php $pro = App\Product::find($product_to_show); @endphp
                               <option selected value="{{$product_to_show}}">{{$pro->name}}</option>
                        @endforeach
                          @foreach($products as $product)
                            <option value="{{$product->id}}">{{$product->name}}</option>
                          @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-3 control-label">{{__('Amount')}}</label>
                    <div class="col-sm-9">
                        <input type="number" class="form-control" name="amount" placeholder="{{__('Amount')}}" value="{{ $lottery->amount }}">
                    </div>
                </div>

            </div>
            <div class="panel-footer text-right">
                <button class="btn btn-purple" type="submit">{{__('Update')}}</button>
            </div>
        </form>
        <!--===================================================-->
        <!--End Horizontal Form-->
    </div>
</div>

@endsection

@section('script')
        <script>
        $(document).ready(function(){
            $('.demo-select2').select2();
        });
        $('.remove-files').on('click', function(){
            $(this).parents(".col-md-4").remove();
        });
    </script>
@endsection
