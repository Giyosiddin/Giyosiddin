<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Problems extends Model
{
    public function profession()
    {
        return $this->belongsTo('App\Profession');
    }
}
