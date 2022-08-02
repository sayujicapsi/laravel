@extends('layouts.app')

@section('content')

<div class="container">
	<h2>Product  List</h2>
	@if(Session::has('product_success'))
		<p class="alert alert-success" >{{ Session::get('product_success') }} </p>
	@endif
	@if(Session::has('product_update'))
		<p class="alert alert-success" >{{ Session::get('product_update') }} </p>
	@endif
	@if(Session::has('product_delete'))
		<p class="alert alert-success" >{{ Session::get('product_delete') }} </p>
	@endif
	<div class="row">
		<div class="col-md-12 pull-right">
			<a href="{{ route('product.add') }}" class="btn btn-success " style="float:right;">Add</a>	
		</div>
		
		<table class="table">
			  <thead>
			    <tr>
			      <th scope="col">ID</th>
			      <th scope="col">Product Name</th>
			      <th scope="col">Category</th>
			      <th scope="col">Price</th>
			      <th scope="col">Actions</th>
			     
			    </tr>
			  </thead>
			  <tbody>
			  	@foreach($products as $key => $product)
				    <tr>
				      <th scope="row">{{ $key+1}}</th>
				      <td>{{ $product->product_name }}</td>
				      <td>{{ $product->category_name }}</td>
				      <td>{{ $product->price }}</td>
				      <td>
				      	<a href="{{ route('product.edit',$product->id) }}" class="btn btn-warning">Edit </a>
				      	{{-- <a href="{{ route('product.delete',$product->id) }}"  onclick="return confirm('Are you sure you want to delete this product?');" class="btn btn-danger">Delete </a> --}}
				      </td>
				    </tr>
			    @endforeach
			  </tbody>
		</table>
	</div>
</div>


@endsection