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
        $test = Review::all();
        dd($test);
        return view('product', compact( 'categories', 'product', 'related_products', 'thumbnails', 'reviews', 'review_qty', 'avg_rating'));
    }
    private function sim_pearson($prefs, $p1, $p2){
        $si = [];
        $pSum = 0;
        $sum1 = 0;
        $sum1Sq = 0;
        $sum2 = 0;
        $sum2Sq = 0;
        foreach($prefs[$p1] as $key => $value){
            if(array_key_exists($key, $prefs[$p2]))
                $si[$key] = 1;
        }
        if(count($si) == 0)
            return 0;
        $n = count($si);
        foreach($si as $key => $value){
            $pSum += $prefs[$p1][$key] * $prefs[$p2][$key];
            $sum1 += $prefs[$p1][$key];
            $sum1Sq += pow($prefs[$p1][$key], 2);
            $sum2 += $prefs[$p2][$key];
            $sum2Sq += pow($prefs[$p2][$key], 2);
        }
        $num = $pSum - $sum1 * $sum2 / $n;
        $den = sqrt(($sum1Sq - pow($sum1, 2) / $n) * ($sum2Sq - pow($sum2, 2) / $n));
        if($den == 0)
            return 0;
        $r = $num / $den;
        return $r;
    }
}
