<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orders_detail extends Model
{
    protected $fillable = ['orders_id', 'products_id', 'quantity', 'price', 'status'];
    public function order(){
        return $this->belongsTo('App\Order', 'orders_id');
    }
    public function product(){
        return $this->belongsTo('App\Product', 'products_id');
    }
}
