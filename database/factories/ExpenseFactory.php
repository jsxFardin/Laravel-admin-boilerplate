<?php

namespace Database\Factories;

use App\Models\Destination;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;
use DateTime;

class ExpenseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $types = [1, 2, 3, 4];

        $destination =  Destination::all()->random();
        $user =  User::all()->except([1,2])->random();

        return [
            'expense_type_id' => Arr::random($types),
            'destination_id' => $destination->id,
            'description' => $this->faker->paragraph,
            'duration_form' => $this->faker->dateTimeBetween('-1 week', '+1 week'),
            'duration_to' => $this->faker->dateTimeBetween('-1 week', '+1 week'),
            'amount' => $destination->amount,
            'status' => Arr::random(['0','1']),
            'created_by' => $user->id,
            'created_at' => now(),
        ];
    }
}
