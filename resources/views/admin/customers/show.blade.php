@extends('layouts.admin')

@section('content')
    <h1 class="text-2xl font-bold mb-6">Customer Details</h1>
    <div class="bg-white p-6 rounded shadow-md max-w-lg">
        <div class="mb-4">
            <span class="font-semibold">ID:</span> {{ $customer->id }}
        </div>
        <div class="mb-4">
            <span class="font-semibold">Name:</span> {{ $customer->name }}
        </div>
        <div class="mb-4">
            <span class="font-semibold">Email:</span> {{ $customer->email }}
        </div>
        <div class="mb-4">
            <span class="font-semibold">Phone:</span> {{ $customer->phone }}
        </div>
        <a href="{{ route('admin.customers.edit', $customer) }}" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">Edit</a>
        <a href="{{ route('admin.customers.index') }}" class="ml-4 text-gray-600 hover:underline">Back to List</a>
    </div>
@endsection
