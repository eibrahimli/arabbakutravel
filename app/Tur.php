<?php

namespace App;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Tur extends Model
{
    protected $fillable = [
      'turBas','turKat','turQiy','turAciq','turCedvel','turP','turSingleP'
    ];

    public function categorie() {
      return $this->belongsTo(Categorie::class,'turKat');
    }

    public function path() {

      return url("/tur/{$this->id}-".Str::slug($this->turBas));
    }
}
