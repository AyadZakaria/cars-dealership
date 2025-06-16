<nav class="w-full bg-white shadow mb-8" x-data="{ open: false }">
    <div class="max-w-6xl mx-auto px-4 py-3 flex items-center justify-between">
        <a href="{{ url('/') }}" class="text-2xl font-bold text-[#FFA07A] tracking-tight">CarDealership</a>
        <div class="flex items-center gap-6">
            <x-nav-link href="{{ url('/') }}" :active="request()->is('/')">
                Home
            </x-nav-link>
            <x-nav-link href="{{ route('dashboard') }}" :active="request()->is('dashboard')">
                Dashboard
            </x-nav-link>
        </div>
        @auth
            <form method="POST" action="{{ route('logout') }}" class="inline">
                @csrf
                <button type="submit"
                    class="text-[#1b1b18] font-medium hover:text-[#FFA07A] transition bg-transparent border-none cursor-pointer">Logout</button>
            </form>
        @endauth
    </div>
    </div>
</nav>
