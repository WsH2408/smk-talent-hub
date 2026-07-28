@extends('layouts.app')

@section('content')
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <h1 class="text-2xl font-bold text-gray-900 mb-6">Unggah Proyek Baru</h1>

        <form action="{{ route('projects.store') }}" method="POST" enctype="multipart/form-data"
            class="bg-white rounded-2xl shadow-sm p-8 border border-gray-100">
            @csrf

            <!-- Judul Proyek -->
            <div class="mb-6">
                <label for="judul" class="block text-sm font-medium text-gray-700 mb-2">Judul Proyek</label>
                <input type="text" name="judul" id="judul"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                    placeholder="Contoh: Aplikasi Toko Online dengan Laravel" required>
            </div>

            <!-- Deskripsi -->
            <div class="mb-6">
                <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
                <textarea name="deskripsi" id="deskripsi" rows="5"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                    placeholder="Jelaskan tentang proyek ini..." required></textarea>
            </div>

            <!-- Kategori -->
            <div class="mb-6">
                <label for="kategori" class="block text-sm font-medium text-gray-700 mb-2">Kategori</label>
                <select name="kategori" id="kategori"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                    required>
                    <option value="">Pilih kategori</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Thumbnail -->
            <div class="mb-6">
                <label for="thumbnail" class="block text-sm font-medium text-gray-700 mb-2">Thumbnail (Gambar)</label>
                <input type="file" name="thumbnail" id="thumbnail" accept="image/*" class="w-full text-sm text-gray-500 
                       file:mr-4 file:py-2 file:px-4 
                       file:rounded-full file:border-0 file:text-sm file:font-semibold
                       file:bg-blue-50 file:text-blue-700
                       hover:file:bg-blue-100" required>
                <p class="mt-2 text-sm text-gray-500">Format: JPG, PNG. Ukuran maks: 2MB</p>
            </div>

            <!-- Link Demo (Opsional) -->
            <div class="mb-6">
                <label for="link_demo" class="block text-sm font-medium text-gray-700 mb-2">Link Demo (Opsional)</label>
                <input type="url" name="link_demo" id="link_demo"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                    placeholder="https://example.com">
            </div>

            <!-- Submit Button -->
            <div class="flex justify-end">
                <button type="submit"
                    class="px-6 py-3 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition shadow-sm">
                    Unggah Proyek
                </button>
            </div>
        </form>
    </div>
@endsection