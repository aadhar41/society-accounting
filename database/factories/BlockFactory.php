<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Society;
use App\Models\User;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use Illuminate\Support\Str;

class BlockFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'unique_code' => Str::random(10),
            'user_id' => User::pluck('id')->random(),
            'society_id' => Society::active()->pluck('id')->random(),
            'name' => $this->faker->company(),
            'slug' => $this->faker->sentence(),
            'total_flats' => rand(50, 500),
            'description' => $this->faker->realText($maxNbChars = 200, $indexSize = 2),
            'status' => "1",
        ];
    }
}
