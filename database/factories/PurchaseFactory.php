<?php

namespace Database\Factories;

use App\Models\Purchase;
use App\Models\Customer;
use App\Models\Car;
use Illuminate\Database\Eloquent\Factories\Factory;

class PurchaseFactory extends Factory
{
    protected $model = Purchase::class;

    public function definition()
    {
        $purchaseDate = $this->faker->dateTimeBetween('-1 year', 'now');

        return [
            'uuid' => $this->faker->uuid(),
            'customer_uuid' => Customer::inRandomOrder()->first()?->uuid ?? \Illuminate\Support\Str::uuid(),
            'car_uuid' => Car::inRandomOrder()->first()?->uuid ?? \Illuminate\Support\Str::uuid(),
            'purchase_date' => $purchaseDate,
            'total_price' => $this->faker->randomFloat(2, 5000, 100000),
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null,
        ];
    }
}
