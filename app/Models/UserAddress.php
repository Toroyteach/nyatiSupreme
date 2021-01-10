<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserAddress extends Model
{
    //
    use SoftDeletes;
    protected $table = 'user_address';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fullname', 'address', 'city', 'phonenumber', 'user_id', 'geo_location' => 'array', 'county', 'town','location', 'default_address'
    ];

    protected $dates = ['deleted_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function userEmail()
    {
        return $this->email;
    }
}
