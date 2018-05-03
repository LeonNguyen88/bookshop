<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index($id, Request $request)
    {
        $category = Category::find($id);
        if ($category->parent_id != 0) {
            $category = Category::where('id', $category->parent_id)->first();
        }
        $child_category = Category::where('parent_id', $category->id)->get();
        $real_category = Category::find($id);
        $products = Product::filter()->wherehas('categories', function ($query) use ($id, $request) {
            $query->where('category_id', $id);
        })->sort()->paginate(20);
        return view('category', compact('products', 'category', 'child_category', 'real_category'));
    }
}
