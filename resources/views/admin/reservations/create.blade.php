@extends('layouts.admin')

@section('content')
    <h1 class="text-2xl font-bold mb-6">Add Reservation</h1>
    <form action="{{ route('admin.reservations.store') }}" method="POST" class="bg-white p-6 rounded shadow-md max-w-lg">
        @csrf
        <div class="mb-4">
            <label class="block mb-1 font-semibold">Customer <span class="text-red-500">*</span></label>
            <select name="customer_uuid" class="w-full border px-3 py-2 rounded" required>
                <option value="">Select Customer</option>
                @foreach($customers as $customer)
                    <option value="{{ $customer->uuid }}"
                        @if(old('customer_uuid', isset($selectedCustomer) ? $selectedCustomer->uuid : null) == $customer->uuid) selected @endif>
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
                    <option value="{{ $car->uuid }}">{{ $car->brand ?? $car->make }} {{ $car->model }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-4">
            <label class="block mb-1 font-semibold">Start Date</label>
            <input type="datetime-local" name="rent_start_date" class="w-full border px-3 py-2 rounded">
        </div>
        <div class="mb-4">
            <label class="block mb-1 font-semibold">End Date</label>
            <input type="datetime-local" name="rent_end_date" class="w-full border px-3 py-2 rounded">
        </div>
        <div class="mb-4">
            <label class="block mb-1 font-semibold">Status</label>
            <select name="status" class="w-full border px-3 py-2 rounded">
                <option value="pending" selected>Pending</option>
                <option value="confirmed">Confirmed</option>
                <option value="cancelled">Cancelled</option>
                <option value="completed">Completed</option>
                <option value="rejected">Rejected</option>
            </select>
        </div>
        <div class="mb-4">
            <label class="block mb-1 font-semibold">Reservation Type</label>
            <select name="reservation_type" class="w-full border px-3 py-2 rounded">
                <option value="rent" selected>Rent</option>
                <option value="sale">Sale</option>
            </select>
        </div>
        <div class="mb-4">
            <label class="block mb-1 font-semibold">Total Price</label>
            <input type="number" name="total_price" class="w-full border px-3 py-2 rounded" step="0.01" min="0" value="0.00">
        </div>
        <div class="mb-4 flex items-center">
            <input type="checkbox" name="is_confirmed" id="is_confirmed" class="mr-2">
            <label for="is_confirmed" class="font-semibold">Is Confirmed</label>
        </div>
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Save</button>
        <a href="{{ route('admin.reservations.index') }}" class="ml-4 text-gray-600 hover:underline">Cancel</a>
    </form>
@endsection
