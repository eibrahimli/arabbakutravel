<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Transfer extends Model
{
    protected $fillable = [
      'name','price', 'description','pickUpAdress','dropOffAdress','photo', 'singlePhoto'
    ];

    public function path() {
      return url('/transfer/'.$this->id.'-'.Str::slug($this->name));
    }
}
