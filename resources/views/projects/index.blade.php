@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Header -->
        <div class="text-center mb-8">
            <h1 class="text-4xl font-bold text-gray-900 mb-4">Semua Karya Siswa</h1>
            <p class="text-xl text-gray-600">Jelajahi portofolio dari seluruh siswa SMK Talent Hub</p>
        </div>

        <!-- Search & Filter Bar -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 mb-8">
            <form method="GET" action="{{ route('projects.index') }}" class="flex flex-col lg:flex-row gap-4">
                <!-- Search Input -->
                <div class="flex-1 relative">
                    <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Cari judul proyek atau nama siswa..."
                        class="w-full pl-12 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>

                <!-- Filter Kategori -->
                <select name="category"
                    class="px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="">Semua Kategori</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                    @endforeach
                </select>

                <!-- Filter Jurusan -->
                <select name="jurusan"
                    class="px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="">Semua Jurusan</option>
                    <option value="RPL" {{ request('jurusan') == 'RPL' ? 'selected' : '' }}>RPL</option>
                    <option value="Multimedia" {{ request('jurusan') == 'Multimedia' ? 'selected' : '' }}>Multimedia</option>
                    <option value="TKJ" {{ request('jurusan') == 'TKJ' ? 'selected' : '' }}>TKJ</option>
                    <option value="DKV" {{ request('jurusan') == 'DKV' ? 'selected' : '' }}>DKV</option>
                </select>

                <!-- Sort -->
                <select name="sort"
                    class="px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Terbaru</option>
                    <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Terlama</option>
                </select>

                <!-- Buttons -->
                <div class="flex gap-2">
                    <button type="submit"
                        class="px-6 py-3 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition">
                        Cari
                    </button>
                    <a href="{{ route('projects.index') }}"
                        class="px-6 py-3 bg-gray-200 text-gray-700 font-medium rounded-lg hover:bg-gray-300 transition">
                        Reset
                    </a>
                </div>
            </form>

            <!-- Active Filters Info -->
            @if(request('search') || request('category') || request('jurusan'))
                <div class="mt-4 flex flex-wrap gap-2 text-sm">
                    <span class="text-gray-500">Filter aktif:</span>
                    @if(request('search'))
                        <span class="px-3 py-1 bg-blue-100 text-blue-700 rounded-full">
                            Search: "{{ request('search') }}"
                            <a href="{{ request()->fullUrlWithQuery(['search' => null]) }}"
                                class="ml-1 hover:text-blue-900">&times;</a>
                        </span>
                    @endif
                    @if(request('category'))
                        <span class="px-3 py-1 bg-purple-100 text-purple-700 rounded-full">
                            Kategori: {{ $categories->firstWhere('id', request('category'))->name ?? '' }}
                            <a href="{{ request()->fullUrlWithQuery(['category' => null]) }}"
                                class="ml-1 hover:text-purple-900">&times;</a>
                        </span>
                    @endif
                    @if(request('jurusan'))
                        <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full">
                            Jurusan: {{ request('jurusan') }}
                            <a href="{{ request()->fullUrlWithQuery(['jurusan' => null]) }}"
                                class="ml-1 hover:text-green-900">&times;</a>
                        </span>
                    @endif
                </div>
            @endif
        </div>

        <!-- Results Count -->
        <div class="mb-6 text-gray-600">
            Menampilkan <span class="font-semibold text-gray-900">{{ $projects->total() }}</span> proyek
        </div>

        <!-- Grid Proyek -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($projects as $project)
                <div
                    class="group bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2">
                    <div class="h-56 bg-gray-200 overflow-hidden relative">
                        @if($project->thumbnail && file_exists(storage_path('app/public/' . $project->thumbnail)))
                            <img src="{{ asset('storage/' . $project->thumbnail) }}" alt="{{ $project->judul }}"
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                        @else
                            <div
                                class="w-full h-full bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center">
                                <svg class="w-20 h-20 text-white/50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                    </path>
                                </svg>
                            </div>
                        @endif
                        <div class="absolute top-4 left-4">
                            <span
                                class="px-3 py-1 bg-white/90 backdrop-blur-sm text-blue-600 text-xs font-bold rounded-full shadow-sm">
                                {{ $project->category->name }}
                            </span>
                        </div>
                    </div>

                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-900 mb-2 group-hover:text-blue-600 transition-colors">
                            {{ Str::limit($project->judul, 50) }}
                        </h3>
                        <p class="text-gray-600 text-sm mb-4 line-clamp-2">
                            {{ Str::limit($project->deskripsi, 80) }}
                        </p>

                        <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                            <div class="flex items-center gap-3">
                                <img src="{{ $project->user->foto_profil ? asset('storage/' . $project->user->foto_profil) : 'https://ui-avatars.com/api/?name=' . urlencode($project->user->name) . '&background=random' }}"
                                    class="w-10 h-10 rounded-full">
                                <div>
                                    <div class="text-sm font-medium text-gray-900">{{ $project->user->name }}</div>
                                    <div class="text-xs text-gray-500">{{ $project->user->profile->jurusan ?? 'Siswa' }}</div>
                                </div>
                            </div>
                            <a href="{{ route('projects.show', $project->slug) }}"
                                class="inline-flex items-center text-blue-600 hover:text-blue-700 font-medium text-sm">
                                Detail
                                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                                    </path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-3 text-center py-20">
                    <svg class="w-24 h-24 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    <p class="text-gray-500 text-lg">Tidak ada proyek yang cocok dengan pencarianmu.</p>
                    <a href="{{ route('projects.index') }}"
                        class="inline-block mt-4 px-6 py-3 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition">
                        Reset Filter
                    </a>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($projects->hasPages())
            <div class="mt-12 flex justify-center">
                {{ $projects->links() }}
            </div>
        @endif
    </div>
@endsection
