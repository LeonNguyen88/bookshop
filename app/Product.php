<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'price', 'sale', 'category_id', 'description', 'quantity'];
    public function categories(){
        return $this->belongsToMany('App\Category');
    }
    public function photo(){
        return $this->hasMany('App\Photo');
    }
    public function product_detail(){
        return $this->hasOne('App\Product_detail');
    }
    public function order_details(){
        return $this->hasMany('App\Order_detail');
    }
    /*public function getPriceAttribute($value){
        return number_format($value, 0, ',', '.');
    }
    public function getSaleAttribute($value){
        return number_format($value, 0, ',', '.');
    }*/
}
