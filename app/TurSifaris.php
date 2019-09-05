<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TurSifaris extends Model
{
    protected $fillable = [
      'user_id','tur_id', 'phone', 'email' , 'adults','child', 'price', 'customer', 'status', 'title'
    ];
}
