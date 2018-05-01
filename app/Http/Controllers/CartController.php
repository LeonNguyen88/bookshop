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
    public function add(Request $request){
        $product = Product::whereId($request->id)->first();
        $cart_qty = 0;
        foreach($product->photo as $photo){
            if($photo->is_cover == 1){
                $image = $photo->photo_url;
            }
        }
        foreach(Cart::content() as $item){
            if($item->id == $request->id){
                $cart_qty = $item->qty;
            }
        }
        if($product->quantity == 0 || $cart_qty >= $product->quantity){
            return "Xin lỗi khách hàng, sản phẩm này hiện tại đã hết hàng.";
        }
        else if(Cart::count() == 7){
            return "Khách hàng vui lòng thanh toán giỏ hàng trước khi mua tiếp !";
        }
        else {
            Cart::add($request->id, $product->name, 1, $product->price - $product->sale, ['image' => $image, 'old_price' => $product->price, 'sale' => $product->sale])->associate('App\Product');
            $item = Cart::content()->where('id', $request->id)->first();
            $cart = Cart::content();
            $count = Cart::count();
            $total = Cart::subtotal(0, '.', ',');
            $sum_price_old = 0;
            $sum_sale = 0;
            foreach($cart as $data){
                $sum_price_old = $sum_price_old + $data->options->old_price * $data->qty;
                $sum_sale = $sum_sale + $data->options->sale * $data->qty;
            }
            return ['item_qty' => $item->qty, 'item_price' => $item->qty * $item->price, 'sum_price_old' => $sum_price_old, 'sum_sale' => $sum_sale, 'total_qty' => $count, 'subtotal' => $total];
        }
    }
    public function decrease(Request $request){
        $item = Cart::content()->where('id', $request->id)->first();
        //$product = Product::find($id);
        Cart::update($item->rowId, $item->qty - 1);
        $cart = Cart::content();
        $count = Cart::count();
        $total = Cart::subtotal(0, '.', ',');
        $sum_price_old = 0;
        $sum_sale = 0;
        foreach($cart as $data){
            $sum_price_old = $sum_price_old + $data->options->old_price * $data->qty;
            $sum_sale = $sum_sale + $data->options->sale * $data->qty;
        }
        return ['item_qty' => $item->qty, 'item_price' => $item->qty * $item->price, 'sum_price_old' => $sum_price_old, 'sum_sale' => $sum_sale, 'total_qty' => $count, 'subtotal' => $total];
    }
    public function delete(Request $request){
        $item = Cart::content()->where('id', $request->id)->first();
        Cart::remove($item->rowId);
        $cart = Cart::content();
        $count = Cart::count();
        $total = Cart::subtotal(0, '.', ',');
        $sum_price_old = 0;
        $sum_sale = 0;
        foreach($cart as $data){
            $sum_price_old = $sum_price_old + $data->options->old_price * $data->qty;
            $sum_sale = $sum_sale + $data->options->sale * $data->qty;
        }
        return ['item_qty' => $item->qty, 'item_price' => $item->qty * $item->price, 'sum_price_old' => $sum_price_old, 'sum_sale' => $sum_sale, 'total_qty' => $count, 'subtotal' => $total];
    }
}
