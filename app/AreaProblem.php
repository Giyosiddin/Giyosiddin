<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AreaProblem extends Model
{
    public function problem()
    {
        return $this->belongsTo('App\Problems');
    }
}
