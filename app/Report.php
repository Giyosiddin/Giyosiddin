<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    public function form()
    {
        return $this->belongsTo('App\Form');
    }

    public function status()
    {
        return $this->belongsTo('App\Status');
    }

    public function test_speed()
    {
        return $this->belongsTo('App\TestSpeed');
    }

    public function system()
    {
        return $this->belongsTo('App\System');
    }

    public function areas()
    {
        return $this->hasMany('App\ReportArea');
    }
}
