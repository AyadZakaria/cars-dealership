<x-guest-layout>
    <x-navbar :cars="$cars" />
    <div class=" min-h-screen py-16 px-4 flex flex-col items-center">
        <!-- Minimal Promo Banner -->
        <div class="w-full max-w-3xl mb-12 text-center">
            <h2 class="text-4xl md:text-5xl font-extrabold text-gray-900 mb-4 tracking-tight">Drive Your Dream Car</h2>
            <p class="text-gray-600 text-lg mb-6">Discover the best deals for buying or renting top cars. Fast, easy, and secure.</p>
            <a href="#cars"
                class="inline-block px-8 py-3 border border-blue-500 text-blue-500 font-semibold rounded-lg bg-white hover:bg-blue-500 hover:text-white transition">Browse Cars</a>
        </div>
        <h1 class="text-3xl font-bold mb-8 text-gray-900 tracking-tight">Our Cars</h1>
        <div id="cars" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 w-full max-w-6xl">
            @forelse($cars as $car)
                <div class="bg-white rounded-xl border border-gray-200 overflow-hidden flex flex-col hover:shadow-md transition">
                    @if ($car->image_url)
                        <img src="{{ $car->image_url }}" alt="{{ $car->brand }} {{ $car->model }}"
                            class="w-full h-48 object-cover">
                    @else
                        <div class="w-full h-48 bg-gray-100 flex items-center justify-center">
                            <!-- Default car SVG icon -->
                            <svg width="64" height="40" viewBox="0 0 64 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <rect x="8" y="18" width="48" height="12" rx="6" fill="#3B82F6"/>
                                <rect x="16" y="10" width="32" height="12" rx="6" fill="#60A5FA"/>
                                <circle cx="20" cy="34" r="4" fill="#3B82F6"/>
                                <circle cx="44" cy="34" r="4" fill="#3B82F6"/>
                                <rect x="24" y="20" width="16" height="4" rx="2" fill="#BFDBFE"/>
                            </svg>
                        </div>
                    @endif
                    <div class="p-5 flex-1 flex flex-col">
                        <h2 class="text-xl font-semibold mb-1 text-gray-900">{{ $car->brand }} {{ $car->model }}</h2>
                        <div class="flex items-center mb-3 text-gray-500 text-sm">
                            <span class="mr-4"><strong>Year:</strong> {{ $car->year }}</span>
                            <span><strong>Type:</strong> {{ ucfirst($car->fuel_type) }}</span>
                        </div>
                        <div class="flex-1"></div>
                        <div class="flex flex-col gap-2 mt-4">
                            @php
                                $isForSale = $car->availability === 'for_sale' || $car->availability === 'both';
                                $isForRent = $car->availability === 'for_rent' || $car->availability === 'both';
                            @endphp

                            @if ($isForSale && $car->in_service)
                                <div>
                                    <span class="inline-block px-2 py-0.5 bg-blue-100 text-blue-700 rounded text-xs font-medium">For Sale</span>
                                    <div class="text-gray-900 text-base">Price: <span class="font-bold">${{ number_format($car->price, 2) }}</span></div>
                                </div>
                            @endif
                            @if ($isForRent && $car->in_service)
                                <div>
                                    <span class="inline-block px-2 py-0.5 bg-blue-100 text-blue-700 rounded text-xs font-medium">For Rent</span>
                                    <div class="text-gray-900 text-base"><span class="font-bold">${{ number_format($car->price, 2) }}</span>/day</div>
                                </div>
                            @endif
                            @if (!$isForSale && !$isForRent)
                                <div class="text-gray-400 text-base">Not available</div>
                            @endif
                            <a href="{{ route('car.details', ['uuid' => $car->uuid]) }}"
                                class="inline-block px-5 py-2 border border-blue-500 text-blue-500 rounded-lg font-medium bg-white hover:bg-blue-500 hover:text-white transition mt-2 text-center">View Details</a>
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
