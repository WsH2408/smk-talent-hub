@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Dashboard</h1>
                    <p class="mt-2 text-gray-600">Selamat datang, {{ auth()->user()->name ?? 'pengguna' }}.</p>
                </div>
                <div class="flex flex-wrap gap-3">
                    <a href="{{ route('profile.edit') }}" class="inline-flex items-center px-5 py-3 rounded-full bg-blue-600 text-white text-sm font-medium hover:bg-blue-700 transition">Edit Profile</a>
                    @if(auth()->user()->role === 'siswa')
                        <a href="{{ route('projects.create') }}"
                           class="flex items-center px-6 py-3 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition shadow-sm">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            Unggah Proyek Baru
                        </a>
                    @endif
                </div>
            </div>

            <div class="mt-8 grid gap-6 md:grid-cols-2">
                <div class="rounded-xl border border-gray-100 bg-gray-50 p-6">
                    <h2 class="text-lg font-semibold text-gray-900">Profil</h2>
                    <p class="mt-2 text-sm text-gray-600">Lengkapi profilmu agar recruiter lebih mudah melihat kemampuanmu.</p>
                    <a href="{{ route('profile.edit') }}" class="mt-4 inline-flex items-center text-blue-600 hover:text-blue-700 font-medium">Ubah Profil</a>
                </div>

                <div class="rounded-xl border border-gray-100 bg-gray-50 p-6">
                    <h2 class="text-lg font-semibold text-gray-900">Proyek</h2>
                    <p class="mt-2 text-sm text-gray-600">Unggah karya terbaikmu dan tampilkan portofoliomu di platform ini.</p>
                    @if(auth()->user()->role === 'siswa')
                        <a href="{{ route('projects.create') }}" class="mt-4 inline-flex items-center text-green-600 hover:text-green-700 font-medium">Mulai Unggah</a>
                    @else
                        <p class="mt-4 text-sm text-gray-500">Hanya siswa yang dapat mengunggah proyek.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
