<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
{
    public function series()
    {
        return $this->hasOne('App\Series');
    }
}
