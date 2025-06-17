@extends('layouts.admin')

@section('content')
    <h1 class="text-2xl font-bold mb-6">Edit Reservation</h1>
    <form action="{{ route('admin.reservations.update', $reservation) }}" method="POST" class="bg-white p-6 rounded shadow-md max-w-lg">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label class="block mb-1 font-semibold">Customer</label>
            <select name="customer_id" class="w-full border px-3 py-2 rounded" required>
                <option value="">Select Customer</option>
                @foreach($customers as $customer)
                    <option value="{{ $customer->id }}" {{ old('customer_id', $reservation->customer_id) == $customer->id ? 'selected' : '' }}>
                        {{ $customer->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-4">
            <label class="block mb-1 font-semibold">Car</label>
            <select name="car_id" class="w-full border px-3 py-2 rounded" required>
                <option value="">Select Car</option>
                @foreach($cars as $car)
                    <option value="{{ $car->id }}" {{ old('car_id', $reservation->car_id) == $car->id ? 'selected' : '' }}>
                        {{ $car->make }} {{ $car->model }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-4">
            <label class="block mb-1 font-semibold">Start Date</label>
            <input type="date" name="start_date" class="w-full border px-3 py-2 rounded" value="{{ old('start_date', $reservation->start_date) }}" required>
        </div>
        <div class="mb-4">
            <label class="block mb-1 font-semibold">End Date</label>
            <input type="date" name="end_date" class="w-full border px-3 py-2 rounded" value="{{ old('end_date', $reservation->end_date) }}" required>
        </div>
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Update</button>
        <a href="{{ route('admin.reservations.index') }}" class="ml-4 text-gray-600 hover:underline">Cancel</a>
    </form>
@endsection
