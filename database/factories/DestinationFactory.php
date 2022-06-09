<?php

namespace Database\Factories;

use App\Models\Location;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

class DestinationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $from = Location::all()->random();
        $to = Location::all()->except($from->id)->random();

        return [
            'travel_from_id' => $from->id,
            'travel_to_id' => $to->id,
            'amount' => $this->faker->numberBetween(100, 500),
            'status' => Arr::random(['0','1']),
            'created_at' => now(),
        ];
    }
}
