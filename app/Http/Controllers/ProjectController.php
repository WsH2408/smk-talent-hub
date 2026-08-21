<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Project;
use App\Models\ProjectImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        $query = Project::with(['user.profile', 'category', 'images'])
            ->where('status', 'approved');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                    ->orWhereHas('user', function ($uq) use ($search) {
                        $uq->where('name', 'like', "%{$search}%");
                    });
            });
        }

        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        $projects = $query->latest()->paginate(12)->withQueryString();
        $categories = Category::all();

        return view('projects.index', compact('projects', 'categories'));
    }

    public function show(Project $project)
    {

        $project->load(['user.profile', 'category', 'images']);

        $relatedProjects = Project::with(['user.profile', 'category'])
            ->where('category_id', $project->category_id)
            ->where('id', '!=', $project->id)
            ->where('status', 'approved')
            ->latest()
            ->take(3)
            ->get();

        return view('projects.show', compact('project', 'relatedProjects'));
    }

    public function create()
    {
        if (auth()->user()->role !== 'siswa') {
            abort(403, 'Hanya siswa yang dapat mengunggah proyek.');
        }

        $categories = Category::all();

        return view('projects.create', compact('categories'));
    }

    public function store(Request $request)
    {
        if (auth()->user()->role !== 'siswa') {
            abort(403, 'Hanya siswa yang dapat mengunggah proyek.');
        }

        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'images' => 'nullable|array|max:5',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'link_demo' => 'nullable|url',
            'link_github' => 'nullable|url',
            'tools' => 'nullable|array|max:10',
            'tools.*' => 'string|max:50',
            'tanggal_mulai' => 'nullable|date',
            'tanggal_selesai' => 'nullable|date|after_or_equal:tanggal_mulai',
        ]);

        // Generate slug
        $slug = Str::slug($validated['judul']).'-'.time();

        // Simpan thumbnail
        $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public');

        // Buat project
        $project = Project::create([
            'user_id' => auth()->id(),
            'category_id' => $validated['category_id'],
            'judul' => $validated['judul'],
            'slug' => $slug,
            'deskripsi' => $validated['deskripsi'],
            'thumbnail' => $thumbnailPath,
            'link_demo' => $validated['link_demo'] ?? null,
            'link_github' => $validated['link_github'] ?? null,
            'tools' => $validated['tools'] ?? [],
            'tanggal_mulai' => $validated['tanggal_mulai'] ?? null,
            'tanggal_selesai' => $validated['tanggal_selesai'] ?? null,
            'status' => 'approved',
        ]);

        // Simpan multiple images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $image) {
                $path = $image->store('project_images', 'public');
                ProjectImage::create([
                    'project_id' => $project->id,
                    'image_path' => $path,
                    'order' => $index,
                ]);
            }
        }

        return redirect()->route('dashboard')->with('success', '🎉 Proyek berhasil diunggah!');
    }

    public function edit(Project $project)
    {
        if ($project->user_id !== auth()->id()) {
            abort(403, 'Anda tidak berhak mengedit proyek ini.');
        }

        $categories = Category::all();

        return view('projects.edit', compact('project', 'categories'));
    }

    public function update(Request $request, Project $project)
    {
        if ($project->user_id !== auth()->id()) {
            abort(403, 'Anda tidak berhak mengedit proyek ini.');
        }

        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'images' => 'nullable|array|max:5',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'link_demo' => 'nullable|url',
            'link_github' => 'nullable|url',
            'tools' => 'nullable|array|max:10',
            'tools.*' => 'string|max:50',
            'tanggal_mulai' => 'nullable|date',
            'tanggal_selesai' => 'nullable|date|after_or_equal:tanggal_mulai',
        ]);

        $data = [
            'judul' => $validated['judul'],
            'deskripsi' => $validated['deskripsi'],
            'category_id' => $validated['category_id'],
            'link_demo' => $validated['link_demo'] ?? null,
            'link_github' => $validated['link_github'] ?? null,
            'tools' => $validated['tools'] ?? [],
            'tanggal_mulai' => $validated['tanggal_mulai'] ?? null,
            'tanggal_selesai' => $validated['tanggal_selesai'] ?? null,
        ];

        // Update thumbnail jika ada file baru
        if ($request->hasFile('thumbnail')) {
            Storage::disk('public')->delete($project->thumbnail);
            $data['thumbnail'] = $request->file('thumbnail')->store('thumbnails', 'public');
        }

        $project->update($data);

        // Update multiple images jika ada
        if ($request->hasFile('images')) {
            // Hapus images lama
            foreach ($project->images as $oldImage) {
                Storage::disk('public')->delete($oldImage->image_path);
                $oldImage->delete();
            }

            // Simpan images baru
            foreach ($request->file('images') as $index => $image) {
                $path = $image->store('project_images', 'public');
                ProjectImage::create([
                    'project_id' => $project->id,
                    'image_path' => $path,
                    'order' => $index,
                ]);
            }
        }

        return redirect()->route('profile.show', auth()->user())->with('success', 'Proyek berhasil diupdate!');
    }

    public function destroy(Project $project)
    {
        if ($project->user_id !== auth()->id()) {
            abort(403, 'Anda tidak berhak menghapus proyek ini.');
        }

        // Hapus thumbnail
        Storage::disk('public')->delete($project->thumbnail);

        // Hapus semua images
        foreach ($project->images as $image) {
            Storage::disk('public')->delete($image->image_path);
        }

        $project->images()->delete();
        $project->delete();

        return redirect()->route('profile.show', auth()->user())->with('success', 'Proyek berhasil dihapus!');
    }
}
