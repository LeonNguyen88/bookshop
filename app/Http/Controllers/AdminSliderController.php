<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class AdminSliderController extends Controller
{
    public function index(){
        $categories = Category::all();
        return view('admin.sliders.index', compact('categories'));
    }
}
