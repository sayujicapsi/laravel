@extends('layouts.app')

@section('content')

<div class="container">
	<h2>Add Category</h2>
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
			<form method="POST" action="{{ route('category.store') }}">
				  @csrf()
				  <div class="form-group">
				    <label for="category_name">Category</label>
				    <input type="text" name="category_name" class="form-control" value="{{ old('category_name') }}" >
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