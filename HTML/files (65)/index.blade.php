@extends('layouts.app')

@section('content')


<!-- Basic Data Tables -->
<!--===================================================-->
<div class="panel">
    <div class="panel-heading">
        <h3 class="panel-title">{{__('Shops')}}</h3>
    </div>
    @php $shop = App\Shop::where('user_id',Auth::user()->id)->first(); @endphp
    @if($shop)
    <div class="panel-body">
            <table class="table table-striped table-bordered demo-dt-basic" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th width="10%">#</th>
                        <th>{{__('Name')}}</th>
                        <th>{{__('Logo')}}</th>
                        <th>{{__('Address')}}</th>
                        <th>{{__('Phone Number')}}</th>
                        <th>{{__('Tax Id')}}</th>
                        <th>{{__('Options')}}</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                    	<td>1</td>
                    	<td>{{$shop->name}}</td>
                    	<td width="20%">
                    	<div class="media-left">
                           <img loading="lazy"  class="img-md" src="{{ asset($shop->logo)}}" alt="Image">
                        </div>
                        <div class="media-body">{{ __($shop->name) }}</div>
                        </td>
                    	<td>{{$shop->address}}</td>
                    	<td>{{$shop->phone}}</td>
                    	<td>{{$shop->tax_id}}</td>
                    	<td>
                                <div class="btn-group dropdown">
                                <button class="btn btn-primary dropdown-toggle dropdown-toggle-icon" data-toggle="dropdown" type="button">
                                    {{__('Actions')}} <i class="dropdown-caret"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-right">
                                    @if(permission_check_all('shops') || permission_check_put('shops') )
                                        <li><a href="{{route('shops.edit', encrypt($shop->id))}}">{{__('Edit')}}</a></li>
                                    @endif
                                    @if(permission_check_all('shops') || permission_check_delete('shops') )
                                    <li><a onclick="confirm_modal('{{route('shops.destroy', $shop->id)}}');">{{__('Delete')}}</a></li>
                                    @endif
                                </ul>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        @else
        <form class="form-horizontal" action="{{ route('shops.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
        <div class="panel-body">
            <div class="form-group">
                <label class="col-sm-3 control-label" for="name">{{__('Store Name')}} <span class="required-star">*</span></label>
                <div class="col-sm-9">
                        <input type="text" class="form-control mb-3" id="searchName"  value="{{ old('name') }}" placeholder="{{__('Shop Name')}}" name="name" required>
                </div>
                <div class="spinner-border spinner_own no_package" id="spinner"></div>
                <div class="spinner_own no_package" id="tick">X</div>
                <div class="spinner_own no_package" id="cross">&check;</div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="logo">{{__('Logo')}}</label>
                <input type="file" name="logo" id="">
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="address">{{__('Address')}}  <span class="required-star">*</span></label>
                <div class="col-sm-9">
                            <input  value="{{ old('address') }}" type="text" class="form-control mb-3" placeholder="{{__('Address')}}" name="address" required>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="address">{{__('Phone Number')}} <span class="required-star">*</span></label>
                <div class="col-sm-9">
                            <input  value="{{ old('phone') }}" type="text" class="form-control mb-3" placeholder="{{__('Phone Number')}}" name="phone" required>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="address">{{__('Tax')}} <span class="required-star">*</span></label>
                <div class="col-sm-9">
                            <select name="tax" class="form-control" onchange="selectTax(this)">
                                <option value="default" selected>Please Select Type</option>
                                <option value="vat">Vat</option>
                                <option value="no_vat">No Vat</option>
                            </select>
                </div>
            </div>
            <div class="form-group"  id="tax_id">
                <label class="col-sm-3 control-label" for="address">{{__('Tax Id')}} <span class="required-star">*</span></label>
                <div class="col-sm-9">
                            <input type="text" class="form-control mb-3" placeholder="{{__('Id')}}" name="tax_id" value="">
                </div>
            </div>
            <div class="panel-footer text-right">
                <button class="btn btn-purple" type="submit">{{__('Save')}}</button>
            </div>
        </div>
        </form>
        @endif
</div>

@endsection

@section('script')
<script type="text/javascript">
    $(document).ready(function(){


     $('#searchName').keyup(function(){
    $('#spinner').css('display','block');
    $('#cross').css('display','none');
    $('#tick').css('display','none');
    var query = $(this).val();
    if(query != ''){
       $.ajax({
        url:"{{ route('shops.create.search') }}",
        method:"GET",
        data:{_token: '{{ csrf_token()}}', name:query},
        success:function(data){
            console.log(data == "true");

            if(data == "false"){
                $('#spinner').css('display','none');
                $('#cross').css('display','block');
                $('#tick').css('display','none');
            }else{
                $('#spinner').css('display','none');
                $('#cross').css('display','none');
                $('#tick').css('display','block');
            }
    }
    });}
    });
});

function selectTax(el){

            if(el.value=='vat'){
                $('#tax_id').css('display','flex');
            }else if(el.value=='no_vat'){
                $('#tax_id').css('display','none');
            }else{
                $('#tax_id').css('display','none');
            }
        }


</script>

@endsection
