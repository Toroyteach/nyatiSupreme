<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class STKPush extends Model
{

    /**
 * Class STKPush
 * @package App
 * @property string $result_desc
 * @property string $result_code
 * @property string $merchant_request_id
 * @property string $checkout_request_id
 * @property string $amount
 * @property string $mpesa_receipt_number
 * @property string $transaction_date
 * @property string $phone_number
 */

    protected $fillable = [
        'order_id',
        'result_desc',
        'result_code',
        'merchant_request_id',
        'checkout_request_id',
        'amount',
        'mpesa_receipt_number',
        'transaction_date',
        'phone_number',
    ];

    protected $table = 'mpesa_stk_push';

    //belongs to
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
