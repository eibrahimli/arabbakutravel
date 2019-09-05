<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Otel extends Model
{
    protected $fillable = [
      'name', 'description', 'adress', 'price' ,'category', 'photo' ,'singlePhoto','city','district'
    ];

    public function path() {

      return url('/otel/'.$this->id.'-'.Str::slug($this->name));
    }
}
