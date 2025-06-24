<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;
use App\Models\Reservation;
use Devrabiul\ToastMagic\Facades\ToastMagic;
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
        $user = Auth::user();
        $customer = $user?->customer;
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:30',
            'type' => 'required|in:rent,sale',
            'rent_start_date' => 'nullable|date',
            'rent_end_date' => 'nullable|date|after_or_equal:rent_start_date',
            'purchase_date' => 'nullable|date',
        ]);

        // If authenticated and no customer profile, create and link it
        if ($user && !$customer) {
            $customer_uuid = $user->customer_uuid ?? (string) Str::uuid();
            $customer = \App\Models\Customer::create([
                'uuid' => $customer_uuid,
                'user_id' => $user->id,
                'name' => $user->name ?? $validated['name'],
                'email' => $user->email,
                'phone' => $validated['phone'],
            ]);

            $user->customer_uuid = $customer_uuid;
            $user->save();
        }


        // If not authenticated, create a new customer (guest)
        if (!$user && !$customer) {
            $customer = \App\Models\Customer::create([
                'uuid' => (string) Str::uuid(),
                'name' => $validated['name'],
                'phone' => $validated['phone'],
            ]);
        }

        $reservationData = [
            'uuid' => (string) Str::uuid(),
            'car_uuid' => $car->uuid,
            'customer_uuid' => $customer?->uuid,
            'status' => 'pending',
            'reservation_type' => $validated['type'],
            'is_confirmed' => false,
        ];

        if ($validated['type'] === 'rent') {
            $reservationData['rent_start_date'] = $validated['rent_start_date'];
            $reservationData['rent_end_date'] = $validated['rent_end_date'];
            $rent_days_count = (strtotime($validated['rent_end_date']) - strtotime($validated['rent_start_date'])) / (60 * 60 * 24);
            $reservationData['total_rent_price'] = $rent_days_count * $car->price;
        } elseif ($validated['type'] === 'sale') {
            $reservationData['total_rent_price'] = $car->price;
        }

        $reservation = Reservation::create($reservationData);

        $car->in_service = false;
        $car->save();

        ToastMagic::success('Reservation submitted! Please wait for a phone call to confirm or deny your reservation.');


        return redirect()->route('home')
            ->with(['success', 'Reservation submitted! Please wait for a phone call to confirm or deny your reservation.', 'car_uuid' => $car->uuid]);
    }
}
