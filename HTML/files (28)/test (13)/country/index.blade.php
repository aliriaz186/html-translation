@extends('frontend.layouts.app')
@section('content')


<section class="gry-bg py-4 profile">
        <div class="container-fluid p-4">
            <div class="row cols-xs-space cols-sm-space cols-md-space">
                <div class="col-lg-2-1 d-none d-lg-block">@include('frontend.inc.seller_side_nav')</div>
                <div class="col-lg-9">
                    <!-- Page title -->
                    <div class="page-title">
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <h2 class="heading heading-6 text-capitalize strong-600 mb-0">
                                            {{__('Shipping Countries')}}
                                </h2>
                            </div>
                            <div class="col-md-6">
                                <div class="float-md-right">
                                    <ul class="breadcrumb">
                                            <li><a href="{{ route('home') }}">{{__('Home')}}</a>
                                            </li>
                                            <li class="active"><a href="{{ route('shipping-countries.index') }}">{{__('Shiping Countries')}}</a>
                                            </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="">
                        <div class="row">{{-- card no-border mt-4 --}}
                            <div style="width:100%">
                                 <div class="card no-border mt-4" style="width:100%">
                                    <div class="card-header py-3">
                                         <form id="bulk_select" action="" method="GET">
                                            @csrf
                                            <div class="row">
                                                <div class="col-md-3 ">
                                                    <select class="form-control mb-3 selectpicker" data-placeholder="{{__('Multi Select')}}" name="bulk_select" onchange="bulk_select_all(this)">
                                                        <option value="">Multi Select</option>
                                                        <optgroup label="Asia">
                                                          <option value="AS_select" @isset($bulk_select) @if($bulk_select == 'AS_select') selected @endif @endisset>Select</option>
                                                          <option value="AS_deselect" @isset($bulk_select) @if($bulk_select == 'AS_deselect') selected @endif @endisset>Deselect</option>
                                                        </optgroup>
                                                        <optgroup label="Europe">
                                                          <option value="EU_select" @isset($bulk_select) @if($bulk_select== 'EU_select') selected @endif @endisset>Select</option>
                                                          <option value="EU_deselect" @isset($bulk_select) @if($bulk_select== 'EU_deselect') selected @endif @endisset>Deselect</option>
                                                        </optgroup>
                                                          <optgroup label="Africa">
                                                          <option value="AF_select" @isset($bulk_select) @if($bulk_select== 'AF_select') selected @endif @endisset>Select</option>
                                                          <option value="AF_deselect" @isset($bulk_select) @if($bulk_select== 'AF_deselect') selected @endif @endisset>Deselect</option>
                                                        </optgroup>
                                                          <optgroup label="North America">
                                                            <option value="NA_select" @isset($bulk_select) @if($bulk_select== 'NA_select') selected @endif @endisset>Select</option>
                                                            <option value="NA_deselect" @isset($bulk_select) @if($bulk_select== 'NA_deselect') selected @endif @endisset>Deselect</option>
                                                          </optgroup>
                                                          <optgroup label="South America">
                                                            <option value="SA_select" @isset($bulk_select) @if($bulk_select== 'SA_select') selected @endif @endisset>Select</option>
                                                            <option value="SA_deselect" @isset($bulk_select) @if($bulk_select== 'SA_deselect') selected @endif @endisset>Deselect</option>
                                                          </optgroup>

                                                          <optgroup label="Antarctica">
                                                          <option value="AN_select" @isset($bulk_select) @if($bulk_select== 'AN_select') selected @endif @endisset>Select</option>
                                                          <option value="AN_deselect" @isset($bulk_select) @if($bulk_select== 'AN_deselect') selected @endif @endisset>Deselect</option>
                                                          </optgroup>

                                                          <optgroup label="Oceania">
                                                            <option value="OC_select" @isset($bulk_select) @if($bulk_select== 'OC_select') selected @endif @endisset>Select</option>
                                                            <option value="OC_deselect" @isset($bulk_select) @if($bulk_select== 'OC_deselect') selected @endif @endisset>Deselect</option>
                                                          </optgroup>
                                                    </select>
                                                </div>
                                                <div class="col-md-3 ">
                                                    <select class="form-control mb-3 selectpicker" data-placeholder="{{__('Select/Deselect')}}" name="select" onchange="select_all(this)">
                                                            <option value="default">Select All\Deselect All</option>
                                                            <option value="select" @isset($select) @if($select == 'select') selected @endif @endisset>Select All</option>
                                                            <option value="deselect" @isset($select) @if($select == 'deselect') selected @endif @endisset>Deselect All</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-3">
                                                    <select class="form-control mb-3 selectpicker" data-placeholder="{{__('Show/Hide')}}" id="show_hide" name="show_hide" onchange="show_hide_all(this)">
                                                        <option value="Show/Hide">Show/Hide</option>
                                                        <option value="Show" @isset($show_hide) @if($show_hide == 'Show') selected @endif @endisset>Show</option>
                                                        <option value="Hide" @isset($show_hide) @if($show_hide == 'Hide') selected @endif @endisset>Hide</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-3">
                                                    <input type="text" class="form-control" id="search" name="search" @isset($sort_search) value="{{ $sort_search }}" @endisset placeholder="Type & Enter">
                                                </div>
                                            </div>
                                        </form>
                                </div>
                                    <div class="card-body">
                                         <table class="table table-striped table-bordered demo-dt-basic" cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <th width="10%">#</th>
                                                    <th>{{__('Name')}}</th>
                                                    <th>{{__('Code')}}</th>
                                                    <th>{{__('Show/Hide')}}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            	@php $set=false; if(count(App\Country::where('default',1)->get())>0) $set=true; @endphp
                                                @foreach(App\Country::where('default',1)->get() as $key => $country)
                                                <tr>
                                                    <td>{{($key+1)}}</td>
                                                    <td>{{ $country->name }}</td>
                                                    <td>{{ $country->code }}</td>
                                                    <td><label class="switch">
                                                        <input  value="{{ $country->name }}" checked readonly type="checkbox" name="name[]"  onclick="return false;" >
                                                        <span class="slider round"></span></label>
                                                    (Default)
                                                    </td>
                                                </tr>
                                                @endforeach
                                                @foreach($countries as $key => $country)
                                                    <tr>
                                                    	@if($set)
                                                    	<td>{{ ($key+2) + ($countries->currentPage() - 1)*$countries->perPage() }}</td>
                                                    	@else 
                                                    	<td>{{ ($key+1) + ($countries->currentPage() - 1)*$countries->perPage() }}</td>
                                                    	@endif
                                                        <td>{{ $country->name }}</td>
                                                        <td>{{ $country->code }}</td>
                                                        @php $flag = false; @endphp
                                                        @isset($sellerCountries)
                                                            @foreach ($sellerCountries as $sellerCountry)
                                                                 @php  $country->name =str_replace(' ','_', $country->name); @endphp
                                                                @if($sellerCountry == $country->name)
                                                                    @php $flag = true; @endphp
                                                                @endif
                                                            @endforeach
                                                        @endisset
                                                        <td><label class="switch">
                                                            <input  value="{{ $country->name }}" onchange="update_status(this)" type="checkbox" name="name[]" <?php if($flag == true) echo "checked";?> >
                                                            <span class="slider round"></span></label>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                            <div class="clearfix">
                                                <div class="pull-right">
                                                    {{ $countries->links() }}
                                                </div>
                                            </div>
                                            <br>
                                            <a href="{{route('seller.set_shipping_profile')}}" class="btn btn-sm btn-danger text-center pull-right mr-3 ml-2">Set Shipping Profile</a>
                                    </div>
                                 </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endsection

    @section('script')
        <script>
        function update_status(el){
            if(el.checked){
                var status = 1;
            }
            else{
                var status = 0;
            }
            $.get('{{ route('countries.set_default_countries') }}', {_token:'{{ csrf_token() }}', name:el.value, status:status}, function(data){
                if(data == 1){
                    showFrontendAlert('success', 'Seller Default Countries.');
                }
                else{
                    showFrontendAlert('danger', 'Something went wrong');
                }
            });
        }

        function show_hide_all(el){
            $('#bulk_select').submit();
        }
        function select_all(el){
            if(el.value == 'select')
            {
                mark(1);
            }
            else if(el.value=='deselect'){
                mark(0);
            }

                 }

         function bulk_select_all(){
            $('#bulk_select').submit();
         }

         function mark(select){

        $.get('{{ route('countries.status.for.seller') }}', {_token:'{{ csrf_token() }}', status:select}, function(data){
            if(data == 1){
                showFrontendAlert('success', 'Country status updated successfully');
                location.reload();
            }
            else{
                showFrontendAlert('error', 'Try Again');
                location.reload();

            }
        });
        }

        </script>
    @endsection
