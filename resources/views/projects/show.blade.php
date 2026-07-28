@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid gap-8 lg:grid-cols-3">
            <div class="lg:col-span-2 bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <img src="{{ $project->thumbnail }}" alt="{{ $project->judul }}" class="w-full h-80 object-cover">
                <div class="p-8">
                    <div class="flex items-center gap-3">
                        <span class="inline-flex rounded-full bg-blue-100 px-3 py-1 text-sm font-medium text-blue-800">{{ $project->category->name }}</span>
                        <span class="text-sm text-gray-500">{{ $project->status }}</span>
                    </div>
                    <h1 class="mt-4 text-3xl font-bold text-gray-900">{{ $project->judul }}</h1>
                    <p class="mt-4 text-gray-600 leading-relaxed">{{ $project->deskripsi }}</p>

                    @if($project->link_demo)
                        <a href="{{ $project->link_demo }}" target="_blank" class="mt-6 inline-flex rounded-full bg-blue-600 px-5 py-3 text-white font-medium">Lihat Demo</a>
                    @endif
                </div>
            </div>

            <aside class="space-y-6">
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                    <h2 class="text-lg font-semibold text-gray-900">Pembuat</h2>
                    <div class="mt-4 flex items-center gap-3">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($project->user->name) }}" class="w-12 h-12 rounded-full">
                        <div>
                            <p class="font-medium text-gray-900">{{ $project->user->name }}</p>
                            <p class="text-sm text-gray-500">{{ $project->user->profile->jurusan ?? 'Siswa' }}</p>
                        </div>
                    </div>
                </div>

                @if($relatedProjects->isNotEmpty())
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                        <h2 class="text-lg font-semibold text-gray-900">Proyek Terkait</h2>
                        <div class="mt-4 space-y-4">
                            @foreach($relatedProjects as $related)
                                <a href="{{ route('projects.show', $related->slug) }}" class="block rounded-xl border border-gray-100 p-3 hover:bg-gray-50">
                                    <p class="font-medium text-gray-900">{{ $related->judul }}</p>
                                    <p class="text-sm text-gray-500">{{ Str::limit($related->deskripsi, 80) }}</p>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif
            </aside>
        </div>
    </div>
@endsection
