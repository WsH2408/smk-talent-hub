<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Project;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_siswa' => User::where('role', 'siswa')->count(),
            'total_rekruter' => User::where('role', 'rekruter')->count(),
            'total_proyek' => Project::count(),
            'proyek_pending' => Project::where('status', 'pending')->count(),
        ];

        $recentProjects = Project::with(['user', 'category'])
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'recentProjects'));
    }
}