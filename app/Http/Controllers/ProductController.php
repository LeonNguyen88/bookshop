<?php

namespace App\Http\Controllers;

use App\Category;
use App\Photo;
use App\Product;
use App\Product_detail;
use App\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index($id){
        $categories = Category::where('parent_id', 0)->get();
        $product = Product::findOrFail($id);
        $thumbnails = Photo::where('product_id', $id)->where('is_cover', 0)->orderBy('id', 'desc')->take(4)->get();
        $category_of_product = $product->categories->pluck('id');
        $related_products = Product::whereHas('categories', function($query) use($product, $category_of_product) {
            $query->whereIn('categories.id', $category_of_product)->where('products.id', '<>', $product->id);
        })->get();
        $reviews = Review::where('product_id', $id)->paginate(4);
        $review_qty = count($product->reviews);
//        $review = Review::select('product_id')->groupBy('product_id')->get()->toArray();
        $array = [];
        $review = Review::all();
        foreach($review as $item){
            $array[$item->user->name] = [$item->product->name => $item->rating];
        }

        return view('product', compact( 'categories', 'product', 'related_products', 'thumbnails', 'reviews', 'review_qty', 'avg_rating'));
    }
}
