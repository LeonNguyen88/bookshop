<?php

namespace App\Http\Controllers;

use App\Category;
use App\Photo;
use App\Slider;
use Illuminate\Http\Request;

class AdminSliderController extends Controller
{
    public function index(){
        $categories = Category::all();
        return view('admin.sliders.index', compact('categories'));
    }
    public function create($id){
        if($id == 0){
            $name = "Trang chủ";
        }
        else $name = Category::find($id)->name;
        return view('admin.sliders.create', compact('name'));
    }
    public function store(Request $request){
        $input = $request->all();
        for($i = 0; $i < count($input['photo_url']); $i++){
            if($file = $request->file('photo_url')){
                $name = $input['photo_url'][$i]->getClientOriginalName();
                $input['photo_url'][$i]->move('images', $name);
                $photo = Photo::create(['photo_url' => $name]);
                $input['photo_id'][$i] = $photo->id;
            }
            Slider::create(['category_id' => 0, 'photo_id' => $input['photo_url'][$i], 'link' => $input['link'][$i], 'order' => $input['order'][$i]]);
        }
        return redirect()->route('admin.slider');
    }
}
