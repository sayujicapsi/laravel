@extends('layouts.app')

@section('content')

<div class="container">
	<h2>Order  List</h2>
	@if(Session::has('order_success'))
		<p class="alert alert-success" >{{ Session::get('order_success') }} </p>
	@endif
	@if(Session::has('order_update'))
		<p class="alert alert-success" >{{ Session::get('order_update') }} </p>
	@endif
	@if(Session::has('order_delete'))
		<p class="alert alert-success" >{{ Session::get('order_delete') }} </p>
	@endif
	@if(Session::has('order_restore'))
		<p class="alert alert-success" >{{ Session::get('order_restore') }} </p>
	@endif
	<div class="row">
		<div class="col-md-12 pull-right">
			<a href="{{ route('order.add') }}" class="btn btn-success " style="float:right;">Add</a>	
		</div>
		
		<table class="table">
			  <thead>
			    <tr>
			      <th scope="col">ID</th>
			      <th scope="col">Order ID </th>
			      <th scope="col">Customer Name </th>
			      <th scope="col">Phone </th>
			      <th scope="col">Net Amount</th>
			      <th scope="col">Order Date</th>
			      <th scope="col">Status</th>
			      <th scope="col">Actions</th>
			     
			    </tr>
			  </thead>
			  <tbody>
			  	@foreach($orders as $key => $order)
				    <tr>
				      <th scope="row">{{ $key+1}}</th>
				      <td>{{ $order->id }}</td>
				      <td>{{ $order->customer->name }}</td>
				      <td>{{ $order->customer->phone_number }}</td>
				      <td>{{ $order->order_detail->where('order_id',$order->id)->sum('total_amount')  }}</td>
				      <td>{{ date('d M Y',strtotime($order->created_at)) }}</td>
				      <td>{{ !$order->deleted_at ? 'Active' : 'Cancelled' }}</td>
				      <td>
				      	@if(!$order->deleted_at)
					      	<a href="{{ route('order.edit',$order->id) }}" class="btn btn-warning">Edit </a>
					      	<a href="{{ route('order.delete',$order->id) }}"  onclick="return confirm('Are you sure you want to cancel this order?');" class="btn btn-danger">Cancel </a>
					      	<a href="{{ route('order.pdf',$order->id) }}"   class="btn btn-info">Invoice </a>
				      @else
				      		<a href="{{ route('order.restore',$order->id) }}"   class="btn btn-success">Activate </a>

				      @endif
				      </td>
				    </tr>
			    @endforeach
			  </tbody>
		</table>
	</div>
</div>


@endsection