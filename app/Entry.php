<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Entry extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'series_id',
        'account_id',
        'site_id',
        'amount',
        'description',
        'type',
    ];

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

    public function getDebitAmountAttribute()
    {
        return $this->is_debit ? $this->amount : 0;
    }

    public function getCreditAmountAttribute()
    {
        return $this->is_credit ? $this->amount : 0;
    }
}
