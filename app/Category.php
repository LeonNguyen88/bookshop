<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'category';
    protected $fillable = ['name', 'parent_id'];
    public function product(){
        return $this->belongsToMany('App\Product', 'products_category', 'category_id', 'products_id');
    }
    public function toName($id){
        if(Category::find($id)){
            $category = Category::select('name')->whereId($id)->first();
            return $category->name;
        }
    }

}
