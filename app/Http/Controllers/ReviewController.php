<?php

namespace App\Http\Controllers;

use App\Http\Requests\RatingRequest;
use App\Product;
use App\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function store(Request $request, $id){
        $input = $request->all();
        $product = Product::find($id);
        $review = Review::create(['content' => $input['content'], 'rating' => $input['rating'], 'user_id' => Auth::user()->id, 'product_id' => $product->id]);
        $avg_rating = round($product->reviews->avg('rating'), 0);
        $product->update(['rating_count' => $product->reviews->count(), 'rating_cache' => $avg_rating]);
        return redirect()->route('product', $id);
    }
}
