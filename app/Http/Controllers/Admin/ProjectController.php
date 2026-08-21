<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        // Ambil semua proyek yang approved
        $projects = \App\Models\Project::with(['user.profile', 'category'])
            ->where('status', 'approved')
            ->latest()
            ->paginate(12); // Tampilkan 12 per halaman

        return view('projects.index', compact('projects'));
    }

    public function approve(Project $project)
    {
        $project->update(['status' => 'approved']);
        return redirect()->back()->with('success', 'Proyek disetujui!');
    }

    public function reject(Project $project)
    {
        $project->update(['status' => 'rejected']);
        return redirect()->back()->with('success', 'Proyek ditolak!');
    }

    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route('admin.projects')->with('success', 'Proyek dihapus!');
    }
}
