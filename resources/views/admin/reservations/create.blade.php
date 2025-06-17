@extends('layouts.admin')

@section('content')
    <h1 class="text-2xl font-bold mb-6">Add Reservation</h1>
    <form action="{{ route('admin.reservations.store') }}" method="POST" class="bg-white p-6 rounded shadow-md max-w-lg">
        @csrf
        <div class="mb-4">
            <label class="block mb-1 font-semibold">Customer</label>
            <select name="customer_id" class="w-full border px-3 py-2 rounded" required>
                <option value="">Select Customer</option>
                @foreach($customers as $customer)
                    <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-4">
            <label class="block mb-1 font-semibold">Car</label>
            <select name="car_id" class="w-full border px-3 py-2 rounded" required>
                <option value="">Select Car</option>
                @foreach($cars as $car)
                    <option value="{{ $car->id }}">{{ $car->make }} {{ $car->model }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-4">
            <label class="block mb-1 font-semibold">Start Date</label>
            <input type="date" name="start_date" class="w-full border px-3 py-2 rounded" required>
        </div>
        <div class="mb-4">
            <label class="block mb-1 font-semibold">End Date</label>
            <input type="date" name="end_date" class="w-full border px-3 py-2 rounded" required>
        </div>
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Save</button>
        <a href="{{ route('admin.reservations.index') }}" class="ml-4 text-gray-600 hover:underline">Cancel</a>
    </form>
@endsection
