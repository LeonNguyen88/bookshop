<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Products_category extends Model
{
    protected $table = "category_product";
    protected $fillable = ['product_id', 'category_id'];
}
