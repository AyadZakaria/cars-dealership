<?php

namespace Database\Factories;

use App\Models\Car;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CarFactory extends Factory
{
    protected $model = Car::class;

    public function definition()
    {
        $brands = ['Toyota', 'Honda', 'Ford', 'BMW', 'Mercedes', 'Tesla', 'Audi', 'Volkswagen'];
        $models = ['Corolla', 'Civic', 'Focus', '3 Series', 'C-Class', 'Model 3', 'A4', 'Golf'];
        $fuelTypes = ['petrol', 'diesel', 'electric', 'hybrid'];
        $availability = ['for_rent', 'for_sale'];

        $availability_type = $this->faker->randomElement($availability);
        $price = null;
        $purchase_price = null;

        if ($availability_type === 'for_rent') {
            $price = $this->faker->randomFloat(2, 50, 500); // Daily rental price
        } elseif ($availability_type === 'for_sale') {
            $purchase_price = $this->faker->randomFloat(2, 3000, 80000);
        }

        return [
            'uuid' => $this->faker->uuid(),
            'brand' => $this->faker->randomElement($brands),
            'model' => $this->faker->randomElement($models),
            'image_url' => null, // Assuming image_url is nullable
            'year' => $this->faker->numberBetween(2005, 2024),
            'price' => $price,
            'purchase_price' => $purchase_price,
            'mileage' => $this->faker->numberBetween(0, 200000),
            'fuel_type' => $this->faker->randomElement($fuelTypes),
            'availability' => $availability_type,
            'in_service' => $this->faker->boolean(90),
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null,
        ];
    }
}
