<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link rel="icon" type="image/svg+xml" href="/favicon.svg">
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
</head>

<body class="bg-gray-100 min-h-screen flex">
    <!-- Sidebar -->
    <aside class="w-64 bg-white shadow-md flex flex-col">
        <div class="p-6 border-b flex flex-col items-start gap-1">
            <x-application-logo class="w-32 h-8" />
            <span class="text-xs text-gray-500 italic">Admin Panel</span>
        </div>
        <nav class="flex-1 p-4">
            <ul class="space-y-2">
                
                <li>
                    <a href="{{ route('home') }}"
                        class="flex items-center gap-2 px-3 py-2 rounded text-gray-700 hover:bg-[#ffe5dc] hover:text-[#FFA07A]">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0h6"
                                stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        Back to Site
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.cars.index') }}"
                        class="flex items-center gap-2 px-3 py-2 rounded {{ request()->routeIs('admin.cars.*') ? 'bg-[#ffe5dc] text-[#FFA07A] font-semibold' : 'text-gray-700 hover:bg-[#ffe5dc] hover:text-[#FFA07A]' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path
                                d="M3 13l1.5-4.5A2 2 0 0 1 6.4 7h11.2a2 2 0 0 1 1.9 1.5L21 13M5 16v1a2 2 0 0 0 2 2h0a2 2 0 0 0 2-2v-1m6 0v1a2 2 0 0 0 2 2h0a2 2 0 0 0 2-2v-1M7 16h10M7 16a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm10 0a2 2 0 1 1 4 0 2 2 0 0 1-4 0z"
                                stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        Cars
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.users.index') }}"
                        class="flex items-center gap-2 px-3 py-2 rounded {{ request()->routeIs('admin.users.*') ? 'bg-[#ffe5dc] text-[#FFA07A] font-semibold' : 'text-gray-700 hover:bg-[#ffe5dc] hover:text-[#FFA07A]' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path
                                d="M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87M16 3.13a4 4 0 010 7.75M8 3.13a4 4 0 000 7.75"
                                stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        Users
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.customers.index') }}"
                        class="flex items-center gap-2 px-3 py-2 rounded {{ request()->routeIs('admin.customers.*') ? 'bg-[#ffe5dc] text-[#FFA07A] font-semibold' : 'text-gray-700 hover:bg-[#ffe5dc] hover:text-[#FFA07A]' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path
                                d="M5.121 17.804A13.937 13.937 0 0112 15c2.5 0 4.847.655 6.879 1.804M15 11a3 3 0 11-6 0 3 3 0 016 0z"
                                stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        Customers
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.reservations.index') }}"
                        class="flex items-center gap-2 px-3 py-2 rounded {{ request()->routeIs('admin.reservations.*') ? 'bg-[#ffe5dc] text-[#FFA07A] font-semibold' : 'text-gray-700 hover:bg-[#ffe5dc] hover:text-[#FFA07A]' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"
                                stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        Reservations
                    </a>
                </li>
            </ul>
        </nav>
    </aside>
    <!-- Main Content Area -->
    <div class="flex-1 flex flex-col min-h-screen">
        <!-- Header Bar -->
        <header class="bg-white shadow flex items-center justify-between px-8 py-4">
            <div class="text-lg font-semibold text-gray-700">Admin Dashboard</div>
            @auth
                <div class="flex items-center gap-6">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button
                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-700 bg-white hover:text-gray-500 focus:outline-none transition">
                                Actions
                                <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 111.06 1.06l-4.24 4.25a.75.75 0 01-1.06 0L5.21 8.29a.75.75 0 01.02-1.08z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>
                        </x-slot>
                        
                        <x-dropdown-link href="{{ route('profile.show') }}">
                            Profile
                        </x-dropdown-link>
                        @if (Auth::user()->is_admin)
                            <x-dropdown-link href="{{ route('admin.users.index') }}">
                                Admin Panel
                            </x-dropdown-link>
                        @endif
                        <x-dropdown-link href="{{ route('my-reservations') }}">
                            My Reservations
                        </x-dropdown-link>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="block w-full px-4 py-2 text-start text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out">
                                Logout
                            </button>
                        </form>
                    </x-dropdown>
                </div>
            @endauth
        </header>
        <!-- Main Content -->
        <main class="flex-1 p-8">
            <div class="bg-white rounded-lg shadow p-6">
                @yield('content')
            </div>
        </main>
    </div>

    {{-- Toastify notifications for session flashes --}}
    @if (session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Toastify({
                    text: @json(session('success')),
                    duration: 3000,
                    gravity: "top",
                    position: "right",
                    backgroundColor: "#22c55e",
                    stopOnFocus: true,
                }).showToast();
            });
        </script>
    @endif
    @if (session('error'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Toastify({
                    text: @json(session('error')),
                    duration: 3000,
                    gravity: "top",
                    position: "right",
                    backgroundColor: "#ef4444",
                    stopOnFocus: true,
                }).showToast();
            });
        </script>
    @endif
</body>

</html>
