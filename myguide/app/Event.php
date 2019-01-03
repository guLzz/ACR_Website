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
    public function users()
    {
        return $this->belongsToMany(User::class, 'users_events');
    }
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
    public function gallerys()
    {
        return $this->hasMany(Gallery::class);
    }
    public function bundles()
    {
        return $this->belongsToMany(Bundle::class, 'users_events');
    }




}
