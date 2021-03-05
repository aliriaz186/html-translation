@extends('frontend.layouts.app')

@section('content')

    <section class="gry-bg py-4 profile">
        <div class="container-fluid p-4">
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
                                        {{__('Promote Products')}}
                                    </h2>
                                </div>
                                <div class="col-md-6">
                                    <div class="float-md-right">
                                        <ul class="breadcrumb">
                                            <li><a href="{{ route('home') }}">{{__('Home')}}</a></li>
                                            <li><a href="{{ route('dashboard') }}">{{__('Dashboard')}}</a></li>
                                            <li><a href="{{ route('promoteproducts') }}">{{__('Promote Products')}}</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                             <div class="card no-border mt-4" style="width:100%">
                                <div class="card-header py-2">
                                    <div class="row align-items-center">
                                        <div class="col-md-2 ">
                                            <h6 class="mb-0">All Products</h6>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="bulk" id="bulk">
                                              <input data-toggle="modal" data-target="#bulkData" type="submit" class="btn btn-info btn-sm" id="promote_multiple_button" value="Promote Multiple">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-xl-3 ml-auto">
                                            <form class="" action="" method="GET">
                                                <input type="text" class="form-control" id="search" name="search" @isset($search) value="{{ $search }}" @endisset placeholder="Search product">
                                            </form>
                                        </div>
                                    </div>
                                </div>
                           <ul class="nav nav-tabs mt-3" id="myTab" role="tablist">
                             <li class="nav-item"><a class="nav-link active" id="all-tab" data-toggle="tab" href="#all" role="tab" aria-controls="all" aria-selected="false">All Products</a></li>
                             <li class="nav-item"><a class="nav-link " id="promoted-tab" data-toggle="tab" href="#promoted" role="tab" aria-controls="promoted" aria-selected="true">Promoted</a></li>
                             <li class="nav-item"><a class="nav-link " id="graph-tab" data-toggle="tab" href="#graph" role="tab" aria-controls="graph" aria-selected="false">Graph</a></li>
                          </ul>
                        <div class="tab-content" id="myTabContent">
                              <div class="tab-pane fade show active" id="all" role="tabpanel" aria-labelledby="all-tab">    	
                               	<table class="table res-table mar-no table-responsive-md" cellspacing="0" width="100%">
                                    <thead>
					<tr>
						<th>#</th>
						<th width="10%"><input type="checkbox" name="bulk[]" onchange="checkAll(this)"> <span>{{__('Bulk')}}</span> </th>
						<th>{{__('Name')}}</th>
						<th>{{__('Sub Subcategory')}}</th>
						<th>{{__('Current Qty')}}</th>
                        			<th>{{__('Base Price')}}</th>
						<th>{{__('Promoted')}}</th>
						<th>{{__('Promote')}}</th>
					</tr>
				     </thead>
					    <tbody>
                            @foreach ($products as $key => $product)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                        <td>
                                        <input type="checkbox" name="promote_product" onchange="show_button()" value="{{$product->id}}" class="checkbox" >
                                    </td>
                                    <td>
                                        <a href="{{ route('product', $product->slug) }}" target="_blank" id="productName{{$product->id}}">
                                            {{ __($product->name) }}
                                        </a>
                                    </td>
                                    <td> {{ $product->subsubcategory != null?$product->subsubcategory->name:'' }}</td>
                                    <td>@php $qty = 0; if($product->variant_product){ foreach ($product->stocks as $key => $stock) { $qty += $stock->qty; } } else{ $qty = $product->current_stock; } echo $qty; @endphp</td>
                                    <td>{{ $product->unit_price }}</td>
                                    <td>{{App\promote::where('product_id',$product->id)->first()?'Yes':'No'}}</td>
                                    <td> <span class="d-block title heading-3 strong-400"><a href="{{$product->id}}" data-toggle="modal" data-target="#{{$product->id}}" class="btn btn-success text-white">promote</a></span>
                                    </td>
                                    
                                </tr>
                                @endforeach
                                    </tbody>
				                </table>
				                
                                <div class="pagination-wrapper py-4">
                                    <ul class="pagination justify-content-end">
                                        {{ $products->links() }}
                                    </ul>
                                </div>
                                </div>
                                <div class="tab-pane fade" id="promoted" role="tabpanel" aria-labelledby="promoted-tab">   
                                    <table class="table res-table mar-no table-responsive-md" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>{{__('Name')}}</th>
                                                <th>{{__('Sub Subcategory')}}</th>
                                                <th>{{__('Current Qty')}}</th>
                                                <th>{{__('Base Price')}}</th>
                                                <th>{{__('Start Date')}}</th>
                                                <th>{{__('Expiry Date')}}</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($promoteProducts as $key=>$promote_product)
                                                <tr>
                                                    <td>{{$key+1}}</td>
                                                    <td>
                                                        <a href="{{ route('product', $promote_product->product->slug) }}" target="_blank">
                                                            {{ __(Illuminate\Support\Str::limit($promote_product->product->name,45,'...')) }}
                                                        </a>
                                                    </td>
                                                    <td> {{ $promote_product->product->subsubcategory != null?$promote_product->product->subsubcategory->name:'' }}</td>
                                                    <td>@php $qty = 0; if($promote_product->product->variant_product){ foreach ($promote_product->product->stocks as $key => $stock) { $qty += $stock->qty; } } else{ $qty = $promote_product->product->current_stock; } echo $qty; @endphp</td>
                                                    <td>{{ $promote_product->product->unit_price }}</td>
                                                    <td>{{$promote_product->created_at->format('Y-m-d @ H:i:s')}}</td>
                                                    <td>{{Carbon\Carbon::parse($promote_product->ceated_at)->addDays($promote_product->expire_date)->format('Y-m-d @ H:i:s')}}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>

                                </div>
                                
                                <div class="tab-pane fade" id="graph" role="tabpanel" aria-labelledby="graph-tab">    	
                                </div>              
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
        @foreach ($products as $product)
        <div class="modal fade" id="{{$product->id}}" tabindex="-1" role="dialog" aria-labelledby="{{$product->id}}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <form method="POST" action="{{route('promoted-products')}}">
                            @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Promote Product  {{$product->name}}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                                    <div class="form-group">
                                        <label for="Days">Days</label>
                                        <select name="days" class="form-control"  onchange="selectDays(this)">
                                            <option selected value="0">Please select</option>
                                            <option value="3">3 days</option>
                                            <option value="7">7 days</option>
                                            <option value="14">14 days</option>
                                            <option value="28">28 days</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="price">Price</label>
                                        <input type="text" readonly class="form-control promoted_price" id="promoted_price{{$product->id}}" value="230" name="price" placeholder="Please select the Days">
                                        <input type="hidden" name="product_name" value="{{$product->name}}">
                                        <input type="hidden" name="product_id" value="{{$product->id}}">
                                        <input type="hidden" name="thumbnail_img" value="{{$product->thumbnail_img}}">
                                    </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success">Confirm</button>
                        </div>
                    </form>
                    </div>
            </div>
        </div>
        @endforeach

		<div class="modal fade" id="bulkData" tabindex="-1" role="dialog" aria-labelledby="bulkData" aria-hidden="true">
            <form action="{{route('bulk_promote')}}" method="POST" id="form">
                @csrf
            <div class="modal-dialog modal-dialog-centered" role="document">
						<div class="modal-content">
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
									<label for="price">Price per product</label>
									<input type="text" readonly="" class="form-control promoted_price  " id="promoted_price" value="230" name="price" placeholder="Please select the Days">
									<input id="product_ids" name="product_ids"  type="hidden">
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
								<button type="button" onclick="bulk_product()" class="btn btn-success">Conform</button>
							</div>
						</div>
                    </div>
                </form>
            </div>


        @endsection
@section('script')
<script>
   $('#promote_multiple_button').fadeOut();
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

            $('#form').submit();
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

   function show_button(){
     value =  getCheckedBoxes('promote_product');
     if(value){
     	
   $('#promote_multiple_button').fadeIn();
     }
     else{
     
   $('#promote_multiple_button').fadeOut();
     }
   }

   function checkAll(el){
   if(el.checked){value = true; $('#promote_multiple_button').fadeIn();}else{$('#promote_multiple_button').fadeOut();;value = false;}
   $(':checkbox').each(function() {
            this.checked = value;                        
        });
   }
  </script>
@endsection
