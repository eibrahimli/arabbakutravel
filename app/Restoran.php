<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Restoran extends Model
{
    protected $fillable = [
      'name', 'district', 'price', 'photo', 'singlePhoto','adress','description'
    ];

    public function path() {
      return url('/restoran/'.$this->id.'-'.$this->name);
    }
}
