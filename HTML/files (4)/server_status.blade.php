@extends('layouts.app')

@section('content')
<div class="panel">
    <div class="panel-heading bord-btm clearfix pad-all h-100">
        <h3 class="panel-title pull-left pad-no">{{__('Server information')}}</h3>
    </div>
    <div class="panel-body">
        <table class="table table-striped res-table mar-no" cellspacing="0" width="100%">
						<thead>
							<tr>
								<th>{{__('Name') }}</th>
								<th>{{__('Current Version') }}</th>
								<th>{{__('Required Version') }}</th>
								<th>{{__('Status') }}</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>Php versions</td>
								<td>{{ phpversion() }}</td>
								<td>7.2 or 7.3</td>
								<td>
									@if (floatval(phpversion()) >= 7.2 && floatval(phpversion()) < 7.4)
										<i class="fa fa-check text-success"></i>
									@else
										<i class="fa fa-times text-danger"></i>
									@endif
								</td>
							</tr>
							<tr>
								<td>MySQL</td>
								<td>
									@php
										$results = DB::select( DB::raw("select version()") );
										$mysql_version =  $results[0]->{'version()'};
									@endphp
									{{ $mysql_version }}
								</td>
								<td>5.6+</td>
								<td>
									@if ($mysql_version >= 5.6)
										<i class="fa fa-check text-success"></i>
									@else
										<i class="fa fa-times text-danger"></i>
									@endif
								</td>
							</tr>
						</tbody>
					</table>
               
                </div>
            </div>
            
            <div class="panel">
                <div class="panel-heading bord-btm clearfix pad-all h-100">
                    <h3 class="panel-title pull-left pad-no">{{__('Extensions information')}}</h3>
                </div>
                <div class="panel-body">
					<table class="table table-striped">
						<thead>
							<tr>
								<th>{{__('Extension Name') }}</th>
								<th>{{__('Status') }}</th>
							</tr>
						</thead>
						@php
							$loaded_extensions = get_loaded_extensions();
							$required_extensions = ['bcmath', 'ctype', 'json', 'mbstring', 'openssl', 'pdo', 'tokenizer', 'xml', 'dom', 'zip', 'curl', 'fileinfo', 'gd', 'pdo_mysql', 'pdo_mysqli']
						@endphp
						<tbody>
							@foreach ($required_extensions as $extension)
								<tr>
									<td>{{ $extension }}</td>
									<td>
										@if(in_array($extension, $loaded_extensions))
											<i class="fa fa-check text-success"></i>
										@else
											<i class="fa fa-times text-danger"></i>
										@endif
									</td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
            
            <div class="panel">
                <div class="panel-heading bord-btm clearfix pad-all h-100">
                    <h3 class="panel-title pull-left pad-no">{{__('Filesystem Permissions')}}</h3>
                </div>
                <div class="panel-body">
					<table class="table table-striped">
						<thead>
							<tr>
								<th>{{__('File or Folder') }}</th>
								<th>{{__('Status') }}</th>
							</tr>
						</thead>
						@php
							$required_paths = ['.env', 'public', 'app/Providers', 'app/Http/Controllers', 'storage', 'resources/views']
						@endphp
						<tbody>
							@foreach ($required_paths as $path)
								<tr>
									<td>{{ $path }}</td>
									<td>
										@if(is_writable(base_path($path)))
											<i class="fa fa-check text-success"></i>
										@else
											<i class="fa fa-times text-danger"></i>
										@endif
									</td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
@endsection
