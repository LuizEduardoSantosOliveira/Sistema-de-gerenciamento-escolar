<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reserve extends Model
{
    /** @use HasFactory<\Database\Factories\ReserveFactory> */
    use HasFactory;
    protected $fillable = [


        'reservationer',
        'user_id',
        'reservation_datetime',
        'ambient_id',
    ];
}
