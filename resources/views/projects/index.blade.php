@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Header Halaman -->
        <div class="text-center mb-12">
            <h1 class="text-4xl font-extrabold text-gray-900 sm:text-5xl">
                Discovery Feed
            </h1>
            <p class="mt-4 text-xl text-gray-500 max-w-2xl mx-auto">
                Jelajahi ribuan karya inovatif dari siswa-siswi berbakat. Filter berdasarkan jurusan atau temukan yang
                paling populer.
            </p>
        </div>

        <!-- Panggil Komponen Livewire -->
        <livewire:project-feed />
    </div>
@endsection