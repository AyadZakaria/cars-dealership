@extends('layouts.admin')

@section('content')
    <h1 class="text-2xl font-bold mb-6">Edit Reservation</h1>
    <form action="{{ route('admin.reservations.update', $reservation) }}" method="POST" class="bg-white p-6 rounded shadow-md max-w-lg">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label class="block mb-1 font-semibold">Customer <span class="text-red-500">*</span></label>
            <select name="customer_uuid" class="w-full border px-3 py-2 rounded" required>
                <option value="">Select Customer</option>
                @foreach($customers as $customer)
                    <option value="{{ $customer->uuid }}" {{ old('customer_uuid', $reservation->customer_uuid) == $customer->uuid ? 'selected' : '' }}>
                        {{ $customer->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-4">
            <label class="block mb-1 font-semibold">Car <span class="text-red-500">*</span></label>
            <select name="car_uuid" class="w-full border px-3 py-2 rounded" required>
                <option value="">Select Car</option>
                @foreach($cars as $car)
                    <option value="{{ $car->uuid }}" {{ old('car_uuid', $reservation->car_uuid) == $car->uuid ? 'selected' : '' }}>
                        {{ $car->brand ?? $car->make }} {{ $car->model }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-4">
            <label class="block mb-1 font-semibold">Start Date</label>
            <input type="datetime-local" name="rent_start_date" class="w-full border px-3 py-2 rounded"
                value="{{ old('rent_start_date', $reservation->rent_start_date ? \Carbon\Carbon::parse($reservation->rent_start_date)->format('Y-m-d\TH:i') : '') }}">
        </div>
        <div class="mb-4">
            <label class="block mb-1 font-semibold">End Date</label>
            <input type="datetime-local" name="rent_end_date" class="w-full border px-3 py-2 rounded"
                value="{{ old('rent_end_date', $reservation->rent_end_date ? \Carbon\Carbon::parse($reservation->rent_end_date)->format('Y-m-d\TH:i') : '') }}">
        </div>
        <div class="mb-4">
            <label class="block mb-1 font-semibold">Status</label>
            <select name="status" class="w-full border px-3 py-2 rounded">
                <option value="pending" {{ old('status', $reservation->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="confirmed" {{ old('status', $reservation->status) == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                <option value="cancelled" {{ old('status', $reservation->status) == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                <option value="completed" {{ old('status', $reservation->status) == 'completed' ? 'selected' : '' }}>Completed</option>
                <option value="rejected" {{ old('status', $reservation->status) == 'rejected' ? 'selected' : '' }}>Rejected</option>
            </select>
        </div>
        <div class="mb-4">
            <label class="block mb-1 font-semibold">Reservation Type</label>
            <select name="reservation_type" class="w-full border px-3 py-2 rounded">
                <option value="rent" {{ old('reservation_type', $reservation->reservation_type) == 'rent' ? 'selected' : '' }}>Rent</option>
                <option value="sale" {{ old('reservation_type', $reservation->reservation_type) == 'sale' ? 'selected' : '' }}>Sale</option>
            </select>
        </div>
        <div class="mb-4">
            <label class="block mb-1 font-semibold">Total Price</label>
            <input type="number" name="total_price" class="w-full border px-3 py-2 rounded" step="0.01" min="0"
                value="{{ old('total_price', $reservation->total_price) }}">
        </div>
        <div class="mb-4 flex items-center">
            <input type="checkbox" name="is_confirmed" id="is_confirmed" class="mr-2"
                {{ old('is_confirmed', $reservation->is_confirmed) ? 'checked' : '' }}>
            <label for="is_confirmed" class="font-semibold">Is Confirmed</label>
        </div>
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Update</button>
        <a href="{{ route('admin.reservations.index') }}" class="ml-4 text-gray-600 hover:underline">Cancel</a>
    </form>
@endsection
