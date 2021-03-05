@extends('layouts.app')

<link rel="stylesheet" href="{{asset('css/intlTelInput.css')}}">

<style>
    .iti .iti--allow-dropdown{
        width: 100% !important;
    }
</style>

@section('content')
<div class="col-lg-5">
    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title">{{__('Seller Information')}}</h3>
        </div>
        <!--Horizontal Form-->
        <!--===================================================-->
        <form class="form-horizontal" action="{{ route('sellers.update', $seller->id) }}" method="POST" enctype="multipart/form-data">
            <input name="_method" type="hidden" value="PATCH">
        	@csrf
            <div class="panel-body">
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="name">{{__('Name')}}</label>
                    <div class="col-sm-9">
                        <input type="text" placeholder="{{__('Name')}}" id="name" name="name" class="form-control" value="{{$seller->user->name}}" required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-3 control-label" for="email">{{__('Email Address')}}</label>
                    <div class="col-sm-9">
                        <input type="text" placeholder="{{__('Email Address')}}" id="email" name="email" class="form-control" value="{{$seller->user->email}}" required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-3 control-label" for="pNo">{{__('Personal Number')}}</label>
                    {{-- pattern="[0-9+]{2,3}-[0-9]{6,10}" --}}
                    <div class="col-sm-9">
                        <input type="tel" placeholder="{{__('Personal Number')}}" id="pNo" name="personal_number" class="form-control" value="{{$seller->user->personal_number}}" required style="width:120%">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-3 control-label" for="password">{{__('Password')}}</label>
                    <div class="col-sm-9">
                        <input type="password" placeholder="{{__('Password')}}" id="password" name="password" class="form-control">
                    </div>
                </div>
            </div>
            <hr>
            <div class="panel-footer text-right">
                <button class="btn btn-purple" type="submit">{{__('Save')}}</button>
            </div>
        </form>
        <hr>
        <!--===================================================-->

        <!--End Horizontal Form-->
    </div>
