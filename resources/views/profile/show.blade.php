@extends('layouts.app')

@section('content')
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

        <!-- Header Profil (Cover & Avatar) -->
        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden mb-8">
            <!-- Cover Photo (Gradient) -->
            <div class="h-48 bg-gradient-to-r from-blue-500 to-indigo-600"></div>

            <div class="px-8 pb-8">
                <!-- Row 1: Avatar + Tombol (Sejajar) -->
                <div class="flex justify-between items-start -mt-16 mb-6">
                    <!-- Avatar (Sisi Kiri) -->
                    <div class="relative">
                        <img src="{{ $user->foto_profil ?? 'https://ui-avatars.com/api/?name=' . urlencode($user->name) . '&size=128&background=0D8ABC&color=fff' }}"
                            class="w-32 h-32 rounded-full border-4 border-white shadow-md bg-white">
                        <div class="absolute bottom-2 right-2 w-6 h-6 bg-green-500 border-2 border-white rounded-full"
                            title="Available for hire"></div>
                    </div>

                    <!-- Action Buttons (Sisi Kanan) -->
                    <div class="flex gap-3 mt-4">
                        <!-- Tombol Unduh CV -->
                        <a href="{{ route('profile.download-cv', $user->id) }}"
                            class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-full hover:bg-gray-50 transition shadow-sm">
                            <svg class="w-4 h-4 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                            </svg>
                            Unduh CV
                        </a>

                        <!-- Tombol WhatsApp -->
                        @if($user->profile && $user->profile->phone)
                            <a href="https://wa.me/{{ preg_replace('/^0/', '62', $user->profile->phone) }}" target="_blank"
                                style="display: inline-flex; align-items: center; padding: 8px 16px; font-size: 14px; font-weight: 500; color: #FFFFFF !important; background-color: #10B981 !important; border: none; border-radius: 9999px; text-decoration: none; box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);"
                                onmouseover="this.style.backgroundColor='#059669'"
                                onmouseout="this.style.backgroundColor='#10B981'">
                                <svg style="width: 16px; height: 16px; margin-right: 8px; fill: #FFFFFF;" viewBox="0 0 24 24">
                                    <path
                                        d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z" />
                                </svg>
                                WhatsApp
                            </a>
                        @endif
                    </div>
                </div>

                <!-- Row 2: Info Utama (Nama, Tagline, Jurusan) -->
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">{{ $user->name }}</h1>
                    <p class="text-xl text-blue-600 font-medium mt-1">{{ $user->profile->tagline ?? 'Siswa Berbakat' }}</p>
                    <div class="flex items-center gap-4 mt-3 text-gray-500 text-sm">
                        <span class="flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                                </path>
                            </svg>
                            {{ $user->profile->jurusan ?? 'Jurusan Belum Diisi' }}
                        </span>
                        <span class="flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                </path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            SMK Talent Hub
                        </span>
                    </div>
                </div>

                <!-- Skill Tags -->
                @if($user->skills && $user->skills->isNotEmpty())
                    <div class="mt-6">
                        <h3 class="text-sm font-semibold text-gray-900 uppercase tracking-wider mb-3">Keahlian</h3>
                        <div class="flex flex-wrap gap-2">
                            @foreach($user->skills as $skill)
                                <span
                                    class="px-4 py-1.5 bg-blue-50 text-blue-700 text-sm font-medium rounded-full border border-blue-100">
                                    {{ $skill->name }}
                                </span>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>
        <!-- Galeri Proyek Siswa -->
        <div>
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Karya & Proyek</h2>

            @if($user->projects->where('status', 'approved')->count() > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($user->projects()->where('status', 'approved')->latest()->get() as $project)
                        <div
                            class="bg-white rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 overflow-hidden border border-gray-100 group">
                            <div class="h-48 bg-gray-200 overflow-hidden">
                                <img src="{{ $project->thumbnail }}" alt="{{ $project->judul }}"
                                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            </div>
                            <div class="p-5">
                                <span
                                    class="text-xs font-semibold text-blue-600 bg-blue-50 px-2 py-1 rounded-full">{{ $project->category->name }}</span>
                                <h3 class="font-bold text-gray-800 mt-2 text-lg line-clamp-1">{{ $project->judul }}</h3>
                                <p class="text-gray-500 text-sm mt-1 line-clamp-2">{{ Str::limit($project->deskripsi, 80) }}</p>

                                <a href="{{ route('projects.show', $project->slug) }}"
                                    class="mt-4 inline-flex items-center text-blue-600 hover:text-blue-700 font-medium text-sm">
                                    Lihat Detail Proyek
                                    <svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                                        </path>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="bg-white rounded-2xl p-12 text-center border border-gray-100">
                    <p class="text-gray-500">Siswa ini belum mengunggah proyek apapun.</p>
                </div>
            @endif
        </div>

    </div>
@endsection