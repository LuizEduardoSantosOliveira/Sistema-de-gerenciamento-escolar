<?php

// app/Models/User.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'user_type',
        'profile_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function student()
    {
        if ($this->user_type === 'student') {
            return $this->belongsTo(Student::class, 'profile_id');
        }
        return null;
    }

    public function teacher()
    {
        if ($this->user_type === 'teacher') {
            return $this->belongsTo(Teacher::class, 'profile_id');
        }
        return null;
    }

    public function profile()
    {
        return $this->user_type === 'student' 
            ? $this->student() 
            : $this->teacher();
    }
}
