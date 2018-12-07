<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event_Type extends Model
{
    public function getEventTypeName()
    {
        $query = DB::table('events_type')->select('type');
        return $query;
    }

    public function events()
    {
        return $this->hasMany('App\Event');
    }
}
