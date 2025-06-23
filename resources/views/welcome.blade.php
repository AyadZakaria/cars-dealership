<x-guest-layout>
    <x-navbar :cars="$cars" />
    <div class=" min-h-screen py-16 px-4 flex flex-col items-center">
        <!-- Minimal Promo Banner -->
        <div class="w-full max-w-3xl mb-12 text-center">
            <h2 class="text-4xl md:text-5xl font-extrabold text-gray-900 mb-4 tracking-tight">Drive Your Dream Car</h2>
            <p class="text-gray-600 text-lg mb-6">Discover the best deals for buying or renting top cars. Fast, easy, and
                secure.
            </p>
            <a href="#cars"
                class="inline-block px-8 py-3 border border-blue-500 text-blue-500 font-semibold rounded-lg bg-white hover:bg-blue-500 hover:text-white transition">Browse
                Cars
            </a>
        </div>
        <h1 class="text-3xl font-bold mb-8 text-gray-900 tracking-tight">Explore Cars</h1>
        <div id="cars"
            class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 w-full max-w-7xl justify-center items-start mx-auto"
            style="min-height: 600px;">
            @forelse($cars as $car)
                <div
                    class="bg-white rounded-3xl border border-gray-100 shadow-lg overflow-hidden flex flex-col hover:shadow-2xl transition-all duration-200 ring-1 ring-blue-50">
                    @if ($car->image_url)
                        <div
                            class="w-full h-48 overflow-hidden rounded-t-3xl flex items-center justify-center bg-gray-100">
                            <img src="{{ $car->image_url }}" alt="{{ $car->brand }} {{ $car->model }}"
                                class="w-full h-48 object-cover rounded-t-3xl" style="max-height:12rem;">
                        </div>
                    @else
                        <div class="w-full h-48 bg-gray-100 flex items-center justify-center rounded-t-3xl">
                            <!-- Default car SVG icon -->
                            <svg width="64" height="40" viewBox="0 0 64 40" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <rect x="8" y="18" width="48" height="12" rx="6" fill="#3B82F6" />
                                <rect x="16" y="10" width="32" height="12" rx="6" fill="#60A5FA" />
                                <circle cx="20" cy="34" r="4" fill="#3B82F6" />
                                <circle cx="44" cy="34" r="4" fill="#3B82F6" />
                                <rect x="24" y="20" width="16" height="4" rx="2" fill="#BFDBFE" />
                            </svg>
                        </div>
                    @endif
                    <div class="p-6 flex flex-col gap-2">
                        <div class="flex items-center justify-between mb-2">
                            <h2 class="text-2xl font-bold text-gray-900">{{ $car->brand }} {{ $car->model }}</h2>
                            <span
                                class="px-3 py-1 rounded-full text-xs font-semibold
                @if ($car->availability === 'for_sale') bg-blue-100 text-blue-700
                @elseif($car->availability === 'for_rent') bg-yellow-100 text-yellow-700
                @else bg-gray-200 text-gray-500 @endif
            ">
                                {{ ucfirst(str_replace('_', ' ', $car->availability)) }}
                            </span>
                        </div>
                        <div class="flex flex-wrap gap-2 text-sm text-gray-600 mb-2">
                            <span class="bg-gray-100 px-2 py-1 rounded">Year: <span
                                    class="font-semibold text-gray-900">{{ $car->year }}</span></span>
                            <span class="bg-gray-100 px-2 py-1 rounded">Fuel: <span
                                    class="font-semibold text-gray-900">{{ ucfirst($car->fuel_type) }}</span></span>
                            <span class="bg-gray-100 px-2 py-1 rounded">Mileage: <span
                                    class="font-semibold text-gray-900">{{ $car->mileage ?? 'N/A' }}</span> km</span>
                        </div>
                        <div class="flex items-center gap-4 mb-2">
                            @if ($car->availability === 'for_sale' && $car->purchase_price)
                                <div class="flex items-center gap-1">
                                    <span
                                        class="text-blue-500 font-bold text-lg">MAD{{ number_format($car->purchase_price, 2) }}</span>
                                    <span class="text-xs text-gray-500">Sale</span>
                                </div>
                            @endif
                            @if ($car->availability === 'for_rent' && $car->price)
                                <div class="flex items-center gap-1">
                                    <span
                                        class="text-yellow-500 font-bold text-lg">MAD{{ number_format($car->price, 2) }}</span>
                                    <span class="text-xs text-gray-500">/day</span>
                                </div>
                            @endif
                        </div>
                        <div class="flex items-center gap-2 mb-2">
                            @if ($car->in_service)
                                <span
                                    class="inline-flex items-center px-2 py-1 bg-green-100 text-green-700 rounded-full text-xs font-semibold">
                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" stroke-width="2"
                                        viewBox="0 0 24 24">
                                        <path d="M5 13l4 4L19 7" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    Available
                                </span>
                            @else
                                <span
                                    class="inline-flex items-center px-2 py-1 bg-red-100 text-red-700 rounded-full text-xs font-semibold">
                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" stroke-width="2"
                                        viewBox="0 0 24 24">
                                        <path d="M6 18L18 6M6 6l12 12" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    Not in service
                                </span>
                            @endif
                        </div>

                        <div x-data="{ open: false }" class="w-full">
                            <button @click="open = true"
                                class="inline-block px-5 py-2 border border-blue-500 text-blue-500 rounded-lg font-medium bg-white hover:bg-blue-500 hover:text-white transition mt-2 text-center"
                                type="button">
                                View Details
                            </button>
                            <div x-show="open" class="fixed inset-0 z-50 flex items-center justify-center bg-black/40"
                                @keydown.escape.window="open = false">
                                <div class="bg-white rounded-3xl shadow-2xl w-full max-w-6xl p-0 md:p-0 relative flex flex-col md:flex-row gap-0 overflow-hidden border border-blue-100"
                                    @click.away="open = false" x-transition>
                                    <button @click="open = false"
                                        class="absolute top-4 right-4 text-blue-500 hover:text-blue-700 text-3xl font-bold z-10">&times;</button>
                                    <div
                                        class="flex-shrink-0 w-full md:w-1/2 flex flex-col items-center justify-center bg-gradient-to-br from-blue-50 to-blue-100 p-8">
                                        @if ($car->image_url)
                                            <img src="{{ $car->image_url }}"
                                                alt="{{ $car->brand }} {{ $car->model }}"
                                                class="w-full h-64 object-cover rounded-2xl border border-gray-200 shadow mb-4">
                                        @else
                                            <div
                                                class="w-full h-64 bg-gray-100 flex items-center justify-center rounded-2xl border border-gray-200 shadow mb-4">
                                                <!-- Default car SVG icon -->
                                                <svg width="96" height="60" viewBox="0 0 96 60" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <rect x="12" y="27" width="72" height="18" rx="9"
                                                        fill="#3B82F6" />
                                                    <rect x="24" y="15" width="48" height="18" rx="9"
                                                        fill="#60A5FA" />
                                                    <circle cx="30" cy="51" r="6" fill="#3B82F6" />
                                                    <circle cx="66" cy="51" r="6" fill="#3B82F6" />
                                                    <rect x="36" y="30" width="24" height="6" rx="3"
                                                        fill="#BFDBFE" />
                                                </svg>
                                            </div>
                                        @endif
                                        <div class="w-full flex flex-col items-center">
                                            <span
                                                class="inline-block px-4 py-1 rounded-full text-xs font-semibold bg-blue-100 text-blue-700 mb-2">
                                                {{ ucfirst(str_replace('_', ' ', $car->availability)) }}
                                            </span>
                                            <span class="text-lg font-bold text-gray-900 mb-1">{{ $car->brand }}
                                                {{ $car->model }}</span>
                                            <span class="text-gray-500 text-sm mb-2">{{ $car->year }} &bull;
                                                {{ ucfirst($car->fuel_type) }}</span>
                                            <span class="text-gray-700 text-base mb-2">Mileage: <span
                                                    class="font-semibold">{{ $car->mileage ?? 'N/A' }}</span>
                                                km</span>
                                            @if ($car->availability === 'for_sale' && $car->purchase_price)
                                                <span
                                                    class="text-blue-500 font-bold text-xl mb-1">MAD{{ number_format($car->purchase_price, 2) }}
                                                    <span class="text-xs text-gray-500">Sale</span></span>
                                            @endif
                                            @if ($car->availability === 'for_rent' && $car->price)
                                                <span
                                                    class="text-yellow-500 font-bold text-xl mb-1">MAD{{ number_format($car->price, 2) }}
                                                    <span class="text-xs text-gray-500">/day</span></span>
                                            @endif
                                            <span class="mt-2">
                                                @if ($car->in_service)
                                                    <span
                                                        class="inline-flex items-center px-2 py-1 bg-green-100 text-green-700 rounded-full text-xs font-semibold">
                                                        <svg class="w-3 h-3 mr-1" fill="none"
                                                            stroke="currentColor" stroke-width="2"
                                                            viewBox="0 0 24 24">
                                                            <path d="M5 13l4 4L19 7" stroke-linecap="round"
                                                                stroke-linejoin="round" />
                                                        </svg>
                                                        Available
                                                    </span>
                                                @else
                                                    <span
                                                        class="inline-flex items-center px-2 py-1 bg-red-100 text-red-700 rounded-full text-xs font-semibold">
                                                        <svg class="w-3 h-3 mr-1" fill="none"
                                                            stroke="currentColor" stroke-width="2"
                                                            viewBox="0 0 24 24">
                                                            <path d="M6 18L18 6M6 6l12 12" stroke-linecap="round"
                                                                stroke-linejoin="round" />
                                                        </svg>
                                                        Not in service
                                                    </span>
                                                @endif
                                            </span>
                                        </div>
                                    </div>
                                    <div class="flex-1 flex flex-col justify-center p-8 bg-white">
                                        <h2 class="text-2xl font-bold text-gray-900 mb-4">Reserve this Car</h2>
                                        <div x-data="{ reserveOpen: true }">
                                            <form method="POST"
                                                action="{{ route('car.reserve', ['uuid' => $car->uuid]) }}"
                                                class="space-y-4">
                                                @csrf

                                                @include('components.validation-and-session-errors')

                                                <div>
                                                    <label class="block text-gray-900 font-medium mb-1"
                                                        for="name">Your Name</label>
                                                    <input type="text" name="name" id="name" required
                                                        class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                                                        value="{{ old('name') ?? (Auth::check() ? Auth::user()->name : '') }}">
                                                    @error('name')
                                                        <div class="text-blue-500 text-sm mt-1">{{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                                <div>
                                                    <label class="block text-gray-900 font-medium mb-1"
                                                        for="phone">Phone Number</label>
                                                    <input type="text" name="phone" id="phone" required
                                                        class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                                                        value="{{ old('phone') ?? (Auth::check() ? Auth::user()->Customer->phone : '') }}">
                                                    @error('phone')
                                                        <div class="text-blue-500 text-sm mt-1">{{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>

                                                @php
                                                    $isForSale =
                                                        $car->availability === 'for_sale' ||
                                                        $car->availability === 'both';
                                                    $isForRent =
                                                        $car->availability === 'for_rent' ||
                                                        $car->availability === 'both';
                                                @endphp

                                                @if ($isForRent)
                                                    <input type="hidden" name="type" value="rent">
                                                    <div class="flex gap-4">
                                                        <div class="flex-1">
                                                            <label class="block text-gray-900 font-medium mb-1"
                                                                for="rent_start_date">Start Date</label>
                                                            <input type="date" name="rent_start_date"
                                                                id="rent_start_date"
                                                                class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                                                                value="{{ old('rent_start_date') }}">
                                                        </div>
                                                        <div class="flex-1">
                                                            <label class="block text-gray-900 font-medium mb-1"
                                                                for="rent_end_date">End Date</label>
                                                            <input type="date" name="rent_end_date"
                                                                id="rent_end_date"
                                                                class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                                                                value="{{ old('rent_end_date') }}">
                                                        </div>
                                                    </div>
                                                @elseif ($isForSale)
                                                    <input type="hidden" name="type" value="sale">
                                                @endif
                                                <button type="submit"
                                                    class="w-full py-3 border border-blue-500 text-blue-500 font-bold rounded-lg bg-white hover:bg-blue-500 hover:text-white transition">Submit
                                                    Reservation</button>
                                            </form>
                                            <div class="mt-6 text-center text-gray-400 text-sm">
                                                After submitting, please wait for a phone call to confirm or deny
                                                your reservation.
                                            </div>
                                            @if (session('success'))
                                                <div
                                                    class="mt-6 p-4 rounded-lg bg-blue-100 text-blue-700 text-center font-semibold">
                                                    {{ session('success') }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center text-gray-400 text-lg">No cars available at the moment.</div>
            @endforelse
        </div>
        <div class="mt-10 flex justify-center">
            {{ $cars->links() }}
        </div>
    </div>
</x-guest-layout>
