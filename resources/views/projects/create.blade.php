@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
            <h1 class="text-3xl font-bold text-gray-900">Unggah Proyek</h1>
            <p class="mt-2 text-gray-600">Bagikan karya terbaikmu untuk dipamerkan di platform ini.</p>

            <form action="{{ route('projects.store') }}" method="POST" enctype="multipart/form-data" class="mt-8 space-y-6">
                @csrf

                <div>
                    <label class="block text-sm font-medium text-gray-700">Judul Proyek</label>
                    <input type="text" name="judul" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm" required>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Deskripsi</label>
                    <textarea name="deskripsi" rows="5" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm" required></textarea>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Kategori</label>
                    <select name="kategori" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm" required>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Thumbnail</label>
                    <input type="file" name="thumbnail" class="mt-1 block w-full text-sm text-gray-500" required>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Link Demo</label>
                    <input type="url" name="link_demo" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm">
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="rounded-full bg-blue-600 px-6 py-3 text-white font-medium">Simpan Proyek</button>
                </div>
            </form>
        </div>
    </div>
@endsection
