<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    protected $fillable = ['name', 'parent_id'];
    public function products(){
        return $this->belongsToMany('App\Product');
    }
    public function toName($id){
        if(Category::find($id)){
            $category = Category::whereId($id)->first();
            return $category->name;
        }
    }

}
