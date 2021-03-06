<?php

namespace App\Http\Controllers;

use App\Category;
use App\Order_detail;
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
        $list_categories = Category::all();
        $categories = Category::where('parent_id', 0)->get();
        $latest_products = Product::orderBy('id', 'desc')->take(15)->get();
//        $products_category = Product::whereHas('categories', function($query) use ($categories){
//            $query->where('category_id', $this->$category->id);
//        })->get();
        $hot_products = Product::wherehas('Order_details', function($query){
            $query->orderByRaw('sum(order_details.quantity) DESC')->groupBy('order_details.product_id');
        })->take(8)->get();
        $sale_products = Product::orderBy('sale', 'desc')->take(8)->get();
        return view('home', compact('user', 'categories', 'latest_products', 'sale_products', 'hot_products','list_categories'));
    }

}
