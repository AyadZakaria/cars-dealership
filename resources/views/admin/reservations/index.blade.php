@extends('layouts.admin')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Reservations</h1>
        <a href="{{ route('admin.reservations.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Add Reservation</a>
    </div>
    <table class="min-w-full bg-white shadow rounded">
        <thead>
            <tr>
                <th class="py-2 px-4 border-b">ID</th>
                <th class="py-2 px-4 border-b">Customer</th>
                <th class="py-2 px-4 border-b">Car</th>
                <th class="py-2 px-4 border-b">Start Date</th>
                <th class="py-2 px-4 border-b">End Date</th>
                <th class="py-2 px-4 border-b">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($reservations as $reservation)
                <tr>
                    <td class="py-2 px-4 border-b">{{ $reservation->id }}</td>
                    <td class="py-2 px-4 border-b">{{ $reservation->customer->name ?? '-' }}</td>
                    <td class="py-2 px-4 border-b">{{ $reservation->car->make ?? '-' }} {{ $reservation->car->model ?? '' }}</td>
                    <td class="py-2 px-4 border-b">{{ $reservation->start_date }}</td>
                    <td class="py-2 px-4 border-b">{{ $reservation->end_date }}</td>
                    <td class="py-2 px-4 border-b">
                        <a href="{{ route('admin.reservations.show', $reservation) }}" class="text-blue-600 hover:underline">View</a>
                        <a href="{{ route('admin.reservations.edit', $reservation) }}" class="text-yellow-600 hover:underline ml-2">Edit</a>
                        <form action="{{ route('admin.reservations.destroy', $reservation) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline ml-2" onclick="return confirm('Delete this reservation?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
