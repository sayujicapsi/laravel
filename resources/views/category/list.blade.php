@extends('layouts.app')

@section('content')

<div class="container">
	<h2>Category List</h2>

	@if(Session::has('category_success'))
		<p class="alert alert-success" >{{ Session::get('category_success') }} </p>
	@endif
	@if(Session::has('category_update'))
		<p class="alert alert-success"  >{{ Session::get('category_update') }} </p>
	@endif
	@if(Session::has('category_delete'))
		<p class="alert alert-success" >{{ Session::get('category_delete') }} </p>
	@endif
	<div class="row">
		<div class="col-md-12 pull-right">
			<a href="{{ route('category.add') }}" class="btn btn-success " style="float:right;">Add</a>	
		</div>
		
		<table class="table">
			  <thead>
			    <tr>
			      <th scope="col">#</th>
			      <th scope="col">Category</th>
			      <th scope="col">Action</th>
			     
			    </tr>
			  </thead>
			  <tbody>
			  	@foreach($categories as $key => $category)
				    <tr>
				      <th scope="row">{{ $key+1}}</th>
				      <td>{{ $category->category_name }}</td>
				      <td>
				      	<a href="{{ route('category.edit',$category->id) }}" class="btn btn-warning">Edit </a>
				      	<a href="{{ route('category.delete',$category->id) }}"  onclick="return confirm('Are you sure you want to delete this category?');" class="btn btn-danger">Delete </a>
				      </td>
				    </tr>
			    @endforeach
			  </tbody>
		</table>
	</div>
</div>


@endsection