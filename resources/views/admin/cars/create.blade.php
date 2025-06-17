@extends('layouts.admin')

@section('content')
    <h1 class="text-2xl font-bold mb-6">Add Car</h1>
    <form action="{{ route('admin.cars.store') }}" method="POST" class="bg-white p-6 rounded shadow-md max-w-lg">
        @csrf
        <div class="mb-4">
            <label class="block mb-1 font-semibold">Brand <span class="text-red-500">*</span></label>
            <input type="text" name="brand" class="w-full border px-3 py-2 rounded" required>
        </div>
        <div class="mb-4">
            <label class="block mb-1 font-semibold">Model <span class="text-red-500">*</span></label>
            <input type="text" name="model" class="w-full border px-3 py-2 rounded" required>
        </div>
        <div class="mb-4">
            <label class="block mb-1 font-semibold">Year <span class="text-red-500">*</span></label>
            <input type="number" name="year" class="w-full border px-3 py-2 rounded" required min="1900" max="{{ date('Y') + 1 }}">
        </div>
        <div class="mb-4">
            <label class="block mb-1 font-semibold">Price <span class="text-red-500">*</span></label>
            <input type="number" name="price" class="w-full border px-3 py-2 rounded" required step="0.01" min="0">
        </div>
        <div class="mb-4">
            <label class="block mb-1 font-semibold">Availability <span class="text-red-500">*</span></label>
            <select name="availability" class="w-full border px-3 py-2 rounded" required>
                <option value="">Select...</option>
                <option value="for_rent">For Rent</option>
                <option value="for_sale">For Sale</option>
            </select>
        </div>
        <div class="mb-4">
            <label class="block mb-1 font-semibold">Fuel Type <span class="text-red-500">*</span></label>
            <select name="fuel_type" class="w-full border px-3 py-2 rounded" required>
                <option value="">Select...</option>
                <option value="petrol">Petrol</option>
                <option value="diesel">Diesel</option>
                <option value="electric">Electric</option>
                <option value="hybrid">Hybrid</option>
            </select>
        </div>
        <div class="mb-4">
            <label class="block mb-1 font-semibold">Image URL</label>
            <input type="url" name="image_url" class="w-full border px-3 py-2 rounded">
        </div>
        <div class="mb-4">
            <label class="block mb-1 font-semibold">Mileage</label>
            <input type="number" name="mileage" class="w-full border px-3 py-2 rounded" min="0" value="0">
        </div>
        <div class="mb-4 flex items-center">
            <input type="checkbox" name="in_service" id="in_service" class="mr-2" checked>
            <label for="in_service" class="font-semibold">In Service</label>
        </div>
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Save</button>
        <a href="{{ route('admin.cars.index') }}" class="ml-4 text-gray-600 hover:underline">Cancel</a>
    </form>
@endsection
