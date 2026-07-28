@extends('layouts.app')

@section('content')
    <!-- Hero Section -->
    <div class="relative bg-white overflow-hidden">
        <div class="max-w-7xl mx-auto">
            <div
                class="relative z-10 pb-8 bg-white sm:pb-16 md:pb-20 lg:max-w-2xl lg:w-full lg:pb-28 xl:pb-32 pt-20 px-4 sm:px-6 lg:px-8">
                <main class="mt-10 mx-auto max-w-7xl sm:mt-12 md:mt-16 lg:mt-20 xl:mt-28">
                    <div class="sm:text-center lg:text-left">
                        <h1 class="text-4xl tracking-tight font-extrabold text-gray-900 sm:text-5xl md:text-6xl">
                            <span class="block xl:inline">Temukan Talenta</span>
                            <span class="block text-blue-600 xl:inline">Digital Terbaik</span>
                        </h1>
                        <p
                            class="mt-3 text-base text-gray-500 sm:mt-5 sm:text-lg sm:max-w-xl sm:mx-auto md:mt-5 md:text-xl lg:mx-0">
                            Platform showcase portofolio siswa SMK. Jelajahi karya-karya kreatif dari jurusan RPL,
                            Multimedia, TKJ, dan lainnya.
                        </p>
                        <div class="mt-5 sm:mt-8 sm:flex sm:justify-center lg:justify-start">
                            <div class="rounded-md shadow">
                                <a href="{{ route('projects.index') }}"
                                    class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-full text-white bg-blue-600 hover:bg-blue-700 md:py-4 md:text-lg transition">
                                    Lihat Karya Siswa
                                </a>
                            </div>
                            <div class="mt-3 sm:mt-0 sm:ml-3">
                                <a href="{{ route('register') }}"
                                    class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-full text-blue-700 bg-blue-100 hover:bg-blue-200 md:py-4 md:text-lg transition">
                                    Daftar Sekarang
                                </a>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>

        <!-- Hero Image -->
        <div
            class="lg:absolute lg:inset-y-0 lg:right-0 lg:w-1/2 bg-gradient-to-br from-blue-50 to-indigo-100 flex items-center justify-center">
            <div class="text-center p-8">
                <svg class="w-64 h-64 mx-auto text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                        d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                    </path>
                </svg>
                <p class="mt-4 text-2xl font-bold text-blue-600">1000+ Proyek</p>
                <p class="text-gray-600">Dari siswa berbakat</p>
            </div>
        </div>
    </div>

    <!-- Stats Section -->
    <div class="bg-gray-50 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 gap-8 sm:grid-cols-3 text-center">
                <div class="bg-white p-6 rounded-2xl shadow-sm">
                    <div class="text-4xl font-bold text-blue-600">{{ $featuredProjects->count() }}+</div>
                    <div class="mt-2 text-gray-600">Proyek Dipamerkan</div>
                </div>
                <div class="bg-white p-6 rounded-2xl shadow-sm">
                    <div class="text-4xl font-bold text-blue-600">50+</div>
                    <div class="mt-2 text-gray-600">Siswa Berbakat</div>
                </div>
                <div class="bg-white p-6 rounded-2xl shadow-sm">
                    <div class="text-4xl font-bold text-blue-600">20+</div>
                    <div class="mt-2 text-gray-600">Partner Industri</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Featured Projects Section -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-extrabold text-gray-900 sm:text-4xl">
                Karya Terbaru
            </h2>
            <p class="mt-4 text-xl text-gray-500">
                Jelajahi proyek-proyek terbaik dari siswa kami
            </p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($featuredProjects as $project)
                <div
                    class="bg-white rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 overflow-hidden border border-gray-100 group">
                    <!-- Thumbnail -->
                    <div class="h-48 bg-gray-200 overflow-hidden">
                        <img src="{{ $project->thumbnail }}" alt="{{ $project->judul }}"
                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                    </div>

                    <!-- Content -->
                    <div class="p-6">
                        <span
                            class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                            {{ $project->category->name }}
                        </span>

                        <h3 class="mt-3 text-xl font-bold text-gray-900 group-hover:text-blue-600 transition">
                            {{ $project->judul }}
                        </h3>

                        <p class="mt-2 text-gray-500 line-clamp-2">
                            {{ Str::limit($project->deskripsi, 100) }}
                        </p>

                        <!-- Author -->
                        <div class="mt-4 pt-4 border-t border-gray-100 flex items-center">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($project->user->name) }}"
                                class="w-8 h-8 rounded-full">
                            <div class="ml-3">
                                <p class="text-sm font-medium text-gray-900">{{ $project->user->name }}</p>
                                <p class="text-xs text-gray-500">{{ $project->user->profile->jurusan ?? 'Siswa' }}</p>
                            </div>
                        </div>

                        <a href="{{ route('projects.show', $project->slug) }}"
                            class="mt-4 inline-flex items-center text-blue-600 hover:text-blue-700 font-medium">
                            Lihat Detail
                            <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="text-center mt-12">
            <a href="{{ route('projects.index') }}"
                class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-full text-blue-700 bg-blue-100 hover:bg-blue-200 transition">
                Lihat Semua Proyek
                <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3">
                    </path>
                </svg>
            </a>
        </div>
    </div>

    <!-- Categories Section -->
    <div class="bg-gray-50 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-extrabold text-center text-gray-900 mb-12">
                Kategori Proyek
            </h2>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                @foreach($categories as $category)
                    <a href="{{ route('projects.index', ['category' => $category->id]) }}"
                        class="bg-white p-6 rounded-2xl shadow-sm hover:shadow-md transition text-center group">
                        <div
                            class="w-16 h-16 mx-auto bg-blue-100 rounded-full flex items-center justify-center group-hover:bg-blue-600 transition">
                            <svg class="w-8 h-8 text-blue-600 group-hover:text-white transition" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z">
                                </path>
                            </svg>
                        </div>
                        <h3 class="mt-4 font-semibold text-gray-900">{{ $category->name }}</h3>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
@endsection