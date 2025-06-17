@extends('layouts.admin')

@section('content')
    <h1 class="text-2xl font-bold mb-6">Edit Customer</h1>
    <form action="{{ route('admin.customers.update', $customer) }}" method="POST" class="bg-white p-6 rounded shadow-md max-w-lg">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label class="block mb-1 font-semibold">Name</label>
            <input type="text" name="name" class="w-full border px-3 py-2 rounded" value="{{ old('name', $customer->name) }}" required>
        </div>
        <div class="mb-4">
            <label class="block mb-1 font-semibold">Email</label>
            <input type="email" name="email" class="w-full border px-3 py-2 rounded" value="{{ old('email', $customer->email) }}" required>
        </div>
        <div class="mb-4">
            <label class="block mb-1 font-semibold">Phone</label>
            <input type="text" name="phone" class="w-full border px-3 py-2 rounded" value="{{ old('phone', $customer->phone) }}" required>
        </div>
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Update</button>
        <a href="{{ route('admin.customers.index') }}" class="ml-4 text-gray-600 hover:underline">Cancel</a>
    </form>
@endsection
