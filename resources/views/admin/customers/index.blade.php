@extends('layouts.admin')

@section('content')
<div x-data="customerCrudModals()" x-init="init()">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Customers</h1>
        <button @click="openCreate = true" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Add Customer</button>
    </div>
    <!-- Create Customer Modal -->
    <div x-show="openCreate" class="fixed inset-0 flex items-center justify-center z-50" style="display: none;" x-cloak>
        <div class="absolute inset-0 bg-black opacity-50" @click="openCreate = false"></div>
        <div class="bg-white rounded-lg shadow-lg w-full max-w-md z-10 p-6">
            <h2 class="text-xl font-bold mb-4">Create Customer</h2>
            <form method="POST" action="{{ route('admin.customers.store') }}">
                @csrf
                <div class="mb-4">
                    <label class="block text-gray-700 mb-1" for="name">Name</label>
                    <input type="text" name="name" id="name" class="w-full border rounded px-3 py-2" required>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 mb-1" for="email">Email</label>
                    <input type="email" name="email" id="email" class="w-full border rounded px-3 py-2" required>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 mb-1" for="phone">Phone</label>
                    <input type="text" name="phone" id="phone" class="w-full border rounded px-3 py-2" required>
                </div>
                <div class="flex justify-end">
                    <button type="button" @click="openCreate = false" class="mr-2 px-4 py-2 rounded bg-gray-200 hover:bg-gray-300">Cancel</button>
                    <button type="submit" class="px-4 py-2 rounded bg-blue-600 text-white hover:bg-blue-700">Create</button>
                </div>
            </form>
        </div>
    </div>
    <!-- View Customer Modal -->
    <div x-show="openView" class="fixed inset-0 flex items-center justify-center z-50" style="display: none;" x-cloak>
        <div class="absolute inset-0 bg-black opacity-50" @click="openView = false"></div>
        <div class="bg-white rounded-lg shadow-lg w-full max-w-md z-10 p-6">
            <h2 class="text-xl font-bold mb-4">Customer Details</h2>
            <div class="mb-2"><span class="font-semibold">ID:</span> <span x-text="selectedCustomer.id"></span></div>
            <div class="mb-2"><span class="font-semibold">Name:</span> <span x-text="selectedCustomer.name"></span></div>
            <div class="mb-2"><span class="font-semibold">Email:</span> <span x-text="selectedCustomer.email"></span></div>
            <div class="mb-2"><span class="font-semibold">Phone:</span> <span x-text="selectedCustomer.phone"></span></div>
            <div class="flex justify-end mt-4">
                <button type="button" @click="openView = false" class="px-4 py-2 rounded bg-gray-200 hover:bg-gray-300">Close</button>
            </div>
        </div>
    </div>
    <!-- Edit Customer Modal -->
    <div x-show="openEdit" class="fixed inset-0 flex items-center justify-center z-50" style="display: none;" x-cloak>
        <div class="absolute inset-0 bg-black opacity-50" @click="openEdit = false"></div>
        <div class="bg-white rounded-lg shadow-lg w-full max-w-md z-10 p-6">
            <h2 class="text-xl font-bold mb-4">Edit Customer</h2>
            <form :action="'/admin/customers/' + selectedCustomer.id" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label class="block text-gray-700 mb-1" for="edit_name">Name</label>
                    <input type="text" name="name" id="edit_name" class="w-full border rounded px-3 py-2" x-model="selectedCustomer.name" required>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 mb-1" for="edit_email">Email</label>
                    <input type="email" name="email" id="edit_email" class="w-full border rounded px-3 py-2" x-model="selectedCustomer.email" required>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 mb-1" for="edit_phone">Phone</label>
                    <input type="text" name="phone" id="edit_phone" class="w-full border rounded px-3 py-2" x-model="selectedCustomer.phone" required>
                </div>
                <div class="flex justify-end">
                    <button type="button" @click="openEdit = false" class="mr-2 px-4 py-2 rounded bg-gray-200 hover:bg-gray-300">Cancel</button>
                    <button type="submit" class="px-4 py-2 rounded bg-yellow-600 text-white hover:bg-yellow-700">Save</button>
                </div>
            </form>
        </div>
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
                            <button
                                class="text-blue-600 hover:underline"
                                type="button"
                                @click="openViewModal({ 
                                    id: {{ $customer->id }},
                                    name: '{{ addslashes($customer->name) }}',
                                    email: '{{ addslashes($customer->email) }}',
                                    phone: '{{ addslashes($customer->phone) }}'
                                })"
                            >View</button>
                            <button
                                class="text-yellow-600 hover:underline ml-2"
                                type="button"
                                @click="openEditModal({ 
                                    id: {{ $customer->id }},
                                    name: '{{ addslashes($customer->name) }}',
                                    email: '{{ addslashes($customer->email) }}',
                                    phone: '{{ addslashes($customer->phone) }}'
                                })"
                            >Edit</button>
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
<script>
function customerCrudModals() {
    return {
        openCreate: false,
        openEdit: false,
        openView: false,
        selectedCustomer: {
            id: null,
            name: '',
            email: '',
            phone: ''
        },
        openEditModal(customer) {
            this.selectedCustomer = { ...customer };
            this.openEdit = true;
            this.openView = false;
        },
        openViewModal(customer) {
            this.selectedCustomer = { ...customer };
            this.openView = true;
            this.openEdit = false;
        },
        init() {
            // For future extensibility
        }
    }
}
</script>
@endsection
