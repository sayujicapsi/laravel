<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<table>
		<tr>
				<td>Order Id</td>
				<td>{{ $order[0]->order_id }}</td>
		</tr>
		<tr>
				<td>Products</td>
				<td>
					@foreach($order as $key=>$value)
						{{$key +1}}. {{$value->product_name}} X {{ $value->quantity}} = {{ $value->total_amount }}
						<br>
					@endforeach

				</td>

		</tr>
		<tr>
				<td>Total</td>
				<td>
					{{ $order->sum('total_amount') }}

				</td>
					

		</tr>
	</table>
<style>
	table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
}

</style>
</body>
</html>



