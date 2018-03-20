<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product_detail extends Model
{
    protected $fillable = ['product_id', 'issuer', 'publisher', 'author', 'size', 'cover', 'num_page', 'date_publish', 'status'];
    public $timestamps = false;
}
