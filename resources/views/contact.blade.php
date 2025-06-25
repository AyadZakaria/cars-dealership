@extends('layouts.guest')

@section('content')
<div class="max-w-xl mx-auto mt-12 mb-16 px-4">
    <h1 class="text-2xl font-semibold text-gray-800 mb-2">Contact Us</h1>
    <p class="text-gray-500 mb-8">Have a question or feedback? Fill out the form below and we'll get back to you soon.</p>

    @if(session('success'))
        <div class="mb-6 rounded bg-green-50 border border-green-200 text-green-700 px-4 py-3">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ route('contact') }}" class="space-y-6 bg-white p-6 rounded shadow-sm border border-gray-100">
        @csrf

        <div>
            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Name</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}"
                class="block w-full rounded border-gray-200 focus:border-blue-500 focus:ring-blue-500 text-gray-900 text-sm px-3 py-2"
                required>
            @error('name')
                <div class="text-xs text-red-500 mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}"
                class="block w-full rounded border-gray-200 focus:border-blue-500 focus:ring-blue-500 text-gray-900 text-sm px-3 py-2"
                required>
            @error('email')
                <div class="text-xs text-red-500 mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label for="message" class="block text-sm font-medium text-gray-700 mb-1">Message</label>
            <textarea id="message" name="message" rows="5"
                class="block w-full rounded border-gray-200 focus:border-blue-500 focus:ring-blue-500 text-gray-900 text-sm px-3 py-2 resize-none"
                required>{{ old('message') }}</textarea>
            @error('message')
                <div class="text-xs text-red-500 mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <button type="submit"
                class="w-full md:w-auto inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded px-6 py-2 transition-colors focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-offset-2">
                Send Message
            </button>
        </div>
    </form>
</div>
@endsection
