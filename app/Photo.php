<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $fillable = ['photo_url'];
    public function product(){
        return $this->hasMany('App\Product', 'photos_id');
    }
    public $directory = "/images/";
    public function getPhotoUrlAttribute($photo){
        return $this->directory.$photo;
    }
}
