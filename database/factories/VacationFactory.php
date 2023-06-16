<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vacation>
 */
class VacationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $startDate = fake()->dateTimeThisYear("-30 days");
        $endDate = (clone $startDate)->modify("+14 day");
        $startDate = $startDate->format('Y-m-d');
        $endDate = $endDate->format('Y-m-d');

        return [
            'start_date' => $startDate,
            'end_date' => $endDate,
            'is_confirmed' => fake()->numberBetween(0, 1),
            'user_id' => fake()->numberBetween(1, \App\Models\User::all()->count()),
            //
        ];
    }
}
