<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Product;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function store(Request $request, $id){
        $input = $request->all();
        $product = Product::find($id);
        $comment = Comment::create(['content' => $input['content'], 'user_id' => Auth::user()->id, 'product_id' => $product->id]);
        return redirect()->back();
    }
    public function destroy($id){
        $comment = Comment::find($id)->delete();
        return view('admin.comment.index');
    }
}
