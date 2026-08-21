@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Edit Profil</h1>
        <p class="text-gray-500 mt-2">Kelola informasi profil Anda</p>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-6">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-6">
            <ul class="list-disc list-inside">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('profile.update.custom') }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-2xl shadow-sm p-8 border border-gray-100">
        @csrf
        @method('POST')

        <!-- Foto Profil -->
        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700 mb-2">Foto Profil</label>
            <div class="flex items-center gap-4 mb-4">
                @if($user->foto_profil && file_exists(storage_path('app/public/' . $user->foto_profil)))
                    <img src="{{ asset('storage/' . $user->foto_profil) }}"
                         alt="Foto Profil"
                         class="w-24 h-24 rounded-full object-cover border-2 border-gray-200">
                @else
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=random"
                         alt="Foto Profil"
                         class="w-24 h-24 rounded-full object-cover border-2 border-gray-200">
                @endif
                <div>
                    <p class="text-sm text-gray-600 mb-2">Format: JPG, PNG. Maksimal 2MB</p>
                    <input type="file" name="foto_profil" accept="image/*"
                           class="text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                </div>
            </div>
        </div>

        <!-- Nama Lengkap -->
        <div class="mb-6">
            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap <span class="text-red-500">*</span></label>
            <input type="text"
                   name="name"
                   id="name"
                   value="{{ old('name', $user->name) }}"
                   required
                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('name') border-red-500 @enderror">
            @error('name')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Email (Read Only) -->
        <div class="mb-6">
            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
            <input type="email"
                   id="email"
                   value="{{ $user->email }}"
                   disabled
                   class="w-full px-4 py-3 border border-gray-300 rounded-lg bg-gray-100 text-gray-500 cursor-not-allowed">
            <p class="text-xs text-gray-500 mt-1">Email tidak dapat diubah</p>
        </div>

        <!-- Role Badge -->
        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700 mb-2">Role Akun</label>
            <div class="inline-flex items-center px-4 py-2 rounded-lg
                {{ $user->role === 'admin' ? 'bg-purple-100 text-purple-700' :
                   ($user->role === 'rekruter' ? 'bg-green-100 text-green-700' : 'bg-blue-100 text-blue-700') }}">
                <span class="font-semibold capitalize">{{ ucfirst($user->role) }}</span>
            </div>
        </div>

        <!-- Fields Khusus Siswa -->
        @if($user->role === 'siswa')
            <div class="border-t border-gray-200 pt-6 mt-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Informasi Siswa</h3>

                <!-- Tagline -->
                <div class="mb-6">
                    <label for="tagline" class="block text-sm font-medium text-gray-700 mb-2">Tagline Profil</label>
                    <input type="text"
                           name="tagline"
                           id="tagline"
                           value="{{ old('tagline', $user->profile->tagline ?? '') }}"
                           placeholder="Contoh: Frontend Developer & UI/UX Designer"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('tagline') border-red-500 @enderror">
                    @error('tagline')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                    <p class="text-xs text-gray-500 mt-1">Tampilan singkat tentang diri Anda</p>
                </div>

                <!-- Jurusan -->
                <div class="mb-6">
                    <label for="jurusan" class="block text-sm font-medium text-gray-700 mb-2">Jurusan <span class="text-red-500">*</span></label>
                    <select name="jurusan"
                            id="jurusan"
                            required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('jurusan') border-red-500 @enderror">
                        <option value="">Pilih Jurusan</option>
                        <option value="RPL" {{ old('jurusan', $user->profile->jurusan ?? '') == 'RPL' ? 'selected' : '' }}>Rekayasa Perangkat Lunak (RPL)</option>
                        <option value="Multimedia" {{ old('jurusan', $user->profile->jurusan ?? '') == 'Multimedia' ? 'selected' : '' }}>Multimedia (MM)</option>
                        <option value="TKJ" {{ old('jurusan', $user->profile->jurusan ?? '') == 'TKJ' ? 'selected' : '' }}>Teknik Komputer dan Jaringan (TKJ)</option>
                        <option value="DKV" {{ old('jurusan', $user->profile->jurusan ?? '') == 'DKV' ? 'selected' : '' }}>Desain Komunikasi Visual (DKV)</option>
                        <option value="Animasi" {{ old('jurusan', $user->profile->jurusan ?? '') == 'Animasi' ? 'selected' : '' }}>Animasi</option>
                        <option value="Lainnya" {{ old('jurusan', $user->profile->jurusan ?? '') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                    </select>
                    @error('jurusan')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Nomor WhatsApp -->
                <div class="mb-6">
                    <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">Nomor WhatsApp</label>
                    <input type="text"
                           name="phone"
                           id="phone"
                           value="{{ old('phone', $user->profile->phone ?? '') }}"
                           placeholder="081234567890"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('phone') border-red-500 @enderror">
                    @error('phone')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                    <p class="text-xs text-gray-500 mt-1">Format: 08xxxxxxxxxx</p>
                </div>

                <!-- Keahlian/Skills -->
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Keahlian</label>
                    <p class="text-xs text-gray-500 mb-3">Pilih keahlian yang Anda kuasai (bisa pilih lebih dari satu)</p>

                    @if(isset($skills) && $skills->count() > 0)
                        <div class="grid grid-cols-2 sm:grid-cols-3 gap-3">
                            @foreach($skills as $skill)
                                <label class="flex items-center space-x-3 p-3 border border-gray-200 rounded-lg hover:bg-gray-50 cursor-pointer transition-colors">
                                    <input type="checkbox"
                                           name="skills[]"
                                           value="{{ $skill->id }}"
                                           {{ in_array($skill->id, $userSkills ?? []) ? 'checked' : '' }}
                                           class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                                    <span class="text-sm text-gray-700 font-medium">{{ $skill->name }}</span>
                                </label>
                            @endforeach
                        </div>
                    @else
                        <div class="p-4 bg-yellow-50 border border-yellow-200 rounded-lg">
                            <p class="text-sm text-yellow-700">Belum ada data keahlian. Silakan hubungi administrator.</p>
                        </div>
                    @endif
                    @error('skills')
                        <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        @else
            <!-- Info untuk Admin/Rekruter -->
            <div class="border-t border-gray-200 pt-6 mt-6">
                <div class="p-4 bg-blue-50 border border-blue-200 rounded-lg">
                    <div class="flex items-start">
                        <svg class="w-5 h-5 text-blue-600 mt-0.5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <div>
                            <h4 class="text-sm font-semibold text-blue-900 mb-1">Informasi {{ ucfirst($user->role) }}</h4>
                            <p class="text-sm text-blue-700">
                                Anda login sebagai <strong>{{ ucfirst($user->role) }}</strong>. Field khusus siswa (tagline, jurusan, nomor WhatsApp, dan keahlian) tidak tersedia untuk akun Anda.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <!-- Action Buttons -->
        <div class="flex justify-end gap-3 pt-6 border-t border-gray-200 mt-6">
            <a href="{{ route('profile.show', $user) }}"
               class="px-6 py-3 bg-gray-200 text-gray-700 font-medium rounded-lg hover:bg-gray-300 transition">
                Batal
            </a>
            <button type="submit"
                    class="px-6 py-3 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition shadow-sm">
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>
@endsection
