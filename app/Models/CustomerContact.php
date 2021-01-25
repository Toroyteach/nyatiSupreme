<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerContact extends Model
{
    //

    protected $table = 'customer_contacts';

    protected $fillable = ['name', 'email', 'subject', 'description'];

    protected $dates = ['deleted_at'];
}
