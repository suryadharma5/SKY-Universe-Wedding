<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venue extends Model
{
    use HasFactory;

    public function regency(){
        return $this->belongsTo(Location::class, 'location_id');
    }

    public function bookings(){
        return $this->hasMany(Booking::class);
    }
}
