<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Guide extends Model
{
    protected $primaryKey = 'user_id';
    public $incrementing = false;
    protected $KeyType ='int';

    protected $fillable = ['user_id', 'availability', 'experience', 'description', 'status'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }


    // Guide has many reviews
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    // Guide can be assigned to many bookings
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

}
