@extends('layouts.app')

@section('content')

<div class="container">
	<h2>Add Product</h2>
	@if (count($errors) > 0)
		<div class="row justify-content-md-center">
			<div class = "col-md-6 alert alert-danger">
			   <ul>
			      @foreach ($errors->all() as $error)
			         <li>{{ $error }}</li>
			      @endforeach
			   </ul>
			</div>
		</div>
	   
	@endif
	<div class="row justify-content-md-center">
		<div class="col-md-6 align-items-center ">
			<form method="POST" action="{{ route('product.store') }}"  enctype="multipart/form-data">
				  @csrf()
				  <div class="form-group">
				    <label for="category_name">Product Name</label>
				    <input type="text" name="product_name" class="form-control" value="{{ old('product_name') }}" >
				  </div>
				  <br>
				  <div class="form-group">
				    <label for="category_name">Product Image</label>
				    <input type="file" name="product_image" class="form-control" value="{{ old('product_image') }}" >
				  </div>
				  <br>
				  <div class="form-group">
				    <label for="category_name">Category</label>
				    <select  class="form-control" name="category_id">
				    	@foreach($categories as $category)
				    		<option value="{{ $category->id }}">{{ $category->category_name }}</option>
				    	@endforeach
				    </select>
				  </div>
				  <br>
				  <div class="form-group">
				    <label for="category_name">Product Price</label>
				    <input type="number" name="price" class="form-control" value="{{ old('price') }}" >
				  </div>
				  <br>
				  <div class="form-group">
				    <button type="submit" class="btn btn-success">Add</button>
				  </div>
			</form>
			
		</div>
		


		
		
	</div>
</div>


@endsection