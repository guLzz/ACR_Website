<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $table = 'gallery';
    protected $fillable = [
        'name',
        'events_id'
    ];

    public function events()
    {
        return $this->belongsto(Event::class);
    }
}
