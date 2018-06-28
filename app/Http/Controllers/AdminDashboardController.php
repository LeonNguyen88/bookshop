<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Order;
use App\Order_detail;
use App\Product;
use App\Review;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index(){
        $comment = Comment::whereDate('created_at', Carbon::today())->get()->count();
        $product = Product::whereDate('created_at', Carbon::today())->get()->count();
        $order = Order::whereDate('created_at', Carbon::today())->get()->count();
        $user = User::whereDate('created_at', Carbon::today())->get()->count();
        $total_pro = Product::all()->count();
        $avai_pro = Product::where('quantity', '>', 0)->get()->count();
        $hot_products = Product::wherehas('Order_details', function($query){
            $query->orderByRaw('sum(order_details.quantity) DESC')->groupBy('order_details.product_id');
        })->take(3)->get();
        $ordered_pro = Order_detail::groupBy('product_id')->get()->count();
        $total_ord = Order::all()->count();
        $not_ord = Order::where('status', 'Chưa giao hàng')->get()->count();
        $ing_ord = Order::where('status', 'Đang giao hàng')->get()->count();
        $al_ord = Order::where('status', 'Đã giao hàng')->get()->count();
        $total_user = User::all()->count();
        $total_cmt = Comment::all()->count();
        $total_review = Review::all()->count();
        return view('admin.index', compact('comment', 'product', 'order', 'user', 'total_pro', 'avai_pro', 'hot_products', 'ordered_pro', 'total_ord', 'al_ord', 'not_ord', 'ing_ord', 'total_user', 'total_cmt', 'total_review'));
    }
}
