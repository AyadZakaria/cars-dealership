@extends('layouts.admin')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Customers</h1>
        <a href="{{ route('admin.customers.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Add Customer</a>
    </div>
    <table class="min-w-full bg-white shadow rounded">
        <thead>
            <tr>
                <th class="py-2 px-4 border-b">ID</th>
                <th class="py-2 px-4 border-b">Name</th>
                <th class="py-2 px-4 border-b">Email</th>
                <th class="py-2 px-4 border-b">Phone</th>
                <th class="py-2 px-4 border-b">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($customers as $customer)
                <tr>
                    <td class="py-2 px-4 border-b">{{ $customer->id }}</td>
                    <td class="py-2 px-4 border-b">{{ $customer->name }}</td>
                    <td class="py-2 px-4 border-b">{{ $customer->email }}</td>
                    <td class="py-2 px-4 border-b">{{ $customer->phone }}</td>
                    <td class="py-2 px-4 border-b">
                        <a href="{{ route('admin.customers.show', $customer) }}" class="text-blue-600 hover:underline">View</a>
                        <a href="{{ route('admin.customers.edit', $customer) }}" class="text-yellow-600 hover:underline ml-2">Edit</a>
                        <form action="{{ route('admin.customers.destroy', $customer) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline ml-2" onclick="return confirm('Delete this customer?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
