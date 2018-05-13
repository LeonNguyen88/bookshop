<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Product extends Model
{
    use Searchable;
    protected $searchable = [
        'name'
    ];
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
    public function searchableAs()
    {
        return 'products_name_index';
    }
    public function toSearchableArray()
    {
        $array = $this->toArray();
        return $array;
    }
    /*public function getPriceAttribute($value){
        return number_format($value, 0, ',', '.');
    }
    public function getSaleAttribute($value){
        return number_format($value, 0, ',', '.');
    }*/
}
