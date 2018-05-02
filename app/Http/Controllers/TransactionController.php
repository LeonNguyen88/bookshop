<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\CreateFormRequest;
use App\Order;
use App\Order_detail;
use App\Product;
use App\User;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class TransactionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('checkout');
    }
    public function index(){
        $categories = Category::where('parent_id', 0)->get();
        $sale_products = Product::orderBy('sale', 'desc')->take(8)->get();
        $products = Cart::content();
        $total = Cart::subtotal(0, ',', '.');
        $user = User::where('id', Auth::user()->id)->first();
        return view('cart.transaction', compact('categories', 'sale_products', 'products', 'total', 'user'));
    }
    public function store(CreateFormRequest $request){
        $cart = Cart::content();
        $add_orders = $request->only(['realname', 'email', 'address', 'phone']);
        //dd($add_orders);
        $orders = Order::create([
            'user_id' => Auth::user()->id,
            'realname' => $add_orders['realname'],
            'email' => $add_orders['email'],
            'address' => $add_orders['address'],
            'phone' => $add_orders['phone'],
            'quantity' => Cart::count(),
            'total' => Cart::subtotal(0, ',', '')
        ]);
        foreach($cart as $item){
            $order_details = Order_detail::create([
                'order_id' => $orders->id,
                'product_id' => $item->id,
                'quantity' => $item->qty,
                'price' => $item->price
            ]);
            $product = Product::find($item->id);
            $product->update(['quantity' => $product->quantity - $item->qty]);
        }
        Cart::destroy();
        $data = ['orders' => $orders];
        Mail::send('emails.checkout', $data, function ($message) use ($orders) {
            $message->to($orders->email)->subject('[Sachngoaivan.com] Xác nhận đơn hàng số #'.$orders->id);
        });
        return redirect('/thank-you');
        //$add_orders_detail = $request->only([''])
    }
}
