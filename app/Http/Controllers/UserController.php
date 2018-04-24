<?php

namespace App\Http\Controllers;

use App\Order;
use App\Orders_detail;
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
        $orders = Order::where('users_id', Auth::user()->id)->orderBy('id', 'desc')->get();
        return view('users.order', compact('orders'));
    }
    public function orderdetail($id){
        $orders = Orders_detail::where('orders_id', $id)->get();
        return view('users.orders_detail', compact('orders'));
    }
    public function removeorder($id){
        $order = Order::find($id);
        if($order->status == "Chưa giao hàng"){
            foreach($order->orders_detail as $item){
                $product = Product::find($item->products_id);
                $product->update(['quantity' => $product->quantity + $item->quantity]);
            }
            $order->delete();
        }
        return redirect('/order/history');
    }
}
