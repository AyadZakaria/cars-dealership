<?php

namespace Database\Factories;

use App\Models\Rent;
use App\Models\Reservation;
use App\Models\Customer;
use App\Models\Car;
use Illuminate\Database\Eloquent\Factories\Factory;

class RentFactory extends Factory
{
    protected $model = Rent::class;

    public function definition()
    {
        $startDate = $this->faker->dateTimeBetween('-1 month', '+1 month');
        $endDate = (clone $startDate)->modify('+' . rand(1, 14) . ' days');
        $confirmationDate = (clone $startDate)->modify('-' . rand(0, 3) . ' days');

        return [
            'uuid' => $this->faker->uuid(),
            'reservation_uuid' => \App\Models\Reservation::inRandomOrder()->first()?->uuid ?? \Illuminate\Support\Str::uuid(),
            'customer_uuid' => \App\Models\Customer::inRandomOrder()->first()?->uuid ?? \Illuminate\Support\Str::uuid(),
            'car_uuid' => \App\Models\Car::inRandomOrder()->first()?->uuid ?? \Illuminate\Support\Str::uuid(),
            'start_date' => $startDate,
            'end_date' => $endDate,
            'reservation_confirmation_date' => $confirmationDate,
            'total_rent_price' => $this->faker->randomFloat(2, 100, 10000),
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null,
        ];
    }
}
