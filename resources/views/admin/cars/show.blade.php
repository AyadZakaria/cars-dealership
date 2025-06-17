@extends('layouts.admin')

@section('content')
    <h1 class="text-2xl font-bold mb-6">Car Details</h1>
    <div class="bg-white p-6 rounded shadow-md max-w-lg">
        <div class="mb-4">
            <span class="font-semibold">Brand:</span> {{ $car->brand }}
        </div>
        <div class="mb-4">
            <span class="font-semibold">Model:</span> {{ $car->model }}
        </div>
        <div class="mb-4">
            <span class="font-semibold">Year:</span> {{ $car->year }}
        </div>
        <a href="{{ route('admin.cars.edit', $car) }}"
            class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">Edit</a>
        <a href="{{ route('admin.cars.index') }}" class="ml-4 text-gray-600 hover:underline">Back to List</a>
    </div>
@endsection
