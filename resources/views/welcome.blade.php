<x-guest-layout>
    <x-navbar :cars="$cars" />
    <div class="bg-[#FDFDFC] min-h-screen py-12 px-4 flex flex-col items-center">
        <!-- Promo Banner -->
        <div class="w-full max-w-7xl mb-10">
            <div
                class="relative rounded-2xl overflow-hidden bg-gradient-to-r from-[#FFA07A] via-[#FFDAB9] to-[#87CEFA] shadow-lg p-6 flex flex-col md:flex-row items-center justify-between gap-6">
                <div class="flex-1">
                    <h2 class="text-3xl md:text-4xl font-bold text-[#1b1b18] mb-2 drop-shadow">Drive Your Dream Car
                        Today!</h2>
                    <p class="text-[#1b1b18] text-lg mb-4">Discover the best deals for buying or renting top cars. Fast,
                        easy, and secure. Start your journey with us!</p>
                    <a href="#cars"
                        class="inline-block px-6 py-3 bg-[#FFA07A] text-white font-semibold rounded-lg shadow hover:bg-[#ffb48a] transition">Browse
                        Cars</a>
                </div>
                <div class="flex-shrink-0">
                    <svg width="120" height="80" viewBox="0 0 120 80" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <rect x="10" y="30" width="100" height="30" rx="15" fill="#fff"
                            fill-opacity="0.7" />
                        <rect x="25" y="20" width="70" height="20" rx="10" fill="#fff"
                            fill-opacity="0.9" />
                        <circle cx="35" cy="65" r="10" fill="#FFA07A" />
                        <circle cx="85" cy="65" r="10" fill="#87CEFA" />
                        <rect x="40" y="35" width="40" height="10" rx="5" fill="#FFDAB9" />
                    </svg>
                </div>
            </div>
        </div>
        <h1 class="text-4xl font-bold mb-8 text-[#1b1b18] tracking-tight">Our Cars</h1>
        <div id="cars" class="grid grid-cols-1 sm:grid-cols-3 lg:grid-cols-4 gap-8 w-full max-w-full px-20">
            @forelse($cars as $car)
                <div
                    class="bg-white rounded-2xl shadow-lg border border-[#e3e3e0] overflow-hidden flex flex-col transition-transform hover:-translate-y-2 hover:shadow-2xl">
                    @if ($car->image_url)
                        <img src="{{ $car->image_url }}" alt="{{ $car->brand }} {{ $car->model }}"
                            class="w-full h-56 object-cover">
                    @else
                        <div class="w-full h-56 bg-[#dbdbd7] flex items-center justify-center text-2xl text-[#706f6c]">
                            No Image
                        </div>
                    @endif
                    <div class="p-6 flex-1 flex flex-col">
                        <h2 class="text-2xl font-semibold mb-2 text-[#1b1b18]">{{ $car->brand }} {{ $car->model }}
                        </h2>
                        <div class="flex items-center mb-4 text-[#706f6c]">
                            <span class="mr-4"><strong>Year:</strong> {{ $car->year }}</span>
                            <span><strong>Type:</strong> {{ ucfirst($car->fuel_type) }}</span>
                        </div>
                        <div class="flex-1"></div>
                        <div class="flex items-center justify-between mt-4">
                            @php
                                $isForSale = $car->availability === 'for_sale' || $car->availability === 'both';
                                $isForRent = $car->availability === 'for_rent' || $car->availability === 'both';
                            @endphp

                            @if ($isForSale && $car->in_service)
                                <div class="mb-2">
                                    <span
                                        class="inline-block px-3 py-1 bg-[#FFA07A] text-white rounded-full text-xs font-semibold mb-1">Available
                                        for Sell</span>
                                    <div class="text-[#1b1b18] text-base">Price: <span
                                            class="font-bold">${{ number_format($car->price, 2) }}</span></div>
                                </div>
                            @endif
                            @if ($isForRent && $car->in_service)
                                <div>
                                    <span
                                        class="inline-block px-3 py-1 bg-[#87CEFA] text-white rounded-full text-xs font-semibold mb-1">Available
                                        for Loan</span>
                                    <div class="text-[#1b1b18] text-base"><span
                                            class="font-bold">${{ number_format($car->price, 2) }}</span>/day</div>
                                </div>
                            @endif
                            @if (!$isForSale && !$isForRent)
                                <div class="text-[#706f6c] text-base">Not available for purchase or loan</div>
                            @endif
                            <a href="{{ route('car.details', ['uuid' => $car->uuid]) }}"
                                class="inline-block px-5 py-2 bg-[#FFA07A] text-white rounded-lg font-medium shadow hover:bg-[#ffb48a] transition mt-2">View
                                Details</a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center text-[#706f6c] text-lg">No cars available at the moment.</div>
            @endforelse
        </div>
        <div class="mt-8 flex justify-center">
            {{ $cars->links() }}
        </div>
    </div>
</x-guest-layout>
