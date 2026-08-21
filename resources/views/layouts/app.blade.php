<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'SMK Talent Hub') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @livewireStyles
</head>

<body class="font-sans antialiased bg-gray-50">
    <!-- Navigation -->
    <nav class="bg-white border-b border-gray-200 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <!-- Logo -->
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="flex items-center space-x-2">
                        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                            </path>
                        </svg>
                        <span class="text-xl font-bold text-gray-900">SMK Talent Hub</span>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="flex items-center space-x-3">
                    @auth
                                    <!-- Beranda (untuk SEMUA role) -->
                                    <a href="{{ route('home') }}"
                                        class="text-gray-600 hover:text-gray-900 font-medium px-3 py-2 rounded-lg hover:bg-gray-100 transition">
                                        Beranda
                                    </a>

                                    <!-- Karya Siswa (untuk SEMUA role) -->
                                    <a href="{{ route('projects.index') }}"
                                        class="text-gray-600 hover:text-gray-900 font-medium px-3 py-2 rounded-lg hover:bg-gray-100 transition">
                                        Karya Siswa
                                    </a>

                                    <!-- Admin Dashboard (HANYA admin) -->
                                    @if(auth()->user()->role === 'admin')
                                        <a href="{{ route('admin.dashboard') }}"
                                            class="inline-flex items-center px-4 py-2 bg-purple-600 text-white text-sm font-medium rounded-lg hover:bg-purple-700 transition shadow-sm">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z">
                                                </path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            </svg>
                                            Admin Panel
                                        </a>
                                    @endif

                                    <!-- Recruiter Dashboard (HANYA rekruter) -->
                                    @if(auth()->user()->role === 'rekruter')
                                        <a href="{{ route('recruiter.dashboard') }}"
                                            class="inline-flex items-center px-4 py-2 bg-green-600 text-white text-sm font-medium rounded-lg hover:bg-green-700 transition shadow-sm">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                                </path>
                                            </svg>
                                            Recruiter Panel
                                        </a>
                                    @endif

                                    <!-- Upload Proyek (HANYA siswa) -->
                                    @if(auth()->user()->role === 'siswa')
                                        <a href="{{ route('projects.create') }}"
                                            class="text-blue-600 hover:text-blue-700 font-medium px-3 py-2 rounded-lg hover:bg-blue-50 transition">
                                            + Upload
                                        </a>
                                    @endif

                                    <!-- Profil Saya (untuk SEMUA role) -->
                                    <a href="{{ route('profile.show', auth()->user()) }}"
                                        class="text-gray-600 hover:text-gray-900 font-medium px-3 py-2 rounded-lg hover:bg-gray-100 transition">
                                        Profil Saya
                                    </a>

                                    <!-- Edit Profil (untuk SEMUA role) -->
                                    <a href="{{ route('profile.edit.custom') }}"
                                        class="text-gray-600 hover:text-gray-900 font-medium px-3 py-2 rounded-lg hover:bg-gray-100 transition">
                                        Edit Profil
                                    </a>

                                    <!-- User Info & Logout -->
                                    <div class="flex items-center space-x-2 ml-2 pl-3 border-l border-gray-200">
                                        <img src="{{ auth()->user()->foto_profil ? asset('storage/' . auth()->user()->foto_profil) : 'https://ui-avatars.com/api/?name=' . urlencode(auth()->user()->name) . '&background=random' }}"
                                            class="w-8 h-8 rounded-full">
                                        <span
                                            class="text-sm font-medium text-gray-700 hidden sm:block">{{ auth()->user()->name }}</span>
                                        <span
                                            class="text-xs px-2 py-1 rounded-full
                                            {{ auth()->user()->role === 'admin' ? 'bg-purple-100 text-purple-700' :
                        (auth()->user()->role === 'rekruter' ? 'bg-green-100 text-green-700' : 'bg-blue-100 text-blue-700') }}">
                                            {{ ucfirst(auth()->user()->role) }}
                                        </span>
                                        <form method="POST" action="{{ route('logout') }}" class="ml-2">
                                            @csrf
                                            <button type="submit"
                                                class="text-sm text-red-600 hover:text-red-700 font-medium">Logout</button>
                                        </form>
                                    </div>
                    @else
                        <a href="{{ route('home') }}"
                            class="text-gray-600 hover:text-gray-900 font-medium px-3 py-2">Beranda</a>
                        <a href="{{ route('projects.index') }}"
                            class="text-gray-600 hover:text-gray-900 font-medium px-3 py-2">Karya Siswa</a>
                        <a href="{{ route('login') }}" class="text-gray-600 hover:text-gray-900 font-medium px-3 py-2">Sign
                            in</a>
                        <a href="{{ route('register') }}"
                            class="px-4 py-2 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition">Get
                            started</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Page Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-white border-t border-gray-200 mt-20">
        <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
            <p class="text-center text-gray-500 text-sm">
                &copy; {{ date('Y') }} SMK Talent Hub. Showcase Your Best Work.
            </p>
        </div>
    </footer>

    @livewireScripts
</body>

</html>
