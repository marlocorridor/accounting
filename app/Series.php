<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Series extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'module_id',
        'reference_number',
        'payee',
        'description',
    ];

    public function entries()
    {
        return $this->hasMany('App\Entry');
    }

    public function purchase_order()
    {
        return $this->belongsTo('App\PurchaseOrder');
    }

    public function module()
    {
        return $this->belongsTo('App\Module');
    }

    public function getPoDescriptionAttribute()
    {
        $po = $this->purchase_order;
        return $po ? $this->purchase_order->description : '-';
    }

    public function getModuleCodeAttribute()
    {
        $module = $this->module;
        return $module ? $this->module->code : '';
    }

    public function getAmountDetailsAttribute()
    {
        $entries = $this->entries;
        // filter credits
        $amount_cr = $entries->filter(function ($value, $key) {
            return $value->is_credit;
        })->sum('amount');
        // filter debits
        $amount_dr = $entries->filter(function ($value, $key) {
            return $value->is_debit;   
        })->sum('amount');

        return [
            'amount_cr' => $amount_cr,
            'amount_dr' => $amount_dr,
        ];
    }

    public function getAmountDebitAttribute()
    {
        return $this->amount_details['amount_dr'];
    }

    public function getAmountCreditAttribute()
    {
        return $this->amount_details['amount_cr'];
    }

    public function getCodeAttribute()
    {
        return $this->module_code . '-' . sprintf( '%08d', $this->id );
    }

    public function getHasNoEntriesAttribute($query)
    {
        return $this->entries->count() < 1;
    }

}
