@extends('layouts.admin')

@section('content')
    <div x-data="carCrudModals()" x-init="init()" x-init="createAvailability = '{{ old('availability', 'for_rent') }}';">
        <div class="flex justify-between mb-6">
            <h1 class="text-2xl font-bold">Cars</h1>
            <button @click="openCreate = true" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700"
                type="button">Add Car</button>
        </div>
        <!-- Create Car Modal -->
        <div x-show="openCreate" style="display: none;" class="fixed inset-0 z-50 flex items-center justify-center" x-cloak>
            <div class="absolute inset-0 bg-black opacity-40" @click="openCreate = false"></div>
            <div class="bg-white rounded-lg shadow-lg w-full max-w-2xl p-8 relative z-10">
                <button @click="openCreate = false"
                    class="absolute top-2 right-2 text-gray-400 hover:text-gray-600 text-2xl">&times;</button>
                <h2 class="text-xl font-bold mb-4">Add Car</h2>
                <form action="{{ route('admin.cars.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="grid grid-cols-2 gap-4">
                        {{-- car type --}}
                        {{-- brand --}}
                        <div class="mb-4">
                            <label class="block mb-1 font-semibold">Brand <span class="text-red-500">*</span></label>
                            <input type="text" name="brand"
                                class="w-full border px-3 py-2 rounded @error('brand') border-red-500 @enderror"
                                value="{{ old('brand') }}" required>
                            @error('brand')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- model --}}
                        <div class="mb-4">
                            <label class="block mb-1 font-semibold">Model <span class="text-red-500">*</span></label>
                            <input type="text" name="model"
                                class="w-full border px-3 py-2 rounded @error('model') border-red-500 @enderror"
                                value="{{ old('model') }}" required>
                            @error('model')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- year --}}
                        <div class="mb-4">
                            <label class="block mb-1 font-semibold">Year <span class="text-red-500">*</span></label>
                            <input type="number" name="year"
                                class="w-full border px-3 py-2 rounded @error('year') border-red-500 @enderror"
                                value="{{ old('year') }}" required min="1900" max="{{ date('Y') + 1 }}">
                            @error('year')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Availability Field -->
                        <div class="mb-4">
                            <label class="block mb-1 font-semibold">Availability <span class="text-red-500">*</span></label>
                            <select name="availability"
                                class="w-full border px-3 py-2 rounded @error('availability') border-red-500 @enderror"
                                x-model="createAvailability" required>
                                <option value="for_rent">For Rent</option>
                                <option value="for_sale">For Sale</option>
                            </select>
                            @error('availability')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Rent Price Field -->
                        <div class="mb-4" x-show="createAvailability === 'for_rent'">
                            <label class="block mb-1 font-semibold">Rent Price <span class="text-red-500">*</span></label>
                            <input type="number" name="price"
                                class="w-full border px-3 py-2 rounded @error('price') border-red-500 @enderror"
                                value="{{ old('price') }}" :required="createAvailability === 'for_rent'" step="1"
                                min="0">
                            @error('price')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Purchase Price Field -->
                        <div class="mb-4" x-show="createAvailability === 'for_sale'">
                            <label class="block mb-1 font-semibold">Purchase Price <span
                                    class="text-red-500">*</span></label>
                            <input type="number" name="purchase_price"
                                class="w-full border px-3 py-2 rounded @error('purchase_price') border-red-500 @enderror"
                                value="{{ old('purchase_price') }}" :required="createAvailability === 'for_sale'"
                                step="1" min="0">
                            @error('purchase_price')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="block mb-1 font-semibold">Fuel Type <span class="text-red-500">*</span></label>
                            <select name="fuel_type"
                                class="w-full border px-3 py-2 rounded @error('fuel_type') border-red-500 @enderror"
                                required>
                                <option value="">Select...</option>
                                <option value="petrol" {{ old('fuel_type') == 'petrol' ? 'selected' : '' }}>Petrol</option>
                                <option value="diesel" {{ old('fuel_type') == 'diesel' ? 'selected' : '' }}>Diesel</option>
                                <option value="electric" {{ old('fuel_type') == 'electric' ? 'selected' : '' }}>Electric
                                </option>
                                <option value="hybrid" {{ old('fuel_type') == 'hybrid' ? 'selected' : '' }}>Hybrid</option>
                            </select>
                            @error('fuel_type')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- image --}}
                        <div class="mb-4">
                            <label class="block mb-1 font-semibold">Car Image</label>
                            <input type="file" name="image" accept="image/*"
                                class="w-full border px-3 py-2 rounded @error('image') border-red-500 @enderror">
                            @error('image')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- mileage --}}
                        <div class="mb-4">
                            <label class="block mb-1 font-semibold">Mileage</label>
                            <input type="number" name="mileage"
                                class="w-full border px-3 py-2 rounded @error('mileage') border-red-500 @enderror"
                                min="0" value="{{ old('mileage', 0) }}">
                            @error('mileage')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- is in service --}}
                        <div class="flex items-center ps-4 border border-gray-200 rounded-sm mb-4">
                            <input type="checkbox" value="1" {{ old('in_service') ? 'checked' : '' }}
                                name="in_service" id="in_service"
                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 focus:ring-2">
                            <label for="in_service" class="w-full py-4 ms-2 text-sm font-medium text-gray-900">In
                                service</label>
                        </div>
                    </div>
                    <div class="flex justify-end">
                        <button type="submit"
                            class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Save</button>
                        <button type="button" @click="openCreate = false"
                            class="ml-2 px-4 py-2 rounded border border-gray-300 text-gray-700 hover:bg-gray-100">Cancel</button>
                    </div>
                </form>
            </div>
        </div>

        {{-- Car List --}}
        <div class="relative overflow-x-auto">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3">Brand</th>
                        <th scope="col" class="px-6 py-3">Model</th>
                        <th scope="col" class="px-6 py-3">Year</th>
                        <th scope="col" class="px-6 py-3 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cars as $car)
                        <tr class="bg-white border-b border-gray-200">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                {{ $car->brand }}
                            </th>
                            <td class="px-6 py-4">
                                {{ $car->model }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $car->year }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                <button class="text-blue-600 hover:underline" type="button"
                                    @click="openViewModal({ 
                                    id: {{ $car->id }},
                                    brand: '{{ addslashes($car->brand ?? '') }}',
                                    model: '{{ addslashes($car->model ?? '') }}',
                                    year: {{ isset($car->year) ? $car->year : 0 }},
                                    price: {{ isset($car->price) ? $car->price : 0 }},
                                    purchase_price: {{ isset($car->purchase_price) ? $car->purchase_price : 0 }},
                                    availability: '{{ $car->availability ?? '' }}',
                                    fuel_type: '{{ $car->fuel_type ?? '' }}',
                                    image_url: '{{ isset($car->image_url) ? $car->image_url : '' }}',
                                    mileage: {{ isset($car->mileage) ? $car->mileage : 0 }},
                                    in_service: {{ !!$car->in_service ? 'true' : 'false' }}
                                })">View</button>
                                <button class="text-yellow-600 hover:underline ml-2" type="button"
                                    @click="openEditModal({ 
                                    id: {{ $car->id }},
                                    brand: '{{ addslashes($car->brand ?? '') }}',
                                    model: '{{ addslashes($car->model ?? '') }}',
                                    year: {{ isset($car->year) ? $car->year : 0 }},
                                    price: {{ isset($car->price) ? $car->price : 0 }},
                                    purchase_price: {{ isset($car->purchase_price) ? $car->purchase_price : 0 }},
                                    availability: '{{ $car->availability ?? '' }}',
                                    fuel_type: '{{ $car->fuel_type ?? '' }}',
                                    image_url: '{{ isset($car->image_url) ? $car->image_url : '' }}',
                                    mileage: {{ isset($car->mileage) ? $car->mileage : 0 }},
                                    in_service: {{ !!$car->in_service ? 'true' : 'false' }}
                                })">Edit</button>
                                <form action="{{ route('admin.cars.destroy', $car) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline ml-2"
                                        onclick="return confirm('Delete this car?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if (method_exists($cars, 'links'))
            <div class="mt-4 flex justify-center">
                {{ $cars->links() }}
            </div>
        @endif
        <!-- View Car Modal -->
        <div x-show="openView" style="display: none;" class="fixed inset-0 z-50 flex items-center justify-center"
            x-cloak>
            <div class="absolute inset-0 bg-gradient-to-br from-gray-900/70 to-blue-900/60 backdrop-blur-sm"
                @click="openView = false"></div>
            <div class="relative z-10 w-full max-w-2xl">
                <div class="bg-white/90 rounded-2xl shadow-2xl border border-gray-200 p-0 overflow-hidden animate-fade-in">
                    <!-- Accent bar -->
                    <div class="h-2 bg-gradient-to-r from-blue-600 via-indigo-500 to-purple-500"></div>
                    <button @click="openView = false"
                        class="absolute top-4 right-4 text-gray-400 hover:text-red-500 text-3xl transition-colors duration-150"
                        aria-label="Close">&times;</button>
                    <div class="p-8 pt-6">
                        <div class="flex items-center gap-6 mb-6">
                            <template x-if="selectedCar.image_url">
                                <div>
                                    <img :src="selectedCar.image_url" alt="Car Image"
                                        class="w-32 h-32 object-cover rounded-xl shadow border border-gray-200 bg-gray-50" />
                                </div>
                            </template>
                            <div>
                                <h2 class="text-2xl font-extrabold text-gray-800 mb-1 flex items-center gap-2">
                                    <span x-text="selectedCar.brand"></span>
                                    <span x-text="selectedCar.model" class="font-semibold text-indigo-600"></span>
                                </h2>
                                <div class="flex items-center gap-2 mt-1">
                                    <span
                                        class="inline-block bg-blue-100 text-blue-700 text-xs font-semibold px-2 py-1 rounded-full"
                                        x-text="selectedCar.year"></span>
                                    <span class="inline-block"
                                        :class="selectedCar.availability === 'for_rent' ? 'bg-green-100 text-green-700' :
                                            'bg-yellow-100 text-yellow-700'"
                                        class="text-xs font-semibold px-2 py-1 rounded-full capitalize"
                                        x-text="selectedCar.availability === 'for_rent' ? 'For Rent' : 'For Sale'"></span>
                                    <span class="inline-block"
                                        :class="selectedCar.in_service ? 'bg-emerald-100 text-emerald-700' :
                                            'bg-gray-200 text-gray-600'"
                                        class="text-xs font-semibold px-2 py-1 rounded-full"
                                        x-text="selectedCar.in_service ? 'In Service' : 'Not in Service'"></span>
                                </div>
                            </div>
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-6">
                            <div>
                                <div class="text-xs text-gray-500 font-medium mb-1">
                                    <template x-if="selectedCar.availability === 'for_rent'">
                                        <span>Rent Price</span>
                                    </template>
                                    <template x-if="selectedCar.availability === 'for_sale'">
                                        <span>Purchase Price</span>
                                    </template>
                                </div>
                                <div class="text-lg font-semibold text-gray-800 mt-1">
                                    <template x-if="selectedCar.availability === 'for_rent'">
                                        <span>
                                            $ <span x-text="selectedCar.price"></span>
                                            <span class="text-xs text-gray-500">/ day</span>
                                        </span>
                                    </template>
                                    <template x-if="selectedCar.availability === 'for_sale'">
                                        <span>
                                            $ <span x-text="selectedCar.purchase_price"></span>
                                        </span>
                                    </template>
                                </div>
                            </div>
                            <div>
                                <div class="text-xs text-gray-500 font-medium mb-1">Fuel Type</div>
                                <div class="text-base font-semibold text-gray-700 capitalize mt-1"
                                    x-text="selectedCar.fuel_type"></div>
                            </div>
                            <div>
                                <div class="text-xs text-gray-500 font-medium mb-1">Mileage</div>
                                <div class="text-base font-semibold text-gray-700 mt-1">
                                    <span x-text="selectedCar.mileage"></span> MI
                                </div>
                            </div>
                            <div>
                                <div class="text-xs text-gray-500 font-medium mb-1">In Service</div>
                                <div class="text-base font-semibold text-gray-700 mt-1"
                                    x-text="selectedCar.in_service ? 'Yes' : 'No'"></div>
                            </div>
                        </div>
                        <div class="flex justify-end mt-10">
                            <button type="button" @click="openView = false"
                                class="px-6 py-2 rounded-lg bg-gradient-to-r from-blue-600 to-indigo-500 text-white font-semibold shadow hover:from-blue-700 hover:to-indigo-600 transition-all duration-150 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-offset-2">
                                Close
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Edit Car Modal -->
        <div x-show="openEdit" style="display: none;" class="fixed inset-0 z-50 flex items-center justify-center"
            x-cloak>
            <div class="absolute inset-0 bg-gradient-to-br from-gray-900/70 to-blue-900/60 backdrop-blur-sm"
                @click="openEdit = false"></div>
            <div class="relative z-10 w-full max-w-3xl">
                <div class="bg-white/90 rounded-2xl shadow-2xl border border-gray-200 p-0 overflow-hidden animate-fade-in">
                    <!-- Accent bar -->
                    <div class="h-2 bg-gradient-to-r from-yellow-400 via-yellow-500 to-yellow-600"></div>
                    <button @click="openEdit = false"
                        class="absolute top-4 right-4 text-gray-400 hover:text-red-500 text-3xl transition-colors duration-150"
                        aria-label="Close">&times;</button>
                    <div class="p-8 pt-6">
                        <h2 class="text-2xl font-extrabold text-gray-800 mb-6">Edit Car</h2>
                        <form :action="'/admin/cars/' + selectedCar.id" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-6">
                                <div>
                                    <label class="block mb-2 font-semibold">Brand <span
                                            class="text-red-500">*</span></label>
                                    <input type="text" name="brand" class="w-full border px-3 py-2 rounded-lg"
                                        x-model="selectedCar.brand" required>
                                </div>
                                <div>
                                    <label class="block mb-2 font-semibold">Model <span
                                            class="text-red-500">*</span></label>
                                    <input type="text" name="model" class="w-full border px-3 py-2 rounded-lg"
                                        x-model="selectedCar.model" required>
                                </div>
                                <div>
                                    <label class="block mb-2 font-semibold">Year <span
                                            class="text-red-500">*</span></label>
                                    <input type="number" name="year" class="w-full border px-3 py-2 rounded-lg"
                                        x-model="selectedCar.year" required min="1900" max="{{ date('Y') + 1 }}">
                                </div>
                                <div>
                                    <label class="block mb-2 font-semibold">Availability <span
                                            class="text-red-500">*</span></label>
                                    <select name="availability" class="w-full border px-3 py-2 rounded-lg"
                                        x-model="selectedCar.availability" required>
                                        <option value="">Select...</option>
                                        <option value="for_rent">For Rent</option>
                                        <option value="for_sale">For Sale</option>
                                    </select>
                                </div>
                                <div x-show="selectedCar.availability === 'for_rent'">
                                    <label class="block mb-2 font-semibold">Rent Price <span
                                            class="text-red-500">*</span></label>
                                    <input type="number" name="price" class="w-full border px-3 py-2 rounded-lg"
                                        x-model="selectedCar.price" :required="selectedCar.availability === 'for_rent'"
                                        step="1" min="0">
                                    @error('price')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div x-show="selectedCar.availability === 'for_sale'">
                                    <label class="block mb-2 font-semibold">Purchase Price <span
                                            class="text-red-500">*</span></label>
                                    <input type="number" name="purchase_price"
                                        class="w-full border px-3 py-2 rounded-lg" x-model="selectedCar.purchase_price"
                                        :required="selectedCar.availability === 'for_sale'" step="1"
                                        min="0">
                                    @error('purchase_price')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label class="block mb-2 font-semibold">Fuel Type <span
                                            class="text-red-500">*</span></label>
                                    <select name="fuel_type" class="w-full border px-3 py-2 rounded-lg"
                                        x-model="selectedCar.fuel_type" required>
                                        <option value="">Select...</option>
                                        <option value="petrol">Petrol</option>
                                        <option value="diesel">Diesel</option>
                                        <option value="electric">Electric</option>
                                        <option value="hybrid">Hybrid</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="block mb-2 font-semibold">Mileage</label>
                                    <input type="number" name="mileage" class="w-full border px-3 py-2 rounded-lg"
                                        x-model="selectedCar.mileage" min="0">
                                </div>
                                <div class="sm:col-span-2">
                                    <label class="block mb-2 font-semibold">Car Image</label>
                                    <div class="flex flex-col sm:flex-row sm:items-start gap-4">
                                        <div class="flex-1">
                                            <input type="file" name="image" accept="image/*"
                                                class="w-full border px-3 py-2 rounded-lg"
                                                @change="previewEditImage($event)">
                                        </div>
                                        <div class="flex flex-col items-center min-w-[140px] max-w-[180px]">
                                            <template x-if="selectedCar.image_url">
                                                <div class="mt-2 w-full">
                                                    <span class="block text-sm text-gray-600 mb-1">Current Image:</span>
                                                    <img :src="selectedCar.image_url" alt="Current Car Image"
                                                        class="w-full max-w-[160px] rounded-xl shadow border border-gray-200 bg-gray-50 mb-2">
                                                </div>
                                            </template>
                                            <div id="editImagePreview" class="mt-2 w-full" style="display: none;">
                                                <span class="block text-sm text-gray-600 mb-1">Preview:</span>
                                                <img id="editPreview" src="" alt="Preview"
                                                    class="w-full max-w-[160px] rounded-xl">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div
                                    class="sm:col-span-2 flex items-center border border-gray-200 rounded-lg px-4 py-2 mt-2">
                                    <input type="checkbox" value="1" name="in_service" id="edit_in_service"
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2"
                                        x-model="selectedCar.in_service">
                                    <label for="edit_in_service" class="ml-2 text-sm font-medium text-gray-900">In
                                        service</label>
                                </div>
                            </div>
                            <div class="flex justify-end mt-8">
                                <button type="submit"
                                    class="px-6 py-2 rounded-lg bg-gradient-to-r from-yellow-500 to-yellow-600 text-white font-semibold shadow hover:from-yellow-600 hover:to-yellow-700 transition-all duration-150 focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:ring-offset-2">
                                    Save
                                </button>
                                <button type="button" @click="openEdit = false"
                                    class="ml-3 px-6 py-2 rounded-lg border border-gray-300 text-gray-700 bg-white hover:bg-gray-100 font-semibold shadow transition-all duration-150 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-2">
                                    Cancel
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function carCrudModals() {
            return {
                openCreate: false,
                openEdit: false,
                openView: false,
                createAvailability: '{{ old('availability', 'for_rent') }}',
                selectedCar: {
                    id: null,
                    brand: '',
                    model: '',
                    year: '',
                    price: '',
                    availability: '',
                    fuel_type: '',
                    image_url: '',
                    mileage: 0,
                    in_service: false
                },
                openEditModal(car) {
                    this.selectedCar = {
                        ...car
                    };
                    this.openEdit = true;
                    this.openView = false;
                    // Reset preview
                    const preview = document.getElementById('editPreview');
                    if (preview) {
                        preview.src = '';
                        document.getElementById('editImagePreview').style.display = 'none';
                    }
                },
                openViewModal(car) {
                    this.selectedCar = {
                        ...car
                    };
                    this.openView = true;
                    this.openEdit = false;
                },
                previewEditImage(event) {
                    const input = event.target;
                    const preview = document.getElementById('editPreview');
                    const previewDiv = document.getElementById('editImagePreview');
                    if (input.files && input.files[0]) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            preview.src = e.target.result;
                            previewDiv.style.display = 'block';
                        };
                        reader.readAsDataURL(input.files[0]);
                    } else {
                        preview.src = '';
                        previewDiv.style.display = 'none';
                    }
                },
                init() {
                    // For future extensibility
                }
            }
        }
    </script>
@endsection
