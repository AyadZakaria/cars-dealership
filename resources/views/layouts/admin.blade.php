<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    @vite('resources/css/app.css')
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-gray-100 min-h-screen flex">
    <!-- Sidebar -->
    <aside class="w-64 bg-white shadow-md flex flex-col">
        <div class="p-6 border-b flex flex-col items-start gap-1">
            <span class="text-2xl font-bold text-[#FFA07A] tracking-tight">CarDealership</span>
            <span class="text-xs text-gray-500 italic">Admin Panel</span>
        </div>
        <nav class="flex-1 p-4">
            <ul class="space-y-2">
                <li>
                    <a href="{{ route('dashboard') }}"
                       class="flex items-center gap-2 px-3 py-2 rounded text-gray-700 hover:bg-[#ffe5dc] hover:text-[#FFA07A]">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0h6" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        Back to Site
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.cars.index') }}"
                       class="flex items-center gap-2 px-3 py-2 rounded {{ request()->routeIs('admin.cars.*') ? 'bg-[#ffe5dc] text-[#FFA07A] font-semibold' : 'text-gray-700 hover:bg-[#ffe5dc] hover:text-[#FFA07A]' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M3 13l1.5-4.5A2 2 0 0 1 6.4 7h11.2a2 2 0 0 1 1.9 1.5L21 13M5 16v1a2 2 0 0 0 2 2h0a2 2 0 0 0 2-2v-1m6 0v1a2 2 0 0 0 2 2h0a2 2 0 0 0 2-2v-1M7 16h10M7 16a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm10 0a2 2 0 1 1 4 0 2 2 0 0 1-4 0z" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        Cars
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.users.index') }}"
                       class="flex items-center gap-2 px-3 py-2 rounded {{ request()->routeIs('admin.users.*') ? 'bg-[#ffe5dc] text-[#FFA07A] font-semibold' : 'text-gray-700 hover:bg-[#ffe5dc] hover:text-[#FFA07A]' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87M16 3.13a4 4 0 010 7.75M8 3.13a4 4 0 000 7.75" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        Users
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.customers.index') }}"
                       class="flex items-center gap-2 px-3 py-2 rounded {{ request()->routeIs('admin.customers.*') ? 'bg-[#ffe5dc] text-[#FFA07A] font-semibold' : 'text-gray-700 hover:bg-[#ffe5dc] hover:text-[#FFA07A]' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M5.121 17.804A13.937 13.937 0 0112 15c2.5 0 4.847.655 6.879 1.804M15 11a3 3 0 11-6 0 3 3 0 016 0z" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        Customers
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.reservations.index') }}"
                       class="flex items-center gap-2 px-3 py-2 rounded {{ request()->routeIs('admin.reservations.*') ? 'bg-[#ffe5dc] text-[#FFA07A] font-semibold' : 'text-gray-700 hover:bg-[#ffe5dc] hover:text-[#FFA07A]' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" stroke-linecap="round" stroke-linejoin="round"/></svg>
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
            <div class="flex items-center gap-4">
                <span class="text-gray-600">{{ Auth::user()->name ?? 'Admin' }}</span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-red-600 hover:underline">Logout</button>
                </form>
            </div>
        </header>
        <!-- Main Content -->
        <main class="flex-1 p-8">
            <div class="bg-white rounded-lg shadow p-6">
                @yield('content')
            </div>
        </main>
    </div>
</body>
</html>
