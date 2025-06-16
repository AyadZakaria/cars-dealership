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

        return [
            'uuid' => $this->faker->uuid(),
            'brand' => $this->faker->randomElement($brands),
            'model' => $this->faker->randomElement($models),
            'image_url' => $this->faker->imageUrl(640, 480, 'cars', true),
            'year' => $this->faker->numberBetween(2005, 2024),
            'price' => $this->faker->randomFloat(2, 5000, 100000),
            'mileage' => $this->faker->numberBetween(0, 200000),
            'fuel_type' => $this->faker->randomElement($fuelTypes),
            'availability' => $this->faker->randomElement($availability),
            'in_service' => $this->faker->boolean(90),
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null,
        ];
    }
}
