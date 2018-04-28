<?php

namespace App\Http\Controllers;

use App\Category;
use App\Orders_detail;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    /*public function __construct()
    {
        $this->middleware('auth');
    }*/

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $categories = Category::where('parent_id', 0)->get();
        $latest_products = Product::orderBy('id', 'desc')->take(15)->get();
        //$sub_categories = Category::where('id', $categories->parent_id)->get();
        $cate = Category::find(1);
        $products_category = Product::wherehas('category', function($query) use ($categories){
            $query->where('category_id', $categories);
        })->get();
        //$hot_products = Orders_detail::orderByRaw('sum(quantity) DESC')->groupBy('products_id')->take(8)->get();
        $hot_products = Product::wherehas('Orders_detail', function($query){
            $query->orderByRaw('sum(orders_details.quantity) DESC')->groupBy('orders_details.products_id');
        })->take(8)->get();
        $sale_products = Product::orderBy('sale', 'desc')->take(8)->get();
        return view('home', compact('user', 'categories', 'latest_products', 'sale_products', 'hot_products'));
    }

}
