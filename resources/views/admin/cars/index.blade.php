@extends('layouts.admin')

@section('content')
    <div x-data="carCrudModals()" x-init="init()">
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
                    <div class="flex flex-wrap gap-4">
                        <div class="w-full md:w-[48%] mb-4">
                            <label class="block mb-1 font-semibold">Brand <span class="text-red-500">*</span></label>
                            <input type="text" name="brand"
                                class="w-full border px-3 py-2 rounded @error('brand') border-red-500 @enderror"
                                value="{{ old('brand') }}" required>
                            @error('brand')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="w-full md:w-[48%] mb-4">
                            <label class="block mb-1 font-semibold">Model <span class="text-red-500">*</span></label>
                            <input type="text" name="model"
                                class="w-full border px-3 py-2 rounded @error('model') border-red-500 @enderror"
                                value="{{ old('model') }}" required>
                            @error('model')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="w-full md:w-[48%] mb-4">
                            <label class="block mb-1 font-semibold">Year <span class="text-red-500">*</span></label>
                            <input type="number" name="year"
                                class="w-full border px-3 py-2 rounded @error('year') border-red-500 @enderror"
                                value="{{ old('year') }}" required min="1900" max="{{ date('Y') + 1 }}">
                            @error('year')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="w-full md:w-[48%] mb-4">
                            <label class="block mb-1 font-semibold">Price <span class="text-red-500">*</span></label>
                            <input type="number" name="price"
                                class="w-full border px-3 py-2 rounded @error('price') border-red-500 @enderror"
                                value="{{ old('price') }}" required step="0.01" min="0">
                            @error('price')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="w-full md:w-[48%] mb-4">
                            <label class="block mb-1 font-semibold">Availability <span class="text-red-500">*</span></label>
                            <select name="availability"
                                class="w-full border px-3 py-2 rounded @error('availability') border-red-500 @enderror"
                                required>
                                <option value="">Select...</option>
                                <option value="for_rent" {{ old('availability') == 'for_rent' ? 'selected' : '' }}>For Rent
                                </option>
                                <option value="for_sale" {{ old('availability') == 'for_sale' ? 'selected' : '' }}>For Sale
                                </option>
                            </select>
                            @error('availability')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="w-full md:w-[48%] mb-4">
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
                        <div class="w-full md:w-[48%] mb-4">
                            <label class="block mb-1 font-semibold">Car Image</label>
                            <input type="file" name="image" accept="image/*"
                                class="w-full border px-3 py-2 rounded @error('image') border-red-500 @enderror">
                            @error('image')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="w-full md:w-[48%] mb-4">
                            <label class="block mb-1 font-semibold">Mileage</label>
                            <input type="number" name="mileage"
                                class="w-full border px-3 py-2 rounded @error('mileage') border-red-500 @enderror"
                                min="0" value="{{ old('mileage', 0) }}">
                            @error('mileage')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="w-full md:w-[48%] flex items-center ps-4 border border-gray-200 rounded-sm mb-4">
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
                                    brand: '{{ addslashes($car->brand) }}',
                                    model: '{{ addslashes($car->model) }}',
                                    year: {{ $car->year }},
                                    price: {{ $car->price }},
                                    availability: '{{ $car->availability }}',
                                    fuel_type: '{{ $car->fuel_type }}',
                                    image_url: '{{ $car->image_url ?? '' }}',
                                    mileage: {{ $car->mileage ?? 0 }},
                                    in_service: {{ $car->in_service ? 'true' : 'false' }}
                                })">View</button>
                                <button class="text-yellow-600 hover:underline ml-2" type="button"
                                    @click="openEditModal({ 
                                    id: {{ $car->id }},
                                    brand: '{{ addslashes($car->brand) }}',
                                    model: '{{ addslashes($car->model) }}',
                                    year: {{ $car->year }},
                                    price: {{ $car->price }},
                                    availability: '{{ $car->availability }}',
                                    fuel_type: '{{ $car->fuel_type }}',
                                    image_url: '{{ $car->image_url ?? '' }}',
                                    mileage: {{ $car->mileage ?? 0 }},
                                    in_service: {{ $car->in_service ? 'true' : 'false' }}
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
        @if (method_exists($cars, 'links'))
            <div class="mt-4 flex justify-center">
                {{ $cars->links() }}
            </div>
        @endif
        <!-- View Car Modal -->
        <div x-show="openView" style="display: none;" class="fixed inset-0 z-50 flex items-center justify-center"
            x-cloak>
            <div class="absolute inset-0 bg-black opacity-40" @click="openView = false"></div>
            <div class="bg-white rounded-lg shadow-lg w-full max-w-2xl p-8 relative z-10">
                <button @click="openView = false"
                    class="absolute top-2 right-2 text-gray-400 hover:text-gray-600 text-2xl">&times;</button>
                <h2 class="text-xl font-bold mb-4">Car Details</h2>
                <div class="mb-2"><span class="font-semibold">Brand:</span> <span x-text="selectedCar.brand"></span>
                </div>
                <div class="mb-2"><span class="font-semibold">Model:</span> <span x-text="selectedCar.model"></span>
                </div>
                <div class="mb-2"><span class="font-semibold">Year:</span> <span x-text="selectedCar.year"></span>
                </div>
                <div class="mb-2"><span class="font-semibold">Price:</span> <span x-text="selectedCar.price"></span>
                </div>
                <div class="mb-2"><span class="font-semibold">Availability:</span> <span
                        x-text="selectedCar.availability"></span></div>
                <div class="mb-2"><span class="font-semibold">Fuel Type:</span> <span
                        x-text="selectedCar.fuel_type"></span></div>
                <div class="mb-2"><span class="font-semibold">Mileage:</span> <span
                        x-text="selectedCar.mileage"></span></div>
                <div class="mb-2"><span class="font-semibold">In Service:</span> <span
                        x-text="selectedCar.in_service ? 'Yes' : 'No'"></span></div>
                <template x-if="selectedCar.image_url">
                    <div class="mt-2">
                        <span class="block text-sm text-gray-600 mb-1">Image:</span>
                        <img :src="selectedCar.image_url" alt="Car Image" class="max-w-xs rounded mb-2">
                    </div>
                </template>
                <div class="flex justify-end mt-4">
                    <button type="button" @click="openView = false"
                        class="px-4 py-2 rounded bg-gray-200 hover:bg-gray-300">Close</button>
                </div>
            </div>
        </div>
        <!-- Edit Car Modal -->
        <div x-show="openEdit" style="display: none;" class="fixed inset-0 z-50 flex items-center justify-center"
            x-cloak>
            <div class="absolute inset-0 bg-black opacity-40" @click="openEdit = false"></div>
            <div class="bg-white rounded-lg shadow-lg w-full max-w-3xl p-8 relative z-10">
                <button @click="openEdit = false"
                    class="absolute top-2 right-2 text-gray-400 hover:text-gray-600 text-2xl">&times;</button>
                <h2 class="text-xl font-bold mb-4">Edit Car</h2>
                <form :action="'/admin/cars/' + selectedCar.id" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="flex flex-wrap gap-4">
                        <div class="w-full md:w-[48%] mb-4">
                            <label class="block mb-1 font-semibold">Brand <span class="text-red-500">*</span></label>
                            <input type="text" name="brand" class="w-full border px-3 py-2 rounded"
                                x-model="selectedCar.brand" required>
                        </div>
                        <div class="w-full md:w-[48%] mb-4">
                            <label class="block mb-1 font-semibold">Model <span class="text-red-500">*</span></label>
                            <input type="text" name="model" class="w-full border px-3 py-2 rounded"
                                x-model="selectedCar.model" required>
                        </div>
                        <div class="w-full md:w-[48%] mb-4">
                            <label class="block mb-1 font-semibold">Year <span class="text-red-500">*</span></label>
                            <input type="number" name="year" class="w-full border px-3 py-2 rounded"
                                x-model="selectedCar.year" required min="1900" max="{{ date('Y') + 1 }}">
                        </div>
                        <div class="w-full md:w-[48%] mb-4">
                            <label class="block mb-1 font-semibold">Price <span class="text-red-500">*</span></label>
                            <input type="number" name="price" class="w-full border px-3 py-2 rounded"
                                x-model="selectedCar.price" required step="0.01" min="0">
                        </div>
                        <div class="w-full md:w-[48%] mb-4">
                            <label class="block mb-1 font-semibold">Availability <span
                                    class="text-red-500">*</span></label>
                            <select name="availability" class="w-full border px-3 py-2 rounded"
                                x-model="selectedCar.availability" required>
                                <option value="">Select...</option>
                                <option value="for_rent">For Rent</option>
                                <option value="for_sale">For Sale</option>
                            </select>
                        </div>
                        <div class="w-full md:w-[48%] mb-4">
                            <label class="block mb-1 font-semibold">Fuel Type <span class="text-red-500">*</span></label>
                            <select name="fuel_type" class="w-full border px-3 py-2 rounded"
                                x-model="selectedCar.fuel_type" required>
                                <option value="">Select...</option>
                                <option value="petrol">Petrol</option>
                                <option value="diesel">Diesel</option>
                                <option value="electric">Electric</option>
                                <option value="hybrid">Hybrid</option>
                            </select>
                        </div>
                        <div class="w-full md:w-[48%] mb-4">
                            <label class="block mb-1 font-semibold">Car Image</label>
                            <input type="file" name="image" accept="image/*"
                                class="w-full border px-3 py-2 rounded" @change="previewEditImage($event)">
                            <template x-if="selectedCar.image_url">
                                <div class="mt-2">
                                    <span class="block text-sm text-gray-600 mb-1">Current Image:</span>
                                    <img :src="selectedCar.image_url" alt="Current Car Image"
                                        class="max-w-xs rounded mb-2">
                                </div>
                            </template>
                            <div id="editImagePreview" class="mt-2" style="display: none;">
                                <span class="block text-sm text-gray-600 mb-1">Preview:</span>
                                <img id="editPreview" src="" alt="Preview" class="max-w-xs rounded">
                            </div>
                        </div>
                        <div class="w-full md:w-[48%] mb-4">
                            <label class="block mb-1 font-semibold">Mileage</label>
                            <input type="number" name="mileage" class="w-full border px-3 py-2 rounded"
                                x-model="selectedCar.mileage" min="0">
                        </div>
                        <div class="w-full md:w-[48%] flex items-center ps-4 border border-gray-200 rounded-sm mb-4">
                            <input type="checkbox" value="1" name="in_service" id="edit_in_service"
                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 focus:ring-2"
                                x-model="selectedCar.in_service">
                            <label for="edit_in_service" class="w-full py-4 ms-2 text-sm font-medium text-gray-900">In
                                service</label>
                        </div>
                    </div>
                    <div class="flex justify-end">
                        <button type="submit"
                            class="bg-yellow-600 text-white px-4 py-2 rounded hover:bg-yellow-700">Save</button>
                        <button type="button" @click="openEdit = false"
                            class="ml-2 px-4 py-2 rounded border border-gray-300 text-gray-700 hover:bg-gray-100">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        function carCrudModals() {
            return {
                openCreate: false,
                openEdit: false,
                openView: false,
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
