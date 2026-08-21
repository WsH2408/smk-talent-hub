@extends('layouts.admin')

@section('content')
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Kelola Proyek</h1>
        <p class="text-gray-500 mt-1">Kelola dan moderasi semua proyek yang diunggah siswa</p>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Judul</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Siswa</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Kategori</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($projects as $project)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $project->judul }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-600">{{ $project->user->name }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-600">{{ $project->category->name }}</td>
                                    <td class="px-6 py-4">
                                        <span
                                            class="px-3 py-1 text-xs font-medium rounded-full 
                                                {{ $project->status == 'approved' ? 'bg-green-100 text-green-700' :
                        ($project->status == 'pending' ? 'bg-yellow-100 text-yellow-700' : 'bg-red-100 text-red-700') }}">
                                            {{ ucfirst($project->status) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-600">{{ $project->created_at->format('d M Y') }}</td>
                                    <td class="px-6 py-4">
                                        @if($project->status == 'pending')
                                            <form action="{{ route('admin.projects.approve', $project) }}" method="POST" class="inline">
                                                @csrf
                                                <button type="submit"
                                                    class="text-green-600 hover:text-green-700 text-sm font-medium mr-2">Setujui</button>
                                            </form>
                                            <form action="{{ route('admin.projects.reject', $project) }}" method="POST" class="inline">
                                                @csrf
                                                <button type="submit"
                                                    class="text-red-600 hover:text-red-700 text-sm font-medium mr-2">Tolak</button>
                                            </form>
                                        @endif
                                        <form action="{{ route('admin.projects.destroy', $project) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-gray-600 hover:text-gray-700 text-sm font-medium"
                                                onclick="return confirm('Yakin hapus?')">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-8 text-center text-gray-500">Belum ada proyek</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="px-6 py-4 border-t border-gray-100">
            {{ $projects->links() }}
        </div>
    </div>
@endsection