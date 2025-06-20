@extends('layouts.admin')

@section('content')
    <div x-data="reservationCrudModals()" x-init="init()">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">Reservations</h1>
            <button @click="openCreate = true" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Add
                Reservation</button>
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
        <!-- View Reservation Modal -->
        <div x-show="openView" class="fixed inset-0 flex items-center justify-center z-50" style="display: none;" x-cloak>
            <div class="absolute inset-0 bg-black opacity-50" @click="openView = false"></div>
            <div class="bg-white rounded-lg shadow-lg w-full max-w-md z-10 p-6">
                <h2 class="text-xl font-bold mb-4">Reservation Details</h2>
                <div class="mb-2"><span class="font-semibold">ID:</span> <span x-text="selectedReservation.id"></span>
                </div>
                <div class="mb-2"><span class="font-semibold">Customer ID:</span> <span
                        x-text="selectedReservation.customer_id"></span></div>
                <div class="mb-2"><span class="font-semibold">Car ID:</span> <span
                        x-text="selectedReservation.car_id"></span></div>
                <div class="mb-2"><span class="font-semibold">Start Date:</span> <span
                        x-text="selectedReservation.start_date"></span></div>
                <div class="mb-2"><span class="font-semibold">End Date:</span> <span
                        x-text="selectedReservation.end_date"></span></div>
                <div class="flex justify-end mt-4">
                    <button type="button" @click="openView = false"
                        class="px-4 py-2 rounded bg-gray-200 hover:bg-gray-300">Close</button>
                </div>
            </div>
        </div>
        <!-- Edit Reservation Modal -->
        <div x-show="openEdit" class="fixed inset-0 flex items-center justify-center z-50" style="display: none;" x-cloak>
            <div class="absolute inset-0 bg-black opacity-50" @click="openEdit = false"></div>
            <div class="bg-white rounded-lg shadow-lg w-full max-w-md z-10 p-6">
                <h2 class="text-xl font-bold mb-4">Edit Reservation</h2>
                <form :action="'/admin/reservations/' + selectedReservation.id" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <label class="block text-gray-700 mb-1" for="edit_customer_id">Customer</label>
                        <input type="number" name="customer_id" id="edit_customer_id"
                            class="w-full border rounded px-3 py-2" x-model="selectedReservation.customer_id" required>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 mb-1" for="edit_car_id">Car</label>
                        <input type="number" name="car_id" id="edit_car_id" class="w-full border rounded px-3 py-2"
                            x-model="selectedReservation.car_id" required>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 mb-1" for="edit_start_date">Start Date</label>
                        <input type="date" name="start_date" id="edit_start_date"
                            class="w-full border rounded px-3 py-2" x-model="selectedReservation.start_date" required>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 mb-1" for="edit_end_date">End Date</label>
                        <input type="date" name="end_date" id="edit_end_date" class="w-full border rounded px-3 py-2"
                            x-model="selectedReservation.end_date" required>
                    </div>
                    <div class="flex justify-end">
                        <button type="button" @click="openEdit = false"
                            class="mr-2 px-4 py-2 rounded bg-gray-200 hover:bg-gray-300">Cancel</button>
                        <button type="submit"
                            class="px-4 py-2 rounded bg-yellow-600 text-white hover:bg-yellow-700">Save</button>
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
                        <th scope="col" class="px-6 py-3">Car</th>
                        <th scope="col" class="px-6 py-3">Start Date</th>
                        <th scope="col" class="px-6 py-3">End Date</th>
                        <th scope="col" class="px-6 py-3 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($reservations as $reservation)
                        <tr class="bg-white border-b border-gray-200">
                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">{{ $reservation->id }}</td>
                            <td class="px-6 py-4">{{ $reservation->customer->name ?? '-' }}</td>
                            <td class="px-6 py-4">{{ $reservation->car->make ?? '-' }} {{ $reservation->car->model ?? '' }}
                            </td>
                            <td class="px-6 py-4">{{ $reservation->start_date }}</td>
                            <td class="px-6 py-4">{{ $reservation->end_date }}</td>
                            <td class="px-6 py-4 text-center">
                                <button class="text-blue-600 hover:underline" type="button"
                                    @click="openViewModal({ 
                                    id: {{ $reservation->id }},
                                    customer_id: {{ $reservation->customer_id }},
                                    car_id: {{ $reservation->car_id }},
                                    start_date: '{{ $reservation->start_date }}',
                                    end_date: '{{ $reservation->end_date }}'
                                })">View</button>
                                <button class="text-yellow-600 hover:underline ml-2" type="button"
                                    @click="openEditModal({ 
                                    id: {{ $reservation->id }},
                                    customer_id: {{ $reservation->customer_id }},
                                    car_id: {{ $reservation->car_id }},
                                    start_date: '{{ $reservation->start_date }}',
                                    end_date: '{{ $reservation->end_date }}'
                                })">Edit</button>
                                <form action="{{ route('admin.reservations.destroy', $reservation) }}" method="POST"
                                    class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline ml-2"
                                        onclick="return confirm('Delete this reservation?')">Delete</button>
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
                    openEdit: false,
                    openView: false,
                    selectedReservation: {
                        id: null,
                        customer_id: '',
                        car_id: '',
                        start_date: '',
                        end_date: ''
                    },
                    openEditModal(reservation) {
                        this.selectedReservation = {
                            ...reservation
                        };
                        this.openEdit = true;
                        this.openView = false;
                    },
                    openViewModal(reservation) {
                        this.selectedReservation = {
                            ...reservation
                        };
                        this.openView = true;
                        this.openEdit = false;
                    },
                    init() {
                        // For future extensibility
                    }
                }
            }
        </script>
    @endsection
