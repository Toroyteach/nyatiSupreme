<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RequestProduct extends Model
{
    //
    protected $table = 'request_products';
    
    protected $fillable = ['name', 'quantity', 'email_number', 'description'];

    protected $dates = ['deleted_at'];
}
