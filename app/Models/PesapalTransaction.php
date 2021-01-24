<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PesapalTransaction extends Model
{
    //
    protected $table = 'pesapal_transactions';

    protected $fillable = ['status','businessid','transactionid','trackingid','amount','payment_method'];

    protected $dates = ['deleted_at'];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
