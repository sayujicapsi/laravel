<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Faker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use DB;
class OrderController extends Controller
{
    //
    public function index(){

    	$orders = Order::with('customer','order_detail')->orderBy('id','desc')->withTrashed()->get();
    	return view('order.list',compact('orders'));
    }

    public function create(){
    	$products = Product::whereNull('deleted_at')->get();

    	return view('order.add',compact('products'));

    }

    public function store(Request $request){
    	// dd($request->all());
    	
    	$request->validate([
    		'customer_name' => 'required',
    		'phone_number' => 'required|numeric',
    		'product_id.*' => 'required',
    		'quantity.*' => 'required|integer',
    		
    	],[
	         
    		'quantity.*.required' =>   "Quantity is required",
    		'quantity.*.numeric' =>   "Quantity is numeric",
	    ]);
    	
    	
    	$faker = Faker\Factory::create(); 
    	$customer_email = $faker->unique()->safeEmail();
    	$customer = new Customer();
    	$customer->name = $request->customer_name;
    	$customer->phone_number = $request->phone_number;
    	$customer->password = Hash::make('123');
    	$customer->remember_token = Str::random(10);
    	$customer->email = $customer_email;
    	$customer->save();

    	$order = new Order();
    	$order->customer_id = $customer->id;
    	$order->save();

    	foreach ($request->product_id as $key => $value) {
    		

    		$product = Product::find($value);
    		$category_id = $product->category_id;
    		$product_price = $product->price;
    		$quantity = $request->quantity[$key];
    		$total_amount = $product_price*$quantity;
    			# code...
    		$order_detail = new OrderDetail();
    		$order_detail->order_id = $order->id;
    		$order_detail->product_id = $value;
    		$order_detail->category_id = $category_id;
    		$order_detail->quantity = $quantity;
    		$order_detail->product_price = $product_price;
    		$order_detail->total_amount = $total_amount;
    		$order_detail->save();
    	}
    	
    	session()->flash('order_success','Order Success');
    	return response()->json([
    		"data" => "success"
    	]);
    	//return redirect()->route('order.list');




    }

    public function edit($id){

    	$order = Order::with(['order_detail','customer'])->find($id);
    	//$customer = Customer::find($order->customer_id);
    	$products = DB::table('products')->get();
    	return view('order.edit',compact('products','order'));

    }

    public function update($id,Request $request){

    	$request->validate([
    		'customer_name' => 'required',
    		'phone_number' => 'required|numeric',
    		'product_id.*' => 'required',
    		'quantity.*' => 'required|integer',
    		
    	],[
             
            'quantity.*.required' =>   "Quantity is required",
            'quantity.*.numeric' =>   "Quantity is numeric",
        ]);

    	
    	$order = Order::find($id);
    	$customer = Customer::where('name',$request->customer_name)
    				->where('phone_number',$request->phone_number)
    				->first();
    	if(!empty($customer)){
    		if($order->customer_id != $customer->id){
    			Order::where('id',$id)
    				  ->update([
    				  	'customer_id' => $customer->id
    				  ]);
    		}
    	}else{

    		$customer->name = $request->customer_name;
    		$customer->phone_number = $request->phone_number;
    		$customer->password = Hash::make('123');
    		$customer->remember_token = Str::random(10);
    		$customer->email = $customer_email;
    		$customer->save();
    		Order::where('id',$id)
    			  ->update([
    			  	'customer_id' => $customer->id
    			  ]);
    	}	
    	
    	OrderDetail::where('order_id',$id)->delete();

    	foreach ($request->product_id as $key => $value) {
    		$product = Product::find($value);
    		$category_id = $product->category_id;
    		$product_price = $product->price;
    		$quantity = $request->quantity[$key];
    		$total_amount = $product_price*$quantity;
    			# code...
    		$order_detail = new OrderDetail();
    		$order_detail->order_id = $id;
    		$order_detail->product_id = $value;
    		$order_detail->category_id = $category_id;
    		$order_detail->quantity = $quantity;
    		$order_detail->product_price = $product_price;
    		$order_detail->total_amount = $total_amount;
    		$order_detail->save();
    	}
    		

    	

    	session()->flash('order_update','Order Updated');
    	return response()->json([
    		"data" => "success"
    	]);




    }

    public function destroy($id){
    	Order::where('id',$id)->delete();
    	OrderDetail::where('order_id',$id)->delete();
    	session()->flash('order_delete','Order Deleted');
    	return redirect()->route('order.list');
    }

    public function restore($id){
        Order::where('id',$id)->restore();
        OrderDetail::where('order_id',$id)->restore();
        session()->flash('order_restore','Order has been activated');
        return redirect()->route('order.list');
    }

 
}
