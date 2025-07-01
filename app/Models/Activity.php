<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Activity extends Model
{
    

    protected $fillable = ['name', 'description','location', 'cost', 'image'];

    public function itineraries(): HasMany
    {
        return $this->hasMany(Itinerary::class);
    }

    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }
}
