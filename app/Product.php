<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'price', 'sale', 'category_id', 'description', 'quantity'];
    public function category(){
        return $this->belongsToMany('App\Category', 'products_category', 'products_id', 'category_id');
    }
    public function photo(){
        return $this->hasMany('App\Photo');
    }
    public function product_detail(){
        return $this->hasOne('App\Product_detail');
    }
    /*public function getPriceAttribute($value){
        return number_format($value, 0, ',', '.');
    }
    public function getSaleAttribute($value){
        return number_format($value, 0, ',', '.');
    }*/
}
