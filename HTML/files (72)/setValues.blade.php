@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-lg-12 pull-right">
            <a class="btn btn-rounded btn-info pull-right mr-1" data-toggle="modal" data-target="#feature--modal">{{__('Add New Feature')}}</a>

          <a class="btn btn-rounded btn-warning pull-right" data-toggle="modal" data-target="#create">{{__('Add New Package')}}</a>
        </div>
    </div>

<br>
<div class="panel">
   <form action="{{ action('productSubscriptionController@store_admin_sub') }}" method="POST" >
      @csrf
      <!--Panel heading-->
      <div class="panel-heading bord-btm clearfix pad-all h-100">
         <h3 class="panel-title pull-left pad-no">{{ __('Subscription') }}</h3>
      </div>
      <div class="panel-body">
         <table class="table table-striped res-table mar-no" cellspacing="0" width="100%">
            <thead>
               <tr>
                  <th>#</th>
                  <th>Name</th>
                  {{-- <th>name</th> --}}
                  <th>{{__('Prices')}}</th>
                  <th>{{__('Product')}}</th>
                  <th>{{__('Days')}}</th>
                  <th>{{__('Freature')}}</th>
                  @if($subscription!='')
                  <th>{{__('List')}}</th>
                  <th>{{__('Delete')}}</th>
                  @endif
               </tr>
            </thead>
            <tbody>
               @if($subscription!='' && (permission_check_all('subscriptions_product_set') || permission_check_post('subscriptions_product_set') ||  permission_check_delete('subscriptions_product_set')  ) )
                 @foreach ($subscription as $key=>$sub)
                <tr>
                <td>{{($key+1)}}</td>
                 <td> <div class="form-group" style="width:100%"><input type="text" class="form-control" name="Type[]" placeholder="type" value="{{$sub->type}}" style="border:1px solid gray;width:100%"></div></td>
                 <td> <div class="form-group" style="width:100%"><input type="number" class="form-control" name="Price[]" value="{{$sub->prices}}" placeholder="Price" style="border:1px solid gray;width:100%"></div></td>
                 <td><div class="form-group" style="width:100%"><input type="number" class="form-control" name="Product[]" value="{{$sub->product}}" placeholder="Product" style="border:1px solid gray;width:100%"></div></td>
                 <td><div class="form-group" style="width:100%"><input type="number" class="form-control" name="Days[]" value="{{$sub->time}}" placeholder="Days" style="border:1px solid gray;width:100%"></div></td>
                <td><div class="form-group" style="width:100%">
                        <select name="Feature[]" id="feature" class="form-control">
                           @foreach(App\SubscriptionFeature::all() as $feature)
                                <option  {{$sub->feature==$feature->name? 'selected':''}} value="{{$feature->name}}">{{ucfirst($feature->name)}}</option>
                           @endforeach
                            </select>
                </div></td>
                <td><a class="btn btn-sm btn-info"  data-toggle="modal" data-target="#List--{{$sub->id}}">More</a></td>

               @if( permission_check_all('subscriptions_product_set') || permission_check_delete('subscriptions_product_set')  )
                <td><a href="{{route('deletePricing',$sub->id)}}" class="btn btn-sm btn-danger">x</a></td>
               @endif
                </tr>
                 @endforeach
              @else
               <tr>
                  <td>01</td>
                  <td>Free</td>
                  <td style="display: none"> <div class="form-group w-100 "><input type="hidden" class="form-control" name="Type[]" placeholder="type" value="free" style="border:1px solid gray;width:100%"></div></td>
                  <td> <div class="form-group w-100"><input type="number" class="form-control" name="Price[]" value="0" placeholder="Price" style="border:1px solid gray;width:100%"></div></td>
                  <td><div class="form-group w-100"><input type="number" class="form-control" name="Product[]" value="0" placeholder="Product" style="border:1px solid gray;width:100%"></div></td>
                  <td><div class="form-group w-100"><input type="number" class="form-control" name="Days[]" value="0" placeholder="Days" style="border:1px solid gray;width:100%"></div></td>
                  <td><div class="form-group w-100"><input type="number" class="form-control" name="feature[]" value="0" placeholder="Feature" style="border:1px solid gray;width:100%"></div></td>
                  {{-- <td><button type="button" onclick="addList(0)" class="btn btn-info btn-sm pull-right">Add More</button></td> --}}

                </tr>
               <tr>
                    <td>02</td>
                    <td>Basic</td>
                    <td style="display: none"> <div class="form-group w-100 "><input type="hidden" class="form-control" name="Type[]" placeholder="type" value="basic" style="border:1px solid gray;width:100%"></div></td>
                    <td> <div class="form-group" style="width:100%"><input type="number" class="form-control" name="Price[]" value="0" placeholder="Price" style="border:1px solid gray;width:100%"></div></td>
                    <td><div class="form-group" style="width:100%"><input type="number" class="form-control" name="Product[]" value="0" placeholder="Product" style="border:1px solid gray;width:100%"></div></td>
                    <td><div class="form-group" style="width:100%"><input type="number" class="form-control" name="Days[]" value="0" placeholder="Days" style="border:1px solid gray;width:100%"></div></td>
                    <td><div class="form-group" style="width:100%"><input type="number" class="form-control" name="feature[]" value="0" placeholder="Feature" style="border:1px solid gray;width:100%"></div></td>
                    {{-- <td><button type="button" onclick="addList(1)" class="btn btn-info btn-sm pull-right">Add More</button></td> --}}

                </tr>
                <tr>
                    <td>03</td>
                    <td>Pro</td>
                    <td style="display: none"> <div class="form-group w-100 "><input type="hidden" class="form-control" name="Type[]" placeholder="type" value="pro" style="border:1px solid gray;width:100%"></div></td>
                    <td> <div class="form-group" style="width:100%"><input type="number" class="form-control" name="Price[]" value="0" placeholder="Price" style="border:1px solid gray;width:100%"></div></td>
                    <td><div class="form-group" style="width:100%"><input type="number" class="form-control" name="Product[]" value="0" placeholder="Product" style="border:1px solid gray;width:100%"></div></td>
                    <td><div class="form-group" style="width:100%"><input type="number" class="form-control" name="Days[]" value="0" placeholder="Days" style="border:1px solid gray;width:100%"></div></td>
                    <td><div class="form-group" style="width:100%"><input type="number" class="form-control" name="feature[]" value="0" placeholder="Feature" style="border:1px solid gray;width:100%"></div></td>
                    {{-- <td><button type="button" onclick="addList(2)" class="btn btn-info btn-sm pull-right">Add More</button></td> --}}

                </tr>
         @endif
            </tbody>
         </table>
         @if( permission_check_all('subscriptions_product_set') || permission_check_post('subscriptions_product_set')  ||  permission_check_delete('subscriptions_product_set')  )
         <div class="clearfix">
            <div class="pull-right">
               <input class="btn btn-primary " type="submit" value="send">
            </div>
         </div>
         @endif
      </div>
    </form>
