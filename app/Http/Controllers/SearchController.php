<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request){
        $keyword = $request->keyword;
        $products = Product::search($keyword)->get();
        $count = count($products);
        return view('search', compact('products', 'keyword', 'count'));
    }
}
