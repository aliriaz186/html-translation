@extends('layouts.app')

@section('content')
    <div class="panel">
        <div class="panel-heading"> <h3 class="panel-title">{{__('Admin Set Shipping Countries')}}</h3>
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

                        <div class="box-inline pad-rgt pull-left">
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

                        <div class="box-inline pad-rgt pull-left">
                            <div>
                            <a class="btn btn-sm btn-primary pull-right" href="{{route('admin.shipping-profile')}}" >
                                Set Shipping Profile
                            </a>
                            </div>
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
                            <th>{{__('Show/Hide')}}</th>
                        </tr>
                    </thead>
                    <tbody>
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
                                    <td>{{ ($key+2) + ($countries->currentPage() - 1)*$countries->perPage() }}</td>
                                    <td>{{ $country->name }}</td>
                                    <td>{{ $country->code }}</td>
                                    @php $flag = false; @endphp
                                    @if(isset($sellerCountries))
                                        @foreach ($sellerCountries as $sC)
                                            @if($sC == $country->name)
                                                @php $flag = true; @endphp
                                            @endif
                                        @endforeach
                                    @endif
                                    <td><label class="switch">
                                        <input  value="{{ $country->name }}" onchange="update_status(this)" type="checkbox" name="name[]" <?php if($flag == true) echo "checked";?> >
                                        <span class="slider round"></span></label>
                                    </td>
                                </tr>
                            @endforeach
                    </tbody>
                </table>
            </form>
            <div class="clearfix">
                <div class="pull-right">
                    {{ $countries->links() }}
                </div>
            </div>
        </div>
    </div>
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
                showAlert('success', 'Shipping Default Countries.');
            }
            else{
                showAlert('danger', 'Something went wrong');
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
        showAlert('success', 'Country status updated successfully');
        location.reload();
    }
    else{
        showAlert('error', 'Try Again');
        location.reload();

    }
});
}

</script>
@endsection




