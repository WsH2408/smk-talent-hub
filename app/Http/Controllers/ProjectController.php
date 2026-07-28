<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::query()
            ->with(['category', 'user.profile'])
            ->where('status', 'approved')
            ->latest()
            ->paginate(12);

        $categories = Category::all();

        return view('projects.index', compact('projects', 'categories'));
    }

    public function show($project)
    {
        $project = $project instanceof Project ? $project : Project::where('slug', $project)->firstOrFail();

        $project->load(['category', 'user.profile', 'likes']);

        $relatedProjects = Project::query()
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
        $categories = Category::all();

        return view('projects.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'kategori' => 'required|exists:categories,id',
            'thumbnail' => 'required|image|max:2048',
            'link_demo' => 'nullable|url',
        ]);

        $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public');

        Project::create([
            'user_id' => Auth::id(),
            'category_id' => $validated['kategori'],
            'judul' => $validated['judul'],
            'deskripsi' => $validated['deskripsi'],
            'thumbnail' => $thumbnailPath,
            'link_demo' => $validated['link_demo'],
            'status' => 'pending',
        ]);

        return redirect()->route('dashboard')->with('success', 'Proyek berhasil diunggah! Tunggu persetujuan admin.');
    }
}