<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Series extends Model
{
    public function entries()
    {
        return $this->hasMany('App\Entry');
    }

    public function purchase_order()
    {
        return $this->belongsTo('App\PurchaseOrder');
    }
}
