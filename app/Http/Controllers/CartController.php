<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use Gloudemans\Shoppingcart\CartItem;
use Gloudemans\Shoppingcart\CartItemOptions;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index(){
        $categories = Category::where('parent_id', 0)->get();
        $carts = Cart::content();
        $total = Cart::subtotal(0, '.', ',');
        $count = Cart::count();
        $sum_price_old = 0;
        $sum_sale = 0;
        foreach($carts as $item){
            $sum_price_old = $sum_price_old + $item->options->old_price * $item->qty;
            $sum_sale = $sum_sale + $item->options->sale * $item->qty;
        }
        return view('cart.index', compact('categories', 'carts', 'total', 'count', 'sum_price_old', 'sum_sale'));
    }
    public function add($id){
        $product = Product::whereId($id)->first();
        $cart_qty = 0;
        foreach(Cart::content() as $item){
            if($item->id == $id){
                $cart_qty = $item->qty;
            }
        }
        if($product->quantity == 0 || $cart_qty >= $product->quantity){
            echo "<script>alert('Xin lỗi khách hàng, sản phẩm này hiện tại đã hết hàng.'); history.go(-1);</script>";
        }
        else if(Cart::count() == 7){
            echo "<script>alert('Khách hàng vui lòng thanh toán giỏ hàng trước khi mua tiếp !'); location.href='/cart';</script>";
        }
        else {
            Cart::add($id, $product->name, 1, $product->price - $product->sale, ['image' => $product->photo->photo_url, 'old_price' => $product->price, 'sale' => $product->sale])->associate('App\Product');
            //Product::find($id)->update(['quantity' => $product->quantity - 1]);
            return redirect()->route('cart');
        }
    }
    public function delete($id){
        $item = Cart::content()->where('id', $id)->first();
        //$product = Product::find($id);
        Cart::remove($item->rowId);
        //$product->update(['quantity' => $product->quantity + $item->qty]);
        return redirect()->route('cart');
    }
    public function decrease($id){
        $item = Cart::content()->where('id', $id)->first();
        //$product = Product::find($id);
        Cart::update($item->rowId, $item->qty - 1);
        //$product->update(['quantity' => $product->quantity + 1]);
        return redirect()->route('cart');
    }
}
