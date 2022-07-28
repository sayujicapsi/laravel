<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/categories',[CategoryController::class,'index'])->name('category.list');
Route::get('/categories/add',[CategoryController::class,'create'])->name('category.add');
Route::get('/categories/edit/{id}',[CategoryController::class,'edit'])->name('category.edit');
Route::post('/categories/store',[CategoryController::class,'store'])->name('category.store');
Route::put('/categories/update/{id}',[CategoryController::class,'update'])->name('category.update');
Route::get('/categories/delete/{id}',[CategoryController::class,'destroy'])->name('category.delete');

Route::get('/products',[ProductController::class,'index'])->name('product.list');
Route::get('/products/add',[ProductController::class,'create'])->name('product.add');
Route::get('/products/edit/{id}',[ProductController::class,'edit'])->name('product.edit');
Route::post('/products/store',[ProductController::class,'store'])->name('product.store');
Route::put('/products/update/{id}',[ProductController::class,'update'])->name('product.update');
Route::get('/products/delete/{id}',[ProductController::class,'destroy'])->name('product.delete');


Route::get('/orders',[OrderController::class,'index'])->name('order.list');
Route::get('/orders/add',[OrderController::class,'create'])->name('order.add');
Route::get('/orders/edit/{id}',[OrderController::class,'edit'])->name('order.edit');
Route::post('/orders/store',[OrderController::class,'store'])->name('order.store');
Route::put('/orders/update/{id}',[OrderController::class,'update'])->name('order.update');
Route::get('/orders/delete/{id}',[OrderController::class,'destroy'])->name('order.delete');


Route::get('/pdf/{id}',[PdfController::class,'pdf'])->name('order.pdf');

