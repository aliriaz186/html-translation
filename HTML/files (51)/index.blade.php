@extends('layouts.app')

@section('content')

<br>

<!-- Basic Data Tables -->
<!--===================================================-->
<div class="panel">
    <div class="panel-heading">
        <h3 class="panel-title">{{__('Registered Companies')}}</h3>
    </div>
    <div class="panel-body">
        <table class="table table-striped table-bordered demo-dt-basic" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>#</th>
                    @if(permission_check_all('	register_api_companies') || permission_check_post('	register_api_companies') )
                        <th>Activaition</th>
                    @endif
                    <th>Name</th>
                    <th>Pu Key</th>
                    <th>Pr Key</th>
                    <th>Key Description</th>
                    <th>Url</th>
                    <th>Connected At</th>
                    <th width="10%">{{__('options')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($RegisterApiCompany as $key=>$RAIC)
                <tr>
                    @php
                        $url = $RAIC->website_url;
                        $parts = parse_url($url);
                        $str = $parts['host'];
                        $company_name_without_com = str_replace(".com","",$str);
                        $company_name = str_replace("www.","",$company_name_without_com);

                    @endphp
                        <td> {{ ($key+1) + ($RegisterApiCompany->currentPage() - 1)*$RegisterApiCompany->perPage() }}</td>
                        @if(permission_check_all('register_api_companies') || permission_check_post('	register_api_companies') )
                        <td>
                            <label class="switch">
                                <input type="checkbox" name="enable" onchange="RegisterCompanyChange({{$RAIC->id}})" {{$RAIC->status == 'on' ? 'checked':''  }}>
                                <span class="slider round"></span>
                            </label>
                        </td>
                        @endif
                        <td>{{$company_name}}</td>
                        <td>{{$RAIC->key}}</td>
                        <td>{{$RAIC->private_key}}</td>
                        <td>{{$RAIC->key_description}}</td>
                        <td>{{$RAIC->website_url}}</td>
                        <td>{{$RAIC->created_at}}</td>

                        <td>
                            <div class="btn-group dropdown">
                                <button class="btn btn-primary dropdown-toggle dropdown-toggle-icon" data-toggle="dropdown" type="button">
                                    {{__('Actions')}} <i class="dropdown-caret"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-right">
                                    <li><a onclick="confirm_modal('{{route('registerCompany.delete', $RAIC->id)}}');">{{__('Delete')}}</a></li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="pagination-wrapper py-4 pr-4">
            <ul class="pagination justify-content-end">
                {{ $RegisterApiCompany->links() }}
            </ul>
        </div>
    </div>
</div>

@endsection

<script>
    function RegisterCompanyChange(id){
        $.get('{{ route('admin.register-company-api.status')}}',{_token:'{{ @csrf_token() }}' , id:id}, function(data){
                window.location.reload();
                // console.log(data);
        });
    }
</script>

