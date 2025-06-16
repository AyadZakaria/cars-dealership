<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;
use App\Models\Reservation;
use Illuminate\Support\Str;

class CarController extends Controller
{
    public function show($uuid)
    {
        $car = Car::where('uuid', $uuid)->firstOrFail();
        return view('car-details', compact('car'));
    }

    public function reserve(Request $request, $uuid)
    {
        $car = Car::where('uuid', $uuid)->firstOrFail();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:30',
            'type' => 'required|in:rent,purchase',
        ]);

        // Find or create customer
        if (auth()->check()) {
            $user = auth()->user();
            $customer = $user->customer ?? \App\Models\Customer::where('user_id', $user->id)->first();
            if (!$customer) {
                $customer = \App\Models\Customer::create([
                    'uuid' => (string) Str::uuid(),
                    'user_id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'phone' => $validated['phone'],
                ]);
            }
        } else {
            $customer = \App\Models\Customer::where('phone', $validated['phone'])->first();
            if (!$customer) {
                $customer = \App\Models\Customer::create([
                    'uuid' => (string) Str::uuid(),
                    'user_id' => null,
                    'name' => $validated['name'],
                    'email' => null,
                    'phone' => $validated['phone'],
                ]);
            }
        }

        // Map 'purchase' to 'sale' for reservation_type
        $reservationType = $validated['type'] === 'purchase' ? 'sale' : $validated['type'];

        // Create reservation
        $reservation = Reservation::create([
            'uuid' => (string) Str::uuid(),
            'car_uuid' => $car->uuid,
            'customer_uuid' => $customer->uuid,
            'status' => 'pending',
            'reservation_type' => $reservationType,
        ]);

        // Change car status (mark as not in service)
        $car->in_service = false;
        $car->save();

        return redirect()->route('car.details', ['uuid' => $car->uuid])
            ->with('success', 'Reservation submitted! Please wait for a phone call to confirm or deny your reservation.');
    }
}
