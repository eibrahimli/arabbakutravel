<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dreamtour extends Model
{
    protected $fillable = ['title','city','desc','schedule','status'];
}
