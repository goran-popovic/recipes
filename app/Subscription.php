<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'status', 'reference', 'recurring', 'customer_reference', 'start_date', 'expiration_date',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'expiration_date' => 'datetime',
        'start_date' => 'datetime',
    ];

    /**
     * Get the order associated with the subscription.
     */
    public function order()
    {
        return $this->hasOne('App\Order');
    }
}
