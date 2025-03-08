<?php

namespace Database\Factories;

use App\Models\Student;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    protected $model = UserFactory::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => Hash::make('password'), // senha padrão para testes
            'remember_token' => Str::random(10),
            'user_type' => $this->faker->randomElement(['student', 'teacher', 'admin']),
            'profile_id' => null, // Será preenchido depois
        ];
    }

    // Estado para criar usuário do tipo estudante
    public function student(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'user_type' => 'student',
            ];
        });
    }

    // Estado para criar usuário do tipo professor
    public function teacher(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'user_type' => 'teacher',
            ];
        });
    }

    // Configurar o relacionamento com o perfil
    public function configure(): Factory
    {
        return $this->afterCreating(function (User $user) {
            if ($user->user_type === 'student') {
                $student = Student::factory()->create([
                    'name' => $user->name,
                    'email' => $user->email,
                ]);
                $user->profile_id = $student->id;
                $user->save();
            } elseif ($user->user_type === 'teacher') {
                $teacher = Teacher::factory()->create([
                    'name' => $user->name,
                    'email' => $user->email,
                ]);
                $user->profile_id = $teacher->id;
                $user->save();
            }
        });
    }
}
