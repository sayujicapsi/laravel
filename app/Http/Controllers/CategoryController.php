<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //

    public function index(){
    	$categories = Category::orderBy('id','desc')->get();
    	return view('category.list', compact('categories'));
    }

    public function create(){

    	return view('category.add');
    }

    public function store(Request $request){

    	$request->validate([
    		'category_name' => 'required|unique:categories'
    	]);

    	$category = new Category();
    	$category->category_name = $request->category_name;
    	$category->save();
        session()->flash('category_success','Category Added  Successfully');
    	return redirect()->route('category.list');

    }

    public function edit($id){
    	$category = Category::find($id);
    	return view('category.edit',compact('category'));

    }
    

    public function update($id,Request $request){
    	$request->validate([
    		'category_name' => 'required|unique:categories,category_name,'.$id
    	]);

    	$category = Category::where('id',$id)->update([
    		"category_name" => $request->category_name
    	]);
        session()->flash('category_update','Category Updated  Successfully');
    	return redirect()->route('category.list');

    }



    public function destroy($id){

    	
    	$category = Category::find($id);
    	$category->delete();
        session()->flash('category_delete','Category Deleted  Successfully'); 
    	return redirect()->route('category.list');
    }
}