</div>

<!-- Modal -->
<div class="modal fade" id="create" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Create Package</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="{{ action('productSubscriptionController@create_package')}}" method="GET">
            <div class="modal-body">
                            <div class="form-group">
                                <label for="name">Package Name</label>
                                <input type="text" name="name" class="form-control" id="name">
                            </div>
                            <div class="form-group">
                                 <label for="price">Package Price</label>
                                  <input type="number" name="price" class="form-control" id="price">
                            </div>
                            <div class="form-group">
                                    <label for="product">Package Product</label>
                                    <input type="number" name="product" class="form-control" id="product">
                            </div>
                            <div class="form-group">
                                    <label for="time">Package Time</label>
                                    <input type="number" name="time" class="form-control" id="time">
                            </div>
                            <div class="form-group">
                                    <label for="feature">Featured</label>
                                    <select name="feature" id="feature" class="form-control">
                                       @foreach(App\SubscriptionFeature::all() as $feature)
                                        <option value="{{$feature->name}}">{{ucfirst($feature->name)}}</option>
                                       @endforeach 
                                    </select>
                            </div>
                            <div class="form-group">
                                  <label for="feature">Background Color</label>
                                  <input type="color" class="form-control" name="background_color"> 
                            </div>
                               <div class="form-group">
                                  <label for="feature">Ribbon Color</label>
                                  <input type="color" class="form-control" name="ribbon_color"> 
                            </div>

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <input type="submit" class="btn btn-primary">
                   </div>
                </form>

          </div>
        </div>
      </div>
      
      <div id="feature--modal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Features</h4>
      </div>
      <div class="modal-body">
       <table class="table table-bordered">
         <thead>
           <th> # </th>
           <th>Feature Name</th>
           <th>Option</th>
         </thead>
         <tbody>
         @forelse (App\SubscriptionFeature::all() as $index=>$feature)
         	<tr class="text-center">
         	<td>{{$index+1}}</td>
         	<td  class="text-left"> <p>{{ucfirst($feature->name)}}</p> </td>
         	<td> <a class="btn btn-danger btn-sm" href="{{route('delete-feature',$feature->id)}}"> <i class="fa fa-trash"></i> </a></td>
         	</tr>
         @empty
         	 <tr>
	                <td class="text-center pt-5 h4" colspan="100%">
	                    <i class="la la-meh-o d-block heading-1 alpha-5"></i>
	                <span class="d-block">{{ __('No history found.') }}</span>
	                </td>
	            </tr>
         @endforelse
         </tbody>
       </table> 
       <form method="post" action="{{route('add-feature')}}">
       @csrf
         <div class="row">
           <div class="col-lg-12">
          	<div class="form-group">
        	   <label for="feature">Feature</label>
       	 	   <input type="text" name="name" class="form-control" placeholder="Enter Feature Name">
          	</div>
            </div>
            <div class="col-lg-12">
                       <label></label>
            		<button type="submit" class="btn btn-primary pull-right" >Add</button>
  
            </div>
            </div>

        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
@if($subscription!='')
@foreach ($subscription as $index=>$sub)
    <div class="modal fade" id="List--{{$sub->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add List</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <form action="{{ route('subscription_list.extra')}}" method="POST">
                @csrf
              <div class="modal-body">
                <div class="form-group">
                    @if($sub->list!= null)
                        @foreach (json_decode($sub->list) as $list)
                            <label for="name">List </label>
                            <input type="text" name="list[]" value="{{$list}}" class="form-control">
                             <input type="hidden" name="id" value="{{$sub->id}}">
                        @endforeach
                    @else
                        <label for="name">List </label>
                        <input type="text" name="list[]" placeholder="List" class="form-control">
                        <input type="hidden" name="id" value="{{$sub->id}}">
                    @endif
                </div>
                <div id="addMore--{{$index}}">

                </div>
                <div class="form-group">
                    <button type="button" onclick="addList({{$index}})" class="btn btn-info btn-sm pull-right">Add More</button>
                </div>
                <br>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <input type="submit" class="btn btn-primary">
                     </div>
                  </form>
            </div>
          </div>
    </div>
@endforeach
@endif

@endsection

@section('script')
        <script>
        function addList(id){
              var set =
               `  <div class="form-group">
                    <label for="name">List</label>
                    <input type="text" name="list[]" class="form-control">
                </div>`;
                $('#addMore--'+id).append(set);
            }


        </script>
@endsection

