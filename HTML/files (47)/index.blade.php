@extends('layouts.app')

@section('content')
    <div class="row">
			<div class="panel-heading">
				<h3 class="panel-title">{{__('Product Information')}}</h3>
			</div>
			<div class="panel-body">
				<div class="tab-base">
				    <!--Nav tabs-->
				    <ul class="nav nav-tabs">
				        <li class="active">
				            <a data-toggle="tab" href="#demo-stk-lft-tab-1" aria-expanded="true">{{__('All Promoted Products')}}</a>
				        </li>
				        <li class="">
				            <a data-toggle="tab" href="#demo-stk-lft-tab-2" aria-expanded="false">{{__('Set Days & Price')}}</a>
                        </li>
                        <li class="">
				            <a data-toggle="tab" href="#demo-stk-lft-tab-3" aria-expanded="false">{{__('Promote Admin Product')}}</a>
				        </li>

				    </ul>

				    <!--Tabs Content-->
				    <div class="tab-content">

						<div id="demo-stk-lft-tab-1" class="tab-pane fade active in">
                            <table class="table table-striped res-table mar-no" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{__('Name')}}</th>
                                        <th>{{__('Price')}}</th>
                                        <th>{{__('User Email')}}</th>
                                        <th>{{__('Start time')}}</th>
                                        <th>{{__('Expire Time')}}</th>
                                        @if(permission_check_all('promotes')|| permission_check_delete('promotes') )
                                            <th>{{__('Delete')}}</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($promotedProducts as $key => $promote)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>{{$promote->name}}</td>
                                        <td>{{$promote->price}}</td>
                                        <td>{{$promote->user_email}}</td>
                                        <td> @php $date = explode(" ",$promote->created_at);@endphp {{$date[0]}}</td>
                                        <td>
                                            @php
                                               echo date('Y-m-d', strtotime($date[0]. ' + '.$promote->days.' days'));
                                            @endphp</td>
                                            @if(permission_check_all('promotes')|| permission_check_delete('promotes') )
                                                <td>
                                                    <a href="{{  route('promote_destroy',["id"=>$promote->id])  }}" class="btn btn-sm btn-danger">x</a>
                                                </td>
                                            @endif
                                      </tr>
                                     @endforeach
                                </tbody>
                            </table>
                        </div>

						<div id="demo-stk-lft-tab-2" class="tab-pane fade">
                            <form action="{{ action('PromoteProductsController@store') }}" method="POST" >
                                @csrf
                                <table class="table table-striped res-table mar-no" cellspacing="0" width="100%">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Days</th>
                                        <th>{{__('Price')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>3 Days </td>
                                        <td>
                                        <div class="form-group" style="width:100%"><input type="number" class="form-control"name="threeDays" value="{{$threeDays}}" placeholder="3 Days" style="border:1px solid gray;width:100%"></div>
                                        </td>
                                    </tr>
                                    <input type="hidden" name="id" value="{{$id}}">
                                    <tr>
                                        <td>1</td>
                                        <td>7 Days</td>
                                        <td>
                                            <div class="form-group" style="width:100%"><input type="number" class="form-control"  name="sevenDays" value="{{$sevenDays}}" placeholder="7 Days" style="border:1px solid gray;width:100%"></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>14 Days</td>
                                        <td>
                                            <div class="form-group" style="width:100%"><input type="number" class="form-control"name="forteenDays" value="{{$forteenDays}}" placeholder="14 Days" style="border:1px solid gray;width:100%"></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td>28 Days</td>
                                        <td>
                                        <div class="form-group" style="width:100%"><input type="number" class="form-control" name="twenteeneightDays" value="{{$twenteeneightDays}}" placeholder="28 Days" style="border:1px solid gray;width:100%"></div>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                             <div class="clearfix">
                                    @if(permission_check_all('promote_prices') || permission_check_delete('promote_prices') || permission_check_post('promote_prices') || permission_check_put('promote_prices') )
                                        <div class="pull-right">
                                            <input class="btn btn-primary " type="submit" value="send">
                                        </div>
                                    @endif
                             </div>
                            </form>
                        </div>

                        <div id="demo-stk-lft-tab-3" class="tab-pane fade">
                            <form action="{{ action('PromoteProductsController@store') }}" method="POST" >
                                @csrf
                                <table class="table table-striped res-table mar-no" cellspacing="0" width="100%">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Unit Price</th>
                                        <th>From</th>
                                        <th>To</th>
                                        <th>Bulk Products</th>
                                        <th>Promote</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach (App\Product::where('added_by','admin')->get() as $key=>$product)
                                        <tr>
                                            <td>{{$key+1}}</td>
                                            <td>{{$product->name}}</td>
                                            <td>{{ $product->unit_price }}</td>
                                            @php $PP = App\promote::where('product_id',$product->id)->first(); @endphp
                                            @if($PP)
                                            @php $PP_created = Carbon\Carbon::parse($PP->created_at);  @endphp
                                                <td>
                                                    {{$PP_created->format('d-m-Y')}}
                                                </td>
                                                <td>
                                                    {{ $PP_created->addDays($PP->days)->format('d-m-Y')}}
                                                </td>
                                            @else
                                                <td>--</td>
                                                <td>--</td>
                                            @endif

                                            <td>
                                                <input type="checkbox" name="promote_product" onchange="change(this)" value="{{$product->id}}" class="checkbox" >
                                            </td>
                                            @if($PP)
                                            <td> <span class="d-block title heading-3 strong-400"><a href="{{$product->id}}" data-toggle="modal" data-target="#{{$product->id}}" class="btn btn-danger">Update</a></span>
                                            @else
                                            <td> <span class="d-block title heading-3 strong-400"><a href="{{$product->id}}" data-toggle="modal" data-target="#{{$product->id}}" class="btn btn-primary">Promote</a></span>
                                            @endif
                                            </tr>
                                                @endforeach
                                    </tbody>
                                </table>
                            </form>
                        </div>
                        <div class="panel-footer text-right" id="bulkPromote" style="display: none">
                            <input  data-toggle="modal" data-target="#bulkData" type="submit" class="btn btn-info btn-sm" value="Promote Multiple">
                        </div>
					</div>
				</div>
            </div>
    </div>


    <div class="modal fade" id="bulkData" tabindex="-1" role="dialog" aria-labelledby="bulkData" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <form action="{{route('bulk_promote-admin')}}" method="POST" id="promoted_product_form">
                            @csrf
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Promotes Products</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="Days">Days</label>
                                    <select name="days" class="form-control Days" onchange="selectDays(this)">
                                        <option selected value="0">Please select</option>
                                        <option value="3">3 days</option>
                                        <option value="7">7 days</option>
                                        <option value="14">14 days</option>
                                        <option value="28">28 days</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                        <input id="product_ids" name="product_ids"  type="hidden">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="button" onclick="bulk_product()" class="btn btn-success">Conform</button>
                            </div>
                        </form>
                    </div>
            </div>
    </div>




    @foreach (App\Product::where('added_by','admin')->get() as $product)
    <div class="modal fade" id="{{$product->id}}" tabindex="-1" role="dialog" aria-labelledby="{{$product->id}}" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <form method="POST" action="{{route('promoted-products-admin')}}">
                        @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Promote Product  {{$product->name}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @php $PP = App\promote::where('product_id',$product->id)->first(); @endphp
                            @if($PP)
                                <div class="form-group">
                                    <label for="Days">Days</label>
                                    <select name="days" class="form-control"  onchange="selectDays(this)">
                                        <option value="0">Please select</option>
                                        <option value="3"  {{$PP->days==3?'selected':''}}>3 days</option>
                                        <option value="7"  {{$PP->days==7?'selected':''}}>7 days</option>
                                        <option value="14" {{$PP->days==14?'selected':''}}>14 days</option>
                                        <option value="28" {{$PP->days==28?'selected':''}}>28 days</option>
                                    </select>
                                    <input type="hidden" name="product_name" value="{{$PP->product->name}}">
                                    <input type="hidden" name="product_id" value="{{$PP->product->id}}">
                                    <input type="hidden" name="thumbnail_img" value="{{$PP->product->thumbnail_img}}">
                                </div>
                            @else
                            <div class="form-group">
                                <label for="Days">Days</label>
                                <select name="days" class="form-control"  onchange="selectDays(this)">
                                    <option selected value="0">Please select</option>
                                    <option value="3">3 days</option>
                                    <option value="7">7 days</option>
                                    <option value="14">14 days</option>
                                    <option value="28">28 days</option>
                                </select>
                                <input type="hidden" name="product_name" value="{{$product->name}}">
                                <input type="hidden" name="product_id" value="{{$product->id}}">
                                <input type="hidden" name="thumbnail_img" value="{{$product->thumbnail_img}}">
                            </div>
                            @endif
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Confirm</button>
                    </div>
                </form>
                </div>
        </div>
    </div>
    @endforeach


    @section('script')
    <script>
        var price = 0;
        var days = 0;
            function selectDays(el){
                value = el.value;
                $.get('{{ route('get-price') }}',{_token:'{{ csrf_token() }}', value:value}, function(data){
                             if(data == 'not_Allowed' ){
                                    showFrontendAlert('danger', 'Something went wrong');
                             }else{
                                var placeholder = $(".modal-body").find('.promoted_price');
                                placeholder.val(data);
                                days = value;
                                price = days;
                             }
                         });
            }

            function bulk_product(){
                   product_ids =  getCheckedBoxes("promote_product");
                   $('#product_ids').val(product_ids);

                   $('#promoted_product_form').submit();
                }

                function change(el){
                    if(getCheckedBoxes('promote_product').length>1){
                        $('#bulkPromote').css('display','block')
                    }else{
                        $('#bulkPromote').css('display','none')
                    }
                }

                function getCheckedBoxes(chkboxName) {
                var checkboxes = document.getElementsByName(chkboxName);
                var checkboxesChecked = [];
                for (var i=0; i<checkboxes.length; i++) {
                    if (checkboxes[i].checked) {
                        checkboxesChecked.push(checkboxes[i].value);
                    }

                }
                return checkboxesChecked.length > 0 ? checkboxesChecked : null;
                }

      </script>

@endsection
@endsection
