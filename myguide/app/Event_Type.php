<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event_Type extends Model
{

    public function events()
    {
        return $this->hasMany('App\Event');
    }
}
