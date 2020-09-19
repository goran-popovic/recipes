<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'subscription_id', 'status', 'reference', 'order_number', 'sale_date'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'sale_date' => 'datetime',
    ];

    /**
     * Get the subscription that the order belongs to.
     */
    public function subscription()
    {
        return $this->belongsTo('App\Subscription');
    }
}
