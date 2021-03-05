
@extends('layouts.app')

@section('content')

<div class="col-lg-10 col-lg-offset-1">
    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title">{{__('Edit Raffle')}}</h3>
        </div>
        <!--===================================================-->
        <form class="form-horizontal" action="{{ route('raffles.update',$raffle->id) }}"  method="POST" enctype="multipart/form-data">
            <input name="_method" type="hidden" value="PATCH">
            @csrf
            <div class="panel-body">
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="name">{{__('Status')}}</label>
                    <div class="col-sm-9 mt-1">
                        <label class="switch" >
                            <input type="checkbox" name="status" {{$raffle->status== 1?'checked':''}}>
                            <span class="slider round"></span>
                      </label>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="name">{{__('Start Date')}}</label>
                    <div class="col-sm-9">
                        <input type="datetime-local" id="start_date" name="start_date" class="form-control" required value="{{ Carbon\Carbon::parse($raffle->start_date)->format('Y-m-d\TH:i') }}">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="cutoff_date">{{__('Cutoff Date')}}</label>
                    <div class="col-sm-9">
                        <input type="datetime-local" id="cutoff_date" name="cutoff_date" class="form-control" required value="{{ Carbon\Carbon::parse($raffle->cutoff_date)->format('Y-m-d\TH:i') }}">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="end_date">{{__('End Date')}}</label>
                    <div class="col-sm-9">
                        <input type="datetime-local" id="end_date" name="end_date" class="form-control" required value="{{ Carbon\Carbon::parse($raffle->end_date)->format('Y-m-d\TH:i') }}">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">{{__('Product  Image')}}</label>
                    <div class="col-sm-9">
                        @foreach (json_decode($raffle->product_image) as $key => $photo)
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
                    <label class="col-sm-3 control-label">{{__('Products')}}</label>
                    <div class="col-sm-9">
                      <select name="product_to_show[]" id="product_to_show" class="demo-select2" multiple>
                        @foreach(json_decode($raffle->product_to_show) as $product_to_show)
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
                    <label class="col-sm-3 control-label">{{__('Short Description')}}</label>
                    <div class="col-sm-9">
                    <input ty class="form-control" name="short_desc" value="{{$raffle->short_desc}}" placeholder="{{__('Short Description')}}">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">{{__('Description')}}</label>
                    <div class="col-sm-9">
                        <textarea type="text" class="form-control editor" name="description" >
                            {{ $raffle->description }}
                        </textarea>
                    </div>
                </div>
	        <div class="form-group">
                    <label class="col-sm-3 control-label">{{__('Term And Condations')}}</label>
                    <div class="col-sm-9">
                        <textarea  class="form-control editor" name="termsAndCondations" >
                         {{ $raffle->termsAndCondations}}
                        </textarea>
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
