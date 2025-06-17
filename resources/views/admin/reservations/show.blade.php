@extends('layouts.admin')

@section('content')
    <h1 class="text-2xl font-bold mb-6">Reservation Details</h1>
    <div class="bg-white p-6 rounded shadow-md max-w-lg">
        <div class="mb-4">
            <span class="font-semibold">ID:</span> {{ $reservation->id }}
        </div>
        <div class="mb-4">
            <span class="font-semibold">Customer:</span> {{ $reservation->customer->name ?? '-' }}
        </div>
        <div class="mb-4">
            <span class="font-semibold">Car:</span> {{ $reservation->car->make ?? '-' }} {{ $reservation->car->model ?? '' }}
        </div>
        <div class="mb-4">
            <span class="font-semibold">Start Date:</span> {{ $reservation->start_date }}
        </div>
        <div class="mb-4">
            <span class="font-semibold">End Date:</span> {{ $reservation->end_date }}
        </div>
        <a href="{{ route('admin.reservations.edit', $reservation) }}" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">Edit</a>
        <a href="{{ route('admin.reservations.index') }}" class="ml-4 text-gray-600 hover:underline">Back to List</a>
    </div>
@endsection
