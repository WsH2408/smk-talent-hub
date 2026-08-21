@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

    <!-- Breadcrumb -->
    <nav class="mb-8">
        <ol class="flex items-center gap-2 text-sm text-gray-500">
            <li><a href="{{ route('home') }}" class="hover:text-blue-600">Beranda</a></li>
            <li>/</li>
            <li><a href="{{ route('projects.index') }}" class="hover:text-blue-600">Karya Siswa</a></li>
            <li>/</li>
            <li class="text-gray-900 font-medium">{{ Str::limit($project->judul, 30) }}</li>
        </ol>
    </nav>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-6">

            <!-- Image Gallery Slider -->
            @if($project->images && $project->images->count() > 0)
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="relative" id="gallery-container">
                        <!-- Main Image -->
                        <div class="relative aspect-video bg-gray-900 overflow-hidden">
                            <img id="main-image"
                                 src="{{ asset('storage/' . $project->images->first()->image_path) }}"
                                 alt="{{ $project->judul }}"
                                 class="w-full h-full object-contain transition-opacity duration-300">

                            <!-- Navigation Arrows -->
                            @if($project->images->count() > 1)
                                <button onclick="prevImage()" class="absolute left-4 top-1/2 -translate-y-1/2 w-12 h-12 bg-white/90 backdrop-blur-sm rounded-full shadow-lg flex items-center justify-center hover:bg-white transition-all hover:scale-110">
                                    <svg class="w-6 h-6 text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                                    </svg>
                                </button>
                                <button onclick="nextImage()" class="absolute right-4 top-1/2 -translate-y-1/2 w-12 h-12 bg-white/90 backdrop-blur-sm rounded-full shadow-lg flex items-center justify-center hover:bg-white transition-all hover:scale-110">
                                    <svg class="w-6 h-6 text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </button>
                            @endif

                            <!-- Image Counter -->
                            @if($project->images->count() > 1)
                                <div class="absolute top-4 right-4 px-3 py-1 bg-black/70 backdrop-blur-sm text-white text-sm rounded-full">
                                    <span id="current-slide">1</span> / {{ $project->images->count() }}
                                </div>
                            @endif
                        </div>

                        <!-- Thumbnail Strip -->
                        @if($project->images->count() > 1)
                            <div class="p-4 bg-gray-50 border-t border-gray-100">
                                <div class="flex gap-2 overflow-x-auto pb-2">
                                    @foreach($project->images as $index => $image)
                                        <button onclick="goToSlide({{ $index }})"
                                                class="gallery-thumb flex-shrink-0 w-20 h-20 rounded-lg overflow-hidden border-2 transition-all {{ $index === 0 ? 'border-blue-600 opacity-100' : 'border-transparent opacity-60 hover:opacity-100' }}">
                                            <img src="{{ asset('storage/' . $image->image_path) }}"
                                                 alt="Thumbnail {{ $index + 1 }}"
                                                 class="w-full h-full object-cover">
                                        </button>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            @else
                <!-- Fallback: Hanya Thumbnail -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                    @if($project->thumbnail)
                        <img src="{{ asset('storage/' . $project->thumbnail) }}"
                             alt="{{ $project->judul }}"
                             class="w-full h-auto">
                    @else
                        <div class="w-full h-96 bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center">
                            <svg class="w-32 h-32 text-white/30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                    @endif
                </div>
            @endif

            <!-- Project Info -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 sm:p-8">
                <!-- Header -->
                <div class="mb-6">
                    <div class="flex items-center gap-3 mb-4">
                        <!-- Category Badge dengan Null Check -->
                        @if($project->category)
                            <span class="px-3 py-1 bg-blue-100 text-blue-700 text-sm font-medium rounded-full">
                                {{ $project->category->name }}
                            </span>
                        @else
                            <span class="px-3 py-1 bg-gray-100 text-gray-700 text-sm font-medium rounded-full">
                                Tanpa Kategori
                            </span>
                        @endif

                        <!-- Status Badge -->
                        <span class="px-3 py-1
                            {{ $project->status == 'approved' ? 'bg-green-100 text-green-700' :
                               ($project->status == 'pending' ? 'bg-yellow-100 text-yellow-700' : 'bg-red-100 text-red-700') }}
                            text-sm font-medium rounded-full">
                            {{ ucfirst($project->status) }}
                        </span>
                    </div>

                    <h1 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-4">{{ $project->judul }}</h1>

                    <div class="flex flex-wrap items-center gap-4 text-sm text-gray-500">
                        <span class="flex items-center gap-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            Dipublikasikan {{ $project->created_at->format('d M Y') }}
                        </span>
                        @if($project->tanggal_mulai && $project->tanggal_selesai)
                            <span class="flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                {{ $project->tanggal_mulai->format('d M Y') }} - {{ $project->tanggal_selesai->format('d M Y') }}
                            </span>
                        @endif
                    </div>
                </div>

                <!-- Action Links -->
                @if($project->link_demo || $project->link_github)
                    <div class="flex flex-wrap gap-3 mb-6 pb-6 border-b border-gray-100">
                        @if($project->link_demo)
                            <a href="{{ $project->link_demo }}" target="_blank"
                               class="inline-flex items-center px-4 py-2 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                                </svg>
                                Lihat Demo
                            </a>
                        @endif
                        @if($project->link_github)
                            <a href="{{ $project->link_github }}" target="_blank"
                               class="inline-flex items-center px-4 py-2 bg-gray-900 text-white font-medium rounded-lg hover:bg-gray-800 transition">
                                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/>
                                </svg>
                                Source Code
                            </a>
                        @endif
                    </div>
                @endif

                <!-- Description -->
                <div>
                    <h2 class="text-xl font-bold text-gray-900 mb-4">Deskripsi Proyek</h2>
                    <div class="prose prose-blue max-w-none">
                        <p class="text-gray-700 leading-relaxed whitespace-pre-line">{{ $project->deskripsi }}</p>
                    </div>
                </div>

                <!-- Tools/Teknologi -->
                @if($project->tools && count($project->tools) > 0)
                    <div class="mt-8 pt-6 border-t border-gray-100">
                        <h2 class="text-xl font-bold text-gray-900 mb-4">Teknologi yang Digunakan</h2>
                        <div class="flex flex-wrap gap-2">
                            @foreach($project->tools as $tool)
                                <span class="px-4 py-2 bg-gradient-to-r from-blue-50 to-purple-50 text-gray-700 font-medium rounded-lg text-sm border border-gray-200">
                                    {{ $tool }}
                                </span>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Pembuat -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Pembuat</h3>
                <div class="flex items-center gap-3 mb-4">
                    <img src="{{ $project->user->foto_profil ? asset('storage/' . $project->user->foto_profil) : 'https://ui-avatars.com/api/?name='.urlencode($project->user->name).'&background=random' }}"
                         class="w-14 h-14 rounded-full">
                    <div>
                        <div class="font-semibold text-gray-900">{{ $project->user->name }}</div>
                        <div class="text-sm text-gray-500">{{ $project->user->profile->jurusan ?? 'Siswa' }}</div>
                    </div>
                </div>
                <a href="{{ route('profile.show', $project->user) }}"
                   class="block w-full text-center px-4 py-2.5 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition">
                    Lihat Profil
                </a>
            </div>

            <!-- Proyek Terkait -->
            @if($relatedProjects && $relatedProjects->isNotEmpty())
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Proyek Terkait</h3>
                    <div class="space-y-4">
                        @foreach($relatedProjects as $related)
                            <a href="{{ route('projects.show', $related->slug) }}"
                               class="block group">
                                <div class="flex gap-3">
                                    @if($related->thumbnail)
                                        <img src="{{ asset('storage/' . $related->thumbnail) }}"
                                             class="w-16 h-16 rounded-lg object-cover flex-shrink-0">
                                    @else
                                        <div class="w-16 h-16 bg-gradient-to-br from-blue-400 to-purple-500 rounded-lg flex-shrink-0"></div>
                                    @endif
                                    <div class="flex-1 min-w-0">
                                        <div class="font-medium text-gray-900 text-sm group-hover:text-blue-600 transition-colors line-clamp-2">
                                            {{ $related->judul }}
                                        </div>
                                        <div class="text-xs text-gray-500 mt-1">{{ $related->user->name }}</div>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- JavaScript untuk Image Gallery -->
