<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Itinerary extends Model
{
   

    protected $fillable = [
        'user_id', 'activity_id', 'title', 'description', 'start_date', 'end_date', 'budget'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function activity(): BelongsTo
    {
        return $this->belongsTo(Activity::class);
    }


}
