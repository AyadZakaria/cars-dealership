@extends('layouts.admin')

@section('content')
    <h1 class="text-2xl font-bold mb-6">Edit Car</h1>
    <form action="{{ route('admin.cars.update', $car) }}" method="POST" class="bg-white p-6 rounded shadow-md max-w-lg">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label class="block mb-1 font-semibold">Brand <span class="text-red-500">*</span></label>
            <input type="text" name="brand" class="w-full border px-3 py-2 rounded" value="{{ old('brand', $car->brand) }}" required>
        </div>
        <div class="mb-4">
            <label class="block mb-1 font-semibold">Model <span class="text-red-500">*</span></label>
            <input type="text" name="model" class="w-full border px-3 py-2 rounded" value="{{ old('model', $car->model) }}" required>
        </div>
        <div class="mb-4">
            <label class="block mb-1 font-semibold">Year <span class="text-red-500">*</span></label>
            <input type="number" name="year" class="w-full border px-3 py-2 rounded" value="{{ old('year', $car->year) }}" required min="1900" max="{{ date('Y') + 1 }}">
        </div>
        <div class="mb-4">
            <label class="block mb-1 font-semibold">Price <span class="text-red-500">*</span></label>
            <input type="number" name="price" class="w-full border px-3 py-2 rounded" value="{{ old('price', $car->price) }}" required step="0.01" min="0">
        </div>
        <div class="mb-4">
            <label class="block mb-1 font-semibold">Availability <span class="text-red-500">*</span></label>
            <select name="availability" class="w-full border px-3 py-2 rounded" required>
                <option value="">Select...</option>
                <option value="for_rent" {{ old('availability', $car->availability) == 'for_rent' ? 'selected' : '' }}>For Rent</option>
                <option value="for_sale" {{ old('availability', $car->availability) == 'for_sale' ? 'selected' : '' }}>For Sale</option>
            </select>
        </div>
        <div class="mb-4">
            <label class="block mb-1 font-semibold">Fuel Type <span class="text-red-500">*</span></label>
            <select name="fuel_type" class="w-full border px-3 py-2 rounded" required>
                <option value="">Select...</option>
                <option value="petrol" {{ old('fuel_type', $car->fuel_type) == 'petrol' ? 'selected' : '' }}>Petrol</option>
                <option value="diesel" {{ old('fuel_type', $car->fuel_type) == 'diesel' ? 'selected' : '' }}>Diesel</option>
                <option value="electric" {{ old('fuel_type', $car->fuel_type) == 'electric' ? 'selected' : '' }}>Electric</option>
                <option value="hybrid" {{ old('fuel_type', $car->fuel_type) == 'hybrid' ? 'selected' : '' }}>Hybrid</option>
            </select>
        </div>
        <div class="mb-4">
            <label class="block mb-1 font-semibold">Image URL</label>
            <input type="url" name="image_url" class="w-full border px-3 py-2 rounded" value="{{ old('image_url', $car->image_url) }}">
        </div>
        <div class="mb-4">
            <label class="block mb-1 font-semibold">Mileage</label>
            <input type="number" name="mileage" class="w-full border px-3 py-2 rounded" min="0" value="{{ old('mileage', $car->mileage) }}">
        </div>
        <div class="mb-4 flex items-center">
            <input type="checkbox" name="in_service" id="in_service" class="mr-2" {{ old('in_service', $car->in_service) ? 'checked' : '' }}>
            <label for="in_service" class="font-semibold">In Service</label>
        </div>
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Update</button>
        <a href="{{ route('admin.cars.index') }}" class="ml-4 text-gray-600 hover:underline">Cancel</a>
    </form>
@endsection
