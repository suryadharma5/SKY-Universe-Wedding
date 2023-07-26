<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{

    protected $guarded = ['id'];

    public function venue(){
        return $this->belongsTo(Venue::class, 'venue_id');
    }

    use HasFactory;
}
