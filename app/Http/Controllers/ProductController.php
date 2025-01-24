<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function addProduct(Request $request){
        $incomingFields = $request->validate([
            'product' => 'required',
            'size' => 'required',
            'category' => 'required',
            'price' => 'required|numeric',
        ]);
    
        $incomingFields['product'] = strip_tags($incomingFields['product']);
        $incomingFields['size'] = strip_tags($incomingFields['size']);
        $incomingFields['category'] = strip_tags($incomingFields['category']);
        $incomingFields['price'] = strip_tags($incomingFields['price']);
        $incomingFields['user_id'] = auth('web')->id();
    
        try {
            Product::create($incomingFields);
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    
        return redirect('/');
    }
    
    public function editProduct(Product $product){
        if(auth('web')->user()->id !== $product['user_id']){
            return redirect('/');
        }
        return view('edit-product', ['product' => $product]);
    }

    public function updateProduct(Product $product, Request $request){
        if(auth('web')->user()->id !== $product['user_id']){
            return redirect('/');
        }

        $incomingFields = $request->validate([
            'product' => 'required',
            'size' => 'required',
            'category' => 'required',
            'price' => 'required|numeric',
        ]);

        $incomingFields['product'] = strip_tags($incomingFields['product']);
        $incomingFields['size'] = strip_tags($incomingFields['size']);
        $incomingFields['category'] = strip_tags($incomingFields['category']);
        $incomingFields['price'] = strip_tags($incomingFields['price']);

        $product->update($incomingFields);

        return redirect('/');
    }

    public function deleteProduct(Product $product){
        if(auth('web')->user()->id === $product['user_id']){
            $product->delete();
        }
        return redirect('/');
    }
}
