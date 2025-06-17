@extends('layouts.admin')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Reservations</h1>
        <a href="{{ route('admin.reservations.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Add Reservation</a>
    </div>
    <div class="relative overflow-x-auto">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3">ID</th>
                    <th scope="col" class="px-6 py-3">Customer</th>
                    <th scope="col" class="px-6 py-3">Car</th>
                    <th scope="col" class="px-6 py-3">Start Date</th>
                    <th scope="col" class="px-6 py-3">End Date</th>
                    <th scope="col" class="px-6 py-3 text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($reservations as $reservation)
                    <tr class="bg-white border-b border-gray-200">
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">{{ $reservation->id }}</td>
                        <td class="px-6 py-4">{{ $reservation->customer->name ?? '-' }}</td>
                        <td class="px-6 py-4">{{ $reservation->car->make ?? '-' }} {{ $reservation->car->model ?? '' }}</td>
                        <td class="px-6 py-4">{{ $reservation->start_date }}</td>
                        <td class="px-6 py-4">{{ $reservation->end_date }}</td>
                        <td class="px-6 py-4 text-center">
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
    </div>
    @if(method_exists($reservations, 'links'))
        <div class="mt-4 flex justify-center">
            {{ $reservations->links() }}
        </div>
    @endif
@endsection
