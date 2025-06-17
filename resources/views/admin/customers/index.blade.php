@extends('layouts.admin')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Customers</h1>
        <a href="{{ route('admin.customers.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Add Customer</a>
    </div>
    <div class="relative overflow-x-auto">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3">ID</th>
                    <th scope="col" class="px-6 py-3">Name</th>
                    <th scope="col" class="px-6 py-3">Email</th>
                    <th scope="col" class="px-6 py-3">Phone</th>
                    <th scope="col" class="px-6 py-3 text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($customers as $customer)
                    <tr class="bg-white border-b border-gray-200">
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">{{ $customer->id }}</td>
                        <td class="px-6 py-4">{{ $customer->name }}</td>
                        <td class="px-6 py-4">{{ $customer->email }}</td>
                        <td class="px-6 py-4">{{ $customer->phone }}</td>
                        <td class="px-6 py-4 text-center">
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
    </div>
    @if(method_exists($customers, 'links'))
        <div class="mt-4 flex justify-center">
            {{ $customers->links() }}
        </div>
    @endif
@endsection
