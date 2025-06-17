@extends('layouts.admin')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Cars</h1>
        <a href="{{ route('admin.cars.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Add Car</a>
    </div>
    <table class="min-w-full bg-white shadow rounded">
        <thead>
            <tr>
                <th class="py-2 px-4 border-b">ID</th>
                <th class="py-2 px-4 border-b">Make</th>
                <th class="py-2 px-4 border-b">Model</th>
                <th class="py-2 px-4 border-b">Year</th>
                <th class="py-2 px-4 border-b">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($cars as $car)
                <tr>
                    <td class="py-2 px-4 border-b">{{ $car->id }}</td>
                    <td class="py-2 px-4 border-b">{{ $car->make }}</td>
                    <td class="py-2 px-4 border-b">{{ $car->model }}</td>
                    <td class="py-2 px-4 border-b">{{ $car->year }}</td>
                    <td class="py-2 px-4 border-b">
                        <a href="{{ route('admin.cars.show', $car) }}" class="text-blue-600 hover:underline">View</a>
                        <a href="{{ route('admin.cars.edit', $car) }}" class="text-yellow-600 hover:underline ml-2">Edit</a>
                        <form action="{{ route('admin.cars.destroy', $car) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline ml-2" onclick="return confirm('Delete this car?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
