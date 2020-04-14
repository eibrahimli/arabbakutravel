<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Dreamtour extends Model
{
    protected $fillable = ['title','city','desc','price','schedule','status'];

}
