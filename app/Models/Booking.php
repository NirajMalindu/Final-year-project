<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Booking extends Model
{
   

    protected $fillable = ['user_id', 'guide_id', 'status', 'date', 'activity_id'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function guide(): BelongsTo
    {
        return $this->belongsTo(User::class, 'guide_id');
    }

     public function activity(): BelongsTo
    {
        return $this->belongsTo(Activity::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }
}
