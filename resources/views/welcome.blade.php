@extends('layouts.app')

@section('content')
    <!-- Hero Section dengan Auto-Slider -->
    <section class="relative bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50 overflow-hidden">
        <!-- Background Decorations -->
        <div class="absolute inset-0 overflow-hidden">
            <div
                class="absolute -top-40 -right-40 w-80 h-80 bg-blue-200 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob">
            </div>
            <div
                class="absolute -bottom-40 -left-40 w-80 h-80 bg-purple-200 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob animation-delay-2000">
            </div>
            <div
                class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-80 h-80 bg-pink-200 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob animation-delay-4000">
            </div>
        </div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 lg:py-32">
            <!-- Content Centered -->
            <div class="text-center max-w-4xl mx-auto mb-16">
                <!-- Badge -->
                <div
                    class="inline-flex items-center px-4 py-2 bg-blue-100 text-blue-700 rounded-full text-sm font-medium mb-6">
                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                            clip-rule="evenodd"></path>
                    </svg>
                    Platform Showcase Portofolio Siswa SMK
                </div>

                <!-- Heading -->
                <h1 class="text-5xl lg:text-7xl font-bold text-gray-900 mb-6 leading-tight">
                    Temukan Talenta
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-purple-600">
                        Digital Terbaik
                    </span>
                </h1>

                <!-- Subheading -->
                <p class="text-xl text-gray-600 mb-10 max-w-2xl mx-auto leading-relaxed">
                    Jelajahi karya-karya kreatif dari siswa berbakat jurusan RPL, Multimedia, TKJ, dan lainnya.
                    Platform terbaik untuk showcase portofolio digital.
                </p>

                <!-- CTA Buttons -->
                <a href="{{ route('projects.index') }}"
                    class="inline-flex items-center px-8 py-4 bg-blue-600 text-white font-semibold rounded-full hover:bg-blue-700 transition-all shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                        </path>
                    </svg>
                    Lihat Karya Siswa
                </a>
                <a href="{{ route('register') }}"
                    class="inline-flex items-center px-8 py-4 bg-white text-gray-700 font-semibold rounded-full hover:bg-gray-50 transition-all shadow-lg hover:shadow-xl border border-gray-200 transform hover:-translate-y-1">
                    Daftar Sekarang
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6">
                        </path>
                    </svg>
                </a>
            </div>

            <!-- Stats -->
            <div class="flex justify-center gap-8 mt-12 pt-12 border-t border-gray-200">
                <div>
                    <div class="text-3xl font-bold text-gray-900">1000+</div>
                    <div class="text-sm text-gray-500 mt-1">Proyek</div>
                </div>
                <div>
                    <div class="text-3xl font-bold text-gray-900">500+</div>
                    <div class="text-sm text-gray-500 mt-1">Siswa</div>
                </div>
                <div>
                    <div class="text-3xl font-bold text-gray-900">50+</div>
                    <div class="text-sm text-gray-500 mt-1">Sekolah</div>
                </div>
            </div>
        </div>

        <!-- Auto-Slider Portofolio -->
        @if($featuredProjects->isNotEmpty())
            <!-- Stacked Cards Slider -->
            <div class="relative max-w-6xl mx-auto h-[500px]">
                <div id="stacked-slider" class="relative w-full h-full">
                    @foreach($featuredProjects as $index => $project)
                        <div class="slider-card absolute inset-0 transition-all duration-700 ease-in-out cursor-pointer"
                            data-index="{{ $index }}" data-total="{{ $featuredProjects->count() }}">

                            <!-- Card Content -->
                            <div class="relative w-full h-full rounded-3xl overflow-hidden shadow-2xl">
                                <!-- Background Image -->
                                @if($project->thumbnail && file_exists(storage_path('app/public/' . $project->thumbnail)))
                                    <img src="{{ asset('storage/' . $project->thumbnail) }}" alt="{{ $project->judul }}"
                                        class="w-full h-full object-cover">
                                @else
                                    <div
                                        class="w-full h-full bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center">
                                        <svg class="w-32 h-32 text-white/30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                            </path>
                                        </svg>
                                    </div>
                                @endif

                                <!-- Gradient Overlay -->
                                <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/40 to-transparent"></div>

                                <!-- Content -->
                                <div class="absolute bottom-0 left-0 right-0 p-10 text-white">
                                    <div class="flex items-center gap-3 mb-4">
                                        <span
                                            class="px-4 py-1.5 bg-white/20 backdrop-blur-md text-white text-xs font-bold rounded-full border border-white/30">
                                            {{ $project->category->name }}
                                        </span>
                                        <span class="text-white/80 text-sm">
                                            {{ $project->created_at->format('d M Y') }}
                                        </span>
                                    </div>
                                    <h3 class="text-4xl font-bold mb-3 leading-tight">{{ $project->judul }}</h3>
                                    <p class="text-white/90 text-base line-clamp-2 mb-6 max-w-2xl">
                                        {{ Str::limit($project->deskripsi, 120) }}
                                    </p>

                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center gap-3">
                                            <img src="{{ $project->user->foto_profil ? asset('storage/' . $project->user->foto_profil) : 'https://ui-avatars.com/api/?name=' . urlencode($project->user->name) . '&background=random&color=fff' }}"
                                                class="w-12 h-12 rounded-full border-2 border-white shadow-lg">
                                            <div>
                                                <div class="font-semibold">{{ $project->user->name }}</div>
                                                <div class="text-white/70 text-sm">{{ $project->user->profile->jurusan ?? 'Siswa' }}
                                                </div>
                                            </div>
                                        </div>
                                        <a href="{{ route('projects.show', $project->slug) }}"
                                            class="inline-flex items-center px-6 py-3 bg-white text-gray-900 font-semibold rounded-full hover:bg-gray-100 transition-all shadow-lg">
                                            Lihat Detail
                                            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 5l7 7-7 7"></path>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Navigation Buttons -->
                <button id="slider-prev"
                    class="absolute left-4 top-1/2 -translate-y-1/2 z-50 w-14 h-14 bg-white/90 backdrop-blur-sm rounded-full shadow-xl flex items-center justify-center hover:bg-white hover:scale-110 transition-all group">
                    <svg class="w-6 h-6 text-gray-800 group-hover:text-blue-600 transition-colors" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                </button>
                <button id="slider-next"
                    class="absolute right-4 top-1/2 -translate-y-1/2 z-50 w-14 h-14 bg-white/90 backdrop-blur-sm rounded-full shadow-xl flex items-center justify-center hover:bg-white hover:scale-110 transition-all group">
                    <svg class="w-6 h-6 text-gray-800 group-hover:text-blue-600 transition-colors" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </button>

                <!-- Progress Dots -->
                <div class="absolute bottom-6 left-1/2 -translate-x-1/2 z-50 flex gap-2">
                    @foreach($featuredProjects as $index => $project)
                        <button
                            class="slider-dot h-2 rounded-full transition-all duration-300 {{ $index === 0 ? 'w-8 bg-white' : 'w-2 bg-white/50' }}"
                            data-index="{{ $index }}"></button>
                    @endforeach
                </div>
            </div>
        @endif
        </div>
    </section>

    <!-- CSS Animations -->
    <style>
        @keyframes blob {

            0%,
            100% {
                transform: translate(0, 0) scale(1);
            }

            33% {
                transform: translate(30px, -50px) scale(1.1);
            }

            66% {
                transform: translate(-20px, 20px) scale(0.9);
            }
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-20px);
            }
        }

        .animate-blob {
            animation: blob 7s infinite;
        }

        .animate-float {
            animation: float 6s ease-in-out infinite;
        }

        .animation-delay-2000 {
            animation-delay: 2s;
        }

        .animation-delay-4000 {
            animation-delay: 4s;
        }

        .animation-delay-1000 {
            animation-delay: 1s;
        }

        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>

    <!-- JavaScript untuk Auto-Slider -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const slider = document.getElementById('portfolio-slider');
            const dots = document.querySelectorAll('.slider-dot');
            const prevBtn = document.getElementById('slider-prev');
            const nextBtn = document.getElementById('slider-next');

            if (!slider || dots.length === 0) return;

            let currentIndex = 0;
            const totalSlides = dots.length;
            let autoSlideInterval;

            function goToSlide(index) {
                if (index < 0) index = totalSlides - 1;
                if (index >= totalSlides) index = 0;

                currentIndex = index;
                slider.style.transform = `translateX(-${currentIndex * 100}%)`;

                // Update dots
                dots.forEach((dot, i) => {
                    if (i === currentIndex) {
                        dot.classList.remove('bg-white/50', 'w-3');
                        dot.classList.add('bg-white', 'w-8');
                    } else {
                        dot.classList.remove('bg-white', 'w-8');
                        dot.classList.add('bg-white/50', 'w-3');
                    }
                });
            }

            function nextSlide() {
                goToSlide(currentIndex + 1);
            }

            function prevSlide() {
                goToSlide(currentIndex - 1);
            }

            function startAutoSlide() {
                autoSlideInterval = setInterval(nextSlide, 5000); // Ganti slide setiap 5 detik
            }

            function stopAutoSlide() {
                clearInterval(autoSlideInterval);
            }

            // Event listeners
            nextBtn.addEventListener('click', () => {
                stopAutoSlide();
                nextSlide();
                startAutoSlide();
            });

            prevBtn.addEventListener('click', () => {
                stopAutoSlide();
                prevSlide();
                startAutoSlide();
            });

            dots.forEach((dot, index) => {
                dot.addEventListener('click', () => {
                    stopAutoSlide();
                    goToSlide(index);
                    startAutoSlide();
                });
            });

            // Pause on hover
            slider.parentElement.addEventListener('mouseenter', stopAutoSlide);
            slider.parentElement.addEventListener('mouseleave', startAutoSlide);

            // Start auto slide
            startAutoSlide();
        });
    </script>

    <!-- Section Karya Terbaru -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header Section -->
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">Karya Terbaru</h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                    Jelajahi proyek-proyek terbaru dari siswa berbakat kami
                </p>
            </div>

            <!-- Projects Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
                @foreach($featuredProjects as $project)
                    <div
                        class="group bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2">
                        <!-- Thumbnail -->
                        <div class="h-56 bg-gray-200 overflow-hidden relative">
                            @if($project->thumbnail && file_exists(storage_path('app/public/' . $project->thumbnail)))
                                <img src="{{ asset('storage/' . $project->thumbnail) }}" alt="{{ $project->judul }}"
                                    class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                            @else
                                <div
                                    class="w-full h-full bg-gradient-to-br from-blue-400 to-purple-500 flex items-center justify-center">
                                    <svg class="w-20 h-20 text-white/50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                </div>
                            @endif

                            <!-- Badge Kategori -->
                            <div class="absolute top-4 left-4">
                                <span
                                    class="px-3 py-1 bg-white/90 backdrop-blur-sm text-blue-600 text-xs font-bold rounded-full shadow-sm">
                                    {{ $project->category->name }}
                                </span>
                            </div>
                        </div>

                        <!-- Content -->
                        <div class="p-6">
                            <h3 class="text-xl font-bold text-gray-900 mb-2 group-hover:text-blue-600 transition-colors">
                                {{ Str::limit($project->judul, 50) }}
                            </h3>
                            <p class="text-gray-600 text-sm mb-4 line-clamp-2">
                                {{ Str::limit($project->deskripsi, 80) }}
                            </p>

                            <!-- Creator Info -->
                            <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                                <div class="flex items-center gap-3">
                                    <img src="{{ $project->user->foto_profil ? asset('storage/' . $project->user->foto_profil) : 'https://ui-avatars.com/api/?name=' . urlencode($project->user->name) . '&background=random' }}"
                                        class="w-10 h-10 rounded-full">
                                    <div>
                                        <div class="text-sm font-medium text-gray-900">{{ $project->user->name }}</div>
                                        <div class="text-xs text-gray-500">{{ $project->user->profile->jurusan ?? 'Siswa' }}
                                        </div>
                                    </div>
                                </div>
                                <a href="{{ route('projects.show', $project->slug) }}"
                                    class="inline-flex items-center text-blue-600 hover:text-blue-700 font-medium text-sm">
                                    Lihat Detail
                                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                                        </path>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- View All Button -->
            <div class="text-center">
                <a href="{{ route('projects.index') }}"
                    class="inline-flex items-center px-8 py-4 bg-blue-600 text-white font-semibold rounded-full hover:bg-blue-700 transition-all shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                    Lihat Semua Proyek
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6">
                        </path>
                    </svg>
                </a>
            </div>
        </div>
    </section>

    <style>
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        @keyframes blob {

            0%,
            100% {
                transform: translate(0, 0) scale(1);
            }

            33% {
                transform: translate(30px, -50px) scale(1.1);
            }

            66% {
                transform: translate(-20px, 20px) scale(0.9);
            }
        }

        .animate-blob {
            animation: blob 7s infinite;
        }

        .animation-delay-2000 {
            animation-delay: 2s;
        }

        .animation-delay-4000 {
            animation-delay: 4s;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const cards = document.querySelectorAll('.slider-card');
            const dots = document.querySelectorAll('.slider-dot');
            const prevBtn = document.getElementById('slider-prev');
            const nextBtn = document.getElementById('slider-next');

            if (cards.length === 0) return;

            let currentIndex = 0;
            const totalCards = cards.length;
            let autoSlideInterval;

            function updateSlider() {
                cards.forEach((card, index) => {
                    // Hitung offset dari kartu aktif
                    let offset = index - currentIndex;

                    // Wrap around untuk infinite loop
                    if (offset > totalCards / 2) offset -= totalCards;
                    if (offset < -totalCards / 2) offset += totalCards;

                    const absOffset = Math.abs(offset);

                    // Posisi dan styling berdasarkan jarak dari kartu aktif
                    if (absOffset === 0) {
                        // Kartu aktif - di tengah, paling besar
                        card.style.transform = 'translateX(0) scale(1)';
                        card.style.zIndex = '30';
                        card.style.opacity = '1';
                    } else if (absOffset === 1) {
                        // Kartu di samping - sedikit lebih kecil, di belakang
                        const direction = offset > 0 ? 1 : -1;
                        card.style.transform = `translateX(${direction * 55}%) scale(0.85)`;
                        card.style.zIndex = '20';
                        card.style.opacity = '0.7';
                    } else if (absOffset === 2) {
                        // Kartu paling jauh - lebih kecil lagi
                        const direction = offset > 0 ? 1 : -1;
                        card.style.transform = `translateX(${direction * 85}%) scale(0.7)`;
                        card.style.zIndex = '10';
                        card.style.opacity = '0.4';
                    } else {
                        // Kartu lainnya - disembunyikan
                        card.style.transform = `translateX(${offset > 0 ? 120 : -120}%) scale(0.6)`;
                        card.style.zIndex = '0';
                        card.style.opacity = '0';
                    }
                });

                // Update dots
                dots.forEach((dot, i) => {
                    if (i === currentIndex) {
                        dot.classList.remove('w-2', 'bg-white/50');
                        dot.classList.add('w-8', 'bg-white');
                    } else {
                        dot.classList.remove('w-8', 'bg-white');
                        dot.classList.add('w-2', 'bg-white/50');
                    }
                });
            }

            function nextSlide() {
                currentIndex = (currentIndex + 1) % totalCards;
                updateSlider();
            }

            function prevSlide() {
                currentIndex = (currentIndex - 1 + totalCards) % totalCards;
                updateSlider();
            }

            function goToSlide(index) {
                currentIndex = index;
                updateSlider();
            }

            function startAutoSlide() {
                autoSlideInterval = setInterval(nextSlide, 4000);
            }

            function stopAutoSlide() {
                clearInterval(autoSlideInterval);
            }

            // Event listeners
            nextBtn?.addEventListener('click', () => {
                stopAutoSlide();
                nextSlide();
                startAutoSlide();
            });

            prevBtn?.addEventListener('click', () => {
                stopAutoSlide();
                prevSlide();
                startAutoSlide();
            });

            dots.forEach((dot, index) => {
                dot.addEventListener('click', () => {
                    stopAutoSlide();
                    goToSlide(index);
                    startAutoSlide();
                });
            });

            // Klik kartu untuk navigasi
            cards.forEach((card, index) => {
                card.addEventListener('click', (e) => {
                    if (index !== currentIndex) {
                        stopAutoSlide();
                        goToSlide(index);
                        startAutoSlide();
                    }
                });
            });

            // Pause on hover
            const sliderContainer = document.getElementById('stacked-slider');
            sliderContainer?.addEventListener('mouseenter', stopAutoSlide);
            sliderContainer?.addEventListener('mouseleave', startAutoSlide);

            // Initialize
            updateSlider();
            startAutoSlide();
        });
    </script>
@endsection