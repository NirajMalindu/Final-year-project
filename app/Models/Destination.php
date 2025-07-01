<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Destination extends Model
{
    

    protected $fillable = ['name', 'location', 'description', 'image'];

    public function attractions(): HasMany
    {
        return $this->hasMany(Attraction::class);
    }


}
