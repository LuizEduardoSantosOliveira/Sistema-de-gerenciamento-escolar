<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    /** @use HasFactory<\Database\Factories\TeachersFactory> */
    use HasFactory;

    // app/Models/Teacher.php

public function disciplines()
{
    return $this->belongsToMany(Discipline::class, 'discipline_teachers', 'teacher_id', 'discipline_id');
}
}

// app/Models/Teacher.php


