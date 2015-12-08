<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function orderItems()
    {
        return $this->hasMany('\App\OrderItem');
    }

    protected $fillable = ['user_id', 'total', 'paid', 'charge_id'];
}
