<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{

    protected $fillable = [
        'events_type_id',
        'events_type_type',
        'pic',
        'name',
        'name',
        'price',
        'date',
        'nr_pax'
    ];

    public function users()
    {
        return $this->belongsto(Event_Type::class);
    }


}
