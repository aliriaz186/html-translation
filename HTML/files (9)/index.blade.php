@extends('layouts.app')

@section('content')
<!-- Basic Data Tables -->
<!--===================================================-->

<div class="row">
    <div class="col-sm-12">
        <a data-toggle="modal" data-target="#expire_all" class="btn btn-rounded btn-info pull-right">{{__('Expire Date All')}}</a>
    </div>
</div>

<br>

<div class="row">
    <div class="panel">
    
    <div class="panel-heading">
        <h3 class="panel-title">{{__('Classified Products')}}</h3>
    </div>
    <div class="panel-body">
        <table class="table table-striped table-bordered demo-dt-basic" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>#</th>
                    <th>{{__('Name')}}</th>
                    <th>{{__('Image')}}</th>
                    <th>{{__('Uploaded By')}}</th>
                    <th>{{__('Customer Status')}}</th>
                    <th>{{__('Published')}}</th>
                    <th>{{__('E.Date')}}</th>
                    <th width="10%">{{__('Options')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $key => $product)
                    <tr>
                        <td>{{$key+1}}</td>
                        <td><a href="{{ route('customer.product', $product->slug) }}" target="_blank">{{$product->name}}</a></td>
                        <td><img class="img-md" src="{{ asset($product->thumbnail_img) }}" alt="Logo"></td>
                        <td>{{$product->user->email}}</td>
                        <td>
                            @if ($product->status == 1)
                                <span class="badge badge-success">{{ __('PUBLISHED') }}</span>
                            @else
                                <span class="badge badge-danger">{{ __('UNPUBLISHED') }}</span>
                            @endif
                        </td>
                        <td>
                            <label class="switch">
                            <input onchange="update_published(this)" value="{{ $product->id }}" type="checkbox" <?php if($product->published == 1) echo "checked";?> >
                            <span class="slider round"></span></label>
                        </td>
                        
                        <td>
                        @if($product->expire_date==null)
                         00-00-0000
                       @else
                       	{{$product->expire_date}}
                       @endif 
                       
                        </td>
                        <td>
                            <div class="btn-group dropdown">
                                <button class="btn btn-primary dropdown-toggle dropdown-toggle-icon" data-toggle="dropdown" type="button">
                                    {{__('Actions')}} <i class="dropdown-caret"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-right">
                                     @if($product->expire_date!=null)
                                     	 <li><a data-toggle="modal" data-target="#expre" onclick="edit_chat_modal('{{$product->name}}',{{$product->id}},'{{ date('Y-m-d\TH:i', strtotime($product->expire_date)) }}')">{{__('Edit Expire')}}</a></li>
                                     @else
                                      <li><a data-toggle="modal" data-target="#expre" onclick="show_chat_modal('{{$product->name}}',{{$product->id}})">{{__('Add Expire')}}</a></li>
                                     @endif
                                    @if(permission_check_all('customer_product') || permission_check_get('customer_product') )
                                        <li><a href="{{route('customer.product', $product->slug)}}">{{__('Show')}}</a></li>
                                    @endif
                                    @if(permission_check_all('customer_product') || permission_check_delete('customer_product') )
                                        <li><a onclick="confirm_modal('{{route('customer_products.destroy', $product->id)}}}}');">{{__('Delete')}}</a></li>
                                    @endif
                                </ul>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        </div>
    </div>
</div>

<div class="modal fade" id="expre" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <form method="get" action="{{route('classified.expire_date')}}">
        <div class="modal-header">
        <h5 class="modal-title" id="product-name">Expire Date</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       	<input type="datetime-local" class="form-control mb-3" name="expire_date" id="product-expire" required >
        <input type="hidden" class="form-control mb-3" name="product_id" placeholder="product Id" id="product-id" required readonly>					                       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Set</button>
      </div>
  </form>
    </div>
  </div>
</div>

<!----All-->

<div class="modal fade" id="expire_all" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <form method="get" action="{{route('classified.expire_date_all')}}">
        <div class="modal-header">
        <h5 class="modal-title">Expire Date For All Products</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label for="expire_all">Expire Date </label>
       	  <input type="number" placeholder="Enter the date " id="expire_all" class="form-control mb-3" name="expire_date" required > 
       	</div> 
       	 <div class="form-group">
          <label for="expire_excluded">Exclude Product</label>
       	   <select style="width:150px !important" multiple name="classified_exclude_products[]" id="expire_excluded" data-placeholder="Excluded List" class="form-control demo-select2-placeholder">
       	   	@foreach($products as $product)
       	   	   <option value="{{$product->id}}">{{$product->name}} </option>
       	   	@endforeach
       	   </select> 
       	</div> 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Set</button>
      </div>
  </form>
    </div>
  </div>
</div>


@endsection


@section('script')
    <script type="text/javascript">

        $(document).ready(function(){
            //$('#container').removeClass('mainnav-lg').addClass('mainnav-sm');
        });
	
	  function show_chat_modal(name, id){
            $("#product-name").html(name);
            $("#product-id").val(id);
            $("#product-expire").val('');
        }
        
          function edit_chat_modal(name, id,expire){
            $("#product-name").html(name);
            $("#product-id").val(id);
            $("#product-expire").val(expire);
        }
        
        function update_published(el){
            if(el.checked){
                var status = 1;
            }
            else{
                var status = 0;
            }
            $.post('{{ route('classified_products.published') }}', {_token:'{{ csrf_token() }}', id:el.value, status:status}, function(data){
                if(data == 1){
                    showAlert('success', 'Published products updated successfully');
                }
                else{
                    showAlert('danger', 'Something went wrong');
                }
            });
        }
        

    </script>
@endsection
