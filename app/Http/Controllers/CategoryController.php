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
        $products = Product::wherehas('category', function ($query) use ($id, $request) {
            if ($request->has('price')) {
                $price = explode(' ', $request->get('price'));
                $query->where('category_id', $id)->whereraw('price-sale >= ' . $price[0])->whereraw('price-sale <= ' . $price[1]);
            } else $query->where('category_id', $id);
        })->get();
        return view('category', compact('products', 'category', 'child_category', 'real_category'));
    }
}
