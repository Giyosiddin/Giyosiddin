<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Standart extends Model
{
    public function profession()
    {
        return $this->belongsTo('App\Profession');
    }
}
