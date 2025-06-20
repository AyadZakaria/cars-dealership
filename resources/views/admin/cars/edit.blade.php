@extends('layouts.admin')

@section('content')
    <h1 class="text-2xl font-bold mb-6">Edit Car</h1>

    @if ($errors->any())
        <div class="bg-red-50 text-red-600 p-4 rounded mb-6">
            <div class="font-medium">{{ __('Whoops! Something went wrong.') }}</div>
            <ul class="mt-3 list-disc list-inside text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.cars.update', $car->id) }}" method="POST" enctype="multipart/form-data"
        class="bg-white p-6 rounded shadow-md max-w-lg">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label class="block mb-1 font-semibold">Brand <span class="text-red-500">*</span></label>
            <input type="text" name="brand"
                class="w-full border px-3 py-2 rounded @error('brand') border-red-500 @enderror"
                value="{{ old('brand', $car->brand) }}" required>
            @error('brand')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-4">
            <label class="block mb-1 font-semibold">Model <span class="text-red-500">*</span></label>
            <input type="text" name="model"
                class="w-full border px-3 py-2 rounded @error('model') border-red-500 @enderror"
                value="{{ old('model', $car->model) }}" required>
            @error('model')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-4">
            <label class="block mb-1 font-semibold">Year <span class="text-red-500">*</span></label>
            <input type="number" name="year"
                class="w-full border px-3 py-2 rounded @error('year') border-red-500 @enderror"
                value="{{ old('year', $car->year) }}" required min="1900" max="{{ date('Y') + 1 }}">
            @error('year')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-4">
            <label class="block mb-1 font-semibold">Price <span class="text-red-500">*</span></label>
            <input type="number" name="price"
                class="w-full border px-3 py-2 rounded @error('price') border-red-500 @enderror"
                value="{{ old('price', $car->price) }}" required step="0.01" min="0">
            @error('price')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-4">
            <label class="block mb-1 font-semibold">Availability <span class="text-red-500">*</span></label>
            <select name="availability"
                class="w-full border px-3 py-2 rounded @error('availability') border-red-500 @enderror" required>
                <option value="">Select...</option>
                <option value="for_rent" {{ old('availability', $car->availability) == 'for_rent' ? 'selected' : '' }}>For Rent</option>
                <option value="for_sale" {{ old('availability', $car->availability) == 'for_sale' ? 'selected' : '' }}>For Sale</option>
            </select>
            @error('availability')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-4">
            <label class="block mb-1 font-semibold">Fuel Type <span class="text-red-500">*</span></label>
            <select name="fuel_type"
                class="w-full border px-3 py-2 rounded @error('fuel_type') border-red-500 @enderror" required>
                <option value="">Select...</option>
                <option value="petrol" {{ old('fuel_type', $car->fuel_type) == 'petrol' ? 'selected' : '' }}>Petrol</option>
                <option value="diesel" {{ old('fuel_type', $car->fuel_type) == 'diesel' ? 'selected' : '' }}>Diesel</option>
                <option value="electric" {{ old('fuel_type', $car->fuel_type) == 'electric' ? 'selected' : '' }}>Electric</option>
                <option value="hybrid" {{ old('fuel_type', $car->fuel_type) == 'hybrid' ? 'selected' : '' }}>Hybrid</option>
            </select>
            @error('fuel_type')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-4">
            <label class="block mb-1 font-semibold">Car Image</label>
            <input type="file" name="image" accept="image/*"
                class="w-full border px-3 py-2 rounded @error('image') border-red-500 @enderror"
                onchange="previewImageFile(this)">
            @error('image')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
            <div id="imagePreview" class="mt-2">
                <span class="block text-sm text-gray-600 mb-1">Preview:</span>
                <img id="preview"
                    src="{{ old('image') ? '' : ($car->image_url ?? '') }}"
                    @if($car->image_url) style="display: block;" @else style="display: none;" @endif
                    alt="Preview"
                    class="max-w-xs rounded">
            </div>
        </div>
        <div class="mb-4">
            <label class="block mb-1 font-semibold">Mileage</label>
            <input type="number" name="mileage"
                class="w-full border px-3 py-2 rounded @error('mileage') border-red-500 @enderror" min="0"
                value="{{ old('mileage', $car->mileage ?? 0) }}">
            @error('mileage')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
        <div class="flex items-center ps-4 border border-gray-200 rounded-sm mb-4">
            <input type="checkbox" value="1" {{ old('in_service', $car->in_service) ? 'checked' : '' }} name="in_service"
                id="in_service"
                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 focus:ring-2">
            <label for="in_service" class="w-full py-4 ms-2 text-sm font-medium text-gray-900">In service</label>
        </div>
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Save</button>
        <a href="{{ route('admin.cars.index') }}" class="ml-4 text-gray-600 hover:underline">Cancel</a>
    </form>

    <script>
        function previewImageFile(input) {
            const preview = document.getElementById('preview');
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                };
                reader.readAsDataURL(input.files[0]);
            } else {
                // If no file selected, restore to original image_url if exists, else hide
                @if($car->image_url)
                    preview.src = "{{ $car->image_url }}";
                    preview.style.display = 'block';
                @else
                    preview.src = '';
                    preview.style.display = 'none';
                @endif
            }
        }

        // On page load, show preview if image_url exists
        document.addEventListener('DOMContentLoaded', function() {
            const preview = document.getElementById('preview');
            if (preview.src && preview.src !== window.location.href) {
                preview.style.display = 'block';
            } else {
                preview.style.display = 'none';
            }
        });
    </script>
@endsection
