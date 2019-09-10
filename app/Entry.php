<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Entry extends Model
{
    public function series()
    {
        return $this->belongsTo('App\Series');
    }

    public function account()
    {
        return $this->belongsTo('App\Account');
    }

    public function site()
    {
        return $this->belongsTo('App\Site');
    }

    public function getIsCreditAttribute()
    {
        return $this->type == 'credit' ? true : false;
    }

    public function getIsDebitAttribute()
    {
        // reverse
        return !$this->is_credit;
    }
}
