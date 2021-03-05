@extends('layouts.app')

@section('content')

<div class="col-sm-12">
    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title">{{__('Send Cart')}}</h3>
        </div>
        <!--Horizontal Form-->
        <!--===================================================-->
        <form class="form-horizontal" action="{{ route('cart_email.send') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if(permission_check_all('cart') || permission_check_delete('cart') || permission_check_post('cart') || permission_check_put('promote_prices') )
            <div class="panel-body">
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="name">{{__('Emails')}} ({{__('Users')}})</label>
                    <div class="col-sm-10">
                        <select class="form-control selectpicker" name="user_emails[]" multiple data-selected-text-format="count" data-actions-box="true">
                            @foreach($users as $user)
                                <option value="{{$user->email}}">{{$user->email}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                {{-- <div class="form-group">
                    <label class="col-sm-2 control-label" for="name">{{__('Cart')}} ({{__('Item')}})</label>
                    <div class="col-sm-10">
                        <select class="form-control selectpicker" name="carrt_product[]" multiple data-selected-text-format="count" data-actions-box="true">
                            @foreach($users as $user)
                                @if(count(json_decode($user->cart))>0)
                                    @foreach(json_decode($user->cart) as $cart)
                                        @php $cart = json_decode($cart); @endphp
                                        <option value="{{$cart->id}}">{{App\Product::findOrFail($cart->id)->first()->name}}</option>
                                    @endforeach
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div> --}}
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="subject">{{__('Cart subject')}}</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="subject" id="subject" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="name">{{__('Cart content')}}</label>
                    <div class="col-sm-10">
                        <textarea class="editor" name="content" required placeholder="%username% and --email--"></textarea>
                    </div>
                </div>
            </div>
            <div class="panel-footer text-right">
                <button class="btn btn-purple" type="submit">{{__('Send')}}</button>
            </div>
            @endif
        </form>
        <!--===================================================-->
        <!--End Horizontal Form-->

    </div>
</div>

@endsection
