@extends('layouts.admin')

@section('content')
    <h1 class="text-2xl font-bold mb-6">Add Car</h1>
    <form action="{{ route('admin.cars.store') }}" method="POST" class="bg-white p-6 rounded shadow-md max-w-lg">
        @csrf
        <div class="mb-4">
            <label class="block mb-1 font-semibold">Make</label>
            <input type="text" name="make" class="w-full border px-3 py-2 rounded" required>
        </div>
        <div class="mb-4">
            <label class="block mb-1 font-semibold">Model</label>
            <input type="text" name="model" class="w-full border px-3 py-2 rounded" required>
        </div>
        <div class="mb-4">
            <label class="block mb-1 font-semibold">Year</label>
            <input type="number" name="year" class="w-full border px-3 py-2 rounded" required>
        </div>
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Save</button>
        <a href="{{ route('admin.cars.index') }}" class="ml-4 text-gray-600 hover:underline">Cancel</a>
    </form>
@endsection
