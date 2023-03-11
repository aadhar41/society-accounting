<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Society;
use App\Models\User;
use Illuminate\Support\Str;

class SocietyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Society::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'unique_code' => Str::random(10),
            'name' => $this->faker->company(),
            'slug' => Str::slug($this->faker->sentence(), '-'),
            'address' => $this->faker->sentence(),
            'description' => $this->faker->realText($maxNbChars = 200, $indexSize = 2),
            'contact' => $this->faker->phoneNumber(),
            'country' => rand(100000, 900000),
            'state' => rand(100000, 900000),
            'city' => rand(100000, 900000),
            'postcode' => rand(302000, 302020),
            'user_id' => 1,
            'status' => "1",
        ];
    }
}
