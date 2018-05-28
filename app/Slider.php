<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected $fillable = ['link', 'photo_id', 'category_id', 'order'];
}
