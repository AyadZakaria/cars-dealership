@extends('layouts.admin')

@section('content')
    <h1 class="text-2xl font-bold mb-6">Edit User</h1>
    <form action="{{ route('admin.users.update', $user) }}" method="POST" class="bg-white p-6 rounded shadow-md max-w-lg">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label class="block mb-1 font-semibold">Name</label>
            <input type="text" name="name" class="w-full border px-3 py-2 rounded" value="{{ old('name', $user->name) }}" required>
        </div>
        <div class="mb-4">
            <label class="block mb-1 font-semibold">Email</label>
            <input type="email" name="email" class="w-full border px-3 py-2 rounded" value="{{ old('email', $user->email) }}" required>
        </div>
        <div class="mb-4">
            <label class="block mb-1 font-semibold">Password <span class="text-gray-500">(leave blank to keep current)</span></label>
            <input type="password" name="password" class="w-full border px-3 py-2 rounded">
        </div>
        <div class="mb-4 flex items-center">
            <input type="checkbox" name="is_admin" id="is_admin" class="mr-2" value="1" {{ old('is_admin', $user->is_admin) ? 'checked' : '' }}>
            <label for="is_admin" class="font-semibold">Is Admin</label>
        </div>
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Update</button>
        <a href="{{ route('admin.users.index') }}" class="ml-4 text-gray-600 hover:underline">Cancel</a>
    </form>
@endsection
