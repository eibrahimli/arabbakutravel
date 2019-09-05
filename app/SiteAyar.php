<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SiteAyar extends Model
{
    protected $fillable = [
      'menuP', 'videoP', 'videoUrl', 'videoTitle', 'videoSubTitle', 'gsP', 'tursP', 'otelsP', 'transfersP', 'restoransP', 'contactP', 'aboutP'
    ];
}
