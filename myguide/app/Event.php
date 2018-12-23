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

    public function types()
    {
        return $this->belongsto(Event_Type::class);
    }
    public function attend()
    {
        return $this->belongsToMany(User::class,'events_has_users');
    }
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
    public function gallerys()
    {
        return $this->hasMany(Gallery::class);
    }




}
