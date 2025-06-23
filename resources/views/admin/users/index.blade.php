@extends('layouts.admin')

@section('content')
    <div x-data="userCrudModals()" x-init="init()">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">Users</h1>
            <button @click="openCreate = true"
                class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 focus:outline-none">Add User</button>
        </div>
        <!-- Create User Modal -->
        <div x-show="openCreate" class="fixed inset-0 flex items-center justify-center z-50" style="display: none;" x-cloak>
            <div class="absolute inset-0 bg-black opacity-50" @click="openCreate = false"></div>
            <div class="bg-white rounded-lg shadow-lg w-full max-w-md z-10 p-6">
                <h2 class="text-xl font-bold mb-4">Create User</h2>
                <form method="POST" autocomplete="nope" action="{{ route('admin.users.store') }}">
                    @csrf
                    <div class="mb-4">
                        <label class="block text-gray-700 mb-1" for="name">Name</label>
                        <input type="text" name="name" id="name" class="w-full border rounded px-3 py-2"
                            required>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 mb-1" for="email">Email</label>
                        <input type="email" name="email" id="email" class="w-full border rounded px-3 py-2"
                            required>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 mb-1" for="password">Password</label>
                        <input type="password" name="password" id="password" class="w-full border rounded px-3 py-2"
                            required>
                    </div>
                    <div class="flex items-center ps-4 border border-gray-200 rounded-sm mb-4">
                        <input type="checkbox" value="1" {{ old('is_admin') ? 'checked' : '' }} name="is_admin"
                            id="is_admin"
                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 focus:ring-2">
                        <label for="is_admin" class="w-full py-4 ms-2 text-sm font-medium text-gray-900">Is admin</label>
                    </div>
                    <div class="flex justify-end">
                        <button type="button" @click="openCreate = false"
                            class="mr-2 px-4 py-2 rounded bg-gray-200 hover:bg-gray-300">Cancel</button>
                        <button type="submit"
                            class="px-4 py-2 rounded bg-blue-600 text-white hover:bg-blue-700">Create</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- View User Modal -->
        <div x-show="openView" class="fixed inset-0 flex items-center justify-center z-50" style="display: none;" x-cloak>
            <div class="absolute inset-0 bg-black opacity-50" @click="openView = false"></div>
            <div class="bg-white rounded-lg shadow-lg w-full max-w-md z-10 p-6">
                <h2 class="text-xl font-bold mb-4">User Details</h2>
                <div class="mb-2"><span class="font-semibold">ID:</span> <span x-text="selectedUser.id"></span></div>
                <div class="mb-2"><span class="font-semibold">Name:</span> <span x-text="selectedUser.name"></span></div>
                <div class="mb-2"><span class="font-semibold">Email:</span> <span x-text="selectedUser.email"></span>
                </div>
                <div class="mb-2"><span class="font-semibold">Admin:</span> <span
                        x-text="selectedUser.is_admin ? 'Yes' : 'No'"></span></div>
                <div class="flex justify-end mt-4">
                    <button type="button" @click="openView = false"
                        class="px-4 py-2 rounded bg-gray-200 hover:bg-gray-300">Close</button>
                </div>
            </div>
        </div>
        <!-- Edit User Modal -->
        <div x-show="openEdit" class="fixed inset-0 flex items-center justify-center z-50" style="display: none;" x-cloak>
            <div class="absolute inset-0 bg-black opacity-50" @click="openEdit = false"></div>
            <div class="bg-white rounded-lg shadow-lg w-full max-w-md z-10 p-6">
                <h2 class="text-xl font-bold mb-4">Edit User</h2>
                <form :action="'/admin/users/' + selectedUser.id" method="POST" @submit="fixCheckbox">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <label class="block text-gray-700 mb-1" for="edit_name">Name</label>
                        <input type="text" name="name" id="edit_name" class="w-full border rounded px-3 py-2"
                            x-model="selectedUser.name" required>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 mb-1" for="edit_email">Email</label>
                        <input type="email" name="email" id="edit_email" class="w-full border rounded px-3 py-2"
                            x-model="selectedUser.email" required>
                    </div>
                    <div class="flex items-center ps-4 border border-gray-200 rounded-sm mb-4">
                        <input type="hidden" name="is_admin" value="0">
                        <input type="checkbox" value="1" name="is_admin" id="edit_is_admin"
                            x-model="selectedUser.is_admin" :checked="selectedUser.is_admin"
                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 focus:ring-2">
                        <label for="edit_is_admin" class="w-full py-4 ms-2 text-sm font-medium text-gray-900">Is admin</label>
                    </div>

                    <div class="flex justify-end">
                        <button type="button" @click="openEdit = false"
                            class="mr-2 px-4 py-2 rounded bg-gray-200 hover:bg-gray-300">Cancel</button>
                        <button type="submit"
                            class="px-4 py-2 rounded bg-yellow-600 text-white hover:bg-yellow-700">Save</button>
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
                        <th scope="col" class="px-6 py-3">Admin</th>
                        <th scope="col" class="px-6 py-3 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr class="bg-white border-b border-gray-200">
                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">{{ $user->id }}</td>
                            <td class="px-6 py-4">{{ $user->name }}</td>
                            <td class="px-6 py-4">{{ $user->email }}</td>
                            <td class="px-6 py-4">
                                @if ($user->is_admin)
                                    <span class="text-green-600 font-semibold">Yes</span>
                                @else
                                    <span class="text-gray-500">No</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-center">
                                <button class="text-blue-600 hover:underline" type="button"
                                    @click="openViewModal({ 
                                    id: {{ $user->id }},
                                    name: '{{ addslashes($user->name) }}',
                                    email: '{{ addslashes($user->email) }}',
                                    is_admin: {{ $user->is_admin ? 'true' : 'false' }}
                                })">View</button>
                                <button class="text-yellow-600 hover:underline ml-2" type="button"
                                    @click="openEditModal({ 
                                    id: {{ $user->id }},
                                    name: '{{ addslashes($user->name) }}',
                                    email: '{{ addslashes($user->email) }}',
                                    is_admin: {{ $user->is_admin ? 'true' : 'false' }}
                                })">Edit</button>
                                <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline ml-2"
                                        onclick="return confirm('Delete this user?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @if (method_exists($users, 'links'))
            <div class="mt-4 flex justify-center">
                {{ $users->links() }}
            </div>
        @endif
    </div>
    <script>
        function userCrudModals() {
            return {
                openCreate: false,
                openEdit: false,
                openView: false,
                selectedUser: {
                    id: null,
                    name: '',
                    email: '',
                    is_admin: false
                },
                openEditModal(user) {
                    this.selectedUser = {
                        ...user
                    };
                    this.openEdit = true;
                    this.openView = false;
                },
                openViewModal(user) {
                    this.selectedUser = {
                        ...user
                    };
                    this.openView = true;
                    this.openEdit = false;
                },
                fixCheckbox(e) {
                    // Ensure the checkbox value is sent as 1/0
                    if (!this.selectedUser.is_admin) {
                        document.getElementById('edit_is_admin').checked = false;
                    }
                },
                init() {
                    // For future extensibility
                }
            }
        }
    </script>
@endsection
