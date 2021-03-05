@extends('layouts.app')

@section('content')
    <div class="panel">
        <div class="panel-heading bord-btm clearfix pad-all h-100">
            <h3 class="panel-title pull-left pad-no">{{ __('Countries') }}</h3>
            <div class="pull-right clearfix">
                  <form class="" id="bulk_select" action="" method="GET">
                    <div class="box-inline pad-rgt pull-left">
                        <div class="select" style="min-width: 200px;">
                           <select class="form-control demo-select2" id="bulk_select_internal" name="bulk_select" onchange="bulk_select_all()">
                                <option value="">Bulk Select</option>
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
                    </div>

                 
                    <div class="box-inline pad-rgt pull-left">
                        <div class="select" style="min-width: 200px;">
                            <select class="form-control demo-select2" id="show_hide" name="show_hide" onchange="show_hide_all(this)">
                                <option value="">Show/Hide</option>
                                  <option value="Show" @isset($show_hide) @if($show_hide == 'Show') selected @endif @endisset>Show</option>
                                  <option value="Hide" @isset($show_hide) @if($show_hide == 'Hide') selected @endif @endisset>Hide</option>
                            </select>
                        </div>
                    </div>

                    <div class="box-inline pad-rgt">
                        <div class="" style="min-width: 200px;">
                            <input type="text" class="form-control" id="search" name="search" @isset($sort_search) value="{{ $sort_search }}" @endisset placeholder="Type & Enter">
                        </div>
                    </div>
                    <div class="box-inline pad-rgt pull-left">
                        @if(permission_check_all('countries') || permission_check_post('countries') )
                        <div class="select" style="min-width: 200px;">
                            <select class="form-control demo-select2" id="select" name="select" onchange="select_all(this)">
                                <option value="0">Select/Deselect</option>
                                  <option value="select" @isset($select) @if($select == 'select') selected @endif @endisset>Select All</option>
                                  <option value="deselect" @isset($select) @if($select == 'deselect') selected @endif @endisset>Deselect All</option>
                            </select>
                        </div>

                        @endif
                    </div>

                </form>
        </div>
        </div>
        <div class="panel-body">
          <form action="{{route('countries.store')}}" method="POST">
            @csrf
            <table class="table table-striped res-table mar-no" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th width="10%">#</th>
                        <th>{{__('Name')}}</th>
                        <th>{{__('Code')}}</th>
                        @if(permission_check_all('countries') || permission_check_post('countries') )
                            <th>{{__('Show/Hide')}}</th>
                            <th>{{__('Make Default')}}</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach($countries as $key => $country)
                        <tr>
                            <td>{{ ($key+1) + ($countries->currentPage() - 1)*$countries->perPage() }}</td>
                            <td>{{ $country->name }}</td>
                            <td>{{ $country->code }}</td>
                        @if(permission_check_all('countries') || permission_check_post('countries') )
                            <td><label class="switch">
                                    <input onchange="update_status(this)" value="{{ $country->id }}" type="checkbox" <?php if($country->status == 1) echo "checked";?> >
                                    <span class="slider round"></span></label></td>
                        @endif
                        @if(permission_check_all('countries') || permission_check_post('countries') )
                        <td><label class="switch">
                                <input onchange="update_defualt(this)" value="{{ $country->id }}" type="checkbox" <?php if($country->default == 1) echo "checked";?> >
                                <span class="slider round"></span></label></td>
                    @endif
                                </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="clearfix">
                <div class="pull-right">
                    {{ $countries->appends(request()->input())->links() }}
                </div>
            </div>
        </form>
        </div>
    </div>
@endsection


@section('script')
    <script type="text/javascript">

        function update_status(el){
            if(el.checked){
                var status = 1;
            }
            else{
                var status = 0;
            }
            $.post('{{ route('countries.status') }}', {_token:'{{ csrf_token() }}', id:el.value, status:status}, function(data){
                if(data == 1){
                    showAlert('success', 'Country status updated successfully');
                }
                else{
                    showAlert('danger', 'Something went wrong');
                }
            });
        }

       function mark(select){

            $.post('{{ route('countries.statusForAll') }}', {_token:'{{ csrf_token() }}', status:select}, function(data){
                if(data == 1){
                    showAlert('success', 'Country status updated successfully');
                    location.reload();
                }
                else{
                    showAlert('danger', 'Something went wrong');
                    location.reload();

                }
            });
        }

        function update_defualt(el){
            if(el.checked){
                var default_value = 1;
            }
            else{
                var default_value = 0;
            }
            $.post('{{ route('countries.default') }}', {_token:'{{ csrf_token() }}', id:el.value, default:default_value}, function(data){
                if(data == 1){
                    showAlert('success', 'Country default updated successfully');
                    location.reload();
                }
                else{
                    showAlert('danger', 'Something went wrong');
                    location.reload();

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
    </script>
@endsection
