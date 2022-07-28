<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //

    public function index(){

    	$products = Product::with('category')->orderBy('id','desc')->get();
    	return view('product.list',compact('products'));
    }

    public function create(){
    	$categories = Category::all();
    	return view('product.add',compact('categories'));
    }


    public function store(Request $request){
    	$request->validate([
    		'product_name' => 'required|unique:products',
    		'product_image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:4096',
    		'category_id' => 'required',
    		'price' => 'required|integer',
    	]);

    	$file = $request->file('product_image');
    	$file_extension = $file->getClientOriginalExtension();
    	$file_path = public_path('images');
    	$file_name = time().'.'.$file_extension;
    	$file->move($file_path,$file_name);


    	$product = new Product();
    	$product->product_name = $request->product_name;
    	$product->product_image = $file_name;
    	$product->category_id = $request->category_id;
    	$product->price = $request->price;
    	$product->save();
        session()->flash('product_success','Product Added  Successfully');
    	return redirect()->route('product.list');
 
    }

    public function edit($id){
    	$product = Product::find($id);
    	$categories = Category::all();
    	return view('product.edit',compact('product','categories'));

    }

    public function update($id,Request $request){
    	$pr = Product::find($id);

    	$request->validate([
    		'product_name' => 'required|unique:products,product_name,'.$id,
    		'product_image' => 'image|mimes:jpg,png,jpeg,gif,svg|max:4096',
    		'category_id' => 'required',
    		'price' => 'required|integer',
    	]);

    	if($request->hasFile('product_image')){
    		$file = $request->file('product_image');
    		$file_extension = $file->getClientOriginalExtension();
    		$file_path = public_path('images');
    		$file_name = time().'.'.$file_extension;
    		$file->move($file_path,$file_name);	
    	}else{
    		$file_name = $pr->product_image;
    	}
    	


    	$product = Product::where('id',$id)
    			   ->update([
    			   		 		'product_name' => $request->product_name,
    			   		    	'product_image' => $file_name,
    			   		    	'category_id' => $request->category_id,
    			   		    	'price' => $request->price,
    			   ]);

        session()->flash('product_update','Product Updated  Successfully');

    	return redirect()->route('product.list');
    
    }

    public function destroy($id){

    	
    	$product = Product::find($id);
    	$product->delete(); 
        session()->flash('product_delete','Product Deleted  Successfully');
    	return redirect()->route('product.list');
    }
}
