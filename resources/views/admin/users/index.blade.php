@extends('layouts.admin')

@section('content')
    <div x-data="{ open: false }" class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Users</h1>
        <button @click="open = true" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 focus:outline-none">Add User</button>
        <!-- Modal -->
        <div x-show="open" class="fixed inset-0 flex items-center justify-center z-50" style="display: none;">
            <div class="absolute inset-0 bg-black opacity-50" @click="open = false"></div>
            <div class="bg-white rounded-lg shadow-lg w-full max-w-md z-10 p-6">
                <h2 class="text-xl font-bold mb-4">Create User</h2>
                <form method="POST" action="{{ route('admin.users.store') }}">
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
                        <label class="block text-gray-700 mb-1" for="password">Password</label>
                        <input type="password" name="password" id="password" class="w-full border rounded px-3 py-2" required>
                    </div>
                    <div class="mb-4 flex items-center">
                        <input type="checkbox" name="is_admin" id="is_admin" class="mr-2">
                        <label for="is_admin" class="text-gray-700">Is Admin</label>
                    </div>
                    <div class="flex justify-end">
                        <button type="button" @click="open = false" class="mr-2 px-4 py-2 rounded bg-gray-200 hover:bg-gray-300">Cancel</button>
                        <button type="submit" class="px-4 py-2 rounded bg-blue-600 text-white hover:bg-blue-700">Create</button>
                    </div>
                </form>
            </div>
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
                @foreach($users as $user)
                    <tr class="bg-white border-b border-gray-200">
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">{{ $user->id }}</td>
                        <td class="px-6 py-4">{{ $user->name }}</td>
                        <td class="px-6 py-4">{{ $user->email }}</td>
                        <td class="px-6 py-4">
                            @if($user->is_admin)
                                <span class="text-green-600 font-semibold">Yes</span>
                            @else
                                <span class="text-gray-500">No</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-center">
                            <a href="{{ route('admin.users.show', $user) }}" class="text-blue-600 hover:underline">View</a>
                            <a href="{{ route('admin.users.edit', $user) }}" class="text-yellow-600 hover:underline ml-2">Edit</a>
                            <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline ml-2" onclick="return confirm('Delete this user?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @if(method_exists($users, 'links'))
        <div class="mt-4 flex justify-center">
            {{ $users->links() }}
        </div>
    @endif
@endsection