</div>
<div class="col-lg-7">
    <div class="panel">
    <div class="panel-heading">
        <div class="panel-control">
            <a href="{{ route('sellers.reject', $seller->id) }}" class="btn btn-default btn-rounded d-innline-block">{{__('Reject')}}</a>
            <a href="{{ route('sellers.approve', $seller->id) }}" class="btn btn-primary btn-rounded d-innline-block">{{__('Accept')}}</a>
        </div>
        <h3 class="panel-title">{{__('Seller Verification')}}</h3>
    </div>
    <div class="panel-body">
        <div class="col-md-4">
            <div class="panel-heading">
                <h3 class="text-lg">{{__('User Info')}}</h3>
            </div>
            <div class="row">
                <label class="col-sm-3 control-label" for="name">{{__('Name')}}</label>
                <div class="col-sm-9">
                    <p>{{ $seller->user->name }}</p>
                </div>
            </div>
            <div class="row">
                <label class="col-sm-3 control-label" for="name">{{__('Email')}}</label>
                <div class="col-sm-9">
                    <p>{{ $seller->user->email }}</p>
                </div>
            </div>
            <div class="row">
                <label class="col-sm-3 control-label" for="name">{{__('Address')}}</label>
                <div class="col-sm-9">
                    <p>{{ $seller->user->address }}</p>
                </div>
            </div>
            <div class="row">
                <label class="col-sm-3 control-label" for="name">{{__('Phone')}}</label>
                <div class="col-sm-9">
                    <p>{{ $seller->user->phone }}</p>
                </div>
            </div>


            <div class="panel-heading">
                <h3 class="text-lg">{{__('Shop Info')}}</h3>
            </div>

            <div class="row">
                <label class="col-sm-3 control-label" for="name">{{__('Shop Name')}}</label>
                <div class="col-sm-9">
                    <p>{{ $seller->user->shop->name }}</p>
                </div>
            </div>
            <div class="row">
                <label class="col-sm-3 control-label" for="name">{{__('Address')}}</label>
                <div class="col-sm-9">
                    <p>{{ $seller->user->shop->address }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel-heading">
                <h3 class="text-lg">{{__('Verification Info')}}</h3>
            </div>
            <table class="table table-striped table-bordered" cellspacing="0" width="100%">
                <tbody>
                    @if($seller->verification_info != null)
                    @foreach (json_decode($seller->verification_info) as $key => $info)
                        <tr>
                            <th>{{ $info->label }}</th>
                            @if ($info->type == 'text' || $info->type == 'select' || $info->type == 'radio')
                                <td>{{ $info->value }}</td>
                            @elseif ($info->type == 'multi_select')
                                <td>
                                    {{ implode(json_decode($info->value), ', ') }}
                                </td>
                            @elseif ($info->type == 'file')
                                <td>
                                    <a href="{{ asset($info->value) }}" target="_blank" class="btn-info">{{__('Click here')}}</a>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>
            <div class="text-center">
                <a href="{{ route('sellers.reject', $seller->id) }}" class="btn btn-default d-innline-block">{{__('Reject')}}</a></li>
                <a href="{{ route('sellers.approve', $seller->id) }}" class="btn btn-primary d-innline-block">{{__('Accept')}}</a>
            </div>
        </div>
    </div>
</div>
    <div class="panel">
        <!-- <form class="" action="{{ route('seller.verify.store', $seller->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-box bg-white mt-4">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        {{__('Verification info')}}
                    </h3>
                </div>
                @php
                    $verification_form = \App\BusinessSetting::where('type', 'verification_form')->first()->value;
                @endphp
                <div class="panel-body p-3">
                    @foreach (json_decode($verification_form) as $key => $element)
                        @if ($element->type == 'text')
                            <div class="row">
                                <div class="col-md-4 control-label">
                                    <label>{{ $element->label }} <span class="required-star">*</span></label>
                                </div>
                                <div class="col-md-8">
                                    <input type="{{ $element->type }}" class="form-control mb-3" placeholder="{{ $element->label }}" name="element_{{ $key }}" required>
                                </div>
                            </div>
                        @elseif($element->type == 'file')
                            <div class="row">
                                <div class="col-md-4 control-label">
                                    <label>{{ $element->label }}</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="{{ $element->type }}" name="element_{{ $key }}" id="file-2" class="custom-input-file custom-input-file--4" data-multiple-caption="{count} files selected" required/>
                                    <label for="file-2" class="mw-100 mb-3">
                                        <span></span>
                                        <strong>
                                            <i class="fa fa-upload"></i>
                                            {{__('Choose file')}}
                                        </strong>
                                    </label>
                                </div>
                            </div>
                        @elseif ($element->type == 'select' && is_array(json_decode($element->options)))
                            <div class="row">
                                <div class="col-md-4 control-label">
                                    <label>{{ $element->label }}</label>
                                </div>
                                <div class="col-md-8">
                                    <div class="mb-3">
                                        <select class="form-control selectpicker" data-minimum-results-for-search="Infinity" name="element_{{ $key }}" required>
                                            @foreach (json_decode($element->options) as $value)
                                                <option value="{{ $value }}">{{ $value }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        @elseif ($element->type == 'multi_select' && is_array(json_decode($element->options)))
                            <div class="row">
                                <div class="col-md-4 control-label">
                                    <label>{{ $element->label }}</label>
                                </div>
                                <div class="col-md-8">
                                    <div class="mb-3">
                                        <select class="form-control selectpicker" data-minimum-results-for-search="Infinity" name="element_{{ $key }}[]" multiple required>
                                            @foreach (json_decode($element->options) as $value)
                                                <option value="{{ $value }}">{{ $value }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        @elseif ($element->type == 'radio')
                            <div class="row">
                                <div class="col-md-4 control-label">
                                    <label>{{ $element->label }}</label>
                                </div>
                                <div class="col-md-8">
                                    <div class="mb-3">
                                        @foreach (json_decode($element->options) as $value)
                                            <div class="radio radio-inline">
                                                <input type="radio" name="element_{{ $key }}" value="{{ $value }}" id="{{ $value }}" required>
                                                <label for="{{ $value }}">{{ $value }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
            <div class="panel-footer text-right">
                <button class="btn btn-purple" type="submit">{{__('Apply')}}</button>
            </div>
        </form> -->
    </div>
</div>

@section('script')
        <script src="{{asset('js/intlTelInput.js')}}"></script>
        <script>
            var input = document.querySelector("#pNo");
          var data =   window.intlTelInput(input, {
            customPlaceholder: function(selectedCountryPlaceholder, selectedCountryData) {
                        return "e.g. " + selectedCountryPlaceholder;
                    },
            })
            ;

$("#pNo").on("countrychange", function(e){
    dialCode = data.getSelectedCountryData()["dialCode"];
            document.getElementById('pNo').value = '+'+dialCode;
});

        </script>
@endsection


@endsection

