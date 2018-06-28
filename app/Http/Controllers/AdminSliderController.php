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
        $already = [];
        for($i = 0; $i <= count($categories); $i++){
            if(Slider::where('category_id', $i)->first() != null){
                $already[] = $i;
            }
        }
        return view('admin.sliders.index', compact('categories', 'already'));
    }
    public function create($id){
        if($id == 0){
            $name = "Trang chủ";
        }
        else $name = Category::find($id)->name;
        return view('admin.sliders.create', compact('name', 'id'));
    }
    public function store(Request $request){
        $input = $request->all();
        for($i = 0; $i < count($input['photo_url']); $i++){
            if($file = $input['photo_url'][$i]){
                $name = $file->getClientOriginalName();
                $file->move('images', $name);
                $photo = Photo::create(['photo_url' => $name]);
                $input['photo_id'] = $photo->id;
            }
            Slider::create(['category_id' => $input['category_id'], 'photo_id' => $photo->id, 'link' => $input['link'][$i], 'order' => $input['order'][$i]]);
        }
        return redirect()->route('admin.slider');
    }
    public function edit($id){
        $slider = Slider::where('category_id', $id)->get();
        if($id == 0){
            $name = "Trang chủ";
        }
        else $name = Category::find($id)->name;
        return view('admin.sliders.edit', compact('slider', 'name', 'id'));
    }
}
