@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-gray-50">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

            <!-- Profile Card -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">

                <!-- Cover Photo dengan Avatar Absolute -->
                <div class="relative">
                    <!-- Cover Background -->
                    <div class="h-48 sm:h-64 bg-gradient-to-r from-blue-500 via-purple-500 to-pink-500"></div>

                    <!-- Avatar Container (Absolute Positioning) -->
                    <div class="absolute -bottom-16 sm:-bottom-20 left-6 sm:left-8">
                        <div class="relative">
                            <!-- Avatar dengan Border Putih Tebal -->
                            <div
                                class="w-32 h-32 sm:w-40 sm:h-40 rounded-full border-4 border-white shadow-xl overflow-hidden bg-gray-100">
                                @if($user->foto_profil && file_exists(storage_path('app/public/' . $user->foto_profil)))
                                    <img src="{{ asset('storage/' . $user->foto_profil) }}" alt="{{ $user->name }}"
                                        class="w-full h-full object-cover">
                                @else
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&size=200&background=random&color=fff&bold=true"
                                        alt="{{ $user->name }}" class="w-full h-full">
                                @endif
                            </div>

                            <!-- Role Badge -->
                            <span class="absolute bottom-2 right-2 px-3 py-1.5 rounded-full text-xs font-bold shadow-md
                                {{ $user->role === 'admin' ? 'bg-purple-500 text-white' :
        ($user->role === 'rekruter' ? 'bg-green-500 text-white' : 'bg-blue-500 text-white') }}">
                                {{ ucfirst($user->role) }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Profile Info Section -->
                <div class="pt-20 sm:pt-24 px-6 sm:px-8 pb-8">
                    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">

                        <!-- Name & Info -->
                        <div class="flex-1">
                            <h1 class="text-2xl sm:text-3xl font-bold text-gray-900">{{ $user->name }}</h1>

                            @if($user->profile && $user->profile->tagline)
                                <p class="text-gray-600 mt-1 text-base">{{ $user->profile->tagline }}</p>
                            @else
                                <p class="text-gray-400 mt-1 text-sm italic">Belum ada tagline</p>
                            @endif

                            <div class="flex items-center gap-2 mt-2 text-gray-500 text-sm">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                    </path>
                                </svg>
                                <span>{{ $user->email }}</span>
                            </div>
                        </div>

                        <!-- Edit Button -->
                        @if(auth()->id() === $user->id)
                            <div class="flex-shrink-0">
                                <a href="{{ route('profile.edit.custom') }}"
                                    class="inline-flex items-center px-5 py-2.5 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition shadow-sm">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                        </path>
                                    </svg>
                                    Edit Profil
                                </a>
                            </div>
                        @endif
                    </div>

                    <!-- Info Grid (untuk siswa) -->
                    @if($user->role === 'siswa' && $user->profile)
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mt-8 pt-6 border-t border-gray-100">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 14l9-5-9-5-9 5 9 5z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z">
                                        </path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500">Jurusan</p>
                                    <p class="text-sm font-semibold text-gray-900">{{ $user->profile->jurusan ?? '-' }}</p>
                                </div>
                            </div>

                            @if($user->profile->phone)
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                                            </path>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-500">WhatsApp</p>
                                        <p class="text-sm font-semibold text-gray-900">{{ $user->profile->phone }}</p>
                                    </div>
                                </div>
                            @endif

                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                    <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500">Bergabung</p>
                                    <p class="text-sm font-semibold text-gray-900">{{ $user->created_at->format('d M Y') }}</p>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Skills Section (Hanya untuk siswa) -->
            @if($user->role === 'siswa' && $user->skills->count() > 0)
                <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 sm:p-8 mt-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-4 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z">
                            </path>
                        </svg>
                        Keahlian
                    </h2>
                    <div class="flex flex-wrap gap-2">
                        @foreach($user->skills as $skill)
                            <span class="px-4 py-2 bg-blue-50 text-blue-700 font-medium rounded-lg text-sm border border-blue-100">
                                {{ $skill->name }}
                            </span>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Projects Section (Hanya untuk siswa) -->
            @if($user->role === 'siswa')
                @if($user->projects->count() > 0)
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden mt-6">
                        <div class="px-6 sm:px-8 py-4 border-b border-gray-100">
                            <h2 class="text-xl font-bold text-gray-900 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10">
                                    </path>
                                </svg>
                                Proyek ({{ $user->projects->count() }})
                            </h2>
                        </div>

                        <div class="divide-y divide-gray-100">
                            @foreach($user->projects as $project)
                                <div class="p-6 sm:p-8 hover:bg-gray-50 transition">
                                    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                                        <div class="flex-1">
                                            <h3 class="text-lg font-semibold text-gray-900 mb-2 hover:text-blue-600 transition-colors">
                                                <a href="{{ route('projects.show', $project->slug) }}">{{ $project->judul }}</a>
                                            </h3>
                                            <p class="text-gray-600 text-sm mb-3">{{ Str::limit($project->deskripsi, 150) }}</p>
                                            <div class="flex flex-wrap items-center gap-3 text-sm text-gray-500">
                                                <span class="px-3 py-1 bg-gray-100 rounded-full text-xs font-medium">
                                                    {{ $project->category->name }}
                                                </span>
                                                <span>•</span>
                                                <span>{{ $project->created_at->diffForHumans() }}</span>
                                            </div>
                                        </div>
                                        <a href="{{ route('projects.show', $project->slug) }}"
                                            class="flex-shrink-0 px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition">
                                            Lihat Detail
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @else
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-12 text-center mt-6">
                        <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10">
                                </path>
                            </svg>
                        </div>
                        <p class="text-gray-500 text-lg mb-4">Belum ada proyek yang diunggah</p>
                        @if(auth()->id() === $user->id)
                            <a href="{{ route('projects.create') }}"
                                class="inline-flex items-center px-6 py-3 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                </svg>
                                Upload Proyek Pertama
                            </a>
                        @endif
                    </div>
                @endif
            @endif

            <!-- Info untuk Admin/Rekruter -->
            @if($user->role !== 'siswa')
                <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-8 mt-6 text-center">
                    <div class="w-20 h-20 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-10 h-10 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Akun {{ ucfirst($user->role) }}</h3>
                    <p class="text-gray-500">
                        Anda login sebagai <strong>{{ ucfirst($user->role) }}</strong>.
                        @if($user->role === 'admin')
                            Kelola proyek dan pengguna dari <a href="{{ route('admin.dashboard') }}"
                                class="text-blue-600 hover:underline">Admin Panel</a>.
                        @else
                            Jelajahi karya siswa dari <a href="{{ route('recruiter.dashboard') }}"
                                class="text-blue-600 hover:underline">Recruiter Panel</a>.
                        @endif
                    </p>
                </div>
            @endif

        </div>
    </div>
@endsection
