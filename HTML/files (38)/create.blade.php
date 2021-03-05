@extends('layouts.app')

@section('content')

<style>
    .modal:before {
        height:32% !important;
    }
    </style>
<div class="row">

    <form class="form-horizontal" action="{{ route('spin2win.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
		<input type="hidden" name="added_by" value="admin">
		<div class="panel">
			<div class="panel-heading">
				<h3 class="panel-title">{{__('Lottery Information')}}</h3>
			</div>
			<div class="panel-body">
				<div class="tab-base tab-stacked-left" style="height: auto">
				    <!--Nav tabs-->
				    <ul class="nav nav-tabs">
				        <li class="active">
				            <a data-toggle="tab" href="#demo-stk-lft-tab-1" aria-expanded="true">{{__('General')}}</a>
				        </li>
				        <li class="">
				            <a data-toggle="tab" href="#demo-stk-lft-tab-2" aria-expanded="false">{{__('Slice')}}</a>
				        </li>
				    </ul>

				    <!--Tabs Content-->
				    <div class="tab-content">
				        <div id="demo-stk-lft-tab-1" class="tab-pane fade active in">
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
                                    <label class="col-sm-3 control-label">{{__('Products To Show')}}</label>
                                    <div class="col-sm-9">
                                      <select name="product_id[]" id="product_to_show" class="demo-select2" multiple>
                                          @foreach($products as $product)
                                            <option value="{{$product->id}}">{{$product->name}}</option>
                                          @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">{{__('Quantuty')}}</label>
                                    <div class="col-sm-9">
                                        <input type="number" class="form-control" name="quantity" placeholder="{{__('Quantity')}}">
                                    </div>
                                </div>
				        </div>
				        <div id="demo-stk-lft-tab-2" class="tab-pane fade">
                            <div class="row">
                                <div class="col-sm-12">
                                    <a href="{{ route('spin2win.create.slice')}}" class="btn btn-rounded btn-info pull-right">
                                        {{__('Create Slices')}}
                                    </a>
                                </div>
                            </div>
                            <br>
                                <table class="table table-stripped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>S.No</th>
                                            <th>Coupon Type</th>
                                            <th>Label</th>
                                            <th>Coupon Value</th>
                                            <th>Gravity</th>
                                            <th></th>
                                        </tr>
                                        <tbody>
                                            @php $ids = array(); @endphp
                                                @foreach (App\LotterySlice::all() as $key=>$ls)
                                                    <tr>
                                                        <td>{{$key+1}}</td>
                                                        <td>{{$ls->type}}</td>
                                                        <td>{{$ls->label}}</td>
                                                        <td>{{$ls->value}}</td>
                                                        <td>{{$ls->gravity}}</td>
                                                    <td><button class="btn btn-info btn-sm" type="button"  data-toggle="modal" data-target="#slice{{$key}}" >Edit</button></td>
                                                        @php array_push($ids,$ls->id) @endphp
                                                </tr>
                                                @endforeach
                                        </tbody>
                                    </thead>
                                </table>
				        </div>
				    </div>
				</div>
            </div>
           <input type="hidden" name="product_slice_ids" id="" value="{{json_encode($ids)}}">
			<div class="panel-footer text-right">
				<button type="submit" name="button" class="btn btn-info">{{ __('Save') }}</button>
			</div>
		</div>
    </form>
</div>

@foreach(App\LotterySlice::all() as $key=>$ls)
<div class="modal fade" id="slice{{$key}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <form action="{{route('spin2win.slice.update',$ls->id)}}" method="POST">
    <input name="_method" type="hidden" value="PATCH">
    @csrf
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Slice {{$key+1}} Edit</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <div class="row">
                <label class="col-sm-3 control-label" for="name">{{__('Coupon Type')}}</label>
                <div class="col-sm-9">
                    <select name="type" id="" class="form-control" onchange="change(this,{{$key}})">
                        <option value="{{$ls->type}}" selected>{{$ls->type}}</option>
                        <option value="percentage">Percentage</option>
                        <option value="fixed">Fixed</option>
                        <option value="free_shipping">Free Shipping</option>
                        <option value="gifts">Gifts</option>
                        <option value="free">Free Offer</option>

                    </select>
                </div>
                </div>
            </div>
            <div class="form-group" id="gifts{{$key}}" @if($ls->type=='gifts') style="display:block" @else style="display:none" @endif >
                <div class="row">
                <label class="col-sm-3 control-label" for="end_date">{{__('Gifts')}}</label>
                <div class="col-sm-9">
                    <select name="gifts[]" id="gif1" class="form-control demo-select2" multiple>

                        @foreach(App\Product::all() as $gf)
                          <option value="{{$gf->id}}">{{$gf->name}}</option>
                        @endforeach
                    </select>
                </div>
                </div>
            </div>
            <div class="form-group" id="free_text{{$key}}" style="display: none">
                <div class="row">
                <label class="col-sm-3 control-label" for="end_date">{{__('Product Name')}}</label>
                <div class="col-sm-9">
                    <input type="text" name="product_name" placeholder="Name which offer" class="form-control" value="{{$ls->product_name}}">
                </div>
            </div>
            </div>
            <div class="form-group" id="free_image{{$key}}" style="display: none">
                <div class="row">
                <label class="col-sm-3 control-label" for="end_date">{{__('Product Image')}}</label>
                <div class="col-sm-9">
                    <input type="file" name="product_image" >
                </div>
            </div>
            </div>
            <div class="form-group">
                <div class="row">
                <label class="col-sm-3 control-label" for="label">{{__('Label')}}</label>
                <div class="col-sm-9">
                    <input type="text" name="label" class="form-control" value="{{$ls->label}}">
                </div>
            </div>
            </div>
            <div class="form-group">
                <div class="row">
                <label class="col-sm-3 control-label" for="value">{{__('Coupon Value')}}</label>
                <div class="col-sm-9">
                    <input type="number" name="value" class="form-control" value="{{$ls->value}}">
                </div>
            </div>
            </div>

            <div class="form-group">
                <div class="row">
                <label class="col-sm-3 control-label">{{__('Gravity')}}</label>
                <div class="col-sm-9">
                    <input type="number" min="0" max="100" name="gravity" value="{{$ls->gravity}}" class="form-control">
                </div>
            </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
   </form>
  </div>

@endforeach


@endsection

<script>
  $(document).ready(function(){
        $('.demo-select2').select2();
    });


    function change(e,key){
    selected_value = e.value;
            if(selected_value == 'gifts'){
                $('#gifts'+key).css('display','block');
                $('#free_text'+key).css('display','none');
                $('#free_image'+key).css('display','none');
            }else if (selected_value == 'free'){
                console.log(key);
                $('#free_text'+key).css('display','block');
                $('#free_image'+key).css('display','block');
                $('#gifts'+key).css('display','none');
            }
            else{
                $('#free_text'+key).css('display','block');
                $('#free_image'+key).css('display','block');
                $('#gifts'+key).css('display','none');
            }
      }
    </script>
