<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

use App\Dreamtour;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','fName','lName','country','city','phone','level','photo','street'
    ];

//    protected $attributes = [
//      'user' => 'user',
//    ];

    public function getUserAttribute($attribute) {
      return $this->userOptions()[$attribute];
    }
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

    public function userOptions() {
      return [
        'user' => 'User',
        'admin' => 'Admin',
      ];
    }

}
