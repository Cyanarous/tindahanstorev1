<?php

use App\Models;
use App\Models\User;
use App\Models\Product;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Auth;


Route::get('/', function () {
    $products = [];
    if(auth('web')->check()){
    $products = auth('web')->user()->userProducts()->latest()->get();}
    //eto working pang self
    // $products = Product::all();
    // $products = Product::where('user_id', auth('web')->id())->get();
    return view('home', ['products' => $products]);
});

// Route::post has 2 arguments, the destination and the function 
Route::post('/register', [UserController::class, 'register']);
Route::post('/logout', [UserController::class, 'logout']);
Route::post('/login', [UserController::class, 'login']);

Route::post('/create-product', [ProductController::class, 'addProduct'])->middleware('auth');

Route::get('/edit-product/{product}', [ProductController::class, 'editProduct']);
Route::put('/edit-product/{product}', [ProductController::class, 'updateProduct']);
Route::delete('/delete-product/{product}', [ProductController::class, 'deleteProduct']);



Route::get('/test-auth', function () {
    $user = auth('web')->user();
    dd($user); // This will dump the user object or null
});

