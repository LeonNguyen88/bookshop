<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected  $fillable = [
      'users_id', 'realname', 'phone', 'address', 'email', 'quantity', 'total', 'status'
    ];
    public function orders_detail(){
        return $this->hasMany('App\Orders_detail', 'orders_id');
    }
    public function user(){
        return $this->belongsTo('App\User', 'users_id');
    }
}
