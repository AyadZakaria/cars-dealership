<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Models\Customer;
use App\Models\Car;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function index()
    {
        $reservations = Reservation::with(['customer', 'car'])->paginate(10);
        return view('admin.reservations.index', compact('reservations'));
    }

    public function create()
    {
        $customers = Customer::all();
        $cars = Car::all();
        return view('admin.reservations.create', compact('customers', 'cars'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'car_id' => 'required|exists:cars,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);
        Reservation::create($validated);
        return redirect()->route('admin.reservations.index')->with('success', 'Reservation created successfully.');
    }

    public function show(Reservation $reservation)
    {
        $reservation->load(['customer', 'car']);
        return view('admin.reservations.show', compact('reservation'));
    }

    public function edit(Reservation $reservation)
    {
        $customers = Customer::all();
        $cars = Car::all();
        return view('admin.reservations.edit', compact('reservation', 'customers', 'cars'));
    }

    public function update(Request $request, Reservation $reservation)
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'car_id' => 'required|exists:cars,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);
        $reservation->update($validated);
        return redirect()->route('admin.reservations.index')->with('success', 'Reservation updated successfully.');
    }

    public function destroy(Reservation $reservation)
    {
        $reservation->delete();
        return redirect()->route('admin.reservations.index')->with('success', 'Reservation deleted successfully.');
    }
}
