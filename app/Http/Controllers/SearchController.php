<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request){
//        $keyword = $request->keyword;
//        $products = Product::search($keyword)->paginate(10);
//        $count = count(Product::search($keyword)->get());
//        return view('search', compact('products', 'keyword', 'count'));
    }
}
