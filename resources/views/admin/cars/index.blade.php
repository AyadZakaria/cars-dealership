@extends('layouts.admin')

@section('content')
    <div class="flex justify-between mb-6">
        <h1 class="text-2xl font-bold">Cars</h1>
        <a href="{{ route('admin.cars.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Add
            Car</a>
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
                            <a href="{{ route('admin.cars.show', $car) }}" class="text-blue-600 hover:underline">View</a>
                            <a href="{{ route('admin.cars.edit', $car) }}"
                                class="text-yellow-600 hover:underline ml-2">Edit</a>
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
    @if(method_exists($cars, 'links'))
        <div class="mt-4 flex justify-center">
            {{ $cars->links() }}
        </div>
    @endif
@endsection
