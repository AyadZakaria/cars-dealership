<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Models\Customer;
use App\Models\Car;
use App\Models\Rent;
use App\Models\Purchase;
use Illuminate\Http\Request;
use Devrabiul\ToastMagic\Facades\ToastMagic;
use Illuminate\Support\Str;

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

    public function confirm($id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->status = 'confirmed';
        $reservation->is_confirmed = true;
        $reservation->save();

        $car = Car::where('uuid', $reservation->car_uuid)->first();
        if ($reservation->reservation_type === 'rent') {
            Rent::create([
                'uuid' => Str::uuid(),
                'car_uuid' => $reservation->car_uuid,
                'customer_uuid' => $reservation->customer_uuid,
                'rent_start_date' => $reservation->rent_start_date,
                'rent_end_date' => $reservation->rent_end_date,
                'total_price' => $reservation->total_rent_price,
            ]);
        } else {
            Purchase::create([
                'uuid' => Str::uuid(),
                'car_uuid' => $reservation->car_uuid,
                'customer_uuid' => $reservation->customer_uuid,
                'purchase_date' => now(),
                'total_price' => $reservation->total_sale_price,
            ]);
        }
        if ($car) {
            $car->in_service = false;
            $car->save();
        }
        ToastMagic::success('Reservation confirmed and processed.');
        return redirect()->route('admin.reservations.index');
    }

    public function deny($id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->status = 'rejected';
        $reservation->is_confirmed = false;
        $reservation->save();
        ToastMagic::success('Reservation denied.');
        return redirect()->route('admin.reservations.index');
    }
}
