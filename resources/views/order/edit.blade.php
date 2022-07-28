@extends('layouts.app')

@section('content')

<div class="container">
	<h2>Edit Order</h2>
	<div class="row justify-content-md-center " >
		<div class="col-md-6 alert alert-danger d-none " id="error_div">
		   <ul id="error_ul">
		      
		   </ul>
		</div>
	</div>
	<div class="row justify-content-md-center">

		<div class="col-md-6 align-items-center ">
			<div class="form-group">
				<button onclick="add()" class="btn btn-success" style="float: right; margin-bottom: 20px;">Add item</button>
			</div>
		</div>

		<div class="clearfix"></div>

		<div class="col-md-6 align-items-center ">
			
			<form method="POST" action=""  >
				  @csrf()
				  @method('PUT')
				  <div class="form-group">
				    <label for="customer_name">Customer Name</label>
				    <input type="text" name="customer_name" id="customer_name" class="form-control" value="{{ old('customer_name', $order->customer->name) }}" >
				  </div>
				  <br>
				  <div class="form-group">
				    <label for="phone_number">Customer Phone</label>
				    <input type="text" name="phone_number" id="phone_number" class="form-control" value="{{ old('phone_number', $order->customer->phone_number) }}" >
				  </div>
				  <br>
				  @foreach($order->order_detail as $key => $value)  
					  <div class="form-group">
					    <label for="product_id">Product</label>
					    <select  class="form-control" name="product_id" id="product_id{{$key+1}}">
					    	@foreach($products as $product)
					    		<option  {{$product->id == $value->product_id  ? 'selected' : ''}} value="{{ $product->id }}">{{ $product->product_name }}</option>
					    	@endforeach
					    </select>
					  </div>
					  <br>
					  <div class="form-group">
					    <label for="quantity">Quantity</label>
					    <input type="number" name="quantity[]" class="form-control" value="{{ $value->quantity }}" >
					  </div>

				  @endforeach

				  <br>
				  <div class="add-field">
				  	

				  </div>
				  <div class="form-group">
				    <button type="button" onclick="update_order()" class="btn btn-success">Update</button>
				  </div>
			</form>
			
		</div>
		


		
		
	</div>
</div>
<script>
	var i = {{ $order->order_detail->count() }};
	function add(){
		i = i+1;
		$(".add-field").append(
				`
				<div class="form-group">
				  <label for="product_id">Product</label>
				  <select  class="form-control" name="product_id[]" id="product_id${i}">
				  	@foreach($products as $product)
				  		<option value="{{ $product->id }}">{{ $product->product_name }}</option>
				  	@endforeach
				  </select>
				</div>
				<div class="form-group">
				    <label for="quantity">Quantity</label>
				    <input type="number" name="quantity[]" class="form-control" value="" >
				  </div> <br> `


			);
	}


	function update_order(){
		if(!$("#error_div").hasClass('d-none')){
			$("#error_div").addClass('d-none');
		}
		var product_id_list = new Array();

		for(n =1; n<= i; n++){
			console.log(i);
			console.log(n);
			console.log($("#product_id"+n+" option:selected").val())
			product_id_list.push($("#product_id"+n+ " option:selected" ).val());

		}
		console.log(product_id_list);
		var quantity_list = $('input[name^=quantity]').map(function(idx, elem) {
		    return $(elem).val();
		  }).get();

		$.ajax({
		   headers: {
		       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		   },
		   url: "{{ route('order.update',$order->id) }}",
		   type: 'put',
		   data: {
		      customer_name: $("#customer_name").val(),
		      phone_number: $("#phone_number").val(),
		      product_id : product_id_list,
		      quantity: quantity_list
		     
		   },
		   success: function(result){
		      window.location = '{{ route('order.list') }}';
		   },
		   error: function(err){
		      if($("#error_div").hasClass('d-none')){
		      	$("#error_div").removeClass('d-none');
		      }
		      $.each(err.responseJSON.errors,function(key,value){
		      		console.log(value[0]);
		      		console.log(key);
		      		$("#error_ul").append(
		      		`<li>${value[0]}</li>`
		      		);
		      });
		      // console.log(err.responseJSON.errors["pr.0"]);
		     // console.log(err.responseJSON.errors.'pr.0');

		   }
		 });


	}


</script>

@endsection