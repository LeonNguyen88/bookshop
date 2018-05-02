<?php

namespace App\Http\Controllers;

use App\Order;
use App\Order_detail;
use App\Product;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function account(){
        $user = Auth::user();
        return view('users.account', compact('user'));
    }
    public function updateaccount(Request $request, $id){
        $user = User::find($id)->update($request->all());
        return redirect()->route('account');
    }
    public function orderhistory(){
        $orders = Order::where('user_id', Auth::user()->id)->orderBy('id', 'desc')->get();
        return view('users.order', compact('orders'));
    }
    public function orderdetail($id){
        $orders = Order_detail::where('order_id', $id)->get();
        return view('users.orders_detail', compact('orders'));
    }
    public function removeorder($id){
        $order = Order::find($id);
        if($order->status == "Chưa giao hàng"){
            foreach($order->order_details as $item){
                $product = Product::find($item->product_id);
                $product->update(['quantity' => $product->quantity + $item->quantity]);
            }
            $order->delete();
        }
        return redirect('/order/history');
    }
}