@if($project->images && $project->images->count() > 0)
<script>
    const galleryData = @json($project->images->pluck('image_path'));
    let currentSlide = 0;

    function updateGallery() {
        const mainImage = document.getElementById('main-image');
        const counter = document.getElementById('current-slide');
        const thumbs = document.querySelectorAll('.gallery-thumb');

        if (mainImage) {
            mainImage.style.opacity = '0';
            setTimeout(() => {
                mainImage.src = '{{ asset("storage/") }}/' + galleryData[currentSlide];
                mainImage.style.opacity = '1';
            }, 150);
        }

        if (counter) counter.textContent = currentSlide + 1;

        thumbs.forEach((thumb, index) => {
            if (index === currentSlide) {
                thumb.classList.remove('border-transparent', 'opacity-60');
                thumb.classList.add('border-blue-600', 'opacity-100');
            } else {
                thumb.classList.remove('border-blue-600', 'opacity-100');
                thumb.classList.add('border-transparent', 'opacity-60');
            }
        });
    }

    function nextImage() {
        currentSlide = (currentSlide + 1) % galleryData.length;
        updateGallery();
    }

    function prevImage() {
        currentSlide = (currentSlide - 1 + galleryData.length) % galleryData.length;
        updateGallery();
    }

    function goToSlide(index) {
        currentSlide = index;
        updateGallery();
    }

    // Keyboard navigation
    document.addEventListener('keydown', function(e) {
        if (e.key === 'ArrowRight') nextImage();
        if (e.key === 'ArrowLeft') prevImage();
    });
</script>
@endif

<style>
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>
@endsection
