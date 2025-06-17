<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Car;
use App\Models\Customer;
use App\Models\Reservation;
use App\Models\Purchase;
use App\Models\Rent;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create a test user
        User::updateOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'Test Admin',
                'email_verified_at' => now(),
                'password' => bcrypt('password'),
                'remember_token' => \Illuminate\Support\Str::random(10),
                'is_admin' => true,
            ]
        );

        // Create or update an admin user
        User::updateOrCreate(
            ['email' => 'ayad.admin@laravel.com'],
            [
                'name' => 'Ayad Admin',
                'email_verified_at' => now(),
                'password' => bcrypt('ayad.admin@laravel.com'),
                'remember_token' => \Illuminate\Support\Str::random(10),
                'is_admin' => true,
            ]
        );

        // Create 15 users, cars, customers, reservations, purchases, and rents
        User::factory(15)->create();
        Car::factory(15)->create();
        Customer::factory(15)->create();
        Reservation::factory(15)->create();
        Purchase::factory(15)->create();
        Rent::factory(15)->create();
    }
}
