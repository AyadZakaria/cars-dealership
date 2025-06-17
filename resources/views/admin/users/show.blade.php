@extends('layouts.admin')

@section('content')
    <h1 class="text-2xl font-bold mb-6">User Details</h1>
    <div class="bg-white p-6 rounded shadow-md max-w-lg">
        <div class="mb-4">
            <span class="font-semibold">ID:</span> {{ $user->id }}
        </div>
        <div class="mb-4">
            <span class="font-semibold">Name:</span> {{ $user->name }}
        </div>
        <div class="mb-4">
            <span class="font-semibold">Email:</span> {{ $user->email }}
        </div>
        <div class="mb-4">
            <span class="font-semibold">Admin:</span>
            @if($user->is_admin)
                <span class="text-green-600 font-semibold">Yes</span>
            @else
                <span class="text-gray-500">No</span>
            @endif
        </div>
        <a href="{{ route('admin.users.edit', $user) }}" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">Edit</a>
        <a href="{{ route('admin.users.index') }}" class="ml-4 text-gray-600 hover:underline">Back to List</a>
    </div>
@endsection
