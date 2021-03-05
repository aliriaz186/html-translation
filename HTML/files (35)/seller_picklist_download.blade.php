<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
    <meta http-equiv="Content-Type" content="text/html;"/>
    <meta charset="UTF-8">
	<style media="all">
		*{
			margin: 0;
			padding: 0;
			line-height: 1.3;
			font-family: sans-serif;
			color: #333542;
		}
		body{
			font-size: .875rem;
		}
		.gry-color *,
		.gry-color{
			color:#878f9c;
		}
		table{
			width: 100%;
		}
		table th{
			font-weight: normal;
		}
		table.padding th{
			padding: .5rem .7rem;
		}
		table.padding td{
			padding: .7rem;
		}
		table.sm-padding td{
			padding: .2rem .7rem;
		}
		.border-bottom td,
		.border-bottom th{
			border-bottom:1px solid #eceff4;
		}
		.text-left{
			text-align:left;
		}
		.text-right{
			text-align:right;
		}
		.small{
			font-size: .85rem;
		}
		.currency{

		}
	</style>
</head>
<body>
	<div style="margin-left:auto;margin-right:auto;">

		@php
			$generalsetting = \App\GeneralSetting::first();
		@endphp

		<div style="background: #eceff4;padding: 1.5rem;">
			<table>
				<tr>
					<td>
						@if (Auth::user()->user_type == 'seller')
							@if(Auth::user()->shop->logo != null)
								<img loading="lazy"  src="{{ asset(Auth::user()->shop->logo) }}" height="40" style="display:inline-block;">
							@else
								<img loading="lazy"  src="{{ asset('frontend/images/logo/logo.png') }}" height="40" style="display:inline-block;">
							@endif
						@else
							@if($generalsetting->logo != null)
								<img loading="lazy"  src="{{ asset($generalsetting->logo) }}" height="40" style="display:inline-block;">
							@else
								<img loading="lazy"  src="{{ asset('frontend/images/logo/logo.png') }}" height="40" style="display:inline-block;">
							@endif
						@endif
					</td>
					<td style="font-size: 2.5rem;" class="text-right strong">PICK LIST</td>
				</tr>
			</table>
			<table>
				@if (Auth::user()->user_type == 'seller')
					<tr>
						<td style="font-size: 1.2rem;" class="strong">{{ Auth::user()->shop->name }}</td>
						<td class="text-right"></td>
					</tr>
					<tr>
						<td class="gry-color small">{{ Auth::user()->shop->address }}</td>
						<td class="text-right"></td>
					</tr>
					<tr>
						<td class="gry-color small">Email: {{ Auth::user()->email }}</td>
					</tr>
					<tr>
						<td class="gry-color small">Phone: {{ Auth::user()->phone }}</td>
					</tr>
				@else
					<tr>
						<td style="font-size: 1.2rem;" class="strong">{{ $generalsetting->site_name }}</td>
						<td class="text-right"></td>
					</tr>
					<tr>
						<td class="gry-color small">{{ $generalsetting->address }}</td>
						<td class="text-right"></td>
					</tr>
					
					<tr>
						<td class="gry-color small">Phone: {{ $generalsetting->phone }}</td>
							</tr>
				@endif
			</table>

		</div>

	    <div style="padding: 1.5rem;">
			<table class="padding text-left small border-bottom">
				<thead>
	                <tr class="gry-color" style="background: #eceff4;">
	                    <th width="15%">SKU</th>
	                    <th width="35%">Product Name</th>
	                    <th width="10%">Qty</th>
	                </tr>
				</thead>
				<tbody class="strong">
			@foreach($orders as $order_id)
			     @php   $order = \App\Order::find($order_id->id); @endphp
		                @foreach ($order->orderDetails->where('seller_id', Auth::user()->id) as $key => $orderDetail)
			                @if ($orderDetail->product)
								<tr class="">
							           <td>{{ $orderDetail->product->sku}}</td>
							           <td>{{ $orderDetail->product->name }} ({{ $orderDetail->variation }})</td>
							           <td>{{$orderDetail->quantity}}</td>	
								</tr>
			                @endif
				@endforeach
			@endforeach
	            </tbody>
			</table>
		</div>

	   
	</div>
</body>
</html>