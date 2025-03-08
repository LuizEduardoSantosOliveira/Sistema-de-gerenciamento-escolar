<?php

namespace Database\Factories;


use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    protected $model = Student::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'date_of_birth' => $this->faker->date('Y-m-d', '-18 years'),
            'photo' => 'default.jpg',
            'cpf' => $this->faker->numerify('###########'),
            'cep' => $this->faker->numerify('########'),
            'phone_number' => $this->faker->numerify('###########'),
        ];
    }
}
