<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;

class AdminCommentController extends Controller
{
    public function index(){
        $comments = Comment::all();
        return view('admin.comments.index', compact('comments'));
    }
}
