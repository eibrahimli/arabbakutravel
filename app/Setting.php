<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
      'siteTitle','siteDesc','siteKey','siteNum','siteMail','siteSocial','siteFooterCopy','siteAdress','siteLogo'
    ];
}
