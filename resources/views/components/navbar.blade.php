<nav class="w-full bg-white shadow mb-8" x-data="{ open: false }">
    <div class="max-w-6xl mx-auto px-4 py-3 flex items-center justify-between">
        <a href="{{ route('home') }}">
            <x-application-logo class="h-8 w-auto" />
        </a>
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
                    <x-dropdown-link href="{{ route('dashboard') }}">
                        Dashboard
                    </x-dropdown-link>
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
    </div>
</nav>
