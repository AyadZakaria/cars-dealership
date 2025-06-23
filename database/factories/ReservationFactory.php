<?php

namespace Database\Factories;

use App\Models\Reservation;
use App\Models\Car;
use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReservationFactory extends Factory
{
    protected $model = Reservation::class;

    public function definition()
    {
        $status = ['pending', 'confirmed', 'cancelled', 'completed', 'rejected'];
        $reservationTypes = ['rent', 'sale'];
        $startDate = $this->faker->dateTimeBetween('-1 month', '+1 month');
        $endDate = (clone $startDate)->modify('+' . rand(1, 14) . ' days');

        return [
            'uuid' => $this->faker->uuid(),
            'car_uuid' => Car::inRandomOrder()->first()?->uuid ?? \Illuminate\Support\Str::uuid(),
            'customer_uuid' => Customer::inRandomOrder()->first()?->uuid ?? \Illuminate\Support\Str::uuid(),
            'rent_start_date' => $startDate,
            'rent_end_date' => $endDate,
            'status' => $this->faker->randomElement($status),
            'reservation_type' => $this->faker->randomElement($reservationTypes),
            'total_rent_price' => $this->faker->randomFloat(2, 100, 10000),
            'is_confirmed' => $this->faker->boolean(80),
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null,
        ];
    }
}
