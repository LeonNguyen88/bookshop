<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected  $fillable = [
      'users_id', 'realname', 'phone', 'address', 'email', 'quantity', 'total', 'status'
    ];
    public function order_details(){
        return $this->hasMany('App\Order_detail');
    }
    public function user(){
        return $this->belongsTo('App\User');
    }
}
