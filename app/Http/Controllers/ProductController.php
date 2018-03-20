<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use App\Product_detail;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index($id){
        $categories = Category::where('parent_id', 0)->get();
        $product = Product::findOrFail($id);
        $category_of_product = $product->category->pluck('id');
        $related_products = Product::whereHas('category', function($query) use($product, $category_of_product) {
            $query->whereIn('category.id', $category_of_product)->where('products.id', '<>', $product->id);
        })->get();
        return view('product', compact( 'categories', 'product', 'related_products'));
    }
}