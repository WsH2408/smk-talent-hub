@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center gap-3 mb-2">
                <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12">
                        </path>
                    </svg>
                </div>
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Unggah Proyek Baru</h1>
                    <p class="text-gray-500 text-sm">Bagikan karya terbaikmu kepada dunia</p>
                </div>
            </div>
        </div>

        <form action="{{ route('projects.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <!-- Informasi Dasar -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 sm:p-8">
                <h2 class="text-lg font-semibold text-gray-900 mb-6 flex items-center">
                    <span
                        class="w-8 h-8 bg-blue-600 text-white rounded-full flex items-center justify-center text-sm font-bold mr-3">1</span>
                    Informasi Dasar
                </h2>

                <!-- Judul -->
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Judul Proyek <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="judul" value="{{ old('judul') }}" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Contoh: Aplikasi Kasir dengan Laravel">
                    <p class="text-xs text-gray-500 mt-1">Buat judul yang menarik dan deskriptif</p>
                </div>

                <!-- Kategori -->
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Kategori <span class="text-red-500">*</span>
                    </label>
                    <select name="category_id" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="">-- Pilih Kategori --</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Deskripsi -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Deskripsi Lengkap <span class="text-red-500">*</span>
                    </label>
                    <textarea name="deskripsi" rows="6" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Jelaskan tentang proyek ini: apa tujuannya, fitur utamanya, teknologi yang digunakan, dan tantangan yang dihadapi...">{{ old('deskripsi') }}</textarea>
                    <p class="text-xs text-gray-500 mt-1">Minimal 50 karakter untuk deskripsi yang baik</p>
                </div>
            </div>

            <!-- Upload Gambar -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 sm:p-8">
                <h2 class="text-lg font-semibold text-gray-900 mb-6 flex items-center">
                    <span
                        class="w-8 h-8 bg-blue-600 text-white rounded-full flex items-center justify-center text-sm font-bold mr-3">2</span>
                    Gambar Proyek
                </h2>

                <!-- Thumbnail (Wajib) -->
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Thumbnail / Cover <span class="text-red-500">*</span>
                    </label>
                    <div
                        class="border-2 border-dashed border-gray-300 rounded-lg p-6 hover:border-blue-500 transition-colors">
                        <div class="flex flex-col items-center">
                            <svg class="w-12 h-12 text-gray-400 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                </path>
                            </svg>
                            <p class="text-sm text-gray-600 mb-2">Pilih 1 gambar untuk thumbnail</p>
                            <p class="text-xs text-gray-500 mb-4">JPG, PNG, GIF (Maks 2MB)</p>
                            <input type="file" name="thumbnail" accept="image/*" required
                                class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                        </div>
                    </div>
                </div>

                <!-- Multiple Images (Opsional) -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Gambar Tambahan (Opsional)
                    </label>
                    <div
                        class="border-2 border-dashed border-gray-300 rounded-lg p-6 hover:border-blue-500 transition-colors">
                        <div class="flex flex-col items-center">
                            <svg class="w-12 h-12 text-gray-400 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path>
                            </svg>
                            <p class="text-sm text-gray-600 mb-2">Upload hingga 5 gambar tambahan</p>
                            <p class="text-xs text-gray-500 mb-4">Screenshot, mockup, atau foto proyek</p>
                            <input type="file" name="images[]" accept="image/*" multiple
                                class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-purple-50 file:text-purple-700 hover:file:bg-purple-100">
                        </div>
                    </div>
                    <p class="text-xs text-gray-500 mt-2"> Tip: Tambahkan screenshot fitur-fitur utama proyekmu</p>
                </div>
            </div>

            <!-- Detail Teknis -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 sm:p-8">
                <h2 class="text-lg font-semibold text-gray-900 mb-6 flex items-center">
                    <span
                        class="w-8 h-8 bg-blue-600 text-white rounded-full flex items-center justify-center text-sm font-bold mr-3">3</span>
                    Detail Teknis
                </h2>

                <!-- Link Demo & Github -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Link Demo (Opsional)
                        </label>
                        <input type="url" name="link_demo" value="{{ old('link_demo') }}"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="https://example.com">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Link GitHub (Opsional)
                        </label>
                        <input type="url" name="link_github" value="{{ old('link_github') }}"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="https://github.com/username/repo">
                    </div>
                </div>

                <!-- Tools/Teknologi -->
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Tools / Teknologi yang Digunakan
                    </label>
                    <input type="text" id="tools-input"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Ketik lalu tekan Enter (contoh: Laravel, MySQL, Tailwind)">
                    <div id="tools-tags" class="flex flex-wrap gap-2 mt-3">
                        <!-- Tags akan muncul di sini -->
                    </div>
                    <input type="hidden" name="tools[]" id="tools-hidden">
                    <p class="text-xs text-gray-500 mt-2">Tekan Enter atau koma untuk menambah tools</p>
                </div>

                <!-- Timeline -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Tanggal Mulai (Opsional)
                        </label>
                        <input type="date" name="tanggal_mulai" value="{{ old('tanggal_mulai') }}"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Tanggal Selesai (Opsional)
                        </label>
                        <input type="date" name="tanggal_selesai" value="{{ old('tanggal_selesai') }}"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex justify-end gap-3 sticky bottom-4">
                <a href="{{ route('dashboard') }}"
                    class="px-6 py-3 bg-white text-gray-700 font-medium rounded-lg hover:bg-gray-50 transition border border-gray-300 shadow-sm">
                    Batal
                </a>
                <button type="submit"
                    class="px-8 py-3 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                    🚀 Publikasikan Proyek
                </button>
            </div>
        </form>
    </div>

    <!-- JavaScript untuk Tools Tags -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const toolsInput = document.getElementById('tools-input');
            const toolsTags = document.getElementById('tools-tags');
            const toolsHidden = document.getElementById('tools-hidden');
            let tools = [];

            function updateTools() {
                toolsHidden.value = JSON.stringify(tools);
                toolsTags.innerHTML = tools.map((tool, index) => `
                    <span class="inline-flex items-center px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-sm font-medium">
                        ${tool}
                        <button type="button" onclick="removeTool(${index})" class="ml-2 text-blue-700 hover:text-blue-900">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </span>
                `).join('');
            }

            window.removeTool = function (index) {
                tools.splice(index, 1);
                updateTools();
            };

            toolsInput.addEventListener('keydown', function (e) {
                if (e.key === 'Enter' || e.key === ',') {
                    e.preventDefault();
                    const value = this.value.replace(',', '').trim();
                    if (value && !tools.includes(value) && tools.length < 10) {
                        tools.push(value);
                        updateTools();
                        this.value = '';
                    }
                }
            });
        });
    </script>
@endsection
