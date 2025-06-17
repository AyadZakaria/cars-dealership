<x-app-layout>
    <div class="bg-gray-50 min-h-screen py-12 px-4 flex flex-col items-center">
        <div class="w-full max-w-4xl mx-auto bg-white rounded-3xl shadow-2xl p-0 md:p-10 mb-10 flex flex-col md:flex-row gap-10">
            <div class="flex-shrink-0 w-full md:w-1/2 flex flex-col items-center justify-center p-6">
                @if($car->image_url)
                    <img src="{{ $car->image_url }}" alt="{{ $car->brand }} {{ $car->model }}" class="w-full h-80 object-cover rounded-2xl border border-gray-200 shadow">
                @else
                    <div class="w-full h-80 bg-gray-100 flex items-center justify-center rounded-2xl border border-gray-200 shadow">
                        <!-- Default car SVG icon -->
                        <svg width="96" height="60" viewBox="0 0 96 60" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect x="12" y="27" width="72" height="18" rx="9" fill="#3B82F6"/>
                            <rect x="24" y="15" width="48" height="18" rx="9" fill="#60A5FA"/>
                            <circle cx="30" cy="51" r="6" fill="#3B82F6"/>
                            <circle cx="66" cy="51" r="6" fill="#3B82F6"/>
                            <rect x="36" y="30" width="24" height="6" rx="3" fill="#BFDBFE"/>
                        </svg>
                    </div>
                @endif
            </div>
            <div class="flex-1 flex flex-col justify-between p-6">
                <div>
                    <h1 class="text-4xl font-extrabold text-gray-900 mb-4 tracking-tight">{{ $car->brand }} {{ $car->model }}</h1>
                    <div class="flex flex-wrap gap-4 mb-6">
                        <div class="bg-blue-100 px-4 py-2 rounded-lg text-blue-700 font-semibold text-sm">Year: <span class="text-gray-900">{{ $car->year }}</span></div>
                        <div class="bg-blue-100 px-4 py-2 rounded-lg text-blue-700 font-semibold text-sm">Type: <span class="text-gray-900">{{ ucfirst($car->fuel_type) }}</span></div>
                        <div class="bg-blue-100 px-4 py-2 rounded-lg text-blue-700 font-semibold text-sm">Mileage: <span class="text-gray-900">{{ $car->mileage ?? 'N/A' }}</span></div>
                    </div>
                    <div class="mb-6">
                        @php
                            $isForSale = $car->availability === 'for_sale' || $car->availability === 'both';
                            $isForRent = $car->availability === 'for_rent' || $car->availability === 'both';
                        @endphp
                        <div class="flex flex-col gap-2">
                            @if($isForSale)
                                <div>
                                    <span class="inline-block px-3 py-1 border border-blue-500 text-blue-500 rounded-full text-xs font-semibold mb-1 bg-white">Available for Sale</span>
                                    <span class="ml-2 text-xl font-bold text-gray-900">${{ number_format($car->price, 2) }}</span>
                                </div>
                            @endif
                            @if($isForRent)
                                <div>
                                    <span class="inline-block px-3 py-1 border border-blue-500 text-blue-500 rounded-full text-xs font-semibold mb-1 bg-white">Available for Loan</span>
                                    <span class="ml-2 text-xl font-bold text-gray-900">${{ number_format($car->price, 2) }}</span><span class="text-gray-400">/day</span>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="mb-8">
                        <span class="font-semibold text-gray-500">Status:</span>
                        @if($car->in_service)
                            <span class="inline-block px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-xs font-semibold ml-2">Available</span>
                        @else
                            <span class="inline-block px-3 py-1 bg-gray-300 text-gray-500 rounded-full text-xs font-semibold ml-2">Reserved</span>
                        @endif
                    </div>
                </div>
                <div x-data="{ open: false }">
                    <button
                        @click="open = true"
                        class="w-full md:w-auto px-8 py-3 border border-blue-500 text-blue-500 font-bold rounded-lg bg-white hover:bg-blue-500 hover:text-white transition text-lg"
                        :disabled="!{{ $car->in_service ? 'true' : 'false' }}"
                        {{ $car->in_service ? '' : 'disabled' }}
                    >
                        Reserve this Car
                    </button>
                    <!-- Reservation Modal -->
                    <div
                        x-show="open"
                        x-on:keydown.escape.window="open = false"
                        style="display: none;"
                        class="fixed inset-0 z-50 flex items-center justify-center bg-black/40"
                    >
                        <div
                            class="bg-white rounded-2xl shadow-2xl w-full max-w-lg p-8 relative"
                            @click.away="open = false"
                            x-transition
                        >
                            <button @click="open = false" class="absolute top-4 right-4 text-blue-500 hover:text-blue-700 text-2xl font-bold">&times;</button>
                            <h2 class="text-2xl font-bold text-gray-900 mb-4 text-center">Reserve this Car</h2>
                            @if(session('success'))
                                <div class="mb-6 p-4 rounded-lg bg-blue-100 text-blue-700 text-center font-semibold">
                                    {{ session('success') }}
                                </div>
                            @endif
                            <form method="POST" action="{{ route('car.reserve', ['uuid' => $car->uuid]) }}" class="space-y-4">
                                @csrf
                                <div>
                                    <label class="block text-gray-900 font-medium mb-1" for="name">Your Name</label>
                                    <input type="text" name="name" id="name" required class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" value="{{ old('name') }}">
                                    @error('name')
                                        <div class="text-blue-500 text-sm mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div>
                                    <label class="block text-gray-900 font-medium mb-1" for="phone">Phone Number</label>
                                    <input type="text" name="phone" id="phone" required class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" value="{{ old('phone') }}">
                                    @error('phone')
                                        <div class="text-blue-500 text-sm mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div>
                                    <label class="block text-gray-900 font-medium mb-1" for="type">Reservation Type</label>
                                    <select name="type" id="type" required class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none">
                                        @if($isForRent)
                                            <option value="rent" {{ old('type') == 'rent' ? 'selected' : '' }}>For Loan</option>
                                        @endif
                                        @if($isForSale)
                                            <option value="sale" {{ old('type') == 'sale' ? 'selected' : '' }}>For Purchase</option>
                                        @endif
                                    </select>
                                    @error('type')
                                        <div class="text-blue-500 text-sm mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                                <button type="submit" class="w-full py-3 border border-blue-500 text-blue-500 font-bold rounded-lg bg-white hover:bg-blue-500 hover:text-white transition">Submit Reservation</button>
                            </form>
                            <div class="mt-6 text-center text-gray-400 text-sm">
                                After submitting, please wait for a phone call to confirm or deny your reservation.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
