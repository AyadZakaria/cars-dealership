<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Models\Customer;
use App\Models\Car;
use Illuminate\Http\Request;
use Devrabiul\ToastMagic\Facades\ToastMagic;

class ReservationController extends Controller
{
    public function index()
    {
        $reservations = Reservation::orderBy('created_at', 'desc')
            ->with(['customer', 'car'])->paginate(10);
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
            'customer_uuid' => 'required|exists:customers,uuid',
            'car_uuid' => 'required|exists:cars,uuid',
            'rent_start_date' => 'required|date',
            'rent_end_date' => 'required|date|after_or_equal:rent_start_date',
        ]);
        Reservation::create($validated);
        ToastMagic::success('Reservation created successfully.');
        return redirect()->route('admin.reservations.index');
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
            'customer_uuid' => 'required|exists:customers,uuid',
            'car_uuid' => 'required|exists:cars,uuid',
            'rent_start_date' => 'required|date',
            'rent_end_date' => 'required|date|after_or_equal:rent_start_date',
        ]);
        $reservation->update($validated);
        ToastMagic::success('Reservation updated successfully.');
        return redirect()->route('admin.reservations.index');
    }

    public function destroy(Reservation $reservation)
    {
        $reservation->delete();
        ToastMagic::success('Reservation deleted successfully.');
        return redirect()->route('admin.reservations.index');
    }
}
