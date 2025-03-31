<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Ambient;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Reserve>
 */
class ReserveFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
          'reservationer' => fake()->name(),
          'user_id' => User::factory(),
          'reservation_datetime' => fake()-> dateTimeBetween('now' ,'+60 days'),
          'ambient_id' => Ambient::factory(),
        ];
    }
}
