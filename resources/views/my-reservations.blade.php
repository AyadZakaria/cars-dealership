<x-app-layout>
    <div class="max-w-3xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-8 text-center">My Reservations</h1>

        @auth
            @if(isset($reservations) && $reservations->count())
                <div class="space-y-6">
                    @foreach ($reservations as $reservation)
                        <div class="bg-white shadow rounded-lg p-6 flex flex-col sm:flex-row sm:items-center justify-between hover:shadow-md transition">
                            <div>
                                <div class="text-lg font-semibold text-gray-800">
                                    {{ $reservation->car->brand ?? 'Car' }} {{ $reservation->car->model ?? '' }}
                                </div>
                                <div class="text-sm text-gray-500 mt-1">
                                    Reserved on: <span class="font-medium text-gray-700">{{ $reservation->created_at->format('M d, Y') }}</span>
                                </div>
                                <div class="text-sm text-gray-500">
                                    From: <span class="font-medium text-gray-700">{{ $reservation->rent_start_date ?? '-' }}</span>
                                    &mdash; To: <span class="font-medium text-gray-700">{{ $reservation->rent_end_date ?? '-' }}</span>
                                </div>
                            </div>
                            <div class="mt-4 sm:mt-0">
                                @php
                                    $statusColors = [
                                        'pending' => 'bg-gray-200 text-gray-800',
                                        'confirmed' => 'bg-green-200 text-green-800',
                                        'rejected' => 'bg-red-200 text-red-800',
                                        'cancelled' => 'bg-yellow-200 text-yellow-800',
                                        'completed' => 'bg-blue-200 text-blue-800',
                                    ];
                                @endphp
                                <span class="inline-block px-3 py-1 rounded-full text-xs font-medium {{ $statusColors[$reservation->status] ?? 'bg-gray-100 text-gray-700' }}">
                                    {{ ucfirst($reservation->status) }}
                                </span>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="mt-8">
                    {{ $reservations->links() }}
                </div>
            @else
                <div class="text-center text-gray-500 mt-12">
                    <svg class="mx-auto mb-4 h-12 w-12 text-gray-300" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 17l4 4 4-4m0-5V3m-8 9a9 9 0 1118 0 9 9 0 01-18 0z" />
                    </svg>
                    <p class="text-lg">You have no reservations yet.</p>
                    <a href="{{ route('home') }}" class="mt-4 inline-block text-blue-600 hover:underline">Browse cars</a>
                </div>
            @endif
        @else
            <div class="text-center text-gray-500 mt-12">
                <p class="text-lg">Please log in to view your reservations.</p>
                <a href="{{ route('login') }}" class="mt-4 inline-block text-blue-600 hover:underline">Login</a>
            </div>
        @endauth
    </div>
</x-app-layout>
