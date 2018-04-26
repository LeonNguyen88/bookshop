<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $fillable = ['photo_url', 'product_id', 'is_cover'];
    public function product(){
        return $this->belongsTo('App\Product');
    }
    public $directory = "/images/";
    public function getPhotoUrlAttribute($photo){
        return $this->directory.$photo;
    }
}
