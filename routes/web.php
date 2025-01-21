<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Models;

Route::get('/', function () {
    $products = auth('web')->user()->userProducts()->get();
    // $products = Product::where('user_id', auth('web')->id())->get();
    // $products = Product::all();
    return view('home', ['products' => $products]);
});

// Route::post has 2 arguments, the destination and the function 
Route::post('/register', [UserController::class, 'register']);
Route::post('/logout', [UserController::class, 'logout']);
Route::post('/login', [UserController::class, 'login']);

Route::post('/create-product', [ProductController::class, 'addProduct'])->middleware('auth');

