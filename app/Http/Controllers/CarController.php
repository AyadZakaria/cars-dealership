<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;
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
        $customer = Auth::user()->Customer;
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:30',
            'type' => 'required|in:rent,purchase',
            'rent_start_date' => 'nullable|date',
            'rent_end_date' => 'nullable|date|after_or_equal:rent_start_date',
            'purchase_date' => 'nullable|date',
        ]);

        // Map 'purchase' to 'sale' for reservation_type
        $reservationType = $validated['type'] === 'purchase' ? 'sale' : $validated['type'];

        // Create reservation
        $reservation = Reservation::create([
            'uuid' => (string) Str::uuid(),
            'car_uuid' => $car->uuid ?? '',
            'customer_uuid' => $customer->uuid,
            'status' => 'pending',
            'reservation_type' => $reservationType,
        ]);

        // Set reservation dates based on type
        if ($reservationType === 'for_rent') {
            $rent_days_count = (strtotime($validated['rent_end_date']) - strtotime($validated['rent_start_date'])) / (60 * 60 * 24);
            $totalPrice = $rent_days_count * $car->price;
            $reservation->total_price = $totalPrice;
            $reservation->is_confirmed = false; // Default to false for rent
            $reservation->rent_start_date = $validated['rent_start_date'];
            $reservation->rent_end_date = $validated['rent_end_date'];
        }

        // Change car status (mark as not in service)
        $car->in_service = false;
        $car->save();

        return redirect()->route('car.details', ['uuid' => $car->uuid])
            ->with('success', 'Reservation submitted! Please wait for a phone call to confirm or deny your reservation.');
    }
}
