<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event_Type extends Model
{
    public $table = "events_type";
    protected $fillable = [
        'type',
        'pic'
    ];

    public function events()
    {
        return $this->hasMany(Event::class);
    }
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
