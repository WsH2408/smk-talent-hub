<div>
    <!-- Filter & Sort Bar (Clean & Interactive) -->
    <div class="flex flex-col md:flex-row md:items-center justify-between mb-8 gap-4">
        <!-- Filter Kategori -->
        <div class="flex flex-wrap gap-2">
            <button wire:click="$set('filterKategori', '')"
                class="px-4 py-2 rounded-full text-sm font-medium transition {{ $filterKategori == '' ? 'bg-blue-600 text-white shadow-md' : 'bg-white text-gray-600 hover:bg-gray-100 border border-gray-200' }}">
                Semua
            </button>

            @foreach($categories as $category)
                <button wire:click="$set('filterKategori', {{ $category->id }})"
                    class="px-4 py-2 rounded-full text-sm font-medium transition {{ $filterKategori == $category->id ? 'bg-blue-600 text-white shadow-md' : 'bg-white text-gray-600 hover:bg-gray-100 border border-gray-200' }}">
                    {{ $category->name }}
                </button>
            @endforeach
        </div>

        <!-- Sort Dropdown -->
        <div class="flex items-center gap-2">
            <span class="text-sm text-gray-500">Urutkan:</span>
            <select wire:model.live="sortBy"
                class="bg-white border border-gray-200 text-gray-700 text-sm rounded-full focus:ring-blue-500 focus:border-blue-500 block px-4 py-2">
                <option value="terbaru">Terbaru</option>
                <option value="populer">Paling Banyak Disukai</option>
            </select>
        </div>
    </div>

    <!-- Grid Kartu Proyek -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($projects as $project)
            <div
                class="bg-white rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 overflow-hidden border border-gray-100 group flex flex-col">
                <!-- Thumbnail -->
                <div class="h-48 bg-gray-200 overflow-hidden relative">
                    <img src="{{ $project->thumbnail }}" alt="{{ $project->judul }}"
                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    <div class="absolute top-3 left-3">
                        <span
                            class="px-3 py-1 bg-white/90 backdrop-blur-sm text-blue-600 text-xs font-bold rounded-full shadow-sm">
                            {{ $project->category->name }}
                        </span>
                    </div>
                </div>

                <!-- Content -->
                <div class="p-5 flex flex-col flex-grow">
                    <h3 class="font-bold text-gray-900 text-lg line-clamp-1 group-hover:text-blue-600 transition">
                        {{ $project->judul }}
                    </h3>
                    <p class="text-gray-500 text-sm mt-2 line-clamp-2 flex-grow">
                        {{ Str::limit($project->deskripsi, 80) }}
                    </p>

                    <!-- Author Info -->
                    <div class="mt-4 pt-4 border-t border-gray-100 flex items-center justify-between">
                        <div class="flex items-center">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($project->user->name) }}&background=random"
                                class="w-8 h-8 rounded-full mr-2">
                            <div>
                                <p class="text-sm font-semibold text-gray-800 leading-tight">{{ $project->user->name }}</p>
                                <p class="text-xs text-gray-500">{{ $project->user->profile->jurusan ?? 'Siswa' }}</p>
                            </div>
                        </div>

                        <!-- Like Button -->
                        <button class="text-gray-400 hover:text-red-500 transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z">
                                </path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full text-center py-20">
                <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <p class="text-gray-500 text-lg">Belum ada proyek di kategori ini.</p>
            </div>
        @endforelse
    </div>

    <!-- Load More Button -->
    @if($projects->hasMorePages())
        <div class="text-center mt-12">
            <button wire:click="loadMore" wire:loading.attr="disabled"
                class="px-8 py-3 bg-white border border-gray-300 text-gray-700 font-medium rounded-full hover:bg-gray-50 transition shadow-sm">
                <span wire:loading.remove>Muat Lebih Banyak</span>
                <span wire:loading class="flex items-center justify-center">
                    <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-gray-700" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor"
                            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                        </path>
                    </svg>
                    Memuat...
                </span>
            </button>
        </div>
    @endif
</div>