@extends('layouts.admin')

@section('content')
    <div x-data="reservationCrudModals()" x-init="init()">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">Reservations</h1>
            {{-- <button @click="openCreate = true" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Add
                Reservation</button> --}}
        </div>
        <!-- Create Reservation Modal -->
        <div x-show="openCreate" class="fixed inset-0 flex items-center justify-center z-50" style="display: none;" x-cloak>
            <div class="absolute inset-0 bg-black opacity-50" @click="openCreate = false"></div>
            <div class="bg-white rounded-lg shadow-lg w-full max-w-md z-10 p-6">
                <h2 class="text-xl font-bold mb-4">Create Reservation</h2>
                <form method="POST" action="{{ route('admin.reservations.store') }}">
                    @csrf
                    <div class="mb-4">
                        <label class="block text-gray-700 mb-1" for="customer_id">Customer</label>
                        <input type="number" name="customer_id" id="customer_id" class="w-full border rounded px-3 py-2"
                            required>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 mb-1" for="car_id">Car</label>
                        <input type="number" name="car_id" id="car_id" class="w-full border rounded px-3 py-2"
                            required>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 mb-1" for="start_date">Start Date</label>
                        <input type="date" name="start_date" id="start_date" class="w-full border rounded px-3 py-2"
                            required>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 mb-1" for="end_date">End Date</label>
                        <input type="date" name="end_date" id="end_date" class="w-full border rounded px-3 py-2"
                            required>
                    </div>
                    <div class="flex justify-end">
                        <button type="button" @click="openCreate = false"
                            class="mr-2 px-4 py-2 rounded bg-gray-200 hover:bg-gray-300">Cancel</button>
                        <button type="submit"
                            class="px-4 py-2 rounded bg-blue-600 text-white hover:bg-blue-700">Create</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="relative overflow-x-auto">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3">ID</th>
                        <th scope="col" class="px-6 py-3">Customer</th>
                        <th scope="col" class="px-6 py-3">Phone</th>
                        <th scope="col" class="px-6 py-3">Car</th>
                        <th scope="col" class="px-6 py-3">Details</th>
                        <th scope="col" class="px-6 py-3">Status</th>
                        <th scope="col" class="px-6 py-3 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($reservations as $reservation)
                        <tr class="bg-white border-b border-gray-200">
                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">{{ $reservation->id }}</td>
                            <td class="px-6 py-4">{{ $reservation->customer->name ?? '-' }}</td>
                            <td class="px-6 py-4">{{ $reservation->customer->phone ?? '-' }}</td>
                            <td class="px-6 py-4">{{ $reservation->car->brand ?? '-' }} {{ $reservation->car->model ?? '' }}
                            </td>
                            <td class="px-6 py-4">
                                @if ($reservation->reservation_type === 'rent')
                                    <div>
                                        <span class="font-semibold">Total:</span>
                                        {{ $reservation->total_rent_price ?? '-' }}
                                    </div>
                                    <div>
                                        <span class="font-semibold">From:</span>
                                        {{ $reservation->rent_start_date ? \Carbon\Carbon::parse($reservation->rent_start_date)->format('Y-m-d') : '-' }}
                                    </div>
                                    <div>
                                        <span class="font-semibold">To:</span>
                                        {{ $reservation->rent_end_date ? \Carbon\Carbon::parse($reservation->rent_end_date)->format('Y-m-d') : '-' }}
                                    </div>
                                @elseif ($reservation->reservation_type === 'sale')
                                    <div>
                                        <span class="font-semibold">Sale Price:</span>
                                        {{ $reservation->car->purchase_price ?? '-' }}
                                    </div>
                                @else
                                    -
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                @php
                                    $statusColors = [
                                        'pending' => 'bg-gray-200 text-gray-800',
                                        'confirmed' => 'bg-green-200 text-green-800',
                                        'rejected' => 'bg-red-200 text-red-800',
                                        'cancelled' => 'bg-yellow-200 text-yellow-800',
                                        'completed' => 'bg-blue-200 text-blue-800',
                                    ];
                                @endphp
                                <span
                                    class="px-2 py-1 rounded text-xs font-semibold {{ $statusColors[$reservation->status] ?? 'bg-gray-100 text-gray-700' }}">
                                    {{ ucfirst($reservation->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <form action="{{ route('admin.reservations.destroy', $reservation) }}" method="POST"
                                    class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline ml-2"
                                        onclick="return confirm('Delete this reservation?')">Delete</button>
                                </form>
                                <form action="{{ route('admin.reservations.confirm', $reservation->id) }}" method="POST"
                                    class="inline">
                                    @csrf
                                    <button type="submit" class="text-green-600 hover:underline ml-2"
                                        onclick="return confirm('Confirm this reservation?')">Confirm</button>
                                </form>
                                <form action="{{ route('admin.reservations.deny', $reservation->id) }}" method="POST"
                                    class="inline">
                                    @csrf
                                    <button type="submit" class="text-gray-600 hover:underline ml-2"
                                        onclick="return confirm('Deny this reservation?')">Deny</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @if (method_exists($reservations, 'links'))
            <div class="mt-4 flex justify-center">
                {{ $reservations->links() }}
            </div>
        @endif
        <script>
            function reservationCrudModals() {
                return {
                    openCreate: false,
                    selectedReservation: {
                        id: null,
                        customer_id: '',
                        car_id: '',
                        start_date: '',
                        end_date: ''
                    },
                    init() {
                        // For future extensibility
                    }
                }
            }
        </script>
    @endsection
