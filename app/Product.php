<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Laravel\Scout\Searchable;

class Product extends Model
{
    use Searchable;
    protected $searchable = [
        'name'
    ];
    protected $fillable = ['name', 'price', 'sale', 'category_id', 'description', 'quantity', 'rating_cache', 'rating_count'];
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
    public function reviews(){
        return $this->hasMany('App\Review');
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
    public function scopeFilter($query)
    {
        if (request('price')) {
            $price = explode(' ', request('price'));
            $query->whereraw('price-sale >= ' . $price[0])->whereraw('price-sale <= ' . $price[1]);
        }
        if (request('author')) {
            $query->whereHas('product_detail', function ($query) {
                $query->where('product_details.author', request('author'));
            });
        }
        return $query;
    }
    public function scopeSort($query){
        if (request('sort')) {
            if(request('sort') == 'a-z'){
                $query->orderBy('name', 'asc');
            }
            if(request('sort') == 'z-a'){
                $query->orderBy('name', 'desc');
            }
            if(request('sort') == 'priceasc'){
                $query->orderByRaw('price-sale ASC');
            }
            if(request('sort') == 'pricedesc'){
                $query->orderByRaw('price-sale DESC');
            }
            if(request('sort') == 'new'){
                $query->orderBy('id', 'desc');
            }
            if(request('sort') == 'old'){
                $query->orderBy('id', 'asc');
            }
        }
        else $query->orderBy('id', 'desc');
        return $query;
    }
    public function scopeRating($query){
        $query->selectRaw('round(avg(rating), 0)')->where('id', 'reviews.product_id');
    }

}
