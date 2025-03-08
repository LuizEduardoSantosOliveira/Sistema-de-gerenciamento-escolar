<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Discipline extends Model
{
    // app/Models/Discipline.php

public function teachers()
{
    return $this->belongsToMany(Teacher::class, 'discipline_teachers', 'discipline_id', 'teacher_id');
}
}
