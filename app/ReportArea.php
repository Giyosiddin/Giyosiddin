<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReportArea extends Model
{
    public function area()
    {
        return $this->belongsTo('App\Area');
    }

    public function report()
    {
        return $this->belongsTo('App\Report');
    }

    public function problems()
    {
        return $this->hasMany('App\AreaProblem');
    }
}
