<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="https://cdn.tailwindcss.com"></script>
    @vite(['resources/js/app.js'])

</head>

<body class="bg-gray-100 flex flex-col min-h-screen">
    <div id="app" class="flex-grow">
        <header class="bg-white shadow-sm sticky top-0 z-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between h-16">
                    <!-- Logo -->
                    <div class="flex-shrink-0">
                        <a href="{{ route('home') }}" class="flex items-center space-x-2">
                            <div class="bg-black text-white px-3 py-2 rounded font-bold text-xl">
                                MK
                            </div>
                            <span class="text-gray-800 font-medium">Manajemen Kost</span>
                        </a>
                    </div>

                    <!-- Navigation -->
                    <nav class="hidden md:block">
                        <div class="ml-10 flex items-baseline space-x-8">

                            {{-- Menu untuk Semua User yang Login --}}
                            @auth
                                <a href="{{ route('home') }}"
                                    class="{{ request()->routeIs('home') ? 'text-blue-600 border-b-2 border-blue-600' : 'text-gray-600 hover:text-blue-600' }} px-3 py-2 text-sm font-medium">Home</a>
                            @endauth

                            {{-- Menu Khusus PENYEWA --}}
                            @if (Auth::check() && Auth::user()->role == 'penyewa')
                                <a href="{{ route('index') }}"
                                    class="{{ request()->routeIs('index') ? 'text-blue-600 border-b-2 border-blue-600' : 'text-gray-600 hover:text-blue-600' }} px-3 py-2 text-sm font-medium">Cari
                                    Kost</a>
                                <a href="{{ route('penyewa.status') }}"
                                    class="{{ request()->routeIs('penyewa.status') ? 'text-blue-600 border-b-2 border-blue-600' : 'text-gray-600 hover:text-blue-600' }} px-3 py-2 text-sm font-medium">Status
                                    Booking</a>
                            @endif

                            {{-- Menu Khusus PEMILIK --}}
                            @if (Auth::check() && Auth::user()->role == 'pemilik')
                                <a href="{{ route('pemilik.index') }}"
                                    class="{{ request()->routeIs('pemilik.index') ? 'text-blue-600 border-b-2 border-blue-600' : 'text-gray-600 hover:text-blue-600' }} px-3 py-2 text-sm font-medium">Kost
                                    Saya</a>
                                <a href="{{ route('pemilik.orderan') }}"
                                    class="{{ request()->routeIs('pemilik.orderan') ? 'text-blue-600 border-b-2 border-blue-600' : 'text-gray-600 hover:text-blue-600' }} px-3 py-2 text-sm font-medium">Orderan
                                    Masuk</a>
                            @endif

                            {{-- Menu Khusus ADMIN --}}
                            @if (Auth::check() && Auth::user()->role == 'admin')
                                <a href="{{ route('admin.users') }}"
                                    class="{{ request()->routeIs('admin.users') ? 'text-blue-600 border-b-2 border-blue-600' : 'text-gray-600 hover:text-blue-600' }} px-3 py-2 text-sm font-medium">Kelola
                                    User</a>
                            @endif
                        </div>
                    </nav>

                    <!-- Profile Dropdown -->
                    <div class="hidden md:block">
                        <div class="ml-4 flex items-center md:ml-6">
                            @guest
                                <div class="space-x-4">
                                    <a href="{{ route('login') }}" class="text-gray-600 hover:text-blue-600">Login</a>
                                    <a href="{{ route('register') }}"
                                        class="bg-blue-600 text-white px-4 py-2 rounded-md text-sm font-medium hover:bg-blue-700">Register</a>
                                </div>
                            @else
                                <div class="relative">
                                    <button type="button"
                                        class="max-w-xs bg-white flex items-center text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                                        id="user-menu-button" aria-expanded="false" aria-haspopup="true"
                                        onclick="toggleDropdown()">
                                        <span class="sr-only">Open user menu</span>
                                        <div
                                            class="h-8 w-8 rounded-full bg-blue-600 text-white flex items-center justify-center font-bold">
                                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                        </div>
                                    </button>

                                    <div id="user-menu"
                                        class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none hidden"
                                        role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button"
                                        tabindex="-1">
                                        <div class="px-4 py-2 text-sm text-gray-700 border-b">
                                            <div class="font-bold">{{ Auth::user()->name }}</div>
                                            <div class="text-xs text-gray-500">{{ Auth::user()->email }}</div>
                                        </div>
                                        <a href="{{ route('profile.show') }}"
                                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem"
                                            tabindex="-1" id="user-menu-item-0">Profil Anda</a>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem"
                                            tabindex="-1" id="user-menu-item-2">
                                            Logout
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                            style="display: none;">
                                            @csrf
                                        </form>
                                    </div>
                                </div>
                            @endguest
                        </div>
                    </div>

                    <!-- Mobile menu button -->
                    <div class="-mr-2 flex md:hidden">
                        <button type="button" onclick="toggleMobileMenu()"
                            class="bg-white inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-blue-500"
                            aria-controls="mobile-menu" aria-expanded="false">
                            <span class="sr-only">Open main menu</span>
                            <svg id="menu-open-icon" class="h-6 w-6 block" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                            <svg id="menu-close-icon" class="h-6 w-6 hidden" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                </div>
            </div>

            <!-- Mobile menu, show/hide based on menu state. -->
            <div class="md:hidden hidden" id="mobile-menu">
                <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
                    {{-- Mobile Menu Role Links --}}
                    @auth
                        @if (Auth::user()->role == 'penyewa')
                            <a href="{{ route('index') }}"
                                class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50">Cari
                                Kost</a>
                            <a href="{{ route('penyewa.status') }}"
                                class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50">Status
                                Booking</a>
                        @elseif(Auth::user()->role == 'pemilik')
                            <a href="{{ route('pemilik.index') }}"
                                class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50">Kost
                                Saya</a>
                            <a href="{{ route('pemilik.orderan') }}"
                                class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50">Orderan
                                Masuk</a>
                        @elseif(Auth::user()->role == 'admin')
                            <a href="{{ route('admin.users') }}"
                                class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50">Kelola
                                User</a>
                        @endif
                    @endauth
                </div>
                <div class="pt-4 pb-3 border-t border-gray-200">
                    @guest
                        <div class="px-2 space-y-1">
                            <a href="{{ route('login') }}"
                                class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50">Login</a>
                            <a href="{{ route('register') }}"
                                class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50">Register</a>
                        </div>
                    @else
                        <div class="flex items-center px-5">
                            <div class="flex-shrink-0">
                                <div
                                    class="h-10 w-10 rounded-full bg-blue-600 text-white flex items-center justify-center font-bold">
                                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                </div>
                            </div>
                            <div class="ml-3">
                                <div class="text-base font-medium leading-none text-gray-800">{{ Auth::user()->name }}
                                </div>
                                <div class="text-sm font-medium leading-none text-gray-500">{{ Auth::user()->email }}
                                </div>
                            </div>
                        </div>
                        <div class="mt-3 px-2 space-y-1">
                            <a href="{{ route('profile.show') }}"
                                class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50">Profil
                                Anda</a>
                            <a href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form-mobile').submit();"
                                class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50">
                                Logout
                            </a>
                            <form id="logout-form-mobile" action="{{ route('logout') }}" method="POST"
                                style="display: none;">
                                @csrf
                            </form>
                        </div>
                    @endguest
                </div>
            </div>
        </header>

        <main class="flex-grow">
            @yield('content')
        </main>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-4">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <p class="text-sm text-gray-400">
                    Copyright &copy; 2025 - Manajemen Kost
                </p>
            </div>
        </div>
    </footer>

    <script>
        function toggleDropdown() {
            document.getElementById('user-menu').classList.toggle('hidden');
        }

        function toggleMobileMenu() {
            const mobileMenu = document.getElementById('mobile-menu');
            const openIcon = document.getElementById('menu-open-icon');
            const closeIcon = document.getElementById('menu-close-icon');

            mobileMenu.classList.toggle('hidden');
            openIcon.classList.toggle('hidden');
            closeIcon.classList.toggle('hidden');
        }
        // Close dropdown when clicking outside
        window.addEventListener('click', function(e) {
            if (document.getElementById('user-menu-button') && !document.getElementById('user-menu-button')
                .contains(e.target) && !document.getElementById('user-menu').contains(e.target)) {
                document.getElementById('user-menu').classList.add('hidden');
            }
        });
    </script>

</body>

</html>
