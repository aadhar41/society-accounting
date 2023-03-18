<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Society;
use App\Models\Block;
use App\Models\Flat;
use App\Models\Plot;
use App\Models\User;
use App\Models\Maintenance;
use Illuminate\Support\Str;

class MaintenanceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $maintenanceTypes = getMaintenanceTypes();
        $paymentStatus = getPaymentStatus();
        $key1 = array_rand($maintenanceTypes, 1);
        $key2 = array_rand($paymentStatus, 1);
        return [
            'unique_code' => Str::random(10),
            'user_id' => User::pluck('id')->random(),
            'society_id' => Society::pluck('id')->random(),
            'block_id' => Block::pluck('id')->random(),
            'plot_id' => Plot::pluck('id')->random(),
            'flat_id' => Flat::pluck('id')->random(),
            'type' => "$key1",
            'date' => $this->faker->dateTimeThisMonth($max = 'now', $timezone = null),
            'year' => $this->faker->year($max = 'now'),
            'month' => $this->faker->year($max = 'now'),
            'amount' => $this->faker->randomNumber(2),
            'description' => $this->faker->realText($maxNbChars = 100, $indexSize = 2),
            'attachments' => $this->faker->phoneNumber(),
            'payment_status' => "$key2",
            'status' => "1",
        ];
    }
}
