<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'password', 'address', 'city', 'country', 'phonenumber',  'profile_image'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    /**
     * @return string
     */
    public function getFullNameAttribute()
    {
        return $this->first_name. ' '. $this->last_name;
    }

    public function getimageurl()
    {
        return env('APP_URL').$this->profile_image;
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function wishlist(){
        return $this->hasMany(Wishlist::class);
    }

    public function address()
    {
        return $this->hasMany(UserAddress::class);
    }
}
