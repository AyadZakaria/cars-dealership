<x-app-layout>
    <x-navbar :car="$car" />
    <div class="bg-[#FDFDFC] min-h-screen py-12 px-4 flex flex-col items-center">
        <div class="w-full max-w-4xl mx-auto bg-white rounded-3xl shadow-2xl p-0 md:p-10 mb-10 flex flex-col md:flex-row gap-10">
            <div class="flex-shrink-0 w-full md:w-1/2 flex flex-col items-center justify-center p-6">
                @if($car->image)
                    <img src="{{ asset('storage/' . $car->image) }}" alt="{{ $car->brand }} {{ $car->model }}" class="w-full h-80 object-cover rounded-2xl border border-[#e3e3e0] shadow-lg">
                @else
                    <div class="w-full h-80 bg-[#dbdbd7] flex items-center justify-center text-2xl text-[#706f6c] rounded-2xl border border-[#e3e3e0] shadow-lg">No Image</div>
                @endif
            </div>
            <div class="flex-1 flex flex-col justify-between p-6">
                <div>
                    <h1 class="text-4xl font-extrabold text-[#1b1b18] mb-2 tracking-tight">{{ $car->brand }} {{ $car->model }}</h1>
                    <div class="flex flex-wrap gap-4 mb-4">
                        <div class="bg-[#FFA07A]/10 px-4 py-2 rounded-lg text-[#FFA07A] font-semibold text-sm shadow">Year: <span class="text-[#1b1b18]">{{ $car->year }}</span></div>
                        <div class="bg-[#87CEFA]/10 px-4 py-2 rounded-lg text-[#87CEFA] font-semibold text-sm shadow">Type: <span class="text-[#1b1b18]">{{ ucfirst($car->fuel_type) }}</span></div>
                        <div class="bg-[#FFDAB9]/10 px-4 py-2 rounded-lg text-[#FFA07A] font-semibold text-sm shadow">Mileage: <span class="text-[#1b1b18]">{{ $car->mileage ?? 'N/A' }}</span></div>
                    </div>
                    <div class="mb-4">
                        @php
                            $isForSale = $car->availability === 'for_sale' || $car->availability === 'both';
                            $isForRent = $car->availability === 'for_rent' || $car->availability === 'both';
                        @endphp
                        <div class="flex flex-col gap-2">
                            @if($isForSale)
                                <div>
                                    <span class="inline-block px-3 py-1 bg-[#FFA07A] text-white rounded-full text-xs font-semibold mb-1">Available for Sale</span>
                                    <span class="ml-2 text-xl font-bold text-[#1b1b18]">${{ number_format($car->price, 2) }}</span>
                                </div>
                            @endif
                            @if($isForRent)
                                <div>
                                    <span class="inline-block px-3 py-1 bg-[#87CEFA] text-white rounded-full text-xs font-semibold mb-1">Available for Loan</span>
                                    <span class="ml-2 text-xl font-bold text-[#1b1b18]">${{ number_format($car->price, 2) }}</span><span class="text-[#706f6c]">/day</span>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="mb-6">
                        <span class="font-semibold text-[#706f6c]">Status:</span>
                        @if($car->in_service)
                            <span class="inline-block px-3 py-1 bg-[#87CEFA] text-white rounded-full text-xs font-semibold ml-2">Available</span>
                        @else
                            <span class="inline-block px-3 py-1 bg-[#FFA07A] text-white rounded-full text-xs font-semibold ml-2">Reserved</span>
                        @endif
                    </div>
                </div>
                <div x-data="{ open: false }">
                    <button
                        @click="open = true"
                        class="w-full md:w-auto px-8 py-3 bg-[#FFA07A] text-white font-bold rounded-lg shadow hover:bg-[#ffb48a] transition text-lg"
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
                            <button @click="open = false" class="absolute top-4 right-4 text-[#FFA07A] hover:text-[#d46a00] text-2xl font-bold">&times;</button>
                            <h2 class="text-2xl font-bold text-[#1b1b18] mb-4 text-center">Reserve this Car</h2>
                            @if(session('success'))
                                <div class="mb-6 p-4 rounded-lg bg-[#87CEFA] text-white text-center font-semibold">
                                    {{ session('success') }}
                                </div>
                            @endif
                            <form method="POST" action="{{ route('car.reserve', ['uuid' => $car->uuid]) }}" class="space-y-4">
                                @csrf
                                <div>
                                    <label class="block text-[#1b1b18] font-medium mb-1" for="name">Your Name</label>
                                    <input type="text" name="name" id="name" required class="w-full px-4 py-2 border border-[#e3e3e0] rounded-lg focus:ring-2 focus:ring-[#FFA07A] focus:outline-none" value="{{ old('name') }}">
                                    @error('name')
                                        <div class="text-[#FFA07A] text-sm mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div>
                                    <label class="block text-[#1b1b18] font-medium mb-1" for="phone">Phone Number</label>
                                    <input type="text" name="phone" id="phone" required class="w-full px-4 py-2 border border-[#e3e3e0] rounded-lg focus:ring-2 focus:ring-[#FFA07A] focus:outline-none" value="{{ old('phone') }}">
                                    @error('phone')
                                        <div class="text-[#FFA07A] text-sm mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div>
                                    <label class="block text-[#1b1b18] font-medium mb-1" for="type">Reservation Type</label>
                                    <select name="type" id="type" required class="w-full px-4 py-2 border border-[#e3e3e0] rounded-lg focus:ring-2 focus:ring-[#FFA07A] focus:outline-none">
                                        @if($isForRent)
                                            <option value="rent" {{ old('type') == 'rent' ? 'selected' : '' }}>For Loan</option>
                                        @endif
                                        @if($isForSale)
                                            <option value="sale" {{ old('type') == 'sale' ? 'selected' : '' }}>For Purchase</option>
                                        @endif
                                    </select>
                                    @error('type')
                                        <div class="text-[#FFA07A] text-sm mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                                <button type="submit" class="w-full py-3 bg-[#FFA07A] text-white font-bold rounded-lg shadow hover:bg-[#ffb48a] transition">Submit Reservation</button>
                            </form>
                            <div class="mt-6 text-center text-[#706f6c] text-sm">
                                After submitting, please wait for a phone call to confirm or deny your reservation.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
