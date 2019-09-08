<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransferSifaris extends Model
{
    protected $table = 'transfer_sifaris';

    protected $fillable = [
        'user_id','transfer_id', 'phone', 'email' , 'adults','child', 'price', 'customer', 'title','date','time',
        'dropOffAdress', 'pickUpAdress'
    ];
}
