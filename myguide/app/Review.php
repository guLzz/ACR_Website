<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    public function event()
    {
        return $this->belongsto(Event::class);
    }
}
